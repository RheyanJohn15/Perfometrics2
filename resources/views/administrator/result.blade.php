@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Scores-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="{{asset('dashboard/js/result.js')}}" defer></script>
    <script src="{{asset('dashboard/js/quote.js')}}"></script>
  </head>
  <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  <link rel="icon" href="{{asset('images/icon.png')}}">
 <style>
  tbody .scores:hover{
background-color:#e5e7eb; 
    cursor: pointer; 
  }
 </style>
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
  <div id="modalContainer" class="MainModal">
              <div class="contentModal">
              <h4
              id="header"
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
           <br>
            </h4>
              <h4
              id="question"
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
            
            </h4>
              </div>
            </div>
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
         </span> </a>
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
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column;margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
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
            @php
                $teachProfile= App\Models\Teacher::where('id', $teacher_id)->first();

                if($teachProfile->teacher_image===1){
                  $teachPicture= asset("Users/Teacher(". $teacher_id. ").". $teachProfile->teacher_image_type);
                }else{
                  $teachPicture= asset('Users/ph.jpg');
                }
                if($teachProfile->teacher_suffix==='none'){
                $teachSuffix ='';
                }else{
                $teachSuffix=$teachProfile->teacher_suffix;
                }
                $studentFetchEval = App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher_id)->get();
                $coordinatorFetchEval = App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher_id)->get();
                $studentInitialScore = $studentFetchEval->sum('evaluation_score') / $studentFetchEval->count();
                $coordinatorInitialScore = $coordinatorFetchEval->sum('evaluation_score') / $coordinatorFetchEval->count();

                $adminWeight = App\Models\Admin::where('admin_type', 'Super Admin')->first();
                $studentWeight= $adminWeight->student_weight;
                $coordinatorWeight = $adminWeight->coordinator_weight;

                $totalTeacherScorePercentage = (($studentInitialScore/4) * $studentWeight) + (($coordinatorInitialScore/4) * $coordinatorWeight);
                $totalTeacherAverageScore = 4 * ( $totalTeacherScorePercentage / 100);
            @endphp
            
            <div class="w-full mt-8 flex items-center">
              <img style="width: 13rem; height:13rem; border-radius:50%;" src="{{$teachPicture}}" class="border border-solid-gray-800" alt="pic">
               <div>
                <h4
                class="mb-4 ml-4 text-xl mt-4 font-semibold text-gray-600 dark:text-gray-300">
               Faculty Member
              </h4>
              <h4
              class="mb-4 ml-4 text-sm font-semibold  text-gray-600 dark:text-gray-300">
              Name: <span class="underline">{{$teachProfile->teacher_first_name. ", ". $teachProfile->teacher_last_name. " ". substr($teachProfile->teacher_middle_name, 0, 1). " ".$teachSuffix }}</span>
            </h4>
            <h4
              class="mb-4 ml-4 text-sm font-semibold  text-gray-600 dark:text-gray-300">
              Total Evaluation Score: <span class="underline">{{number_format($totalTeacherAverageScore, 3)}}</span>
            </h4>
             <h4
              class="mb-4 ml-4 text-sm font-semibold  text-gray-600 dark:text-gray-300">
              Ranking: <span class="underline">{{$place}}</span>
            </h4>
      </div>
    
            </div>

            <div id="dashboardData">
              @php
            
              $populationS = App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher_id)
   ->distinct('evaluator_id')
   ->count('evaluator_id');
   $populationC = App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher_id)
   ->distinct('evaluator_id')
   ->count('evaluator_id');
         
     @endphp
     
              <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Dashboard     <button onclick="backRankings()" type="button"  style="float:right"
            class="px-4 ml-8 mt-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  <script>
                      function backRankings(){
                          window.location.href= "{{route('viewData')}}";
                      }
                  </script>
