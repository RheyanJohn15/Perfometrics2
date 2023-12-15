<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardViews;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DeleteLog;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//LOGIN ROUTE
Route::get('/',[LoginController::class, 'LoginView'])->name('login.index');
Route::get('/privacy',[LoginController::class, 'Privacy'])->name('login_privacy');
Route::get('/aboutus',[LoginController::class, 'AboutUs'])->name('login_aboutus');
Route::get('/contactus',[LoginController::class, 'ContactUs'])->name('login_contactus');
Route::get('/terms',[LoginController::class, 'Terms'])->name('login_terms');
Route::get('/forgotpassword',[LoginController::class, 'ForgotPassword'])->name('forgot');

Route::post('/forgotpassword/student/sendcode',[LoginController::class, 'StudentForgotPass'])->name('studentForgotPass');
Route::post('/forgotpassword/teacher/sendcode',[LoginController::class, 'TeacherForgotPass'])->name('teacherForgotPass');
Route::post('/forgotpassword/coordinator/sendcode',[LoginController::class, 'CoordinatorForgotPass'])->name('coordinatorForgotPass');

Route::post('/forgotpassword/student/changepass',[StudentController::class, 'StudentRecoverChangePass'])->name('studentRecoverChangePass');
Route::post('/forgotpassword/teacher/changepass',[TeacherController::class, 'TeacherRecoverChangePass'])->name('teacherRecoverChangePass');
Route::post('/forgotpassword/coordinator/changepass',[CoordinatorController::class, 'CoordinatorRecoverChangePass'])->name('coordinatorRecoverChangePass');
// LOGIN POST
Route::post('/loginAdmin',[LoginController::class, 'AdminLogin'])->name('login_Admin');
Route::post('/loginStudent',[LoginController::class, 'StudentLogin'])->name('login_Student');
Route::post('/loginTeacher',[LoginController::class, 'TeacherLogin'])->name('login_Teacher');
Route::post('/loginCoordinator',[LoginController::class, 'CoordinatorLogin'])->name('login_Coordinator');

Route::post('/contactus/sendMessage',[DashboardViews::class, 'SendFeedback'])->name('sendMessage');
//DASHBOARD ROUTE
//ADMINISTRATOR
Route::get('/administrator',[LoginController::class, 'AdminDashboard'])->name('admin_dashboard');
Route::get('/administrator/surveyform', [DashboardViews::class, 'SurveyView'])->name('admin_survey');
Route::get('/administrator/alluser', [DashboardViews::class, 'AllUserView'])->name('allUser');

Route::get('/administrator/alluser/student', [DashboardViews::class, 'EditStudent'])->name('editStudent');
Route::get('/administrator/alluser/teacher', [DashboardViews::class, 'EditTeacher'])->name('editTeacher');
Route::get('/administrator/alluser/coordinator', [DashboardViews::class, 'EditCoordinator'])->name('editCoordinator');

Route::get('/administrator/parameters', [DashboardViews::class, 'AssignTeacherView'])->name('assignTeacher');
Route::get('/administrator/parameters/editassignedteacher', [DashboardViews::class, 'EditAssignedTeacher'])->name('editAssignedTeacher');

Route::get('/administrator/viewdata', [DashboardViews::class, 'ViewDataView'])->name('viewData');
Route::get('/administrator/viewdata/results', [DashboardViews::class, 'ResultView'])->name('result');
Route::get('/administrator/viewdata/results/data', [DashboardViews::class, 'DataView'])->name('data');

Route::get('/administrator/classSchedules', [DashboardViews::class, 'ClassScheduleView'])->name('classSchedule');
Route::get('/administrator/classSchedules/viewschedule', [DashboardViews::class, 'ViewSchedule'])->name('viewSchedule');
Route::get('/administrator/classSchedules/editclassSchedules', [DashboardViews::class, 'EditClassSchedules'])->name('editClassSchedules');

Route::get('administrator/adminslist', [DashboardViews::class, 'AddAdminView'])->name('addAdminView');

