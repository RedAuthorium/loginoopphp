<?php

require_once "core/init.php";
require_once "templates/header.php";

$errors = array();
$validation = new Validation();

$validation = $validation->check(array(
    'username' => array('required' => true),
    'password' => array('required' => true)
));

    if ( $validation->passed() ){
        if($user->login_user(Input::get('username'), Input::get('password'))){
            Session::set('username', Input::get('username'));
            header('location: profile.php');
        }else{
            $errors [] = "Login failed!";
        }
    }else{
        $errors = $validation->errors();
}

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