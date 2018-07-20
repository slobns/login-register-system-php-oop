<?php
require_once 'core/init.php';

if(!$username = Input::get('user')) {
	Redirect::to('index.php');
} else {
	$user = new User($username);
	if(!$user->exists()) {
		Redirect::to(404);
	} else {
		$data = $user->data();
	}
	?>

	<h3>Welcome <?php echo escape($data->username)?>!
    <p>You can take source code on my <a href="https://github.com/slobns/login-register-system-php-oop"> GitHub </a>page.</p>
    
	</h3>

	<?php
}
