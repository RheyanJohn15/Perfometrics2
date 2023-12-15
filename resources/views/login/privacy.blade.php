<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- SEO Meta Tags -->
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
        <title>Privacy Policy</title>
        
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
    <body data-spy="scroll" data-target=".fixed-top">
        @include('login.loading')
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
            <div class="container">
                
                <!-- Text Logo - Use this if you don't have a graphic logo -->
                <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Name</a> -->

                <!-- Image Logo -->
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
                        <h1>Privacy Policy</h1>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </header> <!-- end of ex-header -->
        <!-- end of header -->


        <!-- Basic -->
        <div class="ex-basic-1 pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <h2 class="mt-5 mb-3">1. Student Information</h2>
                        <p class="mb-5">Specify that student information will only be used for the purpose of evaluating teacher performance. Ensure that any student data collected is strictly limited to what is necessary for the evaluation process, and outline the steps taken to protect the confidentiality and privacy of student information.</p>
                      
                        <h2 class="mt-5 mb-3">2. Anonymity and Confidentiality</h2>
                        <p class="mb-5">Emphasize that evaluations submitted by students will be kept anonymous and confidential. Assure students that their identities will not be revealed to the teachers being evaluated, and that their responses will be aggregated to maintain privacy.</p>
                      
                        <h2 class="mt-5 mb-3">3. Age Restriction</h2>
                        <p class="mb-5"> Clarify that the system is intended for use by individuals of a certain age, in compliance with applicable laws and regulations regarding the collection and processing of personal information from minors.</p>
                      
                        
                        <h2 class="mt-5 mb-3">4. Consent and Parental Authorization</h2>
                        <p class="mb-5"> Clarify that the system is intended for use by individuals of a certain age, in compliance with applicable laws and regulations regarding the collection and processing of personal information from minors.</p>
                      
                        
                        <h2 class="mt-5 mb-3">5.Data Access and Sharing</h2>
                        <p class="mb-5">Specify who will have access to the evaluation data, such as administrators, principals, and relevant staff members. Highlight that access will be limited to authorized individuals with a legitimate need for the information. Explain that evaluation data will not be shared with unauthorized parties unless required by law.</p>
                      
                         
                        <h2 class="mt-5 mb-3">6.Data De-identification</h2>
                        <p class="mb-5">If evaluation data is used for research or statistical purposes, clarify how any personally identifiable information will be de-identified or anonymized to protect individual privacy.</p>
                         
                        <h2 class="mt-5 mb-3">7.Data Integrity and Accuracy</h2>
                        <p class="mb-5">Assure users that measures will be in place to ensure the accuracy and integrity of the evaluation data. Explain how users can request corrections or updates to their evaluation information if necessary.</p>
                         
                        <h2 class="mt-5 mb-3">8.Retention and Disposal</h2>
                        <p class="mb-5"> Define the retention period for evaluation data and specify the process for securely disposing of data after the retention period expires. Consider any legal requirements or internal policies regarding data retention.</p>
                         
                        <h2 class="mt-5 mb-3">9.Third-Party Services</h2>
                        <p class="mb-5"> If any third-party services or platforms are utilized for data storage, processing, or analytics, disclose this information and provide links to their privacy policies. Explain how data is protected when shared with these third parties.</p>
                         
                        <h2 class="mt-5 mb-3">10.Data Access and SharingTraining and Awareness</h2>
                        <p class="mb-5">Highlight that personnel involved in handling evaluation data receive appropriate training and are bound by confidentiality obligations to protect the privacy of users' information.</p>
                      
                    
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-basic-1 -->
        <!-- end of basic -->

 <!-- Footer -->
 <div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4>Performance analysis made simple with Performetrics.</h4>
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