@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <meta name="theme-color" content="#7e3af2">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator - Generate Report</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <script src="{{asset('dashboard/js/quote.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    @include('administrator/loading_screen', ['location'=>'generate'])
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
            href="{{route('exportData')}}"
          ><span style="text-align: center; font-size:15px">
       {{$admin_username}}
         </span> </a>
       @include('administrator/desktop_nav', ['location'=>'export'])
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
            href="{{route('exportData')}}"
          ><span style="text-align: center; font-size:15px">
        {{$admin_username}}
          </span></a>
       @include('administrator/mobile_nav', ['location'=>'export'])
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
        <h1 id="title" style="text-align: center;" class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Evaluation Data Reports</h1>
        <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">
           Select Types of Data to Export
          </span>
          <select id="typeSelection" onchange="selectType()"
            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
          >
            <option value="evaluation">Evaluation Data Reports </option>
            <option value="user">User Accounts(Teacher, Student, Coordinators)</option>
            <option value="schedule">Class Schedules</option>
          
          </select>
        </label>

        <div id="EvaluationExport" class="grid gap-6 mt-4 mb-8 md:grid-cols-2">
  <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    <i class="fa-solid fa-award" style="font-size: 5rem; float: right;"></i>
    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
      PDF(Evaluation Summary) 
    </h4>
    <img style="width: 10%;"src="{{asset('dashboard/img/pdf.png')}}" alt="pdf">

    
    <p class="text-gray-600 dark:text-gray-400">
      Export report in PDF Documents</p>
      <form method="post" action="{{route('exportPdf')}}">
        @csrf
        @method('post')
        <label class="block mt-4 mb-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Choose data to Export
                </span>
                <select name="teachPDF"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                  <option value="all">All</option>
                  @php
            $teachers=App\Models\Teacher::where('id', '!=', 6)->get();
                  @endphp
                  @foreach($teachers as $teacher)
                  @php
                  if($teacher->teacher_suffix==="none"){
                    $finalSuffix=" ";
                  }else{
                    $finalSuffix= $teacher->teacher_suffix;
                  }
                  @endphp
                  <option value='{{$teacher->id}}'>{{
                    $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ". $teacher->teacher_last_name. " ". $finalSuffix
                  }}</option>
                  @endforeach
             
                </select>
              </label>
              <button type="submit" value="preview" name="action" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              <i class='fa-solid fa-eye'></i> Preview </button>
        <button type="submit" value="download" name="action"  class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <i class="fa-regular fa-circle-down"></i> Download </button>
      </form>
    
  </div>
  

</div>

<div id="userExport" style="display: none" class="grid gap-6 mt-4 mb-8 md:grid-cols-2">
  <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    <i class="fa-solid fa-users" style="float: right; font-size:5rem"></i>
    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
      PDF(User Accounts)
    </h4>
    <img style="width: 10%;" src="{{asset('dashboard/img/pdf.png')}}" alt="pdf">
    <p class="text-gray-600 dark:text-gray-400">
      Export report in PDF Documents</p>
      <form method="post" action="{{route('userPDF')}}">
        @csrf
        @method('post')
        <label class="block mt-4 mb-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Choose data to Export
                </span>
                <select name="userPdf"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                  <option>All</option>
                  <option>Teacher</option>
                  <option>Student</option>
                  <option>Coordinator</option>
                </select>
              </label>
              <button type="submit" value="preview" name="action" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              <i class='fa-solid fa-eye'></i> Preview </button>
        <button type="submit" value="download" name="action"  class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <i class="fa-regular fa-circle-down"></i> Download </button>
      </form>
    
  </div>
  
 
</div>



