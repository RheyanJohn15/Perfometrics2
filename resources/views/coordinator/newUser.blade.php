<div class="bgNewUser dark:bg-gray-800 overflow-x-auto mb-8" id="bgNewUser"  >
   <div id="starting" class="w-full h-full starting">
    <img class="imageNewUser" src="{{asset('images/icon.png')}}" alt="logo">
    <h3 id="firstNew" class="firstNew mt-4 text-6xl text-center font-semibold text-gray-700 dark:text-gray-200">Hi!..{{$name}}</h3>

    <h3 id="secondNew" style="display: none;" class="firstNew text-center mt-4 text-6xl font-semibold text-gray-700 dark:text-gray-200">Welcome to Perfometrics😊</h3>

   </div>

   <div id="passwordNew" style="display: none;" class="w-full h-full step1 mb-8">
   

    <div class="passText mb-8" >
        <h3  class="firstPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Welcome Notre Dame Talisay Students to Perfometrics!</h3>
        <img class="imageNewUserStep1" src="{{asset('images/icon.png')}}" alt="logo">
    
        <h3  class="secondPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Getting Started: Creating Your Account
        </h3>
        <h3  class="secondPass mt-4 text-center text-base text-gray-700 dark:text-gray-200">Thank you for choosing Perfometrics, the ultimate platform for student-driven faculty performance evaluation. This system allows you to actively participate in enhancing the quality of education in your school. Follow these simple steps to set up your new account and get started.</h3>
        <div class="mt-8 mb-8" id="step1Display">
            <h3  class="secondPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Step 1: Set Up Your Password  </h3>
            <h3  class="secondPass mt-4 text-center text-base text-gray-700 dark:text-gray-200">To get started, the password you used in your first login is your One Time Password(OTP) it means that you need to
                create your own password for the security of your account. Choose a strong password for your Perfometrics account. Make sure it's unique and something you can remember easily. A strong password ensures the safety of your data.
            </h3>
<label class="block text-sm mt-4">
    <span class="text-gray-700 dark:text-gray-400">New Password</span>
    <input
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
        placeholder="New Password"
        id="newPasswordInput"
        oninput="validate()"
        type="password"
    />
    <span id="passwordError" class="text-xs text-red-600 dark:text-red-400"></span>
</label>

<label class="block text-sm mt-4">
    <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
    <input
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
        placeholder="Confirm Password"
        id="confirmPasswordInput"
        oninput="validate()"
        type="password"
    />
    <span id="confirmPasswordError" class="text-xs text-red-600 dark:text-red-400"></span>
</label>
 
