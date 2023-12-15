@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Perfometrics Settings</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <script src="{{asset('dashboard/js/settings.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  <!-- JavaScript -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
  
  <!-- 
      RTL version
  -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
  
  </head>
  <style>
  .radio-container {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

.radio-container input[type="radio"] {
    display: none;
}

.radio-container label {
    padding: 10px;
    flex-grow: 1;
    background-color: white; /* Dark gray background color */

    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out; /* Smooth transition */
}

.radio-container input[type="radio"]:checked + label {
    background-color: #7e3af2; 
    color: white;/* Dark gray background when selected */
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

    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px; ">
            {{$admin_username}}
         </span>
          </a>

          <ul class="mt-6">
            <li class="relative px-6 py-3">
           
              <a
                class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-600"
                href="{{route('AdminProfile')}}"
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
                    d="M12,12c2.21,0 4,-1.79 4,-4s-1.79,-4 -4,-4 -4,1.79 -4,4 1.79,4 4,4zM12,14c-2.67,0 -8,1.34 -8,4v2h16v-2c0,-2.66 -5.33,-4 -8,-4z"
                  ></path>
                </svg>
                <span class="ml-4">Profile</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
                <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center text-gray-800 w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:text-gray-100 dark:hover:text-gray-200"
                href="{{route('settings')}}"
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
                    d="M19.14,12.94c0.04,-0.3 0.06,-0.61 0.06,-0.94c0,-0.32 -0.02,-0.64 -0.07,-0.94l2.03,-1.58c0.18,-0.14 0.23,-0.41 0.12,-0.61l-1.92,-3.32c-0.12,-0.22 -0.37,-0.29 -0.59,-0.22l-2.39,0.96c-0.5,-0.38 -1.03,-0.7 -1.62,-0.94L14.4,2.81c-0.04,-0.24 -0.24,-0.41 -0.48,-0.41h-3.84c-0.24,0 -0.43,0.17 -0.47,0.41L9.25,5.35C8.66,5.59 8.12,5.92 7.63,6.29L5.24,5.33c-0.22,-0.08 -0.47,0 -0.59,0.22L2.74,8.87C2.62,9.08 2.66,9.34 2.86,9.48l2.03,1.58C4.84,11.36 4.8,11.69 4.8,12s0.02,0.64 0.07,0.94l-2.03,1.58c-0.18,0.14 -0.23,0.41 -0.12,0.61l1.92,3.32c0.12,0.22 0.37,0.29 0.59,0.22l2.39,-0.96c0.5,0.38 1.03,0.7 1.62,0.94l0.36,2.54c0.05,0.24 0.24,0.41 0.48,0.41h3.84c0.24,0 0.44,-0.17 0.47,-0.41l0.36,-2.54c0.59,-0.24 1.13,-0.56 1.62,-0.94l2.39,0.96c0.22,0.08 0.47,0 0.59,-0.22l1.92,-3.32c0.12,-0.22 0.07,-0.47 -0.12,-0.61L19.14,12.94zM12,15.6c-1.98,0 -3.6,-1.62 -3.6,-3.6s1.62,-3.6 3.6,-3.6s3.6,1.62 3.6,3.6S13.98,15.6 12,15.6z"
                  ></path>
                </svg>
                <span class="ml-4">Settings</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
           
              <a
                class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('feedback')}}"
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
                    d="M20,2L4,2c-1.1,0 -1.99,0.9 -1.99,2L2,22l4,-4h14c1.1,0 2,-0.9 2,-2L22,4c0,-1.1 -0.9,-2 -2,-2zM13,14h-2v-2h2v2zM13,10h-2L11,6h2v4z"
                  ></path>
                </svg>
                <span class="ml-4">Feedbacks</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
           
              <a
                class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('logs')}}"
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
                    d="M19,3h-4.18C14.4,1.84 13.3,1 12,1c-1.3,0 -2.4,0.84 -2.82,2L5,3c-1.1,0 -2,0.9 -2,2v14c0,1.1 0.9,2 2,2h14c1.1,0 2,-0.9 2,-2L21,5c0,-1.1 -0.9,-2 -2,-2zM12,3c0.55,0 1,0.45 1,1s-0.45,1 -1,1 -1,-0.45 -1,-1 0.45,-1 1,-1zM14,17L7,17v-2h7v2zM17,13L7,13v-2h10v2zM17,9L7,9L7,7h10v2z"
                  ></path>
                </svg>
                <span class="ml-4">Activity Logs</span>
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
          <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column;margin-bottom:20px" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px">
          {{$admin_username}}
          </span></a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
      
              <a
                class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-600"
                href="{{route('AdminProfile')}}"
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
                    d="M12,12c2.21,0 4,-1.79 4,-4s-1.79,-4 -4,-4 -4,1.79 -4,4 1.79,4 4,4zM12,14c-2.67,0 -8,1.34 -8,4v2h16v-2c0,-2.66 -5.33,-4 -8,-4z"
                  ></path>
                </svg>
                <span class="ml-4">Profile</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
                <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center text-gray-800 w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('settings')}}"
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
                    d="M19.14,12.94c0.04,-0.3 0.06,-0.61 0.06,-0.94c0,-0.32 -0.02,-0.64 -0.07,-0.94l2.03,-1.58c0.18,-0.14 0.23,-0.41 0.12,-0.61l-1.92,-3.32c-0.12,-0.22 -0.37,-0.29 -0.59,-0.22l-2.39,0.96c-0.5,-0.38 -1.03,-0.7 -1.62,-0.94L14.4,2.81c-0.04,-0.24 -0.24,-0.41 -0.48,-0.41h-3.84c-0.24,0 -0.43,0.17 -0.47,0.41L9.25,5.35C8.66,5.59 8.12,5.92 7.63,6.29L5.24,5.33c-0.22,-0.08 -0.47,0 -0.59,0.22L2.74,8.87C2.62,9.08 2.66,9.34 2.86,9.48l2.03,1.58C4.84,11.36 4.8,11.69 4.8,12s0.02,0.64 0.07,0.94l-2.03,1.58c-0.18,0.14 -0.23,0.41 -0.12,0.61l1.92,3.32c0.12,0.22 0.37,0.29 0.59,0.22l2.39,-0.96c0.5,0.38 1.03,0.7 1.62,0.94l0.36,2.54c0.05,0.24 0.24,0.41 0.48,0.41h3.84c0.24,0 0.44,-0.17 0.47,-0.41l0.36,-2.54c0.59,-0.24 1.13,-0.56 1.62,-0.94l2.39,0.96c0.22,0.08 0.47,0 0.59,-0.22l1.92,-3.32c0.12,-0.22 0.07,-0.47 -0.12,-0.61L19.14,12.94zM12,15.6c-1.98,0 -3.6,-1.62 -3.6,-3.6s1.62,-3.6 3.6,-3.6s3.6,1.62 3.6,3.6S13.98,15.6 12,15.6z"
                  ></path>
                </svg>
                <span class="ml-4">Settings</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
           
              <a
                class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('feedback')}}"
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
                    d="M20,2L4,2c-1.1,0 -1.99,0.9 -1.99,2L2,22l4,-4h14c1.1,0 2,-0.9 2,-2L22,4c0,-1.1 -0.9,-2 -2,-2zM13,14h-2v-2h2v2zM13,10h-2L11,6h2v4z"
                  ></path>
                </svg>
                <span class="ml-4">Feedbacks</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
           
              <a
                class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('logs')}}"
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
                    d="M19,3h-4.18C14.4,1.84 13.3,1 12,1c-1.3,0 -2.4,0.84 -2.82,2L5,3c-1.1,0 -2,0.9 -2,2v14c0,1.1 0.9,2 2,2h14c1.1,0 2,-0.9 2,-2L21,5c0,-1.1 -0.9,-2 -2,-2zM12,3c0.55,0 1,0.45 1,1s-0.45,1 -1,1 -1,-0.45 -1,-1 0.45,-1 1,-1zM14,17L7,17v-2h7v2zM17,13L7,13v-2h10v2zM17,9L7,9L7,7h10v2z"
                  ></path>
                </svg>
                <span class="ml-4">Activity Logs</span>
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
                <div class="absolute inset-y-0 flex items-center pl-2">
                
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
                        href="{{route('admin_dashboard')}}"
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
                            d="M15.41,16.59L10.83,12l4.58,-4.59L14,6l-6,6 6,6 1.41,-1.41z"
                          ></path>
                        </svg>
                        <span>Go Back</span>
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
          @php
          $admin= App\Models\Admin::where('admin_type', 'Super Admin')->first();
      @endphp

        </header>
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Administrator Settings
              </h4>

              <p class="text-l font-semibold text-gray-600 dark:text-gray-200">
                SAVED DATA
              </p>
             
           @php
               $saved= App\Models\SavedEvaluation::all();
           @endphp
             <form id="saveEvaluationResultForm" method="post">
                @csrf
                @method('post')
              <div style="height: 30vh; "
              class="px-4 py-3 mb-8 bg-white border border-solid-gray-800 rounded-lg overflow-y-auto overflow-x-auto shadow-md dark:bg-gray-800" >
             <!--Content-->
             @php
                 $admin=  App\Models\Admin::where('admin_type', 'Super Admin')->first();
             @endphp
             @if ($saved->count()>0)
             @foreach ($saved as $save)
             <div class="radio-container">
                 <input type="radio" id="radio_{{$save->id}}" name="selectedData" onclick="radioData({{$save->id}})" value="{{$save->id}}">
                 <label for="radio_{{$save->id}}"><strong>Name:</strong> {{$save->evaluation_name}} / <i><strong>Current Sem:</strong> </i> {{
                 $admin->admin_sem
                 }} / <i><strong>Academic Year:</strong> </i>{{$admin->admin_sy}}</label>
             </div>
         @endforeach
         
             @else
             <p class="text-sm text-center font-semibold text-gray-400 dark:text-gray-800">
                NO DATA SAVED
              </p>
              <p class=" text-center font-semibold text-gray-400 dark:text-gray-800">
                <i class="fa-regular fa-face-frown text-xl" style="font-size:4rem"></i>
              </p>
            
             @endif
            
            </div>
           
            <div class="flex w-full gap-6">
              @if ($saved->count()>0)
                <button type="submit" 
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
              <i class="fa-regular fa-hard-drive"></i> Load Evaluation Data
              </button>
              @endif
              <button  type="button" @click="openModal" onclick="ResetData()"
              class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-solid fa-arrow-rotate-left"></i>   Reset Evaluation Data
            </button>
            <button  @click="openModal" onclick="save('{{$admin->admin_sem}}')" type="button"
            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
          <i class="fa-solid fa-download"></i> Saved Current Evaluation Data
          </button>
          @if ($saved->count()>0)
          <button type="button" @click="openModal" onclick="deleteData()"
            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
          <i class="fa-solid fa-trash-can"></i> Delete Evaluation Data
          </button>
          @endif
          <button type="button" onclick="back()"
          class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
        <i class="fa-solid fa-circle-arrow-left"></i> Return
        </button>
            </div>

        </form>
        <script>
          $(document).ready(function() {
    $('form#saveEvaluationResultForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: '{{route('deleteOrLoad')}}',
            data: formData,
            success: function(response) {
                if (response.message === 'Data loaded successfully') {
            // Handle successful login
            Swal.fire({
                title: 'Data Succesfully Loaded',
                text: 'Done',
                icon: 'success',
                showConfirmButton: false
            });

           
        } else if(response.message==='Data is already loaded') {
            // Handle other cases (e.g., validation errors)
            Swal.fire({
                        icon: 'question',
                        title: 'Oops...',
                        text: 'Data is already Loaded',
                        showConfirmButton: false,
                    });
        }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle the validation error
                    var responseJSON = xhr.responseJSON;
                    if (responseJSON && responseJSON.error) {
                        // Display the error message to the user (e.g., using a library like Swal)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error',
                            showConfirmButton: false,
                        });
                    }
                } else if (xhr.status === 401) {
                    // Handle the case where the user is not found in the database
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data is already Loaded',
                        showConfirmButton: false,
                    });
                } else {
                    // Handle other types of errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'NO SELECTED DATA SET',
                        showConfirmButton: false,
                    });
                }
            }
        });
    });
});
    


          function back(){
  window.location.href="{{route('admin_dashboard')}}";
  
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
             
                <!-- Modal title -->
                <form id="saveEvalData" style="display: none" method="post">
                    @csrf
                    @method('post')
                    <div class="mt-4 mb-6">
                <p
                  class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
                >
                 Save Current Evaluation Data
                </p>
                
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Evaluation Name</span>
                    <input
                    type="text"
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Data"
                      id="saveData"
                      name="dataName"
                      value="someValue"
                      required
                    />
                  </label>
                  <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400">Current Semester(Uneditable)</span>
                    <input
                    type="text"
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Data"
                      id="saveData"
                      value="{{App\Models\Admin::where('admin_type', 'Super Admin')->first()->admin_sem}}"
                      disabled
                    />
                  </label>
                  <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400">Academic Year(Undeditable)</span>
                    <input
                    type="text"
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                      placeholder="Data"
                      id="saveData"
                      value="AY - {{App\Models\Admin::where('admin_type', 'Super Admin')->first()->admin_sy}}"
                      disabled
                    />
                  </label>

              </div>
              <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
              >
                <button type="button"
                  @click="closeModal"
                  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                >
                  Cancel
                </button>
                <button
                  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Evaluation Data
                </button>
              </footer>
            </form>

            <form id="resetData" style="display: none" method="post" action="{{route('resetData')}}">
              @csrf
              @method('post')
              <div class="mt-4 mb-6">
          <p
            class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
          >
           Admin Password Required
          </p>
          
          <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Admin Password</span>
              <input
              type="password"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Enter Password"
               required
                name="adminPassword"
                
              />
            </label>

        </div>
        <footer
          class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
        >
          <button type="button"
            @click="closeModal"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
          >
            Cancel
          </button>
          <button type="submit"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
           Reset Evaluation
          </button>
        </footer>
      </form>


      <form id="scorePercentage" style="display: none" method="post">
        @csrf
        @method('post')
        <div class="mt-4 mb-6">
    <p
      class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
    >
    Evaluator Weighting Settings
    </p>
   
    @php
        $scoreWeight= App\Models\Admin::where('admin_type', 'Super Admin')->first();
    @endphp
    <div class="flex items-center mb-4">
      <label class="block text-sm flex items-center gap-6">
          <span class="text-gray-700 dark:text-gray-400">Student: </span>
          <input
              type="number"
              class="block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input student-input"
              placeholder="%"
              required
              id="studentWeight"
              value="{{$scoreWeight->student_weight}}"
              oninput="limitInputLength(this, 2)"
              name="studentWeight"
          />
      </label>
      <div class="percent-box ml-2 flex items-center bg-gray-200 rounded-md px-2 py-1">
          <span>%</span>
      </div>
  </div>
      
  <div class="flex items-center mb-4">
    <label class="block text-sm flex items-center gap-6">
        <span class="text-gray-700 dark:text-gray-400">Coordinator: </span>
        <input
            type="number"
            class="block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input student-input"
            placeholder="%"
            required
            id="coordinatorWeight"
            value="{{$scoreWeight->coordinator_weight}}"
            oninput="limitInputLength(this, 2)"
            name="coordinatorWeight"
        />
    </label>
    <div class="percent-box ml-2 flex items-center bg-gray-200 rounded-md px-2 py-1">
        <span>%</span>
    </div>
</div>
<span id="invalidValues" style="display: none" class="text-xs text-red-600 dark:text-red-400">
  Values Not Allowed Must be equal to 100%
</span>
  
  </div>
  <footer
    class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
  >
    <button type="button"
      @click="closeModal"
      class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
    >
      Cancel
    </button>
    <button type="submit" id="weightSubmit"
      class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
    >
     Save
    </button>
  </footer>
</form>

<form id="deleteData" style="display: none" method="post" action="{{route('deleteData')}}">
  @csrf
  @method('post')
  <div class="mt-4 mb-6">
<p
class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
>
Admin Password Required
</p>
<input type="hidden" id="radioData" name="data">

<label class="block text-sm">
  <span class="text-gray-700 dark:text-gray-400">Admin Password</span>
  <input
  type="password"
    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
    placeholder="Enter Password"
   required
    name="adminPassword"
    
  />
</label>

</div>
<footer
class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
>
<button type="button"
@click="closeModal"
class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
>
Cancel
</button>
<button type="submit"
class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
>
Delete Evaluation
</button>
</footer>
</form>


            </div>
          </div>

<script>
  $(document).ready(function() {
    $('form#saveEvalData').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: "{{route('saveEvalStorage')}}",
            data: formData,
            success: function(response) {
             if(response.message==='success'){
              Swal.fire({
                title: 'Success!',
                text: 'Saved Evaluation data.',
                icon: 'success',
                showConfirmButton: true,
                allowOutsideClick: true, 
                allowEscapeKey: true,    
                timer: 2000,           
            });
             }else{
              Swal.fire({
                title: 'Are you sure?',
                text: 'Data already exist. Do you want to Overwrite',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Overwrite',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                  const dataId = response.dataId
                   Overwrite(dataId);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Overwrite Canceled', 'error');
                }
            });
             }
            },
            error: function(xhr) {
               
            }
        });
    });
});



