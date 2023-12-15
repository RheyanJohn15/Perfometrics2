<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Coordinator;
use App\Models\Admin;
use App\Models\AssignedTeacher;
use App\Models\AssignedSubject;
use App\Models\EvaluationResult;
use App\Models\Strand;
use App\Models\Room;
use App\Models\ClassSchedule;
use App\Models\Section;
use App\Models\RoomAvailable;
use App\Models\SavedEvaluation;
use App\Models\Feedback;
use App\Models\Analytics;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File; 
use ZipArchive;
use App\Mail\SendMessageUser;
use App\Mail\CustomMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use App\Exports\Users;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardViews extends Controller
{
    public function BackUpData(){
      
        $directory = 'Perfometrics'; // Directory name inside storage/app/
        $files = Storage::files($directory);
        return view('administrator.backup', compact('files'));
    }
    public function downloadData(Request $request)
    {
        $fileName = $request->input('downloadFile'); // Assuming 'selectedFile' contains the file name
        $fileLocation = str_replace('Perfometrics/', '', $fileName);
        if (Storage::exists($fileName)) {
            $response = response()->download(storage_path('app/Perfometrics/'.$fileLocation));
            $response->headers->set('Content-Type', 'application/zip');
            return $response;
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }
    public function RestoreData(Request $request){
        $pass = $request->input('adminPassword');
        $admin = Admin::where('admin_type', 'Super Admin')->first();
        $fileName = $request->input('fileName');
    
        // Construct the full path to the file
        $filePath = storage_path('app/Perfometrics/'.$fileName);
        $extract= str_replace(".zip",'',$fileName);
        if(empty($fileName)){
            $message = 'No File Selected';
            return response()->json(['message' => 'fail', 'data' => $message, 'status' => $filePath]);
        }
        if($admin->admin_password === $pass){
            if (file_exists($filePath)) {
                $zip = new ZipArchive();
    
                if ($zip->open($filePath) === true) {
                    $extractPath = storage_path('app/Restore/'.$extract);
    
                    if (!file_exists($extractPath)) {
                        mkdir($extractPath, 0755, true);
                    }
                      $name=[];
                    // Loop through each entry in the ZIP file
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $entry = $zip->getNameIndex($i);
                        array_push($name, $entry);
                        // Check if the entry is a directory
                       
                            $zip->extractTo($extractPath, $entry);
                        }
                    
    
                    $zip->close();
                  
                    $sqlFilePath = $extractPath . '/db-dumps/mysql-capstone.sql';

                    // Read the SQL file content
                    $sqlQueries = file_get_contents($sqlFilePath);
                    
                    try {
                        // Execute the SQL queries using the DB facade
                        DB::unprepared($sqlQueries);
                        return response()->json(['message' => 'success', 'data' => 'Data Restored!', 'name'=>$name]);
                    } catch (\Exception $e) {
                        return response()->json(['message' => 'Error executing SQL: ' . $e->getMessage()]);
                    }
                   
                } else {
                    $message = 'Failed to open the zip file.';
                    $status = $zip->getStatusString();
                    $zip->close();
                    return response()->json(['message' => 'fail', 'data' => $message, 'status' => $status]);
                }
            } else {
                $message = 'File not found.';
                return response()->json(['message' => 'fail', 'data' => $message, 'status' => $filePath]);
            }
        } else {
            $message = 'Incorrect admin password.';
            return response()->json(['message' => 'fail', 'data' => $message]);
        }
    }
    
    
    public function Backup(Request $request){
        $pass = $request->input('adminPassword');
        $admin= Admin::where('admin_type', 'Super Admin')->first();

        if($admin->admin_password === $pass){
           return redirect(route('backUpRoute'));
        }else{
            return response()->json(['message'=>'fail']);
        }
    
    }
    public function SurveyView(){
        return view('administrator.survey');
    }
    public function AllUserView(){
        return view('administrator.alluser');
    }
   public function EditStudent(Request $request){
    $student_id= $request->input('student_id');

    $student= Student::where('student_id', $student_id)->first();
    $id= $student->id;
    $password= $student->student_password;
    $first_name= $student->student_first_name;
    $last_name= $student->student_last_name;
    $middle_name= $student->student_middle_name;
    $suffix= $student->student_suffix;
    $year_level= $student->student_year_level;
    $strand= $student->student_strand;
    $section= $student->student_section;
    $mail= $student->student_mail;
    $status= $student->student_status;
    $trimYearLevel= substr($year_level, -2);
    if($suffix==="none"){
        $finalSuffix= " ";
    }else{
        $finalSuffix=$suffix;
    }
     $sectionQuery= Section::where('id', $section)->first();
    $fullname= $first_name. " ". $middle_name. " ". $last_name. " ". $finalSuffix;
    return view('administrator.student',[
        'id'=>$id,
        'student_id'=>$student_id,
        'password'=>$password,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'middle_name'=>$middle_name,
        'suffix'=>$suffix,
        'fullname'=>$fullname,
        'year_level'=>$year_level,
        'trimYearLevel'=>$trimYearLevel,
        'strand'=>$strand,
        'section'=>$section,
        'section_name'=>$sectionQuery->section,
        'mail'=>$mail,
        'status'=>$status
    ]);
   }
   public function EditTeacher(Request $request){
    $teacher_id= $request->input('teacher_id');

    $teacher= Teacher::where('id', $teacher_id)->first();
    $first_name= $teacher->teacher_first_name;
    $middle_name= $teacher->teacher_middle_name;
    $last_name= $teacher->teacher_last_name;
    $suffix= $teacher->teacher_suffix;
    if($suffix==="none"){
        $finalSuffix= " ";
    }else{
        $finalSuffix=$suffix;
    }
    $username=$teacher->teacher_username;
    $password= $teacher->teacher_password;
    $fullname= $first_name. " ". $middle_name. " ". $last_name. " ". $finalSuffix;
    return view('administrator.teacher', [
        'fullname'=>$fullname,
        'first_name'=>$first_name,
        'middle_name'=>$middle_name,
        'last_name'=>$last_name,
        'suffix'=>$suffix,
        'username'=>$username,
        'password'=>$password,
        'teacher_id'=>$teacher_id,
        'status'=>$teacher->teacher_status,
    ]);
   }
   public function EditCoordinator(Request $request){
    $coordinator_id= $request->input('coordinator_id');

    $coordinator= Coordinator::where('id', $coordinator_id)->first();
    $first_name= $coordinator->coordinator_first_name;
    $last_name= $coordinator->coordinator_last_name;
    $middle_name= $coordinator->coordinator_middle_name;
    $suffix= $coordinator->coordinator_suffix;
    if($suffix=="none"){
        $finalSuffix=" ";
    }else{
        $finalSuffix= $suffix;
    }
    $username= $coordinator->coordinator_username;
    $password= $coordinator->coordinator_password;
    $position= $coordinator->coordinator_position;
    $fullname= $first_name. " ". $middle_name. " ". $last_name. " ". $finalSuffix;
    return view('administrator.coordinator', [
        'fullname'=>$fullname,
        'first_name'=>$first_name,
        'middle_name'=>$middle_name,
        'last_name'=>$last_name,
        'suffix'=>$suffix,
        'username'=>$username,
        'password'=>$password,
        'position'=>$position,
        'coordinator_id'=>$coordinator_id,
        'status'=>$coordinator->coordinator_status,
    ]);
   }
    public function ChangeQuestion(Request $request){

        $data= $request->validate([
           'editedQuestion'=> 'required',
           'question_id'=> 'required',
        ]);
  $question = Question::where('id', $data['question_id'])->first();
  $question->update(['question_content'=> $data['editedQuestion']]);
  return redirect()->route('admin_survey');
    }

    public function AddQuestion(Request $request){

        $data= $request->validate([
           'criteria'=>'required',
           'question'=> 'required',
        ]);
        $event= new Event();
        $event->event_name = 'Added Evaluation Question';
        $event->save(); 
        $question= new Question();
        $question->question_content= $data['question'];
        $question->question_criteria= $data['criteria'];

        $question->save();
        return redirect()->route('admin_survey');
    }

    public function DeleteQuestion(Request $request){
        $data= $request->validate([
            'question_id'=>'required',
            'adminPassword'=>'required',
        ]);
        $event= new Event();
        $event->event_name = 'Evaluation Question deleted';
        $event->save();
       if(Admin::where('admin_type', 'Super Admin')->first()->admin_password === $data['adminPassword']){
            $question = Question::find($data['question_id']);

        if (!$question) {
            return redirect()->back()->with('error', 'Question not found!');
        }
    
        $question->delete();
       }
        
        return redirect()->back()->with("success", "Question Deleted Succesfully");
    }


    public function AddStudent(Request $request){
    $data= $request->validate([
       'firstNameStudent'=>'required',
       'lastNameStudent'=> 'required',
       'suffixStudent'=>'required',
       'student_id'=>'required',
       'year'=>'required',
       'strand'=>'required',
    ]);

    $studentCheck = Student::where('student_id', $data['student_id'])->first();
    if($studentCheck){
        return response()->json(['message'=>'error']);
    }else{
        $finalMname = empty($request->input('middleNameStudent')) ? ' ' : $request->input('middleNameStudent');
        $section= Section::where('id', $data['year'])->first();
        $randomPassword= randomString(8);
        $students = new Student();
        $students->student_id= $data['student_id'];
        $students->student_password=$randomPassword;
        $students->student_first_name= $data['firstNameStudent'];
        $students->student_last_name= $data['lastNameStudent'];
        $students->student_middle_name= $finalMname;
        $students->student_suffix= $data['suffixStudent'];
        $students->student_year_level= $section->year_level;
        $students->student_strand= $data['strand'];
        $students->student_section= $data['year'];
        $students->student_mail= '';
        $students->student_image= '0';
        $students->student_image_type= "";
        $students->student_status="0";
    
        $students->save();
    
        return response()->json(['message'=>'success']);
    }

 
    }
    public function AddTeacher(Request $request){
      $data= $request->validate([
        'last_name'=>'required',
        'first_name'=>'required',
        'suffix'=>'required',
        'username'=>'required',
      ]);

      $teacherChecking = Teacher::where('teacher_username', $data['username'])->first();
      if($teacherChecking){
        return response()->json(['message'=>'error']);
      }else{
        $finalMname = empty($request->input('middle_name')) ? ' ' : $request->input('middle_name');
        $password= randomString(8);
        $teacher= new Teacher();
        $teacher->teacher_username= $data['username'];
        $teacher->teacher_password= $password;
        $teacher->teacher_first_name= $data['first_name'];
        $teacher->teacher_last_name= $data['last_name'];
        $teacher->teacher_middle_name= $finalMname;
        $teacher->teacher_suffix= $data['suffix'];
        $teacher->teacher_mail = '';
        $teacher->teacher_image= '0';
        $teacher->teacher_image_type= " ";
        $teacher->teacher_status= "0";
  
        $teacher->save();
  
        return response()->json(['message'=>'success']);
      }
     
    }
    public function AddCoordinator(Request $request){
        $data= $request->validate([
            'last_name'=>'required',
            'first_name'=>'required',
            'suffix'=>'required',
            'username'=>'required',
            'Position'=>'required',
          ]);
         $coordinatorChecking = Coordinator::where('coordinator_username', $data['username'])->first();
         if($coordinatorChecking){
            return response()->json(['message'=>'error']);
         }else{
            $finalMname = empty($request->input('middle_name')) ? ' ' : $request->input('middle_name');
            $coordinator= new Coordinator();
            $password= randomString(8);
            $coordinator->coordinator_username= $data['username'];
            $coordinator->coordinator_password= $password;
            $coordinator->coordinator_first_name= $data['first_name'];
            $coordinator->coordinator_last_name= $data['last_name'];
            $coordinator->coordinator_middle_name=$finalMname;
            $coordinator->coordinator_suffix= $data['suffix'];
            $coordinator->coordinator_position= $data['Position'];
            $coordinator->coordinator_mail= '';
            $coordinator->coordinator_image= '0';
            $coordinator->coordinator_image_type= " ";
            $coordinator->coordinator_status= "0";
            $coordinator->save();
  
            return response()->json(['message'=>'success']);
         }
       
    }


    public function AlterStudentPersonalInfo(Request $request){
        $data= $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'suffix'=>'required',
            'student_id'=>'required',
            'password'=>'required',
            'email'=>'required',
            'getStudentId'=>'required',
            'strands'=>'required',
            'sections'=>'required',
        ]);

      
        $student= Student::where('student_id', $data['getStudentId'])->first();
        $yearLevel=Section::where('id', $data['sections'])->first()->year_level;
        $student->update([
            'student_first_name'=>$data['first_name'],
            'student_last_name'=>$data['last_name'],
            'student_suffix'=>$data['suffix'],
            'student_id'=>$data['student_id'],
            'student_middle_name'=>$data['middle_name'],
            'student_password'=>$data['password'],
            'student_mail'=>$data['email'],
            'student_year_level'=>$yearLevel,
            'student_section'=> $data['sections'],
            'student_strand'=>$data['strands'],
        ]);

        return redirect()->route('editStudent', ['student_id' => $data['getStudentId']]);
    }


    public function AlterTeacherInfo(Request $request){

        $data= $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'suffixTeacher'=>'required',
            'username'=>'required',
            'password'=>'required',
            'hiddenTeacherId'=>'required',
        ]);

        $teacher= Teacher::where('id', $data['hiddenTeacherId'])->first();

        $teacher->update([
           'teacher_first_name'=>$data['first_name'],
           'teacher_last_name'=>$data['last_name'],
           'teacher_middle_name'=>$data['middle_name'],
           'teacher_suffix'=>$data['suffixTeacher'],
           'teacher_username'=>$data['username'],
           'teacher_password'=>$data['password'],
        ]);

        return redirect()->route('editTeacher', ['teacher_id' => $data['hiddenTeacherId']]);
    }

    public function AlterCoordinatorInfo(Request $request){
        $data= $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'suffixCoordinator'=>'required',
            'username'=>'required',
            'password'=>'required',
            'hiddenCoordinatorId'=>'required',
        ]);

        $coordinator = Coordinator::where('id',$data['hiddenCoordinatorId'])->first();
        $coordinator->update([
          'coordinator_first_name'=>$data['first_name'],
          'coordinator_last_name'=>$data['last_name'],
          'coordinator_middle_name'=>$data['middle_name'],
          'coordinator_suffix'=>$data['suffixCoordinator'],
          'coordinator_username'=>$data['username'],
          'coordinator_password'=>$data['password'],
        ]);

        return redirect()->route('editCoordinator', ['coordinator_id' => $data['hiddenCoordinatorId']]);
    }
    


    //AssignTeacher
    public function AssignTeacherView(){
        return view('administrator.assignteacher');
    }
    public function EditAssignedTeacher(Request $request){
        $strand_id= $request->input('strand_id');
        $gLevel = $request->input('glevel');
        $section= $request->input('section');
        if($gLevel==="Grade11"){
            $finalGlevel="Grade 11";
        }else{
            $finalGlevel="Grade 12";
        }
        $admin= Admin::where('admin_type', 'Super Admin')->first();
        $strand= Strand::where('id',$strand_id)->first();
        return view('administrator.editassigned',[
            'strand_name'=>$strand->strand_name,
            'gLevel'=>$finalGlevel,
            'grade_level'=>$gLevel,
            'semester'=>$admin->admin_sem,
            'strand_id'=>$strand_id,
            'section'=>$section,
        ]);
    }


    public function AssignedTeacherUpdate(Request $request){
        $selectedTeachers = $request->input('selectedTeacher');
        $hiddenSubjectId= $request->input('hiddenSubjectId');
        $hiddenSection= $request->input('hiddenSection');
        $hiddenStrand= $request->input('hiddenStrand');
        $hiddenSemester= $request->input('hiddenSemester');
        $hiddenGlevel= $request->input('hiddenGlevel');
        $itemCount= count($selectedTeachers);
        for($i=0; $i<$itemCount; $i++){
            $assignedTeacherUpdate= AssignedTeacher::where('subject_id', $hiddenSubjectId[$i])
            ->where('section_id', $hiddenSection)
            ->where('strand_id', $hiddenStrand)
            ->where('sem', $hiddenSemester)
            ->where('grade_level', $hiddenGlevel)
            ->first();

           if($assignedTeacherUpdate){
            $assignedTeacherUpdate->update([
                'teacher_id'=>$selectedTeachers[$i],
           ]);
           }else{
            $assignedTeachers= new AssignedTeacher();
            $assignedTeachers ->subject_id=$hiddenSubjectId[$i];
            $assignedTeachers ->section_id=$hiddenSection;
            $assignedTeachers ->strand_id=$hiddenStrand;
            $assignedTeachers ->sem=$hiddenSemester;
            $assignedTeachers ->grade_level=$hiddenGlevel;
            $assignedTeachers ->teacher_id=$selectedTeachers[$i];
            $assignedTeachers->save(); 
           }
        }

      

        if($hiddenGlevel==="Grade 11"){
            $returnGlevel= "Grade11";
        }else{
            $returnGlevel= "Grade12";
        }

        $event= new Event();
        $event->event_name = 'Set Teacher Parameters';
        $event->save();
        return redirect()->route('editAssignedTeacher', ['strand_id' => $hiddenStrand, 'glevel'=>$returnGlevel,'section'=>$hiddenSection]);
    }


    //Class Schedule
    public function ClassScheduleView(){
        return view('administrator.classschedule');
    }
    public function ViewSchedule(Request $request){
        $type = $request->input('type');
        $id= $request->input('id');

        return view('administrator.viewschedule', [
            'type'=> $type,
            'id'=>$id,
        ]);
    }
    public function EditClassSchedules(){
        $Sem= Admin::where('admin_type', 'Super Admin')->first();
        Session::put('selectedStrand', 'Null');
        return view('administrator.editclass_schedules', [
            'currentSem'=>$Sem->admin_sem,
        ]);
    }
    public function SubmitSelectedStrand(Request $request){
        $data=$request->validate(['strands'=>'required']);
        $Sem= Admin::where('admin_type', 'Super Admin')->first();
        Session::put('selectedStrand',$data['strands']);
        return view('administrator.editclass_schedules', [
            'currentSem'=>$Sem->admin_sem,
        ]);
    }

    public function UpdateSchedule(Request $request){

        $data= $request->validate([
         'timeContent'=>'required',
         'dayContent'=>'required',
         'strand'=>'required',
         'subject'=>'required',
         'room'=>'required',
        ]);

        $explodeSub= explode('-', $data['subject']);
        $subject= $explodeSub[0];
        $teacher= $explodeSub[1];

        if($teacher===0){
            $saveTeacher= 6;
        }else{
            $saveTeacher= $teacher;
        }
        $schedule= ClassSchedule::where('sched_class_name', $data['strand'])
        ->where('sched_time', $data['timeContent'])
        ->where('sched_day', $data['dayContent'])
        ->first();

        $schedule->update([
          'sched_teacher'=>$saveTeacher,
          'sched_room'=>$data['room'],
          'sched_subject'=>$subject,
        ]);

        $roomAvail= RoomAvailable::where('room_id', $data['room'])
        ->where('room_day', $data['dayContent'])->first();

        $checkRoom= RoomAvailable::where('room_day', $data['dayContent'])->where($data['timeContent'], $data['strand'])->first();
        if($checkRoom){
          $checkRoom->update([
             $data['timeContent']=>'0',
          ]);
        }

        $roomAvail->update([
            $data['timeContent']=>$data['strand'],
        ]);
        $Sem= Admin::where('admin_type', 'Super Admin')->first();
        Session::put('selectedStrand',$data['strand']);
        $event= new Event();
        $event->event_name = 'Set Schedule';
        $event->save();
        return view('administrator.editclass_schedules', [
            'currentSem'=>$Sem->admin_sem,
        ]);
    }

    //Add Admin
    public function AddAdminView(){
        return view('administrator.addadmin');
    }
    public function AddAdmin(Request $request){
        $data=$request->validate([
          'first_name'=>'required',
          'last_name'=>'required',
          'middle_name'=>'required',
          'username'=>'required',
          'suffix'=>'required',
        ]);

        $admin= new Admin();
        
        $admin->admin_first_name= $data['first_name'];
        $admin->admin_last_name= $data['last_name'];
        $admin->admin_middle_name= $data['middle_name'];
        $admin->admin_suffix= $data['suffix'];
        $admin->admin_username=$data['username'];
        $admin->admin_password= randomString(8);
        $admin->admin_type= 'Admin';
        $admin->admin_image= '0';
        $admin->admin_image_type= '';
        $admin->admin_sem= '';
        $admin->save();

        return redirect()->route('addAdminView');
    }


        //ViewData
        public function ViewDataView(){
            return view('administrator.viewdata');
        }
        public function ResultView(Request $request){
            $teacher_id= $request->input('teacher_id');
            return view('administrator.result',[
                'teacher_id'=>$teacher_id,
                'place'=>$request->input('place'),
            ]);
        }
        public function DataView(Request $request){
            $evaluator= $request->input('evaluator_id');
            $teacher= $request->input('teacher_id');
            $type= $request->input('type');
            return view('administrator.data', [
                'teacher_id'=>$teacher,
                'evaluator'=>$evaluator,
                'type'=>$type,
            ]);
        
        }
  

        //Profile
        public function ProfileView(){
            $admin= Admin::where('id', session('user_id'))->first();
            if($admin->admin_suffix==="none"){
                $finalSuffix= " ";
            }else{
                $finalSuffix= $admin->admin_suffix;
            }

          
            $fullName= $admin->admin_first_name. " ". substr($admin->admin_middle_name, 0, 1). ". ". $admin->admin_last_name. " ". $finalSuffix;
            return view('administrator.profile', [
                'fullname'=> $fullName,
                'first_name'=>$admin->admin_first_name,
                'middle_name'=>$admin->admin_middle_name,
                'last_name'=>$admin->admin_last_name,
                'suffix'=>$admin->admin_suffix,
                'username'=>$admin->admin_username,
                'password'=>$admin->admin_password,
              
            ]);
        }

        public function UpdateProfilePicAdmin(Request $request){
            $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20048', // Adjust the validation rules as needed
            ]);
    
            // Store the file in the public folder
            $file = $request->file('picture');
            $fileName = "Admin(". session('user_id'). ").". $file->getClientOriginalExtension();
            $filePath = public_path('Users/');  // Adjust the storage path as needed
    
            // Save the file
          
            $admin= Admin::where('id', session('user_id'))->first();
            if($admin->admin_image===1){
                  File::delete(public_path('Users/Admin('.$admin->id.').'.$admin->admin_image_type));
                   $admin->update([
                'admin_image'=>'1',
                'admin_image_type'=> $file->getClientOriginalExtension(),
        
            ]);
    
            }else{
                 $admin->update([
                'admin_image'=>'1',
                'admin_image_type'=> $file->getClientOriginalExtension(),
        
            ]);
    
            }
             $file->move($filePath, $fileName);
            return redirect()->back()->with('success', 'File uploaded successfully.');
        }
    
        public function UpdatePersonalDataAdmin(Request $request){
            $data= $request->validate([
               'first_name'=>'required',
               'middle_name'=>'required',
               'last_name'=>'required',
               'suffix'=>'required',
               'username'=>'required',
            ]);
    
    
            $admin= Admin::where('id', session('user_id'))->first();
    
            $admin->update([
               'admin_first_name'=> $data['first_name'],
               'admin_middle_name'=>$data['middle_name'],
               'admin_last_name'=>$data['last_name'],
               'admin_suffix'=>$data['suffix'],
               'admin_username'=>$data['username'],
               
            ]);
    
            return redirect()->back()->with('success', 'File uploaded successfully.');
    
        }
    
        public function ChangePasswordAdmin(Request $request){
    
            $data= $request->validate([
                'newPassword'=>'required',
                'currentPassword'=>'required',
            ]);
    
            $admin= Admin::where('id', session('user_id'))->first();
            if($admin->admin_password===$data['currentPassword']){
                $admin->update([
                    'admin_password'=>$data['newPassword'],
                ]);
                return redirect()->back()->with('Success', 'Changed Password');
            }else{
                return redirect()->back()->with('Fail', 'Incorrect Password');
            }
        }

        //ExportData

        public function ExportDataView(){
            return view('administrator.exportdata');
        }

        public function ExportPdf(Request $request){
            $teacher_id= $request->input('teachPDF');
            if ($request->input('action') === 'preview') {

                $imageUrl = public_path('images/logo.jfif');
                $signature = public_path('dashboard/img/sign.png');
                $imageData = File::get($imageUrl);
                $signData= File::get($signature);
                
               if($teacher_id!='all'){

               
                $data = [
                    'teacher_id' =>$teacher_id,
                    'logoData' => base64_encode($imageData),
                    'signature' => base64_encode($signData), // Pass the image data to the view
                ];
        
                $pdf = PDF::loadView('administrator.evaluationPdf', $data);
                return $pdf->stream('administrator.evaluationPdf', ['Attachment' => false]);
            }else{
                $data = [
                    'logoData' => base64_encode($imageData),
                    'signature' => base64_encode($signData), // Pass the image data to the view
                ];
                $pdf = PDF::loadView('administrator.evaluationPDFall', $data);
                return $pdf->stream('administrator.evaluationPDFall', ['Attachment' => false]);
            }
            } elseif ($request->input('action') === 'download') {
                if($teacher_id!='all'){
                    $imageUrl = public_path('images/logo.jfif');
                    $imageData = File::get($imageUrl);
            
                    $data = [
                        'teacher_id' =>$teacher_id,
                        'logoData' => base64_encode($imageData), // Pass the image data to the view
                    ];
                    $teacher= Teacher::where('id', $teacher_id)->first();
            
                    $pdf = PDF::loadView('administrator.evaluationPdf', $data);
                    return $pdf->download('evaluation('.$teacher->teacher_last_name.').pdf');
                }else{
                    $pdfContents = [];
                    $teachers= Teacher::where('id', '!=', 6)->get();
                    $imageUrl = public_path('images/logo.jfif');
                    $imageData = File::get($imageUrl);
                    foreach($teachers as $teacher){
                        $data = [
                            'logoData' => base64_encode($imageData), 
                            'teacher_id' => $teacher->id,
                        ];
            
                        $pdf = PDF::loadView('administrator.evaluationPdf', $data);
                        $pdfContents[] = [
                            'content' => $pdf->output(),
                            'filename' => 'evaluation(' . $teacher->teacher_last_name . ').pdf',
                        ];
                    }
                    $data=[
                        'logoData' => base64_encode($imageData), 
                    ];
                    
                    $pdf = PDF::loadView('administrator.evaluationPDFall', $data);
                    $pdfContents[] = [
                        'content' => $pdf->output(),
                        'filename' => 'evaluation_result_all.pdf',
                    ];
                    $zipFileName = 'teacher_evaluations.zip';
                    $zipFilePath = public_path($zipFileName);
            
                    $zip = new ZipArchive();
                    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                        foreach ($pdfContents as $pdfContent) {
                            $zip->addFromString($pdfContent['filename'], $pdfContent['content']);
                        }

                        $zip->close();
            
                        // Provide the zip archive for download
                        return Response::download($zipFilePath)->deleteFileAfterSend(true);
                    } else {
                        return response()->json(['message' => 'Failed to create zip archive'], 500);
                    }
                }
            }
    
            // Default action if neither button is clicked
            return redirect()->back();
        }

        public function ExportUserPdf(Request $request){
            $selection= $request->input('userPdf');
            $imageUrl = public_path('images/logo.jfif');
            $imageData = File::get($imageUrl);
            if($request->input('action')==='preview'){
                $data = [
                    'selection' =>$selection,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];

                $pdf = PDF::loadView('administrator.userAccountsPdf', $data);
                return $pdf->stream('administrator.userAccountsPdf', ['Attachment' => false]);
        
            }else if($request->input('action')==='download'){
        
                $data = [
                    'selection' =>$selection,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
       
                $pdf = PDF::loadView('administrator.userAccountsPdf', $data);
                return $pdf->download('Accounts_'.$selection.'.pdf');
            }

        }
        public function ExportUserExcel(Request $request){
            $userData=[];
            $selection = $request->input('userExcel');
        if($selection==="Student"){
        $students=Student::all();
        foreach($students as $student){
         $data=[];
         $fullname= $student->student_first_name. " ". substr($student->student_middle_name, 0, 1). " ". $student->student_last_name. " ". $student->student_suffix;
         array_push($data, $fullname);
         array_push($data,  $student->student_id);
         array_push($data, $student->student_password);
        array_push($userData, $data);
        }
        $fileName = 'student_users.xlsx';
        }else if($selection==="Teacher"){
            $teachers=Teacher::where('id', '!=', 6)->get();
            foreach($teachers as $teacher){
             $data=[];
             $fullname= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). " ". $teacher->teacher_last_name. " ". $teacher->teacher_suffix;
             array_push($data, $fullname);
             array_push($data, $teacher->teacher_username);
             array_push($data, $teacher->teacher_password);
            array_push($userData, $data);
            }
            $fileName = 'teacher_users.xlsx';
        }else if($selection==="Coordinator"){
            $coordinators=Coordinator::all();
            foreach($coordinators as $coordinator){
             $data=[];
             $fullname= $coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name, 0, 1). " ". $coordinator->coordinator_last_name. " ". $coordinator->coordinator_suffix;
             array_push($data, $fullname);
             array_push($data, $coordinator->coordinator_username);
             array_push($data, $coordinator->coordinator_password);
            array_push($userData, $data);
            }

            $fileName = 'coordinator_users.xlsx';
        }else{
            array_push($userData, ['Student Fullname', 'Student Id', 'Student Password']);
            $students=Student::all();
        foreach($students as $student){
         $data=[];
         $fullname= $student->student_first_name. " ". substr($student->student_middle_name, 0, 1). " ". $student->student_last_name. " ". $student->student_suffix;
         array_push($data, $fullname);
         array_push($data, $student->student_id);
         array_push($data, $student->student_password);
        array_push($userData, $data);
        }
        array_push($userData, ['Teacher Fullname', 'Teacher Username', 'Teacher Password']);
        $teachers=Teacher::where('id', '!=', 6)->get();
        foreach($teachers as $teacher){
         $data=[];
         $fullname= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). " ". $teacher->teacher_last_name. " ". $teacher->teacher_suffix;
         array_push($data, $fullname);
         array_push($data, $teacher->teacher_username);
         array_push($data, $teacher->teacher_password);
        array_push($userData, $data);
        }
        array_push($userData, ['Coordinator Fullname', 'Coordinator Username', 'Coordinator Password']);
        $coordinators=Coordinator::all();
        foreach($coordinators as $coordinator){
         $data=[];
         $fullname= $coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name, 0, 1). " ". $coordinator->coordinator_last_name. " ". $coordinator->coordinator_suffix;
         array_push($data, $fullname);
         array_push($data, $coordinator->coordinator_username);
         array_push($data, $coordinator->coordinator_password);
        array_push($userData, $data);
        }
        $fileName = 'all_users.xlsx';
        }

        // Set the desired filename for the exported Excel file.
    
        return Excel::download(new Users(collect($userData)), $fileName);
    }

    public function ClassScheduleExportPDF(Request $request){
        $imageUrl = public_path('images/logo.jfif');
        $imageData = File::get($imageUrl);
        $class_id= $request->input('schedPDF');
       
        if($request->input('action')==="preview"){
            if($class_id!='All'){
                $data = [
                    'class_id' =>$class_id,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
        
                $pdf = PDF::loadView('administrator.classScheduleExportPdf', $data);
                $pdf->setPaper('legal', 'landscape');
                return $pdf->stream('administrator.classScheduleExportPdf', ['Attachment' => false]);
            }else{
                $data = [
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
        
                $pdf = PDF::loadView('administrator.classScheduleExportPdfAll', $data);
                $pdf->setPaper('legal', 'landscape');
                return $pdf->stream('administrator.classScheduleExportPdfAll', ['Attachment' => false]);
            }
           
        
        }else if($request->input('action')==='download'){
            $class_id= $request->input('schedPDF');
            $imageUrl = public_path('images/logo.jfif');
            $imageData = File::get($imageUrl);
            if($class_id!='All'){
                $data = [
                    'class_id' =>$class_id,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
            $section= Section::where('id', $class_id)->first();
            $strand= Strand::where('id', $section->strand_id)->first();
                $pdf = PDF::loadView('administrator.classScheduleExportPdf', $data);
                $pdf->setPaper('legal', 'landscape');
                return $pdf->download('Schedules_'.$strand->strand_shortcut.'-'.$section->year_level. '-'.$section->section.'.pdf');
            }else{
                $pdfContents = [];
                $sections= Section::where('id', '!=', 25)->get();
                $imageUrl = public_path('images/logo.jfif');
                $imageData = File::get($imageUrl);
                foreach($sections as $section){
                    $data = [
                        'logoData' => base64_encode($imageData), 
                        'class_id' => $section->id,
                    ];
             $strand= Strand::where('id', $section->strand_id)->first();
                    $pdf = PDF::loadView('administrator.classScheduleExportPdf', $data);
                    $pdf->setPaper('legal', 'landscape');
                    $pdfContents[] = [
                        'content' => $pdf->output(),
                        'filename' => 'Class_Schedule(' . $strand->strand_shortcut.'-'.$section->year_level. '-'. $section->section. ').pdf',
                    ];
                }
                $data=[
                    'logoData' => base64_encode($imageData), 
                ];
                
                $pdf = PDF::loadView('administrator.classScheduleExportPdfAll', $data);
                $pdf->setPaper('legal', 'landscape');
                $pdfContents[] = [
                    'content' => $pdf->output(),
                    'filename' => 'All_Class_Schedule.pdf',
                ];
                $zipFileName = 'Class_Schedules.zip';
                $zipFilePath = public_path($zipFileName);
        
                $zip = new ZipArchive();
                if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                    foreach ($pdfContents as $pdfContent) {
                        $zip->addFromString($pdfContent['filename'], $pdfContent['content']);
                    }

                    $zip->close();
        
                    // Provide the zip archive for download
                    return Response::download($zipFilePath)->deleteFileAfterSend(true);
                } else {
                    return response()->json(['message' => 'Failed to create zip archive'], 500);
                }
               
            }
        }
    }
    public function AddRoom(Request $request){
      if($request->input('submit')==="add"){
        $data = $request->validate([
            'addRoom' => 'required',
            'building'=>'required',
        ]);
        
        $room = new Room();
        $room->room_name = $data['addRoom'];
        switch($data['building']){
            case 1:
                $room->room_building ='1st Building';
                $room->room_floor = ' ';
                break;
            case 2:
                $room->room_building= '2nd Building';
                $room->room_floor= '1st Floor';
                break;
            case 3:
                $room->room_building= '2nd Building';
                $room->room_floor= '2nd Floor';
                break;
            case 4:
                $room->room_building = '2nd Building';
                $room->room_floor = '3rd Floor';
                break;
            case 5:
                $room->room_building = '2nd Building';
                $room->room_floor= '4th Floor';
                break;
        }
        $room->save();
        $newRoomId = $room->id;
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeStamps = ['7:30AM - 8:30AM', '8:30AM - 9:30AM', '9:45AM - 10:45AM', '10:45AM - 11:45AM', '1:00PM - 2:00PM', '2:00PM - 3:00PM', '3:00PM - 4:00PM', '4:00PM - 5:00PM'];
        
        foreach ($days as $day) {
            $roomAvailable = new RoomAvailable(); // Create a new RoomAvailable object for each day
            $roomAvailable->room_id = $newRoomId;
            $roomAvailable->room_day = $day;
        
            foreach ($timeStamps as $time) {
                // Create dynamic property name using a sanitized version of the time
              
                $roomAvailable->$time = 0;
            }
        
            $roomAvailable->save();
        }
        
      }else if($request->input('submit')==="delete"){
        $adminPass = $request->input('password');
        $admin = Admin::where('admin_type', 'Super Admin')->first();
        
        if ($adminPass === $admin->admin_password) {
            $selectedRoomIds = $request->input('selectedRoom', []);
        
            foreach ($selectedRoomIds as $room) {
                $room = Room::find($room);
        
                if ($room) {
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        
                    foreach ($days as $day) {
                        $roomAvailable = RoomAvailable::where('room_day', $day)->where('room_id', $room->id)->first();
        
                        if ($roomAvailable) {
                            $roomAvailable->delete();
                        }
                    }
        
                    $room->delete();
                }
            }
        }
        
        
        
      }
       
        return redirect()->back();
        
    }


    public function AddStrand(Request $request){
        if($request->input('submit')==="add"){
          $data = $request->validate([
              'addStrand' => 'required',
              'addStrandShortcut'=>'required',
          ]);
          
          $strand = new Strand();
          $strand->strand_name = $data['addStrand'];
          $strand->strand_shortcut= $data['addStrandShortcut'];
          $strand->save();
          $strand_id = $strand->id;
          
          $sects= ['A', 'B'];
          $grades= ['Grade 11', 'Grade 12'];
         
          foreach($grades as $grade){
             foreach($sects as $sect){
                $section= new Section();
                $section->section= $sect;
                $section->year_level= $grade;
                $section->strand_id= $strand_id;
                $section->save();
             }
           
          }
          
        }else if($request->input('submit')==="delete"){
            $adminPass = $request->input('password');
            $admin = Admin::where('admin_type', 'Super Admin')->first();
            
            if ($adminPass === $admin->admin_password) {
                $selectedStrand = $request->input('selectedStrand', []);
            
                foreach ($selectedStrand as $strandId) {
                    $strand = Strand::find($strandId);
            
                    if ($strand) {
                        $grades = ['Grade 11', 'Grade 12'];
            
                        foreach ($grades as $grade) {
                            $sections = Section::where('year_level', $grade)->where('strand_id', $strandId)->get();
            
                            foreach ($sections as $section) {
                                $section->delete();
                            }
                        }
            
                        $strand->delete();
                    }
                }
            }
            
          
        }
         
          return redirect()->back();
          
      }


      public function AddSection(Request $request){
        if($request->input('submit')==="add"){
          $data = $request->validate([
              'addSection' => 'required',
              'sectionYear'=>'required',
              'sectionStrand'=>'required',
          ]);
          
          $section = new Section();
          $section->section = $data['addSection'];
          $section->year_level= $data['sectionYear'];
          $section->strand_id= $data['sectionStrand'];
          $section->save();
          $newSection= $section->id;
         
          $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
          $timeStamps = ['7:30AM - 8:30AM', '8:30AM - 9:30AM', '9:45AM - 10:45AM', '10:45AM - 11:45AM', '1:00PM - 2:00PM', '2:00PM - 3:00PM', '3:00PM - 4:00PM', '4:00PM - 5:00PM'];
        
          foreach($days as $day){
            foreach($timeStamps as $time){
                $schedule= new ClassSchedule();
                $schedule->sched_day= $day;
                $schedule->sched_time= $time;
                $schedule->sched_room= 13;
                $schedule->sched_teacher= 6;
                $schedule->sched_subject=204;
                $schedule->sched_class_name= $newSection;
                $schedule->save();
            }
          }
          
        }else if($request->input('submit')==="delete"){
            $adminPass = $request->input('password');
            $admin = Admin::where('admin_type', 'Super Admin')->first();
            
            if ($adminPass === $admin->admin_password) {
                $selectedSection = $request->input('selectedSection', []);
            
                foreach ($selectedSection as $sect) {
                    $section = Section::find($sect);
            
                    if ($section) {
                        $schedules = ClassSchedule::where('sched_class_name', $sect)->get();

                        foreach ($schedules as $schedule) {
                            $schedule->delete();
                        }
            
                          
                       $section->delete();
                    }
                }
            }
            
          
        }
         
          return redirect()->back();
          
      }

      public function DeployEvaluation(Request $request){
      

        $admin= Admin::where('admin_type', 'Super Admin')->first();
        if($admin->admin_password===$request->input('adminPass')){
            if($request->input('status')==="true"){
                $dateTime = $request->input('dateTime');
                if(empty($dateTime)){
                    $FinaldateTime = 'none';
                    $eventName= 'Deployed Evaluation(Schedule Not Set)';
                }else{
                    $dateTimeObj = \Carbon\Carbon::parse($dateTime);
                    $FinaldateTime = $dateTimeObj->format('Y-m-j H:i');           
                    $eventName = 'Deployed Evaluation(Schedule Set To Expire At '.$FinaldateTime.')';
                }
                $admin->update([
                    'admin_evaluation_status'=>1,
                    'admin_evaluation_schedule'=>$FinaldateTime ,
                ]);
                $event= new Event();
                $event->event_name = $eventName;
                $event->save();
            }else{
                $admin->update([
                    'admin_evaluation_status'=>0,
                ]);
                $event= new Event();
                $event->event_name = 'Evaluation Closed(Manually)';
                $event->save();
            }
            
        }

        return redirect()->back();
      }

      //Settings
      public function Settings(){
        return view('administrator.settings');
      }

      public function SaveEvaluationDataOnStorage(Request $request){

        $data= $request->validate([
            'dataName'=>'required',
        ]);
        $admin= Admin::where('admin_type', 'Super Admin')->first();

        $checkSave = SavedEvaluation::where('evaluation_sem', $admin->admin_sem)->where('evaluation_year', $admin->admin_sy)->first();
        if($checkSave){
          return response()->json(['message'=>'error', 'dataId'=> $checkSave->id]);
        }else{
            $tableData = EvaluationResult::all();

            $saved= new SavedEvaluation();
            $saved->evaluation_name= $data['dataName'];
            $saved->evaluation_sem= $admin->admin_sem;
            $saved->evaluation_year= $admin->admin_sy;
            $saved->saved_status= 'save';
            $saved->save();
            
            foreach($tableData as $data){
                $analytics= new Analytics();
                $analytics->evaluator_id= $data->evaluator_id;
                $analytics->evaluator_type= $data->evaluator_type;
                $analytics->teacher_id= $data->teacher_id;
                $analytics->question_id= $data->question_id;
                $analytics->evaluation_score= $data->evaluation_score;
                $analytics->evaluation_remarks= $data->evaluation_remarks;
                $analytics->evaluation_id= $saved->id;
                $analytics->semester=$admin->admin_sem;
                $analytics->acad_year= $admin->admin_sy;
                $analytics->save();
            }
            foreach($tableData as $delete){
                $delete->delete();
            }

            $event= new Event();
            $event->event_name = 'Saved Evaluation Data';
            $event->save();
            return response()->json(['message'=> 'success']);
        }

      }

      public function OverWriteSaveData(Request $request){
        $data= $request->validate([
            'dataName'=>'required',
        ]);
        $admin= Admin::where('admin_type', 'Super Admin')->first();
        $tableData = EvaluationResult::all();

        $saved= SavedEvaluation::where('id', $request->input('data'))->first();
        $saved->update([
         'evaluation_name'=>$data['dataName'],
         'evaluation_sem'=> $admin->admin_sem,
         'evaluation_year'=> $admin->admin_sy,
         'saved_status'=>'save',
        ]);
        $event= new Event();
        $event->event_name = 'Overwrite Evaluation Data('. $data['dataName']. ")";
        $event->save();
        $analytics = Analytics::where('evaluation_id', $request->input('data'))->get();
        foreach($analytics as $anal){
            $anal->delete();
        }
        foreach($tableData as $data){
            $analytics= new Analytics();
            $analytics->evaluator_id= $data->evaluator_id;
            $analytics->evaluator_type= $data->evaluator_type;
            $analytics->teacher_id= $data->teacher_id;
            $analytics->question_id= $data->question_id;
            $analytics->evaluation_score= $data->evaluation_score;
            $analytics->evaluation_remarks= $data->evaluation_remarks;
            $analytics->evaluation_id= $saved->id;
            $analytics->semester=$admin->admin_sem;
            $analytics->acad_year= $admin->admin_sy;
            $analytics->save();
        }
        foreach($tableData as $delete){
            $delete->delete();
        }

        return response()->json(['message'=> 'success']);

      }
      public function DeleteOrLoadData(Request $request){
    

            $save= SavedEvaluation::where('id', $request->input('selectedData'))->first();
            if($save->saved_status==="save"){
               
                $analytics= Analytics::where('evaluation_id', $request->input('selectedData'))->get();

                foreach($analytics as $data){
                    $result= new EvaluationResult();
                    $result->evaluator_id= $data->evaluator_id;
                    $result->evaluator_type= $data->evaluator_type;
                    $result->teacher_id= $data->teacher_id;
                    $result->question_id= $data->question_id;
                    $result->evaluation_score= $data->evaluation_score;
                    $result->evaluation_remarks= $data->evaluation_remarks;
                    $result->save();
                }
                $save->update([
                    'saved_status'=>'loaded',
                 ]);
                 $event= new Event();
                 $event->event_name = 'Load data('. $save->evaluation_name. ")";
                 $event->save();
 
                 return response()->json(['message' => 'Data loaded successfully'], 200);
        
        }else{
            return response()->json(['message' => 'Data is already loaded'], 200);
        }

        return redirect()->back();
      }

      public function DeleteEvaluationData(Request $request){
        $admin= Admin::where('admin_type','Super Admin')->first();
        if($request->input('adminPassword')===$admin->admin_password){
            $saved= SavedEvaluation::where('id', $request->input('data'))->first();
            $saved->delete(); 
            $deleteData= Analytics::where('evaluation_id', $request->input('data'))->get();
            $event= new Event();
            $event->event_name = 'Delete Evaluation Data';
            $event->save();
            foreach($deleteData as $data){
                $data->delete();
            }
        }
      
        return redirect()->back();
      }

      public function Credits(){
        return view('administrator.credits');
      }
      public function Feedback(){
        return view('administrator.feedback');
      }

      public function SendFeedback(Request $request){
        $data= $request->validate([
          'email'=>'required',
          'message'=>'required',
        ]);


        $feedback= new Feedback();
        $feedback->sender_mail= $data['email'];
        $feedback->message= $data['message'];
        $feedback->status= "stat";
        $feedback->save();

        return redirect()->back();
      }
      public function PatchNotes(){
        return view('administrator.patchnotes');
      }

      //DASHBOARD POPULATION LIST

      public function StudentList(){
        return view('administrator.liststudent');
      }
      public function TeacherList(){
        return view('administrator.listteacher');
      }
      public function CoordinatorList(){
        return view('administrator.listcoordinator');
      }

      //Logout
      public function logout(Request $request)
      {
        $request->session()->forget('user_id');
        $request->session()->forget('user_type');
        $event= new Event();
        $event->event_name ='Admin Logout';
        $event->save();
        return redirect()->route('login.index');
      }

    
     public function ResetData(Request $request){
        $data= $request->validate([
            'adminPassword'=>'required',
        ]);

        $adminPassword= Admin::where('admin_type', 'Super Admin')->first()->admin_password;

        if($data['adminPassword']===$adminPassword){
            $evaluations= EvaluationResult::all();
            $savedEvaluation= SavedEvaluation::all();
          
                foreach($evaluations as $eval){
                    $eval->delete();
                }

                foreach($savedEvaluation as $save){
                    
                    $save->update(['saved_status'=>'save']);
                }
            
          
        }
        $event= new Event();
        $event->event_name = 'Reset Evaluation Data';
        $event->save();
        return redirect()->route('viewData');
     }     


     public function FetchSections(Request $request){

        $data= Section::where('strand_id', $request->input('strand_id'))->get();

        return response()->json($data);
     }

   
    public function OpenBatchAdd(Request $request){
        $strand = $request->input('strand');
        $year_level = $request->input('year_level');
        $quantity = $request->input('quantity');
        $type = $request->input('type');
        return view('administrator.addbatch', [
            'strand_id'=>$strand,
            'section_id'=>$year_level,
            'quantity'=>$quantity,
            'type'=>$type,
        ]);
        
    }

    public function AddStudentBatch(Request $request){
        $fname = $request->input('first_name');
        $mname = $request->input('middle_name');
        $lname= $request->input('last_name');
        $suffix = $request->input('suffix');
        $lrn = $request->input('lrn');
        $strand = $request->input('strand');
        $section = $request->input('section');
        $quantity = $request->input('quantity');

        $data = [];
        for($i=0; $i<$quantity; $i++){
            $checkStudent = Student::where('student_id', $lrn[$i])->first();
            if($checkStudent){
             array_push($data, ['message'=>"error", 'lrn'=> $lrn[$i], 'firstName'=> $fname[$i],
            'middleName'=> $mname[$i], 'lastName'=>$lname[$i], 'suffix'=> $suffix[$i]]);
            }else{

                $finalMname = empty($mname[$i]) ? ' ' : $mname[$i];
                $year= Section::where('id', $section)->first();
                $student = new Student();
                $student->student_first_name = $fname[$i];
                $student->student_last_name = $lname[$i];
                $student->student_middle_name = $finalMname;
                $student->student_suffix = $suffix[$i];
                $student->student_id = $lrn[$i];
                $student->student_password = randomString(8);
                $student->student_year_level= $year->year_level;
                $student->student_strand= $strand;
                $student->student_section = $section;
                $student->student_image = 0;
                $student->student_image_type = " ";
                $student->student_status= 0;
                $student->student_mail = '';
                $student->save();
                array_push($data, ['message'=>"success", 'lrn'=> 'empty', 'firstName'=> 'empty',
                'middleName'=>'empty', 'lastName'=>'empty', 'suffix'=> 'empty']);
            }    
        }
        
        return response()->json(['data' => $data]);
}


    public function AddBatchTeacher(Request $request){
        $fname = $request->input('first_name');
        $mname = $request->input('middle_name');
        $lname= $request->input('last_name');
        $suffix = $request->input('suffix');
        $username = $request->input('username');
        $quantity = $request->input('quantity');

        
        ensureUniqueUsernames($username);
        
        $data=[];
        for($i =0; $i<$quantity; $i++){
            $checkTeacher = Teacher::where('teacher_username', $username[$i])->first();
            if($checkTeacher){
                array_push($data, ['message'=>"error", 'username'=> $username[$i], 'fname'=> $fname[$i], 'mname'=> $mname[$i], 'lname'=>$lname[$i], 'suffix'=> $suffix[$i]]);
            }else{
                $finalMname = empty($mname[$i]) ? ' ' : $mname[$i];
                $teacher = new Teacher();
                $teacher->teacher_first_name = $fname[$i];
                $teacher->teacher_middle_name = $finalMname;
                $teacher->teacher_last_name = $lname[$i];
                $teacher->teacher_suffix = $suffix[$i];
                $teacher->teacher_username = $username[$i];
                $teacher->teacher_password = randomString(8);
                $teacher->teacher_mail ='';
                $teacher->teacher_image = 0;
                $teacher->teacher_image_type =" ";
                $teacher->teacher_status = 0;
                $teacher->save();

                array_push($data, ['message'=>"success", 'username'=> 'empty', 'fname'=> 'empty', 'mname'=> 'empty', 'lname'=>'empty', 'suffix'=> 'empty']);
            }
          
        }
    
        return response()->json(['data' => $data]);
    }

    public function AddBatchCoordinator(Request $request){
        $fname = $request->input('first_name');
        $mname = $request->input('middle_name');
        $lname= $request->input('last_name');
        $position= $request->input('position');
        $suffix = $request->input('suffix');
        $username = $request->input('username');
        $quantity = $request->input('quantity');

       
        ensureUniqueUsernames($username);

        $data= [];
        for($i =0; $i<$quantity; $i++){
            $checkCoordinator= Coordinator::where('coordinator_username', $username[$i])->first();
            if($checkCoordinator){
                array_push($data, ['message'=>"error", 'username'=> $username[$i], 'fname'=> $fname[$i], 'mname'=> $mname[$i], 'lname'=>$lname[$i], 'suffix'=> $suffix[$i], 'position'=> $position[$i]]);
            }else{
                $finalMname = empty($mname[$i]) ? ' ' : $mname[$i];
                $Coordinator = new Coordinator();
                $Coordinator->coordinator_first_name = $fname[$i];
                $Coordinator->coordinator_middle_name = $finalMname;
                $Coordinator->coordinator_last_name = $lname[$i];
                $Coordinator->coordinator_suffix = $suffix[$i];
                $Coordinator->coordinator_username = $username[$i];
                $Coordinator->coordinator_password = randomString(8);
                $Coordinator->coordinator_mail ='';
                $Coordinator->coordinator_position = $position[$i];
                $Coordinator->coordinator_image = 0;
                $Coordinator->coordinator_image_type =" ";
                $Coordinator->coordinator_status = 0;
                $Coordinator->save();
                
                array_push($data, ['message'=>"success", 'username'=> 'empty', 'fname'=> 'empty', 'mname'=> 'empty', 'lname'=>'empty', 'suffix'=> 'empty', 'positon'=> 'empty']);
            }
           
        }
       
        return response()->json(['data' => $data]);
    }

    public function SearchUser(Request $request){
        
        $search = $request->input('search');
        $filter= $request->input('filter');
        $data=[];
        if($filter==="1"){
        $studentFirstName= Student::where('student_first_name', $search)->get();
        $studentMiddleName = Student::where('student_middle_name', $search)->get();
        $studentLastName = Student::where('student_last_name', $search)->get();

        $teacherFirstName = Teacher::where('teacher_first_name', $search)->get();
        $teacherMiddleName = Teacher::where('teacher_middle_name', $search)->get();
        $teacherLastName = Teacher::where('teacher_last_name', $search)->get();

        $coordinatorFirstName = Coordinator::where('coordinator_first_name', $search)->get();
        $coordinatorMiddleName = Coordinator::where('coordinator_middle_name', $search)->get();
        $coordinatorLastName = Coordinator::where('coordinator_last_name', $search)->get();
 

      
        if($studentFirstName->isEmpty()&&
           $studentMiddleName->isEmpty() &&
           $studentLastName->isEmpty() &&
           $teacherFirstName->isEmpty() &&
           $teacherLastName->isEmpty() &&
           $teacherMiddleName->isEmpty() &&
           $coordinatorFirstName->isEmpty() &&
           $coordinatorLastName->isEmpty() &&
           $coordinatorMiddleName->isEmpty()){

            array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
            return response()->json($data);
        }else{
          
            if($studentFirstName->isNotEmpty()){
                foreach($studentFirstName as $studentFirst){
                    if($studentFirst->student_suffix==='none'){
                        $finalSuffix= '';
                    }else{
                        $finalSuffix = $studentFirst->student_suffix;
                    }
                    $fullname = $studentFirst->student_first_name . " ". $studentFirst->student_middle_name ." ". $studentFirst->student_last_name. " ". $finalSuffix;
                    array_push($data, ['fullname'=>$fullname, 'username'=>$studentFirst->student_id, 'type'=>'Student', 'id'=>$studentFirst->student_id]);
                }
            }

            if ($studentMiddleName->isNotEmpty()) {
                foreach ($studentMiddleName as $studentMiddle) {
                    if ($studentMiddle->student_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $studentMiddle->student_suffix;
                    }
                    $fullname = $studentMiddle->student_first_name . " " . $studentMiddle->student_middle_name . " " . $studentMiddle->student_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $studentMiddle->student_id, 'type' => 'Student', 'id'=>$studentMiddle->student_id]);
                }
            }

            if ($studentLastName->isNotEmpty()) {
                foreach ($studentLastName as $studentLast) {
                    if ($studentLast->student_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $studentLast->student_suffix;
                    }
                    $fullname = $studentLast->student_first_name . " " . $studentLast->student_middle_name . " " . $studentLast->student_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $studentLast->student_id, 'type' => 'Student', 'id'=>$studentLast->student_id]);
                }
            }
            

            if ($teacherFirstName->isNotEmpty()) {
                foreach ($teacherFirstName as $teacherFirst) {
                    if ($teacherFirst->teacher_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $teacherFirst->teacher_suffix;
                    }
                    $fullname = $teacherFirst->teacher_first_name . " " . $teacherFirst->teacher_middle_name . " " . $teacherFirst->teacher_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $teacherFirst->teacher_username, 'type' => 'Teacher', 'id'=>$teacherFirst->id]);
                }
            }
            if ($teacherMiddleName->isNotEmpty()) {
                foreach ($teacherMiddleName as $teacherMiddle) {
                    if ($teacherMiddle->teacher_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $teacherMiddle->teacher_suffix;
                    }
                    $fullname = $teacherMiddle->teacher_first_name . " " . $teacherMiddle->teacher_middle_name . " " . $teacherMiddle->teacher_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $teacherMiddle->teacher_username, 'type' => 'Teacher', 'id'=>$teacherMiddle->id]);
                }
            }
            if ($teacherLastName->isNotEmpty()) {
                foreach ($teacherLastName as $teacherLast) {
                    if ($teacherLast->teacher_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $teacherLast->teacher_suffix;
                    }
                    $fullname = $teacherLast->teacher_first_name . " " . $teacherLast->teacher_middle_name . " " . $teacherLast->teacher_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $teacherLast->teacher_username, 'type' => 'Teacher', 'id'=>$teacherLast->id]);
                }
            }
            if ($coordinatorFirstName->isNotEmpty()) {
                foreach ($coordinatorFirstName as $coordinatorFirst) {
                    if ($coordinatorFirst->coordinator_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $coordinatorFirst->coordinator_suffix;
                    }
                    $fullname = $coordinatorFirst->coordinator_first_name . " " . $coordinatorFirst->coordinator_middle_name . " " . $coordinatorFirst->coordinator_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $coordinatorFirst->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorFirst->id]);
                }
            }
            if ($coordinatorMiddleName->isNotEmpty()) {
                foreach ($coordinatorMiddleName as $coordinatorMiddle) {
                    if ($coordinatorMiddle->coordinator_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $coordinatorMiddle->coordinator_suffix;
                    }
                    $fullname = $coordinatorMiddle->coordinator_first_name . " " . $coordinatorMiddle->coordinator_middle_name . " " . $coordinatorMiddle->coordinator_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $coordinatorMiddle->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorMiddle->id]);
                }
            }
            if ($coordinatorLastName->isNotEmpty()) {
                foreach ($coordinatorLastName as $coordinatorLast) {
                    if ($coordinatorLast->coordinator_suffix === 'none') {
                        $finalSuffix = '';
                    } else {
                        $finalSuffix = $coordinatorLast->coordinator_suffix;
                    }
                    $fullname = $coordinatorLast->coordinator_first_name . " " . $coordinatorLast->coordinator_middle_name. " " . $coordinatorLast->coordinator_last_name . " " . $finalSuffix;
                    array_push($data, ['fullname' => $fullname, 'username' => $coordinatorLast->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorLast->id]);
                }
            }
            return response()->json($data);                                                        
        }


   
        }
        if($filter === "2"){
            $studentFirstName= Student::where('student_first_name', $search)->get();
            $studentMiddleName = Student::where('student_middle_name', $search)->get();
            $studentLastName = Student::where('student_last_name', $search)->get();

    
            if($studentFirstName->isEmpty()&&
               $studentMiddleName->isEmpty() &&
               $studentLastName->isEmpty()
              ){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if($studentFirstName->isNotEmpty()){
                    foreach($studentFirstName as $studentFirst){
                        if($studentFirst->student_suffix==='none'){
                            $finalSuffix= '';
                        }else{
                            $finalSuffix = $studentFirst->student_suffix;
                        }
                        $fullname = $studentFirst->student_first_name . " ". $studentFirst->student_middle_name ." ". $studentFirst->student_last_name. " ". $finalSuffix;
                        array_push($data, ['fullname'=>$fullname, 'username'=>$studentFirst->student_id, 'type'=>'Student', 'id'=>$studentFirst->student_id]);
                    }
                }
    
                if ($studentMiddleName->isNotEmpty()) {
                    foreach ($studentMiddleName as $studentMiddle) {
                        if ($studentMiddle->student_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $studentMiddle->student_suffix;
                        }
                        $fullname = $studentMiddle->student_first_name . " " . $studentMiddle->student_middle_name . " " . $studentMiddle->student_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $studentMiddle->student_id, 'type' => 'Student', 'id'=>$studentMiddle->student_id]);
                    }
                }
    
                if ($studentLastName->isNotEmpty()) {
                    foreach ($studentLastName as $studentLast) {
                        if ($studentLast->student_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $studentLast->student_suffix;
                        }
                        $fullname = $studentLast->student_first_name . " " . $studentLast->student_middle_name . " " . $studentLast->student_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $studentLast->student_id, 'type' => 'Student', 'id'=>$studentLast->student_id]);
                    }
                }
                return response()->json($data);
            }   
            
      
        }

        if($filter === "3"){
            $teacherFirstName = Teacher::where('teacher_first_name', $search)->get();
            $teacherMiddleName = Teacher::where('teacher_middle_name', $search)->get();
            $teacherLastName = Teacher::where('teacher_last_name', $search)->get();

           
            if( $teacherFirstName->isEmpty() &&
            $teacherLastName->isEmpty() &&
            $teacherMiddleName->isEmpty()
              ){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if ($teacherFirstName->isNotEmpty()) {
                    foreach ($teacherFirstName as $teacherFirst) {
                        if ($teacherFirst->teacher_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $teacherFirst->teacher_suffix;
                        }
                        $fullname = $teacherFirst->teacher_first_name . " " . $teacherFirst->teacher_middle_name . " " . $teacherFirst->teacher_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $teacherFirst->teacher_username, 'type' => 'Teacher', 'id'=>$teacherFirst->id]);
                    }
                }
                if ($teacherMiddleName->isNotEmpty()) {
                    foreach ($teacherMiddleName as $teacherMiddle) {
                        if ($teacherMiddle->teacher_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $teacherMiddle->teacher_suffix;
                        }
                        $fullname = $teacherMiddle->teacher_first_name . " " . $teacherMiddle->teacher_middle_name . " " . $teacherMiddle->teacher_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $teacherMiddle->teacher_username, 'type' => 'Teacher', 'id'=>$teacherMiddle->id]);
                    }
                }
                if ($teacherLastName->isNotEmpty()) {
                    foreach ($teacherLastName as $teacherLast) {
                        if ($teacherLast->teacher_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $teacherLast->teacher_suffix;
                        }
                        $fullname = $teacherLast->teacher_first_name . " " . $teacherLast->teacher_middle_name . " " . $teacherLast->teacher_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $teacherLast->teacher_username, 'type' => 'Teacher', 'id'=>$teacherLast->id]);
                    }
                }
                return response()->json($data);
            }
        }
        
        if($filter=== "4"){
            $coordinatorFirstName = Coordinator::where('coordinator_first_name', $search)->get();
            $coordinatorMiddleName = Coordinator::where('coordinator_middle_name', $search)->get();
            $coordinatorLastName = Coordinator::where('coordinator_last_name', $search)->get();
     
    
          
            
            if(
               $coordinatorFirstName->isEmpty() &&
               $coordinatorLastName->isEmpty() &&
               $coordinatorMiddleName->isEmpty()){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if ($coordinatorFirstName->isNotEmpty()) {
                    foreach ($coordinatorFirstName as $coordinatorFirst) {
                        if ($coordinatorFirst->coordinator_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $coordinatorFirst->coordinator_suffix;
                        }
                        $fullname = $coordinatorFirst->coordinator_first_name . " " . $coordinatorFirst->coordinator_middle_name . " " . $coordinatorFirst->coordinator_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $coordinatorFirst->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorFirst->id]);
                    }
                }
                if ($coordinatorMiddleName->isNotEmpty()) {
                    foreach ($coordinatorMiddleName as $coordinatorMiddle) {
                        if ($coordinatorMiddle->coordinator_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $coordinatorMiddle->coordinator_suffix;
                        }
                        $fullname = $coordinatorMiddle->coordinator_first_name . " " . $coordinatorMiddle->coordinator_middle_name . " " . $coordinatorMiddle->coordinator_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $coordinatorMiddle->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorMiddle->id]);
                    }
                }
                if ($coordinatorLastName->isNotEmpty()) {
                    foreach ($coordinatorLastName as $coordinatorLast) {
                        if ($coordinatorLast->coordinator_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $coordinatorLast->coordinator_suffix;
                        }
                        $fullname = $coordinatorLast->coordinator_first_name . " " . $coordinatorLast->coordinator_middle_name. " " . $coordinatorLast->coordinator_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $coordinatorLast->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorLast->id]);
                    }
                }
                return response()->json($data);                 
            }
        }

        if($filter==="5"){
            $student= Student::where('student_id', $search)->get();

          
            if($student->isEmpty()
              ){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if($student->isNotEmpty()){
                    foreach($student as $studentFirst){
                        if($studentFirst->student_suffix==='none'){
                            $finalSuffix= '';
                        }else{
                            $finalSuffix = $studentFirst->student_suffix;
                        }
                        $fullname = $studentFirst->student_first_name . " ". $studentFirst->student_middle_name ." ". $studentFirst->student_last_name. " ". $finalSuffix;
                        array_push($data, ['fullname'=>$fullname, 'username'=>$studentFirst->student_id, 'type'=>'Student', 'id'=>$studentFirst->student_id]);
                    }
                }
    
                
                return response()->json($data);
            }   
      
        }

        
        if($filter==="5.1"){
            $student= Student::where('student_year_level', $search)->get();

            
            if($student->isEmpty()
              ){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if($student->isNotEmpty()){
                    foreach($student as $studentFirst){
                        if($studentFirst->student_suffix==='none'){
                            $finalSuffix= '';
                        }else{
                            $finalSuffix = $studentFirst->student_suffix;
                        }
                        $fullname = $studentFirst->student_first_name . " ". $studentFirst->student_middle_name ." ". $studentFirst->student_last_name. " ". $finalSuffix;
                        array_push($data, ['fullname'=>$fullname, 'username'=>$studentFirst->student_id, 'type'=>'Student', 'id'=>$studentFirst->student_id]);
                    }
                }
    
                
                return response()->json($data);
            }   
      
        }

        if($filter==="5.2"){
            $strandName = Strand::where('strand_name', $search)->first();
            $strandShortcut = Strand::where('strand_shortcut', $search)->first();
           

            if($strandName){
                $student= Student::where('student_strand', $strandName->id)->get();
            }elseif($strandShortcut){
                $student= Student::where('student_strand', $strandShortcut->id)->get();
            }else{
                $student= Student::where('student_strand', 0)->get();
            }
            
           
            if($student->isEmpty()){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if($student->isNotEmpty()){
                    foreach($student as $studentFirst){
                        if($studentFirst->student_suffix==='none'){
                            $finalSuffix= '';
                        }else{
                            $finalSuffix = $studentFirst->student_suffix;
                        }
                        $fullname = $studentFirst->student_first_name . " ". $studentFirst->student_middle_name ." ". $studentFirst->student_last_name. " ". $finalSuffix;
                        array_push($data, ['fullname'=>$fullname, 'username'=>$studentFirst->student_id, 'type'=>'Student', 'id'=>$studentFirst->student_id]);
                    }
                }
    
                
                return response()->json($data);
            }   
      
        }

        if($filter==="7"){
            $coordinator = Coordinator::where('coordinator_username', $search)->get();
            
            if(
               $coordinator->isEmpty()){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if ($coordinator->isNotEmpty()) {
                    foreach ($coordinator as $coordinatorFirst) {
                        if ($coordinatorFirst->coordinator_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $coordinatorFirst->coordinator_suffix;
                        }
                        $fullname = $coordinatorFirst->coordinator_first_name . " " . $coordinatorFirst->coordinator_middle_name . " " . $coordinatorFirst->coordinator_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $coordinatorFirst->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorFirst->id]);
                    }
                }
              
                return response()->json($data);                 
            }
        }

        if($filter === "6"){
            $teacher = Teacher::where('teacher_username', $search)->get();
           

           
            if( $teacher->isEmpty()  
              ){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if ($teacher->isNotEmpty()) {
                    foreach ($teacher as $teacherFirst) {
                        if ($teacherFirst->teacher_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $teacherFirst->teacher_suffix;
                        }
                        $fullname = $teacherFirst->teacher_first_name . " " . $teacherFirst->teacher_middle_name . " " . $teacherFirst->teacher_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $teacherFirst->teacher_username, 'type' => 'Teacher', 'id'=>$teacherFirst->id]);
                    }
                }
                
                return response()->json($data);
            }
        }

        if($filter==='7.1'){
            $coordinator = Coordinator::where('coordinator_position', $search)->get();
            
            if(
               $coordinator->isEmpty()){
    
                array_push($data, ['fullname'=>'empty', 'username'=>'empty', 'type'=>'empty', 'id'=>'empty']);
                return response()->json($data);
            }else{
                if ($coordinator->isNotEmpty()) {
                    foreach ($coordinator as $coordinatorFirst) {
                        if ($coordinatorFirst->coordinator_suffix === 'none') {
                            $finalSuffix = '';
                        } else {
                            $finalSuffix = $coordinatorFirst->coordinator_suffix;
                        }
                        $fullname = $coordinatorFirst->coordinator_first_name . " " . $coordinatorFirst->coordinator_middle_name . " " . $coordinatorFirst->coordinator_last_name . " " . $finalSuffix;
                        array_push($data, ['fullname' => $fullname, 'username' => $coordinatorFirst->coordinator_username, 'type' => 'Coordinator', 'id'=>$coordinatorFirst->id]);
                    }
                }
              
                return response()->json($data);                 
            }
        }
    }


  public function Events(){

   return view('administrator.event');
  }

  public function RecycleBin(){
    return view('administrator.recycle');
  }

  public function SendAccountDetails(Request $request){
    $id = $request->input('username');
    $type = $request->input('type');

    if($type=== 'Student'){
        $student= Student::where('student_id', $id)->first();
      
        $fname = $student->student_first_name;
        $mname = $student->student_middle_name;
        $lname = $student->student_last_name;
        $suffix = $student->student_suffix;
        $email = $student->student_mail;
        $username = $student->student_id. "(LRN)";
        $password = $student->student_password;

        Mail::to($email)->send(new SendMessageUser($fname, $mname, $lname, $suffix, $username, $password, $type, $email));  
        return response()->json(['message'=>'success']); 
    }else if($type === 'Teacher'){
        $teacher= Teacher::where('teacher_username', $id)->first();
     
        $fname = $teacher->teacher_first_name;
        $mname = $teacher->teacher_middle_name;
        $lname = $teacher->teacher_last_name;
        $suffix = $teacher->teacher_suffix;
        $email = $teacher->teacher_mail;
        $username = $teacher->teacher_username;
        $password = $teacher->teacher_password;

        Mail::to($email)->send(new SendMessageUser($fname, $mname, $lname, $suffix, $username, $password, $type, $email));  
        return response()->json(['message'=>'success']); 
    }else{
   $coordinator= Coordinator::where('coordinator_username', $id)->first();
     
        $fname = $coordinator->coordinator_first_name;
        $mname = $coordinator->coordinator_middle_name;
        $lname = $coordinator->coordinator_last_name;
        $suffix = $coordinator->coordinator_suffix;
        $email = $coordinator->coordinator_mail;
        $username = $coordinator->coordinator_username;
        $password = $coordinator->coordinator_password;

        Mail::to($email)->send(new SendMessageUser($fname, $mname, $lname, $suffix, $username, $password, $type, $email));  
        return response()->json(['message'=>'success']); 
    }
  }

  public function SendCustomMessage(Request $request){
    $id = $request->input('username');
    $type = $request->input('type');
    $subject = $request->input('subject');
    $message = $request->input('message');

    if($type==='Student'){
        $student= Student::where('student_id', $id)->first();
        if($student->student_suffix === 'none'){
            $finalSuffix='';
        }else{
            $finalSuffix=$student->student_suffix.' ';
        }
        $fullname = $student->student_last_name . " ". substr($student->student_first_name, 0, 1). ". ". $finalSuffix;
        Mail::to($student->student_mail)->send(new CustomMessage($subject,$message, $fullname));  
        return response()->json(['message'=>'success']); 
    }else if($type === 'Teacher'){
        $teacher= Teacher::where('teacher_username', $id)->first();
        if($teacher->teacher_suffix === 'none'){
            $finalSuffix='';
        }else{
            $finalSuffix=$teacher->teacher_suffix.' ';
        }
        $fullname = $teacher->teacher_last_name . " ". substr($teacher->teacher_first_name, 0, 1). ". ". $finalSuffix;
        Mail::to($teacher->teacher_mail)->send(new CustomMessage($subject,$message, $fullname));  
        return response()->json(['message'=>'success']); 
    }else{
        $coordinator= Coordinator::where('coordinator_username', $id)->first();
        if($coordinator->coordinator_suffix === 'none'){
            $finalSuffix='';
        }else{
            $finalSuffix=$coordinator->coordinator_suffix.' ';
        }
        $fullname = $coordinator->coordinator_last_name . " ". substr($coordinator->coordinator_first_name, 0, 1). ". ". $finalSuffix;
        Mail::to($coordinator->coordinator_mail)->send(new CustomMessage($subject, $message, $fullname));  
        return response()->json(['message'=>'success']); 
    }
  }
   
  public function AddSubject(Request $request){
    $subject = $request->input('subject');
    $strand = $request->input('strand');
    $sem = $request->input('sem');
    $gradeLevel = $request->input('gradeLevel');


    $addSubject = new AssignedSubject();

    $addSubject->assigned_year_level = $gradeLevel;
    $addSubject->assigned_strand = $strand;
    $addSubject->assigned_subject = $subject;
    $addSubject->assigned_sem= $sem;
    $addSubject->save();

    return redirect()->back();
  }

  public function ManageSubject(Request $request){

    $subjectID = $request->input('subjectId');
    $subject = $request->input('subject');
  
    $action = $request->input('action');

    if ($action === 'deletedSub') {
        $subjectData = AssignedSubject::where('id', $subjectID)->first();
        $subjectData->delete();

        return redirect()->back();
    } else {
        $subjectData = AssignedSubject::where('id', $subjectID)->first();
        $subjectData->update([
            'assigned_subject' => $subject,
        ]);

        return redirect()->back();
    } 

  }
  
  public function UpdateSection(Request $request){
      $sectionId= $request->input('updateSectionId');
      $sectionName = $request->input('updateSectionName');

      $section = Section::where('id', $sectionId)->first();
      $section->update([
         'section'=>$sectionName,
      ]);

      return response()->json(['message'=>'success']);
  }

  public function ScoreWeightPercentage(Request $request){
    $student = $request->input('studentWeight');
    $coordinator= $request->input('coordinatorWeight');

    $admin= Admin::where('admin_type', 'Super Admin')->first();

    $admin->update([
      'student_weight'=> $student,
      'coordinator_weight'=>$coordinator,
    ]);

    return response()->json(['message'=>'success']);
  }

 public function EvaluationCheck(Request $request){
    $teacher = $request->input('teacher');
    $student_id = $request->input('student_id');
    $type = $request->input('type');

    $eval = EvaluationResult::where('teacher_id', $teacher)->where('evaluator_type', $type)->where('evaluator_id', $student_id)->get();
    if($eval->count()>0){
        return response()->json(['result'=>1]);
    }else{
        return response()->json(['result'=>0]);
    }
 }

 public function ChangeSignatureImage(Request $request){
    if ($request->hasFile('signature')) {
        $image = $request->file('signature');
        $imageName = 'sign.'.$image->getClientOriginalExtension(); // Generate a unique name for the image

        $filePath = public_path('dashboard/img/');  
        $image->move($filePath, $imageName);
        // Optionally, you can return the URL of the saved image or perform other operations
        return response()->json(['message' => 'success']);
    }else{

  return response()->json(['message' => 'fail']);
    }

  
 }

 public function AutomaticBackup(Request $request){
    $value = $request->input('value');

    $admin= Admin::where('admin_type', 'Super Admin')->first();
    $admin->update([
        'backup'=>$value,
    ]);

    return response()->json(['message'=>'success']);
 }

 public function RestrictSemYear(Request $request){

   $years = $request->input('year');

   $savedYear = SavedEvaluation::all();

   $evaluationYear= [];
foreach($savedYear as $year){
    $semAssoc = SavedEvaluation::where('evaluation_year', $year->evaluation_year)->get()->count();
    array_push($evaluationYear,[ $year->evaluation_year, $semAssoc]);
}
$sem = SavedEvaluation::where('evaluation_year', $years)->get()->count();

return response()->json(['message'=>'success', 'year'=>$evaluationYear, 'sem'=>$sem]);
 }
}