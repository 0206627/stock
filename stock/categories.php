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
    <link rel="stylesheet" href="css/sales.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Categories</title>
    <link rel="shortcut icon" href="img/lucianos_black.ico">
  </head>
  <body>
    <!-- Start PHP Session -->
    <?php 
        require 'categories_.php';
    ?>

    <!-- Navigation -->
	<nav class="navbar bg-light navbar-light navbar-expand-lg">
		<div class="container">

			<a href="home.php" class="navbar-brand"><img src="img/luccianos_icon.png" alt="Logo" title="Logo"></a>
			
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
                    <h4 class = "modal-title">Category</h4>
                    <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                </div>
                <div class = "modal-body">
                    <div class="my-form">
                        <form class="" id="" name="" method="post" action="">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Category</label>
                                    <input type="text" name="category" id="category" class="form-control" placeholder="Category" required>  
                                </div>

                                <div class="form-group col-6">
                                    <label for="">Code</label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Code" maxlength="3" minlength="3" required>
                                </div>
                            </div>

                            <input type="hidden" name="category_id" id="category_id">

                            <div class="row">
                                <div class="form-group col-6">
                                    <button type="button" class="btn btn-success" id="update-btn">Confirm</button>
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
            <!-- Add button -->
            <?php 
                if($_SESSION['is_admin']) {
                    echo '
                    <div class="add_div">
                        <button class="btn btn-success add_button">Add</button>
                     </div>';
                }
            ?>
            <!-- End Add button -->
            <table class="content-table">
                <thead>
                    <tr>
                    <th>Category</th>
                    <th>Category Code</th>
                    <?php 
                        if($_SESSION['is_admin']) {
                            echo '<th>Edit</th>
                            <th>Delete</th>';
                        }
                    ?>
                    <th hidden>ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        foreach($_SESSION['categories'] as $category) {

                    ?>

                    <tr>
                        <td class='td_category'><?=$category['category_name']?></td>
                        <td class="td_code"><?=$category['category_code']?></td>
                        <td hidden class='td_id'><?=$category['category_id']?></td>
                        <?php 
                            if($_SESSION['is_admin']) {
                                echo "
                                <td>
                                    <button type = 'button' class='btn btn-info edit'>Edit</button>
                                </td>
                                <td> 
                                    <button type = 'button' class='btn btn-danger delete'>Delete</button>
                                </td>";
                            }
                        ?>
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

            // Add button 
            
            $(document).on("click", ".add_button", function(){
                $('#category_id').val(0);
                $('#myModal').modal('toggle');
			});

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

                var category = $("#category").val();
                var code = $("#code").val();
                var category_id = $("#category_id").val();

                if (category_id != 0) {

                    $.ajax({
                        type: 'POST',
                        url: 'updateCategory_.php',
                        data: {category: category, code: code, category_id: category_id},
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

                                window.location='categories.php';
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

                } else {
                    var valid = this.form.checkValidity();
                    if(valid) {

                        $.ajax({
                            type: 'POST',
                            url: 'addCategory_.php',
                            data: {category: category, code: code},
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
                                        'text': 'Added successfully.',
                                        'icon': 'success'
                                    })

                                    window.location='categories.php';
                                } 
                            },
                            error: function(data) {
                                Swal.fire({
                                    'title': 'Error',
                                    'text': 'Error in adding service.',
                                    'icon': 'error'
                                })
                            }
                        });


                    } else {
                        Swal.fire({
                            'title': 'Error',
                            'text': 'Fill all fields correctly.',
                            'icon': 'error'
                        })
                    }
                }

            });

            // Edit button
            $(document).on("click", ".edit", function(){

                $('#category').val($(this).closest("tr").find(".td_category").text());
                $('#code').val($(this).closest("tr").find(".td_code").text());
                $('#category_id').val($(this).closest("tr").find(".td_id").text());

                $('#myModal').modal({show:true});

            });

            // Delete button
            $(document).on("click", ".delete", function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "If you delete a category, all the related products will be deleted as well!",
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
                            url: 'deleteCategory_.php',
                            data: {id: id},
                            success: function(data) {

                                if(data < 0) {
                                    Swal.fire({
                                        'title': 'Error',
                                        'text': 'Error while deleting category.',
                                        'icon': 'error'
                                    })
                                } else {
                                    Swal.fire({
                                        'title': 'Successful',
                                        'text': 'Deletion successful.',
                                        'icon': 'success'
                                    })

                                    window.location='categories.php';
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