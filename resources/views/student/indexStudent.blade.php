@if (session()->has('user_id') && session('user_type')==="Student")
@php
$image= App\Models\Student::where('id', session('user_id'))->first();

if($image->student_image===1){
    $profilePic= asset('Users/Student('. session('user_id'). ").". $image->student_image_type);
}else{
    $profilePic= asset('Users/ph.jpg');
}
if($image->student_suffix==="none"){
  $studentFinalSuffix='';
}else{
  $studentFinalSuffix=$image->student_suffix;
}
$student_username= $image->student_first_name . " ". substr($image->student_middle_name, 0,1).". ". $image->student_last_name. " ". $studentFinalSuffix;
@endphp
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Student- {{$student_username}} </title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
  <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
  <link rel="stylesheet" href="{{asset('dashboard/css/mycss.css')}}" />
  <link rel="stylesheet" href="{{asset('dashboard/css/profile.css')}}" />
  <link rel="stylesheet" href="{{asset('dashboard/css/new.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
     <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
     <script src="{{asset('dashboard/js/new.js')}}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="./assets/js/charts-pie.js" defer></script>
   
  
  </head>
  <link rel="icon" href="{{asset('images/icon.png')}}">


  <style>
    @keyframes slideCloseMorning {
      0%{
       height: 53vh;
      }
      100%{
        height: 0vh;
      }
    }
    @keyframes slideOpenMorning {
      0%{
       height: 0vh;
      }
      100%{
        height: 40vh;
      }
    }

    @keyframes slideCloseAfternoon {
      0%{
       height: 40vh;
      }
      100%{
        height: 0vh;
      }
    }
    @keyframes slideOpenAfternoon {
      0%{
       height: 0vh;
      }
      100%{
        height: 53vh;
      }
    }
  </style>
  <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  <body>
   
  

    @if($image->student_status ===0)
    @include('student/newUser', ['student_id'=>$image->id, 'name'=> $image->student_first_name])
    @else
    <div id="completeModal" class="MainModal">
      <div class="contentModal">
      <i style="font-size:40px; color:#7e3af2;" class="fa-solid fa-circle-check fa-bounce"></i>
      <p  class="ml-6 text-lg font-bold text-gray-800">Evaluation Complete</p>
      </div>
    </div>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain">  <div class="profileImage" style="background-image:url('{{$profilePic}}')"></div></div>
          <a style="text-align: center;"
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
        {{$student_username}}
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('student_dashboard')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                @php
                    $deployedStatus= App\Models\Admin::where('admin_type', 'Super Admin')->first();
                @endphp
                @if ($deployedStatus->admin_evaluation_status===1)
                <span class="ml-4">Evaluate Teacher</span>
                @else
                <span class="ml-4"><s> Evaluate Teacher</s>(Closed)</span>
                @endif
              
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('scheduleToday')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM12,20c-4.42,0 -8,-3.58 -8,-8s3.58,-8 8,-8 8,3.58 8,8 -3.58,8 -8,8z"
                  ></path>
                  <path
                  d="M12.5,7H11v6l5.25,3.15 0.75,-1.23 -4.5,-2.67z"
                ></path>
                </svg>
                <span class="ml-4">Class Schedule({{date('l')}})</span>
              </a>
            </li>
           
             <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('scheduleOverall')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM15.29,16.71L11,12.41V7h2v4.59l3.71,3.71L15.29,16.71z"
                  ></path>
                </svg>
                <span class="ml-4">Class Schedule(Overall)</span>
              </a>
            </li>
          
              <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('summary')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Evaluation History</span>
              </a>
            </li>
          </ul>
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
            <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain">  <div class="profileImage" style="background-image:url('{{$profilePic}}')"></div></div>
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
        {{$student_username}}
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('student_dashboard')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                @php
                $deployedStatus= App\Models\Admin::where('admin_type', 'Super Admin')->first();
            @endphp
            @if ($deployedStatus->admin_evaluation_status===1)
            <span class="ml-4">Evaluate Teacher</span>
            @else
            <span class="ml-4"><s> Evaluate Teacher</s>(Closed)</span>
            @endif
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('scheduleToday')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                <path
                d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM12,20c-4.42,0 -8,-3.58 -8,-8s3.58,-8 8,-8 8,3.58 8,8 -3.58,8 -8,8z"
              ></path>
              <path
              d="M12.5,7H11v6l5.25,3.15 0.75,-1.23 -4.5,-2.67z"
            ></path>
                </svg>
                <span class="ml-4">Class Schedule({{date('l')}})</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('scheduleOverall')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                <path
                    d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM15.29,16.71L11,12.41V7h2v4.59l3.71,3.71L15.29,16.71z"
                  ></path>
                </svg>
                <span class="ml-4">Class Schedule(Overall)</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('summary')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                <path
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
              ></path>
                </svg>
                <span class="ml-4">Evaluation History</span>
              </a>
            </li>
          </ul>
         
        </div>
      </aside>
      <div class="flex flex-col flex-1 w-full">
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
                        href="{{route('studentProfile')}}"
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
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
<div class="containLogo">
<div class="contLogo">
  <img class="logo" src="{{asset('images/logo.jfif')}}" alt="Logo">
