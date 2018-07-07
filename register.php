<?php
require_once 'core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){

   $validate = new Validate();
   $validation = $validate->check($_POST, array(
        'username' => array(
           'required' => true,
           'min' => 2,
           'max' => 20,
           'unique' => 'user'
        ),
        'password' => array(
           'required' => true,
           'min' => 6
           
        ),
        'password_again' => array(
           'required' => true,
           'matches' => 'password'
        ),
        'name' => array(
           'required' => true,
           'min' => 2,
           'max' => 50
        )
   ));

   if($validation->passed()){
   	   // Register user
   	    Session::flash('success', 'You registered successfully!');
   	    header('Location: index.php');
   } else {
   	   // output error
   	  foreach ($validation->errors() as $error) {
   	  	 echo '<h4 style="color: red;">' . ucfirst($error) . '</h4>'. '<br>';
   	  }
   }
 }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Form</title>
	
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> 
	<style type="text/css">
		body{

		      background: url('http://localhost/portfolio/img/bg-callout.jpg') no-repeat center center fixed; 
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
    		<button class="btn btn-default"><a href="http://localhost/portfolio/ooplg/index.php">Back</a></button>
    	</div>
    <div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Please sign up<small>  It's free!</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post">
			    			<div class="form-group">
			    				<input type="username" name="username" id="username" class="form-control input-sm" value="<?php echo escape(Input::get('username')); ?>" autocompete="off" placeholder="Username">
			    			</div>
                            <div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_again" id="password_again" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="form-group">
			    				<input type="name" name="name" id="name" class="form-control input-sm" value="<?php echo escape(Input::get('name')); ?>" autocompete="off" placeholder=" Your Name">
			    			</div>
			    			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			    			<input type="submit" value="Register" class="btn btn-info btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
  </body>
</html>
