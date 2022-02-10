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

    <title>Products</title>
    <link rel="shortcut icon" href="img/lucianos_black.ico">
  </head>
  <body>
    <!-- Start PHP Session -->
    <?php 
        require 'products_.php';
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
                    <h4 class = "modal-title">Product</h4>
                    <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                </div>
                <div class = "modal-body">
                    <div class="my-form">
                        <form class="" id="" name="" method="post" action="">
                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="">Product</label>
                                    <input type="text" name="product" id="product" class="form-control" placeholder="Product" required>  
                                </div>

                                <div class="form-group col-6">
                                    <label for="">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price" required>
                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                                </div>

                                <input type="hidden" name="product_id" id="product_id">

                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Category</label>
                                    <select name="" id="category" class="form-control">
                                        <?php foreach($_SESSION['categories'] as $category) { ?>
                                            <option value="<?=$category['category_id']?>"><?=$category['category_code']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

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
                    <th>Product</th>
                    <th>Price ($)</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th hidden>idCategory</th>
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
                    
                        foreach($_SESSION['products'] as $product) {

                    ?>

                    <tr>

                        <td class='td_product'><?=$product['product_name']?></td>
                        <td class="td_price"><?=$product['price']?></td>
                        <td class="td_quantity"><?=$product['quantity']?></td>
                        <td class="td_category"><?=$product['category_code']?></td>
                        <td hidden class="td_category_id"><?=$product['category_id']?></td>
                        <td hidden class='td_id'><?=$product['product_id']?></td>
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
                $('#product_id').val(0);
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

                var product = $("#product").val();
                var product_id = $("#product_id").val();
                var price = $("#price").val();
                var quantity = $("#quantity").val();
                var category_id = $("#category option:selected").val();

                if (product_id != 0) {

                    $.ajax({
                        type: 'POST',
                        url: 'updateProduct_.php',
                        data: {product: product, product_id: product_id, price: price, quantity: quantity, category_id: category_id},
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

                                window.location='products.php';
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
                            url: 'addProduct_.php',
                            data: {product: product, price: price, quantity: quantity, category_id: category_id},
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

                                    window.location='products.php';
                                } 
                            },
                            error: function(data) {
                                Swal.fire({
                                    'title': 'Error',
                                    'text': 'Error in adding product.',
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

                $('#product').val($(this).closest("tr").find(".td_product").text());
                $('#product_id').val($(this).closest("tr").find(".td_id").text());
                $('#price').val($(this).closest("tr").find(".td_price").text());
                $('#quantity').val($(this).closest("tr").find(".td_quantity").text());
                $('#category_id').val($(this).closest("tr").find(".td_category_id").text());

                var category_id = $(this).closest("tr").find(".td_category_id").text();
                $("#category option[value='"+category_id+"']").attr("selected", true);

                $('#myModal').modal({show:true});

            });

            // Delete button
            $(document).on("click", ".delete", function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to recover the product!",
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
                            url: 'deleteProduct_.php',
                            data: {id: id},
                            success: function(data) {

                                if(data < 0) {
                                    Swal.fire({
                                        'title': 'Error',
                                        'text': 'Error while deleting product.',
                                        'icon': 'error'
                                    })
                                } else {
                                    Swal.fire({
                                        'title': 'Successful',
                                        'text': 'Deletion successful.',
                                        'icon': 'success'
                                    })

                                    window.location='products.php';
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