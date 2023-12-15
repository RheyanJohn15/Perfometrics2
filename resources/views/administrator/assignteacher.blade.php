@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Parameters-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <script src="{{asset('dashboard/js/quote.js')}}"></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  </head>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
  <style>
    tr.strands{
        cursor: pointer!important;
        
    }
   tbody tr.strands:hover{
      background:#e5e7eb !important ;
    }
    li:hover, .li:hover{
      cursor: pointer;
      color: #7e3af2;
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
    @include('administrator/loading_screen', ['location'=> 'assign'])
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
            href="{{route('assignTeacher')}}"
          ><span style="text-align: center; font-size:15px">
          {{$admin_username}}
          </span></a>
    @include('administrator/desktop_nav', ['location'=>'assign'])
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
            href="{{route('assignTeacher')}}"
          ><span style="text-align: center; font-size:15px">
         {{$admin_username}}
         ?>
          </span></a>
        @include('administrator/mobile_nav', ['location'=>'assign'])
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
             Parameters for Teacher Assignment
            </h2>

            @php
               $CurrentSem= App\Models\Admin::where('admin_type', 'Super Admin')->first();
            @endphp
            <h2
            class=" text-sm mb-4 text-gray-700 dark:text-gray-200"
          >
            Select Strand to see assigned Teacher or manage subjects (Current Semester: {{$CurrentSem->admin_sem}})
             <span class="underline" title="Show Subject List" style="float: right; cursor:pointer;" onclick="switchSubject(this)">Manage Subjects</span>
          </h2>  
            
          <div id="strandDiv" >

            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class=" strands text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Strand</th>
                      <th class="px-4 py-3">Year Level</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  @php
                  $strand=App\Models\Strand::where('id', '!=', 7)->get();
                  $g11=1;
                  @endphp
                  @foreach ($strand as $strands)
                      
                  
                  <tr onclick="EditOpenG11{{$g11}}()" class="strands text-gray-700 dark:text-gray-400 ">
                    <td class="px-4 py-3 text-sm">
                      {{$strands->strand_name}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      Grade 11
                    </td>
                   
                  </tr>
                  <script>
                    function EditOpenG11{{$g11}}(){
                      var strand_id= {{$strands->id}};
                      window.location.href= "{{route('editAssignedTeacher')}}?strand_id="+ strand_id + "&glevel=Grade11&section=Null";
                    }
                   </script>
               @php
                 $g11++;
               @endphp
                  @endforeach
                
              </tbody>
          </table>
        </div>
          </div>

          <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr 
                      class="strands text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Strand</th>
                      <th class="px-4 py-3">Year Level</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  @php
                  $strand=App\Models\Strand::where('id', '!=', 7)->get();
                  $g12=1;
                  @endphp
                  @foreach ($strand as $strands)
                      
                  
                  <tr onclick="EditOpenG12{{$g12}}()" class="strands text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm">
                      {{$strands->strand_name}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      Grade 12
                    </td>
                   
                  </tr>
                   <script>
                    function EditOpenG12{{$g12}}(){
                      var strand_id={{$strands->id}};
                      window.location.href= "{{route('editAssignedTeacher')}}?strand_id="+ strand_id + "&glevel=Grade12&section=Null";
                    }
                   </script>
                  
                  @php
                  $g12++;
                @endphp
                  @endforeach
              </tbody>
          </table>
        </div>
          </div>
          </div>


          <div id="subjectList" style="display: none">
         
            <div class="max-w-screen-md mx-auto">
              <table class="w-full border">
                  <thead>
                    <colgroup>
                      <col style="width: 20%">
                      <col style="width: 40%">
                       <col style="width: 40%">
                  </colgroup>
                  @php
                      $subjectSem = App\Models\Admin::where('admin_type', 'Super Admin')->first()->admin_sem;
                  @endphp
                      <tr class="bg-gray-300">
                          <th class="border p-2">Strand</th>
                          <th class="border p-2">Grade 11({{$subjectSem}} Semester)</th>
                          <th class="border p-2">Grade 12({{$subjectSem}} Semester)</th>
                     
                      </tr>
                  </thead>
                  <tbody>
                     @php
                         $strands = App\Models\Strand::where('id', '!=', 7)->get();
                     @endphp
                     @foreach ($strands as $strand)
                     <tr>
                      <td class="border p-2"><span @click = "openModal" class="li" onclick="editSubject(`null`, `null`, `add`, `{{$strand->id}}`, `{{$subjectSem}}`)">{{$strand->strand_name}}</span></td>
                      @php
                          $subject11= App\Models\AssignedSubject::where('assigned_year_level', 'Grade 11')->where('assigned_strand', $strand->id)->where('assigned_sem', $subjectSem)->get();
                          $subject12= App\Models\AssignedSubject::where('assigned_year_level', 'Grade 12')->where('assigned_strand', $strand->id)->where('assigned_sem', $subjectSem)->get();
                      @endphp
                       <td class="border p-2">
                     @foreach ($subject11 as $subject)
                     <ul style="margin-left: 40px;
                     list-style-type: disc;">
                      <li @click = "openModal" onclick="editSubject(`{{$subject->assigned_subject}}`, `{{$subject->id}}`, `edit`, `null`,`null`)"> {{$subject->assigned_subject}} </li>
                     </ul>
                   
                     @endforeach
                    </td>
                    <td class="border p-2">
                      @foreach ($subject12 as $subject)
                    <ul style="margin-left: 40px;
                     list-style-type: disc;">
                      <li  @click = "openModal" onclick="editSubject(`{{$subject->assigned_subject}}`, `{{$subject->id}}`), `edit`, `null`, `null`"> {{$subject->assigned_subject}} </li>
                     </ul>
                      @endforeach
                     </td>
                     
                  </tr>
                     @endforeach
      
        
                  </tbody>
              </table>
          </div>
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
          <form method="post" action="{{route('manageSubject')}}" style="display: none;" id="editSubmission">
            @csrf
            @method('post')
            <div class="mt-4 mb-6">
              <!-- Modal title -->
              <p
                class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
              >
                Edit Subject
              </p>
              <!-- Modal description -->
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Subject</span>
                <input type="hidden" id="subjectId" name="subjectId">
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Edit Subject"
                  name="subject"
                  type="text"
                  id="editSubject"
                />
              </label>
            </div>
            <footer
              class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
            >
              <button
                @click="closeModal" type="button"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
              >
                Cancel
              </button>
              <button type="submit" name="action" value="deletedSub"
              class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-solid fa-trash-can"></i>   Delete
            </button>
              <button type="submit" name="action" value="saveEdit"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
              <i class="fa-regular fa-floppy-disk"></i>   Save Changes
              </button>
            </footer>
          </form>

          <form method="post" style="display: none;" id="addSubject">
            @csrf
            @method('post')
            <div class="mt-4 mb-6">
              <!-- Modal title -->
              <p
                class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
              >
                Add Subject
              </p>
              <!-- Modal description -->
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Subject Name</span>
                <input type="hidden" id="strandId" name="strand">
                <input type="hidden" id="semester" name="sem">
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Subject"
                  name="subject"
                  type="text"
                  required
                  id="subjectName"
                />
              </label>
           
            
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Grade Level
                </span>
                <select name="gradeLevel" required
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                  <option>Grade 11</option>
                  <option>Grade 12</option>
                
                </select>
              </label>
            </div>
            <footer
              class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
            >
              <button
                @click="closeModal" type="button"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
              >
                Cancel
              </button>
         
              <button type="submit" 
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
              <i class="fa-regular fa-floppy-disk"></i>   Save Subject
              </button>
            </footer>
          </form>
          </div>
        </div>


        <script>
          function editSubject(subject, id, type, strand, sem){
            const subjectId = document.getElementById('subjectId');
            const editSubject = document.getElementById('editSubject');

            const editSubmission = document.getElementById('editSubmission');
            const addSubject = document.getElementById('addSubject');

            const semester = document.getElementById('semester');
            const strandId= document.getElementById('strandId');
           if(type === 'edit'){
            editSubject.value = subject;
            subjectId.value= id;
            addSubject.style.display= 'none';
            editSubmission.style.display= '';
           }else{
            semester.value= sem;
            strandId.value= strand;
            addSubject.style.display= '';
            editSubmission.style.display= 'none';
           }

          }

          let counter = 1;
          function switchSubject(trigger){
            const strand = document.getElementById('strandDiv');
            const subject = document.getElementById('subjectList');
            
          if(counter % 2 === 0){
            subject.style.display = 'none';
            strand.style.display= '';

            trigger.textContent = 'Manage Subjects';
          }else{

            subject.style.display = '';
            strand.style.display= 'none';

            trigger.textContent = 'Strand List';

          }
        counter++;
          }

          $(document).ready(function() {
      $('form#addSubject').submit(function(event) {
          event.preventDefault(); // Prevent the form from submitting traditionally
          
          var formData = $(this).serialize(); // Serialize the form data
          
          $.ajax({
              type: 'POST',
              url: "{{route('addSubject')}}", // Set the route to handle the form submission
              data: formData,
              success: function(response) {
                Swal.fire({
    title: 'Success',
    text: 'Subject Succefully added',
    icon: 'success',
    confirmButtonText: 'Ok',
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
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
@else
 @include('administrator.unauthorized')
@endif