</div>
<div class="headerLogo">
  <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Republic Of the Philippines</h3>
  <h3 class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Notre Dame of Talisay</h3>
  <h1 class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Carmela Valley Homes, Talisay City, Negros Occidental</h1>
</div>
</div>
<div class="personalDetails">
@php
$student= App\Models\Student::where('id', session('user_id'))->first();
$section_id=App\Models\Section::where('id', $student->student_section)->first();
$section= $section_id->section;
$class= $student->student_year_level. " - ". $section;
$strand= App\Models\Strand::where('id',$student->student_strand)->first()->strand_name;
@endphp
 <p class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Evaluator: {{session('user_name')}}</p> 
 <p class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Grade Level: {{$class}}</p> 
 <p class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Strand: {{$strand}}</p> 
</div>

            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Questions
            </h2>
            <!-- CTA -->
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <h5
              class="text-gray-700 dark:text-gray-200"
            >
             Rating Scale
            </h5>
            <p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
    4 - Performance of this item is innovatively done.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
  3 - Performance of this item is satisfactory done.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
 2 - Performance of this item is partially due to some omissions.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
 1 - Performance of this item is partially done due to serious errors and misconceptions.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
 0 - Performance of this item is not observe at all.
</p>


            </div>






            <button   @click="openModal" id="buttonForTeacherSelected"
                  class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
               
             Start Evaluating
                
                </button>
<br>
          
          <form method="post" id="evaluationSubmit" >
         @csrf
         @method('post')
         @if ($deployedStatus->admin_evaluation_status===1)
         <div id="CheckedEvaluation" style="display: none">
          <h2 style="text-align: center"
          class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
        You've Already Evaluated this teacher Please choose another one!
        </h2>
        <h2 style="text-align: center; font-size:100px"
        class="my-6  font-semibold text-gray-700 dark:text-gray-200"
      >
      <i class="fa-solid fa-face-frown"></i>
      </h2>
         </div>
         <div style="display:none" id="wholeForm">
          <div id="teacher" class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full ">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                  >
                    <th class="px-4 py-3">TEACHER ACTIONS</th>
                    <th class="px-4 py-3">4</th>
                    <th class="px-4 py-3">3</th>
                    <th class="px-4 py-3">2</th>
                    <th class="px-4 py-3">1</th>
                    <th class="px-4 py-3">0</th>
                  </tr>
                </thead>
                <tbody
                  class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                @php
                $questions= App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
                $t=1;
                @endphp
                @foreach($questions as $question)
                <input type="hidden" name="ques{{$t}}" value="{{$question->id}}">
                <tr class="text-gray-700 dark:text-gray-400"><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">{{$t}}. {{$question->question_content}}</p>
                  </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="customRadio text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="4"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="customRadio text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="3"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="customRadio text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="2"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="customRadio text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="1"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="customRadio text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="0"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td></tr>

                      @php
                        $t++;
                      @endphp
                @endforeach
              
                 

                </tbody>
              </table>
            </div>
            <input type="hidden" name="teacher_id" id="teacherSelectedId" value="">
            <input type="hidden" name="student_id" value="{{session('user_id')}}">
          </div>
           <!-- New Table -->
           <br>
         
  
           <label class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Comment/Remarks(Type NA if None)</span>
              <textarea
              required
              id="message"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3"
                name="remarks"
                placeholder="Remarks."
              ></textarea>
            </label><span class="text-gray-700 dark:text-gray-400" style="float: right;" id="character">0/255 Characters</span><br>
            <button
            name="submit" type="submit"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
             Submit Evaluation
              </button>
          </div>
              
         @else
         <h2 style="text-align: center"
         class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
       >
         Sorry Evaluation Form is Currently Closed
       </h2>
       <h2 style="text-align: center; font-size:100px"
       class="my-6  font-semibold text-gray-700 dark:text-gray-200"
     >
     <i class="fa-solid fa-face-frown"></i>
     </h2>
         @endif
        
             </form>
             <script>
                var message= document.getElementById("message");
  var character = document.getElementById("character");

  message.addEventListener('input', function(){
  
    var text= message.value;
    var remaining= 255 - text.length;

    if(remaining>=0){
        character.textContent= text.length +'/255 Characters';
    }else{
       message.value= text.slice(0,255);
       character.textContent= '255/255 Characters';
    }
    
  });

 


            

                </script>

