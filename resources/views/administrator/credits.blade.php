@if (session()->has('user_id') && session('user_type')==="Admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{{asset('dashboard/css/credits.css')}}"/>
  <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
  <meta name="theme-color" content="#7e3af2">
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Credits</title>
</head>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
<link rel="icon" href="{{asset('images/icon.png')}}">
<body class="bg-gray-800">
    <h4 style="font-size: 2rem" class="mt-4 mb-4 text-center text-xl font-semibold text-gray-200 dark:text-gray-300">
        Credits
         </h4>   

         <div class="flex w-full justify-between px-6 flex-col sm:flex-row gap-4 mt-16">

          <div class="dev flex justify-center flex-col" >
           <img src="{{asset('credits/dev1.png')}}" class="devPic" alt="dev1">

           <p class="mt-4  text-center text-xl font-semibold text-gray-200 dark:text-gray-300">
            Programmer
           </p>  
           <p class="  text-center text-xl text-gray-200 dark:text-gray-300">
            Rheyan John V. Blanco
           </p>  
          </div>

          <div class="dev flex flex-col" >
            <img src="{{asset('credits/dev2.png')}}" class="devPic" alt="dev1">
            <p class="mt-4  text-center text-xl font-semibold text-gray-200 dark:text-gray-300">
              Researcher/Document and Support
             </p>  
             <p class="  text-center text-xl text-gray-200 dark:text-gray-300">
              Jonah Grace F. Dumanon
             </p>  
          </div>
          <div class="dev flex justify-center flex-col" >
            
            <img src="{{asset('credits/dev3.png')}}" class="devPic" alt="dev1">
            
            <p class="mt-4  text-center text-xl font-semibold text-gray-200 dark:text-gray-300">
              Quality Assurance/Quality Control
             </p>  
             <p class="  text-center text-xl text-gray-200 dark:text-gray-300">
              Jan Russel G. Engracial
             </p>  
          </div>
          
         

         </div>

         <div class="allDev flex flex-col w-full ">
          <h4 class=" mb-4 text-center text-xl font-semibold text-gray-800 dark:text-gray-300">
            Thanks for the Support
               </h4> 
          <img src="{{asset('credits/all.jpg')}}" class="devPic" alt="dev1">
          <p class="mt-4 text-center text-l text-gray-200 dark:text-gray-300">
            We extend our heartfelt gratitude to our dedicated team members and mentors who have tirelessly contributed their time and expertise to bring this capstone project proposal system to fruition. Their unwavering support and commitment have been invaluable in shaping this project. As Bachelor of Science in Information Systems students, we also acknowledge the guidance and support from Carlos Hilado Memorial State University, which has been instrumental in our journey.
           </p>  
        </div>
        <p class="  text-center text-xl text-gray-200 dark:text-gray-300">
          &copy; Performetrics All Right Reserved 
         </p>  

        <p  class="click text-center text-xl text-gray-200 dark:text-gray-300">
          Click Anywhere to Return
         </p>  
<script>
  // Smoothly scrolls the page to the bottom
  function scrollToBottom() {
    const scrollStep = 3; // How many pixels to scroll per step
    const scrollInterval = 40; // Interval in milliseconds
  
    const scrollTo = (currentPosition, targetPosition) => {
      if (currentPosition <= targetPosition) {
        window.scrollBy(0, scrollStep);
        setTimeout(() => scrollTo(window.pageYOffset, targetPosition), scrollInterval);
      }
    };
  
    scrollTo(window.pageYOffset, document.body.scrollHeight);
  }
  
  // Call the function to start scrolling when the page loads
  window.onload = scrollToBottom;
  document.addEventListener("click", function(event) {
  // This function will be executed whenever a click event occurs anywhere in the document.
  window.location.href="{{route('settings')}}";
});
  </script>

</body>
</html>
@else
 @include('administrator.unauthorized')
@endif