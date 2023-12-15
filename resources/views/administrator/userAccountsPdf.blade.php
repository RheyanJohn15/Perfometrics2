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
     
     <div class="title">
       <h3>User Accounts of {{$selection}}</h3>
     </div>
    @if($selection !="All")
     <table class="table">
     <thead><tr>
   <th style="width:50%">Account Name</th><th style="width: 25%">Username</th><th>Passwords</th>
  </tr><tbody>
  
   @if($selection==="Student")
   @php
   $students= App\Models\Student::all();
   @endphp
    @foreach($students as $student)
    @php
    if($student->student_suffix === 'none'){
       $finalSuffix= '';
    }else{
       $finalSuffix= $student->student_suffix;
    }
@endphp
     <tr><td>{{$student->student_first_name. " ". substr($student->student_middle_name, 0,1). ". ". $student->student_last_name. " ". $finalSuffix}}</td>
      <td>{{$student->student_id}}</td> <td>{{$student->student_password}}</td>
    </tr>
    @endforeach
@elseif($selection==="Teacher")
@php
$teachers= App\Models\Teacher::where('id', '!=', 6)->get();
@endphp

 @foreach($teachers as $teacher)
 @php
 if($teacher->teacher_suffix === 'none'){
    $finalSuffix= '';
 }else{
    $finalSuffix= $teacher->teacher_suffix;
 }
@endphp
  <tr><td>{{$teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0,1). ". ". $teacher->teacher_last_name. " ". $finalSuffix}}</td>
   <td>{{$teacher->teacher_username}}</td> <td>{{$teacher->teacher_password}}</td>
 </tr>
 @endforeach

@elseif($selection==="Coordinator")
@php
$coordinators= App\Models\Coordinator::all();
@endphp
 @foreach($coordinators as $coordinator)
 @php
 if($coordinator->coordinator_suffix === 'none'){
    $finalSuffix= '';
 }else{
    $finalSuffix= $coordinator->coordinator_suffix;
 }
@endphp
  <tr><td>{{$coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name, 0,1). ". ". $coordinator->coordinator_last_name. " ". $finalSuffix}}</td>
   <td>{{$coordinator->coordinator_username}}</td> <td>{{$coordinator->coordinator_password}}</td>
 </tr>
 @endforeach
</tbody></thead></table>
@endif

@else
<h3>User Accounts of All Students</h3>
<table class="table">
    <thead><tr>
  <th style="width:50%">Account Name</th><th style="width: 25%">Username</th><th>Passwords</th>
 </tr><tbody>
    @php
    $students= App\Models\Student::all();
    @endphp
     @foreach($students as $student)
     @php
         if($student->student_suffix === 'none'){
            $finalSuffix= '';
         }else{
            $finalSuffix= $student->student_suffix;
         }
     @endphp
      <tr><td>{{$student->student_first_name. " ". substr($student->student_middle_name, 0,1). ". ". $student->student_last_name. " ". $finalSuffix}}</td>
       <td>{{$student->student_id}}</td> <td>{{$student->student_password}}</td>
     </tr>
     @endforeach
    </tbody></thead></table>

    <h3>User Accounts of All Teachers</h3>
<table class="table mt-8">
    <thead><tr>
  <th style="width:50%">Account Name</th><th style="width: 25%">Username</th><th>Passwords</th>
 </tr></thead><tbody>
    @php
    $teachers= App\Models\Teacher::where('id', '!=', 6)->get();
    @endphp
     @foreach($teachers as $teacher)
     @php
     if($teacher->teacher_suffix === 'none'){
        $finalSuffix= '';
     }else{
        $finalSuffix= $teacher->teacher_suffix;
     }
 @endphp
      <tr><td>{{$teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0,1). ". ". $teacher->teacher_last_name. " ". $finalSuffix}}</td>
       <td>{{$teacher->teacher_username}}</td> <td>{{$teacher->teacher_password}}</td>
     </tr>
     @endforeach
    </tbody></thead></table>
    <h3>User Accounts of All Coordinators</h3>
    <table class="table mt-8">
        <thead><tr>
      <th style="width:50%">Account Name</th><th style="width: 25%">Username</th><th>Passwords</th>
     </tr><tbody>
        @php
        $coordinators= App\Models\Coordinator::all();
        @endphp
         @foreach($coordinators as $coordinator)
         @php
         if($coordinator->coordinator_suffix === 'none'){
            $finalSuffix= '';
         }else{
            $finalSuffix= $coordinator->coordinator_suffix;
         }
     @endphp
          <tr><td>{{$coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name, 0,1). ". ". $coordinator->coordinator_last_name. " ". $finalSuffix}}</td>
           <td>{{$coordinator->coordinator_username}}</td> <td>{{$coordinator->coordinator_password}}</td>
         </tr>
         @endforeach
        </tbody></table>
@endif

  
</body>
</html>

