@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Admin Profile - Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/profile.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
       <link rel="stylesheet" href="{{asset('/dashboard/css/loadWait.css')}}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <body>
          <div id="uploadingLoading" style="display: none;" class="loading">Loading&#8230;</div>
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
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px">
       {{$admin_username}}
         </span> </a>
         <ul class="mt-6">
            <li class="relative px-6 py-3">
            <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center text-gray-800 w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
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
           
              <a
                class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
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
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column;margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="{{route('AdminProfile')}}"
          ><span style="text-align: center; font-size:15px">
          {{$admin_username}}
          </span></a>
       
          <ul class="mt-6">
            <li class="relative px-6 py-3">
            <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center text-gray-800 w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
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
           
              <a
                class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
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
        </header>
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container px-6 mx-auto grid h-full">
            <h4 class="mt-8 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Administrator Profile
              </h4>

            <div class="flex flex-col md:flex-row w-screen mt-4">
                <!-- First div - Occupies half width and whole height -->
                <div class="md:w-1/2 h-full mr-4 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                  <div class="profile">
                    
                    <img  class="profileImage border border-solid-gray-800" src="{{$profilePic}}" alt="profile_picture">
                    <div style="margin-top: -20px; align-items:center; display:flex; justify-content:center;" class="w-full" >  <button @click="openModal"
                       style="background: transparent">
                       <i class="fa-solid fa-camera" style="color:#7e3af2; font-size:1.75rem"></i>
                      </button></div>
                  </div>
                  <h4 class="mt-4 text-lg font-semibold text-xl text-center text-gray-600 dark:text-gray-300">
                    {{$fullname}}
                  </h4>
                  <h4 class=" text-sm  text-xs text-center text-gray-600 dark:text-gray-300">
                   Username: {{$username}}
                  </h4>
                  <h4 class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Personal Information
                  </h4>
                  <form style="display: block" action="{{route('updatePersonalAdmin')}}" id="personalForm" method="POST" class="border border-solid-gray-800">
                    @csrf
                    @method('post')
                    <div class="flex h-full w-full">
                 
                        <div class="flex-1 h-full px-4 py-3">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">First Name</span>
                                <input type="text"
                                name="first_name"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="First Name"
                                  required
                                  disabled
                                  value="{{$first_name}}"
                                />
                              </label>
                         
                              <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
                                <input
                                type="text"
                                required
                                name="middle_name"
                                disabled
                                value="{{$middle_name}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Middle Name"
                                />
                              </label>
                           
                              <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Username</span>
                                <input
                                type="text"
                                required
                                disabled
                                value="{{$username}}"
                                name="username"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Username"
                                />
                              </label>
                        </div>
                        <div class="flex-1 h-full px-4 py-3">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                                <input type="text"
                                required
                                disabled
                                name="last_name"
                                value="{{$last_name}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Last Name"
                                />
                              </label>
                              <label  id="text" class="block text-sm mt-4">
                                <span  class="text-gray-700 dark:text-gray-400">Suffix</span>
                                <input
                               
                                type="text"
                                required
                                disabled
                                value="{{$suffix}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="suffix"
                                />
                              </label>
                              <label style="display: none" id="dropdown" class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Suffix</span>
                                <select name="suffix" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                  <option value="none" {{ $suffix === 'none' ? 'selected' : '' }}>None</option>
                                  <option value="Jr." {{ $suffix === 'Jr.' ? 'selected' : '' }}>Jr.(Junior)</option>
                                  <option value="Sr." {{ $suffix === 'Sr.' ? 'selected' : '' }}>Sr.(Senior)</option>
                                  <option value="I" {{ $suffix === 'I' ? 'selected' : '' }}>I(The First)</option>
                                  <option value="II" {{ $suffix === 'II' ? 'selected' : '' }}>II(The Second)</option>
                                  <option value="III" {{ $suffix === 'III' ? 'selected' : '' }}>III(The Third)</option>
                                  <option value="IV" {{ $suffix === 'IV' ? 'selected' : '' }}>IV(The Fourth)</option>
                                  <option value="V" {{ $suffix === 'V' ? 'selected' : '' }}>V(The Fifth)</option>
                                </select>
                              </label>
                          
                          
                         
                            
                             
                             
                       
                                <button style="display: none" id="save"
                                class="px-4 mt-8 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                              >
                              <i class="fa-regular fa-floppy-disk"></i> Save
                              </button>
                              
                        </div>
           
                     </div>
              
                  </form>


                  <form action="{{route('changePassAdmin')}}" style="display: none" id="changePassword" method="POST" class="border border-solid-gray-800">
                    @csrf
                    @method('post')
                    <div class="flex h-full w-full">
                 
                      <div class="flex-1 h-full px-4 py-3">
                        <label class="block text-sm">
                          <span class="text-gray-700 dark:text-gray-400">Current Password</span>
                          <input
                          id="password"
                          type="password"
                          required
                          
                          name="currentPassword"
                          value=""
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Current Password"
                          />
                        </label>
                       
                        
                 
                          <button id="saveButton" type="submit"
                          class="px-4 mt-8 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                        <i class="fa-regular fa-floppy-disk"></i> Save
                        </button>
                        
                       
                          
                      </div>
                      <div class="flex-1 h-full px-4 py-3">
                        <label class="block text-sm">
                          <span class="text-gray-700 dark:text-gray-400">New Password</span>
                          <input
                          oninput="resetPassword()"
                          id="newpassword"
                          type="password"
                          required
                        
                          name="newPassword"
                          value=""
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="New Password"
                          />
                        </label>
                        <label class="block text-sm mt-4">
                          <span class="text-gray-700 dark:text-gray-400">
                          Confirm Password
                          </span>
                          <input oninput="passwordConfirmation()"
                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-gray-400 focus:outline-none focus:shadow-outline-red form-input"
                            placeholder="Confirm Password"
                            id="passwordConfirm"
                            type="password"
                            required
                            id=""
                          />
                          <span style="display: none" id="passwordText" class="text-xs text-red-600 dark:text-red-400">
                            Password Does not Match.
                          </span>
                        </label>
                            
                      </div>
            
                   </div>
            
                   <script>
                    function passwordConfirmation() {
                      const passwordConfirm = document.getElementById('passwordConfirm');
                      const newPassword = document.getElementById('newpassword');
                      const passwordText = document.getElementById('passwordText');
                  
                  
                      if (passwordConfirm.value === newPassword.value) {
                        const save= document.getElementById('saveButton');
                        passwordText.textContent= "Password Match."
                        while (passwordConfirm.classList.length > 0) {
                        passwordConfirm.classList.remove(passwordConfirm.classList.item(0));
                      } 
                      while (passwordText.classList.length > 0) {
                        passwordText.classList.remove(passwordText.classList.item(0));
                      } 
                      passwordConfirm.classList.add(
'block',
'w-full',
'mt-1',
'text-sm',
'border-green-600',
'dark:text-gray-300',
'dark:bg-gray-700',
'focus:border-green-400',
'focus:outline-none',
'focus:shadow-outline-green',
'form-input'
);  // Add one or more classes separated by commas
                      passwordText.classList.add(
                        'text-xs', 'text-green-600', 'dark:text-green-400'
                      );

                      save.disabled= false;
                      } else {
                        const save= document.getElementById('saveButton');
                        passwordText.textContent= " Password Does not Match."
                        passwordText.style.display = "block"; 
                        while (passwordConfirm.classList.length > 0) {
                        passwordConfirm.classList.remove(passwordConfirm.classList.item(0));
                      } 
                      while (passwordText.classList.length > 0) {
                        passwordText.classList.remove(passwordText.classList.item(0));
                      } 
                      passwordConfirm.classList.add(
                        'block',
'w-full',
'mt-1',
'text-sm',
'border-red-600',
'dark:text-gray-300',
'dark:bg-gray-700',
'focus:border-red-400',
'focus:outline-none',
'focus:shadow-outline-red',
'form-input'
                      );
                      passwordText.classList.add(
                        'text-xs', 'text-red-600', 'dark:text-red-400'
                      );
                      save.disabled= true;
                      }
                    }

                    function resetPassword(){
                      const newPassword= document.getElementById('newpassword');
                      const passwordConfirm = document.getElementById('passwordConfirm');
                      const passwordText = document.getElementById('passwordText');
                  
                     if(newPassword.value===""){
                    
                      while (passwordConfirm.classList.length > 0) {
                        passwordConfirm.classList.remove(passwordConfirm.classList.item(0));
                      } 
                      passwordConfirm.classList.add(
                        'block',
'w-full',
'mt-1',
'text-sm',
'border-gray-600',
'dark:text-gray-300',
'dark:bg-gray-700',
'focus:border-red-400',
'focus:outline-none',
'focus:shadow-outline-red',
'form-input'
                      );
                      passwordText.style.display="none";

                     } else   if (passwordConfirm.value === newPassword.value) {
                        const save= document.getElementById('saveButton');
                        passwordText.textContent= "Password Match."
                        while (passwordConfirm.classList.length > 0) {
                        passwordConfirm.classList.remove(passwordConfirm.classList.item(0));
                      } 
                      while (passwordText.classList.length > 0) {
                        passwordText.classList.remove(passwordText.classList.item(0));
                      } 
                      passwordConfirm.classList.add(
'block',
'w-full',
'mt-1',
'text-sm',
'border-green-600',
'dark:text-gray-300',
'dark:bg-gray-700',
'focus:border-green-400',
'focus:outline-none',
'focus:shadow-outline-green',
'form-input'
);  // Add one or more classes separated by commas
                      passwordText.classList.add(
                        'text-xs', 'text-green-600', 'dark:text-green-400'
                      );

                      save.disabled= false;
                      } else {
                        const save= document.getElementById('saveButton');
                        passwordText.textContent= " Password Does not Match."
                        passwordText.style.display = "block"; 
                        while (passwordConfirm.classList.length > 0) {
                        passwordConfirm.classList.remove(passwordConfirm.classList.item(0));
                      } 
                      while (passwordText.classList.length > 0) {
                        passwordText.classList.remove(passwordText.classList.item(0));
                      } 
                      passwordConfirm.classList.add(
                        'block',
'w-full',
'mt-1',
'text-sm',
'border-red-600',
'dark:text-gray-300',
'dark:bg-gray-700',
'focus:border-red-400',
'focus:outline-none',
'focus:shadow-outline-red',
'form-input'
                      );
                      passwordText.classList.add(
                        'text-xs', 'text-red-600', 'dark:text-red-400'
                      );
                      save.disabled= true;
                      }
                    }
                  </script>
                  
                </form>
                  </form>
                </div>
                
                <!-- Second div - Occupies half width and half height -->
                <div class="md:w-1/2 flex flex-col">
                  <div class="flex-1/2 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mb-4">
                    <h4 class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                     Admin Info
                       </h4>
                    <div id="infoSchool" class="border border-solid-gray-800 p-4">
                       
                      <h4 class=" text-sm text-gray-600 dark:text-gray-300">
                        As the administrator of Perfometrics, your role is pivotal in ensuring the smooth functioning of the evaluation system for Notre Dame Senior High School in Talisay City. You hold the responsibility of managing user accounts, overseeing the evaluation process, and maintaining the integrity of the data collected. The admin dashboard empowers you to configure system settings, generate reports, and facilitate a seamless experience for both faculty and students. Your efforts contribute to fostering a culture of continuous improvement and academic excellence at Notre Dame Senior High School, enhancing the overall educational experience for everyone involved.
                      </h4>
                    </div>
                
                    
                  </div>
                  <div class="flex-1/2 flex flex-col px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-4">
                    <h4 class="mt-4 mb-4 text-lg text-gray-600 dark:text-gray-300">
                      Other Options
                       </h4>
                 
                  <button
                  onclick="editPersonalData()" id="editPersonal" 
                  class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <i class="fa-solid fa-user-pen"></i> Edit Details
                </button>
                <button  id="editingPersonal" style="display: none" disabled
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 cursor-not-allowed focus:outline-none"
              >
              <i class="fa-solid fa-pen-to-square"></i>  Editing.....
              </button>

              <button
              onclick="editPassword()" id="editPassword"
              class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-solid fa-key"></i> Change Password
            </button>
            <button  id="editingPassword" style="display: none" disabled
            class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 cursor-not-allowed focus:outline-none"
          >
          <i class="fa-solid fa-key"></i> Changing..
          </button>
          <button onclick="returnToMain()"
          class="px-4 mt-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
        <i class="fa-solid fa-circle-arrow-left"></i> Return
        </button>
           
              <button style="display: none" id="cancel" onclick="cancelAll()"
              class="px-4 mt-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-regular fa-rectangle-xmark"></i> Cancel All Edit
            </button>
                  </div>
                </div>
              </div>
              
              
              <script>
                function returnToMain(){
                  window.location.href="{{route('admin_dashboard')}}";
                }
                function editPersonalData(){
                    const personalForm= document.getElementById('personalForm');
                    const changePassword= document.getElementById('changePassword');
                    const editPassword= document.getElementById('editPassword');
                    const editingPassword= document.getElementById('editingPassword');

                  const disabledInputs = document.querySelectorAll('input[disabled]');
                  const password= document.querySelectorAll('input[type=password]');
                  const text= document.getElementById('text');
                  const dropdown= document.getElementById('dropdown');
                  const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');
                  
                  const save= document.getElementById('save');
                 const cancel= document.getElementById('cancel');

                 personalForm.style.display="block";
                    changePassword.style.display="none";
                    editPassword.style.display="block";
                    editingPassword.style.display="none";
// Loop through the NodeList and remove the "disabled" attribute from each input
disabledInputs.forEach((input) => {
  input.removeAttribute('disabled');
});


  text.style.display= "none";
  dropdown.style.display="block";
  save.style.display="block";
   
    cancel.style.display="inline"
  editingPersonal.style.display="inline";
    editPersonal.style.display="none";
                }


                function editPassword(){
                    const personalForm= document.getElementById('personalForm');
                    const changePassword= document.getElementById('changePassword');
                    const editPassword= document.getElementById('editPassword');
                    const editingPassword= document.getElementById('editingPassword');

                    const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');

                  const cancel= document.getElementById('cancel');

                    personalForm.style.display="none";
                    changePassword.style.display="block";
                    editPassword.style.display="none";
                    editingPassword.style.display="block";

                    editingPersonal.style.display="none";
    editPersonal.style.display="inline";
    cancel.style.display="inline"
                }
             
