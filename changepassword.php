 <?php

   require_once 'core/init.php';

   $user = new User();

   if(!$user->isLoggedIn()) {
      Redirect::to('Location: index.php');
   }

   if(Input::exists()) {
   	 if(Token::check(Input::get('token'))) {
        
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
              'password_current' => array(
                   'required' => true,
                   'min' => 6
               ),
              'password_new' => array(
                   'required' => true,
                   'min' => 6
              ),
              'password_new_again' => array(
                   'required' => true,
                   'min' => 6,
                   'matches' => 'password_new'
              )
           
        ));

        if($validation->passed()) {
        	if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
        		echo 'Your current password is wrong!';
        	} else {
        		$salt = Hash::salt(32);
        		$user->update(array(
                     'password' => Hash::make(Input::get('password_new'), $salt),
                     'salt' => $salt
        		));

        		Session::flash('home', '<p style="padding-top:40px; color:green;">Your password has been changed.</p>');
        		Redirect::to('index.php');
        	}
        } else {
        	foreach ($validation->errors() as $error) {
        		echo '<h4 style="color:white;">' . ucfirst($error),  '</h4><br>';
        	}
        }
   	 }
   }

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> 
<style type="text/css">
		body{

		      background: url('http://localhost/portfolio/img/portfolio-2.jpg') no-repeat center center fixed; 
		     -webkit-background-size: cover;
		     -moz-background-size: cover;
		     -o-background-size: cover;
		      background-size: cover;
         
		}
		.container{
			
		}
		.centered-form{
			margin-top: 160px;
		}

		.centered-form .panel{
			background: rgba(255, 255, 255, 0.8);
			box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
		}
	</style>
</head>
<body>
	<div>
    		<button class="btn btn-default"><a href="http://localhost/portfolio/ooplg/login.php">Back</a></button>
    	</div>
<div class="container">
    <div class="row centered-form">
      <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
        	<div class="panel-heading">
			    <h3 class="panel-title">Change password<small></small></h3>
			 </div>
			 	<div class="panel-body">
			    	<form action="" method="post">
			    		<div class="form-group">
			    			<input type="password" name="password_current" id="password_current" class="form-control input-sm"  placeholder="Current Password">
			    			</div>
                         <div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-6">
			    				<div class="form-group">
			    					<input type="password" name="password_new" id="password_new" class="form-control input-sm"  placeholder="New Password">
			    				</div>
			    			</div>
			    			<div class="col-xs-6 col-sm-6 col-md-6">
			    				<div class="form-group">
			    					<input type="password" name="password_new_again" id="password_new_again" class="form-control input-sm"  placeholder="New Password Again">
			    				</div>
			    			</div>
			    		</div>
						    <input type="submit" value="Change" class="btn btn-info btn-block">
						    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">	
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</body>
</html>