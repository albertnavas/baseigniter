<div class="row" id="main_description">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h3>¿What is BaseIgniter?</h3>
        <p>BaseIgniter is a project based on Code Igniter so you can start your website with user management, very easy. A part also includes Twitter Bootstrap and some plugin and functions to load header and footer.</p>
    </div>
</div>
<? if (isset($messagec) && !empty($messagec)) {
    $message = $messagec;
    $hidden = 'hidden';
    $show = 'show';
} else {
    $hidden = false;
    $show = false;
} ?>

<? if (isset($message) && !empty($message)) { ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <?=$message?>
            </div>
        </div>
    </div>
<? } ?>

<?php echo form_open("login" ,array('id' => 'login_form', 'class' => 'form-signin '.$hidden, 'rel' => 'form'));?>
    <input id="identity" type="text" name="identity" class="input-block-level form-control" placeholder="" />
    <input id="password" type="password" name="password" class="input-block-level form-control" placeholder="" />
    <div class="checkbox">
        <label class="checkbox" for="remember_user">
            <input id="remember" type="checkbox" name="remember" value="1" checked="<?=set_value('remember_user');?>" >Remember me
        </label>
    </div>
    <button class="btn btn-large btn-primary" type="submit" name="submit" >Log In</button>
<?php echo form_close();?>

<div class="text-center">
    <div class="row">
        <a href="/forgot_password" id="forgot-password-btn" class="<?=$hidden?>"><?=lang('login_forgot_password')?></a>
    </div>
    <div class="row" style="margin-top:20px;">
        <button id="register-btn" class="btn btn-large btn-success <?=$hidden?>" >Register</button>
    </div>
    <div class="row">
        <?=form_open("/register", array('id' => 'register_form', 'class' => 'form-signin '.$show, 'rel' => 'form'))?>
            <input type="text" name="first_name" value="" id="first_name" class="input-block-level form-control" placeholder="Name">
            <input type="text" name="email" value="" id="email" class="input-block-level form-control" placeholder="Email">
            <input type="password" name="password" value="" id="password" class="input-block-level form-control" placeholder="Password">
            <button class="btn btn-large btn-primary" type="submit" name="submit" >Sign Up</button>
        <?=form_close()?>
    </div>
    <button id="login-btn" class="btn btn-large btn-success" style="display:none;">Log In</button>
</div>
