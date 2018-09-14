<?php

require_once "core/init.php";
require_once "templates/header.php";

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
    print_r($validation->errors());
}

?>

<h2>Register</h2>
<form action="register.php" method="POST">
    <label>Username</label>
    <input type="text" name="username"> <br>
    <label>Password</label>
    <input type="password" name="password"> <br>
    <input type="submit" name="submit" value="Join Now!!!">
</form>

<?php
require_once "templates/footer.php";
?>