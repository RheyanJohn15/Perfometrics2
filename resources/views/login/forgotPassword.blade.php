
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
        <title>Forgot Password</title>
        
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('css/fontawesome-all.css')}}" rel="stylesheet">
        <link href="{{asset('css/swiper.css')}}" rel="stylesheet">
        <link href="{{asset('css/magnific-popup.css')}}" rel="stylesheet">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet">
        <link href="{{asset('css/mycss.css')}}" rel="stylesheet">
        <link href="{{asset('css/loading.css')}}" rel="stylesheet">
        <link href="{{asset('css/spinner.css')}}" rel="stylesheet">
        <!-- Favicon  -->
        <link rel="icon"  href="{{ asset('images/icon.png') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
                        <h1>Forgot Password</h1>
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
                        
                       @if ($type ==='student')
                        <!-- Contact Form -->
                        <form id="studentForgotForm" method="post"class="mt-5">
                            @csrf
                            @method('post')
                            <p>Verification Code will be sent to your recovery email</p>
                            <div class="form-group">
                             
                                <input name="lrn" id="studentEmail" type="number" class="form-control-input" required>
                                <label class="label-control" for="studentEmail">Learners Reference Number(LRN)</label>
                            </div>
                         
                            <div class="form-group">
                                <button type="submit" onclick="spinner()" name="submit" class="form-control-submit-button"><div id="studentSpinner" style="display: none">Loading.. <svg style="left: 50%;
                                    top: 50%;
                                    position: absolute;
                                    transform: translate(-50%, -50%) matrix(1, 0, 0, 1, 0, 0);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 187.3 93.7" height="100px" width="200px">
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" id="outline" stroke="#4E4FEB"></path>
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" stroke="#4E4FEB" fill="none" opacity="0.05" id="outline-bg"></path>
                                </svg></div><span id="studentText">Send Recovery Code</span></button>
                            </div>
                            <h3 style="color:#fd7e14; text-align:center; display:none" id="studentErrorMessage"></h3>
                        </form>
                        <form id="studentVerificationCode" method="post" style="display: none;" class="mt-5" style="width: 100%">
                            @csrf
                            @method('post')
                            <p>Enter the verification Code you recieved on your email</p>
                          
                            <input type="hidden" name="verificationCode"  id="emailStudentCode">
                            <div class="form-group" style="display: flex; justify-content:space-between;">
                                <input name="digit1" type="number" class="form-control-input" id="digit1" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit2'), 'none')">
                                <input name="digit2" type="number" class="form-control-input" id="digit2" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit3'), document.getElementById('digit1'))">
                                <input name="digit3" type="number" class="form-control-input" id="digit3" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit4'), document.getElementById('digit2'))">
                                <input name="digit4" type="number" class="form-control-input" id="digit4" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit5'), document.getElementById('digit3'))">
                                <input name="digit5" type="number" class="form-control-input" id="digit5" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit6'), document.getElementById('digit4'))">
                                <input name="digit6" type="number" class="form-control-input" id="digit6" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, 'none', document.getElementById('digit5'))">
                            </div>
                           
                            <p style="color:#fd7e14; text-align:center; display:none;" id="studentVerifcationError">Error Code</p>
                        </form>
                        <form id="studentChangePassword" method="post" style="display: none;"  class="mt-5 ">
                            @csrf
                            @method('post')
                            <p>Change Your Password(<span id="student_fname"></span>)</p>
                            <input type="hidden" name="student_id"  id="student_id">
                            <div class="form-group">
                             
                                <input name="newPass" id="studentnewPass" type="password" class="form-control-input" oninput="validate()" required>
                                <label class="label-control" for="studentnewPass">New Password</label>

                                <p style="color:#fd7e14; text-align:center; " id="studentPasswordError"></p>
                            </div>
                           
                         
                            <div class="form-group">
                             
                                <input oninput="validate()" name="confPass" id="studentconfirmPass" type="password" class="form-control-input"  required>
                                <label class="label-control" for="studentconfirmPass">Confirm Password</label>
                                <p style="color:#fd7e14; text-align:center; " id="studentConfirmError"></p>
                            </div>
                          
                         
                            <div class="form-group">
                                <button id="studentChangeButton" type="submit" onclick="spinner()" name="submit" class="form-control-submit-button"><div id="studentSpinner" style="display: none">Loading.. <svg style="left: 50%;
                                    top: 50%;
                                    position: absolute;
                                    transform: translate(-50%, -50%) matrix(1, 0, 0, 1, 0, 0);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 187.3 93.7" height="100px" width="200px">
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" id="outline" stroke="#4E4FEB"></path>
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" stroke="#4E4FEB" fill="none" opacity="0.05" id="outline-bg"></path>
                                </svg></div><span id="studentText">Change Password</span></button>
                            </div>
                          
                        </form>
                        <script>
                            function spinner(){
                                const spinner = document.getElementById('studentSpinner');
                                const text = document.getElementById('studentText');
                                const email = document.getElementById('studentEmail');
                                spinner.style.display = '';
                                text.style.display ='none';

                                if(email.value===''){
                                spinner.style.display = 'none';
                                text.style.display ='';

                                }

                            }

                            function handleInput(inputField, nextInputField, prevInputField) {
    checkLengthVerification();
    inputField.addEventListener('input', function (e) {
        let value = e.target.value;
        
        // Remove any non-numeric characters
        value = value.replace(/\D/g, '');

        // Update the input field value
        e.target.value = value;

        if (value.length === 1) {
            // If a digit is entered, move the focus to the next input field
            nextInputField.focus();
        }
    });

    inputField.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && e.target.value === '') {
            // If Backspace is pressed and the input field is empty, move the focus to the previous input field
            prevInputField.focus();
        }
    });
}

