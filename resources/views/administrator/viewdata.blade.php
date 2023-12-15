@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Evaluation Result-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
  />
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
    defer
  ></script>
    <script src="{{asset('dashboard/js/overall.js')}}" ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <script src="{{asset('dashboard/js/quote.js')}}"></script>
  </head>
<style>
    tbody tr:hover{
        background-color: #e5e7eb;
        cursor: pointer;
    }
    .nav{
      cursor: pointer;
    }
    #ranking{
      text-decoration: underline;
    }
    .legend-container {
      display: grid;
    grid-template-columns: repeat(4, 1fr); /* Set 4 columns */
    gap: 10px; /* Adjust the gap between items */
    justify-content: center; /* Center the items horizontally */
    margin-top: 4px; /* Adjust margin as needed */
}
</style>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <body>
    @php
    $image= App\Models\Admin::where('id', session('user_id'))->first();

    if($image->admin_image===1){
        $profilePic= asset('Users/Admin('. session('user_id'). ").". $image->admin_image_type);
    }else{
        $profilePic= asset('Users/ph.jpg');
    }

    if($image->admin_suffix==="none"){
      $adminFinalSuffix="";
    }else{
      $adminFinalSuffix= $image->admin_suffix;
    }
    $admin_username= $image->admin_first_name. " ". substr($image->admin_middle_name, 0, 1). ". ". $image->admin_last_name. " ". $adminFinalSuffix;
    
    @endphp
 @include('administrator/loading_screen', ['location'=>'view'])
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column;margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="{{route('viewData')}}"
          ><span style="text-align: center; font-size:15px">
        {{$admin_username}}
          </span></a>
       @include('administrator/desktop_nav', ['location'=>'view_data'])
          <div class="px-6 my-6">
          
          </div>
        </div>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="{{route('viewData')}}"
          ><span style="text-align: center; font-size:15px">
       {{$admin_username}}
          </span></a>
         
        @include('administrator/mobile_nav', ['location'=>'view_data'])
        
        </div>
      </aside>
      <div class="flex flex-col flex-1">
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute w-full inset-y-0 flex items-center pl-2">
                 
                </div>

              </div>
            </div>

          
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
                <button
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleTheme"
                  aria-label="Toggle color mode"
                >
                  <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
             
              
             
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="{{$profilePic}}"
                    alt=""
                    aria-hidden="true"
                  />
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="{{route('AdminProfile')}}"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          ></path>
                        </svg>
                        <span>Profile</span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="{{route('settings')}}"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                          ></path>
                          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                      </a>
                    </li>
                    <form action="{{route('logout')}}" method="post">
                      @method('post')
                      @csrf
                    <li class="flex">
                      
                      <button
                      id="logout" type="submit"
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                       
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Log out</span>
                      </button>
                    </li>
                  </form>

                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </header>
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container px-6 mx-auto grid">

           
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Evaluation Results
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
           <div class="flex">
            <h4 id="ranking" onclick="ranking()"
            class="mb-4 hover:underline text-lg font-semibold text-gray-600 dark:text-gray-300 nav"
          >
           Rankings
          </h4>
          <h4 id="overall" onclick="overall()"
          class="mb-4 ml-4 hover:underline text-lg font-semibold text-gray-600 dark:text-gray-300 nav"
        >
         Overall Data Analytics
        </h4>
       
           </div>
         
           <div id="rankings">

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    > 
                    <th class="px-4 py-3 ">Rankings</th>
                      <th class="px-4 py-3">Teachers</th>
                      <th class="px-4 py-3">Overall Scores(4)</th>
                      <th class="px-4 py-3">Percentage Score</th>
                      <th class="px-4 py-3">Sub Score(Student)</th>
                      <th class="px-4 py-3">Sub Score(Coordinator)</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

@php 
$teachers= App\Models\Teacher::where('id', '!=', 6)->get();
$weights = App\Models\Admin::where('admin_type', 'Super Admin')->first();
$t=0;

