<div class="loader" id="loader">
    <div class="body" >
        <main class="loading">
            <div class="div first"></div>
            <div class="div second"></div>
            <div class="div third"></div>
          </main>
    </div>
</div>
<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
            var loader = document.getElementById("loader");
            loader.style.animation = "fades 1s linear";
            setTimeout(function() {
                var loader = document.getElementById("loader");
                loader.style.display = "none";
            }, 1000);
        }, 1000);
    });
</script>

