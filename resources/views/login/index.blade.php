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
        <title>Performetrics</title>
        
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('css/fontawesome-all.css')}}" rel="stylesheet">
        <link href="{{asset('css/swiper.css')}}" rel="stylesheet">
        <link href="{{asset('css/magnific-popup.css')}}" rel="stylesheet">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet">
        <link href="{{asset('css/mycss.css')}}" rel="stylesheet">
        <link href="{{asset('css/loading.css')}}" rel="stylesheet">
        <link href="{{asset('css/button.css')}}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
                <a class="navbar-brand logo-image"  href="{{route('login.index')}}"><img  style="height:50px; width: 50px; border-radius:50%; "  src="{{asset('images/logo.jfif')}}" alt="alternative"></a> 

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
        <header id="header" class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid indexLogo" src="{{asset('images/logo.jfif')}}" style="border-radius: 50%; " alt="alternative">
                        </div> <!-- end of image-container -->
                    </div> <!-- end of div -->
                    <div class="col-lg-6">
                        
                        <div class="text-container" style="margin-top:0">
                            <h1 class="h1-large">Perfometrics</h1>
                            <p class="p-large">A Web-based Evaluation System For Notre Dame of Talisay Senior High School</p>
                            <div class="selectUser">
                                <button  type="submit" id="selectStudent" class="selectButton">Student</button>
                                <button type="submit" id="selectTeacher" class="selectButton">Teacher</button>
                                <button type="submit" id="selectCoordinator" class="selectButton">Coordinator</button>
                            </div>
                       
                            <!-- Registration Form -->
                            <div id="formStudent" class="form-container">
                                <form id="studForm" method="post" > 
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <input name="usernameStudent" type="number" class="form-control-input" id="studentUsername" required>
                                        <label class="label-control" for="studentUsername">Learner Reference Number(LRN)</label>
                                    </div>
                                     <div class="form-group">
                                        <input name="passwordStudent" type="password" class="form-control-input" id="studentPass" required>
                                        <label class="label-control" for="studentPass">Student Password</label>
                                    </div>
                                       
                                    <input type="checkbox" id="checkBoxStudent" onchange="showPass(this, 'studentPass')" style="margin-left:3%;" >
                                    <label for="checkBoxStudent">Show Password</label>
                                    
                                    <div class="form-group">
                                        <button name="loginStudent" id="loginButtonStudent"
                                        onclick="loaderChange('loginLoaderStudent', 'loginTextStudent', 'loginButtonStudent', 'studentUsername', 'studentPass')"
                                        type="submit" class="form-control-submit-button">
                                            <div class="loaderButtonDiv" id="loginLoaderStudent"><span class="loaderButtons"></span></div><span id="loginTextStudent">Start Evaluating as Student</span>
                                        </button>
                                    </div>
                                    
                                    <div style="text-align: center" class="form-group">  
                                        <a  href="{{ route('forgot') }}?type=student">Forgot Password</a> 
                                    </div>
                                 
                               
                                </form>
                            </div> <!-- end of form-container -->
                            <!-- end of registration form -->
                              <div id="formTeacher" style="display: none;" class="form-container">
                                <form id="teachForm" method="post" >
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <input name="usernameTeacher" type="text" class="form-control-input" id="teacherUsername" required>
                                        <label class="label-control" for="teacherUsername">Teacher Username</label>
                                    </div>
                                     <div class="form-group">
                                        <input name="passwordTeacher" type="password" class="form-control-input" id="teacherPassword" required>
                                        <label class="label-control" for="teacherPassword">Teacher Password</label>
                                    </div>
                                      <input type="checkbox" id="checkBoxStudent" onchange="showPass(this, 'teacherPassword')" style="margin-left:3%;" >
                                    <label for="checkBoxStudent">Show Password</label>
                                    <div class="form-group">
                                        <button name="loginTeacher" type="submit" id="loginButtonTeacher"
                                        onclick="loaderChange('loginLoaderTeacher', 'loginTextTeacher', 'loginButtonTeacher', 'teacherUsername', 'teacherPassword')"
                                        class="form-control-submit-button">
                                            <div class="loaderButtonDiv" id="loginLoaderTeacher"><span class="loaderButtons"></span></div><span id="loginTextTeacher">Login as Teacher</span>
                                        </button>
                                    </div>
                                            
                                    <div style="text-align: center" class="form-group">  
                                        <a  href="{{ route('forgot') }}?type=teacher">Forgot Password</a> 
                                    </div>
                                 
                                </form>
                            </div>


                            <div id="formCoordinator" style="display:none" class="form-container">
                                <form id="coordForm"  method="post">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <input name="usernameCoordinator" type="text" class="form-control-input" id="coordinatorUsername" required>
                                        <label class="label-control" for="coordinatorUsername">Coordinator Username</label>
                                    </div>
                                     <div class="form-group">
                                        <input name="passwordCoordinator" type="password" class="form-control-input" id="coordinatorPassword" required>
                                        <label class="label-control" for="coordinatorPassword">Coordinator Password</label>
                                    </div>
                                      <input type="checkbox" id="checkBoxStudent" onchange="showPass(this, 'coordinatorPassword')" style="margin-left:3%;" >
                                    <label for="checkBoxStudent">Show Password</label>
                                    <div class="form-group">
                                        <button name="loginCoordinator" id="loginButtonCoordinator"
                                        onclick="loaderChange('loginLoaderCoordinator', 'loginTextCoordinator', 'loginButtonCoordinator', 'coordinatorUsername', 'coordinatorPassword')"
                                        type="submit" class="form-control-submit-button">
                                            <div class="loaderButtonDiv" id="loginLoaderCoordinator"><span class="loaderButtons"></span></div><span id="loginTextCoordinator">Start Evaluating as Coordinator</span>
                                        </button>
                                    </div>
                                            
                                    <div style="text-align: center" class="form-group">  
                                        <a  href="{{ route('forgot') }}?type=coordinator">Forgot Password</a> 
                                    </div>
                                 
                                </form>
                             
                            </div> <!-- end of form-container -->
                            <!-- end of registration form -->


                          
                            <script>
                               function showPass(checkBox, input){
                                    if(checkBox.checked){
                                        document.getElementById(input).type= 'text';
                                    }else{
                                        document.getElementById(input).type= 'password';
                                    }
                                }
                                
                              $(document).ready(function() {
    $('form#coordForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: '{{ route('login_Coordinator') }}',
            data: formData,
            success: function(response) {
                Swal.fire({
                    title: 'Login Successfully',
                    text: 'Redirecting to dashboard. Please Wait...',
                    icon: 'success',
                    showConfirmButton: false
                });

                setTimeout(function() {
                    window.location.href = "{{route('coordinator_dashboard')}}";
                }, 1000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle the validation error
                    var responseJSON = xhr.responseJSON;
                    if (responseJSON && responseJSON.error) {
                        // Display the error message to the user (e.g., using a library like Swal)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Password, Check your credentials',
                            showConfirmButton: false,
                        });
                        const loginLoader= document.getElementById('loginLoaderCoordinator');
                        const loginText= document.getElementById('loginTextCoordinator');
                      const loginButton = document.getElementById('loginButtonCoordinator');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                    }
                } else if (xhr.status === 401) {
                    // Handle the case where the user is not found in the database
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please check your username.',
                        showConfirmButton: false,
                    });
                    const loginLoader= document.getElementById('loginLoaderCoordinator');
                        const loginText= document.getElementById('loginTextCoordinator');
                      const loginButton = document.getElementById('loginButtonCoordinator');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                } else {
                    // Handle other types of errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please Check your username.',
                        showConfirmButton: false,
                    });
                    const loginLoader= document.getElementById('loginLoaderCoordinator');
                        const loginText= document.getElementById('loginTextCoordinator');
                      const loginButton = document.getElementById('loginButtonCoordinator');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                }
            }
        });
    });
});


