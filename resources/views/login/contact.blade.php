
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <meta name="description" content="An Evaluation System and Class Scheduler for Notre Dame with Data Analytics Utilization">
        <meta name="Developers" content="BSIS IV-A (CHMSU)">
        <meta name="theme-color" content="#7e3af2">

        <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
        <meta property="og:site_name" content="Performetrics" /> <!-- website name -->
        <meta property="og:site" content="perfometrics-notre-dame.com" /> <!-- website link -->
        <meta property="og:title" content="Notre Dame Evaluation System"/> <!-- title shown in the actual shared post -->
        <meta property="og:description" content="A Powerful Web Base Evaluation System with Class Scheduler developed for Notre Dame Talisay" /> <!-- description shown in the actual shared post -->
        <meta property="og:image" content="{{asset('images/perfometrics.png')}}" /> <!-- image link, make sure it's jpg -->
        <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
        <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->


        <!-- Webpage Title -->
        <title>Contact Us</title>
        
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('css/fontawesome-all.css')}}" rel="stylesheet">
        <link href="{{asset('css/swiper.css')}}" rel="stylesheet">
        <link href="{{asset('css/magnific-popup.css')}}" rel="stylesheet">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet">
        <link href="{{asset('css/mycss.css')}}" rel="stylesheet">
        <link href="{{asset('css/loading.css')}}" rel="stylesheet">
        <!-- Favicon  -->
        <link rel="icon"  href="{{ asset('images/icon.png') }}">
    </head>
    <body style="background-color: #010046;" data-spy="scroll" data-target=".fixed-top">
        @include('login.loading')
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
            <div class="container">
                
                <!-- Text Logo - Use this if you don't have a graphic logo -->
                <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Name</a> -->

                <a class="navbar-brand logo-image"  href="{{route('login.index')}}"><img style="height:50px; width: 50px; border-radius:50%; "  src="{{asset('images/logo.jfif')}}" alt="alternative"></a> 

                <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{route('login_aboutus')}}">About Us <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{route('login_terms')}}">Terms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{route('login_privacy')}}">Privacy</a>
                        </li>
                        
                    </ul>
                    <span class="nav-item">
                        <a class="btn-outline-sm" href="{{route('login_contactus')}}">Contact</a>
                    </span>
                </div> <!-- end of navbar-collapse -->
            </div> <!-- end of container -->
        </nav> <!-- end of navbar -->
        <!-- end of navigation -->


        <!-- Header -->
        <header class="ex-header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <h1>Send a message to us</h1>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </header> <!-- end of ex-header -->
        <!-- end of header -->


        <!-- Form -->
        <div class="ex-form-1 pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        
                        <!-- Contact Form -->
                        <form id="contactForm" method="post" action="{{route('sendMessage')}}" class="mt-5">
                            @csrf
                            @method('post')
                           
                            <div class="form-group">
                                <input name="email" type="email" class="form-control-input" id="cemail" required>
                                <label class="label-control" for="cemail">Email</label>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control-textarea" id="cmessage" required></textarea>
                                <label class="label-control"  for="cmessage">Your message <span id="character">0/255 Characters</span></label>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="form-control-submit-button">Submit Message</button>
                            </div>
                        </form>
                        <!-- end of contact form -->

                       
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-form-1 -->
        <!-- end of form -->

        <script>
     var message= document.getElementById("cmessage");
  var character = document.getElementById("character");

  message.addEventListener('input', function(){
  
    var text= message.value;
    var remaining= 255 - text.length;

    if(remaining>=0){
        character.textContent= text.length +'/255 Characters';
    }else{
       message.value= text.slice(0,255);
       character.textContent= '255/255 Characters';
    }
    
  });
</script>

        <!-- Footer -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Performance analysis made simple with Performetrics. </h4>
                        <div class="social-container">
                            <span class="fa-stack">
                                <a href="#your-link">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="#your-link">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="#your-link">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-pinterest-p fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="#your-link">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="#your-link">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-youtube fa-stack-1x"></i>
                                </a>
                            </span>
                        </div> <!-- end of social-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of footer -->  
        <!-- end of footer -->


        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled li-space-lg p-small">
                            <li><a href="{{route('login_aboutus')}}">About us</a></li>
                            <li><a href="{{route('login_terms')}}">Terms</a></li>
                            <li><a href="{{route('login_privacy')}}">Privacy</a></li>
                            <li><a href="{{route('login_contactus')}}">Contact</a></li>
                        </ul>
                    </div> <!-- end of col -->
                    <div class="col-lg-6">
                        <p class="p-small statement">Copyright © Perfometrics</p>
                    </div> <!-- end of col -->
                </div> <!-- enf of row -->
            </div> <!-- end of container -->
        </div> <!-- end of copyright --> 
        <!-- end of copyright -->
        
            
        
            
        <!-- Scripts -->
        <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
        <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
        <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
        <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
        <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
        <script src="js/scripts.js"></script> <!-- Custom scripts -->
    </body>
</html>