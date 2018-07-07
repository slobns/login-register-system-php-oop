<?php

require_once 'core/init.php';

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
         <button class="btn btn-default"><a href="http://localhost/portfolio/">Back</a></button>
    </div>
  <div>
  	<h2><a href="http://localhost/portfolio/ooplg/register">Register</a></h2>
  </div>
</body>
</html>