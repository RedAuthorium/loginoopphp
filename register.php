<?php

require_once "core/init.php";
require_once "templates/header.php";

$errors = array();
$validation = new Validation();

$validation = $validation->check(array(
    'username' => array(
                        'required' => true,
                        'min' => 5,
                        'max' => 11
                  ),
    'password' => array(
                        'required' => true,
                        'min' => 5,
                  )
));

if ( $validation->passed() ){
    $user->register_user(array(
        'username' => Input::get('username'),
        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
    ));
}else {
    $errors = $validation->errors();
}

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