function checkLengthVerification() {
    const input1 = document.getElementById('digit1');
    const input2 = document.getElementById('digit2');
    const input3 = document.getElementById('digit3');
    const input4 = document.getElementById('digit4');
    const input5 = document.getElementById('digit5');
    const input6 = document.getElementById('digit6');

    const errorVerifcationCode = document.getElementById('studentVerifcationError');
    

    const inputs = [input1, input2, input3, input4, input5, input6];
    let collectedCode = '';

    for (const input of inputs) {
        collectedCode += input.value;
        if (collectedCode.length === 6) {
            break;
        }
    }

    if (collectedCode.length < 6) {
        // Not yet 6 digits, do nothing
        return;
    }

    const verifiedCode = document.getElementById('emailStudentCode').value;

    if (collectedCode === verifiedCode) {
       const changePass = document.getElementById('studentChangePassword');
       const verified = document.getElementById('studentVerificationCode');

       verified.style.animation = "forgotOut 1s";
       setTimeout(()=>{
        changePass.style.display ='';
        changePass.style.animation = 'forgotIn 1s';
        verified.style.display= 'none';
       },1000);
      
    } else {
       input1.value='';
       input2.value='';
       input3.value='';
       input4.value='';
       input5.value='';
       input6.value='';
       errorVerifcationCode.style.display="";
       errorVerifcationCode.textContent="Verification Code does not match";
    }
}