<div id="classScheduleExport" style="display: none" class="grid mt-4 gap-6 mb-8 md:grid-cols-2">
  
  <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    <i class="fa-regular fa-calendar-days" style="font-size:5rem; float: right;"></i>
    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
      PDF(Class Schedules)
    </h4>
    <img style="width: 10%;" src="{{asset('dashboard/img/pdf.png')}}" alt="pdf">
    <p class="text-gray-600 dark:text-gray-400">
      Export report in PDF Documents</p>
      <form method="post" action="{{route('schedulePdf')}}">
        @csrf
        @method('post')
        <label class="block mt-4 mb-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Choose data to Export
                </span>
                <select name="schedPDF"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                <optgroup label="All">
                  <option>All</option>
                </optgroup>
                
                  @php
                  $strands= App\Models\Strand::where('id', '!=', 7)->get();
                  @endphp
                  @foreach($strands as $strand)
                  <optgroup label="{{$strand->strand_name}}">
                    @php
                    $sections = App\Models\Section::where('strand_id', $strand->id)->get();
                    @endphp
                    @foreach($sections as $section)
                    <option value="{{$section->id}}">{{$strand->strand_shortcut}}-{{$section->year_level}} - {{$section->section}}</option>
                    @endforeach
                  </optgroup>

                  @endforeach
                </select>
              </label>
              <button type="submit" value="preview" name="action" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              <i class='fa-solid fa-eye'></i> Preview </button>
        <button type="submit" value="download" name="action"  class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <i class="fa-regular fa-circle-down"></i> Download </button>
      </form>
    
  </div>
  
  
</div>
<div
class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
>
<h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
  <i class="fa-solid fa-gears"></i> Settings
</h4>
<form method="POST" id="changeSignatureImage" enctype="multipart/form-data">
  @csrf
  @method('post')
  <label class="block text-sm">
    <span class="text-gray-700 dark:text-gray-400">
      Change Signature Image
    </span>
    <div class="relative">
      <input
        type="file"
        name="signature"
        accept="image/png"
        class="block w-full pl-20 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
      />
      <button type="button" @click="openModal"
        class="absolute inset-y-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-l-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
      >
        Upload
      </button>
    </div>
  </label>
</form>
</div>
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
          Needs Admin Password
          </p>
          <!-- Modal description -->
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400"> Password</span>
            <!-- focus-within sets the color for the icon when input is focused -->
            <div
              class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
            >
            <input type="hidden" value="{{App\Models\Admin::where('admin_type', 'Super Admin')->first()->admin_password}}" id="adminPasswordDB">
              <input
                class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                placeholder="Admin Password"
                type="password"
                id="adminPasswordChangeSign"
              />
              <div
                class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
              >
              <i class="fa-solid fa-key"></i>
              </div>
            </div>
          </label>
        </div>
        <footer
          class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
        >
          <button
            @click="closeModal"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
          >
            Cancel
          </button>
          <button type="button" onclick="verifyUser()"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Change
          </button>
        </footer>
      </div>
    </div>
<script>
  function selectType(){

    const EvaluationExport= document.getElementById('EvaluationExport');
    const userExport= document.getElementById('userExport');
    const classScheduleExport= document.getElementById('classScheduleExport');
    const title= document.getElementById('title');
    const typeSelection = document.getElementById('typeSelection');

    if(typeSelection.value==="evaluation"){
      title.textContent="Evaluation Data Reports";
      EvaluationExport.style.display="";
      userExport.style.display="none";
      classScheduleExport.style.display="none";

    }else if(typeSelection.value==="user"){
      title.textContent="User Accounts(Teacher, Student, Coordinators)";
      EvaluationExport.style.display="none";
      userExport.style.display="";
      classScheduleExport.style.display="none";
    }else if(typeSelection.value==="schedule"){
      title.textContent="Class Schedules";
      EvaluationExport.style.display="none";
      userExport.style.display="none";
      classScheduleExport.style.display="";
    }

  }

  function verifyUser(){
    const adminPass = document.getElementById('adminPasswordDB');
    const enterPass = document.getElementById('adminPasswordChangeSign');

    if(adminPass.value === enterPass.value){
      changeSignatureData();
    }else{
      Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "You've Entered an Incorrect Password",

});

enterPass.value="";
    }
  }
  function changeSignatureData() {
    var formData = new FormData($('#changeSignatureImage')[0]); // Create FormData object from the form
    
    $.ajax({
        type: 'POST',
        url: "{{ route('changeSignatureImage') }}",
        data: formData,
        contentType: false, // Set contentType to false when sending FormData
        processData: false, // Set processData to false to prevent jQuery from processing data
        success: function(response) {
            if (response.message === 'success') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Reports Signature Change",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "No Image Found",
                    text: "Please choose an image first before uploading",
                });
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

</script>
        
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