Route::get('administrator/profile', [DashboardViews::class, 'ProfileView'])->name('AdminProfile');
Route::get('administrator/exportdata', [DashboardViews::class, 'ExportDataView'])->name('exportData');

Route::get('administrator/settings', [DashboardViews::class, 'Settings'])->name('settings');
Route::get('administrator/settings/credits', [DashboardViews::class, 'Credits'])->name('credits');
Route::get('administrator/feedback', [DashboardViews::class, 'Feedback'])->name('feedback');

Route::get('administrator/settings/patchnotes', [DashboardViews::class, 'PatchNotes'])->name('patch');
Route::get('administrator/settings/backup', [DashboardViews::class, 'BackUpData'])->name('backup');

Route::get('administrator/dashboard/studentslist', [DashboardViews::class, 'StudentList'])->name('liststudent');
Route::get('administrator/dashboard/teacherslist', [DashboardViews::class, 'TeacherList'])->name('listteacher');
Route::get('administrator/dashboard/coordinatorlist', [DashboardViews::class, 'CoordinatorList'])->name('listcoordinator');
Route::post('/administrator/dashboard/editSection', [DashboardViews::class, 'UpdateSection'])->name('updateSection');
Route::get('/fetch-data', [DashboardViews::class, 'FetchSections'])->name('fetchData');
Route::get('administrator/alluser/addbatch', [DashboardViews::class, 'OpenBatchAdd'])->name('openAddBatch');
Route::get('administrator/profile/activitylogs', [DashboardViews::class, 'Events'])->name('logs');
Route::get('administrator/profile/activitylogs/recyclebin', [DashboardViews::class, 'RecycleBin'])->name('recycle');

Route::get('administrator/profile/activitylogs/recyclebin/all_list', [DeleteLog::class, 'FetchDeletedUser'])->name('fetchDeletedUser');
Route::get('administrator/profile/activitylogs/recyclebin/student', [DeleteLog::class, 'FetchDeletedStudent'])->name('fetchDeletedStudent');
Route::get('administrator/profile/activitylogs/recyclebin/teacher', [DeleteLog::class, 'FetchDeletedTeacher'])->name('fetchDeletedTeacher');
Route::get('administrator/profile/activitylogs/recyclebin/coordinator', [DeleteLog::class, 'FetchDeletedCoordinator'])->name('fetchDeletedCoordinator');
//STUDENT
Route::get('/student',[LoginController::class, 'StudentDashboard'])->name('student_dashboard');
Route::get('/student/scheduletoday',[StudentController::class, 'ScheduleToday'])->name('scheduleToday');
Route::get('/student/scheduleoverall',[StudentController::class, 'ScheduleOverall'])->name('scheduleOverall');
Route::get('/student/evaluationsummary',[StudentController::class, 'EvaluationSummary'])->name('summary');
Route::get('/student/studentProfile',[StudentController::class, 'StudentProfile'])->name('studentProfile');
//TEACHER
Route::get('/teacher/',[LoginController::class, 'TeacherDashboard'])->name('teacher_dashboard');
Route::get('/teacher/classScheduleToday',[TeacherController::class, 'ClassScheduleToday'])->name('teacherClassScheduleToday');
Route::get('/teacher/classScheduleOverall',[TeacherController::class, 'ClassScheduleOverall'])->name('teacherClassScheduleOverall');
Route::get('/teacher/teacherProfile',[TeacherController::class, 'TeacherProfile'])->name('teacherProfile');
Route::get('/teacher/remarks',[TeacherController::class, 'Remarks'])->name('remark');
//COORDINATOR
Route::get('/coordinator',[LoginController::class, 'CoordinatorDashboard'])->name('coordinator_dashboard');
Route::get('/coordinator/profile',[CoordinatorController::class, 'CoordinatorProfile'])->name('coordinator_profile');
Route::get('/coordinator/evaluationSummary',[CoordinatorController::class, 'EvaluationSummary'])->name('coordinator_summary');

