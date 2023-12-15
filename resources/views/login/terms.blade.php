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
        <title>Terms & Conditions</title>
        
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

                <a class="navbar-brand logo-image"  href="{{route('login.index')}}"><img style="height:50px; width: 50px; border-radius:50%; " src="{{asset('images/logo.jfif')}}" alt="alternative"></a> 

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
                        <h1>Terms & Conditions</h1>
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
                        <div class="text-box mt-5 mb-5">
                            <p class="p-large">Terms and Conditions: Your Agreement to Use Perfometrics
                            </p>
                            <p class="p-large">Welcome to Perfometrics - A Web-based Evaluation System for Notre Dame Senior High! Before you proceed to access and use our system, it is important that you review and understand the following terms and conditions. By using Perfometrics, you agree to be bound by these terms, which form a legally binding agreement between you and the developers of Perfometrics.
                            </p>
                            <p class="p-large">Our Terms and Conditions outline the rights and obligations of users, as well as the rules and guidelines for utilizing Perfometrics. We have designed this agreement to ensure a secure, fair, and transparent environment for all users involved in the evaluation process. Please take the time to read the following information carefully.
                            </p>
                            
                        </div> <!-- end of text-box -->

                       
                        <h2 class="mb-3">By accessing and using Perfometrics, you acknowledge that:

                        </h2>
                          <ul class="list-unstyled li-space-lg mb-4">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">You understand and accept the responsibilities and obligations associated with using Perfometrics in accordance with applicable laws and regulations.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">You agree to use Perfometrics solely for its intended purposes, which include facilitating faculty performance evaluations and providing data analytics insights.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">You will maintain the confidentiality and security of your login credentials and will not share them with unauthorized individuals.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">You will not engage in any activities that could compromise the functionality, security, or integrity of Perfometrics or violate any laws or regulations.</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">You are aware of and consent to the collection, storage, and processing of your personal information as described in our Privacy Policy.</div>
                            </li>
                        </ul>
                      

                        <h2 class="mb-3">1. Acceptance of Terms </h2>
                        <p class="mb-5"> Clearly state that by using Perfometrics, users agree to be bound by the terms and conditions outlined in the agreement. Specify that continued use of the system constitutes ongoing acceptance of the terms.</p>
                      
                        
                        <h2 class="mb-3">2. User Obligations</h2>
                        <p class="mb-5"> Outline the responsibilities and obligations of users when accessing and using Perfometrics. This may include adhering to applicable laws and regulations, using the system only for its intended purposes, and maintaining the confidentiality of login credentials.</p>
                      
                        
                        <h2 class="mb-3">3. System Access</h2>
                        <p class="mb-5">Specify that access to Perfometrics is provided on a non-exclusive basis and may be subject to certain restrictions or limitations. Reserve the right to modify, suspend, or terminate access to the system at any time, with or without cause.</p>
                      
                        
                        <h2 class="mb-3">4. Intellectual Property</h2>
                        <p class="mb-5">Clarify ownership and intellectual property rights related to Perfometrics and its associated materials (such as logos, designs, and content). Specify that users are granted a limited, non-transferable, and non-exclusive right to use the system solely for its intended purposes.</p>
                      
                        
                        <h2 class="mb-3">5. Prohibited Activities</h2>
                        <p class="mb-5">Clearly state activities that are strictly prohibited when using Perfometrics, such as attempting to gain unauthorized access, interfering with the system's functionality, or engaging in any illegal or unethical behavior. Reserve the right to take appropriate action if such activities occur.</p>
                      
                        
                        <h2 class="mb-3">6. Privacy</h2>
                        <p class="mb-5">Reference the privacy policy and its role in governing the collection, use, and protection of user information. Highlight the importance of privacy and the commitment to safeguarding user data in accordance with applicable laws and regulations.</p>
                      
                        
                        <h2 class="mb-3">7. Limitation of Liability</h2>
                        <p class="mb-5">Specify that the use of Perfometrics is at the user's own risk. Clarify that the system and its content are provided on an "as-is" and "as-available" basis, without any warranties or guarantees. Limit liability for any damages or losses incurred while using the system.</p>
                      
                        
                        <h2 class="mb-3">8. Indemnification</h2>
                        <p class="mb-5">Outline the user's obligation to indemnify and hold harmless the developers, administrators, and stakeholders of Perfometrics from any claims, liabilities, or damages arising from their use of the system or any violation of the terms and conditions.</p>
                      
                        
                        <h2 class="mb-3">9. Modifications to Terms:</h2>
                        <p class="mb-5">State that the terms and conditions may be modified or updated from time to time. Specify that users will be notified of any material changes and their continued use of Perfometrics after the modifications constitutes acceptance of the revised terms.

                        </p>
                      
                        
                        <h2 class="mb-3">10.Governing Law and Jurisdiction </h2>
                        <p class="mb-5">Determine the applicable governing law and jurisdiction that will govern the agreement. Specify the courts or arbitration forums that have jurisdiction over any disputes arising from the use of Perfometrics.</p>
                      

                        <div class="text-box mt-5 mb-5">
                            <p class="p-large">Please note that Perfometrics reserves the right to modify, suspend, or terminate access to the system at any time, with or without cause. We may also update these Terms and Conditions periodically, and any modifications will be effective immediately upon posting.
                            </p>
                            
                            <p class="p-large">It is important to review these terms regularly to stay informed about any changes. Your continued use of Perfometrics after any modifications indicates your acceptance of the updated terms.
                            </p>
                        </div> <!-- end of text-box -->
                        <div class="text-box mb-5">
                            <h3>Thank you for choosing Perfometrics, and we look forward to providing you with a seamless and valuable evaluation experience.

                            </h3>
                               </div> <!-- end of text-box -->
                        <p class="mb-5">If you have any questions or concerns about these terms, please reach out to our support team. Your satisfaction and understanding of our Terms and Conditions are of utmost importance to us.</p>
                        
                        <a class="btn-solid-reg mb-5" href="{{route('login.index')}}">Start Using Perfometrics</a>
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