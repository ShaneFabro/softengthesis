<?php

namespace App\Http\Controllers;

use App\User;
use App\PresentAcademic;
use App\PersonalParticular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SystemAdminController extends Controller
{

    public function activeDeactivate($id) {

        $user = Auth::user();

        $member = User::findOrFail($id);

        if($member->is_active == 1){

            $member->update(['is_active' => 0]);

            session()->flash('success', 'Successfully deactivated the account.');

            Log::channel('customlog')->info('User ' . $user->name . ' deactivated ' . $member->name . ' account.');

            return redirect()->back();

        } else {

            $member->update(['is_active' => 1]);

            session()->flash('success', 'Successfully activated the account.');

            Log::channel('customlog')->info('User ' . $user->name . ' activated ' . $member->name . ' account.');

            return redirect()->back();

        }

    }

    public function allFaculty() {

        $search = request()->query('search');

        if(!$search){

            $members = User::where('role_id', '!=', 1)->orderBy('rank_id', 'asc')->get();

            return view('systemadmin.allfaculty')->with('members', $members);

        } else {

            $members = User::where('role_id', '!=', 1)->where('name', 'LIKE', "%{$search}%")->orderBy('rank_id', 'asc')->get();

            return view('systemadmin.allfaculty')->with('members', $members);

        }

    }

    public function viewLogs() {

        $file = File::get(storage_path('logs/custom.log'));

        return view('systemadmin.logs')->with('file', $file);

    }

    public function changePassword() {

        return view('systemadmin.changepassword');

    }

    public function changePasswordConfirm(Request $request) {

        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|different:oldpassword',
        ]);

        if(Hash::check($request->oldpassword, auth()->user()->password)){

            auth()->user()->update(['password' => Hash::make($request->newpassword)]);

            session()->flash('success', 'Password changed');

        } else {

            session()->flash('error', 'Password does not match to your current password.');

            return redirect()->back();

        }

        return redirect(route('admin.index'));
           
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $owner = User::whereHas('academicPresentStatus', function($query){$query->where('employment_status', 'like', 'tenured%')->where('validate', 1);})->get();

        // foreach($owner as $owners){

        //     dd($owners->name);

        // }

        $user = User::all();
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

        return view('systemadmin.index')
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('systemadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'username' => 'required|unique:users',
            'name' => 'required',
            'role_id' => 'required',
            'password' => 'required|min:8'
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'role_id' => $request->role_id,
            'rank_id' => $request->rank_id,
            'password' => Hash::make($request->password)
        ]);
        
        session()->flash('success', 'User created successfully.');

        Log::channel('customlog')->info('User ' . $user->name . ' created a account. Username: ' . $request->username . ', Name: ' . $request->name . ', Role: ' . $request->role_id . ', Department: ' . $request->rank_id . ', Password: ' . $request->password . '.');

        return redirect(route('admin.allfaculty'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('systemadmin.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $memberEdit = User::findOrFail($id);

        return view('systemadmin.create')->with('memberEdit', $memberEdit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        if(trim($request->password) == ''){

            $data = $request->except('password');

            User::findOrFail($id)->update($data);

            session()->flash('success', 'User updated successfully.');

        } else {

            $data = $request->all();

            $data['password'] = Hash::make($request->password);

            User::findOrFail($id)->update($data);

            session()->flash('success', 'User updated successfully.');

        }

        Log::channel('customlog')->info('User ' . $user->name . ' updated a account. Username: ' . $request->username . ', Name: ' . $request->name . ', Role: ' . $request->role_id . ', Department: ' . $request->rank_id . '.');

        return redirect(route('admin.allfaculty'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        $auth = Auth::user();

        if($user->trashed()){

            Storage::delete($user->image);
            $user->forceDelete();

            session()->flash('success', 'User had been permanently deleted.');

            Log::channel('customlog')->info('User ' . $auth->name . ' Permanently Deleted ' . $user->name . ' Account.' );

            return redirect()->back();


        } else {

            $user->delete();

            session()->flash('success', 'User had been archived.');

            Log::channel('customlog')->info('User ' . $auth->name . ' Archived ' . $user->name . ' Account.' );

            return redirect()->back();

        }

    }

    public function trashed() {

        $members = User::onlyTrashed()->get();

        return view('systemadmin.trashed')->with('members', $members);

    }

    public function restore($id) {

        $auth = Auth::user();

        $user = User::onlyTrashed()->where('id', $id)->first();

        $user->restore();

        session()->flash('success', 'User restored successfully.');

        Log::channel('customlog')->info('User ' . $auth->name . ' Restored ' . $user->name . ' Account.' );

        return redirect(route('admin.allfaculty'));

    }

    public function dashboard() {

        return view('systemadmin.dashboard');

    }
}
