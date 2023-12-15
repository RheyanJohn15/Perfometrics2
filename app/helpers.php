<?php
use App\Models\ClassSchedule;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\AssignedSubject;
if (!function_exists('randomString')) {
    function randomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    function YearLevelSectionConcat($year_level, $section){
       return $year_level . " - ".$section;
    }
    function YearLevelSectionSeperate($year_level_section){
        if($year_level_section==="Grade 11-A"){
            $year_level= "Grade 11";
            $section= "A";
        }elseif($year_level_section==="Grade 11-B"){
            $year_level= "Grade 11";
            $section= "B";
        }elseif($year_level_section==="Grade 12-A"){
            $year_level= "Grade 12";
            $section= "A";
        }elseif($year_level_section==="Grade 12-B"){
            $year_level= "Grade 12";
            $section= "B";
        }

        return [$year_level, $section];
    }
}

if(!function_exists('verificationCode')){
  function verificationCode(){

        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    
  }
}
if(!function_exists('StrandFilter')){
  function StrandFilter($strand){
    if($strand==="HUMSS 11-A" || $strand=== "HUMSS 11-B"){
      return array("Grade 11", "HUMSS(Humanities and Social Sciences)");
    }else if($strand==="HUMSS 12-A" || $strand=== "HUMSS 12-B"){
      return array("Grade 12", "HUMSS(Humanities and Social Sciences)");
    }else if($strand==="STEM 11-A" || $strand=== "STEM 11-B"){
      return array("Grade 11", "STEM(Science Technology and Engineering Mathematics)");
    }else if($strand==="STEM 12-A" || $strand=== "STEM 12-B"){
      return array("Grade 12", "STEM(Science Technology and Engineering Mathematics)");
    }else if($strand==="ABM 11-A" || $strand=== "ABM 11-B"){
      return array("Grade 11", "ABM(Accountancy and Business Management)");
    }else if($strand==="ABM 12-A" || $strand=== "ABM 12-B"){
      return array("Grade 12", "ABM(Accountancy and Business Management)");
    }else if($strand==="GAS 11-A" || $strand=== "GAS 11-B"){
      return array("Grade 11", "GAS(General Academic Strand)");
    }else if($strand==="GAS 12-A" || $strand=== "GAS 12-B"){
      return array("Grade 12", "GAS(General Academic Strand)");
    }else if($strand==="TVL-ICT 11-A" || $strand=== "TVL-ICT 11-B"){
      return array("Grade 11", "TVL-ICT(Technical Vocational Livelihood- Information Communications Technology)");
    }else if($strand==="TVL-ICT 12-A" || $strand=== "TVL-ICT 12-B"){
      return array("Grade 12", "TVL-ICT(Technical Vocational Livelihood- Information Communications Technology)");
    }else if($strand==="TVL-HE 11-A" || $strand=== "TVL-HE 11-B"){
      return array("Grade 11", "TVL-HE(Technical Vocational Livelihood-Home Economics)");
    }else if($strand==="TVL-HE 12-A" || $strand=== "TVL-HE 12-B"){
      return array("Grade 12", "TVL-HE(Technical Vocational Livelihood-Home Economics)");
    }
   }
  
}
if (!function_exists('OuputSched')) {
    function OutputSched($className, $day, $time) {
       $classSched= ClassSchedule::where('sched_class_name', $className)
       ->where('sched_day', $day)
       ->where('sched_time', $time)
       ->first();

       $teacher_id= $classSched->sched_teacher;
       $room_id= $classSched->sched_room;
       $subject_id= $classSched->sched_subject;
       if($teacher_id===6 && $subject_id===204 && $room_id===13){
        return "<p>Vacant</p>";
     }else{
      if($teacher_id===6){
        $teacherFullName="Not Set";
      }else{
        $teacher= Teacher::where('id', $teacher_id)->first();
        $middleName= $teacher->teacher_middle_name;
        $teachMiddleInitial= substr($middleName, 0,2 );
        if($teacher->teacher_suffix === 'none'){
          $finalSuffix = '';
        }else{
          $finalSuffix = $teacher->teacher_suffix;
        }
        $teacherFullName= $teacher->teacher_first_name. " ". $teachMiddleInitial. ". ". $teacher->teacher_last_name. " ". $finalSuffix;
      }
      
       $room= Room::where('id', $room_id)->first()->room_name;
       $subject= AssignedSubject::where('id', $subject_id)->first()->assigned_subject;

      return "<p style='font-size:9px'>".$teacherFullName."</p>
    <p style='font-size:9px'>(".$room. ")</p>
     <p style='font-size:9px'>".$subject."</p>";
     }
    }
}

