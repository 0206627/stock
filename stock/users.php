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
    <link rel="stylesheet" href="css/users.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Users</title>
  </head>
  <body>
    <!-- Start PHP Session -->
    <?php 
        require 'users_.php';
    ?>

    <!-- Navigation -->
	<nav class="navbar bg-light navbar-light navbar-expand-lg">
		<div class="container">

			<a href="home.php" class="navbar-brand"><img src="img/paw-icon.png" alt="Logo" title="Logo"></a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" 
				data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="home.php" class="nav-link active">Home</a></li>
					<li class="nav-item"><a href="categories.php" class="nav-link">Categories</a></li>
					<li class="nav-item"><a href="products.php" class="nav-link">Products</a></li>
					<?php if($_SESSION['is_admin']) { 
						echo '<li class="nav-item"><a href="users.php" class="nav-link">Users</a></li>';	
					} ?>
					<li class="nav-item"><button type="button" class="btn btn-danger" id="log-out">Log Out</button>
				</ul>
			</div>

		</div>
	</nav>
	<!-- End Navigation -->

    <!-- Edit Modal -->

    <div class = "container">
        <br>
        <div id = "myModal" class = "modal fade" role="dialog">
        <div class = "modal-dialog">
            <div class = "modal-content">
                <div class = "modal-header">
                    <h4 class = "modal-title"> User update</h4>
                    <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                </div>
                <div class = "modal-body">
                    <div class="my-form">
                        <form class="" id="" name="" method="post" action="">
                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="">Username</label>
                                    <input type="text" name="user" id="user" class="form-control" placeholder="Username" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
                                </div>

                                <input type="hidden" name="user_id" id="user_id">
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Is Admin?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="admin" id="isAdmin" value="Yes">
                                        <label class="form-check-label" for="isAdmin">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="admin" id="isNotAdmin" value="No">
                                        <label class="form-check-label" for="isNotAdmin">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <button type="button" class="btn btn-success" id="update-btn">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Edit Modal -->

    <!-- Table --> 

    <div class="row justify-content-center sales">
        <div class="col-auto">
            <table class="content-table">
                <thead>
                    <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Is Admin?</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th hidden>ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        foreach($_SESSION['users'] as $user) {
                    ?>

                    <tr>
                        <td class='td_username'><?php echo $user['username']; ?></td>
                        <td class='td_email'><?php echo $user['email']; ?></td>
                        <td class='td_is_admin'><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>
                        <td>
                             <button type = 'button' class='btn btn-info edit'>Edit</button>
                        </td>
						<td> 
                            <button type = 'button' class='btn btn-danger delete'>Delete</button>
                        </td>
                        <td hidden class='td_id'><?php echo $user['user_id']; ?></td>
                    </tr>

                    <?php

                        }
                        
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- End Table -->
    

    <!-- Scripts -->
    <script>

        $(document).ready(function() {

            // Log out button
			$(document).on("click", "#log-out", function(){
				$.ajax({
					type: 'GET',
					url: 'logout_.php',
					success: function(data) {

						Swal.fire({
						'title': 'Successful',
						'text': data,
						'icon': 'success'
						})

						window.location='index.php';
					},
					error: function(data) {
						Swal.fire({
						'title': 'Error',
						'text': 'Error in log out.',
						'icon': 'error'
						})
					}
				});
			});

            // Update button
            $(document).on("click", "#update-btn", function(){

                $('#myModal').modal('hide');

                var user = $("#user").val();
                var email = $("#email").val();
                var user_id = $("#user_id").val();
                var is_admin = $('input[name="admin"]:checked').val() == 'Yes' ? 1 : 0;
                
                $.ajax({
                    type: 'POST',
                    url: 'updateUser_.php',
                    data: {user: user, email: email, user_id: user_id, is_admin: is_admin},
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
                                'text': 'Update successful.',
                                'icon': 'success'
                            })

                            window.location='users.php';
                        } 
                    },
                    error: function(data) {
                        Swal.fire({
                            'title': 'Error',
                            'text': 'Error in update.',
                            'icon': 'error'
                        })
                    }
                });

            });

            // Edit button
            $(document).on("click", ".edit", function(){

                $('#user').val($(this).closest("tr").find(".td_username").text());
                $('#email').val($(this).closest("tr").find(".td_email").text());
                $('#user_id').val($(this).closest("tr").find(".td_id").text());

                var is_admin = $(this).closest("tr").find(".td_is_admin").text();
                $("input[name=admin][value='"+is_admin+"']").prop("checked",true);

                $('#myModal').modal({show:true});

            });

            // Delete button
            $(document).on("click", ".delete", function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to recover the user!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#5cb85c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).closest("tr").find(".td_id").text();
                        $.ajax({
                            type: 'POST',
                            url: 'deleteUser_.php',
                            data: {id: id},
                            success: function(data) {

                                if(data < 0) {
                                    Swal.fire({
                                        'title': 'Error',
                                        'text': 'Error while deleting user.',
                                        'icon': 'error'
                                    })
                                } else {
                                    Swal.fire({
                                        'title': 'Successful',
                                        'text': 'Deletion successful.',
                                        'icon': 'success'
                                    })

                                    window.location='users.php';
                                } 
                            },
                            error: function(data) {
                                Swal.fire({
                                    'title': 'Error',
                                    'text': 'Error in deletion.',
                                    'icon': 'error'
                                })
                            }
                        });

                    }
                })
            });
        
        });

    </script>
    <!-- End scripts -->

  </body>
</html>