$(document).ready(function() {
    $('form#scorePercentage').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: "{{route('scoreWeightPercentage')}}",
            data: formData,
            success: function(response) {
             if(response.message==='success'){
              Swal.fire({
                title: 'Success!',
                text: 'Score Weights Updated.',
                icon: 'success',
                showConfirmButton: true,
                allowOutsideClick: true, 
                allowEscapeKey: true,    
                timer: 2000,           
            });
             }
            },
            error: function(xhr) {
               
            }
        });
    });
});
    
function Overwrite(data) {
    var formData = $('form#saveEvalData').serialize();

    $.ajax({
        type: 'POST',
        url: "{{route('overWriteSaveData')}}?data="+data,
        data: formData,
        success: function(response) {
          if(response.message==='success'){
            Swal.fire({
                title: 'Success!',
                text: 'Saved Evaluation data.',
                icon: 'success',
                showConfirmButton: true,
                allowOutsideClick: true, 
                allowEscapeKey: true,    
                timer: 2000,           
            });
            setTimeout(() => {
              location.reload();
            }, 2000);
          }
          
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}

</script>
<div
class="px-4 py-3 mb-4 mt-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
>
<h4 class="mt-2 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
 Advance Settings
 </h4>
 <button onclick="backUpData()"
 class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
>
<i class="fa-solid fa-database"></i> Back Up Data
</button>
<button onclick="ScoreEditor()" @click="openModal"
class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
>
<i class="fa-solid fa-percent"></i> Score Percentage
</button>
</div>
          <div
          class="px-4 mt-8 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
        <h4 class="mt-4 mb-4 text-center text-lg font-semibold text-gray-600 dark:text-gray-300">
          About Performetrics
         </h4>

          <p class="text-sm text-center text-gray-600 dark:text-gray-400">
            Welcome to the Faculty Performance Evaluation System, a comprehensive and innovative app designed exclusively for Notre Dame Talisay. Seamlessly integrating data analytics and a sophisticated class scheduler, our app empowers academic institutions to elevate their faculty management and performance assessment processes. Streamline your administrative tasks, analyze critical performance metrics, and optimize class scheduling effortlessly. Join us in revolutionizing education management at Notre Dame Talisay with our powerful, user-friendly, and tailored solution.
          </p>
          <p class="text-l mt-4 text-center text-gray-600 dark:text-gray-400">
             App Version: Alpha(1.9)  
          </p>
          <p class="text-l text-center text-gray-600 dark:text-gray-400">
           System Birthdate on Web: August, 22, 2023
          
         </p>
         <p class="text-l text-center text-gray-600 dark:text-gray-400">
          Last System Update: December, 7, 2023
        </p>
        
         <div class="flex justify-center gap-6 mt-4">
          <button onclick="patchNotes()"
          class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
        <i class="fa-regular fa-newspaper"></i> Patch Notes
        </button>
        <button onclick="credits()"
        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
      >
      <i class="fa-solid fa-laptop-code"></i> Credits
      </button>
    
         </div>
     
        </div>

        <script>
          function credits(){
            window.location.href="{{route('credits')}}";
          }
          function patchNotes(){
            window.location.href="{{route('patch')}}";
          }
          function backUpData(){
            window.location.href="{{route('backup')}}";
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