<?php

require_once 'core/init.php';

if(Session::exists('success')){
	echo Session::flash('success');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
         <button class="btn btn-default"><a href="http://localhost/portfolio/">Back on Homepage</a></button>
    </div>
  <div>
  	<h2><a href="http://localhost/portfolio/ooplg/register">You have to Register or Login</a></h2>
  </div>
</body>
</html>