<?php 
    require_once('db.php');
    if(isset($_GET['del'])){
        $del = $_GET['del'];
        $q = "DELETE FROM rooms WHERE rooms.id = $del";
        $run = mysqli_query($con, $q);
    }
?>
  </head>
  <body>
    <div id="wrapper">
<?php require_once('header-admin.php');?>

        <div class="container-fluid body-section container">
            <div class="row">
                <div class="col-md-12">
                    <h2><i class="fa fa-plus-square"></i> All Rooms <small>Edit or Delete Room</small></h2>
                    
                    <div class="card">
                        <div class="card-content table-responsive table-full-width">
                            <table class="table">
                                <thead class="text-danger">
                                    <th><center>ID</center></th>
                                    <th><center>Room Title</center></th>
                                    <th><center>Size</center></th>
                                    <th><center>Price</center></th>
                                    <th><center>Edit</center></th>
                                    <th><center>Delete</center></th>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM rooms ORDER BY rooms.id ASC";
                                        $run = mysqli_query($con, $q);
                                        if(mysqli_num_rows($run) > 0){
                                            while($row = mysqli_fetch_array($run)){
                                        
                                    ?>
                                    <tr>
                                        <td><center><?php echo $row['id']; ?></center></td>
                                        <td><center><?php echo $row['title']; ?></center></td>
                                        <td><center><?php echo $row['size']; ?> sq</center></td>
                                        <td class="text-primary"><center><?php echo $row['price']; ?> /-</center></td>
                                        <td><center><a href="edit-room.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a></center></td>
                                        <td><center><a href="all-rooms.php?del=<?php echo $row['id']; ?>"><i class="fa fa-times"></i></a></center></td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once('footer-admin.php');?>