$teacherRanks = [];

 @endphp
@foreach ($teachers as $teacher)
@php

    $score1= App\Models\EvaluationResult::where('teacher_id', $teacher->id)->where('evaluator_type', 'Student')->get();
    $score2= App\Models\EvaluationResult::where('teacher_id', $teacher->id)->where('evaluator_type', 'Coordinator')->get();
    $totalScore1 = $score1->sum('evaluation_score');
    $totalRows1 = $score1->count();

    $totalScore2 = $score2->sum('evaluation_score');
    $totalRows2 = $score2->count();
    
    $image=$teacher->teacher_image;
    if($image===1){
      $pic= asset("Users/Teacher(". $teacher->id. ").". $teacher->teacher_image_type);
    }else{
      $pic=asset( 'Users/ph.jpg');
    }

   if($totalScore1===0 || $totalRows1===0){
    $totalAverage1=0;
   }else{
    $weightValue1 = ($totalScore1/$totalRows1) / 4;
    $totalAverage1  = $weights->student_weight * $weightValue1;
   }

   if($totalScore2===0 || $totalRows2===0){
    $totalAverage2=0;
   }else{
    $weightValue2 = ($totalScore2/$totalRows2) /4;
    $totalAverage2= $weights->coordinator_weight * $weightValue2;
   }

   $totalPercent = $totalAverage1 + $totalAverage2;
   $finalAverage = 4 * ($totalPercent/100); 
  
  $bar= 49.5*$finalAverage;
   if($totalAverage1===0){
    $bar2=0;
    $percent1= 0;
    $percentage1=0;
   }else{
    $percent1= ($totalAverage1/$weights->student_weight)*100;
    $percentage1= number_format($percent1, 2);
    $bar2= 198*$weightValue1;
   }

   if($totalAverage2===0){
    $bar3= 0;
    $percent2=0;
    $percentage2=0;
   }else{
    $percent2= ($totalAverage2/$weights->coordinator_weight)*100;
    $percentage2= number_format($percent2, 2);
    $bar3= 198 * $weightValue2;
   }

if($teacher->teacher_suffix==="none"){
  $finalSuffix= " ";
}else{
  $finalSuffix= $teacher->teacher_suffix;
}


$teacherData= [number_format($finalAverage, 2), $teacher->id, $bar, $pic, $percentage1,$percentage2, $bar2, $bar3];
array_push($teacherRanks, $teacherData);


@endphp
  
 @endforeach
                    
               @php
                   function customSort($a, $b) {
    if ($a[0] == $b[0]) {
        return 0;
    }
    return ($a[0] > $b[0]) ? -1 : 1;
}