$(document).ready(function() {
    $('form#teachForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: '{{route('login_Teacher')}}',
            data: formData,
            success: function(response) {
                if (response.message === 'Login successful') {
            // Handle successful login
            Swal.fire({
                title: 'Login Successful',
                text: 'Redirecting to the dashboard...',
                icon: 'success',
                showConfirmButton: false
            });

            setTimeout(function() {
                window.location.href = "{{route('teacher_dashboard')}}";
            }, 1000);
        } else {
            // Handle other cases (e.g., validation errors)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.error,
                showConfirmButton: false,
            });
        }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle the validation error
                    var responseJSON = xhr.responseJSON;
                    if (responseJSON && responseJSON.error) {
                        // Display the error message to the user (e.g., using a library like Swal)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Password, Check your credentials',
                            showConfirmButton: false,
                        });
                        const loginLoader= document.getElementById('loginLoaderTeacher');
                        const loginText= document.getElementById('loginTextTeacher');
                      const loginButton = document.getElementById('loginButtonTeacher');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                    }
                } else if (xhr.status === 401) {
                    // Handle the case where the user is not found in the database
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please check your username.',
                        showConfirmButton: false,
                    });
                    const loginLoader= document.getElementById('loginLoaderTeacher');
                        const loginText= document.getElementById('loginTextTeacher');
                      const loginButton = document.getElementById('loginButtonTeacher');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                } else {
                    // Handle other types of errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please Check your username.',
                        showConfirmButton: false,
                    });
                  
                }
            }
        });
    });
});



