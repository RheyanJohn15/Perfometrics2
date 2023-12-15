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
    <title>Student Profile - {{$student_username}}</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/profile.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <link rel="stylesheet" href="{{asset('/css/mycss.css')}}" />
    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                   <link rel="stylesheet" href="{{asset('/dashboard/css/loadWait.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <body>
       <div id="uploadingLoading" style="display: none;" class="loading">Loading&#8230;</div>
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
       {{$student_username}}
         </span> </a>
         <ul class="mt-6">
          <li class="relative px-6 py-3">
          <span
              class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"
            ></span>
            <a
              class="inline-flex items-center text-gray-800 w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
              href="{{route('studentProfile')}}"
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
            href="#"
          ><span style="text-align: center; font-size:15px">
          {{$student_username}}
          </span></a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
            <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center text-gray-800 w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('studentProfile')}}"
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
                        href="{{route('student_dashboard')}}"
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
                Student Information
              </h4>

            <div class="flex flex-col md:flex-row w-screen mt-4">
                <!-- First div - Occupies half width and whole height -->
                <div class="md:w-1/2 h-full mr-4 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                  <div class="profile">
                    
                    <div class="profileImage" style="background-image:url('{{$profilePic}}')"></div>
                    <div style="margin-top: -20px; align-items:center; display:flex; justify-content:center;" class="w-full" >  <button @click="openModal"
                       style="background: transparent" onclick="modal('changeProfilePic')">
                       <i class="fa-solid fa-camera" style="color:#7e3af2; font-size:1.75rem"></i>
                      </button></div>
                  </div>
                  <h4 class="mt-4 text-lg font-semibold text-xl text-center text-gray-600 dark:text-gray-300">
                    {{$fullname}}
                  </h4>
                  <h4 class=" text-sm  text-xs text-center text-gray-600 dark:text-gray-300">
                    LRN(Learners Reference Number): {{$student_id}}
                  </h4>
                  <h4 class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Personal Information
                  </h4>
                  <form style="display: block" action="{{route('updatePersonalData')}}" id="personalForm" method="POST" class="border border-solid-gray-800">
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
                <script>
                  function disablingSelect(event, selectedOption){
                    event.preventDefault();
                    var sectioningSelect= document.getElementById('sectioningSelect');
                    var strandSelect= document.getElementById('changeSections');
                    var currentStrand="{{$strand}}";
  
                    if(selectedOption.value===currentStrand){
                      sectioningSelect.disabled = false;
                    }else{
                      sectioningSelect.disabled = true;
                    }
                  }</script>
                     </div>
              
                  </form>


                  <form action="{{route('changePassword')}}" style="display: none" id="changePassword" method="POST" class="border border-solid-gray-800">
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
                       
                          <input type="hidden" name="getStudentId" value="{{$student_id}}" id="">
                 
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
                </div>
                <script>
                  function disablingSelect(event, selectedOption){
                    event.preventDefault();
                    var sectioningSelect= document.getElementById('sectioningSelect');
                    var strandSelect= document.getElementById('changeSections');
                    var currentStrand="{{$strand}}";
  
                    if(selectedOption.value===currentStrand){
                      sectioningSelect.disabled = false;
                    }else{
                      sectioningSelect.disabled = true;
                    }
                  }</script>
                <!-- Second div - Occupies half width and half height -->
                <div class="md:w-1/2 flex flex-col mt-4">
                  <div class="flex-1/2 px-4  py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mb-4">
                    <h4 class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                        School Information
                       </h4>
                    <div id="infoSchool" class="border border-solid-gray-800 p-4">
                           <h4 class="font-semibold text-lg text-gray-600 dark:text-gray-300">
                             Grade Level/Section: {{$trimYearLevel}} - {{$section_name}}
                            </h4>
                            <h4 class="mt-4 font-semibold text-lg text-gray-600 dark:text-gray-300">
                             Strand: {{App\Models\Strand::where('id', $strand)->first()->strand_name}}
                            </h4>
                    </div>
                
                    
                  </div>
                  <div class="flex-1/2 flex flex-col px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-4">
                    <h4 class="mt-4 mb-4 text-lg text-gray-600 dark:text-gray-300">
                       Options
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
            <button type="button"  @click="openModal" onclick="modal('changeMail')"
            class="px-4 mt-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
          <i class="fa-solid fa-envelope-circle-check"></i> Change Recovery Email <strong>({{$student_mail}})</strong> 
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
                  window.location.href="{{route('student_dashboard')}}";
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
  <div class="mt-4 mb-6" id="changeProfilePicModal">
 
<p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
  Change Profile Picture
</p>

