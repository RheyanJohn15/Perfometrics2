<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationResult;
use App\Models\Question;
use App\Models\Student;
use App\Models\Coordinator;
use App\Models\Teacher;
use App\Mail\CoordinatorVerification;
use App\Mail\FarewellRecoverMail;
use App\Mail\ChangeMailCoordinator;
use Illuminate\Support\Facades\Mail;
class CoordinatorController extends Controller
{
    public function SubmitEvaluation(Request $request){
        $question = Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->count();


        for($i=1; $i<=$question; $i++){
           $data= $request->input('t'.$i);
           $remarks= $request->input('remarks');
           $teacher= $request->input('teacher_id');
           $student= $request->input('student_id');
           $questionData= $request->input('ques'.$i);

           $evaluation= EvaluationResult::where('evaluator_id', $student)->where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher)->where('question_id', $questionData)->first();
           if($evaluation){
               $evaluation->update([
                 'evaluation_score'=>$data,
                 'evaluation_remarks'=>$remarks,
               ]);
           }else{
            $result= new EvaluationResult();

            $result->evaluator_id= $student;
            $result->evaluator_type= "Coordinator";
            $result->question_id= $questionData;
            $result->teacher_id= $teacher;
            $result->evaluation_score= $data;
            $result->evaluation_remarks= $remarks;
            $result->save();

           }
           
        }

        return redirect()->back()->with('Success', '[Evaluation Submitted]');
    }

    public function EvaluationSummary(){
        return view('coordinator.evaluationSummary');
    }
    public function CoordinatorProfile(){
        $coordinator= Coordinator::where('id', session('user_id'))->first();
        if($coordinator->coordinator_suffix==="none"){
            $finalSuffix= " ";
        }else{
            $finalSuffix= $coordinator->coordinator_suffix;
        }
        $fullname= $coordinator->coordinator_first_name. " ". $coordinator->coordinator_last_name. " ". $coordinator->coordinator_last_name. " ".$finalSuffix;
        return view('coordinator.coordinatorProfile', [
            'fullname'=>$fullname,
            'first_name'=>$coordinator->coordinator_first_name,
            'last_name'=>$coordinator->coordinator_last_name,
            'middle_name'=>$coordinator->coordinator_middle_name,
            'suffix'=>$coordinator->coordinator_suffix,
            'username'=>$coordinator->coordinator_username,
            'password'=>$coordinator->coordinator_password,
            'position'=>$coordinator->coordinator_position,
            'coordinator_mail'=>$coordinator->coordinator_mail,
        ]);
      
    }

    public function UpdateProfilePicCoordinator(Request $request){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Store the file in the public folder
        $file = $request->file('picture');
        $fileName = "Coordinator(". session('user_id'). ").". $file->getClientOriginalExtension();
        $filePath = public_path('Users/');  // Adjust the storage path as needed

        // Save the file
        $file->move($filePath, $fileName);
        $coordinator= Coordinator::where('id', session('user_id'))->first();
        $coordinator->update([
            'coordinator_image'=>'1',
            'coordinator_image_type'=> $file->getClientOriginalExtension(),
            'coordinator_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function UpdatePersonalDataCoordinator(Request $request){
        $data= $request->validate([
           'first_name'=>'required',
           'middle_name'=>'required',
           'last_name'=>'required',
           'suffix'=>'required',
           'username'=>'required',
        ]);


        $coordinator= Coordinator::where('id', session('user_id'))->first();

        $coordinator->update([
           'coordinator_first_name'=> $data['first_name'],
           'coordinator_middle_name'=>$data['middle_name'],
           'coordinator_last_name'=>$data['last_name'],
           'coordinator_suffix'=>$data['suffix'],
           'coordinator_username'=>$data['username'],
           'student_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }

    public function ChangePasswordCoordinator(Request $request){

        $data= $request->validate([
            'newPassword'=>'required',
            'currentPassword'=>'required',
        ]);

        $coordinator= Coordinator::where('id', session('user_id'))->first();
        if($coordinator->coordinator_password===$data['currentPassword']){
            $coordinator->update([
                'coordinator_password'=>$data['newPassword'],
                'coordinator_status'=>'1',
            ]);
            return redirect()->back()->with('Success', 'Changed Password');
        }else{
            return redirect()->back()->with('Fail', 'Incorrect Password');
        }
    }

    public function CoordinatorVerificationMail(Request $request) {
       $coordinator= Coordinator::where('coordinator_mail', $request->input('email'))->first();
       $teacher= Teacher::where('teacher_mail', $request->input('email'))->first();
       $student=  Student::where('student_mail', $request->input('email'))->first();
       if($coordinator || $teacher || $student){
        return response()->json(['verificationCode' => 'Error']);
       }else{
        $verificationCode = verificationCode();
    
        Mail::to($request->input('email'))->send(new CoordinatorVerification($verificationCode));
    
        return response()->json(['verificationCode' => $verificationCode]);
       }
    }

    public function CoordinatorSavedVerifiedData(Request $request){

        $coordinator = Coordinator::where('id', $request->input('user_id'))->first();

        $coordinator->update([
          'coordinator_password'=>$request->input('finalPassword'),
          'coordinator_mail' =>$request->input('verifiedMail'),
          'coordinator_status'=> 1,
        ]);

        return response()->json(['message' => 'Success']);
    }

    public function CoordinatorRecoverChangePass(Request $request){
        $newpass = $request->input('newPass');
        $confPass = $request->input('confPass');

        if($newpass === $confPass){
            $coordinator = Coordinator::where('id', $request->input('coordinator_id'))->first();
            $coordinator->update([
                'coordinator_password'=>$newpass,
            ]);
            return response()->json(['message' => 'Success']);
        }else{
            return response()->json(['message' => 'Fail']);
        }
    }

    public function ChangeRecoveryMailCoordinator(Request $request){

        $newMail = $request->input('newEmail');
        $id = $request->input('coordinator_id');
        $verificationCode= verificationCode();
        $coordinator = Coordinator::where('id', $id)->first();
        if($coordinator->coordinator_suffix==='none'){
            $finalSuffix ='';
        }else{
            $finalSuffix= $coordinator->coordinator_suffix;
        }
        $fullname = $coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name,0,1 ). ". ". $coordinator->coordinator_last_name. " ". $finalSuffix;
        
        $checkMailStudent = Student::where('student_mail', $newMail)->first(); 
        $checkMailTeacher = Teacher::where('teacher_mail', $newMail)->first(); 
        $checkMailCoordinator = Coordinator::where('coordinator_mail', $newMail)->first(); 
        
        if($coordinator->coordinator_mail === $newMail ||  $checkMailStudent || $checkMailTeacher || $checkMailCoordinator){
            return response()->json(['verificationCode' => 'error']);
        }else{
            
        Mail::to($newMail)->send(new ChangeMailCoordinator($fullname, $verificationCode, 'Coordinator'));      
        return response()->json(['verificationCode' => $verificationCode]);
        }
    }

    public function ConfirmChangeMailCoordinator(Request $request){
        $id = $request->input('coordinator_id');
        $newMail= $request->input('newEmail');

        $coordinator= Coordinator::where('id',$id)->first();
        $fullname = $coordinator->coordinator_first_name . " ". substr($coordinator->coordinator_middle_name, 0, 1). ". ". $coordinator->coordinator_last_name . " ". $coordinator->coordinator_suffix;
        Mail::to($coordinator->coordinator_mail)->send(new FarewellRecoverMail($fullname, $coordinator->coordinator_mail));   
        $coordinator->update([
           'coordinator_mail'=> $newMail,
        ]);
        return response()->json(['message' => 'success']);
    }
}
