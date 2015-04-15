<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/assets/img/favicon.ico">

    <title>Baseigniter 3.0</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="/assets/css/forms.css" rel="stylesheet">
    
  </head>

  <body>

    <div class="container" style="text-align: center;">
	    
		<div class="row" id="main_description">
		    <div class="col-md-6 col-md-offset-3 text-center">
		        <h3>¿What is BaseIgniter?</h3>
		        <p>BaseIgniter is a project based on Code Igniter so you can start your website with user management, very easy. A part also includes Twitter Bootstrap and some plugin and functions to load header and footer.</p>
		    </div>
		</div>
	    
		<form action="/login" method="post" accept-charset="utf-8" class="form-signin">
			<label for="identity" class="sr-only">Email:</label>
			<input type="email" name="identity" value="" id="identity" placeholder="Email" class="form-control" required/>
			
			<label for="password" class="sr-only">Password:</label>
			<input type="password" name="password" value="" id="password" placeholder="Password" class="form-control" required/>
			
			<input type="submit" name="submit" value="Login"  class="btn btn-lg btn-primary btn-block" />
			
		</form>
		
		<a href="/register">Register</a>

    </div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  </body>
</html>
