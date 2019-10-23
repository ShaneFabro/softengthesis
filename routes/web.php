<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){

    return view('home');

})->middleware(['auth'])->name('home');

Auth::routes();

Route::middleware('isAdmin','auth')->group(function(){

    Route::resource('admin','SystemAdminController');
    Route::get('dashboard/admin', 'SystemAdminController@dashboard')->name('admin.dashboard');
    Route::get('changepassword/admin', 'SystemAdminController@changePassword')->name('admin.changepassword');
    Route::put('changepassword/confirm/admin', 'SystemAdminController@changePasswordConfirm')->name('admin.changepassword.confirm');
    Route::get('viewlogs', 'SystemAdminController@viewLogs')->name('admin.viewlogs');
    Route::get('departments/show/allfaculty/admin', 'SystemAdminController@allFaculty')->name('admin.allfaculty');
    Route::put('activedeactivate/{id}/admin', 'SystemAdminController@activeDeactivate')->name('admin.activedeactivate');
    Route::get('archived', 'SystemAdminController@trashed')->name('admin.trashed');
    Route::put('archived/restore/{id}', 'SystemAdminController@restore')->name('admin.restore');

});

Route::middleware('isDean', 'auth')->group(function(){

    Route::resource('dean','DeanController');
    Route::get('create/personalparticular/dean', 'DeanController@beforeEdit')->name('dean.beforeedit');
    Route::get('departments/show/allfaculty', 'DeanController@allFaculty')->name('dean.allfaculty');
    Route::get('departments', 'DeanController@departments')->name('dean.departments');
    Route::get('departments/englishstudies', 'DeanController@englishStudies')->name('dean.englishstudies');
    Route::get('departments/literatures', 'DeanController@literatures')->name('dean.literatures');
    Route::get('departments/philosophy', 'DeanController@philosophy')->name('dean.philosophy');
    Route::get('departments/economics', 'DeanController@economics')->name('dean.economics');
    Route::get('departments/foreignlanguage', 'DeanController@foreignLanguage')->name('dean.foreignlanguage');
    Route::get('departments/politicalscience', 'DeanController@politicalScience')->name('dean.politicalscience');
    Route::get('departments/sociology', 'DeanController@sociology')->name('dean.sociology');
    Route::get('departments/history', 'DeanController@history')->name('dean.history');
    Route::get('departments/commandmediastudies', 'DeanController@commAndMediStudies')->name('dean.commandmediastudies');
    Route::get('departments/interdisciplinary', 'DeanController@interdisciplinary')->name('dean.interdisciplinary');
    Route::get('changepassword/dean', 'DeanController@changePassword')->name('dean.changepassword');
    Route::put('changepassword/confirm/dean', 'DeanController@changePasswordConfirm')->name('dean.changepassword.confirm');


});

Route::middleware('isHead', 'auth')->group(function(){

    Route::resource('head','FacultyHeadController');
    Route::get('create/personalparticular/head', 'FacultyHeadController@beforeEdit')->name('head.beforeedit');
    Route::get('departmentrosters', 'FacultyHeadController@departmentRoster')->name('head.departmentrosters');
    Route::get('changepassword/head', 'FacultyHeadController@changePassword')->name('head.changepassword');
    Route::put('changepassword/confirm/head', 'FacultyHeadController@changePasswordConfirm')->name('head.changepassword.confirm');
    

});

Route::middleware('isMember', 'auth')->group(function(){

    Route::resource('member','FacultyMemberController');
    Route::get('create/personalparticular', 'FacultyMemberController@beforeEdit')->name('member.beforeedit');
    Route::get('changepassword/member', 'FacultyMemberController@changePassword')->name('member.changepassword');
    Route::put('changepassword/confirm/member', 'FacultyMemberController@changePasswordConfirm')->name('member.changepassword.confirm');
   

});

