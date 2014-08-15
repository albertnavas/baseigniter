<div class="row" id="main_description">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h3><?=lang('forgot_password_heading')?></h3>
        <p><?=sprintf(lang('forgot_password_subheading'), $identity_label)?></p>
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

<?php echo form_open("auth/forgot_password" ,array('class' => 'form-signin text-center', 'rel' => 'form'));?>
    <input id="email" type="email" name="email" class="input-block-level form-control" placeholder="Email" />
    <button class="btn btn-large btn-primary" type="submit" name="submit" style="margin-top:20px;">Submit</button>
<?php echo form_close();?>