function validate() {
    const stepNext = document.getElementById('studentChangeButton');
    const newPassword = document.getElementById("studentnewPass").value;
    const confirmPassword = document.getElementById("studentconfirmPass").value;

    // Reset error messages
    document.getElementById("studentPasswordError").textContent = "";
    document.getElementById("studentConfirmError").textContent = "";

    // Password requirements
    const lengthRequirement = 8;
    const symbolRegex = /[!@#$%^&*]/; // You can customize this regex for your symbol requirements
    const numberRegex = /\d/;
    const uppercaseRegex = /[A-Z]/;

    let isValid = true;

    // Check if the password length is met
    if (newPassword.length < lengthRequirement) {
        document.getElementById("studentPasswordError").textContent = "Password is too short.";
        isValid = false;
    }

    // Check for symbol, number, and uppercase requirements
    if (
        !symbolRegex.test(newPassword) ||
        !numberRegex.test(newPassword) ||
        !uppercaseRegex.test(newPassword)
    ) {
        document.getElementById("studentPasswordError").textContent =
            "Password should contain at least one symbol, one number, and one uppercase letter.";
        isValid = false;
    }

    // Check if passwords match
    if (newPassword !== confirmPassword) {
        document.getElementById("studentConfirmError").textContent =
            "Passwords do not match.";
        isValid = false;
        stepNext.disabled= true;
    }

    if (isValid) {
        stepNext.disabled= false;
    }
}

                        </script>
                        <!-- end of contact form -->
                      @elseif($type === 'teacher')
                         <!-- Contact Form -->
                         <form id="teacherForgotForm" method="post"class="mt-5">
                            @csrf
                            @method('post')
                            <p>Verification Code will be sent to your recovery email</p>
                            <div class="form-group">
                             
                                <input name="teacher_username" id="teacherEmail" type="text" class="form-control-input" required>
                                <label class="label-control" for="teacherEmail">Teacher Username</label>
                            </div>
                         
                            <div class="form-group">
                                <button type="submit" onclick="spinner()" name="submit" class="form-control-submit-button"><div id="teacherSpinner" style="display: none">Loading.. <svg style="left: 50%;
                                    top: 50%;
                                    position: absolute;
                                    transform: translate(-50%, -50%) matrix(1, 0, 0, 1, 0, 0);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 187.3 93.7" height="100px" width="200px">
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" id="outline" stroke="#4E4FEB"></path>
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" stroke="#4E4FEB" fill="none" opacity="0.05" id="outline-bg"></path>
                                </svg></div><span id="teacherText">Send Recovery Code</span></button>
                            </div>
                            <h3 style="color:#fd7e14; text-align:center; display:none" id="teacherErrorMessage"></h3>
                        </form>
                        <form id="teacherVerificationCode" method="post" style="display: none;" class="mt-5" style="width: 100%">
                            @csrf
                            @method('post')
                            <p>Enter the verification Code you recieved on your email</p>
                          
                            <input type="hidden" name="verificationCode"  id="emailTeacherCode">
                            <div class="form-group" style="display: flex; justify-content:space-between;">
                                <input name="digit1" type="number" class="form-control-input" id="digit1" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit2'), 'none')">
                                <input name="digit2" type="number" class="form-control-input" id="digit2" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit3'), document.getElementById('digit1'))">
                                <input name="digit3" type="number" class="form-control-input" id="digit3" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit4'), document.getElementById('digit2'))">
                                <input name="digit4" type="number" class="form-control-input" id="digit4" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit5'), document.getElementById('digit3'))">
                                <input name="digit5" type="number" class="form-control-input" id="digit5" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit6'), document.getElementById('digit4'))">
                                <input name="digit6" type="number" class="form-control-input" id="digit6" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, 'none', document.getElementById('digit5'))">
                            </div>
                           
                            <p style="color:#fd7e14; text-align:center; display:none;" id="teacherVerifcationError">Error Code</p>
                        </form>
                        <form id="teacherChangePassword" method="post" style="display: none;"  class="mt-5 ">
                            @csrf
                            @method('post')
                            <p>Change Your Password(<span id="teacher_fname"></span>)</p>
                            <input type="hidden" name="teacher_id"  id="teacher_id">
                            <div class="form-group">
                             
                                <input name="newPass" id="teachernewPass" type="password" class="form-control-input" oninput="validate()" required>
                                <label class="label-control" for="teachernewPass">New Password</label>

                                <p style="color:#fd7e14; text-align:center; " id="teacherPasswordError"></p>
                            </div>
                           
                         
                            <div class="form-group">
                             
                                <input oninput="validate()" name="confPass" id="teacherconfirmPass" type="password" class="form-control-input"  required>
                                <label class="label-control" for="teacherconfirmPass">Confirm Password</label>
                                <p style="color:#fd7e14; text-align:center; " id="teacherConfirmError"></p>
                            </div>
                          
                         
                            <div class="form-group">
                                <button id="teacherChangeButton" type="submit" onclick="spinner()" name="submit" class="form-control-submit-button"><div id="teacherSpinner" style="display: none">Loading.. <svg style="left: 50%;
                                    top: 50%;
                                    position: absolute;
                                    transform: translate(-50%, -50%) matrix(1, 0, 0, 1, 0, 0);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 187.3 93.7" height="100px" width="200px">
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" id="outline" stroke="#4E4FEB"></path>
                                  <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" stroke="#4E4FEB" fill="none" opacity="0.05" id="outline-bg"></path>
                                </svg></div><span id="teacherText">Change Password</span></button>
                            </div>
                          
                        </form>
                        <script>
                            function spinner(){
                                const spinner = document.getElementById('teacherSpinner');
                                const text = document.getElementById('teacherText');
                                const email = document.getElementById('teacherEmail');
                                spinner.style.display = '';
                                text.style.display ='none';

                                if(email.value===''){
                                spinner.style.display = 'none';
                                text.style.display ='';

                                }

                            }

                            function handleInput(inputField, nextInputField, prevInputField) {
    checkLengthVerification();
    inputField.addEventListener('input', function (e) {
        let value = e.target.value;
        
        // Remove any non-numeric characters
        value = value.replace(/\D/g, '');

        // Update the input field value
        e.target.value = value;

        if (value.length === 1) {
            // If a digit is entered, move the focus to the next input field
            nextInputField.focus();
        }
    });

    inputField.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && e.target.value === '') {
            // If Backspace is pressed and the input field is empty, move the focus to the previous input field
            prevInputField.focus();
        }
    });
}

