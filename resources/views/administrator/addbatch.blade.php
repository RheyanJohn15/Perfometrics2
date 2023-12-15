@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#7e3af2">
    <title>Add Batch-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
  </head>
  <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <style>
    .custom-swal2-content {
            max-height: 70vh; /* You can adjust the max height as needed */
            overflow-y: auto;
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
          @if ($type === 'student')

           @php
               $strand= App\Models\Strand::where('id', $strand_id)->first();
               $section = App\Models\Section::where('id', $section_id)->first();
           @endphp
            <h4
            class="mt-4 text-center text-lg font-semibold text-gray-800 dark:text-gray-300"
          >
            {{$strand->strand_name}}
          </h4>
          <h4
          class="mb-4 text-center text-lg font-semibold text-gray-800 dark:text-gray-300"
        >
          {{$section->year_level}} - {{$section->section}}
        </h4>

        <form id="addBatchStudent" method="post">
          @csrf
          @method('post')
           @php
               $quantNum = $quantity;

           @endphp
           <script>
            var quantNum= 1;
           </script>
           <div id="studentFormDiv">
        
           @for ($i = 1; $i <= $quantNum; $i++)
           <div class="w-full flex gap-6 border border-solid border-gray-800 overflow-x-auto">
            <h4
            class=" mb-4 mt-8 ml-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
          >
            {{$i}}
          </h4>
        
              <label class="block text-sm mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">First Name</span>
                <input
                  class="block w-full mt-1 text-sm  dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="First Name"
                  required
                  type="text"
                  name="first_name[]"
                  oninput="validateInput(this)"
                />
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Middle Name"
                  type="text"
                  name="middle_name[]"
                  oninput="validateInput(this)"
                />
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Last Name"
                  required
                  type="text"
                  name="last_name[]"
                  oninput="validateInput(this)"
                />
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">
                  Suffix
                </span>
                <select
                name="suffix[]"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                <option value="none">None</option>
                <option value="Jr.">Jr.(Junior)</option>
                  <option value="Sr.">Sr.(Senior)</option>
                  <option value="I">I(The First)</option>
                  <option value="II">II(The Second)</option>
                  <option value="III">III(The Third)</option>
                  <option value="IV">IV(The Fourth)</option>
                  <option value="V">V(The Fifth)</option>
                </select>
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">LRN</span>
                <input
                  name="lrn[]"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Learners Reference Number"
                  required
                  type="number"
                  oninput="limitInputLength{{$i}}(this, 12)"
                />
                 <span id="errorMsg{{$i}}" class="text-xs text-red-600 dark:text-red-400">
                   12 More to submit
                </span>
              </label>
            
              <script>
              function limitInputLength{{$i}}(inputElement, maxLength) {
  const errormsg = document.getElementById('errorMsg{{$i}}');
  
  if (inputElement.value.length > maxLength) {
    inputElement.value = inputElement.value.slice(0, maxLength); // Truncate the input
  }

  const currentLength = inputElement.value.length;
  const remainingChars = maxLength - currentLength;

  if (remainingChars > 0) {
    errormsg.style.display = "";
    errormsg.textContent = remainingChars + " More to submit";
  } else {
    errormsg.style.display = "none";
  }
  const max= 12 * parseInt("{{$quantity}}");
  console.log(max);
  // Call unlockButton to update the button display
  unlockButton(max);
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
          
        </div>
               
           @endfor
          </div>
           <input type="hidden" name="strand" value="{{$strand_id}}">
           <input type="hidden" name="section" value="{{$section_id}}">
           <input type="hidden" name="quantity" value="{{$quantity}}">

        
        <div class="w-full flex justify-between">
            <button
            type="button" onclick="back()"
           class="px-4 mt-8  py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
         >
         <i class="fa-solid fa-rotate-left"></i>  Return
         </button>
            <button style="display: none;" id="submitButton"
            type="submit" style="float: right;"
           class="px-4 mt-8  py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
         >
         <i class="fa-solid fa-paper-plane"></i>  Submit All Student
         </button>
        </div>
        </form>
         
        <script>

function unlockButton(max) {
  const submitButton = document.getElementById('submitButton');
  const lrnInputs = document.querySelectorAll('input[name="lrn[]"]');

  let totalLength = 0;


  lrnInputs.forEach(function (input) {
    totalLength += input.value.length;
  });
  console.log("Num: "+totalLength);
  if (max === totalLength) {
    submitButton.style.display = '';
    console.log('display');
  } else {
    submitButton.style.display = 'none';
  
  }
}



        </script>
        
        @elseif($type ==='teacher')
        <h4
            class="mt-4 mb-4 text-center text-xl font-semibold text-gray-800 dark:text-gray-300"
          >
            Add Batch Teacher
          </h4>

          <form id="addBatchTeacher" method="post">
            
            @csrf
            @method('post')
             @php
                 $quantNum = $quantity;
  
             @endphp
             <script>
              var quantNum= 1;
             </script>
            <div id="teacherFormDiv">
              @for ($i = 1; $i <= $quantNum; $i++)
              <div class="w-full flex gap-6 border border-solid border-gray-800 overflow-x-auto">
               <h4
               class=" mb-4 mt-8 ml-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
             >
               {{$i}}
             </h4>
               <label class="block text-sm mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">First Name</span>
                   <input
                     class="block w-full mt-1 text-sm  dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="First Name"
                     required
                     type="text"
                     name="first_name[]"
                     oninput="validateInput(this)"
                   />
                 </label>
                 <label class="block text-sm  mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
                   <input
                     class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="Middle Name"
                     type="text"
                     name="middle_name[]"
                     oninput="validateInput(this)"
                   />
                 </label>
                 <label class="block text-sm  mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                   <input
                     class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="Last Name"
                     required
                     type="text"
                     name="last_name[]"
                     oninput="validateInput(this)"
                   />
                 </label>
                 <label class="block text-sm  mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">
                     Suffix
                   </span>
                   <select
                   name="suffix[]"
                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                   >
                   <option value="none">None</option>
                   <option value="Jr.">Jr.(Junior)</option>
                     <option value="Sr.">Sr.(Senior)</option>
                     <option value="I">I(The First)</option>
                     <option value="II">II(The Second)</option>
                     <option value="III">III(The Third)</option>
                     <option value="IV">IV(The Fourth)</option>
                     <option value="V">V(The Fifth)</option>
                   </select>
                 </label>
               
                 <script>
   
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
                 <input type="hidden" value="{{$quantity}}" name="quantity">
                 <label class="block text-sm  mb-4 mt-4 mr-6">
                   <span class="text-gray-700 dark:text-gray-400">Username</span>
                   <input
                     class="block w-full mt-1  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="Username"
                     required
                     type="text"
                     name="username[]"
                   />
                 </label>
           </div>
                  
              @endfor
             
            </div>
  
          
          <div class="w-full flex justify-between">
              <button
              type="button" onclick="back()"
             class="px-4 mt-8  py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
           >
           <i class="fa-solid fa-rotate-left"></i>  Return
           </button>
              <button      type="submit" style="float: right;"
             class="px-4 mt-8  py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
           >
           <i class="fa-solid fa-paper-plane"></i>  Submit All Teachers
           </button>
          </div>
          </form>


          @else
          <h4
            class="mt-4 mb-4 text-center text-xl font-semibold text-gray-800 dark:text-gray-300"
          >
            Add Batch Coordinator
          </h4>

          <form id="addBatchCoordinator" method="post">
            
            @csrf
            @method('post')
             @php
                 $quantNum = $quantity;
  
             @endphp
             <script>
              var quantNum= 1;
             </script>
        <div id="coordinatorFormDiv">
          @for ($i = 1; $i <= $quantNum; $i++)
          <div class="w-full flex gap-6 border border-solid border-gray-800 overflow-x-auto">
           <h4
           class=" mb-4 mt-8 ml-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
         >
           {{$i}}
         </h4>
           <label class="block text-sm mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">First Name</span>
               <input
                 class="block w-full mt-1 text-sm  dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="First Name"
                 required
                 type="text"
                 name="first_name[]"
                 oninput="validateInput(this)"
               />
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
               <input
                 class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="Middle Name"
                 type="text"
                 name="middle_name[]"
                 oninput="validateInput(this)"
               />
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">Last Name</span>
               <input
                 class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="Last Name"
                 required
                 type="text"
                 name="last_name[]"
                 oninput="validateInput(this)"
               />
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">
                 Suffix
               </span>
               <select
               name="suffix[]"
                 class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
               >
               <option value="none">None</option>
               <option value="Jr.">Jr.(Junior)</option>
                 <option value="Sr.">Sr.(Senior)</option>
                 <option value="I">I(The First)</option>
                 <option value="II">II(The Second)</option>
                 <option value="III">III(The Third)</option>
                 <option value="IV">IV(The Fourth)</option>
                 <option value="V">V(The Fifth)</option>
               </select>
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">
                 Position
               </span>
               <select
               required
               name="position[]"
               onchange="coordPosition{{$i}}()"
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
               <span id="coordPosition{{$i}}" class="text-xs text-gray-600 dark:text-gray-400">
               Please Select Coordinator Position
              </span>
             </label>
             <script>

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

function coordPosition{{$i}}(){
  const coord = document.getElementById('coordPosition'+{{$i}});
  coord.style.display= 'none';
}
             </script>
             <input type="hidden" value="{{$quantity}}" name="quantity">
             <label class="block text-sm  mb-4 mt-4 mr-6">
               <span class="text-gray-700 dark:text-gray-400">Username</span>
               <input
                 class="block w-full mt-1  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="Username"
                 required
                 type="text"
                 name="username[]"
               />
             </label>
       </div>
              
          @endfor
         
        </div>
  
          
          <div class="w-full flex justify-between">
              <button
              type="button" onclick="back()"
             class="px-4 mt-8  py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
           >
           <i class="fa-solid fa-rotate-left"></i>  Return
           </button>
              <button      type="submit" style="float: right;"
             class="px-4 mt-8  py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
           >
           <i class="fa-solid fa-paper-plane"></i>  Submit All Coordinators
           </button>
          </div>
          </form>


          @endif

          <script>
            function back(){
  window.location.href= "{{route('allUser')}}";
}
$(document).ready(function() {
        $('form#addBatchCoordinator').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting traditionally
            
            var formData = $(this).serialize(); // Serialize the form data
            
            $.ajax({
                type: 'POST',
                url: "{{route('addBatchCoordinator')}}", // Set the route to handle the form submission
                data: formData,
                success: function(response) {
                  var data = response.data;
                   var allSuccess = true;
                   var dataArray = new Array();
                   let counter= 1;
                   const quantity = data.filter(item => item.message === 'error').length;
                   const coordinatorDiv = document.getElementById('coordinatorFormDiv');
                   coordinatorDiv.innerHTML= '';

                data.forEach(function(item) {
                    if (item.message === 'error') {
                      dataArray.push(item.username);
                        allSuccess = false;
                        const html = ` <div class="w-full flex gap-6 border border-solid border-gray-800 overflow-x-auto">
           <h4
           class=" mb-4 mt-8 ml-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
         >
           ${counter}
         </h4>
           <label class="block text-sm mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">First Name</span>
               <input
                 class="block w-full mt-1 text-sm  dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="First Name"
                 required
                 type="text"
                 name="first_name[]"
                 oninput="validateInput(this)"
                 value= "${item.fname}"
               />
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
               <input
                 class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="Middle Name"
                 type="text"
                 name="middle_name[]"
                 oninput="validateInput(this)"
                 value="${item.mname}"
               />
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">Last Name</span>
               <input
                 class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="Last Name"
                 required
                 type="text"
                 name="last_name[]"
                 oninput="validateInput(this)"
                 value="${item.lname}"
               />
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">
                 Suffix
               </span>
               <select
               name="suffix[]"
                 class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
               >
               <option value="none" ${item.suffix === 'none' ? 'selected' : ''}>None</option>
      <option value="Jr." ${item.suffix === 'Jr.' ? 'selected' : ''}>Jr.(Junior)</option>
  <option value="Sr." ${item.suffix === 'Sr.' ? 'selected' : ''}>Sr.(Senior)</option>
  <option value="I" ${item.suffix === 'I' ? 'selected' : ''}>I(The First)</option>
  <option value="II" ${item.suffix === 'II' ? 'selected' : ''}>II(The Second)</option>
  <option value="III" ${item.suffix === 'III' ? 'selected' : ''}>III(The Third)</option>
  <option value="IV" ${item.suffix === 'IV' ? 'selected' : ''}>IV(The Fourth)</option>
  <option value="V" ${item.suffix === 'V' ? 'selected' : ''}>V(The Fifth)</option>
               </select>
             </label>
             <label class="block text-sm  mb-4 mt-4">
               <span class="text-gray-700 dark:text-gray-400">
                 Position
               </span>
               <select
               required
               name="position[]"
               onchange= "coordPosition${counter}()"
                 class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
               >
               <option  disabled selected>None</option>
               <option ${item.position === 'Principal' ? 'selected' : ''}>Principal</option>
              <option ${item.position === 'Assistant Principal' ? 'selected' : ''}>Assistant Principal</option>
              <option ${item.position === 'Curriculum Coordinator' ? 'selected' : ''}>Curriculum Coordinator</option>
              <option ${item.position === 'Teacher Professional Growth Coordinator' ? 'selected' : ''}>Teacher Professional Growth Coordinator</option>
              <option ${item.position === 'Human Resources' ? 'selected' : ''}>Human Resources</option>
              <option ${item.position === 'Teacher Evaluation Comittee' ? 'selected' : ''}>Teacher Evaluation Committee</option>
               </select>
               <span id="coordPosition${counter}" class="text-xs text-gray-600 dark:text-gray-400">
               Please Select Coordinator Position
              </span>
             </label>
             <input type="hidden" value="${quantity}" name="quantity">
             <label class="block text-sm  mb-4 mt-4 mr-6">
               <span class="text-gray-700 dark:text-gray-400">Username</span>
               <input
                 class="block w-full mt-1  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="Username"
                 required
                 type="text"
                 name="username[]"
                 value = "${item.username}"
               />
             </label>
       </div>
              `;

              const script = document.createElement('script');

              const coordPosFunction = `function coordPosition${counter}(){
  const coord = document.getElementById('coordPosition${counter}');
  coord.style.display= 'none';
}`;

script.innerHTML= coordPosFunction;

              counter++;
              coordinatorDiv.insertAdjacentHTML('beforeend', html);
              coordinatorDiv.appendChild(script);
                    }
                });

                

                if (allSuccess) {
                  Swal.fire({
    title: 'Succefully Added Student',
    text: 'Returning to All User Shortly.....',
    icon: 'success',
    confirmButtonText: 'Ok',
    allowOutsideClick: false,
 
  });
  setTimeout(() => {
    window.location.href="{{route('allUser')}}";
  }, 1500);
                }else{
                  let html = '';

dataArray.forEach(function(item) {
    html += '<li>Username: ' + item + '</li>';
});
function validateInput(inputElement) {
    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');

    var errorText = document.getElementById('errorText');
    if (/[^A-Za-z\s]/.test(inputElement.value)) {
        errorText.style.display = '';
        errorText.textContent = 'Only letters and spaces are allowed.';
    } else {
        errorText.textContent = '';
        errorText.style.display = 'none';
    }
  }
Swal.fire({
    title: 'Error: Some Username is invalid. Existing Users of that Username',
    html: '<div class="custom-swal2-content">' +
        '<ul>' + html + '</ul>' +
        '</div>',
    icon: 'error', // Set the icon to 'error'
    confirmButtonText: 'Ok',
    allowOutsideClick: true,
  });

        }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

    
$(document).ready(function() {
        $('form#addBatchTeacher').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting traditionally
            
            var formData = $(this).serialize(); // Serialize the form data
            
            $.ajax({
                type: 'POST',
                url: "{{route('addBatchTeacher')}}", // Set the route to handle the form submission
                data: formData,
                success: function(response) {
                  var data = response.data;
                   var allSuccess = true;
                   var dataArray = new Array();
                   let counter= 1;
                   const quantity = data.filter(item => item.message === 'error').length;
                   const teacherDiv = document.getElementById('teacherFormDiv');
                   teacherDiv.innerHTML= '';

                data.forEach(function(item) {
                    if (item.message === 'error') {
                      dataArray.push(item.username);
                        allSuccess = false;

                        const html= `<div class="w-full flex gap-6 border border-solid border-gray-800 overflow-x-auto">
               <h4
               class=" mb-4 mt-8 ml-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
             >
               ${counter}
             </h4>
               <label class="block text-sm mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">First Name</span>
                   <input
                     class="block w-full mt-1 text-sm  dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="First Name"
                     required
                     type="text"
                     name="first_name[]"
                     oninput="validateInput(this)"
                     value = "${item.fname}"
                   />
                 </label>
                 <label class="block text-sm  mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
                   <input
                     class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="Middle Name"
                     type="text"
                     name="middle_name[]"
                     oninput="validateInput(this)"
                     value = "${item.mname}"
                   />
                 </label>
                 <label class="block text-sm  mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                   <input
                     class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="Last Name"
                     required
                     type="text"
                     name="last_name[]"
                     oninput="validateInput(this)"
                     value = "${item.lname}"
                   />
                 </label>
                 <label class="block text-sm  mb-4 mt-4">
                   <span class="text-gray-700 dark:text-gray-400">
                     Suffix
                   </span>
                   <select
                   name="suffix[]"
                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                   >
                   <option value="none" ${item.suffix === 'none' ? 'selected' : ''}>None</option>
      <option value="Jr." ${item.suffix === 'Jr.' ? 'selected' : ''}>Jr.(Junior)</option>
  <option value="Sr." ${item.suffix === 'Sr.' ? 'selected' : ''}>Sr.(Senior)</option>
  <option value="I" ${item.suffix === 'I' ? 'selected' : ''}>I(The First)</option>
  <option value="II" ${item.suffix === 'II' ? 'selected' : ''}>II(The Second)</option>
  <option value="III" ${item.suffix === 'III' ? 'selected' : ''}>III(The Third)</option>
  <option value="IV" ${item.suffix === 'IV' ? 'selected' : ''}>IV(The Fourth)</option>
  <option value="V" ${item.suffix === 'V' ? 'selected' : ''}>V(The Fifth)</option>
                   </select>
                 </label>
               
                 <input type="hidden" value="${quantity}" name="quantity">
                 <label class="block text-sm  mb-4 mt-4 mr-6">
                   <span class="text-gray-700 dark:text-gray-400">Username</span>
                   <input
                     class="block w-full mt-1  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                     placeholder="Username"
                     required
                     type="text"
                     name="username[]"
                     value= "${item.username}"
                   />
                 </label>
           </div>`;

           teacherDiv.insertAdjacentHTML('beforeend', html);
           counter++;

                    }
                });

                

                if (allSuccess) {
                  Swal.fire({
    title: 'Succefully Added Teacher',
    text: 'Returning to All User Shortly.....',
    icon: 'success',
    confirmButtonText: 'Ok',
    allowOutsideClick: false,
 
  });
  setTimeout(() => {
    window.location.href="{{route('allUser')}}";
  }, 1500);
                }else{
                  let html = '';

dataArray.forEach(function(item) {
    html += '<li>Username: ' + item + '</li>';
});


function validateInput(inputElement) {
    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');

    var errorText = document.getElementById('errorText');
    if (/[^A-Za-z\s]/.test(inputElement.value)) {
        errorText.style.display = '';
        errorText.textContent = 'Only letters and spaces are allowed.';
    } else {
        errorText.textContent = '';
        errorText.style.display = 'none';
    }
  }

Swal.fire({
    title: 'Error: Some Username is invalid. Existing Users of that Username',
    html: '<div class="custom-swal2-content">' +
        '<ul>' + html + '</ul>' +
        '</div>',
    icon: 'error', // Set the icon to 'error'
    confirmButtonText: 'Ok',
    allowOutsideClick: true,
  });


        }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

    
$(document).ready(function() {
        $('form#addBatchStudent').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting traditionally
            
            var formData = $(this).serialize(); // Serialize the form data
            
            $.ajax({
                type: 'POST',
                url: "{{route('addBatchStudent')}}", // Set the route to handle the form submission
                data: formData,
                success: function(response) {
                  var data = response.data;
                   var allSuccess = true;
                   const lrnArray = new Array();
                   let counter= 1;
                   const quantity = data.filter(item => item.message === 'error').length;
                   const studentDiv = document.getElementById('studentFormDiv');
                 studentDiv.innerHTML= '';
                
                data.forEach(function(item) {
                    if (item.message === 'error') {
                      lrnArray.push(item.lrn);
                        allSuccess = false;

                     
             const html= `<div class="w-full flex gap-6 border border-solid border-gray-800 overflow-x-auto">
            <h4
            class=" mb-4 mt-8 ml-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
          >
          ${counter}
          </h4>
        
              <label class="block text-sm mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">First Name</span>
                <input
                  class="block w-full mt-1 text-sm  dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="First Name"
                  required
                  type="text"
                  name="first_name[]"
                  oninput="validateInput(this)"
                  value= "${item.firstName}"
                />
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Middle Name"
                  type="text"
                  name="middle_name[]"
                  oninput="validateInput(this)"
                  value = "${item.middleName}"
                />
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Last Name"
                  required
                  type="text"
                  name="last_name[]"
                  oninput="validateInput(this)"
                  value = "${item.lastName}"
                />
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">
                  Suffix
                </span>
                <select
                name="suffix[]"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                <option value="none" ${item.suffix === 'none' ? 'selected' : ''}>None</option>
      <option value="Jr." ${item.suffix === 'Jr.' ? 'selected' : ''}>Jr.(Junior)</option>
  <option value="Sr." ${item.suffix === 'Sr.' ? 'selected' : ''}>Sr.(Senior)</option>
  <option value="I" ${item.suffix === 'I' ? 'selected' : ''}>I(The First)</option>
  <option value="II" ${item.suffix === 'II' ? 'selected' : ''}>II(The Second)</option>
  <option value="III" ${item.suffix === 'III' ? 'selected' : ''}>III(The Third)</option>
  <option value="IV" ${item.suffix === 'IV' ? 'selected' : ''}>IV(The Fourth)</option>
  <option value="V" ${item.suffix === 'V' ? 'selected' : ''}>V(The Fifth)</option>
                </select>
              </label>
              <label class="block text-sm  mb-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400">LRN</span>
                <input
                  name="lrn[]"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Learners Reference Number"
                  required
                  type="number"
                  oninput="limitInputLength${counter}(this, 12)"
                  value = "${item.lrn}"
                />
                 <span id="errorMsg${counter}" style= 'none' class="text-xs text-red-600 dark:text-red-400">
                   12 More to submit
                </span>
              </label>
            
             
          </div> `;

          const script = document.createElement('script');
          var limitFunction = `
          function limitInputLength${counter}(inputElement,maxLength) {
    const errormsg = document.getElementById('errorMsg' + ${counter});

    if (inputElement.value.length > maxLength) {
        inputElement.value = inputElement.value.slice(0, maxLength);
    }

    const currentLength = inputElement.value.length;
    const remainingChars = maxLength - currentLength;

    if (remainingChars > 0) {
        errormsg.style.display = '';
        errormsg.textContent = remainingChars + ' More to submit';
    } else {
        errormsg.style.display = 'none';
    }
    const max = 12 * parseInt(${quantity});
    console.log(max);
    // Call unlockButton to update the button display
    unlockButton(max);
}

`;
script.innerHTML = limitFunction;
        
  studentDiv.insertAdjacentHTML('beforeend', html);
  studentDiv.appendChild(script);
  counter++;

                    }
                });

                

                if (allSuccess) {
                  Swal.fire({
    title: 'Succefully Added Student',
    text: 'Returning to All User Shortly.....',
    icon: 'success',
    confirmButtonText: 'Ok',
    allowOutsideClick: false,
 
  });
  setTimeout(() => {
    window.location.href="{{route('allUser')}}";
  }, 1500);
                }else{
                  let html = '';

lrnArray.forEach(function(item) {
    html += '<li>LRN: ' + item + '</li>';
});


function unlockButton(max) {
  const submitButton = document.getElementById('submitButton');
  const lrnInputs = document.querySelectorAll('input[name="lrn[]"]');

  let totalLength = 0;


  lrnInputs.forEach(function (input) {
    totalLength += input.value.length;
  });
  console.log("Num: "+totalLength);
  if (max === totalLength) {
    submitButton.style.display = '';
    console.log('display');
  } else {
    submitButton.style.display = 'none';
  
  }
}
function validateInput(inputElement) {
    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');

    var errorText = document.getElementById('errorText');
    if (/[^A-Za-z\s]/.test(inputElement.value)) {
        errorText.style.display = '';
        errorText.textContent = 'Only letters and spaces are allowed.';
    } else {
        errorText.textContent = '';
        errorText.style.display = 'none';
    }
  }

  
Swal.fire({
    title: 'Error: Some LRN is invalid. Existing Users of that LRN',
    html: '<div class="custom-swal2-content">' +
        '<ul>' + html + '</ul>' +
        '</div>',
    icon: 'error', // Set the icon to 'error'
    confirmButtonText: 'Ok',
    allowOutsideClick: true,
  });


        }
                
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