<i class="fa-solid fa-arrow-left"></i> Return To Rankings
                </button>
            </h2>
        
          
            @if ($populationS>0 || $populationC>0)
            @php
            $SEvaluator = App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
            $barStudentQ = [];
            $barStudentAverage = [];
            $studNum = 1;
            foreach ($SEvaluator as $evaluator) {
                array_push($barStudentQ, 'S' . $studNum);
                $score = App\Models\EvaluationResult::where('question_id', $evaluator->id)->where('teacher_id', $teacher_id)->get();
                
                if ($score->count() === 0) {
                    $average = 0;
                } else {
                    $average = $score->sum('evaluation_score') / $score->count();
                }
                
                array_push($barStudentAverage, number_format($average, 2));
                $studNum++;
            }
            
            $CEvaluator = App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
            $barCoordinatorQ = [];
            $barCoordAverage = [];
            $coordNum = 1;
            foreach ($CEvaluator as $evaluator) {
                array_push($barCoordinatorQ, 'C' . $coordNum);
                $score = App\Models\EvaluationResult::where('question_id', $evaluator->id)->where('teacher_id', $teacher_id)->get();
                
                if ($score->count() === 0) {
                    $average = 0;
                } else {
                    $average = $score->sum('evaluation_score') / $score->count();
                }
                
                array_push($barCoordAverage, number_format($average, 2));
                $coordNum++;
            }
            
            $teacherList = App\Models\Teacher::where('id', '!=', 6)->get();
            $teachersArray = [];
            $teachersArrayScore = [];
            foreach ($teacherList as $list) {
                $teacher = $list->teacher_last_name . " " . substr($list->teacher_first_name, 0, 1);
                array_push($teachersArray, $teacher);
                $scoreStudent = App\Models\EvaluationResult::where('teacher_id', $list->id)->where('evaluator_type', 'Student')->get();
                $scoreCoordinator = App\Models\EvaluationResult::where('teacher_id', $list->id)->where('evaluator_type', 'Coordinator')->get();
                if ($scoreStudent->count() === 0 || $scoreCoordinator->count()===0) {
                    $averages = 0;
                } else {
                  $adminWeight = App\Models\Admin::where('admin_type', 'Super Admin')->first();
                    $studentWeight = $adminWeight->student_weight;
                    $coordinatorWeight = $adminWeight->coordinator_weight;
                    $studentScore=($scoreStudent->sum('evaluation_score') / $scoreStudent->count() )/4;
                    $coordinatorScore= ($scoreCoordinator->sum('evaluation_score')/$scoreCoordinator->count())/4;
                    $studentPercent = $studentScore *  $studentWeight;
                    $coordinatorPercent = $coordinatorScore * $coordinatorWeight;
                    $percentage = ($studentPercent + $coordinatorPercent) / 100;
                    $averages =  $percentage * 4;
                }
            
                array_push($teachersArrayScore, number_format($averages, 2));
            }
            
            $teacherCurrent = App\Models\Teacher::where('id', $teacher_id)->first();
            $teacherArrayName = $teacherCurrent->teacher_last_name . " " . substr($teacherCurrent->teacher_first_name, 0, 1);



            function Analytics($sem, $year, $teacher){

              $adminWeight = App\Models\Admin::where('admin_type', 'Super Admin')->first();
              $studentWeight = $adminWeight->student_weight;
              $coordinatorWeight= $adminWeight->coordinator_weight;
              $scoreStudent = App\Models\Analytics::where('teacher_id', $teacher)->where('evaluator_type', 'Student')->where('semester', $sem)->where('acad_year', $year)->get();
                $scoreCoordinator = App\Models\Analytics::where('teacher_id', $teacher)->where('evaluator_type', 'Coordinator')->where('semester', $sem)->where('acad_year', $year)->get();
              
                if($scoreStudent->count()===0 || $scoreCoordinator->count()===0){
                    return 0;
                }else{
                  $studentScore=($scoreStudent->sum('evaluation_score') / $scoreStudent->count() )/4;
                    $coordinatorScore= ($scoreCoordinator->sum('evaluation_score')/$scoreCoordinator->count())/4;
                    $studentPercent = $studentScore *  $studentWeight;
                    $coordinatorPercent = $coordinatorScore * $coordinatorWeight;
                    $percentage = $studentPercent + $coordinatorPercent;
                

                  return number_format($percentage,2);
                }

            }

     function CurrentAnalytics($teacher){

  $adminWeight = App\Models\Admin::where('admin_type', 'Super Admin')->first();
  $studentWeight = $adminWeight->student_weight;
  $coordinatorWeight= $adminWeight->coordinator_weight;
  $scoreStudent = App\Models\EvaluationResult::where('teacher_id', $teacher)->where('evaluator_type', 'Student')->get();
    $scoreCoordinator = App\Models\EvaluationResult::where('teacher_id', $teacher)->where('evaluator_type', 'Coordinator')->get();
  
    if($scoreStudent->count()===0 || $scoreCoordinator->count()===0){
        return 0;
    }else{
      $studentScore=($scoreStudent->sum('evaluation_score') / $scoreStudent->count() )/4;
        $coordinatorScore= ($scoreCoordinator->sum('evaluation_score')/$scoreCoordinator->count())/4;
        $studentPercent = $studentScore *  $studentWeight;
        $coordinatorPercent = $coordinatorScore * $coordinatorWeight;
        $percentage = $studentPercent + $coordinatorPercent;
     

      return number_format($percentage, 2);
    }

}
            $analyticalTrends = [
    Analytics('1st', '2023-2024', $teacher_id),
    Analytics('2nd', '2023-2024', $teacher_id),
    Analytics('1st', '2024-2025', $teacher_id),
    Analytics('2nd', '2024-2025', $teacher_id),
    Analytics('1st', '2025-2026', $teacher_id),
    Analytics('2nd', '2025-2026', $teacher_id),
    Analytics('1st', '2026-2027', $teacher_id),
    Analytics('2nd', '2026-2027', $teacher_id),
    Analytics('1st', '2027-2028', $teacher_id),
    Analytics('2nd', '2027-2028', $teacher_id),
];