<div class="profileHolder">
  <img id="preview" class="placeholder" capture="user" accept="image/*" src="{{$profilePic}}" alt="alt">

  <form id="uploadForm" method="post" action="{{route('updatePicture')}}" enctype="multipart/form-data">
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

  <div id="changeRecoveryEmail" style="display: none">
     <form action="" id="confirmationPassword" >
      <div class="mt-4 mb-6">
        <!-- Modal title -->
        <p
          class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
        >
          Change Email Recovery
        </p>
        <!-- Modal description -->
        <label class="block text-sm">
          <span class="text-gray-700 dark:text-gray-400">Enter your password</span>
          <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="Password"
            type="password"
            id="confirmRecoveryPassword"
          />
        </label>
        <span id="errorMatchPassword" style="display: none;" class="text-xs text-red-600 dark:text-red-400">
        Password does not match
        </span>
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
        <button type="button" onclick="confirmPasswordRecovery()"
          class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
          Confirm <i class="fa-solid fa-arrow-right"></i>
        </button>
      </footer>
     </form>

     <form id="newRecoveryEmail" style="display: none" method="post">
      @csrf
      @method('post')
      <div class="mt-4 mb-6">
        <!-- Modal title -->
        <p
          class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
        >
          Enter your new recovery email
        </p>
        <!-- Modal description -->
        <label class="block text-sm">
          <span class="text-gray-700 dark:text-gray-400">New Recovery Email</span>
          <input type="hidden" name="student_id" value="{{session('user_id')}}">
          <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="New Recovery Email"
            type="email"
            required
            id="newMail"
            name="newEmail"
          />
        </label>
        <span id="emailExist" style="display: none;" class="text-xs text-red-600 dark:text-red-400">
          Email is already used
           </span>
 
      </div>
      <footer
        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
      >
        <button
          type="button" onclick="backToPassword()"
          class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
        >
        <i class="fa-solid fa-arrow-left"></i> Previous
        </button>
        <button type="submit" onclick="onSpinner()" id="confirmButton"
          class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
          <span id="confirmText">Confirm <i class="fa-solid fa-arrow-right"></i></span> <span id="spinner" style="display: none" >Loading...</span>
        </button>
      </footer>
     </form>

     
     <form method="post" id="verificationForm" class="w-full" style="display: none;">
      @csrf
      @method('post')
      <div class="w-full mt-4 mb-6">
        <!-- Modal title -->
        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
            Enter your verification code sent in your new recovery email
        </p>
        <input type="hidden" id="verificationCode" name="verificationCode">
        <input type="hidden" name="student_id" value="{{session('user_id')}}">
        <input type="hidden" name="newEmail" id="newConfirmMail">
        <!-- Modal description -->
        <div class="flex justify-between p-4 space-x-4" >
            <input type="text" style="width: 3rem" class=" verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input w-1/6" maxlength="1" pattern="[0-9]" id="input1" oninput="handleInput(this, document.getElementById('input2'), 'none')">
            <input type="text" style="width: 3rem" class=" verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input w-1/6" maxlength="1" pattern="[0-9]" id="input2" oninput="handleInput(this, document.getElementById('input3'), document.getElementById('input1'))">
            <input type="text" style="width: 3rem" class=" verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input w-1/6" maxlength="1" pattern="[0-9]" id="input3" oninput="handleInput(this, document.getElementById('input4'), document.getElementById('input2'))">
            <input type="text" style="width: 3rem" class=" verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input w-1/6" maxlength="1" pattern="[0-9]" id="input4" oninput="handleInput(this, document.getElementById('input5'), document.getElementById('input3'))">
            <input type="text" style="width: 3rem" class=" verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input w-1/6" maxlength="1" pattern="[0-9]" id="input5" oninput="handleInput(this, document.getElementById('input6'), document.getElementById('input4'))">
            <input type="text" style="width: 3rem" class=" verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input w-1/6" maxlength="1" pattern="[0-9]" id="input6" oninput="handleInput(this, 'none', document.getElementById('input5'))">
        </div>
        <span id="errorVerificationCode" style="display: none" class="text-xs text-center text-red-600 dark:text-red-400">Verification Code does not match</span>
        <span id="verifiedCodeMessage" style="display: none" class="text-xs text-center text-green-600 dark:text-green-400">Verification Code does not match</span>
    
    </div>
    
      <footer
        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
      >
      <button
      type="button" onclick="backToEmail()"
      class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
    >
    <i class="fa-solid fa-arrow-left"></i> Previous
    </button>
      
      </footer>
     </form>

      
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

function modal(select){
  const changePic = document.getElementById('changeProfilePicModal');
  const changeMail = document.getElementById('changeRecoveryEmail');

  if(select === 'changeProfilePic'){
    
  changePic.style.display='';
  changeMail.style.display='none';
  }else{
    
  changePic.style.display='none';
  changeMail.style.display='';
  }
}

function handleInput(inputField, nextInputField, prevInputField) {
  checkLengthVerification();
    inputField.addEventListener('input', function (e) {
        let value = e.target.value;
        
        // Remove any non-numeric characters
        value = value.replace(/\D/g, '');

        // Update the input field value
        e.target.value = value;

        if (value.length === 1) {
            // If a digit is entered, move the focus to the next input field
            nextInputField.focus();
        }
    });

    inputField.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && e.target.value === '') {
            // If Backspace is pressed and the input field is empty, move the focus to the previous input field
            prevInputField.focus();
        }
    });
}
const inputs = document.querySelectorAll('.verifyInput');
 inputs.forEach((input, index) => {
     const nextIndex = index + 1 < inputs.length ? index + 1 : 0;
     const prevIndex = index > 0 ? index - 1 : inputs.length - 1;
 
     handleInput(input, inputs[nextIndex], inputs[prevIndex]);
 });
 
