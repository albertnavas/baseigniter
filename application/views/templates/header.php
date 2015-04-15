<!DOCTYPE html>
<a href="https://github.com/albertnavas/baseigniter" target="_blank"><img style="position: fixed; top: 0; left: 0; border: 0;z-index:9999;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_red_aa0000.png" alt="Fork me on GitHub"></a>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BaseIgniter</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">
		
	<?
	//CSS
	foreach ($css as $key => $row) {
		if (substr($row, 0,2) == '//') {
			echo '<link rel="stylesheet" type="text/css" href="'.$row.'">';
		} else {
			$time = date("U", filectime($this->input->server('DOCUMENT_ROOT').$row));
		    if ($time > 0) {
		        echo '<link rel="stylesheet" type="text/css" href="'.$row.'?'.$time.'">';
		    }
		}
	}
	
	//JS
	foreach ($js as $key => $row2) {
		if (substr($row2, 0,2) == '//') {
			echo '<script type="text/javascript" src="'.$row2.'"></script>';
		} else {
			$time = date("U", filectime($this->input->server('DOCUMENT_ROOT').$row2));
		    if ($time > 0) {
		        echo '<script type="text/javascript" src="'.$row2.'?'.$time.'"></script>';
		    }
		}
	}
	?>
	
</head>
<body role="document">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  	<div class="container">
		    <div class="navbar-header">
		    	<a class="navbar-brand" href="<?=site_url();?>" style="margin-left: 50px;">BaseIgniter</a>
		    </div>
		    <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
			      	<li><a href="<?=site_url();?>">Home</a></li>
			      	<li><a href="/manage">Backend</a></li>
			      	<li class="dropdown">
			      		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?=$user['username']?> <span class="caret"></span></a>
				  		<ul class="dropdown-menu" role="menu">
		                	<li><a href="/logout">Log Out</a></li>
		                </ul>
		            </li>
			  	</ul>
			</div>
	  	</div>
	</div>
	<div class="container">
