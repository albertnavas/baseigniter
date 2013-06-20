<?
$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$display_register_form = '';
$show_errors_register_form = false;
if(form_error($username['name']) != "" OR form_error($email['name']) != "" OR form_error($password['name']) != "" OR form_error($confirm_password['name']) != "" ){
	$show_errors_register_form = true;
	$display_register_form = 'display:block;';
}
?><!DOCTYPE html>
<a href="https://github.com/albertnavas/baseigniter" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub"></a>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>BaseIgniter</title>
	
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
<body id="home">
	<div class="container">
		<div class="row-fluid" id="main_description">
			<div class="span6 offset3">
				<h3>¿What is BaseIgniter?</h3>
				<p>BaseIgniter is a project based on Code Igniter so you can start your website with user management, very easy. A part also includes Twitter Bootstrap and some plugin and functions to load header and footer.</p>
			</div>
		</div>
		<?
if($this->session->flashdata('message')):
?>
<div class="row-fluid">
	<div class="span6 offset3">
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<?=$this->session->flashdata('message');?>
		</div>
	</div>
</div>
<?
endif;
?>
<? 
//Mostrar errores de login
if(isset($errors_login) AND count($errors_login) > 0): ?>
<div class="row-fluid">
	<div class="span6 offset3">
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<? foreach ($errors_login as $error): ?>
				<?=$error;?><br/>
			<? endforeach;?>
		</div>
	</div>
</div>
<? endif; ?>
		<?php echo form_open('/auth/login',array('class' => 'form-signin')); ?>
		<input type="text" name="login_user" class="input-block-level" placeholder="Email or username" />
		<input type="password" name="password_user" class="input-block-level" placeholder="Password'" />
		<? if(form_error("login_user") != "" OR form_error("password_user") != "" ): ?>
		<div class="alert alert-error">
			<?php echo form_error("login_user"); ?>
			<?php echo form_error("password_user"); ?>
		</div>
	<? endif; ?>
	<label class="checkbox" for="remember_user"><input type="checkbox" value="1" checked="<?=set_value('remember_user');?>" name="remember_user" id="remember_user">Remember me</label>
	<button class="btn btn-large btn-primary" type="submit">Log In</button>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?=anchor('/remember_password', 'Recovery password'); ?>
	<?php echo form_close(); ?>
	<?
//Mostrar errores de Registro
if( (isset($errors_register) AND count($errors_register) > 0) ):
	$display_register_form = 'display:block;';
?>
<div class="row-fluid">
	<div class="span6 offset3">
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<? foreach ($errors_register as $error): ?>
				<?=$error;?><br/>
			<? endforeach;?>
		</div>
	</div>
</div>
<? endif; ?>
	<div class="row-fluid form-register">
		<h4>Not register yet? <? if(!$show_errors_register_form): ?><a href="#" id="register">Sign Up here</a><? endif; ?></h4>
		<? if($show_errors_register_form): ?>
		<div class="alert alert-error">
			<?php echo form_error($username['name']); ?>
			<?php echo form_error($email['name']); ?>
			<?php echo form_error($password['name']); ?>
			<?php echo form_error($confirm_password['name']); ?>
		</div>
	<? endif; ?>
		<?php echo form_open('/auth/register',array('id'=>'register_form','style'=>$display_register_form)); ?>
		<div class="register_form">
		<?php echo form_label('Username', $username['id']); ?>
		<?php echo form_input($username); ?>
		</div>
		<div>
		<?php echo form_label('Email', $email['id']); ?>
		<?php echo form_input($email); ?>
		</div>
		<div>
		<?php echo form_label('Password', $password['id']); ?>
		<?php echo form_password($password); ?>
		</div>
		<div>
		<?php echo form_label('Confirm password', $confirm_password['id']); ?>
		<?php echo form_password($confirm_password); ?>
		</div>
		<div style="float:right;">
		<?php echo form_submit('register', 'Sign Up','class="btn btn-large btn-primary"'); ?>
		</div>
	<?php echo form_close(); ?>
</div>
</div>
</body>
</html>