function checkLengthVerification() {
    const input1 = document.getElementById('digit1');
    const input2 = document.getElementById('digit2');
    const input3 = document.getElementById('digit3');
    const input4 = document.getElementById('digit4');
    const input5 = document.getElementById('digit5');
    const input6 = document.getElementById('digit6');

    const errorVerifcationCode = document.getElementById('teacherVerifcationError');
    

    const inputs = [input1, input2, input3, input4, input5, input6];
    let collectedCode = '';

    for (const input of inputs) {
        collectedCode += input.value;
        if (collectedCode.length === 6) {
            break;
        }
    }

    if (collectedCode.length < 6) {
        // Not yet 6 digits, do nothing
        return;
    }

    const verifiedCode = document.getElementById('emailTeacherCode').value;

    if (collectedCode === verifiedCode) {
       const changePass = document.getElementById('teacherChangePassword');
       const verified = document.getElementById('teacherVerificationCode');

       verified.style.animation = "forgotOut 1s";
       setTimeout(()=>{
        changePass.style.display ='';
        changePass.style.animation = 'forgotIn 1s';
        verified.style.display= 'none';
       },1000);
      
    } else {
       input1.value='';
       input2.value='';
       input3.value='';
       input4.value='';
       input5.value='';
       input6.value='';
       errorVerifcationCode.style.display="";
       errorVerifcationCode.textContent="Verification Code does not match";
    }
}


