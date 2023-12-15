<!DOCTYPE html>
    <html>
    <head>
      
      <title>Evaluation Data</title>

      <style>
        body {
          margin: 0;
          padding: 0;
        }
    
        .header {
          width:100%;
          padding: 10px;
          text-align: center;
        }
    
        .logo {
          display: inline-block;
          vertical-align: top;
        }
    .title{
     width:100%;
     text-align:center;
     margin-top:10px
    }
    .table {
        width: 100%;
        padding: 0;
        border-collapse: collapse; /* Add this line to collapse the border spacing */
      }
      
      .table tr {
        margin: 0;
      }
      hr{
        color:white;
      }
      .table th,
      .table td {
        border: 1px solid black;
        margin: 0px;
        padding: 5px; /* Add padding to create space between the cell content and border */
      }
      .signBox{
      width: 35%;
     height: 40px;
     margin-bottom:-20px;
    background-image: url("data:image/jpeg;base64,{{ $signature }}");
    background-size: contain;
    background-repeat: no-repeat;
    background-position:center;  
    }
      </style>
      <link rel="icon" href="{{asset('images/icon.png')}}">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    
    <body>
      <div class="header">
        <img class="logo" src="data:image/jpeg;base64,{{ $logoData }}" alt="Logo" width="200" height="200">
        <h3>NOTRE DAME OF TALISAY CITY-NEGROS OCCIDENTAL, INC.</h3>
        <p>Capitan Sabi St, Carmela Valley Homes, Talisay City</p>
      </div>
     
     <div class="title">
       <h3>Evaluation Report Summary of All Teachers</h3>
     </div>
    
     <table class="table">
     <thead><tr>
   <th style="width:30%">Teacher Name</th><th style="width: 10%">Average Score</th><th>Remarks</th>
  </tr></thead><tbody>
    @php
    $s=1;
    $teachers= App\Models\Teacher::where('id', '!=', 6)->get();
    $adminWeight = App\Models\Admin::where('admin_type', 'Super Admin')->first();
      $studentWeight = $adminWeight->student_weight;
      $coordinatorWeight = $adminWeight->coordinator_weight;
    @endphp
  @foreach($teachers as $teacher)
  @php
      if($teacher->teacher_suffix ==='none'){
        $finalSuffix ='';
      }else{
        $finalSuffix = $teacher->teacher_suffix;
      }
      $fullname= $teacher->teacher_first_name. " ". $teacher->teacher_middle_name. " ". $teacher->teacher_last_name. " ". $finalSuffix;
      $resultStudent= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher->id)->get();
      $resultCoordinator= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher->id)->get();
      $studentScore= $resultStudent->sum('evaluation_score');
      $studentNum= $resultStudent->count('evaluation_score');
      if($studentScore===0 || $studentNum===0){
        $studentAverage=0;
      }else{
        $studentAverage= $studentScore/$studentNum;
      }

    $coordinatorScore= $resultCoordinator->sum('evaluation_score');
    $coordinatorNum= $resultCoordinator->count('evaluation_score');
    if($coordinatorScore===0 ||$coordinatorNum===0){
        $coordinatorAverage=0;
    }else{
        $coordinatorAverage= $coordinatorScore/$coordinatorNum;
    }


    if($coordinatorAverage===0){
        $totalAverage= $studentAverage;
    }else if($studentAverage===0){
        $totalAverage= $coordinatorAverage;
    }else if($studentAverage!=0 && $coordinatorAverage!=0){
      $studentPercentage = ($studentAverage/4)*$studentWeight;
      $coordinatorPercentage= ($coordinatorAverage/4)*$coordinatorWeight;
        $totalAverage= (($coordinatorPercentage+$studentPercentage)/100)*4;
    }
    if ($totalAverage ===4) {
    $TeacherRemarks = "The teacher consistently communicates clear expectations, utilizes various learning materials and strategies, monitors student learning effectively, provides appropriate feedback, manages the classroom environment and time efficiently, and engages students in higher-order thinking related to the unit standards and competencies.";
} else if ($totalAverage >= 3 && $totalAverage < 4) {
    $TeacherRemarks = "The teacher communicates clear expectations, utilizes a variety of learning materials and strategies, monitors student learning, provides feedback, manages the classroom environment and time effectively, and asks questions to assess understanding of the unit standards and competencies.";
} else if ($totalAverage >= 2 && $totalAverage < 3) {
    $TeacherRemarks = "The teacher partially communicates clear expectations, uses some learning materials and strategies, inconsistently monitors student learning, provides limited feedback, requires improvement in managing the classroom environment and time, and occasionally asks questions to assess understanding of the unit standards and competencies.";
} else if ($totalAverage >= 1 && $totalAverage < 2) {
    $TeacherRemarks = "The teacher does not effectively communicate clear expectations, lacks variety in learning materials and strategies, rarely monitors student learning, provides minimal feedback or interventions, struggles to manage the classroom environment and time, and rarely asks questions to assess understanding of the unit standards and competencies.";
} else if ($totalAverage >= 0 && $totalAverage < 1) {
    $TeacherRemarks = "There is insufficient evidence or evaluation available to assess the teacher's performance in relation to the given criteria.";
}

      
  @endphp 
  <tr><td>{{$s}}. {{$fullname}}</td><td style="text-align:center; font-weight:bold;">{{number_format($totalAverage, 3)}}</td><td>{{$TeacherRemarks}}</td></tr>
  
  @php $s++; @endphp
  @endforeach

</tbody></table>

<p style="margin-top:30px"><strong>Evaluator's Score Weights(Overall Calculations)</strong></p> 
<p>In our faculty performance evaluation system, student evaluators contribute <strong>{{$studentWeight}}%</strong> of the total score,
   assessing teachers based on their performance in teaching.
    On the other hand, coordinator evaluators carry a weight of <strong>{{$coordinatorWeight}}%</strong> in 
    the evaluation process, focusing on the teachers' impact on students' improvement and participation in class. 
    This balanced approach ensures a comprehensive assessment, incorporating both teaching effectiveness and the resulting student development.</p> 
      
<p style="margin-top:60px; text-align:center;"> <div class="signBox"></div>
  _________________________________ <br><span>Dr. Robert Downy Jr <br><span>President</span></span></p> 
</body>
</html>

