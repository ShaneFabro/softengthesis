<?php

namespace App\Http\Controllers;

use App\User;
use App\Photo;
use Carbon\Carbon;
use App\PersonalParticular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateFacultyMemberRequest;
use App\Http\Requests\UpdateFacultyMemberRequest;

class FacultyMemberController extends Controller
{

    // public function pdf() {

    //     $userId = Auth::user()->id;

    //     $user = PersonalParticular::where('user_id', $userId)->first();

    //     $pdf = PDF::loadView('example', $user);
    //     return $pdf->stream('example.pdf');

    // }

    public function changePassword() {

        return view('facultymember.changepassword');

    }

    public function changePasswordConfirm(Request $request) {

        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|different:oldpassword',
        ]);

        if(Hash::check($request->oldpassword, auth()->user()->password)){

            $user = Auth::user();

            auth()->user()->update(['password' => Hash::make($request->newpassword)]);

            session()->flash('success', 'Password changed');

            Log::channel('customlog')->info('User ' . $user->name . ' changed his/her password.');

        } else {

            session()->flash('error', 'Password does not match to your current password.');

            return redirect()->back();

        }

        return redirect(route('member.index'));
           
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;

        $file = File::get(storage_path('logs/custom.log'));

        return view('facultymember.index')->with('user', PersonalParticular::where('user_id', $userId)->first())->with('file', $file);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facultymember.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFacultyMemberRequest $request)
    {
        

        $user = Auth::user();

        $data = $request->all();

        $data['fullname'] = $request->get('lastname') . ', ' . $request->get('firstname');

        $data['age'] = Carbon::parse($request->get('birth'))->diff(Carbon::now())->format('%y');

        if($request->hasFile('image')){

            $name = time() . $request->file('image')->getClientOriginalName();

            $request->file('image')->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            auth()->user()->update(['photo_id' => $photo->id]);
        }

        $user->personalParticular()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created his/her Personal Particular.');

        return redirect(route('member.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function beforeEdit()
    {
        return view('facultymember.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $particular = PersonalParticular::where('user_id', $id)->first();

        return view('facultymember.create')->with('particular', $particular);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacultyMemberRequest $request, $id)
    {

        $user = PersonalParticular::where('user_id', $id)->first();

        $this->validate($request, [
            'email' => 'required|unique:users,email,' . $user->user_id,
            'mobilephone' => 'required|numeric|unique:personal_particulars,mobilephone,' . $user->id,
        ]);

        $data = $request->all();
        
        if($request->hasFile('image')){

            unlink(public_path() . '/images/' . auth()->user()->photo->file);

            $name = time() . $request->file('image')->getClientOriginalName();

            $request->file('image')->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            auth()->user()->update(['photo_id' => $photo->id]);
        }

        $data['fullname'] = $request->get('lastname') . ', ' . $request->get('firstname');

        $data['age'] = Carbon::parse($request->get('birth'))->diff(Carbon::now())->format('%y');

        PersonalParticular::where('user_id', $id)->first()->update($data);

        PersonalParticular::where('user_id', $id)->first()->user()->update(['name' => $data['fullname'] , 'email' => $data['email']]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated his/her Personal Particular.');

        session()->flash('success', 'User updated Successfully.');

        return redirect(route('member.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
