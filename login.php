<?php

require_once "core/init.php";

if(Session::exist('username')){
    Redirect::to('profile');
}

if(Session::exist('flashlogin')){
    echo Session::flash('flashlogin');
}

$errors = array();
$validation = new Validation();

if(Input::get('submit')){
    $validation = $validation->check(array(
        'username' => array('required' => true),
        'password' => array('required' => true)
    ));

    if ( $validation->passed() ){
        if( $user->check_name(Input::get('username')) ){
            if( $user->login_user(Input::get('username'), Input::get('password'))){
                Session::set('username', Input::get('username'));
                Redirect::to('profile');
            }else{
                $errors [] = "Wrong Password!";
            }
        }else{
            $errors [] = "The username is not registered yet";
        }        
    }else{
            $errors = $validation->errors();
    }
}

require_once "templates/header.php";
?>

<h2>Login</h2>
<form action="login.php" method="POST">
    <label>Username</label>
    <input type="text" name="username"> <br>
    <label>Password</label>
    <input type="password" name="password"> <br>
    <input type="submit" name="submit" value="Login">
    <?php if(!empty($errors)){ ?>
        <div id="errors">
            <?php foreach ($errors as $error) { ?>
            <li><?php echo $error; ?></li>
            <?php } ?>
        </div>
    <?php } ?>
</form>

<?php
require_once "templates/footer.php";
?>