// Sort the array of arrays using the custom comparison function
usort($teacherRanks, 'customSort');

               @endphp        
               
  @foreach ($teacherRanks as $teacher)
  @php
      $name= App\Models\Teacher::where('id', $teacher[1])->first();
      if($name->teacher_suffix==="none"){
        $finalSuffix=" ";
      }else{
        $finalSuffix= $name->teacher_suffix;
      }
      $fullname= $name->teacher_first_name. " ". substr($name->teacher_middle_name, 0, 1). ". ". $name->teacher_last_name. " " . $finalSuffix;

      $percentage= ($teacher[0]/4)*100;
  @endphp
  <tr onclick="openData{{$t}}(`{{$t+1}}`)" id="tr{{$t}}" class="text-gray-700 dark:text-gray-400 text-center font-semibold ">
    <td class="px-4 py-3 flex items-center justify-center">
      @php
          $rank=$t+1;
      @endphp
    @if ($rank===1 && $teacher[0] != 0)
    <img src="{{asset('images/1st.png')}}" class="rankImage" alt="rankImage">
     @elseif($rank===2 && $teacher[0] != 0)   
     <img src="{{asset('images/2nd.png')}}" class="rankImage" alt="rankImage">
     @elseif($rank===3 && $teacher[0] != 0)
     <img src="{{asset('images/3rd.png')}}" class="rankImage" alt="rankImage">
     @else
     {{getOrdinalSuffix($rank)}}
    @endif
    </td>
    <td class="px-4 py-3">
    <div class="flex items-center text-sm">
    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
    <img class="object-cover w-full h-full rounded-full" src="{{$teacher[3]}}" alt="" loading="lazy"/>
    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div>
    <div><p class="font-semibold">{{$fullname}}</p>
    </td>
    <td class="px-4 py-3">
      <p class="text-xs text-gray-600 dark:text-gray-400"><div class="cover"><div class="bar_graph" style= "width: {{$teacher[2]}}px"></div></div><p class="text-xs text-gray-600 dark:text-gray-400">Over all Rating: {{$teacher[0]}}</p></p></div></div>
    </td>
    <td class="px-4 py-3">
       {{$percentage}}%
    </td>
    <td class="px-4 py-3">
      <p class="text-xs text-gray-600 dark:text-gray-400"><div class="cover"><div class="bar_graph_student" style= "width: {{$teacher[6]}}px"></div></div><p class="text-xs text-gray-600 dark:text-gray-400">Student Rating: {{$teacher[4]}}%</p></p></div></div>
    </td>
    <td class="px-4 py-3">
      <p class="text-xs text-gray-600 dark:text-gray-400"><div class="cover"><div class="bar_graph_coordinator" style= "width: {{$teacher[7]}}px"></div></div><p class="text-xs text-gray-600 dark:text-gray-400">Coordinator Rating: {{$teacher[5]}}%</p></p></div></div>
    </td>
    </tr>
    <script>
     function openData{{$t}}(place){
     const teacher_id="{{$teacher[1]}}";
     window.location.href= "{{route('result')}}?teacher_id="+teacher_id+"&place="+place;
   }
      
   </script>
   
   @php
   $t++;
   @endphp

  @endforeach

                  
                  </tbody>
                </table>
              </div>

            </div>
           </div>


           <div id="overalls"  style="display: none; width:98%">
            <div class="grid gap-6 md:grid-cols-2">
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  @php
                      $adminSemYear= App\Models\Admin::where('admin_type', 'Super Admin')->first();
                  @endphp
                  Student's Assessment (Current Year and Sem: {{$adminSemYear->admin_sy}} - {{$adminSemYear->admin_sem}} Sem)
                </h4>
                <canvas id="lineStudent"></canvas>
               
              </div>
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Coordinator's Assessment (Current Year and Sem: {{$adminSemYear->admin_sy}} - {{$adminSemYear->admin_sem}} Sem)
                </h4>
                <canvas id="lineCoordinator"></canvas>
              
              </div>
            </div>
            <p class="text-xl font-semibold text-gray-600 dark:text-gray-400 text-center">
              Legends
            </p>
            <div id="legend"
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 legend-container"
          >
           
          </div>
          <label class="block mt-4 mb-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
              Years
            </span>
            <select onchange="selectFilter(this)"
              class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            > <option selected value="9">All 5 Years</option>
              <option value="1">1st year</option>
              <option value="2">2nd Year</option>
              <option value="3">3rd Year</option>
              <option value="4">4th Year</option>
              <option value="5">5th Year</option>
              <option value="6">1-2 Years</option>
              <option value="7">1-3 Years</option>
              <option value="8">1-4 Years</option>

            </select>
          </label>
            <div
            class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
          >
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
              Historical Overview of Teacher Effectiveness(5 years)
            </h4>
            
            <canvas id="bars"></canvas>
            <div
              class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
            >
              <!-- Chart legend -->
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"
                ></span>
                <span>Students Evaluation</span>
              </div>
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                ></span>
                <span>Coordinators Evaluation</span>
              </div>
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 rounded-full" style="background-color:#ff8a4c"
                ></span>
                <span>Over all Scores</span>
              </div>
            </div>
          </div>


          

           </div>
           @php
           function AnalyticsOverAll($semester, $year){
            $analytics= App\Models\Analytics::where('semester', $semester)->where('acad_year', $year)->get();
            if($analytics->count()>0){
              $score = $analytics->sum('evaluation_score') / $analytics->count('evaluation_score');
              $percentage= ($score/4)*100;
            }else{
              $percentage= 0;
            }
            return number_format($percentage, 2);
           }

           function AnalyticsCoordinator($semester, $year){
            $analytics= App\Models\Analytics::where('semester', $semester)->where('acad_year', $year)->where('evaluator_type', 'Coordinator')->get();
            if($analytics->count()>0){
              $score = $analytics->sum('evaluation_score') / $analytics->count('evaluation_score');
              $percentage= ($score/4)*100;
            }else{
              $percentage= 0;
            }
            return number_format($percentage, 2);
            }

           function AnalyticsStudent($semester, $year){
            $analytics= App\Models\Analytics::where('semester', $semester)->where('acad_year', $year)->where('evaluator_type', 'Student')->get();
            if($analytics->count()>0){
              $score = $analytics->sum('evaluation_score') / $analytics->count('evaluation_score');
              $percentage= ($score/4)*100;
            }else{
              $percentage= 0;
            }
            return number_format($percentage, 2);
           }

           
           $studentOverallEvaluation=json_encode([ AnalyticsStudent('1st', '2023-2024'),AnalyticsStudent('2nd', '2023-2024'),AnalyticsStudent('1st', '2024-2025'),
           AnalyticsStudent('2nd', '2024-2025'),AnalyticsStudent('1st', '2025-2026'),AnalyticsStudent('2nd', '2025-2026'),AnalyticsStudent('1st', '2026-2027'),
           AnalyticsStudent('2nd', '2026-2027'),AnalyticsStudent('1st', '2027-2028'),AnalyticsStudent('2nd', '2027-2028')]);
           
           $teacherOverallEvaluation=json_encode([AnalyticsCoordinator('1st', '2023-2024'),AnalyticsCoordinator('2nd', '2023-2024'),AnalyticsCoordinator('1st', '2024-2025'),
           AnalyticsCoordinator('2nd', '2024-2025'),AnalyticsCoordinator('1st', '2025-2026'),AnalyticsCoordinator('2nd', '2025-2026'),AnalyticsCoordinator('1st', '2026-2027'),
           AnalyticsCoordinator('2nd', '2026-2027'),AnalyticsCoordinator('1st', '2027-2028'),AnalyticsCoordinator('2nd', '2027-2028')]);
           $overallEvaluation=json_encode([AnalyticsOverAll('1st', '2023-2024'),AnalyticsOverAll('2nd', '2023-2024'),AnalyticsOverAll('1st', '2024-2025'),
           AnalyticsOverAll('2nd', '2024-2025'),AnalyticsOverAll('1st', '2025-2026'),AnalyticsOverAll('2nd', '2025-2026'),AnalyticsOverAll('1st', '2026-2027'),AnalyticsOverAll('2nd', '2026-2027'),
           AnalyticsOverAll('1st', '2027-2028'),AnalyticsOverAll('1st', '2027-2028')]);

         
          $teacherArrayList=[];
          $teacherLineID= [];

          $questionArrayStudentLine=[];
          $studentQuestionArrayLine=[];
          $studentScoreTeacherLine=[];

          $questionArrayCoordinatorLine=[];
          $coordinatorQuestionArrayLine=[];
          $coordinatorScoreTeacherLine=[];

          $teacherArrayLine= App\Models\Teacher::where('id', '!=', 6)->get();
           $questionStudent = App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
           $questionCoordinator = App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
            
           for($sLine=1; $questionStudent->count()>=$sLine; $sLine++ ){
            array_push($questionArrayStudentLine, "S".$sLine);
           }
            
           for($sLine=1; $questionCoordinator->count()>=$sLine; $sLine++ ){
            array_push($questionArrayCoordinatorLine, "C".$sLine);
           }

           foreach($questionStudent as $question){
            array_push($studentQuestionArrayLine, $question->id);
           }
           
           foreach($questionCoordinator as $question){
            array_push($coordinatorQuestionArrayLine, $question->id);
           }
           foreach($teacherArrayLine as $teacher){
            array_push($teacherArrayList, $teacher->teacher_last_name." ". substr($teacher->teacher_first_name, 0, 1). ".");
            array_push($teacherLineID, $teacher->id);
           }
          

           foreach($teacherLineID as $teacher){
            $scoreArray=[];
               foreach($studentQuestionArrayLine as $question){
                $teacherLine= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher)->where('question_id', $question)->get();
                if($teacherLine->isEmpty()){
                  $score=0;
                }else{
                  $score= $teacherLine->sum('evaluation_score')/ $teacherLine->count();
                  array_push($scoreArray, number_format($score, 2));
                }
               }

            array_push($studentScoreTeacherLine, $scoreArray);
           }
        
           foreach($teacherLineID as $teacher){
            $scoreArray=[];
               foreach($coordinatorQuestionArrayLine as $question){
                $teacherLine= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher)->where('question_id', $question)->get();
                if($teacherLine->isEmpty()){
                  $score=0;
                }else{
                  $score= $teacherLine->sum('evaluation_score')/ $teacherLine->count();
                  array_push($scoreArray, number_format($score, 2));
                }
               }

            array_push($coordinatorScoreTeacherLine, $scoreArray);
           }
            $jsonArrayStudentLine= json_encode($questionArrayStudentLine);
            $jsonTeacherList= json_encode($teacherArrayList);
            $jsonStudentScoreTeacher= json_encode($studentScoreTeacherLine);

            $jsonCoordinatorScoreTeacher= json_encode($coordinatorScoreTeacherLine);
            $jsonArrayCoordinatorLine= json_encode($questionArrayCoordinatorLine);
           @endphp
         
           <script>

            function ranking(){
              const ranking = document.getElementById('ranking');
              const rankings= document.getElementById('rankings');
              const overall= document.getElementById('overall');
              const overalls= document.getElementById('overalls');

              ranking.style.textDecoration='underline';
              overall.style.textDecoration='none';
              overalls.style.display= "none";
              rankings.style.display="";
            }
            function overall(){
              const ranking = document.getElementById('ranking');
              const rankings= document.getElementById('rankings');
              const overall= document.getElementById('overall');
              const overalls= document.getElementById('overalls');

              ranking.style.textDecoration='none';
              overall.style.textDecoration='underline';
              overalls.style.display= "";
              rankings.style.display="none";
            }

           let filter = "9";
            function selectFilter(dataValue){
              const student ={!! $studentOverallEvaluation !!};
                 const teacher ={!! $teacherOverallEvaluation !!};
                 const overall ={!! $overallEvaluation !!};
                 filter= dataValue.value;
                 dataAnalytics(student, teacher, overall, filter);
           
            }
                window.onload = function() {
                 const student ={!! $studentOverallEvaluation !!};
                 const teacher ={!! $teacherOverallEvaluation !!};
                 const overall ={!! $overallEvaluation !!};

                 const studentLine= {!! $jsonArrayStudentLine !!};
                 const teacherList = {!! $jsonTeacherList !!};
                 const teacherScoreStudent= {!! $jsonStudentScoreTeacher !!};
                 
                 const color=[];
  for(let i=0; teacherList.length>i; i++){
      color.push(getRandomHexColor());
  }

                 const coordinatorLine= {!! $jsonArrayCoordinatorLine !!};
                 const teacherScoreCoordinator= {!! $jsonCoordinatorScoreTeacher !!}


                  dataAnalytics(student, teacher, overall, filter);
                  LineStudent(studentLine, teacherList, teacherScoreStudent, color);
                  LineCoordinator(coordinatorLine, teacherList, teacherScoreCoordinator, color);

                  
                 
               
                  
                   };
           </script>



          </div>
        </main>
      </div>
    </div>
  </body>
</html>
@else
 @include('administrator.unauthorized')
@endif