<?php

namespace App\Http\Controllers;

use App\User;
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

class FacultyHeadController extends Controller
{
    public function changePassword() {

        return view('facultyhead.changepassword');

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

        return redirect(route('head.index'));
           
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = auth()->user();

        // $members = User::where('rank_id', $user->rank->id)->where('role_id', 4)->get();

        // return view('facultyhead.index')->with('user', $user)->with('members', $members);
        $userId = Auth::user()->id;

        $file = File::get(storage_path('logs/custom.log'));

        return view('facultyhead.index')->with('user', PersonalParticular::where('user_id', $userId)->first())->with('file', $file);
    }

     /**
     * Display a listing of the Rosters depending to the department.
     *
     * @return \Illuminate\Http\Response
     */
    public function departmentRoster()
    {
        $user = auth()->user();

        $members = User::where('rank_id', $user->rank->id)->where('role_id', 4)->where('is_active', 1)->get();

        return view('facultyhead.departmentrosters')->with('user', $user)->with('members', $members);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facultyhead.edit');
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
            Storage::delete($user->image);
            $image = $request->image->store('particulars');
            $data['image'] = $image;
        }

        $user->personalParticular()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created his/her Personal Particular.');

        return redirect(route('head.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('facultyhead.show')->with('user', $user);
        
    }

    public function beforeEdit()
    {
        return view('facultyhead.create');
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

        return view('facultyhead.create')->with('particular', $particular);
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

        $data['fullname'] = $request->get('lastname') . ', ' . $request->get('firstname');

        $data['age'] = Carbon::parse($request->get('birth'))->diff(Carbon::now())->format('%y');
        
        if($request->hasFile('image')){
            $image = $request->image->store('particulars');
            Storage::delete($user->image);
            $data['image'] = $image;
        } 

        PersonalParticular::where('user_id', $id)->first()->update($data);

        PersonalParticular::where('user_id', $id)->first()->user()->update(['name' => $data['fullname'] , 'email' => $data['email']]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated his/her Personal Particular.');

        session()->flash('success', 'User updated Successfully.');

        return redirect(route('head.index'));
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
