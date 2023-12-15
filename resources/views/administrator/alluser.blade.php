@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Users-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/alluser.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
  </head>
  <style>
    .resultOfSearch{
      cursor: pointer;
    }
    .resultOfSearch:hover{
      background-color:#d9d9d9;
    }
  </style>
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
@include('administrator/loading_screen', ['location' => 'all_user'])
<div id="submitting" style="display: none;" class="loading">Loading&#8230;</div>
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
            href="{{route('allUser')}}"
          ><span style="text-align: center; font-size:15px">
          {{$admin_username}}
         </span> </a>
       @include('administrator/desktop_nav', ['location'=> 'all_user'])
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
            href="{{route('allUser')}}"
          ><span style="text-align: center; font-size:15px">
         {{$admin_username}}
        </span>  </a>
        @include('administrator/mobile_nav', ['location'=>'all_user'])
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
                <div class="absolute inset-y-0 flex items-center pl-2">
                  <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input type="hidden" id="searchFilter" value="1">
                <input
                  oninput="showSearchResult(this)"
                  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text"
                  placeholder="Search for Users"
                  aria-label="Search"
                />
                
              </div>
              <button
              type="button" onclick="batchModal('filter')" @click="openModal"
              class="rounded-md focus:outline-none focus:shadow-outline-purple"
              aria-label="Toggle color mode">
             
              <i class="fa-solid fa-sliders"></i>
            </button>
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
           
          <div id="searchResults" style="display: none;" class="searchResults dark:bg-black" >
            <h4
            class=" text-lg mt-8 ml-4 font-semibold text-gray-600 dark:text-gray-600"
          >
            Search Result for "<span id="searchInput"></span>"  <span id="spanFilter"></span>
          </h4>
            <div style="width:100%;" id="searchResultDiv">
                
            </div>
      
          </div>

         
            <div class="mt-4 text-sm mb-8 ">
              <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                All Users
              </span>
              <div class="mt-2 w-full flex ">
                <label
                  class="inline-flex items-center text-gray-600 dark:text-gray-400"
                >
                  <input
                    type="radio"
                    class="text-purple-600 text-base form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="userType"
                    value="student"
                    checked
                   
                    onchange="userTypeChange()"
                  />
                  <span class="ml-2 text-xl">Student</span>
                </label>
                <label
                  class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400"
                >
                  <input
                    type="radio"
                    class="text-purple-600 text-base form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="userType"
                    value="teacher"
                  
                    onchange="userTypeChange()"
                  />
                  <span class="ml-2 text-xl" >Teacher</span>
                </label>
                <label
                class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400"
              >
                <input
                  type="radio"
                  class="text-purple-600 text-base form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  name="userType"
                  value="coordinator"
                
                  onchange="userTypeChange()"
                />
                <span class="ml-2 text-xl">Coordinator</span>
              </label>
              </div>
            </div>

        
<div id="studentTable">
  @php
  $allStrands = App\Models\Strand::where('id', '!=', 7)->get();
@endphp
  <div class="w-full flex justify-center">
    
<label class="block  text-sm">
  <span class="text-gray-700 dark:text-gray-400">
   Filter Strands
  </span>
  <select onchange="selectStrand()" id="selectionStrand"
    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
  >
    <option>All</option>
    @foreach ($allStrands as $strand)
        <option value="{{$strand->strand_shortcut}}">{{$strand->strand_name}}</option>
    @endforeach
    
  </select>
</label>


    </div>
   
   @php
    $studDeleteForm = 1;
    $s=1;
   @endphp
    @foreach ($allStrands as $strand)
    <div id="strandDiv_{{$strand->strand_shortcut}}" style="display: block;" >
      <hr class="mb-4 mt-4">
    <h4
    class="mb-4 text-lg mt-8 text-center font-semibold text-gray-600 dark:text-gray-300"
  >
    {{$strand->strand_name}}
  </h4>
  <div class="flex">
    <div class="w-full overflow-hidden rounded-lg shadow-xs"  id="tableStudent11{{$studDeleteForm}}" style="height: 70vh; position: relative; overflow: hidden;">
      <div class="w-full overflow-x-auto" style="overflow-y: auto; max-height: 100%;">
        <table class="w-full h-full" style="table-layout: fixed; border-collapse: collapse;">
          <thead>
            <colgroup>
              <col style="width: 45%;"> <!-- First column width is set to 100px -->
              <col style="width: 35%;"> <!-- Second column width is set to 150px -->
              <col style="width: 20%;"> <!-- Third column width is set to 200px -->
            </colgroup>
            <tr
            style="position: sticky; top: 0; z-index: 1;"
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
           
              <th class="px-4 py-3">Student Name</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Year(11)</th>
             
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
  @php
  
  $students= App\Models\Student::where('student_strand', $strand->id)->where('student_year_level', 'Grade 11')->get();
 
  
  @endphp
  
  @if ($students->isNotEmpty())
  @php
  $sortedStudents = $students->sortBy('student_last_name');
  @endphp
  @foreach($sortedStudents as $student)
  @php
  $firstName= $student->student_first_name;
  $lastName= $student->student_last_name;
  $middleName= $student->student_middle_name;
  $suffix= $student->student_suffix;
  if($suffix==="none"){
  $finalSuffix=" ";
  }else{
  $finalSuffix= $suffix;
  }
  $fullname= $lastName. ", ". $firstName. " ". $middleName. " ". $finalSuffix;
  
  
  if($student->student_image===1){
  $profilePic= asset('Users/Student('.$student->id.").". $student->student_image_type );
  }else{
  $profilePic= asset('Users/ph.jpg');
  }
  @endphp
  <tr style="cursor:pointer" onclick="editStudent{{$s}}()" class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3"><div class="flex items-center text-sm">     
  <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block"><img class="object-cover w-full h-full rounded-full" src="{{$profilePic}}"/> 
  <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div><div><p class="font-semibold">{{$fullname}}</p>  
  <p class="text-xs text-gray-600 dark:text-gray-400">Student</p></div></div></td>
  <td class="px-4 py-3 text-xs">
  @if ($student->student_status===1)
  <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
  @else
  <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
  @endif   
  <td class="px-4 py-3 text-sm">{{$student->student_year_level}}</td>      
  </td>
  </tr>
  
  <script>
  function editStudent{{$s}}(){
  const student_id = '{{$student->student_id}}';
  window.location.href= "{{route('editStudent')}}?student_id="+student_id;
  }

  </script>

@php $s++ @endphp

  @endforeach
  @else
  
  <tr class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3 text-center text-gray-400" colspan="5"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>
  
  </tr>
  <tr class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3 text-center" colspan="5">No Student Registered</td>
  
  </tr>
  @endif
              
              
              </tbody>
        </table>
      </div>

    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs"  id="tableStudent12{{$studDeleteForm}}" style="height: 70vh; position: relative; overflow: hidden;">
      <div class="w-full overflow-x-auto"  style="overflow-y: auto; max-height: 100%;">
        <table class="w-full h-full" style="table-layout: fixed; border-collapse: collapse;">
          <thead>
            <colgroup>
              <col style="width: 45%;"> <!-- First column width is set to 100px -->
              <col style="width: 35%;"> <!-- Second column width is set to 150px -->
              <col style="width: 20%;"> <!-- Third column width is set to 200px -->
            </colgroup>
            <tr
            style="position: sticky; top: 0; z-index: 1;"
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
           
              <th class="px-4 py-3">Student Name</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Year(12)</th>
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 "
          >
  @php
  
  $students= App\Models\Student::where('student_strand', $strand->id)->where('student_year_level', 'Grade 12')->get();

  
  
  @endphp
  
  @if ($students->isNotEmpty())
  @php
  $sortedStudents = $students->sortBy('student_last_name');
  @endphp
  @foreach($sortedStudents as $student)
  @php
  $firstName= $student->student_first_name;
  $lastName= $student->student_last_name;
  $middleName= $student->student_middle_name;
  $suffix= $student->student_suffix;
  if($suffix==="none"){
  $finalSuffix=" ";
  }else{
  $finalSuffix= $suffix;
  }
  $fullname= $lastName. ", ". $firstName. " ". $middleName. " ". $finalSuffix;
  
  
  if($student->student_image===1){
  $profilePic= asset('Users/Student('.$student->id.").". $student->student_image_type );
  }else{
  $profilePic= asset('Users/ph.jpg');
  }
  @endphp
  <tr style="cursor:pointer" onclick="editStudent{{$s}}()" class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3"><div class="flex items-center text-sm">     
  <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block"><img class="object-cover w-full h-full rounded-full" src="{{$profilePic}}"/> 
  <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div><div><p class="font-semibold">{{$fullname}}</p>  
  <p class="text-xs text-gray-600 dark:text-gray-400">Student</p></div></div></td>
  <td class="px-4 py-3 text-xs">
  @if ($student->student_status===1)
  <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
  @else
  <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
  @endif         
  </td><td class="px-4 py-3 text-sm">{{$student->student_year_level}}</td>
  </tr>
  <script>
  function editStudent{{$s}}(){
  const student_id = '{{$student->student_id}}';
  window.location.href= "{{route('editStudent')}}?student_id="+student_id;
  }
  </script>
  @php $s++ @endphp

  @endforeach
  @else
  
  <tr class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3 text-center text-gray-400" colspan="5"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>
  
  </tr>
  <tr class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3 text-center" colspan="5">No Student Registered</td>
  
  </tr>
  @endif
              
              
              </tbody>
        </table>
      </div>
     
    </div>
  </div>
  <form action="{{route('deleteBatchStudent')}}" method="post" id="deletionFormStudent{{$studDeleteForm}}" style="display: none">
  @csrf
  @method('post')
   <div class="flex">
    <div class="w-full overflow-hidden rounded-lg shadow-xs" style="height: 70vh; position: relative; overflow: hidden;">
      <div class="w-full overflow-x-auto" style="overflow-y: auto; max-height: 100%;">
        <table class="w-full " style="table-layout: fixed; border-collapse: collapse;">
          <thead>
            <colgroup>
              <col style="width: 5%;">
              <col style="width: 40%;"> <!-- First column width is set to 100px -->
              <col style="width: 35%;"> <!-- Second column width is set to 150px -->
              <col style="width: 20%;"> <!-- Third column width is set to 200px -->
            </colgroup>
            <tr
            style="position: sticky; top: 0; z-index: 1;"
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
            <th class="px-4 py-3"><i class="fa-solid fa-trash-can"></i></th>
              <th class="px-4 py-3">Student Name</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Year(11)</th>
             
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
@php