<div class="flex mt-6 text-sm">
    <label class="flex items-center dark:text-gray-400">
      <input
        type="checkbox"
        onchange="showPassword(this)"
        class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
      />
      <span class="ml-2">
        Show Password
      </span>
    </label>
  </div>
              <button style="float: right; display:none;" id="step1NextButton" onclick="proceedStep2()"
              class="px-4 mt-8 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
              Next <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>

        <form class="mt-8 mb-8" method="post"  id="step2Display" style="display: none;">
            @csrf
            @method('post')
            <h3  class="secondPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Step 2: Set Up Recovery Email</h3>
            <h3  class="secondPass mt-4 text-center text-base text-gray-700 dark:text-gray-200">It's important to have a recovery email associated with your account. This will help you regain access to your account in case you forget your password. Make sure to use a valid and frequently checked email address.
            </h3>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Recovery Email
                </span>
                <div
                  class="relative text-gray-500 focus-within:text-purple-600"
                >
                  <input
                    class="block w-full pr-20 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="Recovery Email"
                    type="email"
                    required
                    id="email"
                    name="email"
                  />
                 
                  <button type="submit" onclick="startCountdown(this)" id="countdownButton"
                    class="absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                  >
                    Send Verification Code
                  </button>
                </div>
              </label>
              <span id="countdownSpan" class="text-xs text-gray-600 dark:text-red-400" style="display: none">
                Email is already used by another user use different one
              </span>
            <br>
              <button  type="button"  onclick="backToStep1()"
              class="px-4 mt-8 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-solid fa-arrow-left"></i> Previous
            </button>
        </form>

        <form method="post" id="formSubmitVerifyFinal" style="display: none;">
            @csrf
            @method('post')
            <input type="hidden" id="formFinalPassword" name="finalPassword">
            <input type="hidden" id="formVerificationCode"  name="verifiedCode">
            <input type="hidden" id="formFinalMail" name="verifiedMail">
            <input type="hidden" name="user_id" value="{{$coordinator_id}}">
            <h3  class="secondPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Step 3: Enter Your Verification Code</h3>
            <h3  class="secondPass mt-4 text-center text-base text-gray-700 dark:text-gray-200">Once you're verified you're good to go and start your journey in Perfometrics
            </h3>

            <div class="w-full flex justify-between mt-4">
                <input type="number" class="block verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" maxlength="1" pattern="[0-9]" id="input1" oninput="handleInput(this, document.getElementById('input2'), 'none')">
                <input type="number" class="block verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" maxlength="1" pattern="[0-9]" id="input2" oninput="handleInput(this, document.getElementById('input3'), document.getElementById('input1'))">
                <input type="number" class="block verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" maxlength="1" pattern="[0-9]" id="input3" oninput="handleInput(this, document.getElementById('input4'), document.getElementById('input2'))">
                <input type="number" class="block verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" maxlength="1" pattern="[0-9]" id="input4" oninput="handleInput(this, document.getElementById('input5'), document.getElementById('input3'))">
                <input type="number" class="block verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outlinegray form-input" maxlength="1" pattern="[0-9]" id="input5" oninput="handleInput(this, document.getElementById('input6'), document.getElementById('input4'))">
                <input type="number" class="block verifyInput text-center text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outlinegray form-input" maxlength="1" pattern="[0-9]" id="input6" oninput="handleInput(this, 'none', document.getElementById('input5'))">
            </div>
          <div class="w-full text-center">
            <span id="errorVerificationCode" style="display: none" class="text-xs text-center text-red-600 dark:text-red-400">Verification Code does not match</span>
            <span id="verifiedCodeMessage" style="display: none" class="text-xs text-center text-green-600 dark:text-green-400">Verification Code does not match</span>
        
          </div>
       </form>



    </div>
   </div>


   <div id="finalGetStarted" style="display: none" class="passText">
      
        
    <h3  class="firstPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Welcome Notre Dame Talisay Students to Perfometrics!</h3>
    <img class="imageNewUserStep1 mt-8" src="{{asset('images/icon.png')}}" alt="logo">
    <h3  class="secondPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Succefully Set up your Account!!</h3>
  <br>

  <h3  class="secondPass mt-4 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">Your Input Drives Change</h3>
  <h3  class="secondPass mt-4 text-center text-base text-gray-700 dark:text-gray-200">With Perfometrics, you have a voice in the education system. Your feedback can lead to improvements in teaching methods, course materials, and more. Together, we can create a better learning environment.
  
   <br><br> Let's embark on this journey to elevate the quality of education together. Start now, and be a part of the change! <br><br>
    
    Ready to get started? Click the button below to begin your Perfometrics journey!</h3>
        <button class="custom-btn btn-2 mb-8 mt-8" onclick="startTheJourney()">Get Started</button>
   </div>
   
</div>


<script>

    const first = document.getElementById('firstNew');
    const second = document.getElementById('secondNew');
 
    const starting = document.getElementById('starting');
    const password = document.getElementById('passwordNew');
    setTimeout(function() {
    first.style.animation= "newFadeOut 1s";
    setTimeout(function(){
        first.style.display= "none";
        second.style.animation= "newFadeIn 2s";
        second.style.display= "";
      
            setTimeout(function(){
                starting.style.animation= "newFadeOut 1s";
                setTimeout(function(){
                   starting.style.display= "none";
                   password.style.animation = "newFadeIn 1s";
                   setTimeout(function(){
                      password.style.display= "";
                   },1000);

                }, 1000);
            }, 2000);
      
      
    },1000);
}, 3000);

