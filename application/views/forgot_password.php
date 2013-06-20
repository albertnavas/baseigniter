<!DOCTYPE html>
<a href="https://github.com/albertnavas/baseigniter" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub"></a>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>BaseIgniter - Forgot password</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="/public/img/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="/public/plugins/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="/public/plugins/bootstrap/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="/public/css/custom.css" />
	
	<script type="text/javascript" src="/public/js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="/public/js/jquery-ui.js"></script>
	<script type="text/javascript" src="/public/plugins/uploadify/jquery.uploadify-3.1.min.js"></script>
	<script type="text/javascript" src="/public/plugins/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="/public/js/custom.js"></script>
	
</head>
<?
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = _('Email or username');
} else {
	$login_label = _('Email');
}
?>
<body id="home">
	<div class="container">
		<?php echo form_open($this->uri->uri_string(),array('class' => 'form-signin')); ?>
		<h2 class="form-signin-heading" style="font-size:26px;">Recover password</h2>
		<?php echo form_label($login_label, $login['id']); ?>
		<?php echo form_input($login); ?>
		<?
		$form_error = form_error($login['name']);
		if(!empty($form_error)):
		echo '<div class="alert alert-error"><p>';
		echo $form_error;
		echo '</p></div>';
		endif; ?>
		<?php echo isset($errors[$login['name']])?'<div class="alert alert-error"><p>'.$errors[$login['name']].'<p/></div>':''; ?>
	<input type="submit" name="reset" class="btn btn-normal btn-primary" value="Recover password" /> or <?=anchor('/', 'Back'); ?>
	<?php echo form_close(); ?>
</div>
</body>
</html>