$adminCurrentData = App\Models\Admin::where('admin_type', 'Super Admin')->first();
$currentSem = $adminCurrentData->admin_sem;
$currentYear = $adminCurrentData->admin_sy;
$analyticalTrends[AnalyticIndex($currentSem, $currentYear)]= CurrentAnalytics($teacher_id);

$CurrentIndex = json_encode(AnalyticIndex($currentSem, $currentYear));

            @endphp
            
            <div class="grid gap-6 mb-8 md:grid-cols-2">
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Student Evaluators
                </h4>
                <canvas id="barStudent"></canvas>
             
              </div>
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Coordinator Evaluators
                </h4>
                <canvas id="barCoordinator"></canvas>
             
              </div>
              <div
              class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
            >
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Ranking
              </h4>
            
              <canvas id="ranking"></canvas>
            
              <div
              class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
            >
              <!-- Chart legend -->
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 rounded-full" style="background-color:#ff5a1f "
                ></span>
                <span>Current Teacher</span>
              </div>
             
              
            </div>
            </div>
           
            <div
            class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
          >
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
              Evaluators Population
            </h4>
            <canvas id="pie"></canvas>
            <div
              class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
            >
            
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"
                ></span>
                <span>Student Evaluators</span>
              </div>
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                ></span>
                <span>Coordinator Evaluators</span>
              </div>
            </div>
          </div>
         
  
            </div>
            <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Teacher Performance Trends: Past Years to Present
                </h4>
                <canvas id="barsPerformanceTrend"></canvas>
                <div
                  class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
                >
                  <!-- Chart legend -->
                  <div class="flex items-center">
                    <span
                      class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"
                    ></span>
                    <span>Past</span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                    ></span>
                    <span>Current</span>
                  </div>
                </div>
              </div>
            @php
                $studentArrayQ= json_encode($barStudentQ);
                $coordArrayQ= json_encode($barCoordinatorQ);
                $studentArrayAverage= json_encode($barStudentAverage);
                $coordArrayAverage= json_encode($barCoordAverage);
  
                $teacherArrayList= json_encode($teachersArray);
                $teacherArrayAverage= json_encode($teachersArrayScore);
                $teacherArrayNamess = json_encode($teacherArrayName);
  
                $countPopStudent= json_encode($populationS);
                $countPopCoord= json_encode($populationC);
                $trendsAnalysis = json_encode($analyticalTrends);
            @endphp
          @else
          @php
                 $studentArrayQ= json_encode('');
                $coordArrayQ= json_encode('');
                $studentArrayAverage= json_encode('');
                $coordArrayAverage= json_encode('');
  
                $teacherArrayList= json_encode('');
                $teacherArrayAverage= json_encode('');
                $teacherArrayNamess = json_encode('');
  
                $countPopStudent= json_encode('');
                $countPopCoord= json_encode('');
                $trendsAnalysis = json_encode('');
          @endphp
          
          @endif
  
              <h4
                class="mb-4 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
              >
                Students Scores <span style="float: right; cursor:pointer;" class="underline" onclick="gotoStudentList()"> View Student's Score List</span>
              </h4>
              <!-- CTA -->
          
              <!-- Big section cards -->
              <h4
                class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
              >
              </h4>
       
           @php
           $checkStudent= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher_id)->get();
           $checkCoordinator= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher_id)->get();

         
           @endphp
  
           @if($checkStudent->count()>0)
              <div id="teacher" style="display: block;" class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="w-full ">
                    <thead>
                      <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                      >
                      <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Questions(Teacher Actions)</th>
                        <th class="px-4 py-3">Average Score</th>
                        <th class="px-4 py-3">Frequency Distribution</th>
  
                      </tr>
                    </thead>
                    <tbody
                      class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                   
                    @php
                        $studentQuestions = App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
                        $studentSuffix =1;
                        $studentGraphFrequencyDistribution = [];
                        $studentFrequencyDistribution=[];
                    @endphp
                    @foreach ($studentQuestions as $question)
                    <tr
                    class="text-gray-700 dark:text-gray-400"
                  >
                   <td class="px-4 py-3 font-semibold text-sm">
                        S{{$studentSuffix}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{$question->question_content}}
                      </td>
                      @php
                          $avgScoreStudent = App\Models\EvaluationResult::where('evaluator_type', 'Student')
                          ->where('teacher_id', $teacher_id)->where('question_id', $question->id)->get();
                      @endphp
                      <td class="px-4 py-3 text-sm">
                          @php
                          if($avgScoreStudent->sum('evaluation_score') ===0 ||  $avgScoreStudent->count()){
                          $finalScoreStudent=0;
                          }else{
                           $finalScoreStudent=$avgScoreStudent->sum('evaluation_score') / $avgScoreStudent->count();
                          }
                          
                          @endphp
                        {{number_format($finalScoreStudent, 2)}}
                      </td>
                      @php
                          for ($i=0; $i < 5; $i++) { 
                            $avgScoreStudent = App\Models\EvaluationResult::where('evaluator_type', 'Student')
                          ->where('teacher_id', $teacher_id)->where('question_id', $question->id)->where('evaluation_score', $i)->get();
                           if($avgScoreStudent->isNotEmpty()){
                            array_push( $studentFrequencyDistribution, $avgScoreStudent->count() );
                           }else{
                            array_push( $studentFrequencyDistribution,0 );
                           }
                          
                          }
                      @endphp
                      <td class="px-4 py-3 text-sm">
                        <canvas id="studentIndivGraph{{$studentSuffix}}"></canvas>
                      </td>
                    </tr>
                    @php
                        $studentSuffix++;
                        array_push($studentGraphFrequencyDistribution, $studentFrequencyDistribution);
                        $studentFrequencyDistribution=[];
                    @endphp
                    @endforeach
                 
                    
                  
                    
                    </tbody>
                  </table>
                </div>
              </div>
          @else
          <h4
          class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
        >
        No Student Evaluation Result
        </h4>
  @php
      $studentGraphFrequencyDistribution = [0,0,0,0,0];  
  @endphp
          @endif
              <br><br>
              @if($checkCoordinator->count()>0)
              <h4
                class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
              >
                View Result of Coordinator Evaluators <span style="float: right; cursor:pointer;" class="underline" onclick="gotoCoordinatorList()"> View Coordinator's Score List</span>
              </h4>
              <div id="student" style="display:block;" class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="w-full">
                    <thead>
                      <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                      >
                      <th class="px-4 py-3">#</th>
                      <th class="px-4 py-3">Questions(Student Learning Actions)</th>
                      <th class="px-4 py-3">Average Score</th>
                      <th class="px-4 py-3">Frequency Distribution</th>
                      </tr>
                      <tbody>
                        @php
                        $coordinatorQuestions = App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
                        $coordinatorSuffix =1;
                        $coordinatorGraphFrequencyDistribution = [];
                        $coordinatorFrequencyDistribution=[];
                    @endphp
                    @foreach ($coordinatorQuestions as $question)
                    <tr
                    class="text-gray-700 dark:text-gray-400"
                  >
                   <td class="px-4 py-3 font-semibold text-sm">
                        C{{$coordinatorSuffix}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{$question->question_content}}
                      </td>
                      @php
                          $avgScoreStudent = App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')
                          ->where('teacher_id', $teacher_id)->where('question_id', $question->id)->get();
                      @endphp
                      <td class="px-4 py-3 text-sm">
                        {{number_format($avgScoreStudent->sum('evaluation_score') / $avgScoreStudent->count(), 2)}}
                      </td>
                      @php
                          for ($i=0; $i < 5; $i++) { 
                            $avgScoreCoordinator = App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')
                          ->where('teacher_id', $teacher_id)->where('question_id', $question->id)->where('evaluation_score', $i)->get();
                           if($avgScoreCoordinator->isNotEmpty()){
                            array_push( $coordinatorFrequencyDistribution, $avgScoreCoordinator->count() );
                           }else{
                            array_push( $coordinatorFrequencyDistribution,0 );
                           }
                          
                          }
                      @endphp
                      <td class="px-4 py-3 text-sm">
                        <canvas id="coordinatorIndivGraph{{$coordinatorSuffix}}"></canvas>
                      </td>
                    </tr>
                    @php
                        $coordinatorSuffix++;
                        array_push($coordinatorGraphFrequencyDistribution, $coordinatorFrequencyDistribution);
                        $coordinatorFrequencyDistribution=[];
                    @endphp
                    @endforeach
                 
                    
                    </tbody>
                  </table>
                </div>
              </div>
              @else
              <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
             No Coordinator Evaluation Result
            </h4>
            @php
                 $coordinatorGraphFrequencyDistribution=[0,0,0,0,0];
            @endphp
            @endif
         
            @php
                $studentFrequencyDistribution = json_encode($studentGraphFrequencyDistribution);
                $coordinatorFrequencyDistribution = json_encode($coordinatorGraphFrequencyDistribution);
            @endphp
            <script>
              
              window.onload = function() {
                const studentArray={!! $studentArrayQ !!};
                const coordArray= {!! $coordArrayQ !!};
                const studentAverage= {!! $studentArrayAverage !!};
                const coordAverage= {!! $coordArrayAverage !!}
  
                const teacherList= {!! $teacherArrayList !!};
                const teacherAverage= {!! $teacherArrayAverage !!};
                console.log(teacherAverage);
                const currentTeacher= {!! $teacherArrayNamess !!};
  
                const populationS= {!! $countPopStudent !!};
                const populationC= {!! $countPopCoord !!};

                const studentFrequencyDistribution ={!! $studentFrequencyDistribution !!};
                const coordinatorFrequencyDistribution ={!! $coordinatorFrequencyDistribution !!};
  
                const analyticalTrends ={!! $trendsAnalysis !!};
                const currentIndex = {!! $CurrentIndex !!};

                student(studentArray, studentAverage);
                coordinator(coordArray, coordAverage);
                ranking(teacherList, teacherAverage, currentTeacher);
  
                population(populationS, populationC);
                studentFrequencyDistributionGraph(studentFrequencyDistribution);
                coordinatorFrequencyDistributionGraph(coordinatorFrequencyDistribution);

                TeacherPerformanceTrend(analyticalTrends, currentIndex);
              }
          </script>
      
            </div>


            <div id="studentDataList" style="display: none">
              <h4
              class="mb-4 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              View Result of Student Evaluators  <span style="float: right; cursor:pointer;" class="underline" onclick="gotoDashboard()"> Back to Dashboard</span>
            </h4>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
            </h4>
     
         @php
         $checkStudent= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher_id)->get();
      
         @endphp

         @if($checkStudent->count()>0)
            <div id="teacher" style="display: block;" class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Student LRN</th>
                      @php
                      $questions1= App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
                      $t=1;
                      @endphp
                      @foreach($questions1 as $question)
                      <th class="px-4 py-3"><button onclick="openTheModal('Teacher Actions Question No.(S{{$t}})', '{{$question->question_content}}')">S{{$t}}</button></th>
                      @php $t++; @endphp
                      @endforeach
                      <th class="px-4 py-3">Remarks</th>

                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

                  @php
                   $evaluations= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher_id)->distinct()->pluck('evaluator_id');
                   $finalAverage=0;
                   $count=0;
                  @endphp
                  @foreach($evaluations as $evaluation)
                  <tr onclick="nextStudent('{{$evaluation}}', '{{$teacher_id}}')" class="text-gray-700 dark:text-gray-400 scores"><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">
                  {{App\Models\Student::where('id', $evaluation)->first()->student_id}}  
                  </p></div></div></td>
                  
                    @foreach($questions1 as $question)
                    @php
                  $score= App\Models\EvaluationResult::where('evaluator_id', $evaluation)->where('question_id', $question->id)->where('teacher_id', $teacher_id)->first();
                  @endphp
                    <td class="px-4 py-3 text-sm">
                    {{$score->evaluation_score}}
                    </td>
                    @endforeach
                    <td class="px-4 py-3 text-sm">
                      {{App\Models\EvaluationResult::where('evaluator_type','Student')->where('evaluator_id', $evaluation)->where('teacher_id', $teacher_id)->first()->evaluation_remarks}}
                      </td>
                      <script>
                        function nextStudent(evaluator_id, teacher_id){
                       
                          window.location.href= "{{route('data')}}?evaluator_id="+ evaluator_id + "&teacher_id="+teacher_id+ "&type=Student";
                        }
                      </script>
                  @endforeach
                
                  <tr style="background-color:#d3d3d3 ;" class="text-gray-700 "><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">Total Scores</p></div></div></td>
                    @foreach($questions1 as $question)
                   @php
                   $score= App\Models\EvaluationResult::where('question_id', $question->id)->where('teacher_id', $teacher_id)->where('evaluator_type','Student')->get();
                   $totalScore= $score->sum('evaluation_score');
                   $totalRows= $score->count('evaluation_score');
                   if($totalScore===0 && $totalRows===0){
                    $average=0;
                   }else{
                    $average= $totalScore/$totalRows;
                   }

                   $finalAverage+=$average;
                   $count++;
                   @endphp
                   <td class="px-4 py-3 text-sm">
                   {{number_format($average,2)}}
                   </td>
                   @endforeach
                   <td class="px-4 py-3 text-sm">
                    @php $formatAverage= $finalAverage/$count @endphp
                   Total Average: {{number_format($formatAverage, 2)}}
                    </td>
                  </tr>
              
                  

                  
                  </tbody>
                </table>
              </div>
            </div>
        @else
        <h4
        class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
      >
      No Student Evaluation Result
      </h4>

        @endif
              
            </div>


            <div id="coordinatorDataList" style="display: none">
              @php
                     $checkCoordinator= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher_id)->get();
              @endphp
              @if($checkCoordinator->count()>0)
              <h4
                class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
              >
                View Result of Coordinator Evaluators <span style="float: right; cursor:pointer;" class="underline" onclick="gotoDashboard()"> Back to Dashboard</span>
              </h4>
              <div id="student" style="display:block;" class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="w-full whitespace-no-wrap">
                    <thead>
                      <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                      >
                        <th class="px-4 py-3">Coordinator</th>
                        @php
                        $questions2= App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
                        $s=1;
                        @endphp
                        @foreach($questions2 as $question)
                        <th class="px-4 py-3"><button onclick="openTheModal('Teacher Actions Question No.(C{{$s}})', '{{$question->question_content}}')">C{{$s}}</button></th>
                        @php $s++; @endphp
                        @endforeach
                        <th class="px-4 py-3">Remarks</th>
  
                      </tr>
                      <tbody>
                        @php
                     $evaluationsCoordinator= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher_id)->distinct()->pluck('evaluator_id');
                     $finalAverageCoordinator=0;
                     $countCoordinator=0;
                    @endphp
                     @foreach($evaluationsCoordinator as $evaluation)
                     <tr onclick="next('{{$evaluation}}', '{{$teacher_id}}')" class="text-gray-700 dark:text-gray-400 scores"><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">
                     {{App\Models\Coordinator::where('id', $evaluation)->first()->coordinator_position}}  
                     </p></div></div></td>
                     
                       @foreach($questions2 as $question)
                       @php
                     $score= App\Models\EvaluationResult::where('evaluator_id', $evaluation)->where('question_id', $question->id)->where('teacher_id', $teacher_id)->first();
                     @endphp
                       <td class="px-4 py-3 text-sm">
                       {{$score->evaluation_score}}
                       </td>
                       @endforeach
                       <td class="px-4 py-3 text-sm">
                         {{App\Models\EvaluationResult::where('evaluator_type','Coordinator')->where('evaluator_id', $evaluation)->where('teacher_id', $teacher_id)->first()->evaluation_remarks}}
                         </td>
                         <script>
                          function next(evaluator_id, teacher_id){
                         
                            window.location.href= "{{route('data')}}?evaluator_id="+ evaluator_id + "&teacher_id="+teacher_id+ "&type=Coordinator";
                          }
                        </script>
                     @endforeach
                 
                     <tr style="background-color:#d3d3d3 ;" class="text-gray-700 "><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">Total Scores</p></div></div></td>
                       @foreach($questions2 as $question)
                      @php
                      $score2= App\Models\EvaluationResult::where('question_id', $question->id)->where('teacher_id', $teacher_id)->where('evaluator_type','Coordinator')->get();
                      $totalScore2= $score2->sum('evaluation_score');
                      $totalRows2= $score2->count('evaluation_score');
                      if($totalScore2===0 && $totalRows2===0){
                       $average2=0;
                      }else{
                       $average2= $totalScore2/$totalRows2;
                      }
   
                      $finalAverageCoordinator+=$average2;
                      $countCoordinator++;
                      @endphp
                      <td class="px-4 py-3 text-sm">
                      {{number_format($average2, 2)}}
                      </td>
                      @endforeach
                      <td class="px-4 py-3 text-sm">
                       @php $formatAverage2= $finalAverageCoordinator/$countCoordinator @endphp
                      Total Average: {{number_format($formatAverage2, 2)}}
                       </td>
                     </tr>
                 
                    </tbody>
                  </table>
                </div>
              </div>
              @else
              <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
             No Coordinator Evaluation Result
            </h4>
            @endif
              
            </div>

            <script>
              function gotoStudentList(){
                const dashboard = document.getElementById('dashboardData');
                const student =  document.getElementById('studentDataList');
                const coordinator = document.getElementById('coordinatorDataList');

                student.style.display = '';
                coordinator.style.display= 'none';
                dashboard.style.display ='none';
              }
              function gotoCoordinatorList(){
                const dashboard = document.getElementById('dashboardData');
                const student =  document.getElementById('studentDataList');
                const coordinator = document.getElementById('coordinatorDataList');
               
                coordinator.style.display= '';
                student.style.display = 'none';
                dashboard.style.display ='none';
              }

              function gotoDashboard(){
                const dashboard = document.getElementById('dashboardData');
                const student =  document.getElementById('studentDataList');
                const coordinator = document.getElementById('coordinatorDataList');
                
                dashboard.style.display ='';
                coordinator.style.display= 'none';
                student.style.display = 'none';
              
              }
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