function validate() {
    const stepNext = document.getElementById('step1NextButton');
    const newPassword = document.getElementById("newPasswordInput").value;
    const confirmPassword = document.getElementById("confirmPasswordInput").value;

    // Reset error messages
    document.getElementById("passwordError").textContent = "";
    document.getElementById("confirmPasswordError").textContent = "";

    // Password requirements
    const lengthRequirement = 8;
    const symbolRegex = /[!@#$%^&*]/; // You can customize this regex for your symbol requirements
    const numberRegex = /\d/;
    const uppercaseRegex = /[A-Z]/;

    let isValid = true;

    // Check if the password length is met
    if (newPassword.length < lengthRequirement) {
        document.getElementById("passwordError").textContent = "Password is too short.";
        isValid = false;
    }

    // Check for symbol, number, and uppercase requirements
    if (
        !symbolRegex.test(newPassword) ||
        !numberRegex.test(newPassword) ||
        !uppercaseRegex.test(newPassword)
    ) {
        document.getElementById("passwordError").textContent =
            "Password should contain at least one symbol, one number, and one uppercase letter.";
        isValid = false;
    }

    // Check if passwords match
    if (newPassword !== confirmPassword) {
        document.getElementById("confirmPasswordError").textContent =
            "Passwords do not match.";
        isValid = false;
        stepNext.style.display= "none";
    }

    if (isValid) {
        stepNext.style.display= "";
    }
}


function proceedStep2(){

    const step1 = document.getElementById('step1Display');
    const step2 = document.getElementById('step2Display');
    const password = document.getElementById('newPasswordInput');
    const finalPassword = document.getElementById('formFinalPassword');
    step1.style.display="none";
    step2.style.display="";

    finalPassword.value = password.value;
}


$(document).ready(function() {
      $('form#step2Display').submit(function(event) {
          event.preventDefault(); // Prevent the form from submitting traditionally
          
          var formData = $(this).serialize(); // Serialize the form data
          
          $.ajax({
              type: 'POST',
              url: '{{ route('coordinatorVerificationMail') }}', // Set the route to handle the form submission
              data: formData,
              success: function(response) {
                if(response.verificationCode==='Error'){
             
             const countdown = document.getElementById('countdownSpan');
             countdown.style.display= '';
             const button = document.getElementById('countdownButton');
             button.disabled=false;
             stopCountdown();
             button.textContent= 'Resend Verification';
          }else{
             const code = document.getElementById('formVerificationCode');
const step2 = document.getElementById('step2Display');
const verify = document.getElementById('formSubmitVerifyFinal');
const email = document.getElementById('email');
const verifiedMail = document.getElementById('formFinalMail');

step2.style.animation= 'newFadeOut 0.5s';
setTimeout(function(){
step2.style.display ='none';
verify.style.display="";
verify.style.animation= "newFadeIn 0.5s";
code.value= response.verificationCode;
verifiedMail.value = email.value;
},500);

          }
            
              
            
              },
              error: function(xhr) {
                  console.log(xhr.responseText);
              }
          });
      });
  });

  let countdownActive = true;

function startCountdown(button) {
    let seconds = 60;
    button.innerText = `Resend Code: ${seconds} seconds`;

    const countdownInterval = setInterval(function() {
        if (seconds > 1 && countdownActive) {
            seconds--;
            button.innerText = `Resend Code: ${seconds} seconds`;
        } else {
            clearInterval(countdownInterval);

            // Re-enable the button after 1 minute
            button.disabled = false;
            button.innerText = 'Resend Verification';
        }
    }, 1000);
}
function stopCountdown() {
    countdownActive = false;
    
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


// Attach the function to your input fields
const inputs = document.querySelectorAll('.verifyInput');
inputs.forEach((input, index) => {
    const nextIndex = index + 1 < inputs.length ? index + 1 : 0;
    const prevIndex = index > 0 ? index - 1 : inputs.length - 1;

    handleInput(input, inputs[nextIndex], inputs[prevIndex]);
});


function checkLengthVerification() {
    const input1 = document.getElementById('input1');
    const input2 = document.getElementById('input2');
    const input3 = document.getElementById('input3');
    const input4 = document.getElementById('input4');
    const input5 = document.getElementById('input5');
    const input6 = document.getElementById('input6');

    const errorVerifcationCode = document.getElementById('errorVerificationCode');
    const back = document.getElementById('backToStep2');

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

    const verifiedCode = document.getElementById('formVerificationCode').value;

    if (collectedCode === verifiedCode) {
        SaveDataVerified();
        const verifiedCodeMessage = document.getElementById('verifiedCodeMessage');
        verifiedCodeMessage.style.display="";
        verifiedCodeMessage.textContent = "Verifying.......";
        setTimeout(function(){
            verifiedCodeMessage.textContent = "Please Wait.......";
        },2000);
    } else {
       input1.value='';
       input2.value='';
       input3.value='';
       input4.value='';
       input5.value='';
       input6.value='';
       errorVerifcationCode.style.display="";
       back.style.display= "";
    }
}

function backToStep1(){

    const step1= document.getElementById('step1Display');
    const step2 = document.getElementById('step2Display');

    step1.style.display = "";
    step2.style.display = "none";

}


function SaveDataVerified() {
    var formData = $('form#formSubmitVerifyFinal').serialize();

    $.ajax({
        type: 'POST',
        url: '{{route('coordinatorSavedVerifiedData')}}',
        data: formData,
        success: function(response) {
           const steps = document.getElementById('passwordNew');
           const getStarted = document.getElementById('finalGetStarted');

           steps.style.display= "none";
           getStarted.style.display= "";
           console.log(response.message)
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}


function startTheJourney(){
   location.reload();
}
function showPassword(checkbox){
    const newPassword = document.getElementById('newPasswordInput');
    const confirmPasswordInput = document.getElementById('confirmPasswordInput');
    if(checkbox.checked){
        newPassword.type= 'text';
        confirmPasswordInput.type= 'text';
    }else{
        newPassword.type= 'password';
        confirmPasswordInput.type= 'password';
    }
 }
</script>