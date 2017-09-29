<?php
ob_start();
session_start();
require_once('db.php');

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con,strtolower($_POST['username']));
    $password = mysqli_real_escape_string($con,$_POST['password']);
    
    if($username == "srizon" && $password == "srizon"){
        $_SESSION['username'] = $username;
        $_SESSION['role'] = "admin";
        header('Location: all-rooms.php');
    }
    else{
        $error = "Wrong Username or Password";
    }
}
require_once('header.php');
?>


    <div class="container">
      <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
              <form class="form-signin animated shake" action="" method="post">
                <h2 class="form-signin-heading">Admin Login</h2>
                <label for="inputEmail" class="sr-only">Username</label>
                <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <div class="checkbox">
                  <label>
                    <?php
                      if(isset($error)){
                          echo "$error";
                      }
                      ?>
                  </label>
                </div>
                <input type="submit" name="submit" value="Sign In" class="btn btn-lg btn-primary btn-block">
              </form>
          </div>
          <div class="col-md-4"></div>
      </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