function validate() {
    const stepNext = document.getElementById('teacherChangeButton');
    const newPassword = document.getElementById("teachernewPass").value;
    const confirmPassword = document.getElementById("teacherconfirmPass").value;

    // Reset error messages
    document.getElementById("teacherPasswordError").textContent = "";
    document.getElementById("teacherConfirmError").textContent = "";

    // Password requirements
    const lengthRequirement = 8;
    const symbolRegex = /[!@#$%^&*]/; // You can customize this regex for your symbol requirements
    const numberRegex = /\d/;
    const uppercaseRegex = /[A-Z]/;

    let isValid = true;

    // Check if the password length is met
    if (newPassword.length < lengthRequirement) {
        document.getElementById("teacherPasswordError").textContent = "Password is too short.";
        isValid = false;
    }

    // Check for symbol, number, and uppercase requirements
    if (
        !symbolRegex.test(newPassword) ||
        !numberRegex.test(newPassword) ||
        !uppercaseRegex.test(newPassword)
    ) {
        document.getElementById("teacherPasswordError").textContent =
            "Password should contain at least one symbol, one number, and one uppercase letter.";
        isValid = false;
    }

    // Check if passwords match
    if (newPassword !== confirmPassword) {
        document.getElementById("teacherConfirmError").textContent =
            "Passwords do not match.";
        isValid = false;
        stepNext.disabled= true;
    }

    if (isValid) {
        stepNext.disabled= false;
    }
}

                        </script>
                        <!-- end of contact form -->
                    @else
                       <!-- Contact Form -->
                       <form id="coordinatorForgotForm" method="post"class="mt-5">
                        @csrf
                        @method('post')
                        <p>Verification Code will be sent to your recovery email</p>
                        <div class="form-group">
                         
                            <input name="coordinator_username" id="coordinatorEmail" type="text" class="form-control-input"  required>
                            <label class="label-control" for="coordinatorEmail">Coordinator Username</label>
                        </div>
                     
                        <div class="form-group">
                            <button type="submit" onclick="spinner()" name="submit" class="form-control-submit-button"><div id="coordinatorSpinner" style="display: none">Loading.. <svg style="left: 50%;
                                top: 50%;
                                position: absolute;
                                transform: translate(-50%, -50%) matrix(1, 0, 0, 1, 0, 0);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 187.3 93.7" height="100px" width="200px">
                              <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" id="outline" stroke="#4E4FEB"></path>
                              <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" stroke="#4E4FEB" fill="none" opacity="0.05" id="outline-bg"></path>
                            </svg></div><span id="coordinatorText">Send Recovery Code</span></button>
                        </div>
                        <h3 style="color:#fd7e14; text-align:center; display:none" id="coordinatorErrorMessage"></h3>
                    </form>
                    <form id="coordinatorVerificationCode" method="post" style="display: none;" class="mt-5" style="width: 100%">
                        @csrf
                        @method('post')
                        <p>Enter the verification Code you recieved on your email</p>
                      
                        <input type="hidden" name="verificationCode"  id="emailCoordinatorCode">
                        <div class="form-group" style="display: flex; justify-content:space-between;">
                            <input name="digit1" type="number" class="form-control-input" id="digit1" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit2'), 'none')">
                            <input name="digit2" type="number" class="form-control-input" id="digit2" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit3'), document.getElementById('digit1'))">
                            <input name="digit3" type="number" class="form-control-input" id="digit3" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit4'), document.getElementById('digit2'))">
                            <input name="digit4" type="number" class="form-control-input" id="digit4" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit5'), document.getElementById('digit3'))">
                            <input name="digit5" type="number" class="form-control-input" id="digit5" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, document.getElementById('digit6'), document.getElementById('digit4'))">
                            <input name="digit6" type="number" class="form-control-input" id="digit6" required maxlength="1" style="width: 10%; text-align: center; font-size: 3rem; padding:0" pattern="[0-9]" oninput="handleInput(this, 'none', document.getElementById('digit5'))">
                        </div>
                       
                        <p style="color:#fd7e14; text-align:center; display:none;" id="coordinatorVerifcationError">Error Code</p>
                    </form>
                    <form id="coordinatorChangePassword" method="post" style="display: none;"  class="mt-5 ">
                        @csrf
                        @method('post')
                        <p>Change Your Password(<span id="coordinator_fname"></span>)</p>
                        <input type="hidden" name="coordinator_id"  id="coordinator_id">
                        <div class="form-group">
                         
                            <input name="newPass" id="coordinatornewPass" type="password" class="form-control-input" oninput="validate()" required>
                            <label class="label-control" for="coordinatornewPass">New Password</label>

                            <p style="color:#fd7e14; text-align:center; " id="coordinatorPasswordError"></p>
                        </div>
                       
                     
                        <div class="form-group">
                         
                            <input oninput="validate()" name="confPass" id="coordinatorconfirmPass" type="password" class="form-control-input"  required>
                            <label class="label-control" for="coordinatorconfirmPass">Confirm Password</label>
                            <p style="color:#fd7e14; text-align:center; " id="coordinatorConfirmError"></p>
                        </div>
                      
                     
                        <div class="form-group">
                            <button id="coordinatorChangeButton" type="submit" onclick="spinner()" name="submit" class="form-control-submit-button"><div id="coordinatorSpinner" style="display: none">Loading.. <svg style="left: 50%;
                                top: 50%;
                                position: absolute;
                                transform: translate(-50%, -50%) matrix(1, 0, 0, 1, 0, 0);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 187.3 93.7" height="100px" width="200px">
                              <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" id="outline" stroke="#4E4FEB"></path>
                              <path d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 				c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" stroke-width="4" stroke="#4E4FEB" fill="none" opacity="0.05" id="outline-bg"></path>
                            </svg></div><span id="coordinatorText">Change Password</span></button>
                        </div>
                      
                    </form>
                    <script>
                        function spinner(){
                            const spinner = document.getElementById('coordinatorSpinner');
                            const text = document.getElementById('coordinatorText');
                            const email = document.getElementById('coordinatorEmail');
                            spinner.style.display = '';
                            text.style.display ='none';

                            if(email.value===''){
                            spinner.style.display = 'none';
                            text.style.display ='';

                            }

                        }

                        function handleInput(inputField, nextInputField, prevInputField) {
    checkLengthVerification();
    inputField.addEventListener('input', function (e) {
        let value = e.target.value;
        
        // Remove any non-numeric characters
        value = value.replace(/\D/g, '');

        // Update the input field value
        e.target.value = value;

        if (value.length === 1) {
            // If a digit is entered, move the focus to the next input field
            nextInputField.focus();
        }
    });

    inputField.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && e.target.value === '') {
            // If Backspace is pressed and the input field is empty, move the focus to the previous input field
            prevInputField.focus();
        }
    });
}

