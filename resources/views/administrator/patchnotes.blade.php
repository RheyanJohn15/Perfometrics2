@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Perfometrics System Patchnotes</title>
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
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
<style>
    .ul {
  margin-left: 40px;
  list-style-type: disc;
}
</style>
  </head>


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
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <div id="11" >
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
               Current System Patch Notes Version Alpha(1.9)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               December, 7, 2023 Version 1.8.1 Release
               
               </p>
  
               <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
                Current Patch Minor Patches December, 7, 2023
                </p>
                <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                  Bugs Fixed 
                  </p>
            


              <label for="mainFeature">Additional Patch</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Added Added Score Percentage Weights</li>
                   <li>Update Scoring Algorithms</li>
                   <li>Teacher Can Now view Comments</li>
                  </ul>

       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>More Bugs to fix</li>
                    <li>Add Back up</li>
                    <li>Fix Bugs on Generate Reports</li>
                    <li>Add Signatures of officials</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>

            <div id="10" style="display: none">
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
               Previous System Patch Notes Version Alpha(1.8.1)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               November, 13, 2023 Version 1.8.1 Release
               
               </p>
  
               <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
                Previous Patch Minor Patches November, 16, 2023
                </p>
                <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                  Bugs Fixed and added some filters on the analytics and legends
                  </p>
            


              <label for="mainFeature">Additional Patch</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Added Random quotes in each page</li>
                   <li>Subject Management on the parameters page</li>
                   <li>Fix Bugs</li>
                  </ul>

       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>More Bugs to fix</li>
                    <li>Optimization of some feature</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>

            <div id="9" style="display: none">
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
               Previous System Patch Notes Version Alpha(1.8)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               November, 8, 2023 Version 1.8 Release
               
               </p>
  
               <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
                Previous Patch
                </p>
              
                <label for="add">Addition Patch</label>
                <ul id="add" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                 <li>Added 2 additional Graphs on the dashboard</li>
                  <li>Additional Actions that records activity</li>
                   <li>Fix Minor Bugs</li>
                  </ul>

              <label for="mainFeature">Changes</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Can Now Set Schedule for the evaluation form to close</li>
                   <li>Added Frequency Distribution on the teachers dashboard</li>
                   <li>Add Option to Overwrite evaluation data</li>
                   <li>Fix Bugs</li>
                  </ul>

       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>More Bugs to fix</li>
                    <li>Optimization of some feature</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>

            <div id="8" style="display:  none" >
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
               Previous System Patch Notes Version Alpha(1.7)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               October, 27, 2023 Version 1.7 Release
               
               </p>
  
               <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
                Previous Patch
                </p>
                <label for="additional">Additional Patches</label>
                <ul id="additional" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                  <li>Admin Can now send Custom Messages and Account Details to the user</li>
                  <li>Improve UX/UI of Users for Students</li>
                  <li>Add Confirmation for deletion of students</li>
                  
                </ul>
              <label for="mainFeature">Changes</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>On View Data for Evaluation Result Added Frequency Distribution Graphs on each question rows</li>
                   <li>Total Revamp of view data page</li>
                   <li>Revamp All User Dashboards</li>
                   <li>Add Search Query for users</li>
                  <li>Add Batch of users feature in all user dashboard</li>
                  <li>Delete Individual and Delete Batch User is Implemented</li>
                  <li>Fix form to accept 90% chance of clean data</li>                  
                  <li>Added feedback alerts in some actions Especially in form submissions</li>
                  <li>New User Accounts will set up recovery mail and new passwords</li>
                  <li>Recovery mail is used to recover forgotten passwords</li>
                  <li>Added Cookie session for easy log in when returning to the system</li>
                  <li>Activity Logs records certain admin Activities</li>
                  <li>Recycle Bin Can permanently delete or restore deleted users</li>
                  <li>Some Bugs fixed</li>
                  
                </ul>

       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>More Bugs to fix</li>
                    <li>Optimization of some feature</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>

            <div id="7" style="display: none" >
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
               Previous System Patch Notes Version Alpha(1.6)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               October, 13, 2023 Version 1.6 Release
               
               </p>
  
               <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
                Previous Patch
                </p>
              <label for="mainFeature">Changes</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Fix Change Image Bugs</li>
                   <li>Adjust to 20mb max Image size</li>
                   <li>Fix Minor Bugs</li>
                
                </ul>

               
  
     <label for="common">Added Data Analytics</label>
                <ul id="common" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                 <li>Diagnostic Analytics Semi Done(Still On Going)</li>
                 <li>5 years worth of data collection</li>
                 
                </ul>
       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>Additional Data Analyzation and Interpretation</li>
                    <li>Plan to use statistical formulas for better Analyzation</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>

            <div id="6" style="display: none" >
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
               Current System Patch Notes Version Alpha(1.5)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               October, 6, 2023 Version 1.5 Release
               Update: October, 9, 2023 Version 1.5.2
               </p>
  
               <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
                Current Patch
                </p>
              <label for="mainFeature">Changes</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Revamp Evaluation Form UI</li>
                   <li>Integrating Visualization Charts on Evaluation result page of teacher</li>
                   <li>Added Some Feedback mechanism on settings page</li>
                   <li>Optimization of codes</li>
                   <li>Fix Minor Bugs</li>
                </ul>

                <label for="mainFeature">Changes of 1.5.1</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Added Loading Buttons on Login</li>
                   <li>Fix Minor Bugs</li>
                   <li>Change Some Visualization on overall data Analytics</li>
                </ul>
                
                <label for="mainFeature">Changes of 1.5.2</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Fix UI Bugs</li>
                   <li>Fix Minor Bugs</li>
            
                </ul>
  
     <label for="common">Added Data Analytics</label>
                <ul id="common" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                 <li>Diagnostic Analytics Semi Done(Still On Going)</li>
                 <li>5 years worth of data collection</li>
                 
                </ul>
       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>Additional Data Analyzation and Interpretation</li>
                    <li>Plan to use statistical formulas for better Analyzation</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>

            <div id="5" style="display: none">
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
               <i>Previous</i> System Patch Notes Version Beta(1.4)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               October, 1, 2023 Version 1.4 Release
               </p>
  
               <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
                <i>Previous</i> Patch Includes Adviser Suggestions Implemention(Sir Padilla)
                </p>
              <label for="mainFeature">Changes</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Added feedback modal on Login page</li>
                   <li>Change Settings configurations</li>
                   <li>Added Confirm Password on profile of each entity</li>
                   <li>Fix Minor Bugs</li>
                </ul>
  
  
     <label for="common">Added Data Analytics</label>
                <ul id="common" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                 <li>Diagnostic Analytics Semi Done</li>
                 <li>5 years worth of data collection</li>
                 
                </ul>
       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>Additional Data Analyzation and Interpretation</li>
                    <li>Plan to use statistical formulas for better Analyzation</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>

            <div id="4" style="display: none">
              <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                <i>Previous</i> System Patch Notes Version Beta(1.3)
              </h4>
  
  
              <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
               September, 28, 2023 Version 1.3 Release
               </p>
  
               <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
                <i>Previous</i> Patch Includes Adviser Suggestions Implemention(Sir Padilla)
                </p>
              <label for="mainFeature">Changes</label>
                <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>Change Side Panel Text</li>
                    <li>Changes of UI Designs </li>
                    <li>Change Succes Modals</li>
                    <li>Fix Some Bugs</li>
                    <li>Added Loader for Landing Page</li>
                    <li>Can View Previous patches</li>
                   
                </ul>
  
  
     <label for="common">Added Data Analytics  For the next update</label>
                <ul id="common" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                  <li>Diagnostic and Prescriptive</li>
                  <li>Maximum of 5 years data accumulation </li>
                 
                </ul>
       
  
                    <label for="soon">Future Updates(Plans)</label>
                    <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                     <li>Change Password Integration</li>
                     <li>Waiting for panel suggestion</li>
                    </ul>
  
                    <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                       ~~Project Leader/Programmer
                         </p>

            </div>
          <div id="3" style="display: none">
            <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              <i>Previous</i>  System Patch Notes Version Beta(1.2)  
            </h4>


            <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
             September, 15, 2023 Version 1.2 Release
             </p>

             <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
              <i>Previous</i>  Patch Includes Adviser Suggestions Implemention(Sir Padilla)
              </p>
            <label for="mainFeature">Changes</label>
              <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                  <li>Removed Star Ranking</li>
                  <li>Changes of UI Designs Especially on the View Data</li>
                  <li>Finalize Design for Ranking System</li>
                  <li>Additional Info on View Data Dashboard</li>
                  <li>Change "Assigned Teacher" to "Parameter"</li>
                  <li>Scheduling Form Major Changes</li>
              </ul>


   <label for="common">Scheduling From Changes</label>
              <ul id="common" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                <li>Teacher Selection is removed</li>
                <li>Subject that are assigned with teacher will automatically appear</li>
                <li>Subject that has no teacher assigned will automatically put to Not Set</li>
            
              </ul>
     

                  <label for="soon">Future Updates(Plans)</label>
                  <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                   <li>Change Password Integration</li>
                   <li>Message System</li>
                  </ul>

                  <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                     ~~Project Leader/Programmer
                       </p>
          </div>

          <div id="2" style="display: none">
            <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              <i>Previous</i>  System Patch Notes Version Beta(1.0.1) 
            </h4>


            <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
             August, 30, 2023 Version 1.0.1 Release
             </p>

             <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
              <i>Previous</i>  Patch Includes Fixed Bug and some additional functions
              </p>
            <label for="mainFeature">Bugs Fixed</label>
              <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                  <li>Incorrect Name on view data</li>
                  <li>Some Minor UI Bugs</li>
              </ul>


   <label for="common">Additional Patch</label>
              <ul id="common" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                  <li>Added Messaging System</li>
                  <li>Change Login Mechanics for Admin Login</li>
                  <li>Added 401 Error Page for Unauthorized Access</li>
                  <li>Added Teacher Profiles on View Data Page</li>
              </ul>
     

                  <label for="soon">Future Updates(Plans)</label>
                  <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                    <li>Messaging System still on development at 20%</li>
                    <li>More Testing for Bugs</li>                        
                  </ul>

                  <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                      Provide your insights
                       </p>
          </div>


          <div id="1" style="display: none">
            <h4 class="mt-8 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              <i>Previous</i> System Patch Notes Version Beta(1.0) 
            </h4>

            <p class="text-gray-800 text-sm dark:text-gray-200">
             Hi guys!
            </p>

            <p class="text-gray-800 mt-8 text-sm dark:text-gray-200">
             First Release of our System 🥂🎈🥳 Release Date: August, 22, 2023
             </p>

             <p class="text-gray-800 mt-8 mb-8 text-sm dark:text-gray-200">
              <i>Previous</i>  Patch Includes all the basic functionality and declared feature of the system this includes:
              </p>
            <label for="mainFeature">Main Features</label>
              <ul id="mainFeature" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                  <li>Evaluation System</li>
                  <li>Data analytics</li>
                  <li>Class Scheduler</li>
                  <li>Teacher Profiling</li>
              </ul>


   <label for="common">Common Features</label>
              <ul id="common" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                  <li>Dynamic Data on Dashboard(Section, Strands, Classrooms )</li>
                  <li>Forms Can Be closed or deployed</li>
                  <li>Add Accounts(Teacher, Coordinator, Students, Visitor Admin)</li>
                  <li>Assign Teachers</li>
                  <li>Export Data(PDF, Excel)</li>
                  <li>Set Schedule</li>
                  <li>Data Management on Settings</li>
                  <li>Editable Profile(Teacher, Student, Settings)</li>
              </ul>
     

                  <label for="soon">Future Updates(Plans)</label>
                  <ul id="soon" class="ul text-gray-800 mb-8 text-sm dark:text-gray-200">
                      <li>UI/UX Improvement</li>
                      <li>Update form submission Response</li>
                      <li>Add in App notifications</li>
                      <li>In App Messaging</li>  
                      <li>Implement Suggestions</li> 
                                             
                  </ul>

                  <p class="text-gray-800 mb-8 text-sm dark:text-gray-200">
                      And other Stuffs Explore it yourself
                       </p>
          </div>


                         <label class="block mt-4 mb-8 text-sm">
                          <span class="text-gray-700 dark:text-gray-400">
                          View Previous Patch Notes
                          </span>
                          <select id="selectPatch" onchange="changePatch()"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          >
                         
                            <option value="1">Alpha(1.0)</option>
                            <option value="2">Alpha(1.0.1)</option>
                            <option value="3">Alpha(1.2)</option>
                            <option value="4">Alpha(1.3)</option>
                            <option value="5">Alpha(1.4)</option>
                            <option value="6">Alpha(1.5)</option>
                            <option value="7">Alpha(1.6)</option>
                            <option value="8">Alpha(1.7)</option>
                            <option value="9">Alpha(1.8)</option>
                            <option value="10">Alpha(1.8.1)</option>
                            <option value="11" selected>Alpha(1.9) - Current</option>
                          </select>
                        </label>
          
                        <script>
                          function changePatch(){
                            const beta10= document.getElementById('1');
                            const beta101= document.getElementById('2');
                            const beta12= document.getElementById('3');
                            const beta13= document.getElementById('4');
                            const beta14= document.getElementById('5');
                            const beta15 = document.getElementById('6');
                            const beta16 = document.getElementById('7');
                            const beta17= document.getElementById('8');
                            const beta18= document.getElementById('9');
                            const beta181= document.getElementById('10');
                            const beta19= document.getElementById('11');

                            const selectPatch= document.getElementById('selectPatch');

                            if(selectPatch.value==="1"){
                              beta10.style.display="";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else if(selectPatch.value==="2"){
                              beta10.style.display="none";
                              beta101.style.display="";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else if(selectPatch.value==="3"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else if(selectPatch.value==="4"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else  if(selectPatch.value==="5"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else if(selectPatch.value==="6"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else if(selectPatch.value==="7"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else  if(selectPatch.value==="8"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else if(selectPatch.value==="9"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='';
                              beta181.style.display='none';
                              beta19.style.display='none';
                            }else if(selectPatch.value==="10"){
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='';
                              beta19.style.display='none';
                            }else{
                              beta10.style.display="none";
                              beta101.style.display="none";
                              beta12.style.display="none";
                              beta13.style.display="none";
                              beta14.style.display="none";
                              beta15.style.display="none";
                              beta16.style.display="none";
                              beta17.style.display='none';
                              beta18.style.display='none';
                              beta181.style.display='none';
                              beta19.style.display='';
                            }
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