if (!function_exists('IndivClassOutput')) {
    function IndivClassOutput($selectedClassStrand) {

       $begin= '<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
       <div class="w-full overflow-x-auto">
         <table class="w-full whitespace-no-wrap">
           <thead>
             <tr
               class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
             >
               <th class="px-4 py-3">Timestamps</th>
               <th class="px-4 py-3">Monday</th>
               <th class="px-4 py-3">Tuesday</th>
               <th class="px-4 py-3">Wednesday</th>
               <th class="px-4 py-3">Thursday</th>
               <th class="px-4 py-3">Friday</th>
             </tr>
           </thead>
           <tbody
             class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
           >
             <tr class="text-gray-700 dark:text-gray-400">
              
               <td class="px-4 py-3 text-sm">
               7:30AM - 8:30AM
               </td>
                 
               <td class="px-4 py-3 text-sm td">';
               
             
                if($selectedClassStrand==="NULL"){
                 $m1= "<p>Not Set</p><p>Click to Select</p>";
                }else{
                 $m1= OutputSched( $selectedClassStrand, 'Monday','7:30AM - 8:30AM' );
                }
                $one1= '</td>
                <td class="px-4 py-3 text-sm td">';
             
                    
              
              if($selectedClassStrand==="NULL"){
                $t1= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $t1=OutputSched( $selectedClassStrand, 'Tuesday','7:30AM - 8:30AM' );
               }
      
          $one2= '</td>
      
             <td class="px-4 py-3 text-sm td">';
             
             
              if($selectedClassStrand==="NULL"){
                $w1= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $w1= OutputSched( $selectedClassStrand, 'Wednesday','7:30AM - 8:30AM' );
               }
             $one3='
             </td>
      
             <td class="px-4 py-3 text-sm td">';
             
              if($selectedClassStrand==="NULL"){
                $th1= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $th1= OutputSched( $selectedClassStrand, 'Thursday','7:30AM - 8:30AM' );
               }
         $one4= '</td>
             <td  class="px-4 py-3 text-sm td">';
      
              if($selectedClassStrand==="NULL"){
                $f1= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $f1= OutputSched( $selectedClassStrand, 'Friday','7:30AM - 8:30AM' );
               }
       
       $secondPart=   '</td>
      
              </tr>
              <tr class="text-gray-700 dark:text-gray-400">
               
               <td class="px-4 py-3 text-sm">
               8:30AM - 9:30AM
               </td>
               
      
                  
               <td class="px-4 py-3 text-sm td">';
       
               if($selectedClassStrand==="NULL"){
                $m2= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $m2=OutputSched( $selectedClassStrand, 'Monday','8:30AM - 9:30AM' );
               }
          $two1= '
               </td>
               <td  class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $t2= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $t2=OutputSched( $selectedClassStrand, 'Tuesday','8:30AM - 9:30AM' );
               }
           
           $two2= '</td>
        
            <td class="px-4 py-3 text-sm td">';
          
              
              if($selectedClassStrand==="NULL"){
                $w2= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $w2=OutputSched( $selectedClassStrand, 'Wednesday','8:30AM - 9:30AM' );
               }
        
            $two3= '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
         
              if($selectedClassStrand==="NULL"){
                $th2= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $th2= OutputSched( $selectedClassStrand, 'Thursday','8:30AM - 9:30AM' );
               }
        
           $two4= '</td>
            <td class="px-4 py-3 text-sm td">';
         
              if($selectedClassStrand==="NULL"){
                $f2= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $f2=OutputSched( $selectedClassStrand, 'Friday','8:30AM - 9:30AM' );
               }
           
            $thirdPart= '</td>
        
            
               </tr>
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 9:30AM - 9:45AM
                 </td>
                 <td colspan="5" style="text-align:center; font-weight:bold;" class="px-4 py-3 text-sm">
                 RECESS
                 </td>
                 
               </tr>
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 9:45AM - 10:45AM
                 </td>
                    
                 <td  class="px-4 py-3 text-sm td">';
               
              
              if($selectedClassStrand==="NULL"){
                $m3= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $m3= OutputSched( $selectedClassStrand, 'Monday','9:45AM - 10:45AM' );
               }
          
              $three1= '</td>
               <td  class="px-4 py-3 text-sm td">';
            
              
              if($selectedClassStrand==="NULL"){
                $t3= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $t3=OutputSched( $selectedClassStrand, 'Tuesday','9:45AM - 10:45AM' );
               }
            $three2= '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
          
              if($selectedClassStrand==="NULL"){
                $w3= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $w3=OutputSched( $selectedClassStrand, 'Wednesday','9:45AM - 10:45AM' );
               }
        
            $three3= '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $th3= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $th3=OutputSched( $selectedClassStrand, 'Thursday','9:45AM - 10:45AM' );
               }
            $three4= '</td>
            <td class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $f3= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $f3=OutputSched( $selectedClassStrand, 'Friday','9:45AM - 10:45AM' );
               }
            
            $fourthPart= '</td>
        
            
               </tr>
        
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 10:45AM - 11:45AM
                 </td>
                 
                 <td class="px-4 py-3 text-sm td">';
               
              if($selectedClassStrand==="NULL"){
                $m4= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $m4= OutputSched( $selectedClassStrand, 'Monday','10:45AM - 11:45AM' );
               }
               $four1= '</td>
               <td  class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $t4= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $t4=OutputSched( $selectedClassStrand, 'Tuesday','10:45AM - 11:45AM' );
               }
        
           $four2= '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $w4= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $w4= OutputSched( $selectedClassStrand, 'Wednesday','10:45AM - 11:45AM' );
               }
         
         $four3=   '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $th4= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $th4=OutputSched( $selectedClassStrand, 'Thursday','10:45AM - 11:45AM' );
               }
        
            $four4= '</td>
            <td  class="px-4 py-3 text-sm td">';
          
              if($selectedClassStrand==="NULL"){
                $f4= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $f4=OutputSched( $selectedClassStrand, 'Friday','10:45AM - 11:45AM' );
               }
             
            $fifthPart= '</td>
        
        
               </tr>
               
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 11:45AM - 1:00PM
                 </td>
                 <td colspan="5" style="text-align:center; font-weight:bold;" class="px-4 py-3 text-sm">
                   NOON BREAK
                 </td>
               </tr>
        
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 1:00PM - 2:00PM
                 </td>
                 
                 <td  class="px-4 py-3 text-sm td">';
               
             
              
              if($selectedClassStrand==="NULL"){
                $m5= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $m5= OutputSched( $selectedClassStrand, 'Monday','1:00PM - 2:00PM' );
               }
             
              $fifth1= '</td>
               <td  class="px-4 py-3 text-sm td">';
         
              if($selectedClassStrand==="NULL"){
                $t5= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $t5= OutputSched( $selectedClassStrand, 'Tuesday','1:00PM - 2:00PM' );
               }
          
          $fifth2=  '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
              
              if($selectedClassStrand==="NULL"){
                $w5= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $w5= OutputSched( $selectedClassStrand, 'Wednesday','1:00PM - 2:00PM' );
               }
            $fifth3= '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $th5= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $th5= OutputSched( $selectedClassStrand, 'Thursday','1:00PM - 2:00PM' );
               }
            $fifth4= '</td>
            <td class="px-4 py-3 text-sm td">';
            
              
              if($selectedClassStrand==="NULL"){
                $f5= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $f5=OutputSched( $selectedClassStrand, 'Friday','1:00PM - 2:00PM' );
               }
            
            $sixthPart= '</td>
        
               </tr>
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 2:00PM - 3:00PM
                 </td>
                 
                 <td  class="px-4 py-3 text-sm td">';
               
               
              
              if($selectedClassStrand==="NULL"){
                $m6= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $m6= OutputSched( $selectedClassStrand, 'Monday','2:00PM - 3:00PM' );
               }
            
               $sixth1= '</td>
               <td class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $t6= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $t6=OutputSched( $selectedClassStrand, 'Tuesday','2:00PM - 3:00PM' );
               }
           $sixth2= '</td>
        
            <td class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $w6= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $w6=OutputSched( $selectedClassStrand, 'Wednesday','2:00PM - 3:00PM' );
               }
          
           $sixth3= '</td>
        
            <td class="px-4 py-3 text-sm td">';
            
           
              if($selectedClassStrand==="NULL"){
                $th6= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $th6=OutputSched( $selectedClassStrand, 'Thursday','2:00PM - 3:00PM' );
               }
             
            $sixth4= '</td>
            <td  class="px-4 py-3 text-sm td">';
              
              if($selectedClassStrand==="NULL"){
                $f6= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $f6=OutputSched( $selectedClassStrand, 'Friday','2:00PM - 3:00PM' );
               }
          
           $seventhPart= '</td>
        
               </tr>
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 3:00PM - 4:00PM
                 </td>
                  <td  class="px-4 py-3 text-sm td">';
               
                
              if($selectedClassStrand==="NULL"){
                $m7= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $m7=OutputSched( $selectedClassStrand, 'Monday','3:00PM - 4:00PM' );
               }
             
              $seventh1= '</td>
               <td  class="px-4 py-3 text-sm td">';
           
              if($selectedClassStrand==="NULL"){
                $t7= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $t7=OutputSched( $selectedClassStrand, 'Tuesday','3:00PM - 4:00PM' );
               }
            
           $seventh2= '</td>
        
            <td class="px-4 py-3 text-sm td">';
            
              
              if($selectedClassStrand==="NULL"){
                $w7= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $w7= OutputSched( $selectedClassStrand, 'Wednesday','3:00PM - 4:00PM' );
               }
            
            $seventh3= '</td>
        
            <td class="px-4 py-3 text-sm td">';
          
              if($selectedClassStrand==="NULL"){
                $th7= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $th7= OutputSched( $selectedClassStrand, 'Thursday','3:00PM - 4:00PM' );
               }
             
            $seventh4= '</td>
            <td class="px-4 py-3 text-sm td">';
            
              if($selectedClassStrand==="NULL"){
                $f7= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $f7=OutputSched( $selectedClassStrand, 'Friday','3:00PM - 4:00PM' );
               }
           
            $eightPart= '</td>
        
               </tr>
               <tr class="text-gray-700 dark:text-gray-400">
                 
                 <td class="px-4 py-3 text-sm">
                 4:00PM - 5:00PM
                 </td>
                  <td  class="px-4 py-3 text-sm td">';
              
              if($selectedClassStrand==="NULL"){
                $m8= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $m8=OutputSched( $selectedClassStrand, 'Monday','4:00PM - 5:00PM' );
               }
             
              $eight1= '</td>
               <td class="px-4 py-3 text-sm td">';
              if($selectedClassStrand==="NULL"){
                $t8= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $t8=OutputSched( $selectedClassStrand, 'Tuesday','4:00PM - 5:00PM' );
               }
        
            $eight2= '</td>
        
            <td  class="px-4 py-3 text-sm td">';
            
              
              if($selectedClassStrand==="NULL"){
                $w8= "<p>Not Set</p><p>Click to Select</p>";
               }else{
                $w8=OutputSched( $selectedClassStrand, 'Wednesday','4:00PM - 5:00PM' );
               }
            
        $eight3=    '</td>
        
            <td class="px-4 py-3 text-sm td">';
        
              if($selectedClassStrand==="NULL"){
                $th8= "<p>Not Set</p><p>Click to Select</p>";
               }else{
              $th8=  OutputSched( $selectedClassStrand, 'Thursday','4:00PM - 5:00PM' );
               }
        
           $eight4= '</td>
            <td  class="px-4 py-3 text-sm td">';
          
              if($selectedClassStrand==="NULL"){
                $f8= "<p>Not Set</p><p>Click to Select</p>";
               }else{
               $f8= OutputSched( $selectedClassStrand, 'Friday','4:00PM - 5:00PM' );
               }
               
             
     
         $lastpart= '</td>
     
            </tr>
            <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">
            CLASS ENDS
              </td>
            <td colspan="5" style="text-align:center; font-weight:bold;" class="px-4 py-3 text-sm">
                HOME SWEET HOME
              </td>
              
            </tr>
           </tbody>
         </table>
       </div>
     
     </div>';