$students= App\Models\Student::where('student_strand', $strand->id)->where('student_year_level', 'Grade 11')->get();

@endphp

@if ($students->isNotEmpty())
@php
 $sortedStudents = $students->sortBy('student_last_name');
@endphp
@foreach($sortedStudents as $student)
@php
$firstName= $student->student_first_name;
$lastName= $student->student_last_name;
$middleName= $student->student_middle_name;
$suffix= $student->student_suffix;
if($suffix==="none"){
$finalSuffix=" ";
}else{
$finalSuffix= $suffix;
}
$fullname= $lastName. ", ". $firstName. " ". $middleName. " ". $finalSuffix;


if($student->student_image===1){
$profilePic= asset('Users/Student('.$student->id.").". $student->student_image_type );
}else{
$profilePic= asset('Users/ph.jpg');
}
@endphp
<tr class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3 text-sm"><input type="checkbox" name="deleteStudent[]" value="{{$student->id}}"></td>
  <td class="px-4 py-3"><div class="flex items-center text-sm">     
<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block"><img class="object-cover w-full h-full rounded-full" src="{{$profilePic}}"/> 
<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div><div><p class="font-semibold">{{$fullname}}</p>  
<p class="text-xs text-gray-600 dark:text-gray-400">Student</p></div></div></td>
<td class="px-4 py-3 text-xs">
@if ($student->student_status===1)
<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
@else
<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
@endif         
</td><td class="px-4 py-3 text-sm">{{$student->student_year_level}}</td>
</tr>

  @endforeach
@else

<tr class="text-gray-700 dark:text-gray-400">
<td class="px-4 py-3 text-center text-gray-400" colspan="6"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>

</tr>
<tr class="text-gray-700 dark:text-gray-400">
<td class="px-4 py-3 text-center" colspan="6">No Student Registered</td>

</tr>
@endif
              
              
              </tbody>
        </table>
      </div>
      
    </div>
  
    <div class="w-full overflow-hidden rounded-lg shadow-xs" style="height: 70vh; position: relative; overflow: hidden;">
      <div class="w-full overflow-x-auto" style="overflow-y: auto; max-height: 100%;">
        <table class="w-full " style="table-layout: fixed; border-collapse: collapse;">
          <thead>
            <colgroup>
              <col style="width: 5%;">
              <col style="width: 40%;"> <!-- First column width is set to 100px -->
              <col style="width: 35%;"> <!-- Second column width is set to 150px -->
              <col style="width: 20%;"> <!-- Third column width is set to 200px -->
            </colgroup>
            <tr
            style="position: sticky; top: 0; z-index: 1;"
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
            <th class="px-4 py-3"><i class="fa-solid fa-trash-can"></i></th>
              <th class="px-4 py-3">Student Name</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Year(12)</th>
             
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
@php

$students= App\Models\Student::where('student_strand', $strand->id)->where('student_year_level', 'Grade 12')->get();

@endphp

@if ($students->isNotEmpty())
@php
 $sortedStudents = $students->sortBy('student_last_name');
@endphp
@foreach($sortedStudents as $student)
@php
$firstName= $student->student_first_name;
$lastName= $student->student_last_name;
$middleName= $student->student_middle_name;
$suffix= $student->student_suffix;
if($suffix==="none"){
$finalSuffix=" ";
}else{
$finalSuffix= $suffix;
}
$fullname= $lastName. ", ". $firstName. " ". $middleName. " ". $finalSuffix;


if($student->student_image===1){
$profilePic= asset('Users/Student('.$student->id.").". $student->student_image_type );
}else{
$profilePic= asset('Users/ph.jpg');
}
@endphp
<tr class="text-gray-700 dark:text-gray-400">
  <td class="px-4 py-3 text-sm"><input type="checkbox" name="deleteStudent[]" value="{{$student->id}}"></td>
  <td class="px-4 py-3"><div class="flex items-center text-sm">     
<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block"><img class="object-cover w-full h-full rounded-full" src="{{$profilePic}}"/> 
<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div><div><p class="font-semibold">{{$fullname}}</p>  
<p class="text-xs text-gray-600 dark:text-gray-400">Student</p></div></div></td>
<td class="px-4 py-3 text-xs">
@if ($student->student_status===1)
<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
@else
<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
@endif         
</td><td class="px-4 py-3 text-sm">{{$student->student_year_level}}</td>
</tr>


  @endforeach
@else

<tr class="text-gray-700 dark:text-gray-400">
<td class="px-4 py-3 text-center text-gray-400" colspan="6"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>

</tr>
<tr class="text-gray-700 dark:text-gray-400">
<td class="px-4 py-3 text-center" colspan="6">No Student Registered</td>

</tr>
@endif
              
              
              </tbody>
        </table>
      </div>
      
    </div>
   


   </div>
   <div class="w-full flex justify-end mt-8">
    <button style="float: right" type="button" onclick="selectAllDeleteStudent(this)"
    class="px-4  py-2 text-sm mb-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  >
  <i class="fa-solid fa-check-to-slot"></i> Select All
  </button>
        <button  type="submit"
      class="px-4  py-2 text-sm mb-4 ml-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
    >
    <i class="fa-solid fa-trash-can"></i> Delete All
    </button>
    
      </div>
  </form>
    
       <hr class="mb-4 mt-4">
    </div>
    @php
        $studDeleteForm++;
    @endphp
   
    @endforeach
    <script>
      let finalFormDeleteStudent = {{$studDeleteForm}};
    </script>
    <button id="fab_menu_student"  class="fab_menu"  type="button" onclick="openMenu('fab_menu_student_add', 'fab_menu_student_addBatch','fab_menu_student_deleteBatch')">
      <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3,18h13v-2L3,16v2zM3,13h10v-2L3,11v2zM3,6v2h13L16,6L3,6zM21,15.59L17.42,12 21,8.41 19.59,7l-5,5 5,5L21,15.59z"></path>
      </svg>
    </button>

    <button id="fab_menu_student_add"  class="fab_option_add" type="button" onclick="student()">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13,8c0,-2.21 -1.79,-4 -4,-4S5,5.79 5,8s1.79,4 4,4S13,10.21 13,8zM15,10v2h3v3h2v-3h3v-2h-3V7h-2v3H15zM1,18v2h16v-2c0,-2.66 -5.33,-4 -8,-4S1,15.34 1,18z"></path>
      </svg>
    </button>
    <button id="fab_menu_student_addBatch"  class="fab_option_addBatch" type="button" @click= "openModal" onclick="batchModal('student')">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.27,12h3.46c0.93,0 1.63,-0.83 1.48,-1.75l-0.3,-1.79C14.67,7.04 13.44,6 12,6S9.33,7.04 9.09,8.47l-0.3,1.79C8.64,11.17 9.34,12 10.27,12z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.66,11.11c-0.13,0.26 -0.18,0.57 -0.1,0.88c0.16,0.69 0.76,1.03 1.53,1c0,0 1.49,0 1.95,0c0.83,0 1.51,-0.58 1.51,-1.29c0,-0.14 -0.03,-0.27 -0.07,-0.4c-0.01,-0.03 -0.01,-0.05 0.01,-0.08c0.09,-0.16 0.14,-0.34 0.14,-0.53c0,-0.31 -0.14,-0.6 -0.36,-0.82c-0.03,-0.03 -0.03,-0.06 -0.02,-0.1c0.07,-0.2 0.07,-0.43 0.01,-0.65C6.1,8.69 5.71,8.4 5.27,8.38c-0.03,0 -0.05,-0.01 -0.07,-0.03C5.03,8.14 4.72,8 4.37,8C4.07,8 3.8,8.1 3.62,8.26C3.59,8.29 3.56,8.29 3.53,8.28c-0.14,-0.06 -0.3,-0.09 -0.46,-0.09c-0.65,0 -1.18,0.49 -1.24,1.12c0,0.02 -0.01,0.04 -0.03,0.06c-0.29,0.26 -0.46,0.65 -0.41,1.05c0.03,0.22 0.12,0.43 0.25,0.6C1.67,11.04 1.67,11.08 1.66,11.11z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.24,13.65c-1.17,-0.52 -2.61,-0.9 -4.24,-0.9c-1.63,0 -3.07,0.39 -4.24,0.9C6.68,14.13 6,15.21 6,16.39V18h12v-1.61C18,15.21 17.32,14.13 16.24,13.65z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.22,14.58C0.48,14.9 0,15.62 0,16.43V18l4.5,0v-1.61c0,-0.83 0.23,-1.61 0.63,-2.29C4.76,14.04 4.39,14 4,14C3.01,14 2.07,14.21 1.22,14.58z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22.78,14.58C21.93,14.21 20.99,14 20,14c-0.39,0 -0.76,0.04 -1.13,0.1c0.4,0.68 0.63,1.46 0.63,2.29V18l4.5,0v-1.57C24,15.62 23.52,14.9 22.78,14.58z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22,11v-0.5c0,-1.1 -0.9,-2 -2,-2h-2c-0.42,0 -0.65,0.48 -0.39,0.81l0.7,0.63C18.12,10.25 18,10.61 18,11c0,1.1 0.9,2 2,2S22,12.1 22,11z"></path>
      </svg>
    </button>
    <button id="fab_menu_student_deleteBatch"  class="fab_option_delete" type="button" onclick="deleteBatchStudent()">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6,19c0,1.1 0.9,2 2,2h8c1.1,0 2,-0.9 2,-2V7H6v12zM19,4h-3.5l-1,-1h-5l-1,1H5v2h14V4z"></path>
      </svg>
    </button>

    <button id="fab_menu_student_cancelDelete" style="display:none;"  class="fab_option_delete" type="button" onclick="cancelDeleteStudent()">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12,2C6.47,2 2,6.47 2,12s4.47,10 10,10 10,-4.47 10,-10S17.53,2 12,2zM17,15.59L15.59,17 12,13.41 8.41,17 7,15.59 10.59,12 7,8.41 8.41,7 12,10.59 15.59,7 17,8.41 13.41,12 17,15.59z"></path>
      </svg>
    </button>
   
