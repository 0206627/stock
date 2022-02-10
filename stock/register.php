<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/register.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Sign Up</title>
  </head>
  <body>
    <!-- Start PHP Session -->
	<?php session_start(); ?>

    <!-- Registration Form -->
    <div class="container py-5">
        <div class="my-form">
            <form class="" id="" name="" method="post" action="register.php">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Username</label>
                        <input type="text" name="user" id="user" class="form-control" placeholder="Username">
                    </div>

                    <div class="form-group col-6">
                        <label for="">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required >
                    </div>
                    <div class="form-group col-6">
                        <label for="">Confirm password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm password" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <button type="button" class="btn btn-success" id="register-btn">Register</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- End Registration Form -->

    <!-- Scripts -->
    <script>

        function showError(errortxt) {
            Swal.fire({
                    'title': 'Error',
                    'text': errortxt,
                    'icon': 'error'
            })
        }

        $(document).ready(function() {

            // Register button
            $(document).on("click", "#register-btn", function(){
                var valid = this.form.checkValidity();
                var errortxt = 'Fill all fields correctly.';
                if(valid) {
                    var email = $('#email').val();
                    var user = $('#user').val();
                    var password = $('#password').val();
                    var confirmpassword = $('#confirmpassword').val();

                    if(password != confirmpassword) {
                        errortxt = 'Passwords do not match';
                        $('#password').val('');
                        $('#confirmpassword').val('');
                        return showError(errortxt);
                    } 
                    
                    $.ajax({
                        type: 'POST',
                        url: 'register_.php',
                        data: {user: user, email: email, password: password},
                        success: function(data) {

                            data = JSON.parse(data);
  
                            if(data['id'] < 0) {
                                Swal.fire({
                                    'title': 'Error',
                                    'text': data['message'],
                                    'icon': 'error'
                                })
                            } else {
                                Swal.fire({
                                    'title': 'Successful',
                                    'text': 'Registration successful.',
                                    'icon': 'success'
                                })

                                window.location='home.php';
                            } 

                            $('#email').val('');
                            $('#user').val('');
                            $('#password').val('');
                            $('#confirmpassword').val('');

                        },
                        error: function(data) {
                            Swal.fire({
                                'title': 'Error',
                                'text': 'Error in registration.',
                                'icon': 'error'
                            })
                        }
                    });

                } else {
                    showError(errortxt);
                }

            });
        
        });

    </script>
    <!-- End scripts -->

  </body>
</html>