//DASHBOARD POST
Route::post('administrator/changeSem',[LoginController::class, 'AdminChangeSem'])->name('changeSem');
Route::post('/administrator/editQuestion',[DashboardViews::class, 'ChangeQuestion'])->name('editQuestion');
Route::post('/administratot/addquestion',[DashboardViews::class, 'AddQuestion'])->name('addQuestion');
Route::post('/administrator/deletequestion', [DashboardViews::class, 'DeleteQuestion'])->name('deleteQuestion');

Route::post('/administrator/addTeacher', [DashboardViews::class, 'AddTeacher'])->name('addTeacher');
Route::post('/administrator/addStudent', [DashboardViews::class, 'AddStudent'])->name('addStudent');
Route::post('/administrator/addCoordinator', [DashboardViews::class, 'AddCoordinator'])->name('addCoordinator');
Route::post('/administrator/alluser/student/editStudent', [DashboardViews::class, 'AlterStudentPersonalInfo'])->name('alterStudent');
Route::post('/administrator/alluser/teacher/editTeacher', [DashboardViews::class, 'AlterTeacherInfo'])->name('alterTeacher');
Route::post('/administrator/alluser/coordinator/editCoordinator', [DashboardViews::class, 'AlterCoordinatorInfo'])->name('alterCoordinator');
Route::post('/administrator/alluser/student/deleteStudent', [DeleteLog::class, 'DeleteStudent'])->name('deleteStudent');
Route::post('/administrator/assigneteacher/editassignedteacher/insertdata', [DashboardViews::class, 'AssignedTeacherUpdate'])->name('insertDataAssignedTeacher');

Route::post('/administrator/classSchedules/viewschedule/editclassSchedules/submitselectedStrand', [DashboardViews::class, 'SubmitSelectedStrand'])->name('submitSelectedStrand');
Route::post('/administrator/classSchedules/viewschedule/editclassSchedules/updateSchedule', [DashboardViews::class, 'UpdateSchedule'])->name('updateSchedule');

Route::post('/administrator/adminslist/addAdmin', [DashboardViews::class, 'AddAdmin'])->name('addAdmin');
Route::post('/administrator/profile/updateProfilePic', [DashboardViews::class, 'UpdateProfilePicAdmin'])->name('updateProfilePicAdmin');
Route::post('/administrator/profile/updatePersonalInfo', [DashboardViews::class, 'UpdatePersonalDataAdmin'])->name('updatePersonalAdmin');
Route::post('/administrator/profile/changePassword', [DashboardViews::class, 'ChangePasswordAdmin'])->name('changePassAdmin');

Route::post('/administrator/exportdata/exportpdf', [DashboardViews::class, 'ExportPdf'])->name('exportPdf');
Route::post('/administrator/exportdata/exportexcel', [DashboardViews::class, 'ExportExcel'])->name('exportExcel');
Route::post('/administrator/exportdata/exportuserPdf', [DashboardViews::class, 'ExportUserPdf'])->name('userPDF');
Route::post('/administrator/exportdata/exportuserExcel', [DashboardViews::class, 'ExportUserExcel'])->name('userExcel');

Route::post('/administrator/exportdata/exportClassSchedulePdf', [DashboardViews::class, 'ClassScheduleExportPDF'])->name('schedulePdf');

Route::post('/administrator/dashboard/addRooms', [DashboardViews::class, 'AddRoom'])->name('addRoom');
Route::post('/administrator/dashboard/addStrand', [DashboardViews::class, 'AddStrand'])->name('addStrand');
Route::post('/administrator/dashboard/addSection', [DashboardViews::class, 'AddSection'])->name('addSection');

Route::post('/administrator/dashboard/deployEvaluation', [DashboardViews::class, 'DeployEvaluation'])->name('deployEval');

