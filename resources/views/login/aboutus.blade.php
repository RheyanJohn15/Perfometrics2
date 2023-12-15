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
        <title>About Us</title>
        
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
                        <h1>Article Details</h1>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </header> <!-- end of ex-header -->
        <!-- end of header -->


        <!-- Basic -->
        <div class="ex-basic-1 pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img style="width: 100%;" class="img-fluid mt-5 mb-3" src="{{asset('images/article-details-large.jpg')}}" alt="alternative">
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-basic-1 -->
        <!-- end of basic -->


        <!-- Basic -->
        <div class="ex-basic-1 pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <h2 class="mb-3">Welcome to Perfometrics - A Web-based Evaluation System for Notre Dame Senior High!</h2>
                        <p>
                            
                            We are thrilled to present you with our capstone project, the Web-Based Faculty Performance Evaluation System with Data Analytics. Designed specifically for Notre Dame Senior High, this innovative system aims to revolutionize the evaluation process for faculty members while providing valuable insights through advanced data analytics.</p>
                        <p class="mb-4">Our team has put in countless hours of dedication and expertise to create a user-friendly and comprehensive platform that streamlines the evaluation process. Perfometrics empowers administrators, teachers, and staff members by providing them with an efficient and transparent system to evaluate faculty performance.</p>
                
                        <p>With Perfometrics, you can expect a range of features that enhance the evaluation experience. Our system offers a seamless login process, ensuring secure access for authorized users. Once logged in, administrators can effortlessly manage evaluation forms, set evaluation criteria, and monitor the progress of evaluations.</p>
                        <p class="mb-5">Faculty members will appreciate the intuitive interface that allows them to view their evaluations, submit self-assessments, and track their progress over time. Our system also encourages open communication by facilitating feedback and discussion between faculty members and evaluators.</p>

                            </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-basic-1 -->
        <!-- end of basic -->

        
        <!-- Basic -->
        <div class="ex-basic-1 pt-3 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                       
                        
                        <h2 class="mb-4">Data Analytics</h2>
                        <img class="img-fluid mb-5" src="{{asset('images/article-details-small.jpg')}}" alt="alternative">
                        <p>One of the most exciting aspects of Perfometrics is its integration of data analytics. By leveraging advanced algorithms and visualization techniques, our system generates actionable insights from evaluation data. These insights enable administrators and stakeholders to identify patterns, pinpoint areas of improvement, and make data-driven decisions to enhance faculty performance.</p>
                        <p class="mb-5">We are confident that Perfometrics will not only simplify the evaluation process but also provide a wealth of valuable information to support the growth and development of faculty members at Notre Dame Senior High. Our team is excited to have you on this journey as we embrace the power of technology to transform education.</p>
                        <div class="text-box mb-5">
                            <h3>Thank you for choosing Perfometrics, and we look forward to your valuable feedback and success stories as you embark on this new evaluation experience!</h3>
                            
                        </div> <!-- end of text-box -->
                                            </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-basic-1 -->
        <!-- end of basic -->

        <!-- Cards -->
        <div class="ex-cards-1 pt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <!-- Card -->
                        <div class="card">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <span class="fa-stack">
                                        <span class="fas fa-circle fa-stack-2x"></span>
                                        <span class="fa-stack-1x">1</span>
                                    </span>
                                    <div class="media-body">
                                        <h5>Project Leader/Programmer</h5>
                                        <p>Rheyan John V. Blanco</p>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- end of card -->
                        <!-- end of card -->

                        <!-- Card -->
                        <div class="card">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <span class="fa-stack">
                                        <span class="fas fa-circle fa-stack-2x"></span>
                                        <span class="fa-stack-1x">2</span>
                                    </span>
                                    <div class="media-body">
                                        <h6>Document & Support/Researcher</h6>
                                        <p>Jonah Grace Dumanon</p>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- end of card -->
                        <!-- end of card -->

                        <!-- Card -->
                        <div class="card">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <span class="fa-stack">
                                        <span class="fas fa-circle fa-stack-2x"></span>
                                        <span class="fa-stack-1x">3</span>
                                    </span>
                                    <div class="media-body">
                                        <h6>Quality Assurance/Quality Control</h6>
                                        <p>Jan Russel Engracial</p>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- end of card -->
                        <!-- end of card -->

                    </div> <!-- end of col -->   
                </div> <!-- end of row -->   
            </div> <!-- end of container -->   
        </div> <!-- end of ex-cards-1 -->
        <!-- end of cards -->



  <!-- Footer -->
  <div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4>Performance analysis made simple with Performetrics. <br><a href="mailto:rheyanjohn.blanco@chmsc.edu.ph">performetrics.notredame@deped.edu.ph</a></h4>
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