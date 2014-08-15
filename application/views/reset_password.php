<div class="row" id="main_description">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h3><?=lang('reset_password_heading')?></h3>
    </div>
</div>

<? if ($message) { ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <?=$message?>
            </div>
        </div>
    </div>
<? } ?>

<?php echo form_open('auth/reset_password/' . $code ,array('class' => 'form-signin text-center', 'rel' => 'form'));?>
	<input type="password" name="new" value="" id="new" class="input-block-level form-control" pattern="^.{8}.*$" placeholder="New Password">
	<input type="password" name="new_confirm" value="" id="new_confirm" class="input-block-level form-control" pattern="^.{8}.*$" placeholder="Confirm New Password">
    <button class="btn btn-large btn-primary" type="submit" name="submit" style="margin-top:20px;">Change</button>

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>
<?php echo form_close();?>