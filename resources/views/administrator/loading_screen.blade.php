<!-- resources/views/loading_screen.blade.php -->
<div class="loader dark:bg-gray-800" id="loader">
    <div id="center" class="center">
        <img src="{{asset('images/icon.png')}}" alt="logo" id="image">
        <div aria-label="Orange and tan hamster running in a metal wheel" role="img" id="hams" class="wheel-and-hamster">
            <div class="wheel"></div>
            <div class="hamster">
                <div class="hamster__body">
                    <div class="hamster__head">
                        <div class="hamster__ear"></div>
                        <div class="hamster__eye"></div>
                        <div class="hamster__nose"></div>
                    </div>
                    <div class="hamster__limb hamster__limb--fr"></div>
                    <div class="hamster__limb hamster__limb--fl"></div>
                    <div class="hamster__limb hamster__limb--br"></div>
                    <div class="hamster__limb hamster__limb--bl"></div>
                    <div class="hamster__tail"></div>
                </div>
            </div>
            <div class="spoke"></div>
        </div>
        @if($location == "dashboard")
        <h1 id="textLoad" class="dark:text-gray-200 mt-4">Loading Dashboard<span id="dotdot"></span></h1>
    @elseif($location == "survey")
        <h1 id="textLoad"  class="dark:text-gray-200 mt-4">Loading Evaluation Forms<span id="dotdot"></span></h1>
    @elseif($location == "assign")
        <h1 id="textLoad"  class="dark:text-gray-200 mt-4">Loading Parameters<span id="dotdot"></span></h1>
    @elseif($location == "view")
        <h1 id="textLoad"  class="dark:text-gray-200 mt-4">Loading Evaluation Result<span id="dotdot"></span></h1>
    @elseif($location == "all_user")
        <h1 id="textLoad"  class="dark:text-gray-200 mt-4">Loading All Users<span id="dotdot"></span></h1>
    @elseif($location == "admin")
        <h1 id="textLoad"  class="dark:text-gray-200 mt-4">Loading Administrator<span id="dotdot"></span></h1>
    @elseif($location == "class")
        <h1 id="textLoad"  class="dark:text-gray-200 mt-4">Loading Class Schedules<span id="dotdot"></span></h1>
    @elseif($location == "generate")
        <h1 id="textLoad"  class="dark:text-gray-200 mt-4">Loading Generate Reports<span id="dotdot"></span></h1>
    @endif
    </div>

 
</div>

<script>
    function setDot() {
  const dot = document.getElementById('dotdot');
  dot.innerHTML = '';

  let counter = 0;

  function addDot() {
    if (counter < 7) {
      setTimeout(() => {
        dot.textContent += '.';
        counter++;
        addDot(); 
      }, 300);
    }
  }

  addDot(); 
}



  window.addEventListener("load", function() {
    setInterval(() => {
              setDot();
              }, 2100);
        setTimeout(function() {
            var loader = document.getElementById("loader");
            var hams = document.getElementById("hams");
            var textLoad = document.getElementById("textLoad");
            loader.style.animation = "closes 2.5s";
            hams.style.animation = "move 2.5s";
            textLoad.style.display = "none";
            setTimeout(function() {

                loader.style.display = "none";
            }, 2500);
        }, 1000);
    });
</script>