Route::middleware('auth')->group(function(){

    // For Academic Degrees
    Route::get('academic/degrees/add', 'CurriculumVitaeController@addAcademicDegrees')->name('add.academic');
    Route::post('academic/degrees/store', 'CurriculumVitaeController@storeAcademicDegrees')->name('store.academic');
    Route::get('academic/degrees', 'CurriculumVitaeController@beforeEditAcademicDegrees')->name('beforeedit.academic');
    Route::get('academic/degrees/{id}/edit', 'CurriculumVitaeController@editAcademicDegrees')->name('edit.academic');
    Route::put('academic/degrees/{id}/update', 'CurriculumVitaeController@updateAcademicDegrees')->name('update.academic');
    Route::delete('academic/degrees/{id}/delete', 'CurriculumVitaeController@deleteAcademicDegrees')->name('delete.academic');
    

    // For Present Academic Status
    Route::get('present/academic/status/add', 'CurriculumVitaeController@addPresentAcademicStatus')->name('add.academic.present');
    Route::post('present/academic/status/store', 'CurriculumVitaeController@storePresentAcademicStatus')->name('store.academic.present');
    Route::get('present/academic/status/edit', 'CurriculumVitaeController@beforeEditPresentAcademicStatus')->name('beforeedit.academic.present');
    Route::get('present/academic/status/{id}/edit', 'CurriculumVitaeController@editPresentAcademicStatus')->name('edit.academic.present');
    Route::put('present/academic/status/{id}/update', 'CurriculumVitaeController@updatePresentAcademicStatus')->name('update.academic.present');
    Route::delete('present/academic/status/{id}/delete', 'CurriculumVitaeController@deletePresentAcademicStatus')->name('delete.academic.present');
    

    // For Employment History
    Route::get('employment/history/edit', 'CurriculumVitaeController@beforeEditEmploymentHistory')->name('beforeedit.employmenthistory');

    Route::get('employment/history/teachingexperience/add', 'CurriculumVitaeController@addEmploymentHistoryTeachingExperience')->name('add.employmenthistory.teachingexperience');
    Route::post('employment/history/teachingexperience/store', 'CurriculumVitaeController@storeEmploymentHistoryTeachingExperience')->name('store.employmenthistory.teachingexperience');
    Route::get('employment/history/teachingexperience/{id}/edit', 'CurriculumVitaeController@editEmploymentHistoryTeachingExperience')->name('edit.employmenthistory.teachingexperience');
    Route::put('employment/history/teachingexperience/{id}/update', 'CurriculumVitaeController@updateEmploymentHistoryTeachingExperience')->name('update.employmenthistory.teachingexperience');
    Route::delete('employment/history/teachingexperience/{id}/delete', 'CurriculumVitaeController@deleteEmploymentHistoryTeachingExperience')->name('delete.employmenthistory.teachingexperience');

    Route::get('employment/history/adminisexperience/add', 'CurriculumVitaeController@addEmploymentHistoryAdminisExperience')->name('add.employmenthistory.adminisexperience');
    Route::post('employment/history/adminisexperience/store', 'CurriculumVitaeController@storeEmploymentHistoryAdminisExperience')->name('store.employmenthistory.adminisexperience');
    Route::get('employment/history/adminisexperience/{id}/edit', 'CurriculumVitaeController@editEmploymentHistoryAdminisExperience')->name('edit.employmenthistory.adminisexperience');
    Route::put('employment/history/adminisexperience/{id}/update', 'CurriculumVitaeController@updateEmploymentHistoryAdminisExperience')->name('update.employmenthistory.adminisexperience');
    Route::delete('employment/history/adminisexperience/{id}/delete', 'CurriculumVitaeController@deleteEmploymentHistoryAdminisExperience')->name('delete.employmenthistory.adminisexperience');

    Route::get('employment/history/profpracoutteaching/add', 'CurriculumVitaeController@addEmploymentHistoryProfPracOutTeaching')->name('add.employmenthistory.profpracoutteaching');
    Route::post('employment/history/profpracoutteaching/store', 'CurriculumVitaeController@storeEmploymentHistoryProfPracOutTeaching')->name('store.employmenthistory.profpracoutteaching');
    Route::get('employment/history/profpracoutteaching/{id}/edit', 'CurriculumVitaeController@editEmploymentHistoryProfPracOutTeaching')->name('edit.employmenthistory.profpracoutteaching');
    Route::put('employment/history/profpracoutteaching/{id}/update', 'CurriculumVitaeController@updateEmploymentHistoryProfPracOutTeaching')->name('update.employmenthistory.profpracoutteaching');
    Route::delete('employment/history/profpracoutteaching/{id}/delete', 'CurriculumVitaeController@deleteEmploymentHistoryProfPracOutTeaching')->name('delete.employmenthistory.profpracoutteaching');

    Route::get('employment/history/exchangeprogram/add', 'CurriculumVitaeController@addEmploymentHistoryExchangeProgram')->name('add.employmenthistory.exchangeprogram');
    Route::post('employment/history/exchangeprogram/store', 'CurriculumVitaeController@storeEmploymentHistoryExchangeProgram')->name('store.employmenthistory.exchangeprogram');
    Route::get('employment/history/exchangeprogram/{id}/edit', 'CurriculumVitaeController@editEmploymentHistoryExchangeProgram')->name('edit.employmenthistory.exchangeprogram');
    Route::put('employment/history/exchangeprogram/{id}/update', 'CurriculumVitaeController@updateEmploymentHistoryExchangeProgram')->name('update.employmenthistory.exchangeprogram');
    Route::delete('employment/history/exchangeprogram/{id}/delete', 'CurriculumVitaeController@deleteEmploymentHistoryExchangeProgram')->name('delete.employmenthistory.exchangeprogram');

    // For Non-degree training
    Route::get('nondegree/traning/edit', 'CurriculumVitaeController@beforeEditNonDegreeTraining')->name('beforeedit.nondegreetraining');

    Route::get('nondegree/seminarworkshops/add', 'CurriculumVitaeController@addNonDegreeSeminarWorkshops')->name('add.nondegree.seminarworkshops');
    Route::post('nondegree/seminarworkshops/store', 'CurriculumVitaeController@storeNonDegreeSeminarWorkshops')->name('store.nondegree.seminarworkshops');
    Route::get('nondegree/seminarworkshops/{id}/edit', 'CurriculumVitaeController@editNonDegreeSeminarWorkshops')->name('edit.nondegree.seminarworkshops');
    Route::put('nondegree/seminarworkshops/{id}/update', 'CurriculumVitaeController@updateNonDegreeSeminarWorkshops')->name('update.nondegree.seminarworkshops');
    Route::delete('nondegree/seminarworkshops/{id}/delete', 'CurriculumVitaeController@deleteNonDegreeSeminarWorkshops')->name('delete.nondegree.seminarworkshops');

    Route::get('nondegree/culturaleducationaltravel/add', 'CurriculumVitaeController@addNonDegreeCulturalEducationTravel')->name('add.nondegree.culturaleducationaltravel');
    Route::post('nondegree/culturaleducationaltravel/store', 'CurriculumVitaeController@storeNonDegreeCulturalEducationTravel')->name('store.nondegree.culturaleducationaltravel');
    Route::get('nondegree/culturaleducationaltravel/{id}/edit', 'CurriculumVitaeController@editNonDegreeCulturalEducationTravel')->name('edit.nondegree.culturaleducationaltravel');
    Route::put('nondegree/culturaleducationaltravel/{id}/update', 'CurriculumVitaeController@updateNonDegreeCulturalEducationTravel')->name('update.nondegree.culturaleducationaltravel');
    Route::delete('nondegree/culturaleducationaltravel/{id}/delete', 'CurriculumVitaeController@deleteNonDegreeCulturalEducationTravel')->name('delete.nondegree.culturaleducationaltravel');

    //For Research and Creative Works
    Route::get('researchcreativeworks/edit', 'CurriculumVitaeController@beforeEditResearchCreativeWork')->name('beforeedit.researchcreativeworks');

    Route::get('research/scholar/published/refer/add', 'CurriculumVitaeController@addResearchScholarPubRefer')->name('add.research.scholar.pub.refer');
    Route::post('research/scholar/published/refer/store', 'CurriculumVitaeController@storeResearchScholarPubRefer')->name('store.research.scholar.pub.refer');
    Route::get('research/scholar/published/refer/{id}/edit', 'CurriculumVitaeController@editResearchScholarPubRefer')->name('edit.research.scholar.pub.refer');
    Route::put('research/scholar/published/refer/{id}/update', 'CurriculumVitaeController@updateResearchScholarPubRefer')->name('update.research.scholar.pub.refer');
    Route::delete('research/scholar/published/refer/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarPubRefer')->name('delete.research.scholar.pub.refer');

    Route::get('research/scholar/published/nonrefer/add', 'CurriculumVitaeController@addResearchScholarPubNonRefer')->name('add.research.scholar.pub.nonrefer');
    Route::post('research/scholar/published/nonrefer/store', 'CurriculumVitaeController@storeResearchScholarPubNonRefer')->name('store.research.scholar.pub.nonrefer');
    Route::get('research/scholar/published/nonrefer/{id}/edit', 'CurriculumVitaeController@editResearchScholarPubNonRefer')->name('edit.research.scholar.pub.nonrefer');
    Route::put('research/scholar/published/nonrefer/{id}/update', 'CurriculumVitaeController@updateResearchScholarPubNonRefer')->name('update.research.scholar.pub.nonrefer');
    Route::delete('research/scholar/published/nonrefer/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarPubNonRefer')->name('delete.research.scholar.pub.nonrefer');

    Route::get('research/scholar/fullbook/add', 'CurriculumVitaeController@addResearchScholarFullBook')->name('add.research.scholar.fullbook');
    Route::post('research/scholar/fullbook/store', 'CurriculumVitaeController@storeResearchScholarFullBook')->name('store.research.scholar.fullbook');
    Route::get('research/scholar/fullbook/{id}/edit', 'CurriculumVitaeController@editResearchScholarFullBook')->name('edit.research.scholar.fullbook');
    Route::put('research/scholar/fullbook/{id}/update', 'CurriculumVitaeController@updateResearchScholarFullBook')->name('update.research.scholar.fullbook');
    Route::delete('research/scholar/fullbook/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarFullBook')->name('delete.research.scholar.fullbook');

    Route::get('research/scholar/prenonscribed/pubbook/add', 'CurriculumVitaeController@addResearchScholarPreNonScribedPubBook')->name('add.research.scholar.prenonscribed.pubbook');
    Route::post('research/scholar/prenonscribed/pubbook/store', 'CurriculumVitaeController@storeResearchScholarPreNonScribedPubBook')->name('store.research.scholar.prenonscribed.pubbook');
    Route::get('research/scholar/prenonscribed/pubbook/{id}/edit', 'CurriculumVitaeController@editResearchScholarPreNonScribedPubBook')->name('edit.research.scholar.prenonscribed.pubbook');
    Route::put('research/scholar/prenonscribed/pubbook/{id}/update', 'CurriculumVitaeController@updateResearchScholarPreNonScribedPubBook')->name('update.research.scholar.prenonscribed.pubbook');
    Route::delete('research/scholar/prenonscribed/pubbook/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarPreNonScribedPubBook')->name('delete.research.scholar.prenonscribed.pubbook');

    Route::get('research/scholar/profjournal/add', 'CurriculumVitaeController@addResearchScholarProfJournal')->name('add.research.scholar.profjournal');
    Route::post('research/scholar/profjournal/store', 'CurriculumVitaeController@storeResearchScholarProfJournal')->name('store.research.scholar.profjournal');
    Route::get('research/scholar/profjournal/{id}/edit', 'CurriculumVitaeController@editResearchScholarProfJournal')->name('edit.nresearch.scholar.profjournal');
    Route::put('research/scholar/profjournal/{id}/update', 'CurriculumVitaeController@updateResearchScholarProfJournal')->name('update.research.scholar.profjournal');
    Route::delete('research/scholar/profjournal/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarProfJournal')->name('delete.research.scholar.profjournal');

    Route::get('research/scholar/locjournal/add', 'CurriculumVitaeController@addResearchScholarLocJournal')->name('add.research.scholar.locjournal');
    Route::post('research/scholar/locjournal/store', 'CurriculumVitaeController@storeResearchScholarLocJournal')->name('store.research.scholar.locjournal');
    Route::get('research/scholar/locjournal/{id}/edit', 'CurriculumVitaeController@editResearchScholarLocJournal')->name('edit.research.scholar.locjournal');
    Route::put('research/scholar/locjournal/{id}/update', 'CurriculumVitaeController@updateResearchScholarLocJournal')->name('update.research.scholar.locjournal');
    Route::delete('research/scholar/locjournal/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarLocJournal')->name('delete.research.scholar.locjournal');

    Route::get('research/scholar/delpubpaper/add', 'CurriculumVitaeController@addResearchScholarDelPubPaper')->name('add.research.scholar.delpubpaper');
    Route::post('research/scholar/delpubpaper/store', 'CurriculumVitaeController@storeResearchScholarDelPubPaper')->name('store.research.scholar.delpubpaper');
    Route::get('research/scholar/delpubpaper/{id}/edit', 'CurriculumVitaeController@editResearchScholarDelPubPaper')->name('edit.research.scholar.delpubpaper');
    Route::put('research/scholar/delpubpaper/{id}/update', 'CurriculumVitaeController@updateResearchScholarDelPubPaper')->name('update.research.scholar.delpubpaper');
    Route::delete('research/scholar/delpubpaper/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarDelPubPaper')->name('delete.research.scholar.delpubpaper');

    Route::get('research/scholar/commcompresearch/add', 'CurriculumVitaeController@addResearchScholarCommCompResearch')->name('add.research.scholar.commcompresearch');
    Route::post('research/scholar/commcompresearch/store', 'CurriculumVitaeController@storeResearchScholarCommCompResearch')->name('store.research.scholar.commcompresearch');
    Route::get('research/scholar/commcompresearch/{id}/edit', 'CurriculumVitaeController@editResearchScholarCommCompResearch')->name('edit.research.scholar.commcompresearch');
    Route::put('research/scholar/commcompresearch/{id}/update', 'CurriculumVitaeController@updateResearchScholarCommCompResearch')->name('update.research.scholar.commcompresearch');
    Route::delete('research/scholar/commcompresearch/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarCommCompResearch')->name('delete.research.scholar.commcompresearch');

    Route::get('research/scholar/researchposter/add', 'CurriculumVitaeController@addResearchScholarResearchPoster')->name('add.research.scholar.researchposter');
    Route::post('research/scholar/researchposter/store', 'CurriculumVitaeController@storeResearchScholarResearchPoster')->name('store.research.scholar.researchposter');
    Route::get('research/scholar/researchposter/{id}/edit', 'CurriculumVitaeController@editResearchScholarResearchPoster')->name('edit.research.scholar.researchposter');
    Route::put('research/scholar/researchposter/{id}/update', 'CurriculumVitaeController@updateResearchScholarResearchPoster')->name('update.research.scholar.researchposter');
    Route::delete('research/scholar/researchposter/{id}/delete', 'CurriculumVitaeController@deleteResearchScholarResearchPoster')->name('delete.research.scholar.researchposter');

    Route::get('research/creative/distperfart/add', 'CurriculumVitaeController@addResearchCreativeDistPerfArt')->name('add.research.creative.distperfart');
    Route::post('research/creative/distperfart/store', 'CurriculumVitaeController@storeResearchCreativeDistPerfArt')->name('store.research.creative.distperfart');
    Route::get('research/creative/distperfart/{id}/edit', 'CurriculumVitaeController@editResearchCreativeDistPerfArt')->name('edit.research.creative.distperfart');
    Route::put('research/creative/distperfart/{id}/update', 'CurriculumVitaeController@updateResearchCreativeDistPerfArt')->name('update.research.creative.distperfart');
    Route::delete('research/creative/distperfart/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeDistPerfArt')->name('delete.research.creative.distperfart');

    Route::get('research/creative/origmusicwork/add', 'CurriculumVitaeController@addResearchCreativeOrigMusicalWork')->name('add.research.creative.origmusicwork');
    Route::post('research/creative/origmusicwork/store', 'CurriculumVitaeController@storeResearchCreativeOrigMusicalWork')->name('store.research.creative.origmusicwork');
    Route::get('research/creative/origmusicwork/{id}/edit', 'CurriculumVitaeController@editResearchCreativeOrigMusicalWork')->name('edit.research.creative.origmusicwork');
    Route::put('research/creative/origmusicwork/{id}/update', 'CurriculumVitaeController@updateResearchCreativeOrigMusicalWork')->name('update.research.creative.origmusicwork');
    Route::delete('research/creative/origmusicwork/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeOrigMusicalWork')->name('delete.research.creative.origmusicwork');

    Route::get('research/creative/origdesign/add', 'CurriculumVitaeController@addResearchCreativeOrigDesign')->name('add.research.creative.origdesign');
    Route::post('research/creative/origdesign/store', 'CurriculumVitaeController@storeResearchCreativeOrigDesign')->name('store.research.creative.origdesign');
    Route::get('research/creative/origdesign/{id}/edit', 'CurriculumVitaeController@editResearchCreativeOrigDesign')->name('edit.research.creative.origdesign');
    Route::put('research/creative/origdesign/{id}/update', 'CurriculumVitaeController@updateResearchCreativeOrigDesign')->name('update.research.creative.origdesign');
    Route::delete('research/creative/origdesign/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeOrigDesign')->name('delete.research.creative.origdesign');

    Route::get('research/creative/litwork/add', 'CurriculumVitaeController@addResearchCreativeLitWork')->name('add.research.creative.litwork');
    Route::post('research/creative/litwork/store', 'CurriculumVitaeController@storeResearchCreativeLitWork')->name('store.research.creative.litwork');
    Route::get('research/creative/litwork/{id}/edit', 'CurriculumVitaeController@editResearchCreativeLitWork')->name('edit.research.creative.litwork');
    Route::put('research/creative/litwork/{id}/update', 'CurriculumVitaeController@updateResearchCreativeLitWork')->name('update.research.creative.litwork');
    Route::delete('research/creative/litwork/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeLitWork')->name('delete.research.creative.litwork');

    Route::get('research/creative/exartwork/add', 'CurriculumVitaeController@addResearchCreativeExArtWork')->name('add.research.creative.exartwork');
    Route::post('research/creative/exartwork/store', 'CurriculumVitaeController@storeResearchCreativeExArtWork')->name('store.research.creative.exartwork');
    Route::get('research/creative/exartwork/{id}/edit', 'CurriculumVitaeController@editResearchCreativeExArtWork')->name('edit.research.creative.exartwork');
    Route::put('research/creative/exartwork/{id}/update', 'CurriculumVitaeController@updateResearchCreativeExArtWork')->name('update.research.creative.exartwork');
    Route::delete('research/creative/exartwork/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeExArtWork')->name('delete.research.creative.exartwork');

    Route::get('research/creative/gencirculation/add', 'CurriculumVitaeController@addResearchCreativeGenCirculation')->name('add.research.creative.gencirculation');
    Route::post('research/creative/gencirculation/store', 'CurriculumVitaeController@storeResearchCreativeGenCirculation')->name('store.research.creative.gencirculation');
    Route::get('research/creative/gencirculation/{id}/edit', 'CurriculumVitaeController@editResearchCreativeGenCirculation')->name('edit.research.creative.gencirculation');
    Route::put('research/creative/gencirculation/{id}/update', 'CurriculumVitaeController@updateResearchCreativeGenCirculation')->name('update.research.creative.gencirculation');
    Route::delete('research/creative/gencirculation/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeGenCirculation')->name('delete.research.creative.gencirculation');

    Route::get('research/creative/aidteach/matprod/coursemodule/add', 'CurriculumVitaeController@addResearchCreativeAidTechMatProdCourseModule')->name('add.research.creative.aidtech.matprod.coursemodule');
    Route::post('research/creative/aidteach/matprod/coursemodule/store', 'CurriculumVitaeController@storeResearchCreativeAidTechMatProdCourseModule')->name('store.research.creative.aidtech.matprod.coursemodule');
    Route::get('research/creative/aidteach/matprod/coursemodule/{id}/edit', 'CurriculumVitaeController@editResearchCreativeAidTechMatProdCourseModule')->name('edit.research.creative.aidtech.matprod.coursemodule');
    Route::put('research/creative/aidteach/matprod/coursemodule/{id}/update', 'CurriculumVitaeController@updateResearchCreativeAidTechMatProdCourseModule')->name('update.research.creative.aidtech.matprod.coursemodule');
    Route::delete('research/creative/aidteach/matprod/coursemodule/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeAidTechMatProdCourseModule')->name('delete.research.creative.aidtech.matprod.coursemodule');

    Route::get('research/creative/aidteach/matprod/onlinecourses/add', 'CurriculumVitaeController@addResearchCreativeAidTechMatProdOnlineCourse')->name('add.research.creative.aidtech.matprod.onlinecourse');
    Route::post('research/creative/aidteach/matprod/onlinecourses/store', 'CurriculumVitaeController@storeResearchCreativeAidTechMatProdOnlineCourse')->name('store.research.creative.aidtech.matprod.onlinecourse');
    Route::get('research/creative/aidteach/matprod/onlinecourses/{id}/edit', 'CurriculumVitaeController@editResearchCreativeAidTechMatProdOnlineCourse')->name('edit.research.creative.aidtech.matprod.onlinecourse');
    Route::put('research/creative/aidteach/matprod/onlinecourses/{id}/update', 'CurriculumVitaeController@updateResearchCreativeAidTechMatProdOnlineCourse')->name('update.research.creative.aidtech.matprod.onlinecourse');
    Route::delete('research/creative/aidteach/matprod/onlinecourses/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeAidTechMatProdOnlineCourse')->name('delete.research.creative.aidtech.matprod.onlinecourse');

    Route::get('research/creative/aidteach/matprod/manual/add', 'CurriculumVitaeController@addResearchCreativeAidTechMatProdManual')->name('add.research.creative.aidtech.matprod.manual');
    Route::post('research/creative/aidteach/matprod/manual/store', 'CurriculumVitaeController@storeResearchCreativeAidTechMatProdManual')->name('store.research.creative.aidtech.matprod.manual');
    Route::get('research/creative/aidteach/matprod/manual/{id}/edit', 'CurriculumVitaeController@editResearchCreativeAidTechMatProdManual')->name('edit.research.creative.aidtech.matprod.manual');
    Route::put('research/creative/aidteach/matprod/manual/{id}/update', 'CurriculumVitaeController@updateResearchCreativeAidTechMatProdManual')->name('update.research.creative.aidtech.matprod.manual');
    Route::delete('research/creative/aidteach/matprod/manual/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeAidTechMatProdManual')->name('delete.research.creative.aidtech.matprod.manual');

    Route::get('research/creative/aidteach/techaid/add', 'CurriculumVitaeController@addResearchCreativeAidTechTechAid')->name('add.research.creative.aidtech.techaid');
    Route::post('research/creative/aidteach/aidtech/store', 'CurriculumVitaeController@storeResearchCreativeAidTechTechAid')->name('store.research.creative.aidtech.techaid');
    Route::get('research/creative/aidteach/aidtech/{id}/edit', 'CurriculumVitaeController@editResearchCreativeAidTechTechAid')->name('edit.research.creative.aidtech.techaid');
    Route::put('research/creative/aidteach/aidtech/{id}/update', 'CurriculumVitaeController@updateResearchCreativeAidTechTechAid')->name('update.research.creative.aidtech.techaid');
    Route::delete('research/creative/aidteach/aidtech/{id}/delete', 'CurriculumVitaeController@deleteResearchCreativeAidTechTechAid')->name('delete.research.creative.aidtech.techaid');

    //For Community Extension Service
    Route::get('comm/extservice/commservice/devunivinitiate/edit', 'CurriculumVitaeController@beforeEditCommExtService')->name('beforeedit.communityextensionservice');

    Route::get('comm/extservice/commservice/devunivinitiate/add', 'CurriculumVitaeController@addCommExtServiceCommServiceDevUniv')->name('add.commextservicecommservice.devuniv');
    Route::post('comm/extservice/commservice/devunivinitiate/store', 'CurriculumVitaeController@storeCommExtServiceCommServiceDevUniv')->name('store.commextservicecommservice.devuniv');
    Route::get('comm/extservice/commservice/devunivinitiate/{id}/edit', 'CurriculumVitaeController@editCommExtServiceCommServiceDevUniv')->name('edit.commextservicecommservice.devuniv');
    Route::put('comm/extservice/commservice/devunivinitiate/{id}/update', 'CurriculumVitaeController@updateCommExtServiceCommServiceDevUniv')->name('update.commextservicecommservice.devuniv');
    Route::delete('comm/extservice/commservice/devunivinitiate/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceCommServiceDevUniv')->name('delete.commextservicecommservice.devuniv');

    Route::get('comm/extservice/commservice/devextinitiate/add', 'CurriculumVitaeController@addExtServiceCommServiceDevExt')->name('add.commextservicecommservice.devext');
    Route::post('comm/extservice/commservice/devextinitiate/store', 'CurriculumVitaeController@storeExtServiceCommServiceDevExt')->name('store.commextservicecommservice.devext');
    Route::get('comm/extservice/commservice/devextinitiate/{id}/edit', 'CurriculumVitaeController@editExtServiceCommServiceDevExt')->name('edit.commextservicecommservice.devext');
    Route::put('comm/extservice/commservice/devextinitiate/{id}/update', 'CurriculumVitaeController@updateExtServiceCommServiceDevExt')->name('update.commextservicecommservice.devext');
    Route::delete('comm/extservice/commservice/devextinitiate/{id}/delete', 'CurriculumVitaeController@deleteExtServiceCommServiceDevExt')->name('delete.commextservicecommservice.devext');

    Route::get('comm/extservice/commservice/humanunivinitiate/add', 'CurriculumVitaeController@addCommExtServiceCommServiceHumanUniv')->name('add.commextservicecommservice.humanuniv');
    Route::post('comm/extservice/commservice/humanunivinitiate/store', 'CurriculumVitaeController@storeCommExtServiceCommServiceHumanUniv')->name('store.commextservicecommservice.humanuniv');
    Route::get('comm/extservice/commservice/humanunivinitiate/{id}/edit', 'CurriculumVitaeController@editCommExtServiceCommServiceHumanUniv')->name('edit.commextservicecommservice.humanuniv');
    Route::put('comm/extservice/commservice/humanunivinitiate/{id}/update', 'CurriculumVitaeController@updateCommExtServiceCommServiceHumanUniv')->name('update.commextservicecommservice.humanuniv');
    Route::delete('comm/extservice/commservice/humanunivinitiate/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceCommServiceHumanUniv')->name('delete.commextservicecommservice.humanuniv');

    Route::get('comm/extservice/commservice/humanextinitiate/add', 'CurriculumVitaeController@addCommExtServiceCommServiceHumanExt')->name('add.commextservicecommservice.humanext');
    Route::post('comm/extservice/commservice/humanextinitiate/store', 'CurriculumVitaeController@storeCommExtServiceCommServiceHumanExt')->name('store.commextservicecommservice.humanext');
    Route::get('comm/extservice/commservice/humanextinitiate/{id}/edit', 'CurriculumVitaeController@editCommExtServiceCommServiceHumanExt')->name('edit.commextservicecommservice.humanext');
    Route::put('comm/extservice/commservice/humanextinitiate/{id}/update', 'CurriculumVitaeController@updateCommExtServiceCommServiceHumanExt')->name('update.commextservicecommservice.humanext');
    Route::delete('comm/extservice/commservice/humanextinitiate/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceCommServiceHumanExt')->name('delete.commextservicecommservice.humanext');

    Route::get('comm/extservice/commservice/advounivinitiate/add', 'CurriculumVitaeController@addCommExtServiceCommServiceAdvoUniv')->name('add.commextservicecommservice.advouniv');
    Route::post('comm/extservice/commservice/advounivinitiate/store', 'CurriculumVitaeController@storeCommExtServiceCommServiceAdvoUniv')->name('store.commextservicecommservice.advouniv');
    Route::get('comm/extservice/commservice/advounivinitiate/{id}/edit', 'CurriculumVitaeController@editCommExtServiceCommServiceAdvoUniv')->name('edit.commextservicecommservice.advouniv');
    Route::put('comm/extservice/commservice/advounivinitiate/{id}/update', 'CurriculumVitaeController@updateCommExtServiceCommServiceAdvoUniv')->name('update.commextservicecommservice.advouniv');
    Route::delete('comm/extservice/commservice/advounivinitiate/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceCommServiceAdvoUniv')->name('delete.commextservicecommservice.advouniv');

    Route::get('comm/extservice/commservice/advoextinitiate/add', 'CurriculumVitaeController@addCommExtServiceCommServiceAdvoExt')->name('add.commextservicecommservice.advoext');
    Route::post('comm/extservice/commservice/advoextinitiate/store', 'CurriculumVitaeController@storeCommExtServiceCommServiceAdvoExt')->name('store.commextservicecommservice.advoext');
    Route::get('comm/extservice/commservice/advoextinitiate/{id}/edit', 'CurriculumVitaeController@editCommExtServiceCommServiceAdvoExt')->name('edit.commextservicecommservice.advoext');
    Route::put('comm/extservice/commservice/advoextinitiate/{id}/update', 'CurriculumVitaeController@updateCommExtServiceCommServiceAdvoExt')->name('update.commextservicecommservice.advoext');
    Route::delete('comm/extservice/commservice/advoextinitiate/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceCommServiceAdvoExt')->name('delete.commextservicecommservice.advoext');

    Route::get('comm/extservice/extservice/seminar/add', 'CurriculumVitaeController@addCommExtServiceSeminar')->name('add.commextserviceextservice.seminar');
    Route::post('comm/extservice/extservice/seminar/store', 'CurriculumVitaeController@storeCommExtServiceSeminar')->name('store.commextserviceextservice.seminar');
    Route::get('comm/extservice/extservice/seminar/{id}/edit', 'CurriculumVitaeController@editCommExtServiceSeminar')->name('edit.commextserviceextservice.seminar');
    Route::put('comm/extservice/extservice/seminar/{id}/update', 'CurriculumVitaeController@updateCommExtServiceSeminar')->name('update.commextserviceextservice.seminar');
    Route::delete('comm/extservice/extservice/seminar/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceSeminar')->name('delete.commextserviceextservice.seminar');

    Route::get('comm/extservice/extservice/profstandinternational/add', 'CurriculumVitaeController@addCommExtServiceProfStandOffInternational')->name('add.commextserviceextservice.profstandoff.international');
    Route::post('comm/extservice/extservice/profstandinternational/store', 'CurriculumVitaeController@storeCommExtServiceProfStandOffInternational')->name('store.commextserviceextservice.profstandoff.international');
    Route::get('comm/extservice/extservice/profstandinternational/{id}/edit', 'CurriculumVitaeController@editCommExtServiceProfStandOffInternational')->name('edit.commextserviceextservice.profstandoff.international');
    Route::put('comm/extservice/extservice/profstandinternational/{id}/update', 'CurriculumVitaeController@updateCommExtServiceProfStandOffInternational')->name('update.commextserviceextservice.profstandoff.international');
    Route::delete('comm/extservice/extservice/profstandinternational/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceProfStandOffInternational')->name('delete.commextserviceextservice.profstandoff.international');

    Route::get('comm/extservice/extservice/profstandnational/add', 'CurriculumVitaeController@addCommExtServiceProfStandOffNational')->name('add.commextserviceextservice.profstandoff.national');
    Route::post('comm/extservice/extservice/profstandnational/store', 'CurriculumVitaeController@storeCommExtServiceProfStandOffNational')->name('store.commextserviceextservice.profstandoff.national');
    Route::get('comm/extservice/extservice/profstandnational/{id}/edit', 'CurriculumVitaeController@editCommExtServiceProfStandOffNational')->name('edit.commextserviceextservice.profstandoff.national');
    Route::put('comm/extservice/extservice/profstandnational/{id}/update', 'CurriculumVitaeController@updateCommExtServiceProfStandOffNational')->name('update.commextserviceextservice.profstandoff.national');
    Route::delete('comm/extservice/extservice/profstandnational/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceProfStandOffNational')->name('delete.commextserviceextservice.profstandoff.national');

    Route::get('comm/extservice/extservice/profstandacadinternational/add', 'CurriculumVitaeController@addCommExtServiceProfStandOffAcadInternational')->name('add.commextserviceextservice.profstandoffacad.international');
    Route::post('comm/extservice/extservice/profstandacadinternational/store', 'CurriculumVitaeController@storeCommExtServiceProfStandOffAcadInternational')->name('store.commextserviceextservice.profstandoffacad.international');
    Route::get('comm/extservice/extservice/profstandacadinternational/{id}/edit', 'CurriculumVitaeController@editCommExtServiceProfStandOffAcadInternational')->name('edit.commextserviceextservice.profstandoffacad.international');
    Route::put('comm/extservice/extservice/profstandacadinternational/{id}/update', 'CurriculumVitaeController@updateCommExtServiceProfStandOffAcadInternational')->name('update.commextserviceextservice.profstandoffacad.international');
    Route::delete('comm/extservice/extservice/profstandacadinternational/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceProfStandOffAcadInternational')->name('delete.commextserviceextservice.profstandoffacad.international');

    Route::get('comm/extservice/extservice/profstandacadnational/add', 'CurriculumVitaeController@addCommExtServiceProfStandOffAcadNational')->name('add.commextserviceextservice.profstandoffacad.national');
    Route::post('comm/extservice/extservice/profstandacadnational/store', 'CurriculumVitaeController@storeCommExtServiceProfStandOffAcadNational')->name('store.commextserviceextservice.profstandoffacad.national');
    Route::get('comm/extservice/extservice/profstandacadnational/{id}/edit', 'CurriculumVitaeController@editCommExtServiceProfStandOffAcadNational')->name('edit.commextserviceextservice.profstandoffacad.national');
    Route::put('comm/extservice/extservice/profstandacadnational/{id}/update', 'CurriculumVitaeController@updateCommExtServiceProfStandOffAcadNational')->name('update.commextserviceextservice.profstandoffacad.national');
    Route::delete('comm/extservice/extservice/profstandacadnational/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceProfStandOffAcadNational')->name('delete.commextserviceextservice.profstandoffacad.national');

    Route::get('comm/extservice/extservice/manworkgovernment/add', 'CurriculumVitaeController@addCommExtServiceManWorkGovernment')->name('add.commextserviceextservice.manwork.government');
    Route::post('comm/extservice/extservice/manworkgovernment/store', 'CurriculumVitaeController@storeCommExtServiceManWorkGovernment')->name('store.commextserviceextservice.manwork.government');
    Route::get('comm/extservice/extservice/manworkgovernment/{id}/edit', 'CurriculumVitaeController@editCommExtServiceManWorkGovernment')->name('edit.commextserviceextservice.manwork.government');
    Route::put('comm/extservice/extservice/manworkgovernment/{id}/update', 'CurriculumVitaeController@updateCommExtServiceManWorkGovernment')->name('update.commextserviceextservice.manwork.government');
    Route::delete('comm/extservice/extservice/manworkgovernment/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceManWorkGovernment')->name('delete.commextserviceextservice.manwork.government');

    Route::get('comm/extservice/extservice/manworkprivate/add', 'CurriculumVitaeController@addCommExtServiceManWorkPrivate')->name('add.commextserviceextservice.manwork.private');
    Route::post('comm/extservice/extservice/manworkprivate/store', 'CurriculumVitaeController@storeCommExtServiceManWorkPrivate')->name('store.commextserviceextservice.manwork.private');
    Route::get('comm/extservice/extservice/manworkprivate/{id}/edit', 'CurriculumVitaeController@editCommExtServiceManWorkPrivate')->name('edit.commextserviceextservice.manwork.private');
    Route::put('comm/extservice/extservice/manworkprivate/{id}/update', 'CurriculumVitaeController@updateCommExtServiceManWorkPrivate')->name('update.commextserviceextservice.manwork.private');
    Route::delete('comm/extservice/extservice/manworkprivate/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceManWorkPrivate')->name('delete.commextserviceextservice.manwork.private');

    Route::get('comm/extservice/extservice/manworksenior/add', 'CurriculumVitaeController@addCommExtServiceManWorkSenior')->name('add.commextserviceextservice.manwork.senior');
    Route::post('comm/extservice/extservice/manworksenior/store', 'CurriculumVitaeController@storeCommExtServiceManWorkSenior')->name('store.commextserviceextservice.manwork.senior');
    Route::get('comm/extservice/extservice/manworksenior/{id}/edit', 'CurriculumVitaeController@editCommExtServiceManWorkSenior')->name('edit.commextserviceextservice.manwork.senior');
    Route::put('comm/extservice/extservice/manworksenior/{id}/update', 'CurriculumVitaeController@updateCommExtServiceManWorkSenior')->name('update.commextserviceextservice.manwork.senior');
    Route::delete('comm/extservice/extservice/manworksenior/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceManWorkSenior')->name('delete.commextserviceextservice.manwork.senior');

    Route::get('comm/extservice/extservice/consultwork/add', 'CurriculumVitaeController@addCommExtServiceConsultWork')->name('add.commextserviceextservice.consultwork');
    Route::post('comm/extservice/extservice/consultwork/store', 'CurriculumVitaeController@storeCommExtServiceConsultWork')->name('store.commextserviceextservice.consultwork');
    Route::get('comm/extservice/extservice/consultwork/{id}/edit', 'CurriculumVitaeController@editCommExtServiceConsultWork')->name('edit.commextserviceextservice.consultwork');
    Route::put('comm/extservice/extservice/consultwork/{id}/update', 'CurriculumVitaeController@updateCommExtServiceConsultWork')->name('update.commextserviceextservice.consultwork');
    Route::delete('comm/extservice/extservice/consultwork/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceConsultWork')->name('delete.commextserviceextservice.consultwork');

    Route::get('comm/extservice/extservice/guestappearance/add', 'CurriculumVitaeController@addCommExtServiceGuestAppearance')->name('add.commextserviceextservice.guestappearance');
    Route::post('comm/extservice/extservice/guestappearance/store', 'CurriculumVitaeController@storeCommExtServiceGuestAppearance')->name('store.commextserviceextservice.guestappearance');
    Route::get('comm/extservice/extservice/guestappearance/{id}/edit', 'CurriculumVitaeController@editCommExtServiceGuestAppearance')->name('edit.commextserviceextservice.guestappearance');
    Route::put('comm/extservice/extservice/guestappearance/{id}/update', 'CurriculumVitaeController@updateCommExtServiceGuestAppearance')->name('update.commextserviceextservice.guestappearance');
    Route::delete('comm/extservice/extservice/guestappearance/{id}/delete', 'CurriculumVitaeController@deleteCommExtServiceGuestAppearance')->name('delete.commextserviceextservice.guestappearance');

    //For Scholarships, Honors And/Or Awards Received
    Route::get('honorsreceived/government/edit', 'CurriculumVitaeController@beforeEditHonorsReceived')->name('beforeedit.honorsreceived');

    Route::get('honorsreceived/government/add', 'CurriculumVitaeController@addHonorsReceivedGovernment')->name('add.honorsreceived.government');
    Route::post('honorsreceived/government/store', 'CurriculumVitaeController@storeHonorsReceivedGovernment')->name('store.honorsreceived.government');
    Route::get('honorsreceived/government/{id}/edit', 'CurriculumVitaeController@editHonorsReceivedGovernment')->name('edit.honorsreceived.government');
    Route::put('honorsreceived/government/{id}/update', 'CurriculumVitaeController@updateHonorsReceivedGovernment')->name('update.honorsreceived.government');
    Route::delete('honorsreceived/government/{id}/delete', 'CurriculumVitaeController@deleteHonorsReceivedGovernment')->name('delete.honorsreceived.government');

    Route::get('honorsreceived/scholarship/add', 'CurriculumVitaeController@addHonorsReceivedScholarship')->name('add.honorsreceived.scholarship');
    Route::post('honorsreceived/scholarship/store', 'CurriculumVitaeController@storeHonorsReceivedScholarship')->name('store.honorsreceived.scholarship');
    Route::get('honorsreceived/scholarship/{id}/edit', 'CurriculumVitaeController@editHonorsReceivedScholarship')->name('edit.honorsreceived.scholarship');
    Route::put('honorsreceived/scholarship/{id}/update', 'CurriculumVitaeController@updateHonorsReceivedScholarship')->name('update.honorsreceived.scholarship');
    Route::delete('honorsreceived/scholarship/{id}/delete', 'CurriculumVitaeController@deleteHonorsReceivedScholarship')->name('delete.honorsreceived.scholarship');

    Route::get('honorsreceived/award/add', 'CurriculumVitaeController@addHonorsReceivedAward')->name('add.honorsreceived.award');
    Route::post('honorsreceived/award/store', 'CurriculumVitaeController@storeHonorsReceivedAward')->name('store.honorsreceived.award');
    Route::get('honorsreceived/award/{id}/edit', 'CurriculumVitaeController@editHonorsReceivedAward')->name('edit.honorsreceived.award');
    Route::put('honorsreceived/award/{id}/update', 'CurriculumVitaeController@updateHonorsReceivedAward')->name('update.honorsreceived.award');
    Route::delete('honorsreceived/award/{id}/delete', 'CurriculumVitaeController@deleteHonorsReceivedAward')->name('delete.honorsreceived.award');

    //For Use of Information Technology In Instructional Delivery
    Route::get('useoftechnology/edit' , 'CurriculumVitaeController@beforeEditUseOfTechnology')->name('beforeedit.useoftechnology');

    Route::get('useoftechnology/add', 'CurriculumVitaeController@addUseOfTechnology')->name('add.useoftechnology');
    Route::post('useoftechnology/store', 'CurriculumVitaeController@storeUseOfTechnology')->name('store.useoftechnology');
    Route::get('useoftechnology/{id}/edit', 'CurriculumVitaeController@editUseOfTechnology')->name('edit.useoftechnology');
    Route::put('useoftechnology/{id}/update', 'CurriculumVitaeController@updateUseOfTechnology')->name('update.useoftechnology');
    Route::delete('useoftechnology/{id}/delete', 'CurriculumVitaeController@deleteUseOfTechnology')->name('delete.useoftechnology');

    //APPROVE OR UNAPPROVE
    Route::put('academic/degrees/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveAcademicDegrees')->name('approveorunapprove.academic');
    Route::put('present/academic/status/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapprovePresentAcademicStatus')->name('approveorunapprove.academic.present');

    Route::put('employment/history/teachingexperience/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveoOrUnapproveEmploymentHistoryTeachingExperience')->name('approveorunapprove.employmenthistory.teachingexperience');
    Route::put('employment/history/administrativeexperience/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveoOrUnapproveEmploymentHistoryAdminisExperience')->name('approveorunapprove.employmenthistory.adminisexperience');
    Route::put('employment/history/profpracoutteaching/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveoOrUnapproveEmploymentHistoryProfPracOutTeaching')->name('approveorunapprove.employmenthistory.profpracoutteaching');
    Route::put('employment/history/exchangeprogram/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveoOrUnapproveEmploymentHistoryExchangeProgram')->name('approveorunapprove.employmenthistory.exchangeprogram');

    Route::put('nondegree/seminarworkshops/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveNonDegreeSeminarWorkshops')->name('approveorunapprove.nondegree.seminarworkshops');
    Route::put('nondegree/culturaleducationaltravel/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveNonDegreeCulturalEducationTravel')->name('approveorunapprove.nondegree.culturaleducationaltravel');

    Route::put('research/scholar/published/refer/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarPubRefer')->name('approveorunapprove.research.scholar.pub.refer');
    Route::put('research/scholar/published/nonrefer/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarPubNonRefer')->name('approveorunapprove.research.scholar.pub.nonrefer');
    Route::put('research/scholar/fullbook/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarFullBook')->name('approveorunapprove.research.scholar.fullbook');
    Route::put('research/scholar/prenonscribed/pubbook/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarPreNonScribedPubBook')->name('approveorunapprove.research.scholar.prenonscribed.pubbook');
    Route::put('research/scholar/profjournal/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarProfJournal')->name('approveorunapprove.research.scholar.profjournal');
    Route::put('research/scholar/locjournal/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarLocJournal')->name('approveorunapprove.research.scholar.locjournal');
    Route::put('research/scholar/delpubpaper/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarDelPubPaper')->name('approveorunapprove.research.scholar.delpubpaper');
    Route::put('research/scholar/commcompresearch/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarCommCompResearch')->name('approveorunapprove.research.scholar.commcompresearch');
    Route::put('research/scholar/researchposter/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchScholarResearchPoster')->name('approveorunapprove.research.scholar.researchposter');
    Route::put('research/creative/distperfart/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeDistPerfArt')->name('approveorunapprove.research.creative.distperfart');
    Route::put('research/creative/origmusicwork/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeOrigMusicalWork')->name('approveorunapprove.research.creative.origmusicwork');
    Route::put('research/creative/origdesign/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeOrigDesign')->name('approveorunapprove.research.creative.origdesign');
    Route::put('research/creative/litwork/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeLitWork')->name('approveorunapprove.research.creative.litwork');
    Route::put('research/creative/exartwork/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeExArtWork')->name('approveorunapprove.research.creative.exartwork');
    Route::put('research/creative/gencirculation/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeGenCirculation')->name('approveorunapprove.research.creative.gencirculation');
    Route::put('research/creative/aidteach/matprod/coursemodule/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeAidTechMatProdCourseModule')->name('approveorunapprove.research.creative.aidtech.matprod.coursemodule');
    Route::put('research/creative/aidteach/matprod/onlinecourses/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeAidTechMatProdOnlineCourse')->name('approveorunapprove.research.creative.aidtech.matprod.onlinecourse');
    Route::put('research/creative/aidteach/matprod/manual/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeAidTechMatProdManual')->name('approveorunapprove.research.creative.aidtech.matprod.manual');
    Route::put('research/creative/aidteach/aidtech/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveResearchCreativeAidTechTechAid')->name('approveorunapprove.research.creative.aidtech.techaid');

    Route::put('comm/extservice/commservice/devunivinitiate/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceCommServiceDevUniv')->name('approveorunapprove.commextservicecommservice.devuniv');
    Route::put('comm/extservice/commservice/devextinitiate/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveExtServiceCommServiceDevExt')->name('approveorunapprove.commextservicecommservice.devext');
    Route::put('comm/extservice/commservice/humanunivinitiate/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceCommServiceHumanUniv')->name('approveorunapprove.commextservicecommservice.humanuniv');
    Route::put('comm/extservice/commservice/humanextinitiate/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceCommServiceHumanExt')->name('approveorunapprove.commextservicecommservice.humanext');
    Route::put('comm/extservice/commservice/advounivinitiate/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceCommServiceAdvoUniv')->name('approveorunapprove.commextservicecommservice.advouniv');
    Route::put('comm/extservice/commservice/advoextinitiate/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceCommServiceAdvoExt')->name('approveorunapprove.commextservicecommservice.advoext');
    Route::put('comm/extservice/extservice/seminar/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceSeminar')->name('approveorunapprove.commextserviceextservice.seminar');
    Route::put('comm/extservice/extservice/profstandinternational/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceProfStandOffInternational')->name('approveorunapprove.commextserviceextservice.profstandoff.international');
    Route::put('comm/extservice/extservice/profstandnational/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceProfStandOffNational')->name('approveorunapprove.commextserviceextservice.profstandoff.national');
    Route::put('comm/extservice/extservice/profstandacadinternational/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceProfStandOffAcadInternational')->name('approveorunapprove.commextserviceextservice.profstandoffacad.international');
    Route::put('comm/extservice/extservice/profstandacadnational/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceProfStandOffAcadNational')->name('approveorunapprove.commextserviceextservice.profstandoffacad.national');
    Route::put('comm/extservice/extservice/manworkgovernment/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceManWorkGovernment')->name('approveorunapprove.commextserviceextservice.manwork.government');
    Route::put('comm/extservice/extservice/manworkprivate/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceManWorkPrivate')->name('approveorunapprove.commextserviceextservice.manwork.private');
    Route::put('comm/extservice/extservice/manworksenior/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceManWorkSenior')->name('approveorunapprove.commextserviceextservice.manwork.senior');
    Route::put('comm/extservice/extservice/consultwork/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceConsultWork')->name('approveorunapprove.commextserviceextservice.consultwork');
    Route::put('comm/extservice/extservice/guestappearance/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveCommExtServiceGuestAppearance')->name('updaapproveorunapprovete.commextserviceextservice.guestappearance');

    Route::put('honorsreceived/government/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveHonorsReceivedGovernment')->name('updaapproveorunapprovete.honorsreceived.government');
    Route::put('honorsreceived/scholarship/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveHonorsReceivedScholarship')->name('updaapproveorunapprovete.honorsreceived.scholarship');
    Route::put('honorsreceived/award/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveHonorsReceivedAward')->name('updaapproveorunapprovete.honorsreceived.award');

    Route::put('useoftechnology/{id}/approveorunapprove/member', 'CurriculumVitaeController@approveOrUnapproveUseOfTechnology')->name('updaapproveorunapprovete.useoftechnology');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
