<?php

namespace App\Http\Controllers;

use App\User;
use App\AcademicDegree;
use App\PresentAcademic;
use App\UseOfTechnology;
use App\PersonalParticular;
use App\HonorsReceivedAward;
use Illuminate\Http\Request;
use App\HonorsReceivedGovernment;
use App\HonorsReceivedScholarship;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\CommExtServiceExtServiceSeminar;
use App\EmploymentHistoryExchangeProgram;
use App\NondegreetrainingSeminarsWorkshop;
use App\EmploymentHistoryAdminisExperience;
use App\CommExtServiceExtServiceConsultWork;
use App\EmploymentHistoryTeachingExperience;
use App\NondegreetrainingCulturalEducTravel;
use App\EmploymentHistoryProfPracOutTeaching;
use App\CommExtServiceExtServiceManWorkSenior;
use App\CommExtServiceExtServiceManWorkPrivate;
use App\ResearchCreativeWorksEdAidTechTeachAid;
use App\CommExtServiceCommServiceDevExtInitiate;
use App\CommExtServiceExtServiceGuestAppearance;
use App\CommExtServiceCommServiceAdvoExtInitiate;
use App\CommExtServiceCommServiceDevUnivInitiate;
use App\Http\Requests\CreateFacultyMemberRequest;
use App\Http\Requests\UpdateFacultyMemberRequest;
use App\CommExtServiceCommServiceAdvoUnivInitiate;
use App\CommExtServiceCommServiceHumanExtInitiate;
use App\CommExtServiceExtServiceManWorkGovernment;
use App\Http\Requests\CreateAcademicDegreeRequest;
use App\Http\Requests\CreatePresentAcademicStatus;
use App\ResearchCreativeWorksCreativeWorksLitWork;
use App\CommExtServiceCommServiceHumanUnivInitiate;
use App\ResearchCreativeWorksScholarProducFullBook;
use App\ResearchCreativeWorksScholarProducPubRefer;
use App\ResearchCreativeWorksCreativeWorksExArtWork;
use App\ResearchCreativeWorksEdAidTechMatProdManual;
use App\CommExtServiceExtServiceProfStandOffNational;
use App\ResearchCreativeWorksCreativeWorksOrigDesign;
use App\ResearchCreativeWorksCreativeWorksDistPerfArt;
use App\ResearchCreativeWorksScholarProducDelPubPaper;
use App\ResearchCreativeWorksScholarProducProfJournal;
use App\ResearchCreativeWorksScholarProducPubNonRefer;
use App\ResearchCreativeWorksScholarProducLocalJournal;
use App\CommExtServiceExtServiceProfStandOffAcadNational;
use App\ResearchCreativeWorksCreativeWorksGenCirculation;
use App\ResearchCreativeWorksScholarProducResearchPoster;
use App\CommExtServiceExtServiceProfStandOffInternational;
use App\ResearchCreativeWorksCreativeWorksOrigMusicalWork;
use App\ResearchCreativeWorksEdAidTechMatProdCourseModule;
use App\ResearchCreativeWorksEdAidTechMatProdOnlineCourse;
use App\ResearchCreativeWorksScholarProducCommCompResearch;
use App\CommExtServiceExtServiceProfStandOffAcadInterational;
use App\ResearchCreativeWorksScholarProducPreNonScribePubBook;
use App\Http\Requests\EmploymentHistoryTeachingExperienceRequest;

class CurriculumVitaeController extends Controller
{
    public function addAcademicDegrees() {

        return view('curriculumvitae.academicdegrees');

    }