function checkLengthVerification() {
const input1 = document.getElementById('digit1');
const input2 = document.getElementById('digit2');
const input3 = document.getElementById('digit3');
const input4 = document.getElementById('digit4');
const input5 = document.getElementById('digit5');
const input6 = document.getElementById('digit6');

const errorVerifcationCode = document.getElementById('coordinatorVerifcationError');


const inputs = [input1, input2, input3, input4, input5, input6];
let collectedCode = '';

for (const input of inputs) {
    collectedCode += input.value;
    if (collectedCode.length === 6) {
        break;
    }
}

if (collectedCode.length < 6) {
    // Not yet 6 digits, do nothing
    return;
}

const verifiedCode = document.getElementById('emailCoordinatorCode').value;

if (collectedCode === verifiedCode) {
   const changePass = document.getElementById('coordinatorChangePassword');
   const verified = document.getElementById('coordinatorVerificationCode');

   verified.style.animation = "forgotOut 1s";
   setTimeout(()=>{
    changePass.style.display ='';
    changePass.style.animation = 'forgotIn 1s';
    verified.style.display= 'none';
   },1000);
  
} else {
   input1.value='';
   input2.value='';
   input3.value='';
   input4.value='';
   input5.value='';
   input6.value='';
   errorVerifcationCode.style.display="";
   errorVerifcationCode.textContent="Verification Code does not match";
}
}


function validate() {
const stepNext = document.getElementById('coordinatorChangeButton');
const newPassword = document.getElementById("coordinatornewPass").value;
const confirmPassword = document.getElementById("coordinatorconfirmPass").value;

// Reset error messages
document.getElementById("coordinatorPasswordError").textContent = "";
document.getElementById("coordinatorConfirmError").textContent = "";

// Password requirements
const lengthRequirement = 8;
const symbolRegex = /[!@#$%^&*]/; // You can customize this regex for your symbol requirements
const numberRegex = /\d/;
const uppercaseRegex = /[A-Z]/;

let isValid = true;

// Check if the password length is met
if (newPassword.length < lengthRequirement) {
    document.getElementById("coordinatorPasswordError").textContent = "Password is too short.";
    isValid = false;
}

// Check for symbol, number, and uppercase requirements
if (
    !symbolRegex.test(newPassword) ||
    !numberRegex.test(newPassword) ||
    !uppercaseRegex.test(newPassword)
) {
    document.getElementById("coordinatorPasswordError").textContent =
        "Password should contain at least one symbol, one number, and one uppercase letter.";
    isValid = false;
}

// Check if passwords match
if (newPassword !== confirmPassword) {
    document.getElementById("coordinatorConfirmError").textContent =
        "Passwords do not match.";
    isValid = false;
    stepNext.disabled= true;
}

if (isValid) {
    stepNext.disabled= false;
}
}

                    </script>
                    <!-- end of contact form -->
                       @endif
                       
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-form-1 -->
        <!-- end of form -->

    

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
        
            <script>
        $(document).ready(function() {
            $("form#studentForgotForm").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data using AJAX
                $.ajax({
                    type: "POST",
                    url: "{{route('studentForgotPass')}}", // Replace with the URL where you want to process the form data
                    data: formData,
                    success: function(response) {
                        const spinner = document.getElementById('studentSpinner');
                        const text = document.getElementById('studentText');
                        const email = document.getElementById('studentEmail');
                        const error = document.getElementById('studentErrorMessage');

                        if(response.message === 'Account Does not Exist'){
                           email.value='';
                           spinner.style.display='none';
                           text.style.display ='';
                           error.style.display='';
                           error.textContent = 'Account Does Not Exist';
                           setTimeout(() => {
                            error.style.animation ='errorTextOut 1s'
                            setTimeout(()=>{
                                error.style.animation='';
                                error.style.display='none';
                               
                            },1000)
                           }, 2000);
                        }else if(response.message === 'Account Does not Set Up Yet'){
                           email.value='';
                           spinner.style.display='none';
                           text.style.display ='';
                           error.style.display='';
                           error.textContent = 'Unable to recover non set up account';
                           setTimeout(() => {
                            error.style.animation ='errorTextOut 1s'
                            setTimeout(()=>{
                                error.style.animation='';
                                error.style.display='none';
                              
                            },1000)
                           }, 2000);
                        }else{
                           const studentVerificationCode = document.getElementById('studentVerificationCode');
                           const studentForgotForm = document.getElementById('studentForgotForm');
                           const studentCode = document.getElementById('emailStudentCode');
                           studentForgotForm.style.animation ='forgotOut 1s';
                          setTimeout(()=>{
                            studentVerificationCode.style.animation= 'forgotIn 1s';
                           studentVerificationCode.style.display = '';
                           studentForgotForm.style.display ='none';
                          },1000);
                          
                           studentCode.value = response.message;
                           document.getElementById('student_id').value= response.id;
                           document.getElementById('student_fname').textContent= response.name;
                           
                        }
                        
                    }
                });
            });
        });


        $(document).ready(function() {
            $("form#studentChangePassword").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data using AJAX
                $.ajax({
                    type: "POST",
                    url: "{{route('studentRecoverChangePass')}}", // Replace with the URL where you want to process the form data
                    data: formData,
                    success: function(response) {
                       if(response.message === "Success"){
                        Swal.fire({
        title: 'Success!',
        text: 'Password Change Success',
        icon: 'success',
        showConfirmButton: true, // Show the "OK" button
        allowOutsideClick: false, // Prevents closing by clicking outside
        allowEscapeKey: false, // Prevents closing by pressing the Escape key
    }).then((result) => {
        // You can handle the button click here if needed
        if (result.isConfirmed) {
            window.location.href= "{{route('login.index')}}";
        }
    });
                       }else{
                        Swal.fire({
        title: 'Error!',
        text: 'Password does not match',
        icon: 'error',
        showConfirmButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
    }).then((result) => {
        // You can handle the button click here
        if (result.isConfirmed) {
            // The "OK" button was clicked
            Swal.close(); // Close the failure modal
            // Add your custom logic here
        }
    });

                       }
                        
                    }
                });
            });
        });


