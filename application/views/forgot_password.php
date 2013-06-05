<?
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = _('Email o usuario');
} else {
	$login_label = _('Email');
}
?>
<body id="home">
	<div class="container">
		<?php echo form_open($this->uri->uri_string(),array('class' => 'form-signin')); ?>
		<h2 class="form-signin-heading" style="font-size:26px;"><?=_('Recuperar password')?></h2>
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
	<input type="submit" name="reset" class="btn btn-normal btn-primary" value="<?=_('Recuperar password')?>" /> o <?=anchor('/', 'Volver'); ?>
	<?php echo form_close(); ?>
</div>
</body>
</html>