function confirmPasswordRecovery(){
  const password = "{{$password}}";
  const recoveryPassword = document.getElementById('confirmRecoveryPassword');
  const error = document.getElementById('errorMatchPassword');
  const step1 = document.getElementById('confirmationPassword');
  const step2 = document.getElementById('newRecoveryEmail');
  

  if(password === recoveryPassword.value){
    step1.style.animation= 'forgotOut 0.3s';
    setTimeout(() => {
      step1.style.display='none';
      step2.style.display='';
      step2.style.animation='forgotIn 0.3s';
    }, 300);
  }else{
    error.style.display='';
    recoveryPassword.value='';
  }
}

function backToPassword(){
  const step1 = document.getElementById('confirmationPassword');
  const step2 = document.getElementById('newRecoveryEmail');

  step2.style.animation= 'forgotOut 0.3s';
  setTimeout(()=>{
   step2.style.display= 'none';
   step1.style.animation= 'forgotIn 0.3s';
   step1.style.display= '';
  },300);
}

function backToEmail(){
  const step2 = document.getElementById('newRecoveryEmail');
  const step3 = document.getElementById('verificationForm');

  step3.style.animation= 'forgotOut 0.3s';
  setTimeout(()=>{
   step3.style.display= 'none';
   step2.style.animation= 'forgotIn 0.3s';
   step2.style.display= '';
  },300);
}

function checkLengthVerification() {
     const input1 = document.getElementById('input1');
     const input2 = document.getElementById('input2');
     const input3 = document.getElementById('input3');
     const input4 = document.getElementById('input4');
     const input5 = document.getElementById('input5');
     const input6 = document.getElementById('input6');
 
     const errorVerifcationCode = document.getElementById('errorVerificationCode');
 
     const inputs = [input1, input2, input3, input4, input5, input6];
     let collectedCode = '';
 
     for (const input of inputs) {
         collectedCode += input.value;
         if (collectedCode.length === 6) {
             break;
         }
     }
 
     if (collectedCode.length < 6) {
         // Not yet 6 digits, do nothing
         return;
     }
 
     const verifiedCode = document.getElementById('verificationCode').value;
 
     if (collectedCode === verifiedCode) {
         SaveDataVerified();
         const verifiedCodeMessage = document.getElementById('verifiedCodeMessage');
         verifiedCodeMessage.style.display="";
         verifiedCodeMessage.textContent = "Verifying.......";
         errorVerifcationCode.style.display="none";
         setTimeout(function(){
             verifiedCodeMessage.textContent = "Please Wait.......";
         },2000);
     } else {
        input1.value='';
        input2.value='';
        input3.value='';
        input4.value='';
        input5.value='';
        input6.value='';
        errorVerifcationCode.style.display="";
  
     }
 }
 
function onSpinner(){
  const confirmText = document.getElementById('confirmText');
  const spinner = document.getElementById('spinner');
  const button = document.getElementById('confirmButton');

  spinner.style.display='';
  confirmText.style.display='none';
  setTimeout(()=>{
    button.disabled= true;
  }, 300);
}
 
 $(document).ready(function() {
            $("form#newRecoveryEmail").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data using AJAX
                $.ajax({
                    type: "POST",
                    url: "{{route('changeRecoveryMailStudent')}}", // Replace with the URL where you want to process the form data
                    data: formData,
                    success: function(response) {

                      const recoveryMail = document.getElementById('newRecoveryEmail');
                      const verificationForm = document.getElementById('verificationForm');
                      const verificationCode = document.getElementById('verificationCode');
                      const emailExist = document.getElementById('emailExist');
                      const confirmNewMail = document.getElementById('newConfirmMail');
                      const newMail = document.getElementById('newMail');
                      const confirmText = document.getElementById('confirmText');
                      const spinner = document.getElementById('spinner');
                     const button = document.getElementById('confirmButton');

                      if(response.verificationCode!='error'){
                        recoveryMail.style.animation = 'forgotOut 0.3s';
                        confirmNewMail.value = newMail.value;
                        setTimeout(()=>{
                           recoveryMail.style.display='none';
                           verificationForm.style.animation= 'forgotIn 0.3s';
                           verificationForm.style.display='';
                           verificationCode.value = response.verificationCode;
                        }, 300)
                      }else{
                        emailExist.style.display='';
                        spinner.style.display='none';
                       confirmText.style.display='';
                       button.disabled= false;
                      }
                    }
                });
            });
        });

        function SaveDataVerified() {
     var formData = $('form#verificationForm').serialize();
 
     $.ajax({
         type: 'POST',
         url: "{{route('confirmChangeMailStudent')}}",
         data: formData,
         success: function(response) {
            if(response.message==='success'){
              Swal.fire({
        icon: 'success',
        title: 'Recovery Email Successfully Change!',
        text: 'The page will reload',
        showConfirmButton: false,
    });
              setTimeout(()=>{
                location.reload();
              },1000);
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