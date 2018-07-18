<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
             'name' => array(
                 'required' => true,
                 'min' => 2,
                 'max' => 50
             )
		));

		if($validation->passed()) {

            try{
                $user->update(array(
                   'name' => Input::get('name')
                ));

                Session::flash('home', 'Your detail have been updated.');
                Redirect::to('index.php');

            } catch(Exception $e) {
                die($e->getMessage());
            }
		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
 <form action="" method="post">
	 <div class="form-row align-items-center">	
		<div class="col-auto">
			<label class="sr-only" for="inlineFormInput">Name</label>
			<input type="text" name="name" class="form-control mb-2" id="inlineFormInput" placeholder="Input name" value="<?php echo escape($user->data()->name); ?>">
		</div>
		<div class="col-auto">
               <button type="submit" class="btn btn-primary mb-2">Update Detail</button>
               <input type="hidden" name="token" value="<?php echo Token::generate('token'); ?>">
         </div>
		</div>
</form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
