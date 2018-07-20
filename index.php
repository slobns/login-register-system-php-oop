<?php

require_once 'core/init.php';

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css" class="cp-pen-styles">


		.navbar-default {
    background: rgba(45, 100, 222, .98);
    
    transition: all 0.2s ease-out 0s;
    border-color:transparent;
    
}

.navbar-brand {
    float: left;
    height: 50px;
    padding: 15px 15px;
    font-family: "Lato";
    color: snow;
}
   
   
}
.navbar-default .navbar-brand {
     color: snow; 
}
.nav navbar-nav navbar-right {
     color:snow;
    
}

.navbar-default .navbar-nav>li>a {
    color: #fff; 
 
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-    
                    collapse-1" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="color: snow;" href="http://localhost/portfolio/ooplg">Portfolio</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php 
           if(!$user->isLoggedIn()){
        ?>
        
         <li><a href="login.php">Log in</a></li>
         <li><a href="register.php">Register</a></li>
        <?php
        } else {
         ?>  

          <li><a href="#"><?php echo escape($user->data()->username); ?></a></li>
          <li><a href="logout.php">Log Out</a></li>
          <li><a href="update.php">Update Detail</a></li>
          <li><a href="changepassword.php">Change Password</a></li>
          <?php
        }
      ?>
      </ul>
    </div><!-- /.navbar-collapse -->
   
  </div><!-- /.container-fluid -->
</nav>
</body>
</html>