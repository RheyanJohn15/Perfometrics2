@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Data-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script src="{{asset('dashboard/js/quote.js')}}"></script>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
  </head>
  <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
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
        
          <a style="text-align: center;"
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
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
             Calculated Data
            </h4>
         
           
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full">
                <table class="w-full ">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Evaluator ID</th>
                      <th class="px-4 py-3">Average</th>
                      <th class="px-4 py-3">Remarks</th>
                      <th class="px-4 py-3">Submitted At</th>
                      <th class="px-4 py-3">Updated At</th>



                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  <tr
                   class="text-gray-700 dark:text-gray-400">
                 @php
                  if($type==="Student"){
                    $userName= App\Models\Student::where('id', $evaluator)->first()->student_id;
                    $questions= App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
                    $score= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('evaluator_id', $evaluator)->where('teacher_id', $teacher_id)->get();
                    $remarks= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('evaluator_id', $evaluator)->where('teacher_id', $teacher_id)->first();
                  $totalScore= $score->sum('evaluation_score');
                  $totalRows= $score->count('evaluation_score');

                  $average= $totalScore/$totalRows;
                  }
                  if($type==="Coordinator"){
                    $coord=App\Models\Coordinator::where('id', $evaluator)->first();
                    $userName= $coord->coordinator_last_name. " ". substr($coord->coordinator_first_name,0, 1). ". ";
                    $questions= App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
                    $score= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('evaluator_id', $evaluator)->where('teacher_id', $teacher_id)->get();
                    $remarks= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('evaluator_id', $evaluator)->where('teacher_id', $teacher_id)->first();
                  $totalScore= $score->sum('evaluation_score');
                  $totalRows= $score->count('evaluation_score');

                  $average= $totalScore/$totalRows;
                  }

             $t=1;
                 @endphp
                  <td class="px-4 py-3 text-sm">{{$userName}}</td>
                  <td class="px-4 py-3 text-sm">{{number_format($average, 3)}}</td>
                  <td class="px-4 py-3 text-sm">{{$remarks->evaluation_remarks}}</td>
                  <td class="px-4 py-3 text-sm">{{$remarks->created_at}}</td>
                  <td class="px-4 py-3 text-sm">{{$remarks->updated_at}}</td>
                    <tr>
                  

                  
                  </tbody>
                </table>
              </div>
            </div>

       
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              View Result of the Evaluator
            </h4>
         
           
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full ">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Question</th>
                      <th class="px-4 py-3">Score</th>
                      <th class="px-4 py-3">Rating</th>
                      <th class="px-4 py-3">Remarks</th>
                  


                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

             @foreach($questions as $question)
             <tr class="text-gray-700 dark:text-gray-400"><td class="px-4 py-3 text-sm">{{$t}}. {{$question->question_content}}</td>
                @php
                if($type==="Student"){
                    $pointsScore= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('evaluator_id', $evaluator)->where('teacher_id', $teacher_id)
                    ->where('question_id', $question->id)->first();
                }
                if($type==="Coordinator"){
                    $pointsScore= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('evaluator_id', $evaluator)->where('teacher_id', $teacher_id)
                    ->where('question_id', $question->id)->first();
                }
                $points= $pointsScore->evaluation_score;

                if ($points >= 4) {
                     $rating= "Performance of this item is innovatively done.";
                 } elseif ($points >= 3) {
                   $rating=  "Performance of this item is satisfactory done.";
                 } elseif ($points >= 2) {
                   $rating=  "Performance of this item is partially due to some omissions.";
                 } elseif ($points >= 1) {
                   $rating=  "Performance of this item is partially done due to serious errors and misconceptions.";
                 } else {
                   $rating=  "Performance of this item is not observed at all.";
                 }
                 
  
                 if ($points >= 4) {
                   $remarks= "Great job! The performance of this item is excellent.";
                   $color= "green";
               } elseif ($points >= 3) {
                   $color= "blue";
                 $remarks= "Keep up the good work! The performance of this item is very good.";
               } elseif ($points >= 2) {
                 $color= "violet";
                 $remarks= "There is room for improvement. The performance of this item is satisfactory.";
               } elseif ($points >= 1) {
                 $color= "orange";
                 $remarks= "Work on addressing the issues. The performance of this item needs improvement.";
               } else {
                 $color="red";
                 $remarks= "Significant improvements are required. The performance of this item is inadequate.";
               }

                @endphp

                
<td class="px-4 py-3 text-sm">{{$points}}</td>
<td class="px-4 py-3 text-sm">{{$rating}}</td>
<td style= "color:{{$color}};" class="px-4 py-3 text-sm">{{$remarks}}</td>
</tr>

                @php $t++; @endphp
             @endforeach
               

                  
                  </tbody>
                </table>
              </div>
            </div>
         
            <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                  Conclusion
                </h4>
                <p class="text-gray-600 dark:text-gray-400">
                    @if($average===4)
                    The Resulting Average Score given by the Evaluator is 4. Therefore the Evaluator thinks that this teacher is  is performing exceptionally well in the evaluated areas. Therefore, the teacher should continue their current practices and maintain the high level of performance.
                    @elseif($average>=3 && $average<4)
                    The Resulting Average Score given by the Evaluator is {{number_format($average, 3)}}. Therefore the Evaluator thinks that this teacher  is performing satisfactorily with some room for improvement. The teacher should focus on building upon their strengths and addressing any minor areas for enhancement.
                    @elseif($average>=2 && $average<3)
                    The Resulting Average Score given by the Evaluator is {{number_format($average, 3)}}. Therefore the Evaluator thinks that this teacher's performance has some shortcomings and areas that require attention. The teacher should identify and address these areas to enhance their overall performance.
                    @elseif($average>=1 && $average<2)
                    The Resulting Average Score given by the  Evaluator is {{number_format($average, 3)}}. Therefore the Evaluator thinks that this teacher's performance has significant issues and misconceptions. The teacher should prioritize understanding and rectifying these issues to improve their teaching effectiveness.
                    @else
                    The Resulting Average Score given by the  Evaluator is {{number_format($average, 3)}}. Therefore the Evaluator thinks that this teacher's performance is severely lacking, with numerous serious errors and misconceptions. The teacher must undertake comprehensive efforts to improve their teaching skills and knowledge.
                    @endif
             
                </p>
              </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
@else
 @include('administrator.unauthorized')
@endif