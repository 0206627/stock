<!DOCTYPE html>
<html>
<head>
  <title>Log In</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

  <div class="modal-dialog text-center">
    <div class="col-sm-9 main-section">
      <div class="modal-content">

        <!-- Icon -->
        <div class="col-12 user-img">
          <img src="img/paw-icon.png" alt="">
        </div>

        <!-- Name -->
        <div class="col-12 title">
          <p>PETS</p>
        </div>
 
        <!-- Form -->
        <div class="col-12 form-input">
          <form method="post" action="index.php">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Enter username" name="username" id="username" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
            </div>
            <button type="button" class="btn btn-success" id="submit">Log In</button>
          </form>
        </div>

        <div class="col-12 register">
          <a href="register.php">Don't have an account? Register here.</a>
        </div>

      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script>

    $(document).ready(function() {

      // Log in button
      $(document).on("click", "#submit", function(){
        var valid = this.form.checkValidity();
        if(valid) {

          var username = $('#username').val();
          var password = $('#password').val();
          
          $.ajax({
            type: 'POST',
            url: 'login_.php',
            data: {username: username, password: password},
            success: function(data) {
              if(data == 0) {
                Swal.fire({
                  'title': 'Error',
                  'text': 'Wrong username or password.',
                  'icon': 'error'
                })
              } else if (data == -1) {
                Swal.fire({
                  'title': 'Error',
                  'text': 'Error establishing connection.',
                  'icon': 'error'
                })
              } else if (data == 1) {
                Swal.fire({
                  'title': 'Successful',
                  'text': 'Log in successful.',
                  'icon': 'success'
                })

                window.location='home.php';
              }

              $('#username').val('');
              $('#password').val('');

            },
            error: function(data) {
              Swal.fire({
              'title': 'Error',
              'text': 'Error in log in.',
              'icon': 'error'
              })
            }
          });

        } else {
          Swal.fire({
            'title': 'Error',
            'text': 'Fill out all fields correctly.',
            'icon': 'error'
          })
        }

      });
      
    });

  </script>
  <!-- End scripts -->

</body>
</html>