</div>
<script>
  console.log(finalFormDeleteStudent+ "Final");
  function selectStrand() {
    var selectionStrand = document.getElementById('selectionStrand');
    var selectedValue = selectionStrand.value;  // Get the selected value
    
    // Hide all divs first
    var allDivs = document.querySelectorAll('[id^="strandDiv_"]');
    allDivs.forEach(function(div) {
      div.style.display = "none";
    });
    
    // Show the selected div
    var selectedDiv = document.getElementById('strandDiv_' + selectedValue);
    if (selectedDiv) {
      selectedDiv.style.display = "block";
    }else if(selectedValue=="All"){
      allDivs.forEach(function(div) {
      div.style.display = "block";
    });
    }
  }

  function deleteBatchStudent(){
       
    for(let i = 1; i< finalFormDeleteStudent; i++){
      const table11 = document.getElementById('tableStudent11'+i);
      const table12 = document.getElementById('tableStudent12'+i);
      const formDelete= document.getElementById('deletionFormStudent'+i);

      table11.style.display= "none";
      table12.style.display= "none";
      formDelete.style.display= "";
    const cancelDelete = document.getElementById('fab_menu_student_cancelDelete');
    const button = document.getElementById('fab_menu_student_deleteBatch');
    cancelDelete.style.display= 'flex';
    button.style.display= "none";
   console.log(i+'Increment');
    }

  }

  function cancelDeleteStudent(){
    const deleteButton = document.getElementById('fab_menu_student_deleteBatch');
    for(let i = 1; i< finalFormDeleteStudent; i++){
      const table11 = document.getElementById('tableStudent11'+i);
      const table12 = document.getElementById('tableStudent12'+i);
      const formDelete= document.getElementById('deletionFormStudent'+i);

      table11.style.display= "";
      table12.style.display= "";
      formDelete.style.display= "none";
      const cancelDelete = document.getElementById('fab_menu_student_cancelDelete');
    const button = document.getElementById('fab_menu_student_deleteBatch');
    cancelDelete.style.display= 'none';
    button.style.display= "flex";
    }

   
  }
 
  let selectButton=0;

  function selectAllDeleteStudent(button){
     selectButton++;

     if (selectButton % 2 ===0){
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      button.innerHTML = '<i class="fa-solid fa-check-to-slot"></i> Select All';
// Iterate through the NodeList and set the "checked" property to true for each checkbox
for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = false;
}
     }else{
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
     button.innerHTML= '<i class="fa-solid fa-circle-xmark"></i> Unselect All'
// Iterate through the NodeList and set the "checked" property to true for each checkbox
for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = true;
}
     }
  }
</script>


                
<div id="teacherTable" style="display:none;">
  
    
                          <div id="tableTeacher">
                            <div class="w-full overflow-hidden rounded-lg shadow-xs" style="height: 70vh; position: relative; overflow: hidden;">
                              <div class="w-full overflow-x-auto" style="overflow-y: auto; max-height: 100%;">
                                <table class="w-full whitespace-no-wrap" style="table-layout: fixed; border-collapse: collapse;">
                                  <colgroup>
                                    <col style="width: 45%;"> <!-- First column width is set to 100px -->
                                    <col style="width: 35%;"> <!-- Second column width is set to 150px -->
                                    <col style="width: 20%;"> <!-- Third column width is set to 200px -->
                                  </colgroup>
                                  <thead>
                                    <tr    style="position: sticky; top: 0; z-index: 1;"
                                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                                    >
                                      <th class="px-4 py-3">Teacher</th>
                                      <th class="px-4 py-3">Username</th>
                                      <th class="px-4 py-3">Status</th>
                                   
                                    </tr>
                                  </thead>
                                  <tbody
                                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                                  >
                
                
                                  @php 
                                  $teachers= App\Models\Teacher::where('teacher_username', '!=', 'NULL')->get();
                                  $t=1;
                                
                                  @endphp
                                  @if ($teachers->isNotEmpty())
                                      @php
                                          $teachersSorted = $teachers->sortBy('teacher_last_name');
                                      @endphp
                                  @foreach($teachersSorted as $teacher)
                                  @php
                                   $firstNameTeacher= $teacher->teacher_first_name;
                                   $lastNameTeacher= $teacher->teacher_last_name;
                                   $middleNameTeacher= $teacher->teacher_middle_name;
                                   $suffixTeacher= $teacher->teacher_suffix;
                                   
                                   if($suffixTeacher==="none"){
                                    $suffixTeacherFinal= " ";
                                   }else{
                                    $suffixTeacherFinal=$suffixTeacher;
                                   }
                
                                   if($teacher->teacher_image===1){
                 $profilePic= asset('Users/Teacher('.$teacher->id.").". $teacher->teacher_image_type );
                }else{
                 $profilePic= asset('Users/ph.jpg');
                }
                                   $TeacherFullName= $lastNameTeacher. ", ". $firstNameTeacher. " ". $middleNameTeacher. " ". $suffixTeacherFinal;
                                  @endphp
                                  <tr style="cursor: pointer" onclick="editTeacher{{$t}}()" class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full" src="{{ $profilePic }}" alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $TeacherFullName }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">Teacher</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ $teacher->teacher_username }}</td>
                                    <td class="px-4 py-3 text-xs">
                                      @if ($teacher->teacher_status===1)
                                      <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
                                      @else
                                      <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
                                      @endif         
                                    </td>
                                   <script>
                                    function editTeacher{{ $t }}(){
                                      const teacher_id= {{$teacher->id}};
                                      window.location.href= "{{route('editTeacher')}}?teacher_id="+teacher_id;
                                    }
                                   </script>
                                </tr>
                                @php $t++ @endphp
                                  @endforeach
                 
                                  @else
                                  <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-center text-gray-400" colspan="3"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>
                                    
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-center" colspan="3">No Teachers Registered</td>
                                    
                                    </tr>
                                  @endif
                                  </tbody>
                                </table>
                              </div>
                              
                            </div>
                          </div>

                          <form action="{{route('deleteBatchTeacher')}}" method="post" id="deletionFormTeacher" style="display: none">
                            @csrf
                            @method('post')
                            <div class="w-full overflow-hidden rounded-lg shadow-xs" style="height: 70vh; position: relative; overflow: hidden;">
                              <div class="w-full overflow-x-auto" style="overflow-y: auto; max-height: 100%;">
                                <table class="w-full whitespace-no-wrap" style="table-layout: fixed; border-collapse: collapse;">
                                  <thead>
                                    <colgroup>
                                      <col style="width: 5%;">
                                      <col style="width: 40%;"> <!-- First column width is set to 100px -->
                                      <col style="width: 35%;"> <!-- Second column width is set to 150px -->
                                      <col style="width: 20%;"> <!-- Third column width is set to 200px -->
                                    </colgroup>
                                    <tr   style="position: sticky; top: 0; z-index: 1;"
                                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                                    >
                                    <th class="px-4 py-3"><i class="fa-solid fa-trash-can"></i></th>
                                      <th class="px-4 py-3">Teacher</th>
                                      <th class="px-4 py-3">Username</th>
                                      <th class="px-4 py-3">Status</th>
                                   
                                    </tr>
                                  </thead>
                                  <tbody
                                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                                  >
                
                
                                  @php 
                                  $teachers= App\Models\Teacher::where('teacher_username', '!=', 'NULL')->get();
                                  $t=1;
                                
                                  @endphp
                                  @if ($teachers->isNotEmpty())
                                      @php
                                          $teachersSorted = $teachers->sortBy('teacher_last_name');
                                      @endphp
                                  @foreach($teachersSorted as $teacher)
                                  @php
                                   $firstNameTeacher= $teacher->teacher_first_name;
                                   $lastNameTeacher= $teacher->teacher_last_name;
                                   $middleNameTeacher= $teacher->teacher_middle_name;
                                   $suffixTeacher= $teacher->teacher_suffix;
                                   
                                   if($suffixTeacher==="none"){
                                    $suffixTeacherFinal= " ";
                                   }else{
                                    $suffixTeacherFinal=$suffixTeacher;
                                   }
                
                                   if($teacher->teacher_image===1){
                 $profilePic= asset('Users/Teacher('.$teacher->id.").". $teacher->teacher_image_type );
                }else{
                 $profilePic= asset('Users/ph.jpg');
                }
                                   $TeacherFullName= $lastNameTeacher. ", ". $firstNameTeacher. " ". $middleNameTeacher. " ". $suffixTeacherFinal;
                                  @endphp
                                  <tr  class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3"><input type="checkbox" name="deleteTeacher[]" value="{{$teacher->id}}"></td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full" src="{{ $profilePic }}" alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $TeacherFullName }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">Teacher</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ $teacher->teacher_username }}</td>
                                    <td class="px-4 py-3 text-xs">
                                      @if ($teacher->teacher_status===1)
                                      <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
                                      @else
                                      <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
                                      @endif         
                                    </td>
                                  </tr>
                                @php $t++ @endphp
                                  @endforeach
                 
                                  @else
                                  <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-center text-gray-400" colspan="4"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>
                                    
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-center" colspan="4">No Teachers Registered</td>
                                    
                                    </tr>
                                  @endif
                                  </tbody>
                                </table>
                              </div>
                              
                            </div>
                            <div class="w-full flex justify-end mt-8">
                            
                          <button style="float: right" id="selectAllTeacher" type="button" onclick="selectAllDeleteTeacher()"
                          class="px-4  py-2 text-sm mb-4  font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                        <i class="fa-solid fa-check-to-slot"></i>Select All
                        </button>
                        <button style="float: right; display:none;" id="unselectAllTeacher" type="button" onclick="unselectAllDeleteTeacher()"
                        class="px-4  py-2 text-sm mb-4  font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                      >
                      <i class="fa-solid fa-circle-xmark"></i></i> Unselect All
                      </button>
                              <button  type="submit"
                            class="px-4  py-2 text-sm mb-4 ml-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                          >
                          <i class="fa-solid fa-trash-can"></i> Delete All
                          </button>
                          
                            </div>
                          
                          </form>
                <button id="fab_menu_teacher"  class="fab_menu" onclick="openMenu('fab_menu_teacher_add', 'fab_menu_teacher_addBatch','fab_menu_teacher_deleteBatch')">
                  <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3,18h13v-2L3,16v2zM3,13h10v-2L3,11v2zM3,6v2h13L16,6L3,6zM21,15.59L17.42,12 21,8.41 19.59,7l-5,5 5,5L21,15.59z"></path>
                  </svg>
                </button>
                <button id="fab_menu_teacher_add"  class="fab_option_add" type="button" onclick="teacher()">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13,8c0,-2.21 -1.79,-4 -4,-4S5,5.79 5,8s1.79,4 4,4S13,10.21 13,8zM15,10v2h3v3h2v-3h3v-2h-3V7h-2v3H15zM1,18v2h16v-2c0,-2.66 -5.33,-4 -8,-4S1,15.34 1,18z"></path>
                  </svg>
                </button>
                <button id="fab_menu_teacher_addBatch"  class="fab_option_addBatch" type="button" @click= "openModal" onclick="batchModal('teacher')">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.27,12h3.46c0.93,0 1.63,-0.83 1.48,-1.75l-0.3,-1.79C14.67,7.04 13.44,6 12,6S9.33,7.04 9.09,8.47l-0.3,1.79C8.64,11.17 9.34,12 10.27,12z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.66,11.11c-0.13,0.26 -0.18,0.57 -0.1,0.88c0.16,0.69 0.76,1.03 1.53,1c0,0 1.49,0 1.95,0c0.83,0 1.51,-0.58 1.51,-1.29c0,-0.14 -0.03,-0.27 -0.07,-0.4c-0.01,-0.03 -0.01,-0.05 0.01,-0.08c0.09,-0.16 0.14,-0.34 0.14,-0.53c0,-0.31 -0.14,-0.6 -0.36,-0.82c-0.03,-0.03 -0.03,-0.06 -0.02,-0.1c0.07,-0.2 0.07,-0.43 0.01,-0.65C6.1,8.69 5.71,8.4 5.27,8.38c-0.03,0 -0.05,-0.01 -0.07,-0.03C5.03,8.14 4.72,8 4.37,8C4.07,8 3.8,8.1 3.62,8.26C3.59,8.29 3.56,8.29 3.53,8.28c-0.14,-0.06 -0.3,-0.09 -0.46,-0.09c-0.65,0 -1.18,0.49 -1.24,1.12c0,0.02 -0.01,0.04 -0.03,0.06c-0.29,0.26 -0.46,0.65 -0.41,1.05c0.03,0.22 0.12,0.43 0.25,0.6C1.67,11.04 1.67,11.08 1.66,11.11z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.24,13.65c-1.17,-0.52 -2.61,-0.9 -4.24,-0.9c-1.63,0 -3.07,0.39 -4.24,0.9C6.68,14.13 6,15.21 6,16.39V18h12v-1.61C18,15.21 17.32,14.13 16.24,13.65z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.22,14.58C0.48,14.9 0,15.62 0,16.43V18l4.5,0v-1.61c0,-0.83 0.23,-1.61 0.63,-2.29C4.76,14.04 4.39,14 4,14C3.01,14 2.07,14.21 1.22,14.58z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22.78,14.58C21.93,14.21 20.99,14 20,14c-0.39,0 -0.76,0.04 -1.13,0.1c0.4,0.68 0.63,1.46 0.63,2.29V18l4.5,0v-1.57C24,15.62 23.52,14.9 22.78,14.58z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22,11v-0.5c0,-1.1 -0.9,-2 -2,-2h-2c-0.42,0 -0.65,0.48 -0.39,0.81l0.7,0.63C18.12,10.25 18,10.61 18,11c0,1.1 0.9,2 2,2S22,12.1 22,11z"></path>
                  </svg>
                </button>
                <button id="fab_menu_teacher_deleteBatch"  class="fab_option_delete" type="button" onclick="formDeleteBatchTeacher()">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6,19c0,1.1 0.9,2 2,2h8c1.1,0 2,-0.9 2,-2V7H6v12zM19,4h-3.5l-1,-1h-5l-1,1H5v2h14V4z"></path>
                  </svg>
                </button>
                <button id="fab_menu_teacher_cancelDelete" style="display:none;"  class="fab_option_delete" type="button" onclick="cancelDeleteBatchTeacher()">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12,2C6.47,2 2,6.47 2,12s4.47,10 10,10 10,-4.47 10,-10S17.53,2 12,2zM17,15.59L15.59,17 12,13.41 8.41,17 7,15.59 10.59,12 7,8.41 8.41,7 12,10.59 15.59,7 17,8.41 13.41,12 17,15.59z"></path>
                  </svg>
                </button>