Route::post('/administrator/settings/saveEvaluationData', [DashboardViews::class, 'SaveEvaluationDataOnStorage'])->name('saveEvalStorage');
Route::post('/administrator/settings/deleteOrLoadData', [DashboardViews::class, 'DeleteOrLoadData'])->name('deleteOrLoad');
Route::post('/administrator/settings/deleteData', [DashboardViews::class, 'DeleteEvaluationData'])->name('deleteData');
Route::post('/administrator/settings/resetData', [DashboardViews::class, 'ResetData'])->name('resetData');

Route::post('/administrator/alluser/addbatch/submit', [DashboardViews::class, 'AddStudentBatch'])->name('addBatchStudent');


Route::post('/administrator/alluser/teacher/deleteTeacher', [DeleteLog::class, 'DeleteTeacher'])->name('deleteTeacher');
Route::post('/administrator/alluser/teacher/addbatchTeacher', [DashboardViews::class, 'AddBatchTeacher'])->name('addBatchTeacher');

Route::post('/administrator/alluser/coordinator/deleteCoordinator', [DeleteLog::class, 'DeleteCoordinator'])->name('deleteCoordinator');

Route::post('/administrator/alluser/addbatchCoordinator', [DashboardViews::class, 'AddBatchCoordinator'])->name('addBatchCoordinator');

Route::post('/administrator/alluser/deleteBatchStudent', [DeleteLog::class, 'DeleteBatchStudent'])->name('deleteBatchStudent');

Route::post('/administrator/alluser/deleteBatchTeacher', [DeleteLog::class, 'DeleteBatchTeacher'])->name('deleteBatchTeacher');
Route::post('/administrator/alluser/deleteBatchCoordinator', [DeleteLog::class, 'DeleteBatchCoordinator'])->name('deleteBatchCoordinator');
Route::get('/administrator/alluser/searchuser', [DashboardViews::class, 'SearchUser'])->name('searchUser');

Route::post('/administrator/profile/activitylogs/clearLogs', [DeleteLog::class, 'ClearLogs'])->name('clearLogs');

Route::post('administrator/profile/activitylogs/recyclebin/restoreUser', [DeleteLog::class, 'RestoreUser'])->name('restoreUser');
Route::post('administrator/profile/activitylogs/recyclebin/deletePermanently', [DeleteLog::class, 'DeleteUserPermanently'])->name('deleteUserPermanently');
Route::post('administrator/alluser/student/sendAccountDetails', [DashboardViews::class, 'SendAccountDetails'])->name('sendAccountDetails');
Route::post('administrator/alluser/student/sendCustomMessage', [DashboardViews::class, 'SendCustomMessage'])->name('sendCustomMessage');
Route::post('administrator/settings/savedata/overwrite', [DashboardViews::class, 'OverWriteSaveData'])->name('overWriteSaveData');

Route::post('administrator/profile/activitylogs/recyclebin/deleteallpermanently', [DeleteLog::class, 'DeleteAllUserData'])->name('deleteAllUserPermanently');

Route::post('administrator/parameters/addSubject', [DashboardViews::class, 'AddSubject'])->name('addSubject');
Route::post('administrator/parameters/manageSubject', [DashboardViews::class, 'ManageSubject'])->name('manageSubject');

Route::post('administrator/settings/updateScoreWeight', [DashboardViews::class, 'ScoreWeightPercentage'])->name('scoreWeightPercentage');

Route::post('administrator/exportData/changeSignatureImage', [DashboardViews::class, 'ChangeSignatureImage'])->name('changeSignatureImage');

Route::post('administrator/settings/automaticBackup', [DashboardViews::class, 'AutomaticBackup'])->name('automaticBackup');
Route::post('administrator/settings/backup', [DashboardViews::class, 'Backup'])->name('backup');
Route::post('administrator/settings/restoreData', [DashboardViews::class, 'RestoreData'])->name('restoreData');
Route::get('/backup', function() {
    $exitCode = Artisan::call('backup:run');
    
    if ($exitCode === 0) {
        return response()->json(['message' => 'success', 'output' => Artisan::output()]);
    } else {
        return response()->json(['message' => 'fail', 'error' => Artisan::output()]);
    }
})->name('backUpRoute');

