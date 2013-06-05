<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
);
?>
<body id="home">
	<div class="container">
		<?php echo form_open($this->uri->uri_string(),array('class' => 'form-signin')); ?>
		<h2 class="form-signin-heading" style="font-size:26px;"><?=_('Recuperar password')?></h2>
		<?php echo form_label(_('Nuevo Password'), $new_password['id']); ?>
		<?php echo form_password($new_password); ?>
		<?
		$form_error1 = form_error($new_password['name']);
		if(!empty($form_error1)):
		echo '<div class="alert alert-error"><p>';
		echo $form_error1;
		echo '</p></div>';
		endif; 
		?>
		<?php echo form_label(_('Confirma nuevo Password'), $confirm_new_password['id']); ?>
		<?php echo form_password($confirm_new_password); ?>
		<?
		$form_error2 = form_error($confirm_new_password['name']);
		if(!empty($form_error2)):
		echo '<div class="alert alert-error"><p>';
		echo $form_error2;
		echo '</p></div>';
		endif;
		?>
	<input type="submit" name="reset" class="btn btn-normal btn-primary" value="<?=_('Cambiar password')?>" />
	<?php echo form_close(); ?>
</div>
</body>
</html>