function cancelAll(){

                 const disabledInputs = document.querySelectorAll('input');
                 
                  const text= document.getElementById('text');
                  const dropdown= document.getElementById('dropdown');
                  const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');
                
                  const save= document.getElementById('save');
                 const cancel= document.getElementById('cancel');

                 const personalForm= document.getElementById('personalForm');
                    const changePassword= document.getElementById('changePassword');
                    const editPassword= document.getElementById('editPassword');
                    const editingPassword= document.getElementById('editingPassword');

                 const pass= "{{$password}}";
               
disabledInputs.forEach((input) => {
  input.disabled = true;
});


text.style.display= "block";
  dropdown.style.display="none";
  
    save.style.display="none";

    editingPersonal.style.display="none";
    editPersonal.style.display="inline";

    personalForm.style.display="block";
                    changePassword.style.display="none";
                    editPassword.style.display="block";
                    editingPassword.style.display="none";

    cancel.style.display="none"
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
   <!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your HTML content -->
<p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
  Change Profile Picture
</p>

<div class="profileHolder">
  <img id="preview" class="placeholder" capture="user" accept="image/*" src="{{$profilePic}}" alt="alt">

  <form id="uploadForm" method="post" action="{{route('updateProfilePicAdmin')}}" enctype="multipart/form-data">
    @csrf
    @method('post')
    <input accept="image/*" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple custom-file-input" type="file" name="picture" id="picture">
    <input class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit" name="upload" value="Update" onclick="setLoading()">
  </form>
  
  <div class="progress">
    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  
</div>

<script>
function setLoading(){
    document.getElementById('uploadingLoading').style.display='';
}
  $('#uploadForm').submit(function(event) {
    event.preventDefault(); // Prevent default form submission
    
    let formData = new FormData(this); // Grab form data
    
    $.ajax({
      url: $(this).attr('action'), // Get form action URL
      type: $(this).attr('method'), // Get form method type
      data: formData,
      processData: false,
      contentType: false,
      xhr: function () {
        let xhr = new window.XMLHttpRequest();
        xhr.upload.onprogress = function (e) {
          if (e.lengthComputable) {
            let percentComplete = (e.loaded / e.total) * 100;
            let progressBar = $('.progress-bar');
            progressBar.css('width', percentComplete + '%');
            progressBar.attr('aria-valuenow', percentComplete);
          }
        };
        return xhr;
      },
      success: function (data) {
          document.getElementById('uploadingLoading').style.display='none';
       Swal.fire({
  title: "Profile Picture Changed",
  text: "Successfully update your profile picture",
  icon: "success",
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  confirmButtonText: 'OK'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.reload(true);
  }
});
      }
    });
  });
</script>



  </div>

</div>
</div>
<script>
const input = document.querySelector('input[type="file"]');
const preview = document.getElementById('preview');

input.addEventListener('change', function() {
  const file = this.files[0];
  const objectURL = URL.createObjectURL(file);
  
  // Revoke object URL of previous image
  if (preview.src) {
    URL.revokeObjectURL(preview.src);
  }
  
  preview.src = objectURL;
});
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