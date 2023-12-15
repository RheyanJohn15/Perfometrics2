<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Coordinator;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Mail\TeacherVerification;
use App\Mail\FarewellRecoverMail;
use App\Mail\ChangeMailTeacher;
use Illuminate\Support\Facades\Mail;
class TeacherController extends Controller
{
    public function Remarks(){
        return view('teacher.remarks');
    }
    public function ClassScheduleToday(){
        return view('teacher.classScheduleToday');
    }
    public function ClassScheduleOverall(){
        return view('teacher.classScheduleOverall');
    }
    public function TeacherProfile(){
        $teacher= Teacher::where('id', session('user_id'))->first();
        if($teacher->teacher_suffix==="none"){
            $finalSuffix= " ";
        }else{
            $finalSuffix= $teacher->teacher_suffix;
        }
        $fullname= $teacher->teacher_first_name. " ". $teacher->teacher_last_name. " ". $teacher->teacher_last_name. " ".$finalSuffix;
        return view('teacher.teacherProfile', [
            'fullname'=>$fullname,
            'first_name'=>$teacher->teacher_first_name,
            'last_name'=>$teacher->teacher_last_name,
            'middle_name'=>$teacher->teacher_middle_name,
            'suffix'=>$teacher->teacher_suffix,
            'username'=>$teacher->teacher_username,
            'password'=>$teacher->teacher_password,
            'teacher_mail'=>$teacher->teacher_mail,
        ]);
    }
    public function UpdateProfilePicTeacher(Request $request){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Store the file in the public folder
        $file = $request->file('picture');
        $fileName = "Teacher(". session('user_id'). ").". $file->getClientOriginalExtension();
        $filePath = public_path('Users/');  // Adjust the storage path as needed

        // Save the file
        $file->move($filePath, $fileName);
        $teacher= Teacher::where('id', session('user_id'))->first();
        $teacher->update([
            'teacher_image'=>'1',
            'teacher_image_type'=> $file->getClientOriginalExtension(),
            'teacher_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
    public function UpdatePersonalDataTeacher(Request $request){
        $data= $request->validate([
           'first_name'=>'required',
           'middle_name'=>'required',
           'last_name'=>'required',
           'suffix'=>'required',
           'username'=>'required',
        ]);


        $teacher= Teacher::where('id', session('user_id'))->first();

        $teacher->update([
           'teacher_first_name'=> $data['first_name'],
           'teacher_middle_name'=>$data['middle_name'],
           'teacher_last_name'=>$data['last_name'],
           'teacher_suffix'=>$data['suffix'],
           'teacher_username'=>$data['username'],
           'teacher_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }
    public function ChangePassword(Request $request){

        $data= $request->validate([
            'newPassword'=>'required',
            'currentPassword'=>'required',
        ]);

        $teacher= Teacher::where('id', session('user_id'))->first();
        if($teacher->teacher_password===$data['currentPassword']){
            $teacher->update([
                'teacher_password'=>$data['newPassword'],
                'teacher_status'=>'1',
            ]);
            return redirect()->back()->with('Success', 'Changed Password');
        }else{
            return redirect()->back()->with('Fail', 'Incorrect Password');
        }
    }

    public function TeacherVerificationMail(Request $request) {
        $coordinator= Coordinator::where('coordinator_mail', $request->input('email'))->first();
        $teacher= Teacher::where('teacher_mail', $request->input('email'))->first();
        $student=  Student::where('student_mail', $request->input('email'))->first();
        if($coordinator || $teacher || $student){

    return response()->json(['verificationCode' => 'Error']);
   }else{
    $verificationCode = verificationCode();
    
    Mail::to($request->input('email'))->send(new TeacherVerification($verificationCode));

    return response()->json(['verificationCode' => $verificationCode]);
   }
    }

    public function TeacherSavedVerifiedData(Request $request){

        $teacher = Teacher::where('id', $request->input('user_id'))->first();

        $teacher->update([
          'teacher_password'=>$request->input('finalPassword'),
          'teacher_mail' =>$request->input('verifiedMail'),
          'teacher_status'=> 1,
        ]);

        return response()->json(['message' => 'Success']);
    }

    public function TeacherRecoverChangePass(Request $request){
        $newpass = $request->input('newPass');
        $confPass = $request->input('confPass');

        if($newpass === $confPass){
            $teacher = Teacher::where('id', $request->input('teacher_id'))->first();
            $teacher->update([
                'teacher_password'=>$newpass,
            ]);
            return response()->json(['message' => 'Success']);
        }else{
            return response()->json(['message' => 'Fail']);
        }
    }

    public function ChangeRecoveryMailTeacher(Request $request){

        $newMail = $request->input('newEmail');
        $id = $request->input('teacher_id');
        $verificationCode= verificationCode();
        $teacher = Teacher::where('id', $id)->first();
        if($teacher->teacher_suffix==='none'){
            $finalSuffix ='';
        }else{
            $finalSuffix= $teacher->teacher_suffix;
        }
        $fullname = $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name,0,1 ). ". ". $teacher->teacher_last_name. " ". $finalSuffix;

        $checkMailStudent = Student::where('student_mail', $newMail)->first(); 
        $checkMailTeacher = Teacher::where('teacher_mail', $newMail)->first(); 
        $checkMailCoordinator = Coordinator::where('coordinator_mail', $newMail)->first(); 

        if($teacher->teacher_mail === $newMail || $checkMailStudent || $checkMailTeacher || $checkMailCoordinator){
            return response()->json(['verificationCode' => 'error']);
        }else{
            
        Mail::to($newMail)->send(new ChangeMailTeacher($fullname, $verificationCode, 'Teacher'));      
        return response()->json(['verificationCode' => $verificationCode]);
        }

    }
    
    public function ConfirmChangeMailTeacher(Request $request){
        $id = $request->input('teacher_id');
        $newMail= $request->input('newEmail');

        $teacher= Teacher::where('id',$id)->first();
        if($teacher->teacher_suffix==='none'){
            $finalSuffix ='';
        }else{
            $finalSuffix= $teacher->teacher_suffix;
        }
        $fullname = $teacher->teacher_first_name . " ". substr($teacher->teacher_middle_name, 0, 1). ". ". $teacher->teacher_last_name . " ". $finalSuffix;
        Mail::to($teacher->teacher_mail)->send(new FarewellRecoverMail($fullname, $teacher->teacher_mail));   
        $teacher->update([
           'teacher_mail'=> $newMail,
        ]);
        return response()->json(['message' => 'success']);
    }
}
