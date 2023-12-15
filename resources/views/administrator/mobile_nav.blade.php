<ul class="mt-6">
    <li class="relative px-6 py-3">
    @if($location==="dashboard")
    <span
        class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
        aria-hidden="true"
      ></span><a
      class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
      href="{{route('admin_dashboard')}}"
    >
    @else
    <a
        class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
        href="{{route('admin_dashboard')}}"
      >
    @endif
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
      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
    ></path>
  </svg>
  <span class="ml-4">Dashboard</span>
</a>
</li>
</ul>
<ul>
<li class="relative px-6 py-3">
    @if($location==="survey")
    <span
            class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"
          ></span><a
          class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
          href="{{route('admin_survey')}}"
        >
    @else
    <a
            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
            href="{{route('admin_survey')}}"
          >
    @endif
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
      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
    ></path>
  </svg>
  <span class="ml-4">Evaluation Form</span>
</a>
</li>

<li class="relative px-6 py-3">
    @if($location==="assign")
    <span
      class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
      aria-hidden="true"
    ></span><a
    class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
    href="{{route('assignTeacher')}}"
  >
  @else
  <a
      class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
      href="{{route('assignTeacher')}}"
    >
@endif
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
          <path d="M11,7H2v2h9V7zM11,15H2v2h9V15zM16.34,11l-3.54,-3.54l1.41,-1.41l2.12,2.12l4.24,-4.24L22,5.34L16.34,11zM16.34,19l-3.54,-3.54l1.41,-1.41l2.12,2.12l4.24,-4.24L22,13.34L16.34,19z"></path>
        </svg>
        <span class="ml-4">Parameters</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
    @if($location==="view_data")
    <span
    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
    aria-hidden="true"
  ></span><a
  class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
  href="{{route('viewData')}}"
>
@else
<a
      class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
      href="{{route('viewData')}}"
    >
@endif
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
<path d="M12,4.5C7,4.5 2.73,7.61 1,12c1.73,4.39 6,7.5 11,7.5s9.27,-3.11 11,-7.5c-1.73,-4.39 -6,-7.5 -11,-7.5zM12,17c-2.76,0 -5,-2.24 -5,-5s2.24,-5 5,-5 5,2.24 5,5 -2.24,5 -5,5zM12,9c-1.66,0 -3,1.34 -3,3s1.34,3 3,3 3,-1.34 3,-3 -1.34,-3 -3,-3z"></path>
</svg>
<span class="ml-4">Evaluation Result</span>
</a>
</li>
<li class="relative px-6 py-3">
@if($location==="all_user")
<span
      class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
      aria-hidden="true"
    ></span><a
    class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
    href="{{route('allUser')}}"
  >
@else
<a
      class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
      href="{{route('allUser')}}"
    >

@endif
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
<path d="M11.99,2c-5.52,0 -10,4.48 -10,10s4.48,10 10,10 10,-4.48 10,-10 -4.48,-10 -10,-10zM15.6,8.34c1.07,0 1.93,0.86 1.93,1.93 0,1.07 -0.86,1.93 -1.93,1.93 -1.07,0 -1.93,-0.86 -1.93,-1.93 -0.01,-1.07 0.86,-1.93 1.93,-1.93zM9.6,6.76c1.3,0 2.36,1.06 2.36,2.36 0,1.3 -1.06,2.36 -2.36,2.36s-2.36,-1.06 -2.36,-2.36c0,-1.31 1.05,-2.36 2.36,-2.36zM9.6,15.89v3.75c-2.4,-0.75 -4.3,-2.6 -5.14,-4.96 1.05,-1.12 3.67,-1.69 5.14,-1.69 0.53,0 1.2,0.08 1.9,0.22 -1.64,0.87 -1.9,2.02 -1.9,2.68zM11.99,20c-0.27,0 -0.53,-0.01 -0.79,-0.04v-4.07c0,-1.42 2.94,-2.13 4.4,-2.13 1.07,0 2.92,0.39 3.84,1.15 -1.17,2.97 -4.06,5.09 -7.45,5.09z"></path>
</svg>
<span class="ml-4">Users</span>
</a>
</li>
<!--
<li class="relative px-6 py-3">
@if($location==="addAdmin")
<span
class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
aria-hidden="true"
></span><a
class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
href="{{route('addAdminView')}}"
>
@else
<a
      class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
      href="{{route('addAdminView')}}"
    >
@endif
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
   d="M17,11c0.34,0 0.67,0.04 1,0.09V6.27L10.5,3L3,6.27v4.91c0,4.54 3.2,8.79 7.5,9.82c0.55,-0.13 1.08,-0.32 1.6,-0.55C11.41,19.47 11,18.28 11,17C11,13.69 13.69,11 17,11z"
 ></path>
 <path
   d="M17,13c-2.21,0 -4,1.79 -4,4c0,2.21 1.79,4 4,4s4,-1.79 4,-4C21,14.79 19.21,13 17,13zM17,14.38c0.62,0 1.12,0.51 1.12,1.12s-0.51,1.12 -1.12,1.12s-1.12,-0.51 -1.12,-1.12S16.38,14.38 17,14.38zM17,19.75c-0.93,0 -1.74,-0.46 -2.24,-1.17c0.05,-0.72 1.51,-1.08 2.24,-1.08s2.19,0.36 2.24,1.08C18.74,19.29 17.93,19.75 17,19.75z"
 ></path>  </svg>
<span class="ml-4">Administrator</span>
</a>
</li>-->
<li class="relative px-6 py-3">
    @if($location==="classSched")
    <span
      class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
      aria-hidden="true"
    ></span><a
    class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
    href="{{route('classSchedule')}}"
  >
  @else
  <a
      class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
      href="{{route('classSchedule')}}"
    >
    @endif
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
       d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM12,20c-4.42,0 -8,-3.58 -8,-8s3.58,-8 8,-8 8,3.58 8,8 -3.58,8 -8,8z"
     ></path>
     <path
       d="M12.5,7H11v6l5.25,3.15 0.75,-1.23 -4.5,-2.67z"
     ></path>  </svg>
  <span class="ml-4">Class Schedules</span>
</a>
</li><li class="relative px-6 py-3">
    @if($location==="export")
    <span
    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
    aria-hidden="true"
  ></span><a
  class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
  href="{{route('exportData')}}"
>
@else
<a
    class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 "
    href="{{route('exportData')}}"
  >
  @endif
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
     d="M20,6h-8l-2,-2L4,4c-1.1,0 -1.99,0.9 -1.99,2L2,18c0,1.1 0.9,2 2,2h16c1.1,0 2,-0.9 2,-2L22,8c0,-1.1 -0.9,-2 -2,-2zM20,18L4,18L4,8h16v10zM8,13.01l1.41,1.41L11,12.84L11,17h2v-4.16l1.59,1.59L16,13.01 12.01,9 8,13.01z"
   ></path>
   <path
     d="M12.5,7H11v6l5.25,3.15 0.75,-1.23 -4.5,-2.67z"
   ></path>  </svg>
<span class="ml-4">Generate Reports</span>
</a>
</li>
</ul>