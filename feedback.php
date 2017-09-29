<?php 
    require_once('db.php');
    if(isset($_GET['del'])){
        $del = $_GET['del'];
        $q = "DELETE FROM feedback WHERE feedback.id = $del";
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
                    <h2><i class="fa fa-plus-square"></i> All Feedbacks <small>Watch or Delete Feedback</small></h2>
                    
                    <div class="card">
                        <div class="card-content table-responsive table-full-width">
                            <table class="table">
                                <thead class="text-danger">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th><center>Delete</center></th>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM feedback ORDER BY feedback.id ASC";
                                        $run = mysqli_query($con, $q);
                                        if(mysqli_num_rows($run) > 0){
                                            while($row = mysqli_fetch_array($run)){
                                        
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td class="text-primary"><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['message']; ?></td>
                                        <td><center><a href="feedback.php?del=<?php echo $row['id']; ?>"><i class="fa fa-times"></i></a></center></td>
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