</div>

<script>

  function formDeleteBatchTeacher(){
    const table = document.getElementById('tableTeacher');
    const form = document.getElementById('deletionFormTeacher');

    const deleteBatch = document.getElementById('fab_menu_teacher_deleteBatch');
    const cancelDelete = document.getElementById('fab_menu_teacher_cancelDelete');

    table.style.display= "none";
    form.style.display= '';

    cancelDelete.style.display="flex";
    deleteBatch.style.display ='none';
  }

  function cancelDeleteBatchTeacher(){
    const table = document.getElementById('tableTeacher');
    const form = document.getElementById('deletionFormTeacher');

    const deleteBatch = document.getElementById('fab_menu_teacher_deleteBatch');
    const cancelDelete = document.getElementById('fab_menu_teacher_cancelDelete');

    table.style.display= "";
    form.style.display= 'none';
    deleteBatch.style.display ='flex';
    cancelDelete.style.display="none";
    
  }
  function selectAllDeleteTeacher(){
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const select = document.getElementById('selectAllTeacher');
   const unselect = document.getElementById('unselectAllTeacher');
// Iterate through the NodeList and set the "checked" property to true for each checkbox
for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = true;
}

unselect.style.display ='';
select.style.display='none';
  }
  function unselectAllDeleteTeacher(){
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const select = document.getElementById('selectAllTeacher');
   const unselect = document.getElementById('unselectAllTeacher');
// Iterate through the NodeList and set the "checked" property to true for each checkbox
for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = false;
}
unselect.style.display ='none';
select.style.display='';
  }
</script>
<div id="coordinatorTable" style="display: none;">
        <div id="tableCoordinator">
          
          <div class="w-full overflow-hidden rounded-lg shadow-xs" style="height: 70vh; position: relative; overflow: hidden;">
            <div class="w-full overflow-x-auto" style="overflow-y: auto; max-height: 100%;">
              <table class="w-full whitespace-no-wrap" style="table-layout: fixed; border-collapse: collapse;">
                <colgroup>
                  <col style="width: 45%;"> <!-- First column width is set to 100px -->
                  <col style="width: 35%;"> <!-- Second column width is set to 150px -->
                  <col style="width: 20%;"> <!-- Third column width is set to 200px -->
                </colgroup>
                <thead>
                  <tr
                  style="position: sticky; top: 0; z-index: 1;"
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                  >
                    <th class="px-4 py-3">Coordinator</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Status</th>
                 
                  </tr>
                </thead>
                <tbody
                  class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >

         @php 
          $coordinators= App\Models\Coordinator::all();
          $c=1;
         @endphp

        @if ($coordinators->isNotEmpty())
        @php
            $coordinatorSorted = $coordinators->sortBy('coordinator_last_name');
        @endphp
        @foreach($coordinatorSorted as $coordinator)
        @php 
         $firstNameCoordinator= $coordinator->coordinator_first_name;
         $lastNameCoordinator= $coordinator->coordinator_last_name;
         $middleNameCoordinator= $coordinator->coordinator_middle_name;
         $suffixCoordinator= $coordinator->coordinator_suffix;
         if($suffixCoordinator==="none"){
           $suffixCoordinatorFinal= " ";
         }else{
           $suffixCoordinatorFinal= $suffixCoordinator;
         }
         $fullnameCoordinator= $lastNameCoordinator. ", ". $firstNameCoordinator. " ". $middleNameCoordinator. " ". $suffixCoordinatorFinal;
         if($coordinator->coordinator_image===1){
$profilePic= asset('Users/Coordinator('.$coordinator->id.").". $coordinator->coordinator_image_type );
}else{
$profilePic= asset('Users/ph.jpg');
}
        @endphp
        <tr style="cursor: pointer" onclick="editCoordinator{{$c}}()" class="text-gray-700 dark:text-gray-400">
         <td class="px-4 py-3">
             <div class="flex items-center text-sm">
                 <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                     <img class="object-cover w-full h-full rounded-full" src="{{ $profilePic}}" alt="" loading="lazy" />
                     <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                 </div>
                 <div>
                     <p class="font-semibold">{{ $fullnameCoordinator }}</p>
                     <p class="text-xs text-gray-600 dark:text-gray-400">Teacher</p>
                 </div>
             </div>
         </td>
         <td class="px-4 py-3">{{ $coordinator->coordinator_username }}</td>
         <td class="px-4 py-3 text-xs">
          @if ($coordinator->coordinator_status===1)
          <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
          @else
          <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
          @endif         
         </td>
      <script>
       function editCoordinator{{ $c }}(){
         const coordinator_id= {{$coordinator->id}};
         window.location.href= "{{route('editCoordinator')}}?coordinator_id="+coordinator_id;
       }
      </script>
     </tr>
     @php $c++; @endphp
