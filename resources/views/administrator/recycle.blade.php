@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Perfometrics Recycle Bin</title>
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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>

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
.restoreButton{
    background-color: #0e9f6e;
}
.restoreButton:hover{
    background-color:#014737; 
}
.buttonDelete{
    background-color:#f05252; 
}
.buttonDelete:hover{
    background-color:#9b1c1c; 
}
.selected {
    background-color: #7e3af2;
    color: white;
  }

  tr{
    cursor: pointer;
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
               
              <a
                class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800  dark:hover:text-gray-200"
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
                  class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
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
                <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
                <a
                  class="inline-flex items-center text-gray-800 w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100""
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
              
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
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
                  class="inline-flex items-center  w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
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
                <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
                <a
                  class="inline-flex items-center text-gray-800 w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
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
         

        </header>
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
           Recycle Bin
            </h2>
             <form id="deleteAllUser" method="post">
              @csrf
              @method('post')
             </form>
            <div class="flex w-full px-4 gap-6 justify-end">
              <button onclick="returnFunction()"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
              <i class="fa-solid fa-circle-arrow-left"></i>  Return 
              </button>
              <button onclick="ConfirmDeleteAll()"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
              <i class="fa-solid fa-trash-can"></i> Delete All 
              </button>
            </div>

          <script>
            function returnFunction(){
window.location = "{{ route('logs') }}";
}
</script>
          </script>
            <label class="block text-sm mb-4">
                <span class="text-gray-700 dark:text-gray-400">
                  Filter
                </span>
                <select id="filter" onchange="filterUser(this)"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                  <option selected>All</option>
                  <option>Student</option>
                  <option>Teacher</option>
                  <option>Coordinator</option>
                </select>
              </label>
              
            <div class="w-full border border-solid" style="height: 50vh; position: relative; overflow: hidden;">
                <div style="overflow-y: auto; max-height: 100%;">
                  <table class="w-full" style="table-layout: fixed; border-collapse: collapse;">
                    <colgroup>
                      <col style="width:50%;">
                      <col style="width:10%;">
                      <col style="width: 10%;">
                      <col style="width: 30%;">
                    </colgroup>
                    <thead class="text-gray-700 dark:text-gray-700" style="background-color: #d5d6d7; position: sticky; top: 0; z-index: 1;">
                      <th class="border border-solid" style="border: 2px solid #000;">Name</th>
                      <th class="border border-solid" style="border: 2px solid #000;">Evaluation Data/Analytics</th>
                      <th class="border border-solid" style="border: 2px solid #000;">Type</th>
                      <th class="border border-solid" style="border: 2px solid #000;">Date Deleted</th>
                    </thead>
                    <tbody id="logContainer">
                    </tbody>
                  </table>
                </div>
              </div>

              <form method="post" class="w-full justify-between mt-8" style="display: none;" id="actionButton">
                @csrf
                @method('post')
                <input type="hidden" id="deletedId" name="id">
                <input type="hidden" id="deletedType" name="type">
                <div style="width: 49%">
                 <button type="button" onclick="showRestoreConfirmation()"
                 class="restoreButton px-4 w-full py-2 text-base font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
               >
               <i class="fa-solid fa-rotate-left"></i> Restore
               </button>
                </div>
                <div style="width: 49%">
                 <button type="button" onclick="confirmPermDelete()"
                 class="buttonDelete px-4 w-full py-2 text-base font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
               >
               <i class="fa-solid fa-trash"></i> Permanently Delete
               </button>
                </div>
            </form>

              <script>
             function filterUser(select){
          if(select.value==='All'){
            axiosFetch('All');
          }else if(select.value==='Student'){
            axiosFetch('Student');
          }else if(select.value==='Teacher'){
            axiosFetch('Teacher');
          }else{
            axiosFetch('Coordinator');
          }
         }

  window.addEventListener('load', function () {
      axiosFetch("All");

    });
               

    function selectTR(tr, id, type){
        const rows = document.querySelectorAll('#logContainer tr');
        const rowId = document.getElementById('deletedId');
        const rowType = document.getElementById('deletedType');
        const button = document.getElementById('actionButton');
    rows.forEach((row) => {
      row.classList.remove('selected');
    });
       button.style.display='flex';
        tr.classList.add('selected');
        rowId.value=id;
        rowType.value=type;
    }
               
 function axiosFetch(select){
    const container= document.getElementById('logContainer');
    container.innerHTML ='';
    if(select==="All"){
        var url = "{{route('fetchDeletedUser')}}";
    }else if(select==='Student'){
        var url = "{{route('fetchDeletedStudent')}}";
    }else if(select==='Teacher'){
        var url = "{{route('fetchDeletedTeacher')}}";
    }else{
        var url = "{{route('fetchDeletedCoordinator')}}";
    }
    axios.get(url)
        .then(function (response) {
            var data = response.data;
            const tbody = document.getElementById('logContainer');
            data.forEach(function(item) {
              if(item.fullname=== 'empty' && item.type === 'empty' && item.evaluationCount==='empty' && item.id === 'empty' && item.date==='empty'){
                const newRow1 = document.createElement('tr');
newRow1.className = 'text-gray-600 text-center dark:text-gray-400';

// Create the <td> elements for the new row
const td1 = document.createElement('td');
td1.className = 'border border-solid text-6xl';
td1.colSpan = 4; 
td1.innerHTML = '<i class="fa-solid fa-person-circle-question"></i>';

newRow1.appendChild(td1);

tbody.appendChild(newRow1);
const newRow2= document.createElement('tr');
newRow2.className = 'text-gray-600 text-center dark:text-gray-400';

// Create the <td> elements for the new row
  const td2 = document.createElement('td');
td2.className = 'border border-solid text-6xl';
td2.colSpan = 4; 
td2.textContent = 'No Data Found?';

newRow2.appendChild(td2);

tbody.appendChild(newRow2);
              }else{
                const newRow = document.createElement('tr');
newRow.className = 'text-gray-600 text-center dark:text-gray-400';
newRow.setAttribute('onclick', 'selectTR(this," '+item.id+'", "'+item.type+'")'); 

// Create the <td> elements for the new row
const td1 = document.createElement('td');
td1.className = 'border border-solid';
td1.style.borderRight = '2px solid #000';
td1.style.borderLeft = '2px solid #000';
td1.textContent = item.fullname;

const td2 = document.createElement('td');
td2.className = 'border border-solid';
td2.style.borderRight = '2px solid #000';
td2.textContent = item.evaluationCount;

const td3 = document.createElement('td');
td3.className = 'border border-solid ';
td3.style.padding = '5px';
td3.style.borderRight = '2px solid #000';
td3.textContent = item.type;

const td4 = document.createElement('td');
td4.className = 'border border-solid';
td4.style.padding = '5px';
td4.style.borderRight = '2px solid #000';
td4.textContent = item.date;

// Append the <td> elements to the <tr> element
newRow.appendChild(td1);
newRow.appendChild(td2);
newRow.appendChild(td3);
newRow.appendChild(td4);

// Append the new <tr> element to the <tbody>
tbody.appendChild(newRow);
              }

            });
   

        })
       .catch(function (error) {
        console.error(error);
        });
 }
  
 function deselectAllRows() {
    const button = document.getElementById('actionButton');
  const rows = document.querySelectorAll('#logContainer tr');
  rows.forEach((row) => {
    row.classList.remove('selected');
  });
  button.style.display='none';
}
document.addEventListener('click', (e) => {
  const isInsideTable = document.getElementById('logContainer').contains(e.target);
  if (!isInsideTable) {
    deselectAllRows();
  }
});

function confirmPermDelete(){
    Swal.fire({
    title: 'Are you sure?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel',
  }).then((result) => {
    if (result.isConfirmed) {
        DeleteUserPermanently();
      //Swal.fire('Deleted!', 'The item has been deleted.', 'success');
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire('Cancelled', 'The item is not deleted.', 'info');
    }
  });
}

function showRestoreConfirmation() {
  Swal.fire({
    title: 'Restore Data?',
    text: 'Are you sure you want to restore this User?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, restore it',
    cancelButtonText: 'No, cancel',
  }).then((result) => {
    if (result.isConfirmed) {
        RestoreUser();
      //Swal.fire('Restored!', 'The data item has been restored.', 'success');
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire('Cancelled', 'The item is not restored.', 'info');
    }
  });
}

function DeleteUserPermanently() {
     var formData = $('form#actionButton').serialize();
 
     $.ajax({
         type: 'POST',
         url:"{{route('deleteUserPermanently')}}",
         data: formData,
         success: function(response) {
           if(response.message==='Success'){
            Swal.fire({
  title: "User Deleted",
  text: "Successfully deleted user permanently",
  icon: "success"
});
            axiosFetch('All');
           }
         },
         error: function (xhr) {
             console.log(xhr.responseText);
         }
     });
 }
 
 function RestoreUser() {
     var formData = $('form#actionButton').serialize();
 
     $.ajax({
         type: 'POST',
         url:"{{route('restoreUser')}}",
         data: formData,
         success: function(response) {
          if(response.message==='Success'){
            Swal.fire({
  title: "User Restored",
  text: "Successfully Restore User",
  icon: "success"
});
            axiosFetch('All');
           }
         },
         error: function (xhr) {
             console.log(xhr.responseText);
         }
     });
 }

function ConfirmDeleteAll(){
  Swal.fire({
    title: 'Delete all user? ',
    text: 'Are you sure you want to delete all deleted this User?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it',
    cancelButtonText: 'No, cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      DeleteAllDeletedUser();
      //Swal.fire('Restored!', 'The data item has been restored.', 'success');
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire('Cancelled', 'The item is not restored.', 'info');
    }
  });
}

  
 function DeleteAllDeletedUser() {
     var formData = $('form#deleteAllUser').serialize();
 
     $.ajax({
         type: 'POST',
         url: "{{route('deleteAllUserPermanently')}}",
         data: formData,
         success: function(response) {
          if(response.message==='success'){
            const container= document.getElementById('logContainer');
          container.innerHTML ='';
          const newRow1 = document.createElement('tr');
newRow1.className = 'text-gray-600 text-center dark:text-gray-400';

// Create the <td> elements for the new row
const td1 = document.createElement('td');
td1.className = 'border border-solid text-6xl';
td1.colSpan = 4; 
td1.innerHTML = '<i class="fa-solid fa-person-circle-question"></i>';

newRow1.appendChild(td1);

container.appendChild(newRow1);
const newRow2= document.createElement('tr');
newRow2.className = 'text-gray-600 text-center dark:text-gray-400';

// Create the <td> elements for the new row
  const td2 = document.createElement('td');
td2.className = 'border border-solid text-6xl';
td2.colSpan = 4; 
td2.textContent = 'No Data Found?';

newRow2.appendChild(td2);

container.appendChild(newRow2);
          Swal.fire({
            title: 'Successfully Deleted',
            text: 'All Users has been successfully deleted permanently!',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
          }
         },
         error: function (xhr) {
             console.log(xhr.responseText);
         }
     });
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