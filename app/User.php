<?php

namespace App;

use App\Rank;
use App\Role;
use App\AcademicDegree;
use App\PresentAcademic;
use App\UseOfTechnology;
use App\PersonalParticular;
use App\HonorsReceivedAward;
use App\HonorsReceivedGovernment;
use App\HonorsReceivedScholarship;
use App\CommExtServiceExtServiceSeminar;
use Illuminate\Notifications\Notifiable;
use App\EmploymentHistoryExchangeProgram;
use App\NondegreetrainingSeminarsWorkshop;
use App\EmploymentHistoryAdminisExperience;
use App\CommExtServiceExtServiceConsultWork;
use App\EmploymentHistoryTeachingExperience;
use App\NondegreetrainingCulturalEducTravel;
use App\EmploymentHistoryProfPracOutTeaching;
use App\CommExtServiceExtServiceManWorkSenior;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\CommExtServiceExtServiceManWorkPrivate;
use App\ResearchCreativeWorksEdAidTechTeachAid;
use App\CommExtServiceCommServiceDevExtInitiate;
use App\CommExtServiceExtServiceGuestAppearance;
use App\CommExtServiceCommServiceAdvoExtInitiate;
use App\CommExtServiceCommServiceDevUnivInitiate;
use App\CommExtServiceCommServiceAdvoUnivInitiate;
use App\CommExtServiceCommServiceHumanExtInitiate;
use App\CommExtServiceExtServiceManWorkGovernment;
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
use Illuminate\Foundation\Auth\User as Authenticatable;
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
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'rank_id', 'role_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {

        return $this->belongsTo(Role::class);

    }

    public function personalParticular() {

        return $this->hasOne(PersonalParticular::class);

    }

    public function rank() {

        return $this->belongsTo(Rank::class);

    }

    public function academicDegrees() {

        return $this->hasMany(AcademicDegree::class);

    }

    public function academicPresentStatus() {

        return $this->hasOne(PresentAcademic::class);

    }

    public function employmentHistoryTeachingExperiences() {

        return $this->hasMany(EmploymentHistoryTeachingExperience::class);

    }

    public function employmentHistoryAdminisExperiences() {

        return $this->hasMany(EmploymentHistoryAdminisExperience::class);

    }

    public function employmentHistoryProfPracOutTeaching() {

        return $this->hasMany(EmploymentHistoryProfPracOutTeaching::class);

    }

    public function employmentHistoryExchangeProgram() {

        return $this->hasMany(EmploymentHistoryExchangeProgram::class);

    }

    public function nondegreetrainingSeminarsWorkshops() {

        return $this->hasMany(NondegreetrainingSeminarsWorkshop::class);

    }

    public function nondegreetrainingCulturalEducationalTravel() {

        return $this->hasMany(NondegreetrainingCulturalEducTravel::class);

    }

    public function researchScholarPubRefers() {

        return $this->hasMany(ResearchCreativeWorksScholarProducPubRefer::class);

    }

    public function researchScholarPubNonRefers() {

        return $this->hasMany(ResearchCreativeWorksScholarProducPubNonRefer::class);

    }

    public function researchScholarFullBooks() {

        return $this->hasMany(ResearchCreativeWorksScholarProducFullBook::class);

    }

    public function researchScholarPreNonScribePubBooks() {

        return $this->hasMany(ResearchCreativeWorksScholarProducPreNonScribePubBook::class);

    }

    public function researchScholarProfJournals() {

        return $this->hasMany(ResearchCreativeWorksScholarProducProfJournal::class);

    }

    public function researchScholarLocJournals() {

        return $this->hasMany(ResearchCreativeWorksScholarProducLocalJournal::class);

    }

    public function researchScholarDelPubPaper() {

        return $this->hasMany(ResearchCreativeWorksScholarProducDelPubPaper::class);

    }

    public function researchScholarCommCompResearches() {

        return $this->hasMany(ResearchCreativeWorksScholarProducCommCompResearch::class);

    }

    public function researchScholarResearchPosters() {

        return $this->hasMany(ResearchCreativeWorksScholarProducResearchPoster::class);

    }

    public function researchCreativeDistPerfArts() {

        return $this->hasMany(ResearchCreativeWorksCreativeWorksDistPerfArt::class);

    }

    public function researchCreativeOrigMusicalWorks() {

        return $this->hasMany(ResearchCreativeWorksCreativeWorksOrigMusicalWork::class);

    }

    public function researchCreateOrigDesigns() {

        return $this->hasMany(ResearchCreativeWorksCreativeWorksOrigDesign::class);

    }

    public function researchCreativeLitWorks() {

        return $this->hasMany(ResearchCreativeWorksCreativeWorksLitWork::class);

    }

    public function researchCreativeExArtWorks() {

        return $this->hasMany(ResearchCreativeWorksCreativeWorksExArtWork::class);

    }

    public function researchCreativeGenCirculations() {

        return $this->hasMany(ResearchCreativeWorksCreativeWorksGenCirculation::class);

    }

    public function researchCreativeAidTechMatProdCourseModules() {

        return $this->hasMany(ResearchCreativeWorksEdAidTechMatProdCourseModule::class);

    }

    public function researchCreativeAidTechMatProdOnlineCourses() {

        return $this->hasMany(ResearchCreativeWorksEdAidTechMatProdOnlineCourse::class);

    }

    public function researchCreativeAidTechMatProdManuals() {

        return $this->hasMany(ResearchCreativeWorksEdAidTechMatProdManual::class);

    }

    public function researchCreativeAidTechTechAids() {

        return $this->hasMany(ResearchCreativeWorksEdAidTechTeachAid::class);

    }

    public function commExtServiceCommServiceDevUnivInitiates() {

        return $this->hasMany(CommExtServiceCommServiceDevUnivInitiate::class);

    }

    public function commExtServiceCommServiceDevExtInitiates() {

        return $this->hasMany(CommExtServiceCommServiceDevExtInitiate::class);

    }

    public function commExtServiceCommServiceHumanUnivInitiates() {

        return $this->hasMany(CommExtServiceCommServiceHumanUnivInitiate::class);

    }

    public function commExtServiceCommServiceHumanExtInitiates() {

        return $this->hasMany(CommExtServiceCommServiceHumanExtInitiate::class);

    }

    public function commExtServiceCommServiceAdvoUnivInitiates() {

        return $this->hasMany(CommExtServiceCommServiceAdvoUnivInitiate::class);

    }

    public function commExtServiceCommServiceAdvoExtInitiates() {

        return $this->hasMany(CommExtServiceCommServiceAdvoExtInitiate::class);

    }

    public function commExtserviceExtserviceSeminars() {

        return $this->hasMany(CommExtServiceExtServiceSeminar::class);

    }

    public function commExtserviceExtserviceProfStandOffInternationals() {

        return $this->hasMany(CommExtServiceExtServiceProfStandOffInternational::class);

    }

    public function commExtserviceExtserviceProfStandOffNationals() {

        return $this->hasMany(CommExtServiceExtServiceProfStandOffNational::class);

    }

    public function commExtserviceExtserviceProfStandOffAcadInternationals() {

        return $this->hasMany(CommExtServiceExtServiceProfStandOffAcadInterational::class);

    }

    public function commExtserviceExtserviceProfStandOffAcadNationals() {

        return $this->hasMany(CommExtServiceExtServiceProfStandOffAcadNational::class);

    }

    public function commExtserviceExtserviceManWorkGovernments() {

        return $this->hasMany(CommExtServiceExtServiceManWorkGovernment::class);

    }

    public function commExtserviceExtserviceManWorkPrivates() {

        return $this->hasMany(CommExtServiceExtServiceManWorkPrivate::class);

    }

    public function commExtserviceExtserviceManWorkSeniors() {

        return $this->hasMany(CommExtServiceExtServiceManWorkSenior::class);

    }

    public function commExtserviceExtserviceConsultWorks() {

        return $this->hasMany(CommExtServiceExtServiceConsultWork::class);

    }

    public function commExtserviceExtserviceGuestAppearances() {

        return $this->hasMany(CommExtServiceExtServiceGuestAppearance::class);

    }

    public function honorsReceivedGovernments() {

        return $this->hasMany(HonorsReceivedGovernment::class);

    }

    public function honorsReceivedScholarships() {

        return $this->hasMany(HonorsReceivedScholarship::class);

    }

    public function honorsReceivedAwards() {

        return $this->hasMany(HonorsReceivedAward::class);

    }

    //For Use of Information Technology In Instructional Delivery
    public function useOfTechnologies() {

        return $this->hasMany(UseOfTechnology::class);

    }

    public function members() {

        return $this->where('rank_id', 1)->where('role_id', 4)->get();

    }

}
