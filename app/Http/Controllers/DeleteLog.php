<?php

namespace App\Http\Controllers;
use App\Models\EvaluationResult;
use App\Models\Analytics;
use App\Models\AssignedTeacher;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\DeleteStudent;
use App\Models\Coordinator;
use App\Models\DeleteEvaluationResult;
use App\Models\DeleteAnalytics;
use App\Models\Admin;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\DeleteTeacher;
use App\Models\DeleteCoordinator;
use App\Models\DeleteAssignedTeacher;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\File; 
class DeleteLog extends Controller
{
    public function DeleteStudent(Request $request){

       $evaluation = EvaluationResult::where('evaluator_id', $request->input('student_id'))
    ->where('evaluator_type', 'Student')
    ->get();

if ($evaluation->isNotEmpty()) {
    foreach ($evaluation as $ev) {
        $evaluationDelete = new DeleteEvaluationResult();
        $evaluationDelete->evaluator_id = $ev->evaluator_id;
        $evaluationDelete->evaluator_type = $ev->evaluator_type;
        $evaluationDelete->teacher_id = $ev->teacher_id;
        $evaluationDelete->question_id = $ev->question_id;
        $evaluationDelete->evaluation_score = $ev->evaluation_score;
        $evaluationDelete->evaluation_remarks = $ev->evaluation_remarks;
        $evaluationDelete->save();

        $ev->delete();
    }
}


        $analytics = Analytics::where('evaluator_id', $request->input('student_id'))->where('evaluator_type', 'Student')->get();

        if($analytics->isNotEmpty()){
            foreach($analytics as $anal){

                $deleteAnalytics = new DeleteAnalytics();
                $deleteAnalytics->evaluator_id = $anal->evaluator_id;
                $deleteAnalytics->evaluator_type = $anal->evaluator_type;
                $deleteAnalytics->teacher_id = $anal->teacher_id;
                $deleteAnalytics->question_id = $anal->question_id;
                $deleteAnalytics->evaluation_score = $anal->evaluation_score;
                $deleteAnalytics->evaluation_remarks= $anal->evaluation_remarks;
                $deleteAnalytics->evaluation_id = $anal->evaluation_id;
    
                $deleteAnalytics->save();
    
                $anal->delete();
            }
        }
        $student= Student::where('id', $request->input('student_id'))->first();
        $studentDelete = new DeleteStudent();
        $studentDelete->student_first_name = $student->student_first_name;
        $studentDelete->student_last_name= $student->student_last_name;
        $studentDelete->student_middle_name = $student->student_middle_name;
        $studentDelete->student_suffix = $student->student_suffix;
        $studentDelete->student_id= $student->student_id;
        $studentDelete->student_password = $student->student_password;
        $studentDelete->student_year_level = $student->student_year_level;
        $studentDelete->student_strand= $student->student_strand;
        $studentDelete->student_section = $student->student_section;
        $studentDelete->student_mail= $student->student_mail;
        $studentDelete->student_image= 0;
        $studentDelete->student_image_type ='';
        $studentDelete->student_status = $student->student_status;

        $studentDelete->save();
        if($student->student_image===1){
            $imagePath = public_path('Users/Student('.$student->id.').'. $student->student_image_type);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            } 
        }
        $student->delete();

       
        $event= new Event;
        $event->event_name = "Succefully Deleted Student";
        $event->save();
        return redirect()->route('allUser');
    
    }

    public function DeleteTeacher(Request $request){

        $teacher = Teacher::where('id', $request->input('teacher_id'))->first();
        $assigned= AssignedTeacher::where('teacher_id', $request->input('teacher_id'))->get();
        $classSched = ClassSchedule::where('sched_teacher', $request->input('teacher_id'))->get();
        $evaluation = EvaluationResult::where('teacher_id', $request->input('teacher_id'))->get();
        $analytics =Analytics::where('teacher_id', $request->input('teacher_id'))->get();


     if($assigned->isNotEmpty()){
        foreach($assigned as $ass){
            $delete =new DeleteAssignedTeacher();
            $delete->teacher_id = $ass->teacher_id;
            $delete->subject_id = $ass->subject_id;
            $delete->grade_level = $ass->grade_level;
            $delete->section_id = $ass->section_id;
            $delete->sem = $ass->sem;
            $delete->strand_id = $ass->strand_id;
            $delete->save();

            $ass->delete();
        }
     }

      if($evaluation->isNotEmpty()){
        foreach($evaluation as $eval){
            $data = new DeleteEvaluationResult();

            $data->evaluator_id = $eval->evaluator_id;
            $data->evaluator_type = $eval->evaluator_type;
            $data->teacher_id = $eval->teacher_id;
            $data->question_id= $eval->question_id;
            $data->evaluation_score = $eval->evaluation_score;
            $data->evaluation_remarks = $eval->evaluation_remarks;
            $data->save();

            $eval->delete();
        }
      }
       if($analytics->isNotEmpty()){
        foreach($analytics as $anal){

            $analyt= new DeleteAnalytics();
            $analyt->evaluator_id = $anal->evaluator_id;
            $analyt->evaluator_type = $anal->evaluator_type;
            $analyt->teacher_id = $anal->teacher_id;
            $analyt->question_id= $anal->question_id;
            $analyt->evaluation_score = $anal->evaluation_score;
            $analyt->evaluation_remarks = $anal->evaluation_remarks;
            $analyt->evaluation_id = $anal->evaluation_id;
            $analyt->save();

            $anal->delete();

        }
       }
        
      if($classSched->isNotEmpty()){
        foreach($classSched as $sched){
            $sched->update([
            'sched_teacher'=>6,
            ]);
        }
      }

        $deleteTeach = new DeleteTeacher();
        $deleteTeach->teacher_first_name= $teacher->teacher_first_name;
        $deleteTeach->teacher_last_name = $teacher->teacher_last_name;
        $deleteTeach->teacher_middle_name = $teacher->teacher_middle_name;
        $deleteTeach->teacher_suffix = $teacher->teacher_suffix;
        $deleteTeach->teacher_username= $teacher->teacher_username;
        $deleteTeach->teacher_password= $teacher->teacher_password;
        $deleteTeach->teacher_mail = $teacher->teacher_mail;
        $deleteTeach->teacher_image= 0;
        $deleteTeach->teacher_image_type ='';
        $deleteTeach->teacher_status = $teacher->teacher_status;
        $deleteTeach->save();
        if($teacher->teacher_image===1){
            $imagePath = public_path('Users/Teacher('.$teacher->id.').'. $teacher->teacher_image_type);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            } 
        }
        $teacher->delete();

        $event= new Event;
        $event->event_name = "Succefully Deleted Teacher";
        $event->save();
        return redirect()->route('allUser');

    }

    public function DeleteCoordinator(Request $request){

        $analytics =  Analytics::where('evaluator_type', 'Coordinator')->where('evaluator_id', $request->input('coordinator_id'))->get();
        $evaluations = EvaluationResult::where('evaluator_type', 'Coordinator')->where('evaluator_id', $request->input('coordinator_id'))->get();
        $coordinator = Coordinator::where('id', $request->input('coordinator_id'))->first();
        
       if($analytics->isNotEmpty()){
         foreach($analytics as $anal){
            $analyt= new DeleteAnalytics();
            $analyt->evaluator_id = $anal->evaluator_id;
            $analyt->evaluator_type = $anal->evaluator_type;
            $analyt->teacher_id = $anal->teacher_id;
            $analyt->question_id= $anal->question_id;
            $analyt->evaluation_score = $anal->evaluation_score;
            $analyt->evaluation_remarks = $anal->evaluation_remarks;
            $analyt->evaluation_id = $anal->evaluation_id;
            $analyt->save();

            $anal->delete();

            
        }
       }
       if($evaluations->isNotEmpty()){
        foreach($evaluations as $eval){
            $data = new DeleteEvaluationResult();

            $data->evaluator_id = $eval->evaluator_id;
            $data->evaluator_type = $eval->evaluator_type;
            $data->teacher_id = $eval->teacher_id;
            $data->question_id= $eval->question_id;
            $data->evaluation_score = $eval->evaluation_score;
            $data->evaluation_remarks = $eval->evaluation_remarks;
            $data->save();

            $eval->delete();
        }
      }

      $deleteCoord = new DeleteCoordinator();
      $deleteCoord->coordinator_first_name= $coordinator->coordinator_first_name;
      $deleteCoord->coordinator_last_name = $coordinator->coordinator_last_name;
      $deleteCoord->coordinator_middle_name = $coordinator->coordinator_middle_name;
      $deleteCoord->coordinator_suffix = $coordinator->coordinator_suffix;
      $deleteCoord->coordinator_username= $coordinator->coordinator_username;
      $deleteCoord->coordinator_password= $coordinator->coordinator_password;
      $deleteCoord->coordinator_mail = $coordinator->coordinator_mail;
      $deleteCoord->coordinator_position = $coordinator->coordinator_position;
      $deleteCoord->coordinator_image= 0;
      $deleteCoord->coordinator_image_type ='';
      $deleteCoord->coordinator_status = $coordinator->coordinator_status;
      $deleteCoord->save();
      if($coordinator->coordinator_image===1){
          $imagePath = public_path('Users/Coordinator('.$coordinator->id.').'. $coordinator->coordinator_image_type);

          if (File::exists($imagePath)) {
              File::delete($imagePath);
          } 
      }
      $coordinator->delete();

      $event= new Event;
      $event->event_name = "Succefully Deleted Coordinator";
      $event->save();
      return redirect()->route('allUser');

    }

    public function DeleteBatchStudent(Request $request){
        $data = $request->input('deleteStudent');

        foreach($data as $id){
            $evaluation = EvaluationResult::where('evaluator_id',$id)
    ->where('evaluator_type', 'Student')
    ->get();

if ($evaluation->isNotEmpty()) {
    foreach ($evaluation as $ev) {
        $evaluationDelete = new DeleteEvaluationResult();
        $evaluationDelete->evaluator_id = $ev->evaluator_id;
        $evaluationDelete->evaluator_type = $ev->evaluator_type;
        $evaluationDelete->teacher_id = $ev->teacher_id;
        $evaluationDelete->question_id = $ev->question_id;
        $evaluationDelete->evaluation_score = $ev->evaluation_score;
        $evaluationDelete->evaluation_remarks = $ev->evaluation_remarks;
        $evaluationDelete->save();

        $ev->delete();
    }
}


        $analytics = Analytics::where('evaluator_id',$id)->where('evaluator_type', 'Student')->get();

        if($analytics->isNotEmpty()){
            foreach($analytics as $anal){

                $deleteAnalytics = new DeleteAnalytics();
                $deleteAnalytics->evaluator_id = $anal->evaluator_id;
                $deleteAnalytics->evaluator_type = $anal->evaluator_type;
                $deleteAnalytics->teacher_id = $anal->teacher_id;
                $deleteAnalytics->question_id = $anal->question_id;
                $deleteAnalytics->evaluation_score = $anal->evaluation_score;
                $deleteAnalytics->evaluation_remarks= $anal->evaluation_remarks;
                $deleteAnalytics->evaluation_id = $anal->evaluation_id;
    
                $deleteAnalytics->save();
    
                $anal->delete();
            }
        }
        $student= Student::where('id', $id)->first();
        $studentDelete = new DeleteStudent();
        $studentDelete->student_first_name = $student->student_first_name;
        $studentDelete->student_last_name= $student->student_last_name;
        $studentDelete->student_middle_name = $student->student_middle_name;
        $studentDelete->student_suffix = $student->student_suffix;
        $studentDelete->student_id= $student->student_id;
        $studentDelete->student_password = $student->student_password;
        $studentDelete->student_year_level = $student->student_year_level;
        $studentDelete->student_strand= $student->student_strand;
        $studentDelete->student_section = $student->student_section;
        $studentDelete->student_mail= $student->student_mail;
        $studentDelete->student_image= 0;
        $studentDelete->student_image_type ='';
        $studentDelete->student_status = $student->student_status;

        $studentDelete->save();
        if($student->student_image===1){
            $imagePath = public_path('Users/Student('.$id.').'. $student->student_image_type);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            } 
        }
        $student->delete();
        }
        $event= new Event;
        $event->event_name = "Succefully Deleted Batch of Student";
        $event->save();

        return redirect()->back();
    }


    public function DeleteBatchTeacher(Request $request){
        
        $data = $request->input('deleteTeacher');

        foreach($data as $id){
            $teacher = Teacher::where('id',$id)->first();
            $assigned= AssignedTeacher::where('teacher_id', $id)->get();
            $classSched = ClassSchedule::where('sched_teacher', $id)->get();
            $evaluation = EvaluationResult::where('teacher_id', $id)->get();
            $analytics =Analytics::where('teacher_id', $id)->get();
    
    
         if($assigned->isNotEmpty()){
            foreach($assigned as $ass){
                $delete =new DeleteAssignedTeacher();
                $delete->teacher_id = $ass->teacher_id;
                $delete->subject_id = $ass->subject_id;
                $delete->grade_level = $ass->grade_level;
                $delete->section_id = $ass->section_id;
                $delete->sem = $ass->sem;
                $delete->strand_id = $ass->strand_id;
                $delete->save();
    
                $ass->delete();
            }
         }
    
          if($evaluation->isNotEmpty()){
            foreach($evaluation as $eval){
                $data = new DeleteEvaluationResult();
    
                $data->evaluator_id = $eval->evaluator_id;
                $data->evaluator_type = $eval->evaluator_type;
                $data->teacher_id = $eval->teacher_id;
                $data->question_id= $eval->question_id;
                $data->evaluation_score = $eval->evaluation_score;
                $data->evaluation_remarks = $eval->evaluation_remarks;
                $data->save();
    
                $eval->delete();
            }
          }
           if($analytics->isNotEmpty()){
            foreach($analytics as $anal){
    
                $analyt= new DeleteAnalytics();
                $analyt->evaluator_id = $anal->evaluator_id;
                $analyt->evaluator_type = $anal->evaluator_type;
                $analyt->teacher_id = $anal->teacher_id;
                $analyt->question_id= $anal->question_id;
                $analyt->evaluation_score = $anal->evaluation_score;
                $analyt->evaluation_remarks = $anal->evaluation_remarks;
                $analyt->evaluation_id = $anal->evaluation_id;
                $analyt->save();
    
                $anal->delete();
    
            }
           }
            
          if($classSched->isNotEmpty()){
            foreach($classSched as $sched){
                $sched->update([
                'sched_teacher'=>6,
                ]);
            }
          }
    
            $deleteTeach = new DeleteTeacher();
            $deleteTeach->teacher_first_name= $teacher->teacher_first_name;
            $deleteTeach->teacher_last_name = $teacher->teacher_last_name;
            $deleteTeach->teacher_middle_name = $teacher->teacher_middle_name;
            $deleteTeach->teacher_suffix = $teacher->teacher_suffix;
            $deleteTeach->teacher_username= $teacher->teacher_username;
            $deleteTeach->teacher_password= $teacher->teacher_password;
            $deleteTeach->teacher_mail = $teacher->teacher_mail;
            $deleteTeach->teacher_image= 0;
            $deleteTeach->teacher_image_type ='';
            $deleteTeach->teacher_status = $teacher->teacher_status;
            $deleteTeach->save();
            if($teacher->teacher_image===1){
                $imagePath = public_path('Users/Teacher('.$id.').'. $teacher->teacher_image_type);
    
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                } 
            }
            $teacher->delete();
        }

        $event= new Event;
        $event->event_name = "Succefully Deleted Batch of Teacher";
        $event->save();

        return redirect()->back();
    }

    public function DeleteBatchCoordinator(Request $request){
        $data = $request->input('deleteCoordinator');

        foreach($data as $id){
            $analytics =  Analytics::where('evaluator_type', 'Coordinator')->where('evaluator_id',  $id)->get();
            $evaluations = EvaluationResult::where('evaluator_type', 'Coordinator')->where('evaluator_id',  $id)->get();
            $coordinator = Coordinator::where('id',  $id)->first();
            
           if($analytics->isNotEmpty()){
             foreach($analytics as $anal){
                $analyt= new DeleteAnalytics();
                $analyt->evaluator_id = $anal->evaluator_id;
                $analyt->evaluator_type = $anal->evaluator_type;
                $analyt->teacher_id = $anal->teacher_id;
                $analyt->question_id= $anal->question_id;
                $analyt->evaluation_score = $anal->evaluation_score;
                $analyt->evaluation_remarks = $anal->evaluation_remarks;
                $analyt->evaluation_id = $anal->evaluation_id;
                $analyt->save();
    
                $anal->delete();
    
                
            }
           }
           if($evaluations->isNotEmpty()){
            foreach($evaluations as $eval){
                $data = new DeleteEvaluationResult();
    
                $data->evaluator_id = $eval->evaluator_id;
                $data->evaluator_type = $eval->evaluator_type;
                $data->teacher_id = $eval->teacher_id;
                $data->question_id= $eval->question_id;
                $data->evaluation_score = $eval->evaluation_score;
                $data->evaluation_remarks = $eval->evaluation_remarks;
                $data->save();
    
                $eval->delete();
            }
          }
    
          $deleteCoord = new DeleteCoordinator();
          $deleteCoord->coordinator_first_name= $coordinator->coordinator_first_name;
          $deleteCoord->coordinator_last_name = $coordinator->coordinator_last_name;
          $deleteCoord->coordinator_middle_name = $coordinator->coordinator_middle_name;
          $deleteCoord->coordinator_suffix = $coordinator->coordinator_suffix;
          $deleteCoord->coordinator_username= $coordinator->coordinator_username;
          $deleteCoord->coordinator_password= $coordinator->coordinator_password;
          $deleteCoord->coordinator_mail = $coordinator->coordinator_mail;
          $deleteCoord->coordinator_position = $coordinator->coordinator_position;
          $deleteCoord->coordinator_image= 0;
          $deleteCoord->coordinator_image_type ='';
          $deleteCoord->coordinator_status = $coordinator->coordinator_status;
          $deleteCoord->save();
          if($coordinator->coordinator_image===1){
              $imagePath = public_path('Users/Coordinator('. $id.').'. $coordinator->coordinator_image_type);
    
              if (File::exists($imagePath)) {
                  File::delete($imagePath);
              } 
          }
          $coordinator->delete();
        }
        $event= new Event;
        $event->event_name = "Succefully Deleted Batch of Coordinator";
        $event->save();

        return redirect()->back();
    }

    public function ClearLogs(Request $request){
        $password = $request->input('password');
        $admin= Admin::where('admin_type', 'Super Admin')->first();

        if($password === $admin->admin_password){
           $logs = Event::all();
           foreach ($logs as $log) {
            $log->delete();
           }
           return response()->json(["message"=>'success']);
        }else{
            return response()->json(["message"=>'error']);
        }
    }

    public function FetchDeletedUser(){
        $student = DeleteStudent::all();
        $teacher= DeleteTeacher::all();
        $coordinator= DeleteCoordinator::all();
       $data=[];
         if($teacher->isNotEmpty() || $student->isNotEmpty() || $coordinator->isNotEmpty()){
            foreach($student as $s){
                $eval = DeleteEvaluationResult::where('evaluator_id', $s->id)->where('evaluator_type', 'Student')->get()->count();
                $anal = DeleteAnalytics::where('evaluator_id', $s->id)->where('evaluator_type', 'Student')->get()->count();
                if($s->student_suffix==='none'){
                   $finalSuffix= '';
                }else{
                   $finalSuffix= $s->student_suffix;
                }
                $fullName = $s->student_first_name. " ". substr($s->student_middle_name, 0,1). ". ". $s->student_last_name. " ". $finalSuffix;
                array_push($data, ['fullname' => $fullName, 'type'=>'Student', 'evaluationCount'=> $anal + $eval , 'id'=> $s->id,  'date'=>$s->created_at]);
              }
       
              foreach($coordinator as $s){
               $eval = DeleteEvaluationResult::where('evaluator_id', $s->id)->where('evaluator_type', 'Coordinator')->get()->count();
               $anal = DeleteAnalytics::where('evaluator_id', $s->id)->where('evaluator_type', 'Coordinator')->get()->count();
               if($s->coordinator_suffix==='none'){
                  $finalSuffix= '';
               }else{
                  $finalSuffix= $s->coordinator_suffix;
               }
               $fullName = $s->coordinator_first_name. " ". substr($s->coordinator_middle_name, 0,1). ". ". $s->coordinator_last_name. " ". $finalSuffix;
               array_push($data, ['fullname' => $fullName, 'type'=>'Coordinator', 'evaluationCount'=> $anal + $eval , 'id'=> $s->id,  'date'=>$s->created_at]);
             }
       
             foreach($teacher as $s){
               $eval = DeleteEvaluationResult::where('teacher_id', $s->id)->get()->count();
               $anal = DeleteAnalytics::where('teacher_id', $s->id)->get()->count();
               if($s->teacher_suffix==='none'){
                  $finalSuffix= '';
               }else{
                  $finalSuffix= $s->teacher_suffix;
               }
               $fullName = $s->teacher_first_name. " ". substr($s->teacher_middle_name, 0,1). ". ". $s->teacher_last_name. " ". $finalSuffix;
               array_push($data, ['fullname' => $fullName, 'type'=>'Teacher', 'evaluationCount'=> $anal + $eval , 'id'=> $s->id,  'date'=>$s->created_at]);
             }
         }else{
            array_push($data, ['fullname' => 'empty', 'type'=>'empty', 'evaluationCount'=> 'empty', 'id'=> 'empty',  'date'=>'empty']);
         }

      return response()->json($data);
    }

    public function FetchDeletedStudent(){
        $student = DeleteStudent::all();
       $data=[];
       if($student->isNotEmpty()){
        foreach($student as $s){
            $eval = DeleteEvaluationResult::where('evaluator_id', $s->id)->where('evaluator_type', 'Student')->get()->count();
            $anal = DeleteAnalytics::where('evaluator_id', $s->id)->where('evaluator_type', 'Student')->get()->count();
            if($s->student_suffix==='none'){
               $finalSuffix= '';
            }else{
               $finalSuffix= $s->student_suffix;
            }
            $fullName = $s->student_first_name. " ". substr($s->student_middle_name, 0,1). ". ". $s->student_last_name. " ". $finalSuffix;
            array_push($data, ['fullname' => $fullName, 'type'=>'Student', 'evaluationCount'=> $anal + $eval , 'id'=> $s->id, 'date'=>$s->created_at]);
          }
       }else{
        array_push($data, ['fullname' => 'empty', 'type'=>'empty', 'evaluationCount'=> 'empty', 'id'=> 'empty',  'date'=>'empty']);
       }

      return response()->json($data);
    }

    public function FetchDeletedTeacher(){
       
        $teacher= DeleteTeacher::all();
       $data=[];
       
       if($teacher->isNotEmpty()){
        foreach($teacher as $s){
            $eval = DeleteEvaluationResult::where('teacher_id', $s->id)->get()->count();
            $anal = DeleteAnalytics::where('teacher_id', $s->id)->get()->count();
            if($s->teacher_suffix==='none'){
               $finalSuffix= '';
            }else{
               $finalSuffix= $s->teacher_suffix;
            }
            $fullName = $s->teacher_first_name. " ". substr($s->teacher_middle_name, 0,1). ". ". $s->teacher_last_name. " ". $finalSuffix;
            array_push($data, ['fullname' => $fullName, 'type'=>'Teacher', 'evaluationCount'=> $anal + $eval , 'id'=> $s->id, 'date'=>$s->created_at]);
          }
       }else{
        array_push($data, ['fullname' => 'empty', 'type'=>'empty', 'evaluationCount'=> 'empty', 'id'=> 'empty',  'date'=>'empty']);
       }

      return response()->json($data);
    }
    public function FetchDeletedCoordinator(){
     
        $coordinator= DeleteCoordinator::all();
       $data=[];
    if($coordinator->isNotEmpty()){
        foreach($coordinator as $s){
            $eval = DeleteEvaluationResult::where('evaluator_id', $s->id)->where('evaluator_type', 'Coordinator')->get()->count();
            $anal = DeleteAnalytics::where('evaluator_id', $s->id)->where('evaluator_type', 'Coordinator')->get()->count();
            if($s->coordinator_suffix==='none'){
               $finalSuffix= '';
            }else{
               $finalSuffix= $s->coordinator_suffix;
            }
            $fullName = $s->coordinator_first_name. " ". substr($s->coordinator_middle_name, 0,1). ". ". $s->coordinator_last_name. " ". $finalSuffix;
            array_push($data, ['fullname' => $fullName, 'type'=>'Coordinator', 'evaluationCount'=> $anal + $eval , 'id'=> $s->id, 'date'=>$s->created_at]);
          }
    }else{
        array_push($data, ['fullname' => 'empty', 'type'=>'empty', 'evaluationCount'=> 'empty', 'id'=> 'empty',  'date'=>'empty']);
    }

      return response()->json($data);
    }

    public function DeleteUserPermanently(Request $request){
        $id = $request->input('id');
        $type = $request->input('type');

        if($type ==='Student'){
            $evaluations = DeleteEvaluationResult::where('evaluator_id', $id)->where('evaluator_type', 'Student')->get();
            $analytics = DeleteAnalytics::where('evaluator_id', $id)->where('evaluator_type', 'Student')->get();

            foreach($evaluations as $eval){
                $eval->delete();
            }
            foreach($analytics as $anal){
                $anal->delete();
            }
            $student= DeleteStudent::where('id', $id)->first();
            $student->delete();

            $event = new Event();
            $event->event_name= "Permanently Deleted Student";
            $event->save();

            return response()->json(['message'=>'Success']);
        }elseif($type ==='Teacher'){
            $evaluations = DeleteEvaluationResult::where('teacher_id', $id)->get();
            $analytics = DeleteAnalytics::where('teacher_id', $id)->get();

            foreach($evaluations as $eval){
                $eval->delete();
            }
            foreach($analytics as $anal){
                $anal->delete();
            }
            $coordinator= DeleteTeacher::where('id', $id)->first();
            $coordinator->delete();

            $event = new Event();
            $event->event_name= "Permanently Deleted Teacher";
            $event->save();

            return response()->json(['message'=>'Success']);
        }else{
            $evaluations = DeleteEvaluationResult::where('evaluator_id', $id)->where('evaluator_type', 'Coordinator')->get();
            $analytics = DeleteAnalytics::where('evaluator_id', $id)->where('evaluator_type', 'Coordinator')->get();

            foreach($evaluations as $eval){
                $eval->delete();
            }
            foreach($analytics as $anal){
                $anal->delete();
            }
            $parameters= DeleteAssignedTeacher::where('teacher_id', $id)->get();
            foreach($parameters as $param){
                $param->delete();
            }
            $coordinator= DeleteCoordinator::where('id', $id)->first();
            $coordinator->delete();

            $event = new Event();
            $event->event_name= "Permanently Deleted Coordinator";
            $event->save();

            return response()->json(['message'=>'Success']);
        }

    }

    public function RestoreUser(Request $request){
        $id = $request->input('id');
        $type = $request->input('type');

        if($type ==='Student'){
            $evaluation = DeleteEvaluationResult::where('evaluator_id', $id)
            ->where('evaluator_type', 'Student')
            ->get();
        
        if ($evaluation->isNotEmpty()) {
            foreach ($evaluation as $ev) {
                $teacher= Teacher::where('id', $ev->teacher_id)->first();
                if($teacher){
                    $evaluationDelete = new EvaluationResult();
                    $evaluationDelete->evaluator_id = $ev->evaluator_id;
                    $evaluationDelete->evaluator_type = $ev->evaluator_type;
                    $evaluationDelete->teacher_id = $ev->teacher_id;
                    $evaluationDelete->question_id = $ev->question_id;
                    $evaluationDelete->evaluation_score = $ev->evaluation_score;
                    $evaluationDelete->evaluation_remarks = $ev->evaluation_remarks;
                    $evaluationDelete->save();
                    $ev->delete();
                }
               
            }
        }
        
        
                $analytics = DeleteAnalytics::where('evaluator_id', $id)->where('evaluator_type', 'Student')->get();
        
                if($analytics->isNotEmpty()){
                    foreach($analytics as $anal){
                        $teacher= Teacher::where('id', $anal->teacher_id)->first();
                        if($teacher){
                            $deleteAnalytics = new Analytics();
                            $deleteAnalytics->evaluator_id = $anal->evaluator_id;
                            $deleteAnalytics->evaluator_type = $anal->evaluator_type;
                            $deleteAnalytics->teacher_id = $anal->teacher_id;
                            $deleteAnalytics->question_id = $anal->question_id;
                            $deleteAnalytics->evaluation_score = $anal->evaluation_score;
                            $deleteAnalytics->evaluation_remarks= $anal->evaluation_remarks;
                            $deleteAnalytics->evaluation_id = $anal->evaluation_id;
                
                            $deleteAnalytics->save();
                
                            $anal->delete();
                        }
                        
                       
                    }
                }
                $student= DeleteStudent::where('id', $id)->first();
                $studentDelete = new Student();
                $studentDelete->student_first_name = $student->student_first_name;
                $studentDelete->student_last_name= $student->student_last_name;
                $studentDelete->student_middle_name = $student->student_middle_name;
                $studentDelete->student_suffix = $student->student_suffix;
                $studentDelete->student_id= $student->student_id;
                $studentDelete->student_password = $student->student_password;
                $studentDelete->student_year_level = $student->student_year_level;
                $studentDelete->student_strand= $student->student_strand;
                $studentDelete->student_section = $student->student_section;
                $studentDelete->student_mail= $student->student_mail;
                $studentDelete->student_image= 0;
                $studentDelete->student_image_type ='';
                $studentDelete->student_status = $student->student_status;
        
                $studentDelete->save();
                
                $student->delete();
               
                $event= new Event;
                $event->event_name = "Succefully Restore Student";
                $event->save();
                return response()->json(['message'=>'Success']);
            
        }elseif($type ==='Teacher'){
            $teacher = DeleteTeacher::where('id', $id)->first();
            $assigned= DeleteAssignedTeacher::where('teacher_id', $id)->get();
            $evaluation = DeleteEvaluationResult::where('teacher_id', $id)->get();
            $analytics =DeleteAnalytics::where('teacher_id', $id)->get();
    
    
         if($assigned->isNotEmpty()){
            foreach($assigned as $ass){
                $delete =new AssignedTeacher();
                $delete->teacher_id = $ass->teacher_id;
                $delete->subject_id = $ass->subject_id;
                $delete->grade_level = $ass->grade_level;
                $delete->section_id = $ass->section_id;
                $delete->sem = $ass->sem;
                $delete->strand_id = $ass->strand_id;
                $delete->save();
    
                $ass->delete();
            }
         }
    
          if($evaluation->isNotEmpty()){
            foreach($evaluation as $eval){
                $data = new EvaluationResult();
    
                $data->evaluator_id = $eval->evaluator_id;
                $data->evaluator_type = $eval->evaluator_type;
                $data->teacher_id = $eval->teacher_id;
                $data->question_id= $eval->question_id;
                $data->evaluation_score = $eval->evaluation_score;
                $data->evaluation_remarks = $eval->evaluation_remarks;
                $data->save();
    
                $eval->delete();
            }
          }
           if($analytics->isNotEmpty()){
            foreach($analytics as $anal){
    
                $analyt= new Analytics();
                $analyt->evaluator_id = $anal->evaluator_id;
                $analyt->evaluator_type = $anal->evaluator_type;
                $analyt->teacher_id = $anal->teacher_id;
                $analyt->question_id= $anal->question_id;
                $analyt->evaluation_score = $anal->evaluation_score;
                $analyt->evaluation_remarks = $anal->evaluation_remarks;
                $analyt->evaluation_id = $anal->evaluation_id;
                $analyt->save();
    
                $anal->delete();
    
            }
           }
            
          
    
            $deleteTeach = new Teacher();
            $deleteTeach->teacher_first_name= $teacher->teacher_first_name;
            $deleteTeach->teacher_last_name = $teacher->teacher_last_name;
            $deleteTeach->teacher_middle_name = $teacher->teacher_middle_name;
            $deleteTeach->teacher_suffix = $teacher->teacher_suffix;
            $deleteTeach->teacher_username= $teacher->teacher_username;
            $deleteTeach->teacher_password= $teacher->teacher_password;
            $deleteTeach->teacher_mail = $teacher->teacher_mail;
            $deleteTeach->teacher_image= 0;
            $deleteTeach->teacher_image_type ='';
            $deleteTeach->teacher_status = $teacher->teacher_status;
            $deleteTeach->save();

            $teacher->delete();
               
            $event= new Event;
            $event->event_name = "Succefully Restore Teacher";
            $event->save();
            return response()->json(['message'=>'Success']);
        }else{
           
        $analytics =  DeleteAnalytics::where('evaluator_type', 'Coordinator')->where('evaluator_id', $id)->get();
        $evaluations = DeleteEvaluationResult::where('evaluator_type', 'Coordinator')->where('evaluator_id', $id)->get();
        $coordinator = DeleteCoordinator::where('id', $id)->first();
        
       if($analytics->isNotEmpty()){
         foreach($analytics as $anal){
          $teacher= Teacher::where('id', $anal->teacher_id)->first();
          if($teacher){
            $analyt= new Analytics();
            $analyt->evaluator_id = $anal->evaluator_id;
            $analyt->evaluator_type = $anal->evaluator_type;
            $analyt->teacher_id = $anal->teacher_id;
            $analyt->question_id= $anal->question_id;
            $analyt->evaluation_score = $anal->evaluation_score;
            $analyt->evaluation_remarks = $anal->evaluation_remarks;
            $analyt->evaluation_id = $anal->evaluation_id;
            $analyt->save();

            $anal->delete();
          }

            
        }
       }
       if($evaluations->isNotEmpty()){
        foreach($evaluations as $eval){
         $teacher= Teacher::where('id', $eval->teacher_id)->first();
         if($teacher){
            $data = new EvaluationResult();

            $data->evaluator_id = $eval->evaluator_id;
            $data->evaluator_type = $eval->evaluator_type;
            $data->teacher_id = $eval->teacher_id;
            $data->question_id= $eval->question_id;
            $data->evaluation_score = $eval->evaluation_score;
            $data->evaluation_remarks = $eval->evaluation_remarks;
            $data->save();

            $eval->delete();
         }
        }
      }

      $deleteCoord = new Coordinator();
      $deleteCoord->coordinator_first_name= $coordinator->coordinator_first_name;
      $deleteCoord->coordinator_last_name = $coordinator->coordinator_last_name;
      $deleteCoord->coordinator_middle_name = $coordinator->coordinator_middle_name;
      $deleteCoord->coordinator_suffix = $coordinator->coordinator_suffix;
      $deleteCoord->coordinator_username= $coordinator->coordinator_username;
      $deleteCoord->coordinator_password= $coordinator->coordinator_password;
      $deleteCoord->coordinator_mail = $coordinator->coordinator_mail;
      $deleteCoord->coordinator_position = $coordinator->coordinator_position;
      $deleteCoord->coordinator_image= 0;
      $deleteCoord->coordinator_image_type ='';
      $deleteCoord->coordinator_status = $coordinator->coordinator_status;
      $deleteCoord->save();

      $coordinator->delete();
     
      $event= new Event;
      $event->event_name = "Succefully Restore Coordinator";
      $event->save();
      return response()->json(['message'=>'Success']);

        }
    }
    
    public function DeleteAllUserData(Request $request){
        DeleteAnalytics::truncate();
        DeleteTeacher::truncate();
        DeleteStudent::truncate();
        DeleteCoordinator::truncate();
        DeleteEvaluationResult::truncate();
        DeleteAssignedTeacher::truncate();

        $event = new Event();
        $event->event_name = 'Delete all deleted user from recycle bin';
        $event->save();

        return response()->json(['message'=> 'success']);
    }
}