$(document).ready(function() {
    $('form#studForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: '{{route('login_Student')}}',
            data: formData,
            success: function(response) {
                if (response.message === 'Login successful') {
            // Handle successful login
            Swal.fire({
                title: 'Login Successful',
                text: 'Redirecting to the dashboard...',
                icon: 'success',
                showConfirmButton: false
            });

            setTimeout(function() {
                window.location.href = "{{route('student_dashboard')}}";
            }, 1000);
        } else {
            // Handle other cases (e.g., validation errors)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.error,
                showConfirmButton: false,
            });
        }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle the validation error
                    var responseJSON = xhr.responseJSON;
                    if (responseJSON && responseJSON.error) {
                        // Display the error message to the user (e.g., using a library like Swal)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Password, Check your credentials',
                            showConfirmButton: false,
                        });
                        const loginLoader= document.getElementById('loginLoaderStudent');
                        const loginText= document.getElementById('loginTextStudent');
                      const loginButton = document.getElementById('loginButtonStudent');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                    }
                } else if (xhr.status === 401) {
                    // Handle the case where the user is not found in the database
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please check your username.',
                        showConfirmButton: false,
                    });
                    const loginLoader= document.getElementById('loginLoaderStudent');
                        const loginText= document.getElementById('loginTextStudent');
                      const loginButton = document.getElementById('loginButtonStudent');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                } else {
                    // Handle other types of errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please Check your username.',
                        showConfirmButton: false,
                    });
                }
            }
        });
    });
});

                              </script>
                        
                            <script>
                                var selectStudent= document.getElementById("selectStudent");
                                selectStudent.style.backgroundColor= "#FFFEBA";
                                selectStudent.style.color= "#010141";
                                var selectTeacher= document.getElementById("selectTeacher");
                                var selectCoordinator= document.getElementById("selectCoordinator");
                             

                                var formStudent= document.getElementById("formStudent");
                                var formTeacher= document.getElementById("formTeacher");
                                var formCoordinator= document.getElementById("formCoordinator");
                               
                           
                                selectStudent.onclick= function(){
                                    selectStudent.style.backgroundColor= "#FFFEBA";
                                    selectStudent.style.color= "#010141";
                                    selectTeacher.style.backgroundColor= "transparent";
                                    selectTeacher.style.color= "#FFFEBA";
                                    selectCoordinator.style.backgroundColor= "transparent";
                                    selectCoordinator.style.color= "#FFFEBA";
                                   
                                    
                                    formStudent.style.animation= "blurIn 0.3s";
                                    formCoordinator.style.animation= "exit 0.3s";
                                    formTeacher.style.animation= "exit 0.3s";
                                    
                                   setTimeout(function(){
                                    formStudent.style.display= "block";
                                    formTeacher.style.display= "none";
                                    formCoordinator.style.display= "none";
                                   },300);
                                    
                                }

                                selectTeacher.onclick= function(){
                                    selectStudent.style.backgroundColor= "transparent";
                                    selectStudent.style.color= "#FFFEBA";
                                    selectTeacher.style.backgroundColor= "#FFFEBA";
                                    selectTeacher.style.color= "#010141";
                                    selectCoordinator.style.backgroundColor= "transparent";
                                    selectCoordinator.style.color= "#FFFEBA";
                                   
                                    formStudent.style.animation= "exit 0.3s";
                                    formCoordinator.style.animation= "exit 0.3s";
                                    formTeacher.style.animation= "blurIn 0.3s";

                                    setTimeout(function(){
                                    formStudent.style.display= "none";
                                    formTeacher.style.display= "block";
                                    formCoordinator.style.display= "none";
                                    }, 300);
                                    
                                }

                                selectCoordinator.onclick= function(){
                                    selectStudent.style.backgroundColor= "transparent";
                                    selectStudent.style.color= "#FFFEBA";
                                    selectTeacher.style.backgroundColor= "transparent";
                                    selectTeacher.style.color= "#FFFEBA";
                                    selectCoordinator.style.backgroundColor= "#FFFEBA";
                                    selectCoordinator.style.color= "#010141";
                                   

                                    
                                    formStudent.style.animation= "exit 0.3s";
                                    formCoordinator.style.animation= "blurIn 0.3s";
                                    formTeacher.style.animation= "exit 0.3s";

                                  setTimeout(function(){
                                    formStudent.style.display= "none";
                                    formTeacher.style.display= "none";
                                    formCoordinator.style.display= "block";
                                  },300);
                                    
                                }

                            
                              
                                </script>
                        
                        </div> <!-- end of text-container -->

                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
            <svg class="frame-decoration" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 192.275"><defs><style>.cls-1{fill:#f3f6f9;}</style></defs><title>frame-decoration</title><path class="cls-1" d="M0,158.755s63.9,52.163,179.472,50.736c121.494-1.5,185.839-49.738,305.984-49.733,109.21,0,181.491,51.733,300.537,50.233,123.941-1.562,225.214-50.126,390.43-50.374,123.821-.185,353.982,58.374,458.976,56.373,217.907-4.153,284.6-57.236,284.6-57.236V351.03H0V158.755Z" transform="translate(0 -158.755)"/></svg>
        </header> <!-- end of header -->
        <!-- end of header -->


        <!-- Takeaways -->
        <div class="basic-1 bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <!-- Takeaway -->
                        <div class="takeaway-wrapper">
                            <div class="takeaway-container">
                                <div class="takeaway-icon">
                                    <i class="fas fa-user"></i>
                                </div> <!-- end of takeaway-icon -->
                                <div class="takeaway-text">
                                    <h5>Teacher Profiling</h5>
                                    Performetrics is a comprehensive faculty performance evaluation system that enables you to create detailed profiles of your teachers using data analysis. By gathering and analyzing data on various aspects of teaching, such as student feedback, assessment results, and attendance records, Performetrics provides valuable insights into each teacher's individual strengths and weaknesses. The system also allows you to set performance benchmarks and track progress over time, making it easy to monitor each teacher's development and identify areas for improvement. With its customizable reporting options and user-friendly interface, Performetrics streamlines the process of creating teacher profiles and provides a wealth of data that can help you optimize your faculty's performance.
                                </div> <!-- end of takeaway-text -->
                            </div> <!-- end of takeaway-container -->
                        </div> <!-- end of takeaway-wrapper -->
                        <!-- end of takeaway -->

                        <!-- Takeaway -->
                        <div class="takeaway-wrapper">
                            <div class="takeaway-container">
                                <div class="takeaway-icon bg-light-blue">
                                    <span class="fas fa-rocket"></span>
                                </div> <!-- end of takeaway-icon -->
                                <div class="takeaway-text">
                                    <h5>Data Analysis Algorithm</h5>
                                    Performetrics is a comprehensive faculty performance evaluation system that helps you assess and optimize your teachers' performance using data analysis. The system receives evaluation results from students and supervisors, and then analyzes the data to provide valuable insights into your faculty's strengths and weaknesses. By tracking performance over time and identifying areas for improvement, Performetrics helps you make data-driven decisions that can lead to better academic outcomes. With its user-friendly interface and customizable reporting options, Performetrics makes it easy to assess, analyze, and optimize your faculty's performance.
                                </div> <!-- end of takeaway-text -->
                            </div> <!-- end of takeaway-container -->
                        </div> <!-- end of takeaway-wrapper -->
                        <!-- end of takeaway -->

                        <!-- Takeaway -->
                        <div class="takeaway-wrapper">
                            <div class="takeaway-container">
                                <div class="takeaway-icon bg-purple">
                                    <span class="fas fa-funnel-dollar"></span>
                                </div> <!-- end of takeaway-icon -->
                                <div class="takeaway-text">
                                    <h5>Design for School Administration</h5>
                                    Performetrics is an efficient and user-friendly faculty performance evaluation system that benefits teachers, students, and administrative users alike. For teachers, Performetrics provides detailed performance profiles, performance benchmarks, and actionable insights that enable them to improve their teaching skills and achieve better academic outcomes. For students, Performetrics provides a platform for submitting feedback on their teachers and helps ensure that their learning experiences are optimized. For administrative users, Performetrics streamlines the performance evaluation process and provides customizable reporting options, making it easy to identify and optimize faculty performance. With its advanced analytics capabilities and user-friendly interface, Performetrics is an efficient and effective solution for anyone looking to assess, analyze, and optimize faculty performance.
                                </div> <!-- end of takeaway-text -->
                            </div> <!-- end of takeaway-container -->
                        </div> <!-- end of takeaway-wrapper -->
                        <!-- end of takeaway -->

                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of basic-1 -->
        <!-- end of takeaways -->


    


        <!-- Footer -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Performance analysis made simple with Performetrics.
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
        
        <div id="modal" class="MainModal">
            <div class="contentModal">
                <img  src="{{asset('images/logo.jfif')}}" alt="">
                <h4>Administrator Login Credentials</h4>
                <p>Evaluation processes and evaluation data are private data. Verify your identity as an Admin. </p>
                <div id="formAdmin" class="form-container container-fluid">
                    <form id="adminForm" method="post" >
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <input  type="text" class="form-control-input" name="usernameAdmin" id="adminUsername" required>
                            <label class="label-control" for="adminUsername">Admin Username</label>
                        </div>
                         <div class="form-group">
                            <input type="password" name="passwordAdmin" class="form-control-input" id="adminPassword" required>
                            <label class="label-control" for="adminPassword">Admin Password</label>
                        </div>
                        <div class="form-group" >
                            <button type="submit" id="loginButtonAdmin" 
                            onclick="loaderChange('loginLoaderAdmin', 'loginTextAdmin', 'loginButtonAdmin', 'adminUsername', 'adminPassword')" name="loginAdmin" 
                            class="adminButton"> <div class="loaderButtonDiv" id="loginLoaderAdmin"><span class="loaderButtons"></span></div><span id="loginTextAdmin">Login as Admin</span></button>
                           
                        </div>
                      
                    
                    </form>
                </div> <!-- end of form-container -->
           <script>
            
            function loaderChange(loader, text, button, usernameData, passwordData){
                const loginLoader= document.getElementById(loader);
                const loginText= document.getElementById(text);
                const loginButton = document.getElementById(button);
                const username= document.getElementById(usernameData);
                const password = document.getElementById(passwordData);

                if(username.value!="" && password.value!=""){
                loginLoader.style.display="flex";
                loginText.style.display="none";
                loginButton.classList.add('active');
                }else{
                loginButton.classList.remove('active');
                }

              
            }
  $(document).ready(function() {
    $('form#adminForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: '{{route('login_Admin')}}',
            data: formData,
            success: function(response) {
                if (response.message === 'Login successful') {
            // Handle successful login
            Swal.fire({
                title: 'Login Successful',
                text: 'Redirecting to the dashboard...',
                icon: 'success',
                showConfirmButton: false
            });

            setTimeout(function() {
                window.location.href = "{{route('admin_dashboard')}}";
            }, 1000);
        } else {
            // Handle other cases (e.g., validation errors)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.error,
                showConfirmButton: false,
            });
        }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle the validation error
                    var responseJSON = xhr.responseJSON;
                    if (responseJSON && responseJSON.error) {
                        // Display the error message to the user (e.g., using a library like Swal)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Password, Check your credentials',
                            showConfirmButton: false,
                        });
                        const loginLoader= document.getElementById('loginLoaderAdmin');
                        const loginText= document.getElementById('loginTextAdmin');
                      const loginButton = document.getElementById('loginButtonAdmin');

                    loginLoader.style.display="none";
                     loginText.style.display="";
                    loginButton.classList.remove('active');
                    }
                } else if (xhr.status === 401) {
                    // Handle the case where the user is not found in the database
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please check your username.',
                        showConfirmButton: false,
                    });
                    const loginLoader= document.getElementById('loginLoaderAdmin');
                    const loginText= document.getElementById('loginTextAdmin');
                    const loginButton = document.getElementById('loginButtonAdmin');

                    loginLoader.style.display="none";
                    loginText.style.display="";
                    loginButton.classList.remove('active');
                
                } else {
                    // Handle other types of errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User not found in the database. Please Check your username.',
                        showConfirmButton: false,
                    });
                }
            }
        });
    });
});
           </script>
            </div>
        </div>
        <script>
            document.addEventListener('keydown', function(event) {
              if (event.shiftKey && event.ctrlKey) {
            const modal= document.getElementById('modal');
            modal.style.display="flex";
            modal.style.opacity = 1;
         }
      });
      var modal= document.getElementById('modal');
      modal.addEventListener('click', function(event) {
  if (event.target === modal || event.target.classList.contains('modal-content')) {
    modal.style.opacity = 0; // Fade out the modal
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300); // Wait for fade out transition before hiding
  }
});
       </script>
        <!-- Scripts -->
        <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
        <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
        <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
        <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
        <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
        <script src="js/scripts.js"></script> <!-- Custom scripts -->
    </body>
</html>