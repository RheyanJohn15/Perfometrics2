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
     margin-top:40px;
    }
    .table {
        width: 100%;
        padding: 0; 
        margin-top:40px; 
        border-collapse: collapse; /* Add this line to collapse the border spacing */
      }
      
      .table tr {
        margin: 0;
      }
     
      .table th,
      .table td, .table tr {
        border: 1px solid black;
        margin: 0px;
        text-align: center;
        width: 100%;
        padding: 10px; /* Add padding to create space between the cell content and border */
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
      $strands= App\Models\Strand::where('id', '!=', 7)->get();
      @endphp
      @foreach($strands as $strand)
    
        @php
        $sections = App\Models\Section::where('strand_id', $strand->id)->get();
        @endphp
        @foreach($sections as $section)
        <div class="title">
            <h3>Class Schedule of <span style="color:#bda370;">{{$strand->strand_name}} - {{$section->year_level}} - {{$section->section}}</span></h3>
          </div>

           
     <table class="table">
        <thead><tr> <th>TimeStamp</th>
      <th>Monday</th>
      <th>Tuesday</th>
      <th>Wednesday</th>
      <th>Thursday</th>
      <th>Friday</th>
     </tr></thead><tbody>
   
       <tr>
           <td>7:30AM - 8:30AM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '7:30AM - 8:30AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '7:30AM - 8:30AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '7:30AM - 8:30AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '7:30AM - 8:30AM')!!}</td>
           <td >   {!!OutputSched($section->id, 'Friday', '7:30AM - 8:30AM')!!} </td>
       </tr>
   
       <tr>
           <td>8:30AM - 9:30AM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '8:30AM - 9:30AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '8:30AM - 9:30AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '8:30AM - 9:30AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '8:30AM - 9:30AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Friday', '8:30AM - 9:30AM')!!}</td>
       </tr>
   
       <tr>
           <td>9:30AM - 9:45AM</td>
           <td style="text-align: center; font-weight:bold" colspan="6">Recess</td>
       </tr>
   
       <tr>
           <td>9:45AM - 10:45AM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '9:45AM - 10:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '9:45AM - 10:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '9:45AM - 10:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '9:45AM - 10:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Friday', '9:45AM - 10:45AM')!!}</td>
       </tr>
       <tr>
           <td>10:45AM - 11:45AM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '10:45AM - 11:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '10:45AM - 11:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '10:45AM - 11:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '10:45AM - 11:45AM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Friday', '10:45AM - 11:45AM')!!}</td>
       </tr>
       <tr>
           <td>11:45AM - 1:00PM</td>
           <td style="text-align: center; font-weight:bold" colspan="6">NOON BREAK</td>
       </tr>
       <tr>
           <td>1:00PM - 2:00PM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '1:00PM - 2:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '1:00PM - 2:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '1:00PM - 2:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '1:00PM - 2:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Friday', '1:00PM - 2:00PM')!!}</td>
       </tr>
       <tr>
           <td>2:00PM - 3:00PM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '2:00PM - 3:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '2:00PM - 3:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '2:00PM - 3:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '2:00PM - 3:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Friday', '2:00PM - 3:00PM')!!}</td>
       </tr>
       <tr>
           <td>3:00PM - 4:00PM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '3:00PM - 4:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '3:00PM - 4:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '3:00PM - 4:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '3:00PM - 4:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Friday', '3:00PM - 4:00PM')!!}</td>
       </tr>
       <tr>
           <td>4:00PM - 5:00PM</td>
           <td>   {!!OutputSched($section->id, 'Monday', '4:00PM - 5:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Tuesday', '4:00PM - 5:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Wednesday', '4:00PM - 5:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Thursday', '4:00PM - 5:00PM')!!}</td>
           <td>   {!!OutputSched($section->id, 'Friday', '4:00PM - 5:00PM')!!}</td>
       </tr>
       </tbody></table>
   
     
   
        @endforeach

      @endforeach
 

</body>
</html>