$html= $begin. $m1. $one1. $t1. $one2. $w1. $one3. $th1. $one4. $f1.$secondPart. $m2. $two1. $t2. $two2. $w2. $two3. $th2. $two4. $f2. $thirdPart.
$m3.$three1. $t3. $three2. $w4. $three3. $th4. $three4. $f1. $fourthPart. $m4. $four1. $t4. $four2. $w4. $four3. $th4. $four4. $f4. $fifthPart.
$m5. $fifth1. $t5. $fifth2. $w5. $fifth3. $th5. $fifth4. $f5. $sixthPart. $m6. $sixth1. $t6. $sixth2. $w6. $sixth3. $th6. $sixth4. $f6. $seventhPart.
$m7. $seventh1. $t7. $seventh2. $w7. $seventh3. $th7.$seventh4. $f7. $eightPart. $m8.$eight1. $t8. $eight2. $w8. $eight3. $th8. $eight4. $f8. $lastpart;
     return $html;
    }
}

if(!function_exists('getOrdinalSuffix')){
  function getOrdinalSuffix($number) {
    $lastDigit = abs($number) % 10;
    $secondLastDigit = (abs($number) / 10) % 10;

    // Check for exceptions where the suffix is "th"
    if ($secondLastDigit == 1) {
        return $number . "th";
    }

    // Determine the appropriate suffix based on the last digit
    switch ($lastDigit) {
        case 1:
            return $number . "st";
        case 2:
            return $number . "nd";
        case 3:
            return $number . "rd";
        default:
            return $number . "th";
    }
}
}


