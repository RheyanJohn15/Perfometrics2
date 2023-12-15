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
      
      </style>
      <link rel="icon" href="{{asset('images/icon.png')}}">
   
    </head>
    <body>
      <div class="header">
        <img class="logo" src="data:image/jpeg;base64,{{ $logoData }}" alt="Logo" width="200" height="200">
        <h3>NOTRE DAME OF TALISAY CITY-NEGROS OCCIDENTAL, INC.</h3>
        <p>Capitan Sabi St, Carmela Valley Homes, Talisay City</p>
      </div>
      @php
      $teacher= App\Models\Teacher::where('id', $teacher_id)->first();
      if($teacher->teacher_suffix==="none"){
          $finalSuffix= "";
      }else{
          $finalSuffix= $teacher->teacher_suffix;
      }
      $fullname= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ". $teacher->teacher_last_name. " ". $finalSuffix;
      $questions1= App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
      $questions2= App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
      $s=1;
      $t=1;
      $totalScore1=[];
      $totalScore2=[];
      @endphp
     <div class="title">
       <h3>Evaluation Report Summary of Ms/Mrs. <span style="color:#bda370;">{{$fullname}}</span></h3>
     </div>
    
     <table class="table">
     <thead><tr> <th>#</th>
   <th>Corresponding Questions(Teacher Actions)</th><th>Average Score</th>
  </tr></thead><tbody>
  @foreach($questions1 as $question)
  @php
  $evaluation= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('question_id', $question->id)->where('teacher_id', $teacher_id)->get();
  
  $totalScore= $evaluation->sum('evaluation_score');
  $totalRows= $evaluation->count('evaluation_score');
  
  if($totalScore===0 || $totalRows===0){
      $average="Incomplete Data";
  }else{
      $averageScore= $totalScore/$totalRows;
      $average=number_format($averageScore, 2);
      array_push($totalScore1, $average);   
  }
  
  @endphp
  <tr><td>{{$s}}</td><td>{{$question->question_content}}</td><td>{{$average}}</td></tr>
  
  @php $s++; @endphp
  @endforeach
  @php
  if(array_sum($totalScore1)===0 || count($totalScore1)===0){
    $totalAverage1=0;
  }else{
    $totalAverage1= array_sum($totalScore1)/count($totalScore1);
  }

  
 
  @endphp
  <tr style="background-color:#d1d1e0;"><td>#</td><td>Total</td><td>{{number_format($totalAverage1,3)}}</td></tr></tbody></table>
  <style>
    .new-page {
      page-break-before: always;
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
  

<table  class="table mt-8 new-page" >
  <thead>
  <tr><th>#</th> <th>Corresponding Questions(Student Learning Actions)</th><th>Average Score</th></tr>
  </thead>
  <tbody>
      @foreach($questions2 as $question)
      @php
  $evaluation= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('question_id', $question->id)->where('teacher_id', $teacher_id)->get();
  
  $totalScore= $evaluation->sum('evaluation_score');
  $totalRows= $evaluation->count();
  
  if($totalScore===0 && $totalRows===0){
      $average="Incomplete Data";
  }else{
      $averageScore= $totalScore/$totalRows;
      $average=number_format($averageScore, 2);
      array_push($totalScore2, $average);
    
  }
  
  @endphp
      <tr><td>{{$t}}</td><td>{{$question->question_content}}</td><td>{{$average}}</td></tr>
      @php $t++; @endphp
      @endforeach
      @php
     $coordinator= App\Models\EvaluationResult::where('teacher_id', $teacher_id)->get();
     $totalAverage2=  $coordinator->sum('evaluation_score') / $coordinator->count();
 
 
  @endphp
  <tr style="background-color:#d1d1e0;"><td>#</td><td>Total</td><td>{{number_format($totalAverage2, 3)}}</td></tr></tbody></table>

  @php
      $adminWeight = App\Models\Admin::where('admin_type', 'Super Admin')->first();
      $studentWeight = $adminWeight->student_weight;
      $coordinatorWeight = $adminWeight->coordinator_weight;

     $studentScore = ($totalAverage1/4)*$studentWeight;
     $coordinatorScore = ($totalAverage2/4)*$coordinatorWeight;

     $overAllScore = (($studentScore + $coordinatorScore)/100)*4;
     if ($overAllScore == 4) {
    $performance = "Excellent: Performance consistently surpasses all expectations, demonstrating exceptional teaching or coordination abilities across all evaluated criteria.";
} elseif ($overAllScore >= 3 && $overAllScore<4) {
    $performance = "Good: Performance consistently exceeds expectations, showcasing notable strengths in teaching or coordination responsibilities, with few areas needing improvement.";
} elseif ($overAllScore >= 2 && $overAllScore<3) {
    $performance = "Satisfactory: Performance meets the baseline expectations, demonstrating competence in most areas but with room for refinement and further development.";
} elseif ($overAllScore >= 1 && $overAllScore<2) {
    $performance = "Needs Improvement: Performance partially meets expectations but requires substantial enhancements in various aspects of teaching or coordination responsibilities.";
} elseif ($overAllScore >= 0 && $overAllScore<1) {
    $performance = "Unsatisfactory: Performance consistently fails to meet basic expectations. Significant improvements are needed across all evaluated criteria.";
} else {
    $performance = "Invalid score provided."; // Handle negative scores or other cases
}
  @endphp
  
        <p style="margin-top:30px"><strong>Evaluator's Score Weights(Overall Calculations)</strong></p> 
    <p>In our faculty performance evaluation system, student evaluators contribute <strong>{{$studentWeight}}%</strong> of the total score,
       assessing teachers based on their performance in teaching.
        On the other hand, coordinator evaluators carry a weight of <strong>{{$coordinatorWeight}}%</strong> in 
        the evaluation process, focusing on the teachers' impact on students' improvement and participation in class. 
        This balanced approach ensures a comprehensive assessment, incorporating both teaching effectiveness and the resulting student development.</p> 

        <p style="margin-top:30px"><strong>Overall Score/Performance</strong></p> 
        <p><strong>{{number_format($overAllScore,2)}}:</strong>{{$performance}}</p> 


       
        <p style="margin-top:60px; text-align:center;"> <div class="signBox"></div>
          _________________________________ <br><span>Dr. Robert Downy Jr <br><span>President</span></span></p> 
      
   
</body>
</html>

