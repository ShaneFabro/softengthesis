<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\PresentAcademic;
use App\PersonalParticular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateFacultyMemberRequest;
use App\Http\Requests\UpdateFacultyMemberRequest;


class DeanController extends Controller
{
    public function changePassword() {

        return view('dean.changepassword');

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

        return redirect(route('dean.index'));
           
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;

        return view('dean.index')->with('user', PersonalParticular::where('user_id', $userId)->first());
    }

    public function allFaculty() {

        $search = request()->query('search');

        if(!$search){

            $members = User::where('role_id', '!=', 1)->where('is_active', 1)->orderBy('role_id', 'asc')->get();

            return view('dean.allfaculty')->with('members', $members);

        } else {

            $members = User::where('role_id', '!=', 1)->where('is_active', 1)->where('name', 'LIKE', "%{$search}%")->orderBy('role_id', 'asc')->get();

            return view('dean.allfaculty')->with('members', $members);

        }

    }

    public function searched() {



    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dean.edit');
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

        return redirect(route('dean.index'));
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
        return view('dean.viewprofile')->with('user', $user);
    }

    public function beforeEdit() {

        return view('dean.create');

    }

    public function departments() {

        $englishStudies = User::where('rank_id', 1)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $literatures = User::where('rank_id', 2)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $philosophy = User::where('rank_id', 3)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $economics = User::where('rank_id', 4)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $foreignLanguage = User::where('rank_id', 5)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $politicalScience = User::where('rank_id', 6)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $sociology = User::where('rank_id', 7)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $history = User::where('rank_id', 8)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $commAndMediaStudies = User::where('rank_id', 9)->where('role_id', '!=', 1)->where('is_active', 1)->count();
        $interdisciplinary = User::where('rank_id', 10)->where('role_id', '!=', 1)->where('is_active', 1)->count();

        return view('dean.show')
            ->with('englishStudies', $englishStudies)
            ->with('literatures', $literatures)
            ->with('philosophy', $philosophy)
            ->with('economics', $economics)
            ->with('foreignLanguage', $foreignLanguage)
            ->with('politicalScience', $politicalScience)
            ->with('sociology', $sociology)
            ->with('history', $history)
            ->with('commAndMediaStudies', $commAndMediaStudies)
            ->with('interdisciplinary', $interdisciplinary)
            ->with('maleCount', User::where('is_active', 1)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
            ->with('femaleCount', User::where('is_active', 1)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
            ->with('notTenured', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
            ->with('tenured', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
            ->with('one', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
            ->with('two', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
            ->with('three', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
            ->with('four', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
            ->with('five', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
            ->with('six', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
            ->with('seven', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
            ->with('eight', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
            ->with('nine', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
            ->with('ten', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
            ->with('eleven', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
            ->with('twelve', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
            ->with('thirteen', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
            ->with('fourteen', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
            ->with('fifthteen', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
            ->with('sixteen', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
            ->with('seventeen', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
            ->with('eighteen',User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
            ->with('nineteen', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
            ->with('twenthy', User::where('is_active', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function englishStudies() {

        $head = User::where('rank_id', 1)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 1)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.englishstudies')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 1)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 1)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 1)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function literatures() {

        $head = User::where('rank_id', 2)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 2)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.literatures')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 2)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 2)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 2)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function philosophy() {

        $head = User::where('rank_id', 3)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 3)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.philosophy')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 3)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 3)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 3)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function economics() {

        $head = User::where('rank_id', 4)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 4)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.economics')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 4)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 4)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 4)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function foreignLanguage() {

        $head = User::where('rank_id', 5)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 5)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.foreignlanguage')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 5)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 5)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 5)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function politicalScience() {

        $head = User::where('rank_id', 6)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 6)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.politicalscience')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 6)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 6)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 6)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function sociology() {

        $head = User::where('rank_id', 7)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 7)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.sociology')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 7)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 7)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 7)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function history() {

        $head = User::where('rank_id', 8)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 8)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.history')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 8)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 8)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 8)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function commAndMediStudies() {

        $head = User::where('rank_id', 9)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 9)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.commandmediastudies')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 9)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 9)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 9)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

    }

    public function interdisciplinary() {

        $head = User::where('rank_id', 10)->where('role_id', 3)->where('is_active', 1)->get();
        $members = User::where('rank_id', 10)->where('role_id', 4)->where('is_active', 1)->get();
        return view('dean.interdisciplinary')->with('head', $head)->with('members', $members)
        ->with('maleCount', User::where('is_active', 1)->where('rank_id', 10)->whereHas('personalParticular', function($query){$query->where('sex', 0);})->count())
        ->with('femaleCount', User::where('is_active', 1)->where('rank_id', 10)->whereHas('personalParticular', function($query){$query->where('sex', 1);})->count())
        ->with('notTenured', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'not like', 'tenured%')->where('validate', 1);})->count())
        ->with('tenured', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->count())
        ->with('one', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 1)->where('validate', 1);})->count())
        ->with('two', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 2)->where('validate', 1);})->count())
        ->with('three', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 3)->where('validate', 1);})->count())
        ->with('four', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 4)->where('validate', 1);})->count())
        ->with('five', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 5)->where('validate', 1);})->count())
        ->with('six', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 6)->where('validate', 1);})->count())
        ->with('seven', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 7)->where('validate', 1);})->count())
        ->with('eight', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 8)->where('validate', 1);})->count())
        ->with('nine', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 9)->where('validate', 1);})->count())
        ->with('ten', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 10)->where('validate', 1);})->count())
        ->with('eleven', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 11)->where('validate', 1);})->count())
        ->with('twelve', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 12)->where('validate', 1);})->count())
        ->with('thirteen', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 13)->where('validate', 1);})->count())
        ->with('fourteen', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 14)->where('validate', 1);})->count())
        ->with('fifthteen', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 15)->where('validate', 1);})->count())
        ->with('sixteen', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 16)->where('validate', 1);})->count())
        ->with('seventeen', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 17)->where('validate', 1);})->count())
        ->with('eighteen',User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 18)->where('validate', 1);})->count())
        ->with('nineteen', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 19)->where('validate', 1);})->count())
        ->with('twenthy', User::where('is_active', 1)->where('rank_id', 10)->whereHas('academicPresentStatus', function($query){$query->where('academic_rank', 20)->where('validate', 1);})->count());

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

        return view('dean.create')->with('particular', $particular);
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

        return redirect(route('dean.index'));
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
