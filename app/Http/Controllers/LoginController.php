<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Coordinator;
use App\Models\Teacher;
use App\Models\Event;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function LoginView(){
         return view('login.index');  
    }
    public function AboutUs(){  
              return view('login.aboutus');
      
    }
    public function ContactUs(){
            return view('login.contact');
        
    }
    public function Privacy(){
                return view('login.privacy');

    }
    public function Terms(){
             return view('login.terms');
    }


    public function AdminLogin(Request $request){
        $data= $request->validate([
            'usernameAdmin'=> 'required',
            'passwordAdmin'=>'required',
           ]);
              // Retrieve the user record from the database based on the provided username
              $administrator = Admin::where('admin_username', $data['usernameAdmin'])->first();
   
              if ($administrator) {
                  $uname= $administrator->id;
                  if ($data['passwordAdmin'] === $administrator->admin_password) {
                  
                    Session::put('user_type', 'Admin');
                    Session::put('user_id', $uname);

                    $event = new Event();
                    $event->event_name = "Admin Login";
                    $event->save();

                    return response()->json(['message' => 'Login successful'], 200);
                  } else {
                      // Passwords don't match
                      return response()->json(['error' => 'Invalid login credentials.'], 422);
                  }
              } else {
                  // User not found in the database
                  return response()->json(['error' => 'Invalid login credentials.'], 401);
              }
    }

    public function TeacherLogin(Request $request){
        $data= $request->validate([
           'usernameTeacher'=>'required',
           'passwordTeacher'=>'required',
        ]);

        $teacher= Teacher::where('teacher_username', $data['usernameTeacher'])->first();

        if($teacher){
            $uname= $teacher->id;
            if($data['passwordTeacher']===$teacher->teacher_password ){
                Session::put('user_type', 'Teacher');
                Session::put('user_id', $uname);

                return response()->json(['message' => 'Login successful'], 200);
        }else {
            // Passwords don't match
            return response()->json(['error' => 'Invalid login credentials.'], 422);
        }
    }else {
        // User not found in the database
        return response()->json(['error' => 'Invalid login credentials.'], 401);
    }
}

public function StudentLogin(Request $request){
    $data= $request->validate([
       'usernameStudent'=>'required',
       'passwordStudent'=>'required',
    ]);

    $student= Student::where('student_id', $data['usernameStudent'])->first();
  

    if($student){
       
        if($data['passwordStudent']===$student->student_password ){
            $uname= $student->id;
            Session::put('user_type', 'Student');
            Session::put('user_id', $uname);
          
            return response()->json(['message' => 'Login successful'], 200);
    }else {
        // Passwords don't match
        return response()->json(['error' => 'Invalid login credentials.'], 422);
    }
}else {
    // User not found in the database
    return response()->json(['error' => 'Invalid login credentials.'], 401);
}
}
public function CoordinatorLogin(Request $request){
    $data= $request->validate([
       'usernameCoordinator'=>'required',
       'passwordCoordinator'=>'required',
    ]);

    $coordinator= Coordinator::where('coordinator_username', $data['usernameCoordinator'])->first();
   
    if($coordinator){
        $uname= $coordinator->id;
        if($data['passwordCoordinator']===$coordinator->coordinator_password ){
            Session::put('user_type', 'Coordinator');
            Session::put('user_id', $uname);
            return redirect()->route('coordinator_dashboard'); 
    }else {
        // Passwords don't match
        return response()->json(['error' => 'Invalid login credentials.'], 422);
    }
}else {
    // User not found in the database
    return response()->json(['error' => 'Invalid login credentials.'], 401);
}
}


public function AdminDashboard(){
    $studentCount = Student::count(); 
    $teacherCount = Teacher::where('id', '!=', 6)->get()->count(); 
    $coordinatorCount= Coordinator::count();

    $total= $studentCount+ $teacherCount + $coordinatorCount;

    $pieChart= $studentCount. ",". $teacherCount.",".$coordinatorCount;

    $admin= Admin::where('admin_type', 'Super Admin')->first();
    $sem= $admin->admin_sem;
    return view('administrator.indexAdmin', [  
    'studentCount' => $studentCount,
    'teacherCount' => $teacherCount,
    'coordinatorCount' => $coordinatorCount,
    'total' => $total,
     'pie' => $pieChart,
    'semester'=> $sem]);
}

public function AdminChangeSem(Request $request){
    $data= $request-> validate([
        'semester'=>'required',
        'adminPassword'=>'required',
        'sy'=>'required',
    ]);

    $admin= Admin::where('admin_type', 'Super Admin')->first();

    if($admin){
        $adminpass=$admin->admin_password;
        if($adminpass===$data['adminPassword']){
            $admin->update(['admin_sem' => $data['semester'],
        'admin_sy'=>$data['sy']]);
            return redirect()->route('admin_dashboard'); 
        }else{
            return redirect()->back()->with('error', 'Invalid Password.');
        }
    }else{
        return redirect()->back()->with('error', 'Invalid Password.');
    }
}

public function TeacherDashboard(){
    return view('teacher.indexTeacher');
}
public function StudentDashboard(){
    return view('student.indexStudent');
}
public function CoordinatorDashboard(){
    return view('coordinator.indexCoordinator');
}

public function ForgotPassword(Request $request){
   
    return view('login.forgotPassword', [
       'type'=>$request->input('type'),
    ]);
}
public function StudentForgotPass(Request $request){
    $data = Student::where('student_id', $request->input('lrn'))->first(); 

    if($data){
        if($data->student_status === 0){
            return response()->json(['message' => 'Account Does not Set Up Yet']);
        }else{
            $verificationCode = verificationCode();
            Mail::to($data->student_mail)->send(new ForgotPasswordMail($verificationCode, $data->student_first_name, 'Student', $data->student_id));
            return response()->json(['message' => $verificationCode, 'id'=> $data->id, 'name'=>$data->student_id]);
        }
    }else{
        return response()->json(['message' => 'Account Does not Exist']);
    }
}

public function TeacherForgotPass(Request $request){
    $data = Teacher::where('teacher_username', $request->input('teacher_username'))->first(); 

    if($data){
        if($data->teacher_status === 0){
            return response()->json(['message' => 'Account Does not Set Up Yet']);
        }else{
            $verificationCode = verificationCode();
            Mail::to($data->teacher_mail)->send(new ForgotPasswordMail($verificationCode, $data->teacher_first_name, 'Teacher', $data->teacher_username));
            return response()->json(['message' => $verificationCode, 'id'=> $data->id, 'name'=> $data->teacher_first_name]);
        }
    }else{
        return response()->json(['message' => 'Account Does not Exist']);
    }
}

public function CoordinatorForgotPass(Request $request){
    $data = Coordinator::where('coordinator_username', $request->input('coordinator_username'))->first(); 

    if($data){
        if($data->coordinator_status === 0){
            return response()->json(['message' => 'Account Does not Set Up Yet']);
        }else{
            $verificationCode = verificationCode();
            Mail::to($data->coordinator_mail)->send(new ForgotPasswordMail($verificationCode, $data->coordinator_first_name, 'Coordinator', $data->coordinator_username));
            return response()->json(['message' => $verificationCode, 'id'=> $data->id, 'name'=> $data->coordinator_first_name]);
        }
    }else{
        return response()->json(['message' => 'Account Does not Exist']);
    }
}
}
