<?php

namespace App\Http\Controllers;
use App\Models\EvaluationResult;
use App\Models\Question;
use App\Models\Student;
use App\Models\Coordinator;
use App\Models\Teacher;
use App\Models\Section;
use Illuminate\Support\Facades\Cookie;
use App\Mail\StudentVerification;
use App\Mail\FarewellRecoverMail;
use App\Mail\ChangeMailStudent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function SubmitEvaluation(Request $request){
        $question = Question::where('question_criteria', 'TEACHER ACTIONS')->count();


        for($i=1; $i<=$question; $i++){
           $data= $request->input('t'.$i);
           $remarks= $request->input('remarks');
           $teacher= $request->input('teacher_id');
           $student= $request->input('student_id');
           $questionData= $request->input('ques'.$i);

           $evaluation= EvaluationResult::where('evaluator_id', $student)->where('evaluator_type', 'Student')->where('teacher_id', $teacher)->where('question_id', $questionData)->first();
           if($evaluation){
               $evaluation->update([
                 'evaluation_score'=>$data,
                 'evaluation_remarks'=>$remarks,
               ]);
           }else{
            $result= new EvaluationResult();

            $result->evaluator_id= $student;
            $result->evaluator_type= "Student";
            $result->question_id= $questionData;
            $result->teacher_id= $teacher;
            $result->evaluation_score= $data;
            $result->evaluation_remarks= $remarks;
            $result->save();

           }
           
        }

        return redirect()->back()->with('Success', '[Evaluation Submitted]');
    }

    public function ScheduleToday(){
        return view('student.class_schedule_today');
    }
    public function ScheduleOverall(){
        return view('student.class_schedule_overall');
    }
    public function EvaluationSummary(){
        return view('student.evaluationsummary');
    }
    public function StudentProfile(){
      
        $student= Student::where('id', session('user_id'))->first();

     
        $year_level= $student->student_year_level;
        $suffix= $student->student_suffix;
      
        $trimYearLevel= substr($year_level, -2);
        if($suffix==="none"){
            $finalSuffix= " ";
        }else{
            $finalSuffix=$suffix;
        }
        $section= $student->student_section;
        $sectionQuery= Section::where('id', $section)->first();
        $fullname= $student->student_first_name. " ". substr($student->student_middle_name, 0, 1). ". ". $student->student_last_name. " ". $finalSuffix;
        return view('student.studentprofile', [
            'fullname'=>$fullname,
            'mail'=>$student->student_mail,
            'first_name'=>$student->student_first_name,
            'middle_name'=>$student->student_middle_name,
            'last_name'=>$student->student_last_name,
            'suffix'=>$suffix,
            'student_id'=>$student->student_id,
            'password'=>$student->student_password,
            'strand'=>$student->student_strand,
            'section'=>$student->student_section,
            'trimYearLevel'=>$trimYearLevel,
            'section_name'=>$sectionQuery->section,
            'student_mail'=>$student->student_mail,
          
        ]);
    }

    public function UpdateProfilePicStudent(Request $request){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Store the file in the public folder
        $file = $request->file('picture');
        $fileName = "Student(". session('user_id'). ").". $file->getClientOriginalExtension();
        $filePath = public_path('Users/');  // Adjust the storage path as needed

        // Save the file
        $file->move($filePath, $fileName);
        $student= Student::where('id', session('user_id'))->first();
        $student->update([
            'student_image'=>'1',
            'student_image_type'=> $file->getClientOriginalExtension(),
            'student_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function UpdatePersonalData(Request $request){
        $data= $request->validate([
           'first_name'=>'required',
           'middle_name'=>'required',
           'last_name'=>'required',
           'suffix'=>'required',
          
        ]);


        $student= Student::where('id', session('user_id'))->first();

        $student->update([
           'student_first_name'=> $data['first_name'],
           'student_middle_name'=>$data['middle_name'],
           'student_last_name'=>$data['last_name'],
           'student_suffix'=>$data['suffix'],
           'student_status'=>1,
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }

    public function ChangePassword(Request $request){

        $data= $request->validate([
            'newPassword'=>'required',
            'currentPassword'=>'required',
        ]);

        $student= Student::where('id', session('user_id'))->first();
        if($student->student_password===$data['currentPassword']){
            $student->update([
                'student_password'=>$data['newPassword'],
                'student_status'=>'1',
            ]);
            return redirect()->back()->with('Success', 'Changed Password');
        }else{
            return redirect()->back()->with('Fail', 'Incorrect Password');
        }
    }


    public function StudentVerificationMail(Request $request) {
        $coordinator= Coordinator::where('coordinator_mail', $request->input('email'))->first();
        $teacher= Teacher::where('teacher_mail', $request->input('email'))->first();
        $student=  Student::where('student_mail', $request->input('email'))->first();
        if($coordinator || $teacher || $student){
            return response()->json(['verificationCode' => 'Error']);
        }else{
            $verificationCode = verificationCode();
 
            Mail::to($request->input('email'))->send(new StudentVerification($verificationCode));      
            return response()->json(['verificationCode' => $verificationCode]);
        }
        
        
       
    
    }
    

    public function StudentSavedVerifiedData(Request $request){

        $student = Student::where('id', $request->input('user_id'))->first();

        $student->update([
          'student_password'=>$request->input('finalPassword'),
          'student_mail' =>$request->input('verifiedMail'),
          'student_status'=> 1,
        ]);

        return response()->json(['message' => 'Success'])
           ->withCookie(cookie()->forget('student_username'))
            ->withCookie(cookie()->forget('student_password'))
            ->withCookie(cookie()->forget('student_id'))
            ->withCookie(Cookie::make('student_username', $student->student_id, 7 * 24 * 60))
            ->withCookie(Cookie::make('student_password', $student->student_password, 7 * 24 * 60))
            ->withCookie(Cookie::make('student_id', $student->id, 7 * 24 * 60));
    }
    
    public function StudentRecoverChangePass(Request $request){
        $newpass = $request->input('newPass');
        $confPass = $request->input('confPass');

        if($newpass === $confPass){
            $student = Student::where('id', $request->input('student_id'))->first();
            $student->update([
                'student_password'=>$newpass,
            ]);
            return response()->json(['message' => 'Success']);
        }else{
            return response()->json(['message' => 'Fail']);
        }
    }

    public function ChangeRecoveryMailStudent(Request $request){

        $newMail = $request->input('newEmail');
        $id = $request->input('student_id');
        $verificationCode= verificationCode();
        $student = Student::where('id', $id)->first();
        if($student->student_suffix==='none'){
            $finalSuffix ='';
        }else{
            $finalSuffix= $student->student_suffix;
        }
        $fullname = $student->student_first_name. " ". substr($student->student_middle_name,0,1 ). ". ". $student->student_last_name. " ". $finalSuffix;
        
        $checkMailStudent = Student::where('student_mail', $newMail)->first(); 
        $checkMailTeacher = Teacher::where('teacher_mail', $newMail)->first(); 
        $checkMailCoordinator = Coordinator::where('coordinator_mail', $newMail)->first(); 
        if($student->student_mail === $newMail ||  $checkMailStudent || $checkMailTeacher || $checkMailCoordinator){
            return response()->json(['verificationCode' => 'error']);
        }else{
            
        Mail::to($newMail)->send(new ChangeMailStudent($fullname, $verificationCode, 'Student'));      
        return response()->json(['verificationCode' => $verificationCode]);
        }

    }

    public function ConfirmChangeMailStudent(Request $request){
        $id = $request->input('student_id');
        $newMail= $request->input('newEmail');

        $student= Student::where('id',$id)->first();
        if($student->student_suffix==='none'){
            $finalSuffix ='';
        }else{
            $finalSuffix= $student->student_suffix;
        }
        $fullname = $student->student_first_name . " ". substr($student->student_middle_name, 0, 1). ". ". $student->student_last_name . " ". $finalSuffix;
        Mail::to($student->student_mail)->send(new FarewellRecoverMail($fullname, $student->student_mail));   
        $student->update([
           'student_mail'=> $newMail,
        ]);
        return response()->json(['message' => 'success']);
    }
}