@endforeach        
                
          @else
          <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-center text-gray-400" colspan="3"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>
            
            </tr>
            <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-center" colspan="3">No Coordinator Registered</td>
            
            </tr>
            
        @endif


                
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <form action="{{route('deleteBatchCoordinator')}}" method="post" style="display: none" id="deletionFormCoordinator">
          @csrf
          @method('post')
          <div class="w-full overflow-hidden rounded-lg shadow-xs" style="height: 70vh; position: relative; overflow: hidden;">
            <div class="w-full overflow-x-auto" style="overflow-y: auto; max-height: 100%;">
              <table class="w-full whitespace-no-wrap" style="table-layout: fixed; border-collapse: collapse;">
                <colgroup>
                  <col style="width: 5%;">
                  <col style="width: 40%;"> <!-- First column width is set to 100px -->
                  <col style="width: 35%;"> <!-- Second column width is set to 150px -->
                  <col style="width: 20%;"> <!-- Third column width is set to 200px -->
                </colgroup>
                <thead>
                  
                  <tr
                  style="position: sticky; top: 0; z-index: 1;"
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                  >
                  <th class="px-4 py-3"><i class="fa-solid fa-trash-can"></i></th>
                    <th class="px-4 py-3">Coordinator</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Status</th>
                 
                  </tr>
                </thead>
                <tbody
                  class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >

         @php 
          $coordinators= App\Models\Coordinator::all();
          $c=1;
         @endphp

        @if ($coordinators->isNotEmpty())
        @php
            $coordinatorSorted = $coordinators->sortBy('coordinator_last_name');
        @endphp
        @foreach($coordinatorSorted as $coordinator)
        @php 
         $firstNameCoordinator= $coordinator->coordinator_first_name;
         $lastNameCoordinator= $coordinator->coordinator_last_name;
         $middleNameCoordinator= $coordinator->coordinator_middle_name;
         $suffixCoordinator= $coordinator->coordinator_suffix;
         if($suffixCoordinator==="none"){
           $suffixCoordinatorFinal= " ";
         }else{
           $suffixCoordinatorFinal= $suffixCoordinator;
         }
         $fullnameCoordinator= $lastNameCoordinator. ", ". $firstNameCoordinator. " ". $middleNameCoordinator. " ". $suffixCoordinatorFinal;
         if($coordinator->coordinator_image===1){
$profilePic= asset('Users/Coordinator('.$coordinator->id.").". $coordinator->coordinator_image_type );
}else{
$profilePic= asset('Users/ph.jpg');
}
        @endphp
        <tr  class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3"><input type="checkbox" name="deleteCoordinator[]" value="{{$coordinator->id}}"></td>
         <td class="px-4 py-3">
             <div class="flex items-center text-sm">
                 <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                     <img class="object-cover w-full h-full rounded-full" src="{{ $profilePic}}" alt="" loading="lazy" />
                     <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                 </div>
                 <div>
                     <p class="font-semibold">{{ $fullnameCoordinator }}</p>
                     <p class="text-xs text-gray-600 dark:text-gray-400">Teacher</p>
                 </div>
             </div>
         </td>
         <td class="px-4 py-3">{{ $coordinator->coordinator_username }}</td>
         <td class="px-4 py-3 text-xs">
          @if ($coordinator->coordinator_status===1)
          <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Verified Account</span>   
          @else
          <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Not Yet Verified Account</span>   
          @endif         
         </td>
     
     </tr>
     @php $c++; @endphp
@endforeach        
                
          @else
          <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-center text-gray-400" colspan="4"><i class="fa-solid fa-person-circle-question" style="font-size: 6rem"></i></td>
            
            </tr>
            <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-center" colspan="4">No Coordinator Registered</td>
            
            </tr>
            
        @endif


                
                </tbody>
              </table>
            </div>
          </div>

          <div class="w-full flex justify-end mt-8">
                            
            <button style="float: right" id="selectAllCoordinator" type="button" onclick="selectAllDeleteCoordinator()"
            class="px-4  py-2 text-sm mb-4  font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
          <i class="fa-solid fa-check-to-slot"></i> Select All
          </button>
          <button style="float: right; display:none;" id="unselectAllCoordinator" type="button" onclick="unselectAllDeleteCoordinator()"
            class="px-4  py-2 text-sm mb-4  font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
          <i class="fa-solid fa-circle-xmark"></i></i> Unselect All
          </button>
                <button  type="submit"
              class="px-4  py-2 text-sm mb-4 ml-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-solid fa-trash-can"></i> Delete All
            </button>
            
              </div>
            
        </form>
 
                <button id="fab_menu_coordinator"  class="fab_menu" onclick="openMenu('fab_menu_coordinator_add', 'fab_menu_coordinator_addBatch','fab_menu_coordinator_deleteBatch')">
                  <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3,18h13v-2L3,16v2zM3,13h10v-2L3,11v2zM3,6v2h13L16,6L3,6zM21,15.59L17.42,12 21,8.41 19.59,7l-5,5 5,5L21,15.59z"></path>
                  </svg>
                </button>
                <button id="fab_menu_coordinator_add"  class="fab_option_add" type="button" onclick="coordinator()">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13,8c0,-2.21 -1.79,-4 -4,-4S5,5.79 5,8s1.79,4 4,4S13,10.21 13,8zM15,10v2h3v3h2v-3h3v-2h-3V7h-2v3H15zM1,18v2h16v-2c0,-2.66 -5.33,-4 -8,-4S1,15.34 1,18z"></path>
                  </svg>
                </button>
                <button id="fab_menu_coordinator_addBatch"  class="fab_option_addBatch" type="button" @click= "openModal" onclick="batchModal('coordinator')">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.27,12h3.46c0.93,0 1.63,-0.83 1.48,-1.75l-0.3,-1.79C14.67,7.04 13.44,6 12,6S9.33,7.04 9.09,8.47l-0.3,1.79C8.64,11.17 9.34,12 10.27,12z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.66,11.11c-0.13,0.26 -0.18,0.57 -0.1,0.88c0.16,0.69 0.76,1.03 1.53,1c0,0 1.49,0 1.95,0c0.83,0 1.51,-0.58 1.51,-1.29c0,-0.14 -0.03,-0.27 -0.07,-0.4c-0.01,-0.03 -0.01,-0.05 0.01,-0.08c0.09,-0.16 0.14,-0.34 0.14,-0.53c0,-0.31 -0.14,-0.6 -0.36,-0.82c-0.03,-0.03 -0.03,-0.06 -0.02,-0.1c0.07,-0.2 0.07,-0.43 0.01,-0.65C6.1,8.69 5.71,8.4 5.27,8.38c-0.03,0 -0.05,-0.01 -0.07,-0.03C5.03,8.14 4.72,8 4.37,8C4.07,8 3.8,8.1 3.62,8.26C3.59,8.29 3.56,8.29 3.53,8.28c-0.14,-0.06 -0.3,-0.09 -0.46,-0.09c-0.65,0 -1.18,0.49 -1.24,1.12c0,0.02 -0.01,0.04 -0.03,0.06c-0.29,0.26 -0.46,0.65 -0.41,1.05c0.03,0.22 0.12,0.43 0.25,0.6C1.67,11.04 1.67,11.08 1.66,11.11z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.24,13.65c-1.17,-0.52 -2.61,-0.9 -4.24,-0.9c-1.63,0 -3.07,0.39 -4.24,0.9C6.68,14.13 6,15.21 6,16.39V18h12v-1.61C18,15.21 17.32,14.13 16.24,13.65z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.22,14.58C0.48,14.9 0,15.62 0,16.43V18l4.5,0v-1.61c0,-0.83 0.23,-1.61 0.63,-2.29C4.76,14.04 4.39,14 4,14C3.01,14 2.07,14.21 1.22,14.58z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22.78,14.58C21.93,14.21 20.99,14 20,14c-0.39,0 -0.76,0.04 -1.13,0.1c0.4,0.68 0.63,1.46 0.63,2.29V18l4.5,0v-1.57C24,15.62 23.52,14.9 22.78,14.58z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22,11v-0.5c0,-1.1 -0.9,-2 -2,-2h-2c-0.42,0 -0.65,0.48 -0.39,0.81l0.7,0.63C18.12,10.25 18,10.61 18,11c0,1.1 0.9,2 2,2S22,12.1 22,11z"></path>
                  </svg>
                </button>
                <button id="fab_menu_coordinator_deleteBatch"  class="fab_option_delete" type="button" onclick="formDeleteBatchCoordinator()">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6,19c0,1.1 0.9,2 2,2h8c1.1,0 2,-0.9 2,-2V7H6v12zM19,4h-3.5l-1,-1h-5l-1,1H5v2h14V4z"></path>
                  </svg>
                </button>
                <button id="fab_menu_coordinator_cancelDelete" style="display:none;"  class="fab_option_delete" type="button" onclick="cancelDeleteBatchCoordinator()">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12,2C6.47,2 2,6.47 2,12s4.47,10 10,10 10,-4.47 10,-10S17.53,2 12,2zM17,15.59L15.59,17 12,13.41 8.41,17 7,15.59 10.59,12 7,8.41 8.41,7 12,10.59 15.59,7 17,8.41 13.41,12 17,15.59z"></path>
                  </svg>
                </button>
</div>
<script>
   function formDeleteBatchCoordinator(){
    const table = document.getElementById('tableCoordinator');
    const form = document.getElementById('deletionFormCoordinator');

    const deleteBatch = document.getElementById('fab_menu_coordinator_deleteBatch');
    const cancelDelete = document.getElementById('fab_menu_coordinator_cancelDelete');

    table.style.display= "none";
    form.style.display= '';

    cancelDelete.style.display="flex";
    deleteBatch.style.display ='none';
  }

  function cancelDeleteBatchCoordinator(){
    const table = document.getElementById('tableCoordinator');
    const form = document.getElementById('deletionFormCoordinator');

    const deleteBatch = document.getElementById('fab_menu_coordinator_deleteBatch');
    const cancelDelete = document.getElementById('fab_menu_coordinator_cancelDelete');

    table.style.display= "";
    form.style.display= 'none';
    deleteBatch.style.display ='flex';
    cancelDelete.style.display="none";
    
  }
  function selectAllDeleteCoordinator(){
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
   const select = document.getElementById('selectAllCoordinator');
   const unselect = document.getElementById('unselectAllCoordinator');
// Iterate through the NodeList and set the "checked" property to true for each checkbox
for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = true;
}

