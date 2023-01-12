<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Firebase Phone OTP Authentication</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
</head>
<body>
    <div id="BrushCursor">
        <div class="container-fluid">
            <nav class="navbar">
                <div class="container">
                  <span class="navbar-brand mb-0 p p1 h1">Firebase Phone OTP Authentication</span>
                  <span class="navbar-brand mb-0 p p2 h1">Firebase Phone OTP Authentication</span>
                  <span class="navbar-brand mb-0 p p3 h1">Firebase Phone OTP Authentication
                    <div class="cursor"></div>
                  </span>
                </div>
              </nav>
          
        </div>
      </div>


   
    <div class="container mt-5" style="max-width: 550px">

        <div class="card">
            <div class="card-body">
                <div class="alert alert-danger" id="error" style="display: none;"></div>
                <h3>Add Phone Number</h3>
                <div class="alert alert-success" id="successAuth" style="display: none;"></div>
                <form>
                    <div class="mb-3">

                        <label>Phone Number:</label>
                        <input type="text" id="number" class="form-control" placeholder="+91 ********">
                        <br>
                        <div id="recaptcha-container"></div>
                        <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>
                    </div>
                </form>
        
                <div class="mb-5 mt-5">
                    <h3>Add verification code</h3>
                    <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                    <form>
                        <input type="text" id="verification" class="form-control" placeholder="Verification code">
                        <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
   
</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyBatDVoMlvoPhIFXjLtKIXcxp-jFIBuFTE",
            authDomain: "faizi-848e8.firebaseapp.com",
            projectId: "faizi-848e8",
            storageBucket: "faizi-848e8.appspot.com",
            messagingSenderId: "133803846600",
            appId: "1:133803846600:web:a793789089b1508080eefd",
            measurementId: "G-BZ9G43CKLY"
        };
        firebase.initializeApp(firebaseConfig);
    </script>
    <script type="text/javascript">
        window.onload = function () {
            render();
        };
        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }
        function sendOTP() {
            var number = $("#number").val();
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                console.log(coderesult);
                $("#successAuth").text("Message sent");
                $("#successAuth").show();
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
        function verify() {
            var code = $("#verification").val();
            coderesult.confirm(code).then(function (result) {
                var user = result.user;
                console.log(user);
                $("#successOtpAuth").text("Authentication is successful");
                $("#successOtpAuth").show();
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>

</html>