//TEacher
        $(document).ready(function() {
            $("form#teacherForgotForm").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data using AJAX
                $.ajax({
                    type: "POST",
                    url: "{{route('teacherForgotPass')}}", // Replace with the URL where you want to process the form data
                    data: formData,
                    success: function(response) {
                        const spinner = document.getElementById('teacherSpinner');
                        const text = document.getElementById('teacherText');
                        const email = document.getElementById('teacherEmail');
                        const error = document.getElementById('teacherErrorMessage');

                        if(response.message === 'Account Does not Exist'){
                           email.value='';
                           spinner.style.display='none';
                           text.style.display ='';
                           error.style.display='';
                           error.textContent = 'Account Does Not Exist';
                           setTimeout(() => {
                            error.style.animation ='errorTextOut 1s'
                            setTimeout(()=>{
                                error.style.animation='';
                                error.style.display='none';
                               
                            },1000)
                           }, 2000);
                        }else if(response.message === 'Account Does not Set Up Yet'){
                           email.value='';
                           spinner.style.display='none';
                           text.style.display ='';
                           error.style.display='';
                           error.textContent = 'Unable to recover non set up account';
                           setTimeout(() => {
                            error.style.animation ='errorTextOut 1s'
                            setTimeout(()=>{
                                error.style.animation='';
                                error.style.display='none';
                              
                            },1000)
                           }, 2000);
                        }else{
                           const teacherVerificationCode = document.getElementById('teacherVerificationCode');
                           const teacherForgotForm = document.getElementById('teacherForgotForm');
                           const teacherCode = document.getElementById('emailTeacherCode');
                           teacherForgotForm.style.animation ='forgotOut 1s';
                          setTimeout(()=>{
                            teacherVerificationCode.style.animation= 'forgotIn 1s';
                            teacherVerificationCode.style.display = '';
                            teacherForgotForm.style.display ='none';
                          },1000);
                          
                           teacherCode.value = response.message;
                           document.getElementById('teacher_id').value= response.id;
                           document.getElementById('teacher_fname').textContent= response.name;
                           
                        }
                        
                    }
                });
            });
        });


        $(document).ready(function() {
            $("form#teacherChangePassword").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data using AJAX
                $.ajax({
                    type: "POST",
                    url: "{{route('teacherRecoverChangePass')}}", // Replace with the URL where you want to process the form data
                    data: formData,
                    success: function(response) {
                       if(response.message === "Success"){
                        Swal.fire({
        title: 'Success!',
        text: 'Password Change Success',
        icon: 'success',
        showConfirmButton: true, // Show the "OK" button
        allowOutsideClick: false, // Prevents closing by clicking outside
        allowEscapeKey: false, // Prevents closing by pressing the Escape key
    }).then((result) => {
        // You can handle the button click here if needed
        if (result.isConfirmed) {
            window.location.href= "{{route('login.index')}}";
        }
    });
                       }else{
                        Swal.fire({
        title: 'Error!',
        text: 'Password does not match',
        icon: 'error',
        showConfirmButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
    }).then((result) => {
        // You can handle the button click here
        if (result.isConfirmed) {
            // The "OK" button was clicked
            Swal.close(); // Close the failure modal
            // Add your custom logic here
        }
    });

                       }
                        
                    }
                });
            });
        });


        //Coordinator

        $(document).ready(function() {
            $("form#coordinatorForgotForm").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data using AJAX
                $.ajax({
                    type: "POST",
                    url: "{{route('coordinatorForgotPass')}}", // Replace with the URL where you want to process the form data
                    data: formData,
                    success: function(response) {
                        const spinner = document.getElementById('coordinatorSpinner');
                        const text = document.getElementById('coordinatorText');
                        const email = document.getElementById('coordinatorEmail');
                        const error = document.getElementById('coordinatorErrorMessage');

                        if(response.message === 'Account Does not Exist'){
                           email.value='';
                           spinner.style.display='none';
                           text.style.display ='';
                           error.style.display='';
                           error.textContent = 'Account Does Not Exist';
                           setTimeout(() => {
                            error.style.animation ='errorTextOut 1s'
                            setTimeout(()=>{
                                error.style.animation='';
                                error.style.display='none';
                               
                            },1000)
                           }, 2000);
                        }else if(response.message === 'Account Does not Set Up Yet'){
                           email.value='';
                           spinner.style.display='none';
                           text.style.display ='';
                           error.style.display='';
                           error.textContent = 'Unable to recover non set up account';
                           setTimeout(() => {
                            error.style.animation ='errorTextOut 1s'
                            setTimeout(()=>{
                                error.style.animation='';
                                error.style.display='none';
                              
                            },1000)
                           }, 2000);
                        }else{
                           const coordinatorVerificationCode = document.getElementById('coordinatorVerificationCode');
                           const coordinatorForgotForm = document.getElementById('coordinatorForgotForm');
                           const coordinatorCode = document.getElementById('emailCoordinatorCode');
                           coordinatorForgotForm.style.animation ='forgotOut 1s';
                          setTimeout(()=>{
                            coordinatorVerificationCode.style.animation= 'forgotIn 1s';
                            coordinatorVerificationCode.style.display = '';
                            coordinatorForgotForm.style.display ='none';
                          },1000);
                          
                          coordinatorCode.value = response.message;
                           document.getElementById('coordinator_id').value= response.id;
                           document.getElementById('coordinator_fname').textContent= response.name;
                           
                        }
                        
                    }
                });
            });
        });


        $(document).ready(function() {
            $("form#coordinatorChangePassword").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data using AJAX
                $.ajax({
                    type: "POST",
                    url: "{{route('coordinatorRecoverChangePass')}}", // Replace with the URL where you want to process the form data
                    data: formData,
                    success: function(response) {
                       if(response.message === "Success"){
                        Swal.fire({
        title: 'Success!',
        text: 'Password Change Success',
        icon: 'success',
        showConfirmButton: true, // Show the "OK" button
        allowOutsideClick: false, // Prevents closing by clicking outside
        allowEscapeKey: false, // Prevents closing by pressing the Escape key
    }).then((result) => {
        // You can handle the button click here if needed
        if (result.isConfirmed) {
            window.location.href= "{{route('login.index')}}";
        }
    });
                       }else{
                        Swal.fire({
        title: 'Error!',
        text: 'Password does not match',
        icon: 'error',
        showConfirmButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
    }).then((result) => {
        // You can handle the button click here
        if (result.isConfirmed) {
            // The "OK" button was clicked
            Swal.close(); // Close the failure modal
            // Add your custom logic here
        }
    });

                       }
                        
                    }
                });
            });
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