unselect.style.display= '';
select.style.display="none";
  }
  function unselectAllDeleteCoordinator(){
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
   const select = document.getElementById('selectAllCoordinator');
   const unselect = document.getElementById('unselectAllCoordinator');
// Iterate through the NodeList and set the "checked" property to true for each checkbox
for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = false;
}

unselect.style.display= 'none';
select.style.display="";
  }
</script>
 <div id="studentModal" class="studentModal">
            <div id="studentContent" class="contentStudent dark:bg-gray-800">
              <div style="width: 100%; height:2%;"><button style="float: right;" class="dark:text-gray-200" onclick="closeStudent()">X</button></div>
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add Students
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Provide Student Credentials
            </h4>
            <form method="post" id="addStudentFormSubmission">
              @csrf
              @method('post')
            <div 
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <label class="block text-sm mb-2">
              <span class="text-gray-700 dark:text-gray-400">Last Name</span>
             
              <input type="text"
              required
              name="lastNameStudent"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Last Name"
                oninput="validateInput(this)"
              >
              <span id="errorText" style="display: none" class="text-xs text-red-600 dark:text-red-400">
                
              </span>
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">First Name</span>
           
              <input
              required
              type="text"
              name="firstNameStudent"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="First Name"
                oninput="validateInput(this)"
              >
              
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
 
              <input 
              type="text"
              name="middleNameStudent"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Middle Name"
                oninput="validateInput(this)"
              >
          
              
            </label>
            
            <label id="senior" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Suffix</span>
                <select name="suffixStudent" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="none">None</option>
                <option value="Jr.">Jr.(Junior)</option>
                  <option value="Sr.">Sr.(Senior)</option>
                  <option value="I">I(The First)</option>
                  <option value="II">II(The Second)</option>
                  <option value="III">III(The Third)</option>
                  <option value="IV">IV(The Fourth)</option>
                  <option value="V">V(The Fifth)</option>
                </select></label><br>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Learners Reference Number(LRN)</span>
              <input
              oninput="limitInputLength(this, 12)"
              required
              type="number"
              name="student_id"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="117869070047"
              >
            
            </label>
          
            <p></p>
         
            
        
                <label id="strand" style="display: block;" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Strands</span>
                <select onchange="selectedStrandStudent()" id="selectedStrandStudents" required
                 name="strand" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                  @php
                   $strands= App\Models\Strand::where('id', '!=', 7)->get();
                  @endphp
                  <option disabled selected value="">~~~Select Strand~~~</option>
                  @foreach($strands as $strand)
                  <option value="{{$strand->id}}" >{{$strand->strand_name}}</option>
                 @endforeach
                </select></label>
                
            
                <label id="senior" style="display: block;" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Year Level</span>
                  <select  id="selectYearLevelStudent"
                   name="year" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option selected disabled>Please Select a Strand First</option>
                  
                  </select></label>
                  <script>
                      function selectedStrandStudent(){
            var selectedStrandId =document.getElementById('selectedStrandStudents').value;
            const strandIdInteger= parseInt(selectedStrandId);
            const url = "{{ route('fetchData') }}?strand_id=" + strandIdInteger;

        
            axios.get(url)
        .then(function (response) {
        var gradeLevelSelect = document.getElementById('selectYearLevelStudent');
        
        // Clear existing options
        gradeLevelSelect.innerHTML = '';

        if (response.data.length === 0) {
            // Handle the case when no data is returned
            var option = document.createElement('option');
            option.text = 'No options available';
            gradeLevelSelect.appendChild(option);
            console.log(url);
        } else {
            // Add new options based on the response data
            response.data.forEach(function (grade) {
                var option = document.createElement('option');
                option.value = grade.id;
                option.text = grade.year_level + "-" + grade.section;
                gradeLevelSelect.appendChild(option);
            });
        }
    })
    .catch(function (error) {
        console.error(error);
    });

          }
                  </script>
           
                <br>
            <button type="submit"
            id="addStudent"
            name="addStudent"
            style="display: none"
            onclick="load('load')"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Add
          </button><br><br><br>
          <script>
            function limitInputLength(inputElement, maxLength) {
              const addStudent= document.getElementById('addStudent');
if (inputElement.value.length > maxLength) {
inputElement.value = inputElement.value.slice(0, maxLength); // Truncate the input
}

if(inputElement.value.length < maxLength){
  addStudent.style.display='none';
}else{
  addStudent.style.display='';
}


}
        </script>
          </form>
            </div>
           
            </div>
          </div>

            <script>
            
              function student(){
                var studentModal=  document.getElementById("studentModal");
                var studentContent=  document.getElementById("studentContent");
               studentModal.style.display = "block";
               studentContent.style.animation= "zoom 0.5s linear";
              }
              var studentModal=  document.getElementById("studentModal");
              var studentContent=  document.getElementById("studentContent");
              window.addEventListener('click', function(event) {
  if (event.target === studentModal) {
    
    studentContent.style.animation= "close 0.5s linear";
   
    setTimeout(function() {
      studentModal.style.display= "none";
    }, 500);
  }
});

function closeStudent(){
  var studentContent=  document.getElementById("studentContent");
  var studentModal=  document.getElementById("studentModal");
  studentContent.style.animation= "close 0.5s linear";
  setTimeout(function() {
    studentModal.style.display = "none";
    }, 500);
}
            </script>


<div id="teacherModal" class="teacherModal">
  <div id="teacherContent" class="contentTeacher dark:bg-gray-800">
  <div style="width: 100%; height:2%;"><button style="float: right;" class="dark:text-gray-200" onclick="closeTeacher()">X</button></div>
  <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add Teachers
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Provide Teachers Credentials
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <form method="post" id="addTeacherFormSubmission">
              @csrf
              @method('post')
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Last Name</span>
              <input
              required
              name="last_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Last Name"
                oninput="validateInput(this)"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">First Name</span>
              <input
              required
              name="first_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="First Name"
                oninput="validateInput(this)"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
              <input
              
              name="middle_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Middle Name"
                oninput="validateInput(this)"
              />
            </label>
            <label id="senior" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Suffix</span>
                <select name="suffix" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="none">None</option>
                <option value="Jr.">Jr.(Junior)</option>
                  <option value="Sr.">Sr.(Senior)</option>
                  <option value="I">I(The First)</option>
                  <option value="II">II(The Second)</option>
                  <option value="III">III(The Third)</option>
                  <option value="IV">IV(The Fourth)</option>
                  <option value="V">V(The Fifth)</option>
                </select></label>
            <br>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Username</span>
              <input
              required
              name="username"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Username"
              />
            </label>
           
            <br>
            <button
            name="addTeacher" type="submit" onclick="load('load')"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Add
          </button>
          </form>
            </div>
           
  </div>
</div>

<script>
  function teacher(){
    var teacherModal= document.getElementById("teacherModal");
    var teacherContent= document.getElementById("teacherContent");
    teacherModal.style.display="block";
    teacherContent.style.animation= "zoom 0.5s linear";
  }
  var teacherModal=  document.getElementById("teacherModal");
  var teacherContent= document.getElementById("teacherContent");
              window.addEventListener('click', function(event) {
  if (event.target === teacherModal) {
    teacherContent.style.animation= "close 0.5s linear";
    setTimeout(function() {
      teacherModal.style.display= "none";
    }, 500);

  }
});

function closeTeacher(){
  var teacherModal=  document.getElementById("teacherModal");
  var teacherContent= document.getElementById("teacherContent");
  teacherContent.style.animation = "close 0.5s linear";
  setTimeout(function() {
      teacherModal.style.display= "none";
    }, 500);
}


</script>


<div id="coordinatorModal" class="coordinatorModal">
  <div id="coordinatorContent" class="contentCoordinator dark:bg-gray-800">
  <div style="width: 100%; height:2%;"><button style="float: right;" class="dark:text-gray-200" onclick="closeCoordinator()">X</button></div>
  <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add Coordinators
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Provide Coordinator's Credentials
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <form method="post" id="addCoordinatorFormSubmission">
              @csrf
              @method('post')
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Last Name</span>
              <input
              required
              name="last_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Last Name"
                oninput="validateInput(this)"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">First Name</span>
              <input
              required
              name="first_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="First Name"
                     oninput="validateInput(this)"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
              <input
              
              name="middle_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Middle Name"
                oninput="validateInput(this)"
              />
            </label>
            <label id="senior" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Suffix</span>
                <select name="suffix" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="none">None</option>
                <option value="Jr.">Jr.(Junior)</option>
                  <option value="Sr.">Sr.(Senior)</option>
                  <option value="I">I(The First)</option>
                  <option value="II">II(The Second)</option>
                  <option value="III">III(The Third)</option>
                  <option value="IV">IV(The Fourth)</option>
                  <option value="V">V(The Fifth)</option>
                </select></label>
            <br>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Username</span>
              <input
              required
              name="username"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Username"
              />
            </label>
            <label class="block text-sm  mb-4 mt-4">
              <span class="text-gray-700 dark:text-gray-400">
                Position
              </span>
              <select
              required
              name="Position"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              >
              <option  disabled selected>None</option>
              <option>Principal</option>
             <option>Assistant Principal</option>
             <option>Curriculum Coordinator</option>
             <option>Teacher Professional Growth Coordinator</option>
             <option>Human Resources</option>
             <option>Teacher Evaluation Committee</option>
              </select>
            </label>
            <br>
            <button
            name="addCoordinator" type="submit" onclick="load('load')"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Add
          </button>
          </form>

         
            </div>
  </div>
</div>

<script>
function coordinator(){
  var coordinatorModal= document.getElementById("coordinatorModal");
  var coordinatorContent= document.getElementById("coordinatorContent");
  coordinatorModal.style.display= "block";
  coordinatorContent.style.animation= "zoom 0.5s linear";
}
var coordinatorModal=  document.getElementById("coordinatorModal");
var coordinatorContent= document.getElementById("coordinatorContent");
              window.addEventListener('click', function(event) {
  if (event.target === coordinatorModal) {
    coordinatorContent.style.animation= "close 0.5s linear";
    setTimeout(function() {
      coordinatorModal.style.display= "none";
    }, 500);
    
  }
});