    public function beforeEditAcademicDegrees() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.academicdegrees');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.academicdegrees');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.academicdegrees');
        }

    }

    public function editAcademicDegrees($id) {

        $academic = AcademicDegree::find($id);

        return view('curriculumvitae.academicdegrees')->with('academic', $academic);

    }

    public function storeAcademicDegrees(CreateAcademicDegreeRequest $request) {

        $user = Auth::user();

        $data = $request->all();

        $user->academicDegrees()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' create a Degree: ' . $request->degree . ', School: ' . $request->school .'.');

        session()->flash('success', 'Successfully added a Academic Degree');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }
        
    }

    public function updateAcademicDegrees(CreateAcademicDegreeRequest $request, $id) {

        $this->authorize('update', AcademicDegree::find($id));

        $user = Auth::user();

        $academic = AcademicDegree::find($id);
        
        $data = $request->all();

        $academic->update($data);

        $academic->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' update a Degree: ' . $request->degree . ', School: ' . $request->school .'.');

        session()->flash('success', 'Successfully updated a Academic Degree');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteAcademicDegrees($id) {
        
        $this->authorize('delete', AcademicDegree::find($id));
        
        $user = Auth::user();

        $request = AcademicDegree::find($id);

        AcademicDegree::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Degree: ' . $request->degree . ', School: ' . $request->school .'.');

        session()->flash('success', 'Successfully deleted a Academic Degree');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    

    //FOR  ACADEMIC PRESENT STATUS LOGIC CODE
    public function addPresentAcademicStatus() {

        return view('curriculumvitae.academicpresentstatus');

    }

    public function storePresentAcademicStatus(CreatePresentAcademicStatus $request) {

        $user = Auth::user();

        $data = $request->all();

        $user->academicPresentStatus()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Present Academic Status. Academic Rank: ' . $request->academic_rank . ', Employment Status: ' . $request->employment_status . ', Year Appointed in UST: ' . $request->year_appointed_in_ust . ', Number of years in UST: ' . $request->num_of_years_in_ust . ', Position in UST: ' . $request->pos_in_ust . '.');

        session()->flash('success', 'Successfully added a Present Academic Status');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function beforeEditPresentAcademicStatus() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.academicpresentstatus');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.academicpresentstatus');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.academicpresentstatus');
        }

    }

    public function editPresentAcademicStatus($id) {

        $presentStatus = PresentAcademic::find($id);

        return view('curriculumvitae.academicpresentstatus')->with('presentStatus', $presentStatus);

    }

    public function updatePresentAcademicStatus(CreatePresentAcademicStatus $request, $id) {

        $presentStatus = PresentAcademic::find($id);

        $user = Auth::user();

        $data = $request->all();

        $presentStatus->update($data);

        $presentStatus->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Present Academic Status. Academic Rank: ' . $request->academic_rank . ', Employment Status: ' . $request->employment_status . ', Year Appointed in UST: ' . $request->year_appointed_in_ust . ', Number of years in UST: ' . $request->num_of_years_in_ust . ', Position in UST: ' . $request->pos_in_ust . '.');


        session()->flash('success', 'Successfully updated a Present Academic Status');


        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deletePresentAcademicStatus($id) {

        $user = Auth::user();

        $request = PresentAcademic::find($id);

        PresentAcademic::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Present Academic Status. Academic Rank: ' . $request->academic_rank . ', Employment Status: ' . $request->employment_status . ', Year Appointed in UST: ' . $request->year_appointed_in_ust . ', Number of years in UST: ' . $request->num_of_years_in_ust . ', Position in UST: ' . $request->pos_in_ust . '.');

        session()->flash('success', 'Successfully deleted a Present Academic Status');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

   

    //FOR EMPLOYMENT HISTORY LOGIC CODE

    public function beforeEditEmploymentHistory() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.employmenthistory');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.employmenthistory');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.employmenthistory');
        }

    }


    public function addEmploymentHistoryTeachingExperience() {

        return view('curriculumvitae.employmenthistoryteachingexperience');

    }

    public function storeEmploymentHistoryTeachingExperience(Request $request) {

        $this->validate($request, [
            'institution' => 'required',
            'subject_taught' => 'required',
            'period_of_employment_from' => 'required',
            'period_of_employment_to' => 'required|after_or_equal:period_of_employment_from',
            'academic_rank' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->employmentHistoryTeachingExperiences()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Employment History Teaching Experience. Institution: ' . $request->institution . ', Subject Taught: ' . $request->subject_taught . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Academic Rank: ' . $request->academic_rank . '.');

        session()->flash('success', 'Successfully added a Employment History in Teaching Experience');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editEmploymentHistoryTeachingExperience($id) {

        $teachingExperience = EmploymentHistoryTeachingExperience::find($id);

        return view('curriculumvitae.employmenthistoryteachingexperience')->with('teachingExperience', $teachingExperience);

    }

    public function updateEmploymentHistoryTeachingExperience(Request $request, $id) {

        $this->validate($request, [
            'institution' => 'required',
            'subject_taught' => 'required',
            'period_of_employment_from' => 'required',
            'period_of_employment_to' => 'required|after_or_equal:period_of_employment_from',
            'academic_rank' => 'required',

        ]);

        $teachingExperience = EmploymentHistoryTeachingExperience::find($id);

        $user = Auth::user();

        $data = $request->all();

        $teachingExperience->update($data);

        $teachingExperience->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Employment History Teaching Experience. Institution: ' . $request->institution . ', Subject Taught: ' . $request->subject_taught . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Academic Rank: ' . $request->academic_rank . '.');

        session()->flash('success', 'Successfully updated a Employment History in Teaching Experience');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteEmploymentHistoryTeachingExperience($id) {

        $user = Auth::user();

        $request = EmploymentHistoryTeachingExperience::find($id);

        EmploymentHistoryTeachingExperience::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Employment History Teaching Experience. Institution: ' . $request->institution . ', Subject Taught: ' . $request->subject_taught . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Academic Rank: ' . $request->academic_rank . '.');

        session()->flash('success', 'Successfully deleted a Employment History in Teaching Experience');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addEmploymentHistoryAdminisExperience() {

        return view('curriculumvitae.employmenthistoryadminisexperience');

    }

    public function storeEmploymentHistoryAdminisExperience(Request $request) {

        $this->validate($request, [
            'institution' => 'required',
            'period_of_employment_from' => 'required',
            'period_of_employment_to' => 'required|after_or_equal:period_of_employment_from',
            'position_title' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();
        $data['period_of_employment_to'] = 

        $user->employmentHistoryAdminisExperiences()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Employment History Administrative Experience. Institution: ' . $request->institution . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully added a Employment History in Administrative Experience');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editEmploymentHistoryAdminisExperience($id) {

        $adminisExperience = EmploymentHistoryAdminisExperience::find($id);

        return view('curriculumvitae.employmenthistoryadminisexperience')->with('adminisExperience', $adminisExperience);

    }

    public function updateEmploymentHistoryAdminisExperience(Request $request, $id) {

        $this->validate($request, [
            'institution' => 'required',
            'period_of_employment_from' => 'required',
            'period_of_employment_to' => 'required|after_or_equal:period_of_employment_from',
            'position_title' => 'required',

        ]);

        $user = Auth::user();

        $adminisExperience = EmploymentHistoryAdminisExperience::find($id);

        $data = $request->all();

        $adminisExperience->update($data);

        $adminisExperience->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Employment History Administrative Experience. Institution: ' . $request->institution . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully updated a Employment History in Administrative Experience');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteEmploymentHistoryAdminisExperience($id) {

        $user = Auth::user();

        $request = EmploymentHistoryAdminisExperience::find($id);

        EmploymentHistoryAdminisExperience::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Employment History Administrative Experience. Institution: ' . $request->institution . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully deleted a Employment History in Administrative Experience');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addEmploymentHistoryProfPracOutTeaching() {

        return view('curriculumvitae.employmenthistoryprofpracoutteaching');

    }

    public function storeEmploymentHistoryProfPracOutTeaching(Request $request) {

        $this->validate($request, [
            'institution' => 'required',
            'period_of_employment_from' => 'required',
            'period_of_employment_to' => 'required|after_or_equal:period_of_employment_from',
            'position_title' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->employmentHistoryProfPracOutTeaching()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Employment History Professional Practice Outside Teaching. Institution: ' . $request->institution . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully added a Employment History in Professional Practice Outside Teaching');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editEmploymentHistoryProfPracOutTeaching($id) {

        $profPracOutTeaching = EmploymentHistoryProfPracOutTeaching::find($id);

        return view('facultymember\employmenthistoryprofpracoutteaching')->with('profPracOutTeaching', $profPracOutTeaching);

    }

    public function updateEmploymentHistoryProfPracOutTeaching(Request $request, $id) {

        $this->validate($request, [
            'institution' => 'required',
            'period_of_employment_from' => 'required',
            'period_of_employment_to' => 'required|after_or_equal:period_of_employment_from',
            'position_title' => 'required',

        ]);

        $user = Auth::user();

        $profPracOutTeaching = EmploymentHistoryProfPracOutTeaching::find($id);

        $data = $request->all();

        $profPracOutTeaching->update($data);

        $profPracOutTeaching->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Employment History Professional Practice Outside Teaching. Institution: ' . $request->institution . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully updated a Employment History in Professional Practice Outside Teaching');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }
    }

    public function deleteEmploymentHistoryProfPracOutTeaching($id) {

        $user = Auth::user();

        $request = EmploymentHistoryProfPracOutTeaching::find($id);

        EmploymentHistoryProfPracOutTeaching::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Employment History Professional Practice Outside Teaching. Institution: ' . $request->institution . ', Period of Employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully deleted a Employment History in Professional Practice Outside Teaching');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addEmploymentHistoryExchangeProgram() {

        return view('curriculumvitae.employmenthistoryexhangeprogram');

    }

    public function storeEmploymentHistoryExchangeProgram(Request $request) {

        $this->validate($request, [
            'institution' => 'required',
            'inclusive_from' => 'required',
            'inclusive_to' => 'required|after_or_equal:inclusive_from',
            'position_title' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();
      
        $user->employmentHistoryExchangeProgram()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Employment History Exchange Programs. Institution: ' . $request->institution . ', Inclusive from: ' . $request->inclusive_from . ' - ' . $request->inclusive_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully added a Employment History in Exchange Program');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editEmploymentHistoryExchangeProgram($id) {

        $exchangeProgram = EmploymentHistoryExchangeProgram::find($id);

        return view('curriculumvitae.employmenthistoryexhangeprogram')->with('exchangeProgram', $exchangeProgram);
        
    }

    public function updateEmploymentHistoryExchangeProgram(Request $request, $id) {

        $this->validate($request, [
            'institution' => 'required',
            'inclusive_from' => 'required',
            'inclusive_to' => 'required|after_or_equal:inclusive_from',
            'position_title' => 'required',

        ]);

        $user = Auth::user();

        $exchangeProgram = EmploymentHistoryExchangeProgram::find($id);

        $data = $request->all();
       
        $exchangeProgram->update($data);

        $exchangeProgram->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Employment History Exchange Programs. Institution: ' . $request->institution . ', Inclusive from: ' . $request->inclusive_from . ' - ' . $request->inclusive_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully updated a Employment History in Exchange Program');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteEmploymentHistoryExchangeProgram($id) {

        $user = Auth::user();

        $request = EmploymentHistoryExchangeProgram::find($id);

        EmploymentHistoryExchangeProgram::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Employment History Exchange Programs. Institution: ' . $request->institution . ', Inclusive from: ' . $request->inclusive_from . ' - ' . $request->inclusive_to . ', Position/Title: ' . $request->position_title . '.');

        session()->flash('success', 'Successfully deleted a Employment History in Exchange Program');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    //FOR NON DEGREE TRAINING

    public function beforeEditNonDegreeTraining() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.nondegreetraining');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.nondegreetraining');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.nondegreetraining');
        }

    }

    public function addNonDegreeSeminarWorkshops() {

        return view('curriculumvitae.nondegreeseminarworkshops');

    }

    public function storeNonDegreeSeminarWorkshops(Request $request){

        $this->validate($request, [
            'role' => 'required',
            'seminar_workshop' => 'required',
            'venue' => 'required',
            'inclusive_date' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->nondegreetrainingSeminarsWorkshops()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Non-degree Seminars and Workshops. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop  . ', Venue: ' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        session()->flash('success', 'Successfully added a Non-Degree Seminars and Workshops');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editNonDegreeSeminarWorkshops($id) {

        $seminarWorkshops = NondegreetrainingSeminarsWorkshop::find($id);

        return view('curriculumvitae.nondegreeseminarworkshops')->with('seminarWorkshops', $seminarWorkshops);

    }

    public function updateNonDegreeSeminarWorkshops(Request $request, $id) {

        $this->validate($request, [
            'role' => 'required',
            'seminar_workshop' => 'required',
            'venue' => 'required',
            'inclusive_date' => 'required',

        ]);

        $user = Auth::user();

        $seminarWorkshops = NondegreetrainingSeminarsWorkshop::find($id);

        $data = $request->all();

        $seminarWorkshops->update($data);

        $seminarWorkshops->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Non-degree Seminars and Workshops. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop  . ', Venue: ' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        session()->flash('success', 'Successfully updated a Non-Degree Seminars and Workshops');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteNonDegreeSeminarWorkshops($id) {

        $user = Auth::user();

        $request = NondegreetrainingSeminarsWorkshop::find($id);

        NondegreetrainingSeminarsWorkshop::find($id)->delete();

        session()->flash('success', 'Successfully deleted a Non-Degree Seminars and Workshops');

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Non-degree Seminars and Workshops. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop  . ', Venue: ' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addNonDegreeCulturalEducationTravel() {

        return view('curriculumvitae.nondegreeculturaleducationaltravel');

    }

    public function storeNonDegreeCulturalEducationTravel(Request $request) {

        $this->validate($request, [
            'role' => 'required',
            'seminar_workshop' => 'required',
            'venue' => 'required',
            'inclusive_date' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->nondegreetrainingCulturalEducationalTravel()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Non-degree Cultural / Educational Travel. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop  . ', Venue: ' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        session()->flash('success', 'Successfully added a Cultural / Educational Travel');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editNonDegreeCulturalEducationTravel($id) {

        $culturalEducationalTravel = NondegreetrainingCulturalEducTravel::find($id);

        return view('curriculumvitae.nondegreeculturaleducationaltravel')->with('culturalEducationalTravel', $culturalEducationalTravel);

    }

    public function updateNonDegreeCulturalEducationTravel(Request $request, $id) {

        $this->validate($request, [
            'role' => 'required',
            'seminar_workshop' => 'required',
            'venue' => 'required',
            'inclusive_date' => 'required',

        ]);

        $user = Auth::user();

        $culturalEducationalTravel = NondegreetrainingCulturalEducTravel::find($id);

        $data = $request->all();

        $culturalEducationalTravel->update($data);

        $culturalEducationalTravel->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Non-degree Cultural / Educational Travel. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop  . ', Venue: ' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        session()->flash('success', 'Successfully updated a Cultural / Educational Travel');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteNonDegreeCulturalEducationTravel($id) {

        $user = Auth::user();

        $request = NondegreetrainingCulturalEducTravel::find($id);

        NondegreetrainingCulturalEducTravel::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Non-degree Cultural / Educational Travel. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop  . ', Venue: ' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        session()->flash('success', 'Successfully deleted a Cultural / Educational Travel');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    //For Research and Creative Works
    public function beforeEditResearchCreativeWork() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.researchandcreativeworks');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.researchandcreativeworks');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.researchandcreativeworks');
        }

    }

    public function addResearchScholarPubRefer() {

        return view('curriculumvitae.researchscholarpubrefer');

    }

    public function storeResearchScholarPubRefer(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarPubRefers()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Referred Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Refereed Published articles/researches in reputable journals');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarPubRefer($id) {

        $scholarPubRefer = ResearchCreativeWorksScholarProducPubRefer::find($id);

        return view('curriculumvitae.researchscholarpubrefer')->with('scholarPubRefer', $scholarPubRefer);

    }

    public function updateResearchScholarPubRefer(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $scholarPubRefer = ResearchCreativeWorksScholarProducPubRefer::find($id);

        $data = $request->all();

        $scholarPubRefer->update($data);

        $scholarPubRefer->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Referred Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Refereed Published articles/researches in reputable journals');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }
    }

    public function deleteResearchScholarPubRefer($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducPubRefer::find($id);

        ResearchCreativeWorksScholarProducPubRefer::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Referred Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Refereed Published articles/researches in reputable journals');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchScholarPubNonRefer() {

        return view('curriculumvitae.researchscholarpubnonrefer');

    }

    public function storeResearchScholarPubNonRefer(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarPubNonRefers()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Non-Referred Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Non-Refereed Published articles/researches in reputable journals');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarPubNonRefer($id) {

        $scholarPubNonRefer = ResearchCreativeWorksScholarProducPubNonRefer::find($id);

        return view('curriculumvitae.researchscholarpubnonrefer')->with('scholarPubNonRefer', $scholarPubNonRefer);

    }

    public function updateResearchScholarPubNonRefer(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $scholarPubNonRefer = ResearchCreativeWorksScholarProducPubNonRefer::find($id);

        $data = $request->all();

        $scholarPubNonRefer->update($data);

        $scholarPubNonRefer->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Non-Referred Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Non-Refereed Published articles/researches in reputable journals');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchScholarPubNonRefer($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducPubNonRefer::find($id);

        ResearchCreativeWorksScholarProducPubNonRefer::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Non-Referred Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Non-Refereed Published articles/researches in reputable journals');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }
    }

    public function addResearchScholarFullBook() {

        return view('curriculumvitae.researchscholarfullbook');

    }

    public function storeResearchScholarFullBook(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarFullBooks()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarly Productions Full-lenghts Books. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Full-lengths Books');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarFullBook($id) {

        $fullBook = ResearchCreativeWorksScholarProducFullBook::find($id);

        return view('curriculumvitae.researchscholarfullbook')->with('fullBook', $fullBook);

    }

    public function updateResearchScholarFullBook(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $fullBook = ResearchCreativeWorksScholarProducFullBook::find($id);

        $data = $request->all();

        $fullBook->update($data);

        $fullBook->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarly Productions Full-lenghts Books. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Full-lengths Books');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchScholarFullBook($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducFullBook::find($id);

        ResearchCreativeWorksScholarProducFullBook::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarly Productions Full-lenghts Books. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Full-lengths Books');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }
    }

    public function addResearchScholarPreNonScribedPubBook() {

        return view('curriculumvitae.researchscholarprenonscribedpubbook');

    }

    public function storeResearchScholarPreNonScribedPubBook(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarPreNonScribePubBooks()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarly Productions Prescribed/Non-Prescribed published textbooks. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Prescribed/Non-Prescribed published textbooks');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarPreNonScribedPubBook($id) {

        $preNonScribedPubBook = ResearchCreativeWorksScholarProducPreNonScribePubBook::find($id);

        return view('curriculumvitae.researchscholarprenonscribedpubbook')->with('preNonScribedPubBook', $preNonScribedPubBook);

    }

    public function updateResearchScholarPreNonScribedPubBook(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $preNonScribedPubBook = ResearchCreativeWorksScholarProducPreNonScribePubBook::find($id);

        $data = $request->all();

        $preNonScribedPubBook->update($data);

        $preNonScribedPubBook->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarly Productions Prescribed/Non-Prescribed published textbooks. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Prescribed/Non-Prescribed published textbooks');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchScholarPreNonScribedPubBook($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducPreNonScribePubBook::find($id);

        ResearchCreativeWorksScholarProducPreNonScribePubBook::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarly Productions Prescribed/Non-Prescribed published textbooks. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Prescribed/Non-Prescribed published textbooks');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchScholarProfJournal() {

        return view('curriculumvitae.researchscholarprofjournal');

    }

    public function storeResearchScholarProfJournal(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarProfJournals()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarly Productions Professional Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Professional Journal');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarProfJournal($id) {

        $profJournal = ResearchCreativeWorksScholarProducProfJournal::find($id);

        return view('curriculumvitae.researchscholarprofjournal')->with('profJournal', $profJournal);

    }

    public function updateResearchScholarProfJournal(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $profJournal = ResearchCreativeWorksScholarProducProfJournal::find($id);

        $data = $request->all();

        $profJournal->update($data);

        $profJournal->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarly Productions Professional Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Professional Journal');
        
        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }
    }

    public function deleteResearchScholarProfJournal($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducProfJournal::find($id);

        ResearchCreativeWorksScholarProducProfJournal::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarly Productions Professional Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Professional Journal');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchScholarLocJournal() {

        return view('curriculumvitae.researchscholarlocjournal');

    }

    public function storeResearchScholarLocJournal(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarLocJournals()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarly Productions Local Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Local Journal');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarLocJournal($id) {

        $locJournal = ResearchCreativeWorksScholarProducLocalJournal::find($id);

        return view('curriculumvitae.researchscholarlocjournal')->with('locJournal', $locJournal);
    }

    public function updateResearchScholarLocJournal(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $locJournal = ResearchCreativeWorksScholarProducLocalJournal::find($id);

        $data = $request->all();

        $locJournal->update($data);

        $locJournal->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarly Productions Local Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Local Journal');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchScholarLocJournal($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducLocalJournal::find($id);

        ResearchCreativeWorksScholarProducLocalJournal::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarly Productions Local Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Local Journal');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchScholarDelPubPaper() {

        return view('curriculumvitae.researchscholardelpubpaper');

    }

    public function storeResearchScholarDelPubPaper(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarDelPubPaper()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarly Productions Delivered & Published Papers/lectures/Speeches. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Delivered & Published Papers/lectures/Speeches');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarDelPubPaper($id) {

        $delPubPaper = ResearchCreativeWorksScholarProducDelPubPaper::find($id);

        return view('curriculumvitae.researchscholardelpubpaper')->with('delPubPaper', $delPubPaper);

    }

    public function updateResearchScholarDelPubPaper(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $delPubPaper = ResearchCreativeWorksScholarProducDelPubPaper::find($id);

        $data = $request->all();

        $delPubPaper->update($data);

        $delPubPaper->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarly Productions Delivered & Published Papers/lectures/Speeches. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Delivered & Published Papers/lectures/Speeches');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchScholarDelPubPaper($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducDelPubPaper::find($id);

        ResearchCreativeWorksScholarProducDelPubPaper::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarly Productions Delivered & Published Papers/lectures/Speeches. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Delivered & Published Papers/lectures/Speeches');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchScholarCommCompResearch() {

        return view('curriculumvitae.researchscholarcommcompresearch');

    }

    public function storeResearchScholarCommCompResearch(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarCommCompResearches()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarly Productions Commissioned and Completed Researches. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Commissioned and Completed Researches');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarCommCompResearch($id) {

        $commCompResearch = ResearchCreativeWorksScholarProducCommCompResearch::find($id);

        return view('curriculumvitae.researchscholarcommcompresearch')->with('commCompResearch', $commCompResearch);

    }

    public function updateResearchScholarCommCompResearch(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $commCompResearch = ResearchCreativeWorksScholarProducCommCompResearch::find($id);

        $data = $request->all();

        $commCompResearch->update($data);

        $commCompResearch->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarly Productions Commissioned and Completed Researches. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Commissioned and Completed Researches');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchScholarCommCompResearch($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducCommCompResearch::find($id);

        ResearchCreativeWorksScholarProducCommCompResearch::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarly Productions Commissioned and Completed Researches. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Commissioned and Completed Researches');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchScholarResearchPoster() {

        return view('curriculumvitae.researchscholarresearchposter');

    }

    public function storeResearchScholarResearchPoster(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchScholarResearchPosters()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarly Productions Research Posters. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Research Posters');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchScholarResearchPoster($id) {

        $researchPoster = ResearchCreativeWorksScholarProducResearchPoster::find($id);

        return view('curriculumvitae.researchscholarresearchposter')->with('researchPoster', $researchPoster);

    }

    public function updateResearchScholarResearchPoster(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $researchPoster = ResearchCreativeWorksScholarProducResearchPoster::find($id);

        $data = $request->all();

        $researchPoster->update($data);

        $researchPoster->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarly Productions Research Posters. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Research Posters');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchScholarResearchPoster($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducResearchPoster::find($id);

        ResearchCreativeWorksScholarProducResearchPoster::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarly Productions Research Posters. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Research Posters');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeDistPerfArt() {

        return view('curriculumvitae.researchcreativedistperfart');

    }

    public function storeResearchCreativeDistPerfArt(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeDistPerfArts()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Creative Works Distinguished performance in any of the performing arts. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Distinguished performance in any of the performing arts');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeDistPerfArt($id) {

        $distPerfArt = ResearchCreativeWorksCreativeWorksDistPerfArt::find($id);

        return view('curriculumvitae.researchcreativedistperfart')->with('distPerfArt', $distPerfArt);

    }

    public function updateResearchCreativeDistPerfArt(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $distPerfArt = ResearchCreativeWorksCreativeWorksDistPerfArt::find($id);

        $data = $request->all();

        $distPerfArt->update($data);

        $distPerfArt->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Creative Works Distinguished performance in any of the performing arts. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Distinguished performance in any of the performing arts');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeDistPerfArt($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksDistPerfArt::find($id);

        ResearchCreativeWorksCreativeWorksDistPerfArt::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Creative Works Distinguished performance in any of the performing arts. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Distinguished performance in any of the performing arts');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeOrigMusicalWork() {

        return view('curriculumvitae.researchcreativeorigmusicalwork');

    }

    public function storeResearchCreativeOrigMusicalWork(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeOrigMusicalWorks()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Creative Works Original Musical Work. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Original Musical Work');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeOrigMusicalWork($id) {

        $origMusicalWork = ResearchCreativeWorksCreativeWorksOrigMusicalWork::find($id);

        return view('curriculumvitae.researchcreativeorigmusicalwork')->with('origMusicalWork', $origMusicalWork);

    }

    public function updateResearchCreativeOrigMusicalWork(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $origMusicalWork = ResearchCreativeWorksCreativeWorksOrigMusicalWork::find($id);

        $data = $request->all();

        $origMusicalWork->update($data);

        $origMusicalWork->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Creative Works Original Musical Work. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Original Musical Work');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeOrigMusicalWork($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksOrigMusicalWork::find($id);

        ResearchCreativeWorksCreativeWorksOrigMusicalWork::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Creative Works Original Musical Work. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Original Musical Work');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeOrigDesign() {

        return view('curriculumvitae.researchcreativeorigdesign');

    }

    public function storeResearchCreativeOrigDesign(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreateOrigDesigns()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Creative Works Original Design. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Original Design');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeOrigDesign($id) {

        $origDesign = ResearchCreativeWorksCreativeWorksOrigDesign::find($id);

        return view('curriculumvitae.researchcreativeorigmusicalwork')->with('origDesign', $origDesign);

    }

    public function updateResearchCreativeOrigDesign(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $origDesign = ResearchCreativeWorksCreativeWorksOrigDesign::find($id);

        $data = $request->all();

        $origDesign->update($data);

        $origDesign->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Creative Works Original Design. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Original Design');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeOrigDesign($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksOrigDesign::find($id);

        ResearchCreativeWorksCreativeWorksOrigDesign::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Creative Works Original Design. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Original Design');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeLitWork() {

        return view('curriculumvitae.researchcreativelitwork');

    }

    public function storeResearchCreativeLitWork(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeLitWorks()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Creative Works Published / Acknowledge Literary Works. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Published / Acknowledge Literary Works');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeLitWork($id) {

        $litWork = ResearchCreativeWorksCreativeWorksLitWork::find($id);

        return view('curriculumvitae.researchcreativelitwork')->with('litWork', $litWork);

    }

    public function updateResearchCreativeLitWork(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $litWork = ResearchCreativeWorksCreativeWorksLitWork::find($id);

        $data = $request->all();

        $litWork->update($data);

        $litWork->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Creative Works Published / Acknowledge Literary Works. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Published / Acknowledge Literary Works');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeLitWork($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksLitWork::find($id);

        ResearchCreativeWorksCreativeWorksLitWork::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Creative Works Published / Acknowledge Literary Works. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Published / Acknowledge Literary Works');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeExArtWork() {

        return view('curriculumvitae.researchcreativeexartwork');

    }

    public function storeResearchCreativeExArtWork(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeExArtWorks()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Creative Works Exhibited Art Works. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Exhibited Art Works');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeExArtWork($id) {

        $exArtWork = ResearchCreativeWorksCreativeWorksExArtWork::find($id);

        return view('curriculumvitae.researchcreativeexartwork')->with('exArtWork', $exArtWork);

    }

    public function updateResearchCreativeExArtWork(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $exArtWork = ResearchCreativeWorksCreativeWorksExArtWork::find($id);

        $data = $request->all();

        $exArtWork->update($data);

        $exArtWork->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Creative Works Exhibited Art Works. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Exhibited Art Works');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeExArtWork($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksExArtWork::find($id);

        ResearchCreativeWorksCreativeWorksExArtWork::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Creative Works Exhibited Art Works. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Exhibited Art Works');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeGenCirculation() {

        return view('curriculumvitae.researchcreativegencirculation');

    }

    public function storeResearchCreativeGenCirculation(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeGenCirculations()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Creative Works Critiques, Position papers published in newspapers of general Circulation. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Critiques, Position papers published in newspapers of general Circulation');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeGenCirculation($id) {

        $genCirculation = ResearchCreativeWorksCreativeWorksGenCirculation::find($id);

        return view('curriculumvitae.researchcreativegencirculation')->with('genCirculation', $genCirculation);

    }

    public function updateResearchCreativeGenCirculation(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);
        
        $user = Auth::user();

        $genCirculation = ResearchCreativeWorksCreativeWorksGenCirculation::find($id);

        $data = $request->all();

        $genCirculation->update($data);

        $genCirculation->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Creative Works Critiques, Position papers published in newspapers of general Circulation. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Critiques, Position papers published in newspapers of general Circulation');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeGenCirculation($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksGenCirculation::find($id);

        ResearchCreativeWorksCreativeWorksGenCirculation::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Creative Works Critiques, Position papers published in newspapers of general Circulation. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeAidTechMatProdCourseModule() {

        return view('curriculumvitae.researchcreativeaidtechmatprodcoursemodule');

    }

    public function storeResearchCreativeAidTechMatProdCourseModule(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeAidTechMatProdCourseModules()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Educational Aids and Technology Course Modules Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Material Production in Course Modules');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeAidTechMatProdCourseModule($id) {

        $aidTechCourseModule = ResearchCreativeWorksEdAidTechMatProdCourseModule::find($id);

        return view('curriculumvitae.researchcreativeaidtechmatprodcoursemodule')->with('aidTechCourseModule', $aidTechCourseModule);

    }

    public function updateResearchCreativeAidTechMatProdCourseModule(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $genCirculation = ResearchCreativeWorksEdAidTechMatProdCourseModule::find($id);

        $data = $request->all();

        $genCirculation->update($data);

        $genCirculation->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Educational Aids and Technology Course Modules Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Material Production in Course Modules');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeAidTechMatProdCourseModule($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechMatProdCourseModule::find($id);

        ResearchCreativeWorksEdAidTechMatProdCourseModule::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Educational Aids and Technology Course Modules Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Material Production in Course Modules');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeAidTechMatProdOnlineCourse() {

        return view('curriculumvitae.researchcreativeaidtechmatprodonlinecourse');

    }

    public function storeResearchCreativeAidTechMatProdOnlineCourse(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeAidTechMatProdOnlineCourses()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Educational Aids and Technology Online Courses Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Material Production in Online Courses');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeAidTechMatProdOnlineCourse($id) {

        $aidTechOnlineModule = ResearchCreativeWorksEdAidTechMatProdOnlineCourse::find($id);

        return view('curriculumvitae.researchcreativeaidtechmatprodonlinecourse')->with('aidTechOnlineModule', $aidTechOnlineModule);

    }

    public function updateResearchCreativeAidTechMatProdOnlineCourse(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $aidTechOnlineModule = ResearchCreativeWorksEdAidTechMatProdOnlineCourse::find($id);

        $data = $request->all();

        $aidTechOnlineModule->update($data);

        $aidTechOnlineModule->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Educational Aids and Technology Online Courses Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Material Production in Online Courses');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeAidTechMatProdOnlineCourse($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechMatProdOnlineCourse::find($id);

        ResearchCreativeWorksEdAidTechMatProdOnlineCourse::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Educational Aids and Technology Online Courses Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Material Production in Online Courses');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeAidTechMatProdManual() {

        return view('curriculumvitae.researchcreativeaidtechmatprodmanual');

    }

    public function storeResearchCreativeAidTechMatProdManual(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeAidTechMatProdManuals()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Educational Aids and Technology Laboratory manuals, Course manuals or Workbook in actual use by the department or college Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Material Production in Laboratory manuals, Course manuals or Workbook in actual use by the department or college');  

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeAidTechMatProdManual($id) {

        $aidTechManual= ResearchCreativeWorksEdAidTechMatProdManual::find($id);

        return view('curriculumvitae.researchcreativeaidtechmatprodmanual')->with('aidTechManual', $aidTechManual);

    }

    public function updateResearchCreativeAidTechMatProdManual(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $aidTechManual = ResearchCreativeWorksEdAidTechMatProdManual::find($id);

        $data = $request->all();

        $aidTechManual->update($data);

        $aidTechManual->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Educational Aids and Technology Laboratory manuals, Course manuals or Workbook in actual use by the department or college Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Material Production in Laboratory manuals, Course manuals or Workbook in actual use by the department or college');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeAidTechMatProdManual($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechMatProdManual::find($id);

        ResearchCreativeWorksEdAidTechMatProdManual::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Educational Aids and Technology Laboratory manuals, Course manuals or Workbook in actual use by the department or college Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Material Production in Laboratory manuals, Course manuals or Workbook in actual use by the department or college');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addResearchCreativeAidTechTechAid() {

        return view('curriculumvitae.researchcreativeaidtechtechaid');

    }

    public function storeResearchCreativeAidTechTechAid(Request $request) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->researchCreativeAidTechTechAids()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Educational Aids and Technology Teaching aids produced for use in the department and /or Faculty or College. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully added a Teaching aids produced for use in the department and /or Faculty or College');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editResearchCreativeAidTechTechAid($id) {

        $aidTechTechAid= ResearchCreativeWorksEdAidTechTeachAid::find($id);

        return view('curriculumvitae.researchcreativeaidtechtechaid')->with('aidTechTechAid', $aidTechTechAid);

    }

    public function updateResearchCreativeAidTechTechAid(Request $request, $id) {

        $this->validate($request, [
            'nature_of_publication' => 'required',
            'date_publication' => 'required',
            'role_comments' => 'required',

        ]);

        $user = Auth::user();

        $aidTechTechAid = ResearchCreativeWorksEdAidTechTeachAid::find($id);

        $data = $request->all();

        $aidTechTechAid->update($data);

        $aidTechTechAid->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Educational Aids and Technology Teaching aids produced for use in the department and /or Faculty or College. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully updated a Teaching aids produced for use in the department and /or Faculty or College');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteResearchCreativeAidTechTechAid($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechTeachAid::find($id);

        ResearchCreativeWorksEdAidTechTeachAid::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Educational Aids and Technology Teaching aids produced for use in the department and /or Faculty or College. Nature of Publication: ' . $request->nature_of_publication . ', Date Publication: ' . $request->date_publication  . ', Role/Comments: ' . $request->role_comments . '.');

        session()->flash('success', 'Successfully deleted a Teaching aids produced for use in the department and /or Faculty or College');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    //For Community Extension Service

    public function beforeEditCommExtService() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.communityextensionservice');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.communityextensionservice');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.communityextensionservice');
        }

    }

    public function addCommExtServiceCommServiceDevUniv() {

        return view('curriculumvitae.commextservicecommservicedevuniv');

    }

    public function storeCommExtServiceCommServiceDevUniv(Request $request) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtServiceCommServiceDevUnivInitiates()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Community Service University-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully added a Community Development in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceCommServiceDevUniv($id) {

        $devUnivInitiate= CommExtServiceCommServiceDevUnivInitiate::find($id);

        return view('curriculumvitae.commextservicecommservicedevuniv')->with('devUnivInitiate', $devUnivInitiate);

    }

    public function updateCommExtServiceCommServiceDevUniv(Request $request, $id) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $devUnivInitiate = CommExtServiceCommServiceDevUnivInitiate::find($id);

        $data = $request->all();

        $devUnivInitiate->update($data);

        $devUnivInitiate->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Community Service University-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully updated a Community Development in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceCommServiceDevUniv($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceDevUnivInitiate::find($id);

        CommExtServiceCommServiceDevUnivInitiate::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Community Service University-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully deleted a Community Development in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addExtServiceCommServiceDevExt() {

        return view('curriculumvitae.commextservicecommservicedevext');

    }

    public function storeExtServiceCommServiceDevExt(Request $request) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtServiceCommServiceDevExtInitiates()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Community Service Externally-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully added a Community Development in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editExtServiceCommServiceDevExt($id) {

        $devExtInitiate= CommExtServiceCommServiceDevExtInitiate::find($id);

        return view('curriculumvitae.commextservicecommservicedevext')->with('devExtInitiate', $devExtInitiate);

    }

    public function updateExtServiceCommServiceDevExt(Request $request, $id) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $devExtInitiate = CommExtServiceCommServiceDevExtInitiate::find($id);

        $data = $request->all();

        $devExtInitiate->update($data);

        $devExtInitiate->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Community Service Externally-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully updated a Community Development in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteExtServiceCommServiceDevExt($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceDevExtInitiate::find($id);

        CommExtServiceCommServiceDevExtInitiate::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Community Service Externally-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully deleted a Community Development in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceCommServiceHumanUniv() {

        return view('curriculumvitae.commextservicecommservicehumanuniv');

    }

    public function storeCommExtServiceCommServiceHumanUniv(Request $request) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtServiceCommServiceHumanUnivInitiates()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Community Service University-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully added a Humanitarian/Relief Mission in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceCommServiceHumanUniv($id) {

        $humanUnivInitiate= CommExtServiceCommServiceHumanUnivInitiate::find($id);

        return view('curriculumvitae.commextservicecommservicehumanuniv')->with('humanUnivInitiate', $humanUnivInitiate);

    }

    public function updateCommExtServiceCommServiceHumanUniv(Request $request, $id) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $humanUnivInitiate = CommExtServiceCommServiceHumanUnivInitiate::find($id);

        $data = $request->all();

        $humanUnivInitiate->update($data);

        $humanUnivInitiate->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Community Service University-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully updated a Humanitarian/Relief Mission in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceCommServiceHumanUniv($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceHumanUnivInitiate::find($id);

        CommExtServiceCommServiceHumanUnivInitiate::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Community Service University-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully deleted a Humanitarian/Relief Mission in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceCommServiceHumanExt() {

        return view('curriculumvitae.commextservicecommservicehumanext');

    }

    public function storeCommExtServiceCommServiceHumanExt(Request $request) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtServiceCommServiceHumanExtInitiates()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Community Service Externally-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully added a Humanitarian/Relief Mission in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceCommServiceHumanExt($id) {

        $humanExtInitiate= CommExtServiceCommServiceHumanExtInitiate::find($id);

        return view('curriculumvitae.commextservicecommservicehumanext')->with('humanExtInitiate', $humanExtInitiate);

    }

    public function updateCommExtServiceCommServiceHumanExt(Request $request, $id) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $humanExtInitiate = CommExtServiceCommServiceHumanExtInitiate::find($id);

        $data = $request->all();

        $humanExtInitiate->update($data);

        $humanExtInitiate->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Community Service Externally-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully updated a Humanitarian/Relief Mission in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceCommServiceHumanExt($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceHumanExtInitiate::find($id);

        CommExtServiceCommServiceHumanExtInitiate::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Community Service Externally-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully deleted a Humanitarian/Relief Mission in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceCommServiceAdvoUniv() {

        return view('curriculumvitae.commextservicecommserviceadvouniv');

    }

    public function storeCommExtServiceCommServiceAdvoUniv(Request $request) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtServiceCommServiceAdvoUnivInitiates()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Community Service University-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully added a Involvement in Advocacy Activities in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceCommServiceAdvoUniv($id) {

        $advoUnivInitiate= CommExtServiceCommServiceAdvoUnivInitiate::find($id);

        return view('curriculumvitae.commextservicecommserviceadvouniv')->with('advoUnivInitiate', $advoUnivInitiate);

    }

    public function updateCommExtServiceCommServiceAdvoUniv(Request $request, $id) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $advoUnivInitiate = CommExtServiceCommServiceAdvoUnivInitiate::find($id);

        $data = $request->all();

        $advoUnivInitiate->update($data);

        $advoUnivInitiate->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Community Service University-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully updated a Involvement in Advocacy Activities in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceCommServiceAdvoUniv($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceAdvoUnivInitiate::find($id);

        CommExtServiceCommServiceAdvoUnivInitiate::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Community Service University-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully deleted a Involvement in Advocacy Activities in University-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceCommServiceAdvoExt() {

        return view('curriculumvitae.commextservicecommserviceadvoext');

    }

    public function storeCommExtServiceCommServiceAdvoExt(Request $request) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtServiceCommServiceAdvoExtInitiates()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Community Service Externally-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully added a Involvement in Advocacy Activities in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceCommServiceAdvoExt($id) {

        $advoExtInitiate= CommExtServiceCommServiceAdvoExtInitiate::find($id);

        return view('curriculumvitae.commextservicecommserviceadvoext')->with('advoExtInitiate', $advoExtInitiate);

    }

    public function updateCommExtServiceCommServiceAdvoExt(Request $request, $id) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $advoExtInitiate = CommExtServiceCommServiceAdvoExtInitiate::find($id);

        $data = $request->all();

        $advoExtInitiate->update($data);

        $advoExtInitiate->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Community Service Externally-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully updated a Involvement in Advocacy Activities in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceCommServiceAdvoExt($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceAdvoExtInitiate::find($id);

        CommExtServiceCommServiceAdvoExtInitiate::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Community Service Externally-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully deleted a Involvement in Advocacy Activities in Externally-Initiated');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceSeminar() {

        return view('curriculumvitae.commextserviceextserviceseminar');

    }

    public function storeCommExtServiceSeminar(Request $request) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceSeminars()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Extension Service Seminars/Workshops/Conferences/Convention. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully added a Seminars/Workshops/Conferences/Convention');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceSeminar($id) {

        $extServiceSeminar = CommExtServiceExtServiceSeminar::find($id);

        return view('curriculumvitae.commextserviceextserviceseminar')->with('extServiceSeminar', $extServiceSeminar);

    }

    public function updateCommExtServiceSeminar(Request $request, $id) {

        $this->validate($request, [
            'inclusive_date_from' => 'required',
            'inclusive_date_to' => 'required|after_or_equal:inclusive_date_from',
            'title' => 'required',
            'role' => 'required'

        ]);

        $user = Auth::user();

        $extServiceSeminar = CommExtServiceExtServiceSeminar::find($id);

        $data = $request->all();

        $extServiceSeminar->update($data);

        $extServiceSeminar->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Extension Service Seminars/Workshops/Conferences/Convention. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully updated a Seminars/Workshops/Conferences/Convention');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceSeminar($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceSeminar::find($id);

        CommExtServiceExtServiceSeminar::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Extension Service Seminars/Workshops/Conferences/Convention. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to  . ', Title: ' . $request->title . ', Role: ' . $request->role . '.');

        session()->flash('success', 'Successfully deleted a Seminars/Workshops/Conferences/Convention');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceProfStandOffInternational() {

        return view('curriculumvitae.commextserviceextserviceprofstandoffinternational');

    }

    public function storeCommExtServiceProfStandOffInternational(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceProfStandOffInternationals()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a International Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Professional standing, Recognition and Achievements in International Officership / Membership in Professional Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceProfStandOffInternational($id) {

        $extServiceProfStandOffInternational = CommExtServiceExtServiceProfStandOffInternational::find($id);

        return view('curriculumvitae.commextserviceextserviceprofstandoffinternational')->with('extServiceProfStandOffInternational', $extServiceProfStandOffInternational);

    }

    public function updateCommExtServiceProfStandOffInternational(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceProfStandOffInternational = CommExtServiceExtServiceProfStandOffInternational::find($id);

        $data = $request->all();

        $extServiceProfStandOffInternational->update($data);

        $extServiceProfStandOffInternational->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a International Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Professional standing, Recognition and Achievements in International Officership / Membership in Professional Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceProfStandOffInternational($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceProfStandOffInternational::find($id);

        CommExtServiceExtServiceProfStandOffInternational::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a International Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Professional standing, Recognition and Achievements in International Officership / Membership in Professional Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceProfStandOffNational() {

        return view('curriculumvitae.commextserviceextserviceprofstandoffnational');

    }

    public function storeCommExtServiceProfStandOffNational(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceProfStandOffNationals()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a National Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Professional standing, Recognition and Achievements in National Officership / Membership in Professional Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceProfStandOffNational($id) {

        $extServiceProfStandOffNational = CommExtServiceExtServiceProfStandOffNational::find($id);

        return view('curriculumvitae.commextserviceextserviceprofstandoffnational')->with('extServiceProfStandOffNational', $extServiceProfStandOffNational);

    }

    public function updateCommExtServiceProfStandOffNational(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceProfStandOffNational = CommExtServiceExtServiceProfStandOffNational::find($id);

        $data = $request->all();

        $extServiceProfStandOffNational->update($data);

        $extServiceProfStandOffNational->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a National Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Professional standing, Recognition and Achievements in National Officership / Membership in Professional Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceProfStandOffNational($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceProfStandOffNational::find($id);

        CommExtServiceExtServiceProfStandOffNational::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a National Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Professional standing, Recognition and Achievements in National Officership / Membership in Professional Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceProfStandOffAcadInternational() {

        return view('curriculumvitae.commextserviceextserviceprofstandoffacadinternational');

    }

    public function storeCommExtServiceProfStandOffAcadInternational(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceProfStandOffAcadInternationals()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a International Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Professional standing, Recognition and Achievements in International Officership / Membership in Academic Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceProfStandOffAcadInternational($id) {

        $extServiceProfStandOffAcadInternational = CommExtServiceExtServiceProfStandOffAcadInterational::find($id);

        return view('curriculumvitae.commextserviceextserviceprofstandoffacadinternational')->with('extServiceProfStandOffAcadInternational', $extServiceProfStandOffAcadInternational);

    }

    public function updateCommExtServiceProfStandOffAcadInternational(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceProfStandOffAcadInternational = CommExtServiceExtServiceProfStandOffAcadInterational::find($id);

        $data = $request->all();

        $extServiceProfStandOffAcadInternational->update($data);

        $extServiceProfStandOffAcadInternational->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a International Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Professional standing, Recognition and Achievements in International Officership / Membership in Academic Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceProfStandOffAcadInternational($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceProfStandOffAcadInterational::find($id);

        CommExtServiceExtServiceProfStandOffAcadInterational::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a International Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Professional standing, Recognition and Achievements in International Officership / Membership in Academic Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceProfStandOffAcadNational() {

        return view('curriculumvitae.commextserviceextserviceprofstandoffacadnational');

    }

    public function storeCommExtServiceProfStandOffAcadNational(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceProfStandOffAcadNationals()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a National Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Professional standing, Recognition and Achievements in National Officership / Membership in Academic Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceProfStandOffAcadNational($id) {

        $extServiceProfStandOffAcadNational = CommExtServiceExtServiceProfStandOffAcadNational::find($id);

        return view('curriculumvitae.commextserviceextserviceprofstandoffacadnational')->with('extServiceProfStandOffAcadNational', $extServiceProfStandOffAcadNational);

    }

    public function updateCommExtServiceProfStandOffAcadNational(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceProfStandOffAcadNational = CommExtServiceExtServiceProfStandOffAcadNational::find($id);

        $data = $request->all();

        $extServiceProfStandOffAcadNational->update($data);

        $extServiceProfStandOffAcadNational->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a National Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Professional standing, Recognition and Achievements in National Officership / Membership in Academic Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceProfStandOffAcadNational($id) {

        $user = Auth::user();

        $request = ommExtServiceExtServiceProfStandOffAcadNational::find($id);

        CommExtServiceExtServiceProfStandOffAcadNational::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a National Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Professional standing, Recognition and Achievements in National Officership / Membership in Academic Organizations');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceManWorkGovernment() {

        return view('curriculumvitae.commextserviceextservicemanworkgovernment');

    }

    public function storeCommExtServiceManWorkGovernment(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceManWorkGovernments()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Government Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Managerial Work in Government');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceManWorkGovernment($id) {

        $extServiceManWorkGovernment = CommExtServiceExtServiceManWorkGovernment::find($id);

        return view('curriculumvitae.commextserviceextservicemanworkgovernment')->with('extServiceManWorkGovernment', $extServiceManWorkGovernment);

    }

    public function updateCommExtServiceManWorkGovernment(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceManWorkGovernment = CommExtServiceExtServiceManWorkGovernment::find($id);

        $data = $request->all();

        $extServiceManWorkGovernment->update($data);

        $extServiceManWorkGovernment->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Government Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Managerial Work in Government');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceManWorkGovernment($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceManWorkGovernment::find($id);

        CommExtServiceExtServiceManWorkGovernment::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Government Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Managerial Work in Government');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceManWorkPrivate() {

        return view('curriculumvitae.commextserviceextservicemanworkprivate');

    }

    public function storeCommExtServiceManWorkPrivate(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceManWorkPrivates()->create($data);\

        Log::channel('customlog')->info('User ' . $user->name . ' created a Private Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Managerial Work in Private');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceManWorkPrivate($id) {

        $extServiceManWorkPrivate = CommExtServiceExtServiceManWorkPrivate::find($id);

        return view('curriculumvitae.commextserviceextservicemanworkprivate')->with('extServiceManWorkPrivate', $extServiceManWorkPrivate);

    }

    public function updateCommExtServiceManWorkPrivate(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceManWorkPrivate = CommExtServiceExtServiceManWorkPrivate::find($id);

        $data = $request->all();

        $extServiceManWorkPrivate->update($data);

        $extServiceManWorkPrivate->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Private Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Managerial Work in Private');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceManWorkPrivate($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceManWorkPrivate::find($id);

        CommExtServiceExtServiceManWorkPrivate::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Private Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Managerial Work in Private');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceManWorkSenior() {

        return view('curriculumvitae.commextserviceextservicemanworksenior');

    }

    public function storeCommExtServiceManWorkSenior(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceManWorkSeniors()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Senior Partner in a nationally recognized professional partnership Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Managerial Work in Senior Partner in a nationally recognized professional partnership');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceManWorkSenior($id) {

        $extServiceManWorkSenior = CommExtServiceExtServiceManWorkSenior::find($id);

        return view('curriculumvitae.commextserviceextservicemanworksenior')->with('extServiceManWorkSenior', $extServiceManWorkSenior);

    }

    public function updateCommExtServiceManWorkSenior(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceManWorkSenior = CommExtServiceExtServiceManWorkSenior::find($id);

        $data = $request->all();

        $extServiceManWorkSenior->update($data);

        $extServiceManWorkSenior->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Senior Partner in a nationally recognized professional partnership Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Managerial Work in Senior Partner in a nationally recognized professional partnership');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceManWorkSenior($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceManWorkSenior::find($id);

        CommExtServiceExtServiceManWorkSenior::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Senior Partner in a nationally recognized professional partnership Managerial Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Managerial Work in Senior Partner in a nationally recognized professional partnership');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceConsultWork() {

        return view('curriculumvitae.commextserviceextserviceconsultwork');

    }

    public function storeCommExtServiceConsultWork(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceConsultWorks()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Extension Service Consultancy Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Consultancy Work');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceConsultWork($id) {

        $extServiceConsultWork = CommExtServiceExtServiceConsultWork::find($id);

        return view('curriculumvitae.commextserviceextserviceconsultwork')->with('extServiceConsultWork', $extServiceConsultWork);

    }

    public function updateCommExtServiceConsultWork(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceConsultWork = CommExtServiceExtServiceConsultWork::find($id);

        $data = $request->all();

        $extServiceConsultWork->update($data);

        $extServiceConsultWork->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Extension Service Consultancy Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Consultancy Work');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceConsultWork($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceConsultWork::find($id);

        CommExtServiceExtServiceConsultWork::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Extension Service Consultancy Work. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Consultancy Work');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addCommExtServiceGuestAppearance() {

        return view('curriculumvitae.commextserviceextserviceguestappearance');

    }

    public function storeCommExtServiceGuestAppearance(Request $request) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->commExtserviceExtserviceGuestAppearances()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Extension Service Guest appearance or Feature in media on a topic related to expertise. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully added a Guest appearance or Feature in media on a topic related to expertise');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editCommExtServiceGuestAppearance($id) {

        $extServiceGuestAppearance = CommExtServiceExtServiceGuestAppearance::find($id);

        return view('curriculumvitae.commextserviceextserviceguestappearance')->with('extServiceGuestAppearance', $extServiceGuestAppearance);

    }

    public function updateCommExtServiceGuestAppearance(Request $request, $id) {

        $this->validate($request, [
            'inclusive_years_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'inclusive_years_to' => 'required|digits:4|after_or_equal:inclusive_years_from|integer|min:1800|max:'.(date('Y')+1),
            'title' => 'required',
            'position' => 'required'
        ]);

        $user = Auth::user();

        $extServiceGuestAppearance = CommExtServiceExtServiceGuestAppearance::find($id);

        $data = $request->all();

        $extServiceGuestAppearance->update($data);

        $extServiceGuestAppearance->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Extension Service Guest appearance or Feature in media on a topic related to expertise. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully updated a Guest appearance or Feature in media on a topic related to expertise');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteCommExtServiceGuestAppearance($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceGuestAppearance::find($id);

        CommExtServiceExtServiceGuestAppearance::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Extension Service Guest appearance or Feature in media on a topic related to expertise. Inclusive Date from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to  . ', Title: ' . $request->title . ', Position: ' . $request->position . '.');

        session()->flash('success', 'Successfully deleted a Guest appearance or Feature in media on a topic related to expertise');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    //For Scholarships, Honors And/Or Awards Received

    public function beforeEditHonorsReceived() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.honorsreceived');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.honorsreceived');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.honorsreceived');
        }
    }

    public function addHonorsReceivedGovernment() {

        return view('curriculumvitae.honorsreceivedgovernment');

    }

    public function storeHonorsReceivedGovernment(Request $request) {

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required|after_or_equal:from',
            'nature_gov_exam' => 'required',
            'grade' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->honorsReceivedGovernments()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarships, Honors and/or Awards Received Government Examinations passed, if any. From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully added a Government Examinations passed');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editHonorsReceivedGovernment($id) {

        $honorsReceivedGovernment = HonorsReceivedGovernment::find($id);

        return view('curriculumvitae.honorsreceivedgovernment')->with('honorsReceivedGovernment', $honorsReceivedGovernment);

    }

    public function updateHonorsReceivedGovernment(Request $request, $id) {

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required|after_or_equal:from',
            'nature_gov_exam' => 'required',
            'grade' => 'required'
        ]);

        $user = Auth::user();

        $honorsReceivedGovernment = HonorsReceivedGovernment::find($id);

        $data = $request->all();

        $honorsReceivedGovernment->update($data);

        $honorsReceivedGovernment->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarships, Honors and/or Awards Received Government Examinations passed, if any. From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully updated a Government Examinations passed');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteHonorsReceivedGovernment($id) {

        $user = Auth::user();

        $request = HonorsReceivedGovernment::find($id);

        HonorsReceivedGovernment::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarships, Honors and/or Awards Received Government Examinations passed, if any. From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully updated a Government Examinations passed');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addHonorsReceivedScholarship() {

        return view('curriculumvitae.honorsreceivedscholarship');

    }

    public function storeHonorsReceivedScholarship(Request $request) {

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required|after_or_equal:from',
            'nature_gov_exam' => 'required',
            'grade' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->honorsReceivedScholarships()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarships, Honors and/or Awards Received Scholarships, if any. From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully added a Scholarships passed');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editHonorsReceivedScholarship($id) {

        $honorsReceivedScholarship = HonorsReceivedScholarship::find($id);

        return view('curriculumvitae.honorsreceivedscholarship')->with('honorsReceivedScholarship', $honorsReceivedScholarship);

    }

    public function updateHonorsReceivedScholarship(Request $request, $id) {

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required|after_or_equal:from',
            'nature_gov_exam' => 'required',
            'grade' => 'required'
        ]);

        $user = Auth::user();

        $honorsReceivedScholarship = HonorsReceivedScholarship::find($id);

        $data = $request->all();

        $honorsReceivedScholarship->update($data);

        $honorsReceivedScholarship->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarships, Honors and/or Awards Received Scholarships, if any. From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully updated a Scholarships passed');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteHonorsReceivedScholarship($id) {

        $user = Auth::user();

        $request = HonorsReceivedScholarship::find($id);

        HonorsReceivedScholarship::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarships, Honors and/or Awards Received Scholarships, if any. From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully deleted a Scholarships passed');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function addHonorsReceivedAward() {

        return view('curriculumvitae.honorsreceivedaward');

    }

    public function storeHonorsReceivedAward(Request $request) {

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required|after_or_equal:from',
            'nature_gov_exam' => 'required',
            'grade' => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();

        $user->honorsReceivedAwards()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Scholarships, Honors and/or Awards Awards (professional and/or academic honors received). From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully added a Awards (professional and/or academic honors received)');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editHonorsReceivedAward($id) {

        $honorsReceivedAward = HonorsReceivedAward::find($id);

        return view('curriculumvitae.honorsreceivedaward')->with('honorsReceivedAward', $honorsReceivedAward);

    }

    public function updateHonorsReceivedAward(Request $request, $id) {

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required|after_or_equal:from',
            'nature_gov_exam' => 'required',
            'grade' => 'required'
        ]);

        $user = Auth::user();

        $honorsReceivedAward = HonorsReceivedAward::find($id);

        $data = $request->all();

        $honorsReceivedAward->update($data);

        $honorsReceivedAward->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Scholarships, Honors and/or Awards Awards (professional and/or academic honors received). From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully updated a Awards (professional and/or academic honors received)');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteHonorsReceivedAward($id) {
        
        $user = Auth::user();

        $request = HonorsReceivedAward::find($id);

        HonorsReceivedAward::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Scholarships, Honors and/or Awards Awards (professional and/or academic honors received). From: ' . $request->from . ' - ' . $request->to  . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status(Grade): ' . $request->grade . '.');

        session()->flash('success', 'Successfully deleted a Awards (professional and/or academic honors received)');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    //For Use of Information Technology In Instructional Delivery
    public function beforeEditUseOfTechnology() {

        if(auth()->user()->role_id == 4){
            return view('facultymember.useoftechnology');
        } elseif(auth()->user()->role_id == 3){
            return view('facultyhead.useoftechnology');
        } elseif(auth()->user()->role_id == 2){
            return view('dean.useoftechnology');
        }

    }

    public function addUseOfTechnology() {

        return view('curriculumvitae.useoftechnology');

    }

    public function storeUseOfTechnology(Request $request) {

        $this->validate($request, [
            'subjects_taught' => 'required',
            'yes_no' => 'required',
            'nature_it_used' => 'required',
            
        ]);


        $user = Auth::user();

        $data = $request->all();

        $user->useOfTechnologies()->create($data);

        Log::channel('customlog')->info('User ' . $user->name . ' created a Use of Information Technology in Instructional Delivery. Subject Taught: ' . $request->subjects_taught . ', Do you use IT-based instructional aid in teaching the subject?: ' . $request->yes_no . ', If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.): ' . $request->nature_it_used . '.');

        session()->flash('success', 'Successfully added a Use of Information Technology in Instructional Delivery');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function editUseOfTechnology($id) {

        $useOfTechnology = UseOfTechnology::find($id);

        return view('curriculumvitae.useoftechnology')->with('useOfTechnology', $useOfTechnology);

    }

    public function updateUseOfTechnology(Request $request, $id) {

        $this->validate($request, [
            'subjects_taught' => 'required',
            'yes_no' => 'required',
            'nature_it_used' => 'required',
            
        ]);

        $user = Auth::user();

        $useOfTechnology = UseOfTechnology::find($id);

        $data = $request->all();

        $useOfTechnology->update($data);

        $useOfTechnology->update(['validate' => 0]);

        Log::channel('customlog')->info('User ' . $user->name . ' updated a Use of Information Technology in Instructional Delivery. Subject Taught: ' . $request->subjects_taught . ', Do you use IT-based instructional aid in teaching the subject?: ' . $request->yes_no . ', If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.): ' . $request->nature_it_used . '.');

        session()->flash('success', 'Successfully updated a Use of Information Technology in Instructional Delivery');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    public function deleteUseOfTechnology($id) {

        $user = Auth::user();

        $request = UseOfTechnology::find($id);

        UseOfTechnology::find($id)->delete();

        Log::channel('customlog')->info('User ' . $user->name . ' deleted a Use of Information Technology in Instructional Delivery. Subject Taught: ' . $request->subjects_taught . ', Do you use IT-based instructional aid in teaching the subject?: ' . $request->yes_no . ', If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.): ' . $request->nature_it_used . '.');

        session()->flash('success', 'Successfully deleted a Use of Information Technology in Instructional Delivery');

        if(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));
            
        } elseif(auth()->user()->role_id == 3) {

            return redirect(route('head.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        }

    }

    //FOR APPROVAL LOGIC
    public function approveOrUnapproveAcademicDegrees($id) {

        $user = Auth::user();

        $request = AcademicDegree::find($id);

        $academicdegree = AcademicDegree::find($id);

        if($academicdegree->validate == 0){

            $academicdegree->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $academicdegree->user->name . ' Academic Degree. Degree: ' . $request->degree . ', School: ' . $request->school . ', Year Graduated: ' . $request->year_graduated . '.');

        } else {

            $academicdegree->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $academicdegree->user->name . ' Academic Degree. Degree: ' . $request->degree . ', School: ' . $request->school . ', Year Graduated: ' . $request->year_graduated . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapprovePresentAcademicStatus($id) {

        $user = Auth::user();

        $request = PresentAcademic::find($id);

        $presentStatus = PresentAcademic::find($id);

        if($presentStatus->validate == 0){

            $presentStatus->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $presentStatus->user->name . ' Present Academic Status. Academic Rank: ' . $request->academic_rank . ', Employment Status: ' . $request->employment_status  . ', Year appointed in UST: ' . $request->employment_status . ', Number of years in UST:' . $request->num_of_years_in_ust . ', Position in UST: ' . $request->pos_in_ust . '.');


        } else {

            $presentStatus->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $presentStatus->user->name . ' Present Academic Status. Academic Rank: ' . $request->academic_rank . ', Employment Status: ' . $request->employment_status  . ', Year appointed in UST: ' . $request->employment_status . ', Number of years in UST:' . $request->num_of_years_in_ust . ', Position in UST: ' . $request->pos_in_ust . '.');

        }

        return redirect()->back();

    }

    public function approveoOrUnapproveEmploymentHistoryTeachingExperience($id) {

        $user = Auth::user();

        $request = EmploymentHistoryTeachingExperience::find($id);

        $employmentHistoryTeachExp = EmploymentHistoryTeachingExperience::find($id);

        if($employmentHistoryTeachExp->validate == 0){

            $employmentHistoryTeachExp->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $employmentHistoryTeachExp->user->name . ' Employment history Teaching Experience. Institution: ' . $request->institution . ', Subject Taught: ' . $request->subject_taught  . ', Peroid of employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Academic Rank:' . $request->academic_rank . '.');

        } else {

            $employmentHistoryTeachExp->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapporved ' . $employmentHistoryTeachExp->user->name . ' Employment history Teaching Experience. Institution: ' . $request->institution . ', Subject Taught: ' . $request->subject_taught  . ', Peroid of employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Academic Rank:' . $request->academic_rank . '.');

        }

        return redirect()->back();

    }

    public function approveoOrUnapproveEmploymentHistoryAdminisExperience($id) {

        $user = Auth::user();

        $request = EmploymentHistoryAdminisExperience::find($id);

        $employmentHistoryAdminisExp = EmploymentHistoryAdminisExperience::find($id);

        if($employmentHistoryAdminisExp->validate == 0){

            $employmentHistoryAdminisExp->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $employmentHistoryAdminisExp->user->name . ' Employment history Administrative Experience. Institution: ' . $request->institution . ', Peroid of employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title:' . $request->position_title . '.');

        } else {

            $employmentHistoryAdminisExp->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $employmentHistoryAdminisExp->user->name . ' Employment history Administrative Experience. Institution: ' . $request->institution . ', Peroid of employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title:' . $request->position_title . '.');

        }

        return redirect()->back();

    }

    public function approveoOrUnapproveEmploymentHistoryProfPracOutTeaching($id) {

        $user = Auth::user();

        $request = EmploymentHistoryProfPracOutTeaching::find($id);

        $employmentHistoryProfPracOutTeach = EmploymentHistoryProfPracOutTeaching::find($id);

        if($employmentHistoryProfPracOutTeach->validate == 0){

            $employmentHistoryProfPracOutTeach->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $employmentHistoryProfPracOutTeach->user->name . ' Employment history Professional Practice Outside Teaching. Institution: ' . $request->institution . ', Peroid of employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title:' . $request->position_title . '.');

        } else {

            $employmentHistoryProfPracOutTeach->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $employmentHistoryProfPracOutTeach->user->name . ' Employment history Professional Practice Outside Teaching. Institution: ' . $request->institution . ', Peroid of employment from: ' . $request->period_of_employment_from . ' - ' . $request->period_of_employment_to . ', Position/Title:' . $request->position_title . '.');

        }

        return redirect()->back();

    }

    public function approveoOrUnapproveEmploymentHistoryExchangeProgram($id) {

        $user = Auth::user();

        $request = EmploymentHistoryExchangeProgram::find($id);

        $employmentHistoryExchangeProgram = EmploymentHistoryExchangeProgram::find($id);

        if($employmentHistoryExchangeProgram->validate == 0){

            $employmentHistoryExchangeProgram->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $employmentHistoryExchangeProgram->user->name . ' Employment history Exchange Program. Institution: ' . $request->institution . ', Inclusive from: ' . $request->inclusive_from . ' - ' . $request->inclusive_to . ', Position/Title:' . $request->position_title . '.');

        } else {

            $employmentHistoryExchangeProgram->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $employmentHistoryExchangeProgram->user->name . ' Employment history Exchange Program. Institution: ' . $request->institution . ', Inclusive from: ' . $request->inclusive_from . ' - ' . $request->inclusive_to . ', Position/Title:' . $request->position_title . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveNonDegreeSeminarWorkshops($id) {

        $user = Auth::user();

        $request = NondegreetrainingSeminarsWorkshop::find($id);

        $nondegreeseminarworkshops = NondegreetrainingSeminarsWorkshop::find($id);

        if($nondegreeseminarworkshops->validate == 0){

            $nondegreeseminarworkshops->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $nondegreeseminarworkshops->user->name . ' Non-Degree Seminars and Workshops. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop . ', Venue:' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        } else {

            $nondegreeseminarworkshops->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $nondegreeseminarworkshops->user->name . ' Non-Degree Seminars and Workshops. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop . ', Venue:' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveNonDegreeCulturalEducationTravel($id) {
        
        $user = Auth::user();

        $request = NondegreetrainingCulturalEducTravel::find($id);

        $nondegreeculturaleductravel = NondegreetrainingCulturalEducTravel::find($id);

        if($nondegreeculturaleductravel->validate == 0){

            $nondegreeculturaleductravel->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $nondegreeculturaleductravel->user->name . ' Non-Degree Cultural / Educational Travel. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop . ', Venue:' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        } else {

            $nondegreeculturaleductravel->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $nondegreeculturaleductravel->user->name . ' Non-Degree Cultural / Educational Travel. Role: ' . $request->role . ', Title of Seminar / Workshop: ' . $request->seminar_workshop . ', Venue:' . $request->venue . ', Inclusive Date: ' . $request->inclusive_date . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveResearchScholarPubRefer($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducPubRefer::find($id);

        $ResearchCreativeWorksScholarProducPubRefer = ResearchCreativeWorksScholarProducPubRefer::find($id);

        if($ResearchCreativeWorksScholarProducPubRefer->validate == 0){

            $ResearchCreativeWorksScholarProducPubRefer->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducPubRefer->user->name . ' Scholarly Productions Refereed Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducPubRefer->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducPubRefer->user->name . ' Scholarly Productions Refereed Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarPubNonRefer($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducPubNonRefer::find($id);

        $ResearchCreativeWorksScholarProducPubNonRefer = ResearchCreativeWorksScholarProducPubNonRefer::find($id);

        if($ResearchCreativeWorksScholarProducPubNonRefer->validate == 0){

            $ResearchCreativeWorksScholarProducPubNonRefer->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducPubNonRefer->user->name . ' Scholarly Productions Non-Refereed Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducPubNonRefer->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducPubNonRefer->user->name . ' Scholarly Productions Non-Refereed Published articles/researches in reputable journals. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarFullBook($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducFullBook::find($id);

        $ResearchCreativeWorksScholarProducFullBook = ResearchCreativeWorksScholarProducFullBook::find($id);

        if($ResearchCreativeWorksScholarProducFullBook->validate == 0){

            $ResearchCreativeWorksScholarProducFullBook->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducFullBook->user->name . ' Scholarly Productions Full-lenghts Books. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducFullBook->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducFullBook->user->name . ' Scholarly Productions Full-lenghts Books. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarPreNonScribedPubBook($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducPreNonScribePubBook::find($id);

        $ResearchCreativeWorksScholarProducPreNonScribePubBook = ResearchCreativeWorksScholarProducPreNonScribePubBook::find($id);

        if($ResearchCreativeWorksScholarProducPreNonScribePubBook->validate == 0){

            $ResearchCreativeWorksScholarProducPreNonScribePubBook->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducPreNonScribePubBook->user->name . ' Scholarly Productions Prescribed/Non-Prescribed published textbooks. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducPreNonScribePubBook->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducPreNonScribePubBook->user->name . ' Scholarly Productions Prescribed/Non-Prescribed published textbooks. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarProfJournal($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducProfJournal::find($id);

        $ResearchCreativeWorksScholarProducProfJournal = ResearchCreativeWorksScholarProducProfJournal::find($id);

        if($ResearchCreativeWorksScholarProducProfJournal->validate == 0){

            $ResearchCreativeWorksScholarProducProfJournal->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducProfJournal->user->name . ' Scholarly Productions Professional Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducProfJournal->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducProfJournal->user->name . ' Scholarly Productions Professional Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarLocJournal($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducLocalJournal::find($id);

        $ResearchCreativeWorksScholarProducLocalJournal = ResearchCreativeWorksScholarProducLocalJournal::find($id);

        if($ResearchCreativeWorksScholarProducLocalJournal->validate == 0){

            $ResearchCreativeWorksScholarProducLocalJournal->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducLocalJournal->user->name . ' Scholarly Productions Local Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducLocalJournal->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducLocalJournal->user->name . ' Scholarly Productions Local Journal. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarDelPubPaper($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducDelPubPaper::find($id);

        $ResearchCreativeWorksScholarProducDelPubPaper = ResearchCreativeWorksScholarProducDelPubPaper::find($id);

        if($ResearchCreativeWorksScholarProducDelPubPaper->validate == 0){

            $ResearchCreativeWorksScholarProducDelPubPaper->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducDelPubPaper->user->name . ' Scholarly Productions Delivered & Published Papers/lectures/Speeches. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducDelPubPaper->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducDelPubPaper->user->name . ' Scholarly Productions Delivered & Published Papers/lectures/Speeches. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarCommCompResearch($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducCommCompResearch::find($id);

        $ResearchCreativeWorksScholarProducCommCompResearch = ResearchCreativeWorksScholarProducCommCompResearch::find($id);

        if($ResearchCreativeWorksScholarProducCommCompResearch->validate == 0){

            $ResearchCreativeWorksScholarProducCommCompResearch->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducCommCompResearch->user->name . ' Scholarly Productions Commissioned and Completed Researches. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducCommCompResearch->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducCommCompResearch->user->name . ' Scholarly Productions Commissioned and Completed Researches. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchScholarResearchPoster($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksScholarProducResearchPoster::find($id);

        $ResearchCreativeWorksScholarProducResearchPoster = ResearchCreativeWorksScholarProducResearchPoster::find($id);

        if($ResearchCreativeWorksScholarProducResearchPoster->validate == 0){

            $ResearchCreativeWorksScholarProducResearchPoster->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksScholarProducResearchPoster->user->name . ' Scholarly Productions Research Posters. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksScholarProducResearchPoster->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksScholarProducResearchPoster->user->name . ' Scholarly Productions Research Posters. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeDistPerfArt($id) {
        
        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksDistPerfArt::find($id);

        $ResearchCreativeWorksCreativeWorksDistPerfArt = ResearchCreativeWorksCreativeWorksDistPerfArt::find($id);

        if($ResearchCreativeWorksCreativeWorksDistPerfArt->validate == 0){

            $ResearchCreativeWorksCreativeWorksDistPerfArt->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksCreativeWorksDistPerfArt->user->name . ' Creative Works Distinguished performance in any of the performing arts. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksCreativeWorksDistPerfArt->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksCreativeWorksDistPerfArt->user->name . ' Creative Works Distinguished performance in any of the performing arts. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeOrigMusicalWork($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksOrigMusicalWork::find($id);

        $ResearchCreativeWorksCreativeWorksOrigMusicalWork = ResearchCreativeWorksCreativeWorksOrigMusicalWork::find($id);

        if($ResearchCreativeWorksCreativeWorksOrigMusicalWork->validate == 0){

            $ResearchCreativeWorksCreativeWorksOrigMusicalWork->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksCreativeWorksOrigMusicalWork->user->name . ' Creative Works Original Musical Work. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksCreativeWorksOrigMusicalWork->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksCreativeWorksOrigMusicalWork->user->name . ' Creative Works Original Musical Work. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeOrigDesign($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksOrigDesign::find($id);

        $ResearchCreativeWorksCreativeWorksOrigDesign = ResearchCreativeWorksCreativeWorksOrigDesign::find($id);

        if($ResearchCreativeWorksCreativeWorksOrigDesign->validate == 0){

            $ResearchCreativeWorksCreativeWorksOrigDesign->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksCreativeWorksOrigDesign->user->name . ' Creative Works Original Design. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksCreativeWorksOrigDesign->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksCreativeWorksOrigDesign->user->name . ' Creative Works Original Design. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeLitWork($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksLitWork::find($id);

        $ResearchCreativeWorksCreativeWorksLitWork = ResearchCreativeWorksCreativeWorksLitWork::find($id);

        if($ResearchCreativeWorksCreativeWorksLitWork->validate == 0){

            $ResearchCreativeWorksCreativeWorksLitWork->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksCreativeWorksLitWork->user->name . ' Creative Works Published / Acknowledge Literary Works. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksCreativeWorksLitWork->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksCreativeWorksLitWork->user->name . ' Creative Works Published / Acknowledge Literary Works. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeExArtWork($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksExArtWork::find($id);  

        $ResearchCreativeWorksCreativeWorksExArtWork = ResearchCreativeWorksCreativeWorksExArtWork::find($id);

        if($ResearchCreativeWorksCreativeWorksExArtWork->validate == 0){

            $ResearchCreativeWorksCreativeWorksExArtWork->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksCreativeWorksExArtWork->user->name . ' Creative Works Exhibited Art Works. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksCreativeWorksExArtWork->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksCreativeWorksExArtWork->user->name . ' Creative Works Exhibited Art Works. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeGenCirculation($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksCreativeWorksGenCirculation::find($id);

        $ResearchCreativeWorksCreativeWorksGenCirculation = ResearchCreativeWorksCreativeWorksGenCirculation::find($id);

        if($ResearchCreativeWorksCreativeWorksGenCirculation->validate == 0){

            $ResearchCreativeWorksCreativeWorksGenCirculation->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksCreativeWorksGenCirculation->user->name . ' Creative Works Exhibited Art Works. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksCreativeWorksGenCirculation->update(['validate' => 0]);\

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksCreativeWorksGenCirculation->user->name . ' Creative Works Exhibited Art Works. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeAidTechMatProdCourseModule($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechMatProdCourseModule::find($id);

        $ResearchCreativeWorksEdAidTechMatProdCourseModule = ResearchCreativeWorksEdAidTechMatProdCourseModule::find($id);

        if($ResearchCreativeWorksEdAidTechMatProdCourseModule->validate == 0){

            $ResearchCreativeWorksEdAidTechMatProdCourseModule->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksEdAidTechMatProdCourseModule->user->name . ' Educational Aids and Technology Course Module Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksEdAidTechMatProdCourseModule->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksEdAidTechMatProdCourseModule->user->name . ' Educational Aids and Technology Course Module Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeAidTechMatProdOnlineCourse($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechMatProdOnlineCourse::find($id);

        $ResearchCreativeWorksEdAidTechMatProdOnlineCourse = ResearchCreativeWorksEdAidTechMatProdOnlineCourse::find($id);

        if($ResearchCreativeWorksEdAidTechMatProdOnlineCourse->validate == 0){

            $ResearchCreativeWorksEdAidTechMatProdOnlineCourse->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksEdAidTechMatProdOnlineCourse->user->name . ' Educational Aids and Technology Online Course Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksEdAidTechMatProdOnlineCourse->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksEdAidTechMatProdOnlineCourse->user->name . ' Educational Aids and Technology Online Course Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeAidTechMatProdManual($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechMatProdManual::find($id);

        $ResearchCreativeWorksEdAidTechMatProdManual = ResearchCreativeWorksEdAidTechMatProdManual::find($id);

        if($ResearchCreativeWorksEdAidTechMatProdManual->validate == 0){

            $ResearchCreativeWorksEdAidTechMatProdManual->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksEdAidTechMatProdManual->user->name . ' Educational Aids and Technology Laboratory manuals, Course manuals or Workbook in actual use by the department or college Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksEdAidTechMatProdManual->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksEdAidTechMatProdManual->user->name . ' Educational Aids and Technology Laboratory manuals, Course manuals or Workbook in actual use by the department or college Material Production. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveResearchCreativeAidTechTechAid($id) {

        $user = Auth::user();

        $request = ResearchCreativeWorksEdAidTechTeachAid::find($id);

        $ResearchCreativeWorksEdAidTechTeachAid = ResearchCreativeWorksEdAidTechTeachAid::find($id);

        if($ResearchCreativeWorksEdAidTechTeachAid->validate == 0){

            $ResearchCreativeWorksEdAidTechTeachAid->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $ResearchCreativeWorksEdAidTechTeachAid->user->name . ' Educational Aids and Technology Teaching aids produced for use in the department and /or Faculty or College. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        } else {

            $ResearchCreativeWorksEdAidTechTeachAid->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $ResearchCreativeWorksEdAidTechTeachAid->user->name . ' Educational Aids and Technology Teaching aids produced for use in the department and /or Faculty or College. Nature of Publication: ' . $request->nature_of_publication . ', Date of Publication: ' . $request->date_publication . ', Role/Comments: ' . $request->role_comments . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveCommExtServiceCommServiceDevUniv($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceDevUnivInitiate::find($id);

        $CommExtServiceCommServiceDevUnivInitiate = CommExtServiceCommServiceDevUnivInitiate::find($id);

        if($CommExtServiceCommServiceDevUnivInitiate->validate == 0){

            $CommExtServiceCommServiceDevUnivInitiate->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceCommServiceDevUnivInitiate->user->name . ' Community Service University-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceCommServiceDevUnivInitiate->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceCommServiceDevUnivInitiate->user->name . ' Community Service University-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveExtServiceCommServiceDevExt($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceDevExtInitiate::find($id);

        $CommExtServiceCommServiceDevExtInitiate = CommExtServiceCommServiceDevExtInitiate::find($id);

        if($CommExtServiceCommServiceDevExtInitiate->validate == 0){

            $CommExtServiceCommServiceDevExtInitiate->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceCommServiceDevExtInitiate->user->name . ' Community Service Externally-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceCommServiceDevExtInitiate->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceCommServiceDevExtInitiate->user->name . ' Community Service Externally-Initiated Community Development. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceCommServiceHumanUniv($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceHumanUnivInitiate::find($id);

        $CommExtServiceCommServiceHumanUnivInitiate = CommExtServiceCommServiceHumanUnivInitiate::find($id);

        if($CommExtServiceCommServiceHumanUnivInitiate->validate == 0){

            $CommExtServiceCommServiceHumanUnivInitiate->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceCommServiceHumanUnivInitiate->user->name . ' Community Service University-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceCommServiceHumanUnivInitiate->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceCommServiceHumanUnivInitiate->user->name . ' Community Service University-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceCommServiceHumanExt($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceHumanExtInitiate::find($id);

        $CommExtServiceCommServiceHumanExtInitiate = CommExtServiceCommServiceHumanExtInitiate::find($id);

        if($CommExtServiceCommServiceHumanExtInitiate->validate == 0){

            $CommExtServiceCommServiceHumanExtInitiate->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceCommServiceHumanExtInitiate->user->name . ' Community Service Externally-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceCommServiceHumanExtInitiate->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceCommServiceHumanExtInitiate->user->name . ' Community Service Externally-Initiated Humanitarian/Relief Mission. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceCommServiceAdvoUniv($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceAdvoUnivInitiate::find($id);

        $CommExtServiceCommServiceAdvoUnivInitiate = CommExtServiceCommServiceAdvoUnivInitiate::find($id);

        if($CommExtServiceCommServiceAdvoUnivInitiate->validate == 0){

            $CommExtServiceCommServiceAdvoUnivInitiate->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceCommServiceAdvoUnivInitiate->user->name . ' Community Service University-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceCommServiceAdvoUnivInitiate->update(['validate' => 0]);
            
            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceCommServiceAdvoUnivInitiate->user->name . ' Community Service University-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceCommServiceAdvoExt($id) {

        $user = Auth::user();

        $request = CommExtServiceCommServiceAdvoExtInitiate::find($id);

        $CommExtServiceCommServiceAdvoExtInitiate = CommExtServiceCommServiceAdvoExtInitiate::find($id);

        if($CommExtServiceCommServiceAdvoExtInitiate->validate == 0){

            $CommExtServiceCommServiceAdvoExtInitiate->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceCommServiceAdvoExtInitiate->user->name . ' Community Service Externally-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceCommServiceAdvoExtInitiate->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceCommServiceAdvoExtInitiate->user->name . ' Community Service Externally-Initiated Involvement in Advocacy Activities. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceSeminar($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceSeminar::find($id);

        $CommExtServiceExtServiceSeminar = CommExtServiceExtServiceSeminar::find($id);

        if($CommExtServiceExtServiceSeminar->validate == 0){

            $CommExtServiceExtServiceSeminar->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceSeminar->user->name . ' Extension Service Seminars/Workshops/Conferences/Convention. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceSeminar->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceSeminar->user->name . ' Extension Service Seminars/Workshops/Conferences/Convention. Inclusive Date from: ' . $request->inclusive_date_from . ' - ' . $request->inclusive_date_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceProfStandOffInternational($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceProfStandOffInternational::find($id);

        $CommExtServiceExtServiceProfStandOffInternational = CommExtServiceExtServiceProfStandOffInternational::find($id);

        if($CommExtServiceExtServiceProfStandOffInternational->validate == 0){

            $CommExtServiceExtServiceProfStandOffInternational->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceProfStandOffInternational->user->name . ' Extension Service International Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceProfStandOffInternational->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceProfStandOffInternational->user->name . ' Extension Service International Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceProfStandOffNational($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceProfStandOffNational::find($id);

        $CommExtServiceExtServiceProfStandOffNational = CommExtServiceExtServiceProfStandOffNational::find($id);

        if($CommExtServiceExtServiceProfStandOffNational->validate == 0){

            $CommExtServiceExtServiceProfStandOffNational->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceProfStandOffNational->user->name . ' Extension Service National Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceProfStandOffNational->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceProfStandOffNational->user->name . ' Extension Service National Officership / Membership in Professional Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceProfStandOffAcadInternational($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceProfStandOffAcadInterational::find($id);

        $CommExtServiceExtServiceProfStandOffAcadInterational = CommExtServiceExtServiceProfStandOffAcadInterational::find($id);

        if($CommExtServiceExtServiceProfStandOffAcadInterational->validate == 0){

            $CommExtServiceExtServiceProfStandOffAcadInterational->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceProfStandOffAcadInterational->user->name . ' Extension Service International Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceProfStandOffAcadInterational->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceProfStandOffAcadInterational->user->name . ' Extension Service International Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceProfStandOffAcadNational($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceProfStandOffAcadNational::find($id);

        $CommExtServiceExtServiceProfStandOffAcadNational = CommExtServiceExtServiceProfStandOffAcadNational::find($id);

        if($CommExtServiceExtServiceProfStandOffAcadNational->validate == 0){

            $CommExtServiceExtServiceProfStandOffAcadNational->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceProfStandOffAcadNational->user->name . ' Extension Service National Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceProfStandOffAcadNational->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceProfStandOffAcadNational->user->name . ' Extension Service National Officership / Membership in Academic Organizations Professional standing, Recognition and Achievements. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceManWorkGovernment($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceManWorkGovernment::find($id);

        $CommExtServiceExtServiceManWorkGovernment = CommExtServiceExtServiceManWorkGovernment::find($id);

        if($CommExtServiceExtServiceManWorkGovernment->validate == 0){

            $CommExtServiceExtServiceManWorkGovernment->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceManWorkGovernment->user->name . ' Extension Service Managerial Work Government. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceManWorkGovernment->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceManWorkGovernment->user->name . ' Extension Service Managerial Work Government. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceManWorkPrivate($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceManWorkPrivate::find($id);

        $CommExtServiceExtServiceManWorkPrivate = CommExtServiceExtServiceManWorkPrivate::find($id);

        if($CommExtServiceExtServiceManWorkPrivate->validate == 0){

            $CommExtServiceExtServiceManWorkPrivate->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceManWorkPrivate->user->name . ' Extension Service Managerial Work Private. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceManWorkPrivate->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceManWorkPrivate->user->name . ' Extension Service Managerial Work Private. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceManWorkSenior($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceManWorkSenior::find($id);

        $CommExtServiceExtServiceManWorkSenior = CommExtServiceExtServiceManWorkSenior::find($id);

        if($CommExtServiceExtServiceManWorkSenior->validate == 0){

            $CommExtServiceExtServiceManWorkSenior->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceManWorkSenior->user->name . ' Extension Service Managerial Work Senior Partner in a nationally recognized professional partnership. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceManWorkSenior->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceManWorkSenior->user->name . ' Extension Service Managerial Work Senior Partner in a nationally recognized professional partnership. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceConsultWork($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceConsultWork::find($id);

        $CommExtServiceExtServiceConsultWork = CommExtServiceExtServiceConsultWork::find($id);

        if($CommExtServiceExtServiceConsultWork->validate == 0){

            $CommExtServiceExtServiceConsultWork->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceConsultWork->user->name . ' Extension Service Consultancy Work. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceConsultWork->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceConsultWork->user->name . ' Extension Service Consultancy Work. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveCommExtServiceGuestAppearance($id) {

        $user = Auth::user();

        $request = CommExtServiceExtServiceGuestAppearance::find($id);

        $CommExtServiceExtServiceGuestAppearance = CommExtServiceExtServiceGuestAppearance::find($id);

        if($CommExtServiceExtServiceGuestAppearance->validate == 0){

            $CommExtServiceExtServiceGuestAppearance->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $CommExtServiceExtServiceGuestAppearance->user->name . ' Extension Service Guest appearance or Feature in media on a topic related to expertise. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        } else {

            $CommExtServiceExtServiceGuestAppearance->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $CommExtServiceExtServiceGuestAppearance->user->name . ' Extension Service Guest appearance or Feature in media on a topic related to expertise. Inclusive years from: ' . $request->inclusive_years_from . ' - ' . $request->inclusive_years_to . ', Title/Nature of Activities / Services: ' . $request->title . ', Role/Participation: ' . $request->role . '.');

        }

        return redirect()->back();


    }

    public function approveOrUnapproveHonorsReceivedGovernment($id) {

        $user = Auth::user();

        $request = HonorsReceivedGovernment::find($id);

        $HonorsReceivedGovernment = HonorsReceivedGovernment::find($id);

        if($HonorsReceivedGovernment->validate == 0){

            $HonorsReceivedGovernment->update(['validate' => 1]);
            
            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $HonorsReceivedGovernment->user->name . ' Scholarships, Honors and/or Awards Received Government Examinations passed, if any. From: ' . $request->from . ' - ' . $request->to . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status (Grade): ' . $request->grade . '.');

        } else {

            $HonorsReceivedGovernment->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $HonorsReceivedGovernment->user->name . ' Scholarships, Honors and/or Awards Received Government Examinations passed, if any. From: ' . $request->from . ' - ' . $request->to . ', Nature of Government Examination: ' . $request->nature_gov_exam . ', Status (Grade): ' . $request->grade . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveHonorsReceivedScholarship($id) {

        $user = Auth::user();

        $request = HonorsReceivedScholarship::find($id);

        $HonorsReceivedScholarship = HonorsReceivedScholarship::find($id);

        if($HonorsReceivedScholarship->validate == 0){

            $HonorsReceivedScholarship->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $HonorsReceivedScholarship->user->name . ' Scholarships, Honors and/or Awards Received Scholarships, if any. From: ' . $request->from . ' - ' . $request->to . ', Nature of Scholarship: ' . $request->nature_gov_exam . ', Status (Grade): ' . $request->grade . '.');

        } else {

            $HonorsReceivedScholarship->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $HonorsReceivedScholarship->user->name . ' Scholarships, Honors and/or Awards Received Scholarships, if any. From: ' . $request->from . ' - ' . $request->to . ', Nature of Scholarship: ' . $request->nature_gov_exam . ', Status (Grade): ' . $request->grade . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveHonorsReceivedAward($id) {

        $user = Auth::user();

        $request = HonorsReceivedAward::find($id);

        $HonorsReceivedAward = HonorsReceivedAward::find($id);

        if($HonorsReceivedAward->validate == 0){

            $HonorsReceivedAward->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $HonorsReceivedAward->user->name . ' Scholarships, Honors and/or Awards Awards (professional and/or academic honors received). From: ' . $request->from . ' - ' . $request->to . ', Awarding Organization: ' . $request->nature_gov_exam . ', Status (Grade): ' . $request->grade . '.');

        } else {

            $HonorsReceivedAward->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $HonorsReceivedAward->user->name . ' Scholarships, Honors and/or Awards Awards (professional and/or academic honors received). From: ' . $request->from . ' - ' . $request->to . ', Awarding Organization: ' . $request->nature_gov_exam . ', Status (Grade): ' . $request->grade . '.');

        }

        return redirect()->back();

    }

    public function approveOrUnapproveUseOfTechnology($id) {

        $user = Auth::user();

        $request = UseOfTechnology::find($id);

        $UseOfTechnology = UseOfTechnology::find($id);

        if($UseOfTechnology->validate == 0){

            $UseOfTechnology->update(['validate' => 1]);

            Log::channel('customlog')->info('User ' . $user->name . ' approved ' . $UseOfTechnology->user->name . ' Use of Information Technology in Instructional Delivery. List of Subjects Taught: ' . $request->subjects_taught . ', Do you use IT-based instructional aid in teaching the subject?: ' . $request->yes_no . ', If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.): ' . $request->nature_it_used . '.');

        } else {

            $UseOfTechnology->update(['validate' => 0]);

            Log::channel('customlog')->info('User ' . $user->name . ' unapproved ' . $UseOfTechnology->user->name . ' Use of Information Technology in Instructional Delivery. List of Subjects Taught: ' . $request->subjects_taught . ', Do you use IT-based instructional aid in teaching the subject?: ' . $request->yes_no . ', If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.): ' . $request->nature_it_used . '.');

        }

        return redirect()->back();

    }
}
