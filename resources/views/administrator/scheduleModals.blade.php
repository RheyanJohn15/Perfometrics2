<div id="monday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            <optgroup label="Building 1">
            @foreach ($building1 as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 1st Floor">
            @foreach ($building2_1st as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 2nd Floor">
            @foreach ($building2_2nd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 3rd Floor">
            @foreach ($building2_3rd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 4th Floor">
            @foreach ($building2_4th as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
              @php
              $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                  ->where('room_day', 'Tuesday')
                  ->first(); // Use first() to get the actual model instance
          @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
              @php
              $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                  ->where('room_day', 'Tuesday')
                  ->first(); // Use first() to get the actual model instance
          @endphp
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
              @php
              $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                  ->where('room_day', 'Tuesday')
                  ->first(); // Use first() to get the actual model instance
          @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
              @php
              $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                  ->where('room_day', 'Tuesday')
                  ->first(); // Use first() to get the actual model instance
          @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
              @php
              $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                  ->where('room_day', 'Tuesday')
                  ->first(); // Use first() to get the actual model instance
          @endphp
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>


  <div id="thursday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>


  <div id="friday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
             <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <!--8:30AM-9:30AM-->
  <div id="monday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
           <optgroup label="Building 1">
            @foreach ($building1 as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 1st Floor">
            @foreach ($building2_1st as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 2nd Floor">
            @foreach ($building2_2nd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 3rd Floor">
            @foreach ($building2_3rd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 4th Floor">
            @foreach ($building2_4th as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>

                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
              <optgroup label="Building 1">
                @foreach ($building1 as $room)
                    @php
                        $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                            ->where('room_day', 'Thursday')
                            ->first(); // Use first() to get the actual model instance
                    @endphp
                
                    @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                        <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                    @else
                        <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                    @endif
                @endforeach
              </optgroup>
              <optgroup label="Building 2 - 1st Floor">
                @foreach ($building2_1st as $room)
                    @php
                        $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                            ->where('room_day', 'Thursday')
                            ->first(); // Use first() to get the actual model instance
                    @endphp
                
                    @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                        <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                    @else
                        <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                    @endif
                @endforeach
              </optgroup>
              <optgroup label="Building 2 - 2nd Floor">
                @foreach ($building2_2nd as $room)
                    @php
                        $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                            ->where('room_day', 'Thursday')
                            ->first(); // Use first() to get the actual model instance
                    @endphp
                
                    @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                        <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                    @else
                        <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                    @endif
                @endforeach
              </optgroup>
              <optgroup label="Building 2 - 3rd Floor">
                @foreach ($building2_3rd as $room)
                    @php
                        $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                            ->where('room_day', 'Thursday')
                            ->first(); // Use first() to get the actual model instance
                    @endphp
                
                    @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                        <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                    @else
                        <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                    @endif
                @endforeach
              </optgroup>
              <optgroup label="Building 2 - 4th Floor">
                @foreach ($building2_4th as $room)
                    @php
                        $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                            ->where('room_day', 'Thursday')
                            ->first(); // Use first() to get the actual model instance
                    @endphp
                
                    @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                        <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                    @else
                        <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                    @endif
                @endforeach
              </optgroup>

                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30 - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>

            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'9:45 - 10:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>

                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
          <optgroup label="Building 1">
            @foreach ($building1 as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 1st Floor">
            @foreach ($building2_1st as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 2nd Floor">
            @foreach ($building2_2nd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 3rd Floor">
            @foreach ($building2_3rd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 4th Floor">
            @foreach ($building2_4th as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
          <optgroup label="Building 1">
            @foreach ($building1 as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 1st Floor">
            @foreach ($building2_1st as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 2nd Floor">
            @foreach ($building2_2nd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 3rd Floor">
            @foreach ($building2_3rd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 4th Floor">
            @foreach ($building2_4th as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  
  <div id="monday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 2:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 2:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 2:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 2:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 2:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
          <optgroup label="Building 1">
            @foreach ($building1 as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 1st Floor">
            @foreach ($building2_1st as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 2nd Floor">
            @foreach ($building2_2nd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 3rd Floor">
            @foreach ($building2_3rd as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
          <optgroup label="Building 2 - 4th Floor">
            @foreach ($building2_4th as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                @endif
            @endforeach
          </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Monday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Tuesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Wednesday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Thursday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        $classSectionName= $ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut
        @endphp
        {{$classSectionName}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 <strong>{{$classSectionName}}</strong> Assigned Subject And Teachers
                </span>
                <select name="subject" id="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                @php
                    $assignedSubject = App\Models\AssignedTeacher::where('subject_id', $subject->id)->where('section_id', session('selectedStrand'))->first();
                @endphp
                @if ($assignedSubject)
                @php
                    $teacher= App\Models\Teacher::where('id', $assignedSubject->teacher_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $finalSuffix= "";
                    }else{
                      $finalSuffix= $teacher->teacher_suffix;
                    }
                    $teacherName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ".  $teacher->teacher_last_name. " ". $finalSuffix;
                @endphp
                <option value="{{$subject->id}}-{{$assignedSubject->teacher_id}}">{{$subject->assigned_subject}} - {{$teacherName}}</option>
                @else
                <option value="{{$subject->id}}-6">{{$subject->assigned_subject}} - <i>None</i></option>
                @endif
               
                @endforeach
              </select>
              </label>
          
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                 @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
                $building1=[];
                $building2_1st=[];
                $building2_2nd=[];
                $building2_3rd=[];
                $building2_4th=[];
      
                foreach ($rooms as $room) {
                  if($room->room_building==="1st Building"){
                    array_push($building1, $room->id);
                  }else if($room->room_building==="2nd Building"){
                    if($room->room_floor==="1st Floor"){
                      array_push($building2_1st, $room->id);
                    }else if($room->room_floor==="2nd Floor"){
                      array_push($building2_2nd, $room->id);
                    }else if($room->room_floor==="3rd Floor"){
                      array_push($building2_3rd, $room->id);
                    }else if($room->room_floor==="4th Floor"){
                      array_push($building2_4th, $room->id);
                    }
                  }
                }
            @endphp
            
            <optgroup label="Building 1">
              @foreach ($building1 as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 1st Floor">
              @foreach ($building2_1st as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}"  value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 2nd Floor">
              @foreach ($building2_2nd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 3rd Floor">
              @foreach ($building2_3rd as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            <optgroup label="Building 2 - 4th Floor">
              @foreach ($building2_4th as $room)
                  @php
                      $availableRoom = App\Models\RoomAvailable::where('room_id', $room)
                          ->where('room_day', 'Friday')
                          ->first(); // Use first() to get the actual model instance
                  @endphp
              
                  @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                      <option disabled id="{{ $room }}" value="{{ $room }}">{{ App\Models\Room::where('id', $room)->first()->room_name }} (Occupied)</option>
                  @else
                      <option id="{{ $room }}" value="{{ $room }}">{{  App\Models\Room::where('id', $room)->first()->room_name }}</option>
                  @endif
              @endforeach
            </optgroup>
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>