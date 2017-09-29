<?php 

?>
  </head>
  <body>
    <div id="wrapper">
<?php require_once('header-admin.php');?>

        <div class="container-fluid body-section container">
            <div class="row">
                <div class="col-md-12">
                    <h2><i class="fa fa-plus-square"></i> Edit Room <small> Don't Forget To Insert Images Again</small></h2>
                    
                    <?php
                    require_once('db.php');
                    if(isset($_GET['id'])){
                        $t_id = $_GET['id'];
                        $q = "SELECT * FROM rooms WHERE rooms.id = $t_id";
                        $r = mysqli_query($con, $q);
                        $row = mysqli_fetch_array($r);
                        $title = $row['title'];
                        $post_data = $row['description'];
                        $size = $row['size'];
                        $price = $row['price'];
                        $img1 = $row['image1'];
                        $img2 = $row['image2'];
                        $img3 = $row['image3'];
                        $img4 = $row['image4'];
                    }
                    
                    if(isset($_POST['submit'])){
                        $title = mysqli_real_escape_string($con,$_POST['title']);
                        $post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $size = mysqli_real_escape_string($con,$_POST['size']);
                        $price = mysqli_real_escape_string($con,$_POST['price']);
                        
                        $image1 = $_FILES['image1']['name'];
                        $tmp_name1 = $_FILES['image1']['tmp_name'];
                        $image2 = $_FILES['image2']['name'];
                        $tmp_name2 = $_FILES['image2']['tmp_name'];
                        $image3 = $_FILES['image3']['name'];
                        $tmp_name3 = $_FILES['image3']['tmp_name'];
                        $image4 = $_FILES['image4']['name'];
                        $tmp_name4 = $_FILES['image4']['tmp_name'];
                        
                        $q = "SELECT * FROM rooms ORDER BY rooms.id DESC LIMIT 1";
                        $r = mysqli_query($con, $q);
                        if(mysqli_num_rows($r) > 0){
                            $row = mysqli_fetch_array($r);
                            $id = $row['id'];
                            $id = $id + 1;
                        }
                        else{
                            $id = 1;
                        }
                        
                        
                        if(empty($title) or empty($post_data) or empty($size) or empty($price) or empty($image1) or empty($image2) or empty($image3) or empty($image4)){
                            $error = "All (*) Feilds Are Required";
                            
                        }
                        else{
                            $insert_query = "INSERT INTO rooms (`id`,`title`,`description`,`size`,`price`,`image1`,`image2`,`image3`,`image4`) VALUES ($id,'$title','$post_data','$size','$price','$image1','$image2','$image3','$image4')";
                            if(mysqli_query($con, $insert_query)){
                                $path1 = "images/photos/$image1";
                                $path2 = "images/photos/$image2";
                                $path3 = "images/photos/$image3";
                                $path4 = "images/photos/$image4";
                                if(move_uploaded_file($tmp_name1, $path1) and move_uploaded_file($tmp_name2, $path2) and move_uploaded_file($tmp_name3, $path3) and move_uploaded_file($tmp_name4, $path4)){
                                    $msg = "Post has been added";
                                    $title = "";
                                    $post_data = "";
                                    $size = "";
                                    $price = "";
                                    copy($path1, "$path1");
                                    copy($path2, "$path2");
                                    copy($path3, "$path3");
                                    copy($path4, "$path4");
                                }
                            }
                            else{
                                $error = "Post Has not Been Added";
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Room Name:*</label>
                                    <?php
                                    if(isset($msg)){
                                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                    }
                                    else if(isset($error)){
                                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                                    }
                                    ?>
                                    <input type="text" name="title" placeholder="Type Room Title Here" value="<?php if(isset($title)){echo $title;}?>" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="title">Room Description:*</label>
                                    <textarea name="post-data" id="textarea" rows="10" class="form-control"><?php if(isset($post_data)){echo $post_data;}?></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="size">Size:*</label>
                                            <input type="text" name="size" placeholder="Type Size Here (sq. feet)" value="<?php if(isset($title)){echo $size;}?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Price:*</label>
                                            <input type="text" name="price" placeholder="Type Price Here (Taka)" value="<?php if(isset($title)){echo $price;}?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="file">Image 1:*</label>
                                            <input type="file" name="image1">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="file">Image 2:*</label>
                                            <input type="file" name="image2">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="file">Image 3:*</label>
                                            <input type="file" name="image3">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="file">Image 4:*</label>
                                            <input type="file" name="image4">
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="submit" class="btn btn-primary" value="Edit Room" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once('footer-admin.php');?>