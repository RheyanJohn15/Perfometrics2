@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Administrator - Class Schedule</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script src="{{asset('dashboard/js/quote.js')}}"></script>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
    <script src="{{asset('js/click.js')}}"></script>
    
  </head>
  <style>
    .td{
      cursor: pointer;
    }
    td{
      text-align: center;
    }
    th{
      text-align: center;
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
    @if(session('selectedStrand')!="Null")
   @include('administrator/scheduleModals')
    @endif
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="{{route('classSchedule')}}"
          ><span style="text-align: center; font-size:15px">
       {{$admin_username}}
         </span> </a>
        @include('administrator/desktop_nav', ['location'=>'classSched'])
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
            href="{{route('classSchedule')}}"
          ><span style="text-align: center; font-size:15px">
         {{$admin_username}}
          </span></a>
          @include('administrator/mobile_nav', ['location'=>'classSched'])
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
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
          
         <div class="tooltip"><i class="fa-solid fa-circle-info text-2xl font-semibold text-gray-700 dark:text-gray-200""></i> <span class="tooltip-text">Click the text below Class Schedule to select the desire Class</span></div>
          <div class="headerLogo">
          <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Class Schedule</h3>
          </div>
          <div  @click="openModal" class="headerLogo selectStrand">
          <h3 id="selectedStrand" class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">
            @if(session('selectedStrand')==="Null")
            ~~~No Class Selected~~~
            @else
            @php 
            $sectionTitle= App\Models\Section::where('id', session('selectedStrand'))->first();
            $strandTitle= App\Models\Strand::where('id', $sectionTitle->strand_id)->first();
            @endphp
           ({{$strandTitle->strand_shortcut}}) {{$sectionTitle->year_level}} - {{$sectionTitle->section}}
            @endif
          </h3>
          
           <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
          </div>
          @if(session('selectedStrand')!="Null")
          <div class="w-full mb-8 mt-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th style="width: 5%" class="px-4 py-3">Timestamps</th>
                      <th style="width: 19%" class="px-4 py-3">Monday</th>
                      <th style="width: 19%" class="px-4 py-3">Tuesday</th>
                      <th style="width: 19%" class="px-4 py-3">Wednesday</th>
                      <th style="width: 19%"class="px-4 py-3">Thursday</th>
                      <th style="width: 19%" class="px-4 py-3">Friday</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    7:30AM - 8:30AM
                    </td>
                      
                    <td onclick="monday1(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','7:30AM - 8:30AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="tuesday1(this)" class="px-4 py-3 text-sm td">
                      @if(empty(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','7:30AM - 8:30AM')!!}
                      @endif
                    
                    </td>
                  
                    <td onclick="wednesday1(this)" class="px-4 py-3 text-sm td">
                      @if(empty(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','7:30AM - 8:30AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday1(this)" class="px-4 py-3 text-sm td">
                      @if(empty(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','7:30AM - 8:30AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday1(this)" class="px-4 py-3 text-sm td">
                      @if(empty(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','7:30AM - 8:30AM')!!}
                      @endif
                    
                    </td>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    8:30AM - 9:30AM
                    </td>
                    <td onclick="monday2(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','8:30AM - 9:30AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="tuesday2(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','8:30AM - 9:30AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="wednesday2(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','8:30AM - 9:30AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday2(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','8:30AM - 9:30AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday2(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','8:30AM - 9:30AM')!!}
                      @endif
                    
                    </td>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    9:30AM - 9:45AM
                    </td>
                    <td colspan="5" style="text-align:center; font-weight:bold;" class="px-4 py-3 text-sm">
                    RECESS
                    </td>
                    
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    9:45AM - 10:45AM
                    </td>
                    <td onclick="monday3(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','9:45AM - 10:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="tuesday3(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','9:45AM - 10:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="wednesday3(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','9:45AM - 10:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday3(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','9:45AM - 10:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday3(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','9:45AM - 10:45AM')!!}
                      @endif
                    
                    </td>
                  </tr>

                  
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    10:45AM - 11:45AM
                    </td>
                    <td onclick="monday4(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','10:45AM - 11:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="tuesday4(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','10:45AM - 11:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="wednesday4(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','10:45AM - 11:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday4(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','10:45AM - 11:45AM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday4(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','10:45AM - 11:45AM')!!}
                      @endif
                    
                    </td>
                  </tr>

                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    11:45AM - 1:00PM
                    </td>
                    <td colspan="5" style="text-align:center; font-weight:bold;" class="px-4 py-3 text-sm">
                      NOON BREAK
                    </td>
                  </tr>

                  <tr class="text-gray-700 dark:text-gray-400">
                    
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    1:00PM - 2:00PM
                    </td>
                    <td onclick="monday5(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','1:00PM - 2:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="tuesday5(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','1:00PM - 2:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="wednesday5(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','1:00PM - 2:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday5(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','1:00PM - 2:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday5(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','1:00PM - 2:00PM')!!}
                      @endif
                    
                    </td>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    2:00PM - 3:00PM
                    </td>
                    <td onclick="monday6(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','2:00PM - 3:00PM')!!}
                      @endif
                    
                    </td>
                    <td  onclick="tuesday6(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','2:00PM - 3:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="wednesday6(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','2:00PM - 3:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday6(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','2:00PM - 3:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday6(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','2:00PM - 3:00PM')!!}
                      @endif
                    
                    </td>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    3:00PM - 4:00PM
                    </td>
                    <td onclick="monday7(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','3:00PM - 4:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="tuesday7(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','3:00PM - 4:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="wednesday7(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','3:00PM - 4:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday7(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','3:00PM - 4:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday7(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','3:00PM - 4:00PM')!!}
                      @endif
                    
                    </td>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">
                     
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    4:00PM - 5:00PM
                    </td>
                    <td onclick="monday8(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Monday','4:00PM - 5:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="tuesday8(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Tuesday','4:00PM - 5:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="wednesday8(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Wednesday','4:00PM - 5:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="thursday8(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Thursday','4:00PM - 5:00PM')!!}
                      @endif
                    
                    </td>
                    <td onclick="friday8(this)" class="px-4 py-3 text-sm td">
                      @if(is_null(session('selectedStrand')))
                      <p>Not Set</p><p>Click to Select</p>
                      @else
                      {!!OutputSched(session('selectedStrand'), 'Friday','4:00PM - 5:00PM')!!}
                      @endif
                    
                    </td>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td style='font-size:9px' class="px-4 py-3 text-sm">
                    CLASS ENDS
                      </td>
                    <td colspan="5" style="text-align:center; font-weight:bold;" class="px-4 py-3 text-sm">
                        HOME SWEET HOME
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
            <div class="mb-8 ml-8">
              <button  id="return"
                    class="px-4 py-2 text-sm ml-8 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                  >
                  <i class="fa-solid fa-circle-arrow-left"></i> Return
                  </button>
              </div>
            @endif
            
        <script>
          
       var closeMonday1= document.getElementById("monday1");
       var closeMonday2= document.getElementById("monday2");
       var closeMonday3= document.getElementById("monday3");
       var closeMonday4= document.getElementById("monday4");
       var closeMonday5= document.getElementById("monday5");
       var closeMonday6= document.getElementById("monday6");
       var closeMonday7= document.getElementById("monday7");
       var closeMonday8= document.getElementById("monday8");

       var closeTuesday1= document.getElementById("tuesday1");
       var closeTuesday2= document.getElementById("tuesday2");
       var closeTuesday3= document.getElementById("tuesday3");
       var closeTuesday4= document.getElementById("tuesday4");
       var closeTuesday5= document.getElementById("tuesday5");
       var closeTuesday6= document.getElementById("tuesday6");
       var closeTuesday7= document.getElementById("tuesday7");
       var closeTuesday8= document.getElementById("tuesday8");

       var closeWednesday1= document.getElementById("wednesday1");
       var closeWednesday2= document.getElementById("wednesday2");
       var closeWednesday3= document.getElementById("wednesday3");
       var closeWednesday4= document.getElementById("wednesday4");
       var closeWednesday5= document.getElementById("wednesday5");
       var closeWednesday6= document.getElementById("wednesday6");
       var closeWednesday7= document.getElementById("wednesday7");
       var closeWednesday8= document.getElementById("wednesday8");

       var closeThursday1= document.getElementById("thursday1");
       var closeThursday2= document.getElementById("thursday2");
       var closeThursday3= document.getElementById("thursday3");
       var closeThursday4= document.getElementById("thursday4");
       var closeThursday5= document.getElementById("thursday5");
       var closeThursday6= document.getElementById("thursday6");
       var closeThursday7= document.getElementById("thursday7");
       var closeThursday8= document.getElementById("thursday8");

       var closeFriday1= document.getElementById("friday1");
       var closeFriday2= document.getElementById("friday2");
       var closeFriday3= document.getElementById("friday3");
       var closeFriday4= document.getElementById("friday4");
       var closeFriday5= document.getElementById("friday5");
       var closeFriday6= document.getElementById("friday6");
       var closeFriday7= document.getElementById("friday7");
       var closeFriday8= document.getElementById("friday8");

window.addEventListener('click', function(event) {
if (event.target === closeMonday1) {

closeMonday1.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday1.style.display= "none";
}, 300);
}else if (event.target === closeMonday2) {

closeMonday2.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday2.style.display= "none";
}, 300);
}else if (event.target === closeMonday3) {

closeMonday3.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday3.style.display= "none";
}, 300);
}else if (event.target === closeMonday4) {

closeMonday4.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday4.style.display= "none";
}, 300);
}else if (event.target === closeMonday5) {

closeMonday5.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday5.style.display= "none";
}, 300);
}else if (event.target === closeMonday6) {

closeMonday6.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday6.style.display= "none";
}, 300);
}else if (event.target === closeMonday7) {

closeMonday7.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday7.style.display= "none";
}, 300);
}else if (event.target === closeMonday8) {

closeMonday8.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeMonday8.style.display= "none";
}, 300);
}else if (event.target === closeTuesday1) {

closeTuesday1.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday1.style.display= "none";
}, 300);
}else if (event.target === closeTuesday2) {

closeTuesday2.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday2.style.display= "none";
}, 300);
}else if (event.target === closeTuesday3) {

closeTuesday3.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday3.style.display= "none";
}, 300);
}else if (event.target === closeTuesday4) {

closeTuesday4.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday4.style.display= "none";
}, 300);
}else if (event.target === closeTuesday5) {

closeTuesday5.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday5.style.display= "none";
}, 300);
}else if (event.target === closeTuesday6) {

closeTuesday6.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday6.style.display= "none";
}, 300);
}else if (event.target === closeTuesday7) {

closeTuesday7.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday7.style.display= "none";
}, 300);
}else if (event.target === closeTuesday8) {

closeTuesday8.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeTuesday8.style.display= "none";
}, 300);
}else if (event.target === closeWednesday1) {

closeWednesday1.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday1.style.display= "none";
}, 300);
}else if (event.target === closeWednesday2) {

closeWednesday2.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday2.style.display= "none";
}, 300);
}else if (event.target === closeWednesday3) {

closeWednesday3.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday3.style.display= "none";
}, 300);
}else if (event.target === closeWednesday4) {

closeWednesday4.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday4.style.display= "none";
}, 300);
}else if (event.target === closeWednesday5) {

closeWednesday5.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday5.style.display= "none";
}, 300);
}else if (event.target === closeWednesday6) {

closeWednesday6.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday6.style.display= "none";
}, 300);
}else if (event.target === closeWednesday7) {

closeWednesday7.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday7.style.display= "none";
}, 300);
}else if (event.target === closeWednesday8) {

closeWednesday8.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeWednesday8.style.display= "none";
}, 300);
}else if (event.target === closeThursday1) {

closeThursday1.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday1.style.display= "none";
}, 300);
}else if (event.target === closeThursday2) {

closeThursday2.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday2.style.display= "none";
}, 300);
}else if (event.target === closeThursday3) {

closeThursday3.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday3.style.display= "none";
}, 300);
}else if (event.target === closeThursday4) {

closeThursday4.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday4.style.display= "none";
}, 300);
}else if (event.target === closeThursday5) {

closeThursday5.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday5.style.display= "none";
}, 300);
}else if (event.target === closeThursday6) {

closeThursday6.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday6.style.display= "none";
}, 300);
}else if (event.target === closeThursday7) {

closeThursday7.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday7.style.display= "none";
}, 300);
}else if (event.target === closeThursday8) {

closeThursday8.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeThursday8.style.display= "none";
}, 300);
}else if (event.target === closeFriday1) {

closeFriday1.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday1.style.display= "none";
}, 300);
}else if (event.target === closeFriday2) {

closeFriday2.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday2.style.display= "none";
}, 300);
}else if (event.target === closeFriday3) {

closeFriday3.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday3.style.display= "none";
}, 300);
}else if (event.target === closeFriday4) {

closeFriday4.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday4.style.display= "none";
}, 300);
}else if (event.target === closeFriday5) {

closeFriday5.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday5.style.display= "none";
}, 300);
}else if (event.target === closeFriday6) {

closeFriday6.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday6.style.display= "none";
}, 300);
}else if (event.target === closeFriday7) {

closeFriday7.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday7.style.display= "none";
}, 300);
}else if (event.target === closeFriday8) {

closeFriday8.style.animation= "questionClose 0.3s linear";

setTimeout(function() {
closeFriday8.style.display= "none";
}, 300);
}
});



var returnToView= document.getElementById("return");
returnToView.onclick= function(){
  window.location.href= "{{route('classSchedule')}}";
}
        </script>

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
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <p
            class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
          >
          Select Class
          </p>
       <form action="{{route('submitSelectedStrand')}}" method="post">
        @csrf
        @method('post')
          <!-- Modal description -->
          <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Class List
                </span>
                <select name="strands" id="strands"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                 $strands= App\Models\Strand::where('id', '!=', 7)->get();
                @endphp
                @forEach($strands as $strand)
                <option disabled>{{$strand->strand_name}}</option>
                @php 
                 $sections= App\Models\Section::where('id', '!=', 25)->where('strand_id', $strand->id)->get();
                @endphp
                @foreach($sections as $section)
                  <option value="{{$section->id}}">{{$section->year_level}} - {{$section->section}} ({{$strand->strand_shortcut}})</option>
                  @endforEach
                 @endforEach
                </select>
              </label>
        </div>
        <footer
          class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
        >
          
          <button name="select"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Select
          </button>
        </form>
        </footer>
      </div>
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