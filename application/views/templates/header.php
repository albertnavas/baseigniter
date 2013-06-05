<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=_('BaseIgniter')?></title>
	
	<link rel="shortcut icon" type="image/x-icon" href="/public/favicon.ico">
	
	<?
	//CSS
	foreach ($css as $key => $row) {
		$time = date("U", filectime($this->input->server('DOCUMENT_ROOT').$row));
	    if ($time > 0) {
	        echo '<link rel="stylesheet" type="text/css" href="'.$row.'?'.$time.'">';
	    }
	}
	
	//JS
	foreach ($js as $key => $row2) {
		$time = date("U", filectime($this->input->server('DOCUMENT_ROOT').$row2));
	    if ($time > 0) {
	        echo '<script type="text/javascript" src="'.$row2.'?'.$time.'"></script>';
	    }
	}
	?>

</head>
<body>
<div class="container">
	<div class="row-fluid">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
		  		<div class="span5 offset1">
		    		<a class="brand" href="<?=site_url();?>"><?=_('BaseIgniter')?></a>
		    	</div>
			  	<div class="span3 offset3">
				    <ul class="nav">
				      	<li><a href="<?=site_url();?>"><?=_('Inicio')?></a></li>
				      	<li class="dropdown">
		                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=_('Hi')?>, <?=$user['data']['username']?> <b class="caret"></b></a>
		                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
		                    	<li><a href="<?=site_url('auth/logout');?>"><?=_('Salir')?></a></li>
		                    </ul>
		                </li>
				    </ul>
			  	</div>
			</div>
		</div>
	</div>
