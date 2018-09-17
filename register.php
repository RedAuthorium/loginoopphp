<?php

require_once "core/init.php";

if(Session::exist('username')){
    header("location: profile.php");
}

$errors = array();
$validation = new Validation();

$validation = $validation->check(array(
    'username' => array(
                        'required' => true,
                        'min' => 5,
                        'max' => 15
                  ),
    'password' => array(
                        'required' => true,
                        'min' => 3,
                  )
));

    if( $user->check_name(Input::get('username')) ){
        $errors [] = "Name already registered!";
    }else {
        if ( $validation->passed() ){
            $user->register_user(array(
                'username' => Input::get('username'),
                'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
            ));

            Session::set('username', Input::get('username'));
            header('location: profile.php');
        }else {
            $errors = $validation->errors();
        }
    }

require_once "templates/header.php";

?>

<h2>Register</h2>
<form action="register.php" method="POST">
    <label>Username</label>
    <input type="text" name="username"> <br>

    <label>Password</label>
    <input type="password" name="password"> <br>
    
    <input type="submit" name="submit" value="Join Now!!!">

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