if(!function_exists('ensureUniqueUsernames')){
  function ensureUniqueUsernames(array &$usernames) {
    $count = array_count_values($usernames);
    foreach ($count as $username => $frequency) {
        if ($frequency > 1) {
            $suffix = 1;
            foreach ($usernames as &$name) {
                if ($name === $username) {
                    $name = $username . $suffix;
                    $suffix++;
                }
            }
        }
    }
}
}

if(!function_exists('AnalyticIndex')){
  function AnalyticIndex($sem, $year) {
    
    if ($sem === "1st" && $year === "2023-2024") {
      return 0;
  } else if ($sem === "2nd" && $year === "2023-2024") {
      return 1;
  } else if ($sem === "1st" && $year === "2024-2025") {
      return 2;
  } else if ($sem === "2nd" && $year === "2024-2025") {
      return 3;
  } else if ($sem === "1st" && $year === "2025-2026") {
      return 4;
  } else if ($sem === "2nd" && $year === "2025-2026") {
      return 5;
  } else if ($sem === "1st" && $year === "2026-2027") {
      return 6;
  } else if ($sem === "2nd" && $year === "2026-2027") {
      return 7;
  } else if ($sem === "1st" && $year === "2027-2028") {
      return 8;
  } else if ($sem === "2nd" && $year === "2027-2028") {
      return 9;
  } else {
      return null;
  }
  
}
}
?>
