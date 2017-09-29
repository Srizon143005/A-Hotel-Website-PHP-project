<?php 
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}

$session_username = $_SESSION['username'];
$session_role = $_SESSION['role'];
$session_author_image = $_SESSION['author_image'];

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    if($session_role == 'admin'){
        $get_query = "SELECT * FROM posts WHERE id = $edit_id";
        $get_run = mysqli_query($con, $get_query);
    }
    else if($session_role == 'author'){
        $get_query = "SELECT * FROM posts WHERE id = $edit_id and author = '$session_role'";
        $get_run = mysqli_query($con, $get_query);
    }
    
    if(mysqli_num_rows($get_run) > 0){
        $get_row = mysqli_fetch_array($get_run);
        $title = $get_row['title'];
        $post_data = $get_row['post_data'];
        $tags = $get_row['tags'];
        $image = $get_row['image'];
        $status = $get_row['status'];
        $categories = $get_row['categories'];
    }
    else{
        header('location: posts.php');
    }
}
else{
    header('location: posts.php');
}
?>
  </head>
  <body>
    <div id="wrapper">
<?php require_once('inc/header.php');?>

        <div class="container-fluid body-section">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('inc/sidebar.php');?>
                </div>
                <div class="col-md-9">
                    <h1><i class="fa fa-pencil"></i> Edit Post <small>Edit Post Details</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                      <li class="active"><i class="fa fa-pencil"></i> Edit Post</li>
                    </ol>
                    <?php
                    if(isset($_POST['update'])){
                        $up_title = mysqli_real_escape_string($con,$_POST['title']);
                        $up_post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $up_categories = $_POST['categories'];
                        $up_tags = mysqli_real_escape_string($con,$_POST['tags']);
                        $up_status = $_POST['status'];
                        $up_image = $_FILES['image']['name'];
                        $up_tmp_name = $_FILES['image']['tmp_name'];
                        
                        if(empty($up_image)){
                            $up_image = $image;
                        }
                        
                        if(empty($up_title) or empty($up_post_data) or empty($up_tags) or empty($up_image)){
                            $error = "All (*) Feilds Are Required";
                            
                        }
                        else{
                            $update_query = "UPDATE posts SET title = '$up_title', image = '$up_image', categories = '$up_categories', tags = '$up_tags', post_data = '$up_post_data', status = '$up_status' WHERE id = $edit_id";
                            if(mysqli_query($con, $update_query)){
                                $msg = "Post Has Been Udated";
                                $path = "img/$up_image";
                                header("location: edit-post.php?edit=$edit_id");
                                if(!empty($up_image)){
                                        if(move_uploaded_file($up_tmp_name, $path)){
                                        copy($path, "../$path");
                                    }
                                }
                            }
                            else{
                                $error = "Post Has not Been Updated";
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title:*</label>
                                    <?php
                                    if(isset($msg)){
                                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                    }
                                    else if(isset($error)){
                                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                                    }
                                    ?>
                                    <input type="text" name="title" placeholder="Type Post Title Here" value="<?php if(isset($title)){echo $title;}?>" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <a href="media.php" class="btn btn-primary">Add Media</a>
                                </div>
                                
                                <div class="form-group">
                                    <textarea name="post-data" id="textarea" rows="10" class="form-control"><?php if(isset($post_data)){echo $post_data;}?></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="file">Post Image:*</label>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="categories">Categories:*</label>
                                            <select class="form-control" name="categories" id="categories">
                                                <?php
                                                $cat_query = "SELECT * FROM categories ORDER BY id DESC";
                                                $cat_run = mysqli_query($con, $cat_query);
                                                if(mysqli_num_rows($cat_run) > 0){
                                                    while($cat_row = mysqli_fetch_array($cat_run)){
                                                        $cat_name = $cat_row['category'];
                                                        echo "<option value='".$cat_name."' ".((isset($categories) and $categories == $cat_name)?"selected":"").">".ucfirst($cat_name)."</option>";
                                                        
                                                    }
                                                }
                                                else{
                                                    echo "<cetner><h6>No Category Available</h6></center>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tags">Tags:*</label>
                                            <input type="text" name="tags" placeholder="Your Tags Here" value="<?php if(isset($tags)){echo $tags;}?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="status">Status:*</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="publish" <?php if(isset($status) and $status == 'publish'){echo "selected";}?>>Publish</option>
                                                <option value="draft" <?php if(isset($status) and $status == 'draft'){echo "selected";}?>>Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Update Post" name="update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once('inc/footer.php');?>