function closeCoordinator(){
  var coordinatorModal=  document.getElementById("coordinatorModal");
  var coordinatorContent= document.getElementById("coordinatorContent");

  coordinatorContent.style.animation="close 0.5s linear";
  setTimeout(function() {
      coordinatorModal.style.display= "none";
    }, 500);
}

function validateInput(inputElement) {
    // Remove any non-letter and non-space characters using a regular expression
    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');

    // Display an error message if non-letter or non-space characters are entered
    var errorText = document.getElementById("errorText");
    if (/[^A-Za-z\s]/.test(inputElement.value)) {
        errorText.style.display = "";
        errorText.textContent = "Only letters and spaces are allowed.";
    } else {
        errorText.textContent = "";
        errorText.style.display = "none";
    }
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
  <div id="studentModalBatch" style="display: none;">
    <div class="mt-4 mb-6">
      <!-- Modal title -->
      <p
        class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
      >
        Parameters for adding students in batch
      </p>
      <!-- Modal description -->
      
        <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">
             Strand
          </span>
          <select
          name="strand"
          
          onchange="strandChangesBatch()"
          id="strandBatch"
          
            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
          >
        <option selected disabled value="none">~~~NO SELECTED STRAND~~~</option>
          @foreach ($strands as $strand)
              <option value="{{$strand->id}}">{{$strand->strand_name}}</option>
          @endforeach
          </select>
        </label>
        
        <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">
             Grade Level
          </span>
          <select
          required
          name="gradeLevel"
          id="gradeLevelStudentBatch" 
            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
          >
          <option selected  disabled value="none">Please Select a Strand First</option>
          </select>
        </label>
        <script>
          function strandChangesBatch(){
            var selectedStrandId =document.getElementById('strandBatch').value;
            const strandIdInteger= parseInt(selectedStrandId);
            const url = "{{ route('fetchData') }}?strand_id=" + strandIdInteger;

        
        axios.get(url)
        .then(function (response) {
        var gradeLevelSelect = document.getElementById('gradeLevelStudentBatch');
        
        // Clear existing options
        gradeLevelSelect.innerHTML = '';

        if (response.data.length === 0) {
            // Handle the case when no data is returned
            var option = document.createElement('option');
            option.text = 'No options available';
            gradeLevelSelect.appendChild(option);
            console.log(url);
        } else {
            // Add new options based on the response data
            response.data.forEach(function (grade) {
                var option = document.createElement('option');
                option.value = grade.id;
                option.text = grade.year_level + "-" + grade.section;
                gradeLevelSelect.appendChild(option);
            });
        }
    })
    .catch(function (error) {
        console.error(error);
    });

          }
        


        
        
        </script>
       
       
         <label class="block text-sm">
          <span class="text-gray-700 dark:text-gray-400">Quantity</span>
          <input
          required
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="#"
            type="number"
            name="quantity"
            id="quantityBatch"
          />
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
      <button type="button" onclick="openBatchAddStudent()"
        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
      >
        Accept
      </button>
    </footer>
  </div>

  <div id="teacherModalBatch" style="display: none;">
    <div class="mt-4 mb-6">
      <!-- Modal title -->
      <p
        class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
      >
        Parameters for adding Teachers in batch
      </p>
      
        
       
         <label class="block text-sm">
          <span class="text-gray-700 dark:text-gray-400">Quantity</span>
          <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="#"
            type="number"
            name="quantity"
            id="quantityBatchTeacher"
          />
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
      <button type="button" onclick="openBatchAddTeacher()"
        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
      >
        Accept
      </button>
    </footer>
  </div>


  <div id="coordinatorModalBatch" style="display: none;">
    <div class="mt-4 mb-6">
      <!-- Modal title -->
      <p
        class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
      >
        Parameters for adding Coordinator in batch
      </p>
      <!-- Modal description -->
      
        
       
         <label class="block text-sm">
          <span class="text-gray-700 dark:text-gray-400">Quantity</span>
          <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="#"
            type="number"
            name="quantity"
            id="quantityBatchCoordinator"
          />
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
      <button type="button" onclick="openBatchAddCoordinator()"
        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
      >
        Accept
      </button>
    </footer>
  </div>

  <div id="filterModal" style="display: none;">
    <div class="mt-4 mb-6">
      <!-- Modal title -->
      <p
        class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
      >
      Filter Search
      </p>
      <!-- Modal description -->
      <div class="mt-4 text-sm">
      
        <div class="mt-2" style="display: flex; flex-direction:column;">
          <label
            class=" items-center text-gray-600 dark:text-gray-400"
          >
            <input
              type="radio"
              class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              name="filterType"
              value="1"
              checked
            />
            <span class="ml-2">All</span>
          </label>
          <label
          class=" items-center text-gray-600 dark:text-gray-400"
        >
          <input
            type="radio"
            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            name="filterType"
            value="2"
          />
          <span class="ml-2">Student Only</span>
        </label>
                  <label
          class=" items-center text-gray-600 dark:text-gray-400"
        >
          <input
            type="radio"
            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            name="filterType"
            value="3"
          />
          <span class="ml-2">Teacher Only</span>
        </label>
        <label
        class=" items-center text-gray-600 dark:text-gray-400"
      >
        <input
          type="radio"
          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
          name="filterType"
          value="4"
        />
        <span class="ml-2">Coordinator Only</span>
      </label>
      <label
      class=" items-center text-gray-600 dark:text-gray-400"
    >
      <input
        type="radio"
        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        name="filterType"
        value="5"
      />
      <span class="ml-2">Student->LRN</span>
    </label>
    <label
    class=" items-center text-gray-600 dark:text-gray-400"
  >
    <input
      type="radio"
      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
      name="filterType"
      value="5.1"
    />
    <span class="ml-2">Student->Grade Level</span>
  </label>
  <label
  class=" items-center text-gray-600 dark:text-gray-400"
>
  <input
    type="radio"
    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
    name="filterType"
    value="5.2"
  />
  <span class="ml-2">Student->Strand</span>
</label>
    <label
    class=" items-center text-gray-600 dark:text-gray-400"
  >
    <input
      type="radio"
      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
      name="filterType"
      value="6"
    />
    <span class="ml-2">Teacher->Username</span>
  </label>
  <label
  class=" items-center text-gray-600 dark:text-gray-400"
>
  <input
    type="radio"
    class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
    name="filterType"
    value="7"
  />
  <span class="ml-2">Coordinator->Username</span>
</label>
<label
class=" items-center text-gray-600 dark:text-gray-400"
>
<input
  type="radio"
  class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
  name="filterType"
  value="7.1"
/>
<span class="ml-2">Coordinator->Position</span>
</label>
        </div>
      </div>

     
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
      <button type="button"  onclick="setFilter()"   @click="closeModal"
        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
      >
        Accept
      </button>
    </footer>

  </div>
  
</div>
</div>


<script>
function userTypeChange() {
  const type = document.querySelector('input[name="userType"]:checked').value;

  const student = document.getElementById('studentTable');
  const teacher = document.getElementById('teacherTable');
  const coordinator = document.getElementById('coordinatorTable');


  const addMenuStudent = document.getElementById('fab_menu_student_add');
  const addBatchMenuStudent = document.getElementById('fab_menu_student_addBatch');
  const deleteMenuStudent = document.getElementById('fab_menu_student_deleteBatch');

  const studentCancelDelete = document.getElementById('fab_menu_student_cancelDelete');
  const teacherCancelDelete = document.getElementById('fab_menu_teacher_cancelDelete');
  const coordinatorCancelDelete = document.getElementById('fab_menu_coordinator_cancelDelete');

  const addMenuTeacher = document.getElementById('fab_menu_teacher_add');
  const addBatchMenuTeacher = document.getElementById('fab_menu_teacher_addBatch');
  const deleteMenuTeacher = document.getElementById('fab_menu_teacher_deleteBatch');

  const addMenuCoordinator = document.getElementById('fab_menu_coordinator_add');
  const addBatchMenuCoordinator = document.getElementById('fab_menu_coordinator_addBatch');
  const deleteMenuCoordinator = document.getElementById('fab_menu_coordinator_deleteBatch');

  addMenuStudent.style.display= "none";
  addBatchMenuStudent.style.display= "none";
  deleteMenuStudent.style.display= "none";

  addMenuTeacher.style.display= "none";
  addBatchMenuTeacher.style.display= "none";
  deleteMenuTeacher.style.display= "none";

  addMenuCoordinator.style.display= "none";
  addBatchMenuCoordinator.style.display= "none";
  deleteMenuCoordinator.style.display= "none";

  studentCancelDelete.style.display='none';
  teacherCancelDelete.style.display='none';
  coordinatorCancelDelete.style.display='none';
  if (type === "student") {
    student.style.display = 'block';
    teacher.style.display = 'none';
    coordinator.style.display = 'none';
  } else if (type === "teacher") {
    student.style.display = 'none';
    teacher.style.display = 'block';
    coordinator.style.display = 'none';
  } else {
    student.style.display = 'none';
    teacher.style.display = 'none';
    coordinator.style.display = 'block';
  }
}


function load(status){
 if(status=== 'close'){
  const submitting = document.getElementById('submitting');
  submitting.style.display='none';
 }else{
  const submitting = document.getElementById('submitting');
  submitting.style.display='';
 }
}


function openBatchAddStudent(){

  const strand = document.getElementById('strandBatch').value;
  const year_level = document.getElementById('gradeLevelStudentBatch').value;
  const quantity = document.getElementById('quantityBatch').value;
  
  if(strand !='none' && year_level!='none' && quantity !=''){
    window.location.href= "{{route('openAddBatch')}}?strand="+strand+"&year_level="+year_level+"&quantity="+quantity+"&type=student";
  }
}

function openBatchAddTeacher(){

const quantity = document.getElementById('quantityBatchTeacher').value;

if(quantity!= ''){
  window.location.href= "{{route('openAddBatch')}}?strand=null&year_level=null&quantity="+quantity+"&type=teacher";
}
}

function openBatchAddCoordinator(){

const quantity = document.getElementById('quantityBatchCoordinator').value;
if(quantity!= ''){
window.location.href= "{{route('openAddBatch')}}?strand=null&year_level=null&quantity="+quantity+"&type=coordinator";
}
}
function batchModal(type){
  const student = document.getElementById('studentModalBatch');
  const teacher = document.getElementById('teacherModalBatch');
  const coordinator = document.getElementById('coordinatorModalBatch');
  const filter = document.getElementById('filterModal');

  const searchResults = document.getElementById('searchResults');
  const resultDiv= document.getElementById('searchResultDiv');

 if(type === 'student'){
  student.style.display= "";
  teacher.style.display= "none";
  coordinator.style.display= "none";
  filter.style.display='none';

 }else if(type ==='teacher'){
  student.style.display= "none";
  teacher.style.display= "";
  coordinator.style.display= "none";
  filter.style.display='none';
 }else if (type ==='coordinator'){
  student.style.display= "none";
  teacher.style.display= "none";
  coordinator.style.display= "";
  filter.style.display='none';
 }else{
  student.style.display= "none";
  teacher.style.display= "none";
  coordinator.style.display= "none";
  filter.style.display='';
  resultDiv.innerHTML='';
  searchResults.style.animation= 'searchHide 0.5s';
  setTimeout(()=>{
    searchResults.style.display= 'none';
  },500);
 }
}
let clickCounter = 0;

function openMenu(add, addBatch, deleteBatch){

  clickCounter++;
  const addMenu = document.getElementById(add);
  const addBatchMenu = document.getElementById(addBatch);
  const deleteMenu = document.getElementById(deleteBatch);
  
  if(clickCounter % 2 === 0){
  
  addMenu.style.animation= "OutAdd 0.5s";
  addBatchMenu.style.animation= "OutAddBatch 0.5s";
  deleteMenu.style.animation= "OutDeleteBatch 0.5s";

  setTimeout(function(){
  addMenu.style.display= "none";
  addBatchMenu.style.display= "none";
  deleteMenu.style.display= "none";
  }, 500);
  }else{
    
  addMenu.style.display= "flex";
  addBatchMenu.style.display= "flex";
  deleteMenu.style.display= "flex";
    
  addMenu.style.animation= "InAdd 0.5s";
  addBatchMenu.style.animation= "InAddBatch 0.5s";
  deleteMenu.style.animation= "InDeleteBatch 0.5s";
  }
}
let debounceTimer;

function showSearchResult(input){
            const searchResults = document.getElementById('searchResults');
            const searchInput= document.getElementById('searchInput');
            const resultDiv= document.getElementById('searchResultDiv');
            searchInput.textContent= input.value;
           const searchFilter= document.getElementById('searchFilter').value;
           const spanFilter= document.getElementById('spanFilter');
           switch(searchFilter){
            case "1":
              spanFilter.textContent= "(Filter: All)";
              break;
            case "2":
              spanFilter.textContent= "(Filter: Student Only)";
              break;
            case "3":
              spanFilter.textContent= "(Filter: Teacher Only)";
              break;
            case "4":
              spanFilter.textContent= "(Filter: Coordinator Only)";
              break;
            case "5":
              spanFilter.textContent= "(Filter: Student->LRN)";
              break;
            case "5.1":
              spanFilter.textContent= "(Filter: Student->Grade Level)";
              break;
            case "5.2":
              spanFilter.textContent= "(Filter: Student->Strand)";
              break;
            case "6":
              spanFilter.textContent= "(Filter: Teacher->Username)";
              break;
            case "7":
              spanFilter.textContent= "(Filter: Coordinator->Username)";
              break;
            case "7.1":
              spanFilter.textContent= "(Filter: Coordinator->Position)";
              break;
           } 
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
            if(input.value.length === 0){
              searchResults.style.animation= "searchHide 0.5s";
              setTimeout(()=>{
                searchResults.style.display="none";    
              },500);
            }else{
              searchResults.style.animation= "searchShow 0.5s";
              searchResults.style.display="";
              resultDiv.innerHTML='';
              const newDiv = document.createElement('div');
newDiv.className = 'w-full';
newDiv.style.flexDirection = 'column';
newDiv.style.display = 'flex';
newDiv.style.justifyContent = 'center';
newDiv.style.alignItems = 'center';

const noUserText = document.createElement('p');
noUserText.className = 'text-2xl text-gray-400 dark:text-gray-300';
noUserText.innerHTML = 'Searching....<i class="fa-solid fa-magnifying-glass fa-bounce"></i>';
newDiv.appendChild(noUserText);


resultDiv.appendChild(newDiv);
              const url ="{{route('searchUser')}}?search="+ input.value +"&filter="+searchFilter ;
          

        axios.get(url)
        .then(function (response) {
          var data = response.data;
          console.log(data);
          resultDiv.innerHTML='';
          data.forEach(function(item) {
            if(item.fullname === 'empty' && item.username === 'empty' && item.type ==='empty' && item.id==='empty'){
         
              // Create a new div element with the desired content
const newDiv = document.createElement('div');
newDiv.className = 'w-full';
newDiv.style.flexDirection = 'column';
newDiv.style.display = 'flex';
newDiv.style.justifyContent = 'center';
newDiv.style.alignItems = 'center';

// Create the content for the new div
const sadFaceIcon = document.createElement('p');
sadFaceIcon.className = 'text-6xl text-gray-400 dark:text-gray-600';
sadFaceIcon.innerHTML = '<i class="fa-solid fa-face-sad-cry"></i>';

const noUserText = document.createElement('p');
noUserText.className = 'text-2xl text-gray-400 dark:text-gray-600';
noUserText.textContent = 'No User Found';

// Append the content elements to the new div
newDiv.appendChild(sadFaceIcon);
newDiv.appendChild(noUserText);


resultDiv.appendChild(newDiv);

        }else{
         
          const newDiv = document.createElement("div");
newDiv.setAttribute("class", "ml-8 border border-solid flex justify-between resultOfSearch");
newDiv.setAttribute("style", "padding:20px; margin-left:20px; margin-right:10px;");
newDiv.setAttribute("onclick", "openSearchResult('"+item.id+"', '"+item.type+"')");
// Create the inner span elements and their content
const fullNameSpan = document.createElement("span");
fullNameSpan.textContent = item.fullname;

const usernameSpan = document.createElement("span");
usernameSpan.textContent = item.username;

const typeSpan = document.createElement("span");
typeSpan.textContent = item.type;

// Append the inner span elements to the new div element
newDiv.appendChild(fullNameSpan);
newDiv.appendChild(usernameSpan);
newDiv.appendChild(typeSpan);

// Append the new div element to the parent div with id "searchResults"
resultDiv.appendChild(newDiv);
          
        }

        });

      
        
        })
       .catch(function (error) {
        console.error(error);
        });

            }
          }, 500); 
          }
          
          function openSearchResult(id, type){

            if(type==='Student'){
              window.location.href= "{{route('editStudent')}}?student_id="+id;
            }else if(type==='Teacher'){
              window.location.href= "{{route('editTeacher')}}?teacher_id="+id;
            }else{
              window.location.href= "{{route('editCoordinator')}}?coordinator_id="+id;
            }

          }

          function setFilter(){
            const selectedValue = document.querySelector('input[name="filterType"]:checked').value;
            const searchFilter= document.getElementById('searchFilter');

            searchFilter.value= selectedValue;
          }


          $(document).ready(function() {
         $('form#addStudentFormSubmission').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: "{{route('addStudent')}}",
            data: formData,
            success: function(response) {
              load('close');
               if(response.message=== 'success'){
                
                Swal.fire({
    icon: 'success',
    title: 'Student added successfully!',
    text: 'Reloading page shortly...',
    timer: 1500, // Auto-close after 2 seconds
    showConfirmButton: false
  }).then(() => {
    // Reload the page after a delay (optional)
    setTimeout(function() {
      location.reload();
    }, 500); // Reload after 2 seconds
  });
               }else{
                Swal.fire({
    icon: 'error',
    title: 'Invalid LRN',
    text: 'An existing user is using this LRN',
    timer: 1500, 
    showConfirmButton: false
  });
               }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                   
                }
            }
        });
    });
});

