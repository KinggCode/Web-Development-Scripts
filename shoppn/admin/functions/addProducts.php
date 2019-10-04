<?php 
header('Access-Control-Allow-Origin: *');
require_once 'db_connection.php';

if(isset($_POST["product_btn"])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_keyword = $_POST['product_keyword'];
    $brand_id = $_POST['brand_id'];
    $category_id = $_POST['category_id'];
    $product_image = $_POST['product_img'];
    
   
    $query1 = "SELECT * FROM products where product_title = '$product_name'";
    $result = mysqli_query($connect,$query1);
    $fetch_result = mysqli_fetch_object($result);
    $data = mysqli_num_rows($result);

    if($data >0){
      echo("Products already in the database");
    }
    else{
      if($product_name !== '' || $product_price !== '' || $product_desc !== '' || $product_keyword !== '' || $brand_id !== '' || $category_id !== '' || $product_image !==''){
        $folderName = "../images";
            $fileName = $folderName . basename($_FILES["product_img"]["name"]);

            echo($fileName);
    
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
    
            // //get the dimensions of the image and store it in the variable '$check'
            // $fileDimensions = getimagesize($_FILES["product_image"]["tmp_name"]);

            // if($fileDimensions !== false) {
            //     //  echo "File is an image - " . $fileDimensions["mime"] . ".";
            //     // print_r($fileDimensions);
            //     $uploadOk = 1;
            // } else{
            //     echo "File is not an image.";
            //     $uploadOk = 0;
            // }
    
            if ($_FILES["product_img"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
    
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
             && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $fileName)) {
              // echo "The file ". basename( $_FILES["product_image"]["name"]). " has been uploaded.";
              // echo '<image src="../images/'.basename( $_FILES["product_image"]["name"]).'">';
          $sql = "INSERT INTO products(product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) values('$category_id','$brand_id','$product_name','$product_price','$product_desc','$fileName','$product_keyword')";
          $result2 = mysqli_query($connect,$sql);
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }

    }

    }
    
  
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Style - Admin Portal</title>

     <!-- BootStrap Link -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="http://localhost/shoppn/css/style.css">
    <!-- <link rel="stylesheet" href="http://localhost/shoppn/css/register.css"> -->
    <!-- Fontawesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <title>Flames - Admin</title>
     <!-- Datatables CDN Links -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
</head>
<body>
    
    <!-- Header Container  -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" id="company-logo" href="#">Flames<span><i class="fas fa-fire-alt"></i></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/shoppn/admin/pages/adminportal.html">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/shoppn/admin/functions/addBrand.php">Brands <i class="fab fa-bitcoin"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/shoppn/admin/functions/addCategory.php">Categories <i class="fas fa-th-list"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/shoppn/admin/functions/addUser.php">Users <i class="fas fa-users"></i></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="http://localhost/shoppn/admin/functions/addProducts.php">Products<i class="fas fa-users"></i></a>
              </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="adminUsername" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Accounts <i class="fas fa-user"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Update <i class="fas fa-user-cog"></i></a>
                <a class="dropdown-item" href="#" id="adminlogoutbtn">Log Out <i class="fas fa-sign-in-alt"></i></a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

                <!-- End of Header Container -->

    <!-- Brands Tab  -->
    <div id="productsT">
            <h1>Products</h1>

                  <!-- Add Brand  -->
    <div id="BtnSec">
            <div class="row">
            <div class="col-lg-12">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"> Add Product</button>
            </div>
        </div>
        </div>

            <!-- Brand Input -->
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" >
                <div class="form-group">
                  <input type="text" class="form-control" name="product_name" placeholder="Enter Product name">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control"  name="product_desc" placeholder="Enter Product Desc">
                </div>

                <div class="form-group">
                  <!-- <input type="text" class="form-control"  name="product_desc" placeholder="Enter Product Desc"> -->
                  <select class="form-control" id="category" name="category_id">
                        <option> -- Category -- </option>
                    </select>
                </div>

                <div   class="form-group">
                  <!-- <input type="text" class="form-control"  name="product_desc" placeholder="Enter Product Desc"> -->
                  <select id="brand" class="form-control"  name="brand_id">
                        <option> -- Brand -- </option>
                    </select>
                </div>

                <div class="form-group">
                  <input type="number" class="form-control"  name="product_price" placeholder="Enter Price">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control"  name="product_keyword" placeholder="Enter Product Keyword">
                </div>

                <div class="form-group">
                <div class="custom-file">
                        <input type="file" name="product_img" class="custom-file-input" 
                         aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="adminProfile">Choose Product Image</label>
                         </div>
                </div>



                
            
                <button type="submit" class="btn btn-warning btn-block" name="product_btn">Submit</button>
              </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
            <table id="products_id" class="table table-hover">
                    <thead class="table-dark" >
                        <tr>
                            <th>Product_id</th>
                            <th>Product_name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Admin Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
    
    </div>
    
            

    <!-- End of Analysis Tab -->


      <!-- Bootstrap & Jquery Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Custom Js Script -->

<!-- <script src="http://localhost/shoppn/js/validate.js"></script> -->
<script src="http://localhost/shoppn/js/script.js"></script>


     <!-- Datatables Js CDN -->
     <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</body>
</html>