<script>
  $(document).ready(function() {
      $('form#evaluationSubmit').submit(function(event) {
          event.preventDefault(); // Prevent the form from submitting traditionally
          
          var formData = $(this).serialize(); // Serialize the form data
          
          $.ajax({
              type: 'POST',
              url: '{{ route('submitEvaluation') }}', // Set the route to handle the form submission
              data: formData,
              success: function(response) {
                Swal.fire({
    title: 'Done',
    text: 'Evaluation submitted successfully!',
    icon: 'success',
    confirmButtonText: 'Evaluate Again',
    allowOutsideClick: false,
  }).then((result) => {
    // Optionally, you can perform additional actions after the user clicks 'OK'.
    // For example, you can redirect the user to another page or reload the current page.
    if (result.isConfirmed) {
     location.reload();
    }
  });
              },
              error: function(xhr) {
                  console.log(xhr.responseText);
              }
          });
      });
  });
</script>

                <br>
                <div
                x-show="isModalOpen"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
              >
                <!-- Modal -->
                <div
                  x-show="isModalOpen"
                  x-transition:enter="transition ease-out duration-150"
                  x-transition:enter-start="opacity-0 transform translate-y-1/2"
                  x-transition:enter-end="opacity-100"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100"
                  x-transition:leave-end="opacity-0  transform translate-y-1/2"
                  @click.away="closeModal"
                  @keydown.escape="closeModal"
                  class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                  role="dialog"
                  id="modal"
                >
                  <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                  <header class="flex justify-end">
                    <button
                      class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                      aria-label="close"
                      @click="closeModal"
                    >
                      <svg
                        class="w-4 h-4"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        role="img"
                        aria-hidden="true"
                      >
                        <path
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                          fill-rule="evenodd"
                        ></path>
                      </svg>
                    </button>
                  </header>
                  <!-- Modal body -->
                  <div class="mt-4 mb-6 overflow-y-auto modalDiv">
                    <!-- Modal title -->
                    <p
                      class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
                    >
                    Select Teacher to Evaluate
                    </p>
                    @php
                      $assignedTeachers= App\Models\AssignedTeacher::where('section_id', $student->student_section)->get();
                    @endphp
                  @if ($assignedTeachers->isNotEmpty())
                  @foreach($assignedTeachers as $assigned)
                  <label
                  class="inline-flex items-center text-gray-600 dark:text-gray-400"
                >
                  <input
                    type="radio"
                    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="teacherSelected"
                    value="{{$assigned->teacher_id}}"
                  />
                  @php
                    $teacher= App\Models\Teacher::where('id', $assigned->teacher_id)->first();
                    $subject= App\Models\AssignedSubject::where('id', $assigned->subject_id)->first();
                    if($teacher->teacher_suffix==="none"){
                      $teachSuffix=" ";
                    }else{
                      $teachSuffix= $teacher->teacher_suffix;
                    }
                    $teacherFullName= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). " ". $teacher->teacher_last_name. " ".$teachSuffix;
                    $subjectName= $subject->assigned_subject;

                    $evaluated= App\Models\EvaluationResult::where('evaluator_id', session('user_id'))->where('evaluator_type', 'Student')
                    ->where('teacher_id', $assigned->teacher_id)->count();
                  @endphp
                  <span id="teacherStrings" class="ml-2"><strong>{{$teacherFullName}} </strong> <span style="display: {{$evaluated>0? "inline":"none"}}" >(<i class="fa-solid fa-person-circle-check" style="color: #7e3af2"></i>)</span><br> <em id="subjectItalize">({{$subjectName}})</em></span>
                </label><br><hr>
            
  
          @endforeach
          @else
          <div class="w-full text-center">
            <i class="fa-regular fa-face-sad-tear mt-8" style="font-size:8rem; color:gray; opacity:0.6"></i>
            <p class="mt-4 text-base" style="opacity: 0.6">No Assigned Teacher</p>
          </div>
                  @endif
                </div>

                @if ($assignedTeachers->isNotEmpty())
                <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
              >
                <button
                  @click="closeModal"
                  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                >
                  Cancel
                </button>
                <button
                   id="selectButton" @click="closeModal" onclick="CheckEvaluation()"
                  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Select
                </button>
             
              </footer>
                @endif
               
                
                </div>
              </div>
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var selectButton = document.querySelector("#selectButton");
                    var teacherSelectedId = document.querySelector("#teacherSelectedId");
                    var teacherStrings = document.querySelector("#teacherStrings");
                    var buttonForSelectedTeacher = document.querySelector("#buttonForTeacherSelected");
                    selectButton.addEventListener("click", function() {
                        var selectedTeacherId = document.querySelector('input[name="teacherSelected"]:checked').value;
                        var selectedTeacherFullName = document.querySelector('input[name="teacherSelected"]:checked').nextElementSibling.querySelector("strong").textContent;
                        var selectedSubjectName = document.querySelector('input[name="teacherSelected"]:checked').nextElementSibling.querySelector("em").textContent;
                        teacherSelectedId.value = selectedTeacherId;
                        var strongElement = document.createElement("strong");
            strongElement.textContent = selectedTeacherFullName;

            var iElement = document.createElement("em");
            iElement.textContent = selectedSubjectName;

            // Clear the content and append the elements to the buttonForSelectedTeacher
            buttonForSelectedTeacher.innerHTML = ""; // Clear existing content
            buttonForSelectedTeacher.appendChild(document.createTextNode("Currently Evaluating: "));
            buttonForSelectedTeacher.appendChild(strongElement);
    
            buttonForSelectedTeacher.appendChild(iElement);

            document.getElementById('wholeForm').style.display="";
                    });
                });

                function CheckEvaluation() {
                  var radioButtons = document.getElementsByName('teacherSelected');
    var selectedValue = null;
    

    for (var i = 0; i < radioButtons.length; i++) {
      if (radioButtons[i].checked) {
        selectedValue = radioButtons[i].value;
        break;
      }
    }

    if (selectedValue !== null) {
      axios.get("{{route('evaluationCheck')}}?teacher="+selectedValue+"&student_id={{session('user_id')}}&type=Student")
        .then(function (response) {
          const check = document.getElementById('CheckedEvaluation');
          const form = document.getElementById('wholeForm');
          if(response.data.result ===1){
            check.style.display='';
            form.style.display='none';
          }else{
            check.style.display='none';
            form.style.display='';
          }
        
        })
        .catch(function (error) {
          // Handle any errors that occurred during the request
          console.error('Error:', error);
        });
    } else {
      console.log('No option selected');
    }

      
    }
            </script>
          </div>
        </main>
      </div>
    </div>
    @endif
  </body>
</html>
@else
 @include('administrator.unauthorized')
@endif