document.addEventListener('click', function(){
  const searchResults = document.getElementById('searchResults');
  searchResults.style.animation='searchHide 0.3s';
  setTimeout(()=>{
    searchResults.style.display='none';
  }, 300);
});

$(document).ready(function() {
         $('form#addTeacherFormSubmission').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: "{{route('addTeacher')}}",
            data: formData,
            success: function(response) {
              load('close');
               if(response.message=== 'success'){
                Swal.fire({
    icon: 'success',
    title: 'Teacher added successfully!',
    text: 'Reloading page shortly...',
    timer: 1500, // Auto-close after 2 seconds
    showConfirmButton: false
  }).then(() => {
    // Reload the page after a delay (optional)
    setTimeout(function() {
      location.reload();
    }, 500); // Reload after 2 seconds
  });
               }else{
                Swal.fire({
    icon: 'error',
    title: 'Invalid Username',
    text: 'An existing user is using this Username',
    timer: 1500, 
    showConfirmButton: false
  });
               }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                   
                }
            }
        });
    });
});

$(document).ready(function() {
         $('form#addCoordinatorFormSubmission').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: "{{route('addCoordinator')}}",
            data: formData,
            success: function(response) {
              load('close');
               if(response.message=== 'success'){
                Swal.fire({
    icon: 'success',
    title: 'Coordinator added successfully!',
    text: 'Reloading page shortly...',
    timer: 1500, // Auto-close after 2 seconds
    showConfirmButton: false
  }).then(() => {
    // Reload the page after a delay (optional)
    setTimeout(function() {
      location.reload();
    }, 500); // Reload after 2 seconds
  });
               }else{
                Swal.fire({
    icon: 'error',
    title: 'Invalid Username',
    text: 'An existing user is using this Username',
    timer: 1500, 
    showConfirmButton: false
  });
               }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                   
                }
            }
        });
    });
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