Route::get('administrator/restrictSemYear', [DashboardViews::class, 'RestrictSemYear'])->name('restrictSemYear');
Route::post('administrator/settings/backup/downloadData', [DashboardViews::class, 'DownloadData'])->name('downloadData');
//STUDENT POST
Route::post('/student/submitEvaluation',[StudentController::class, 'SubmitEvaluation'])->name('submitEvaluation');
Route::get('/student/evaluationCheck',[DashboardViews::class, 'EvaluationCheck'])->name('evaluationCheck');
Route::post('/student/studentProfile/updatepicture',[StudentController::class, 'UpdateProfilePicStudent'])->name('updatePicture');
Route::post('/student/studentProfile/updatePersonalData',[StudentController::class, 'UpdatePersonalData'])->name('updatePersonalData');
Route::post('/student/studentProfile/changePassword',[StudentController::class, 'ChangePassword'])->name('changePassword');

Route::post('/student/verification',[StudentController::class, 'StudentVerificationMail'])->name('studentVerificationMail');
Route::post('/student/verifiedData',[StudentController::class, 'StudentSavedVerifiedData'])->name('studentSavedVerifiedData');

Route::post('/student/changeRecoveryMail',[StudentController::class, 'ChangeRecoveryMailStudent'])->name('changeRecoveryMailStudent');
Route::post('/student/changeRecoveryMailConfirn',[StudentController::class, 'ConfirmChangeMailStudent'])->name('confirmChangeMailStudent');
//COORDINATOR POST
Route::post('/coordinator/submitEvaluation',[CoordinatorController::class, 'SubmitEvaluation'])->name('evaluationCoordinator');
Route::post('/coordinator/updateProfilePic',[CoordinatorController::class, 'UpdateProfilePicCoordinator'])->name('updateProfilePicCoordinator');
Route::post('/coordinator/updatePersonalData',[CoordinatorController::class, 'UpdatePersonalDataCoordinator'])->name('personalDataCoordinator');
Route::post('/coordinator/changePassword',[CoordinatorController::class, 'ChangePasswordCoordinator'])->name('changePasswordCoordinator');

Route::post('/coordinator/verification',[CoordinatorController::class, 'CoordinatorVerificationMail'])->name('coordinatorVerificationMail');
Route::post('/coordinator/verifiedData',[CoordinatorController::class, 'CoordinatorSavedVerifiedData'])->name('coordinatorSavedVerifiedData');

Route::post('/coordinator/changeRecoveryMail',[CoordinatorController::class, 'ChangeRecoveryMailCoordinator'])->name('changeRecoveryMailCoordinator');
Route::post('/coordinator/changeRecoveryMailConfirn',[CoordinatorController::class, 'ConfirmChangeMailCoordinator'])->name('confirmChangeMailCoordinator');
//TEACHER POST
Route::post('/teacher/profile/updatepicture',[TeacherController::class, 'UpdateProfilePicTeacher'])->name('updatePictureTeacher');
Route::post('/teacher/profile/updatePersonalInf',[TeacherController::class, 'UpdatePersonalDataTeacher'])->name('updatePersonalTeacher');
Route::post('/teacher/profile/changePassword',[TeacherController::class, 'ChangePassword'])->name('changePassTeacher');

Route::post('/teacher/verification',[TeacherController::class, 'TeacherVerificationMail'])->name('teacherVerificationMail');
Route::post('/teacher/verifiedData',[TeacherController::class, 'TeacherSavedVerifiedData'])->name('teacherSavedVerifiedData');

Route::post('/teacher/changeRecoveryMail',[TeacherController::class, 'ChangeRecoveryMailTeacher'])->name('changeRecoveryMailTeacher');
Route::post('/teacher/changeRecoveryMailConfirn',[TeacherController::class, 'ConfirmChangeMailTeacher'])->name('confirmChangeMailTeacher');
Route::post('logout',[DashboardViews::class, 'logout'])->name('logout');

