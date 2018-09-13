<?php

require_once "core/init.php";
require_once "templates/header.php";

if ( Input::Get('submit')){
    $user->register_user(array(
        'username' => Input::Get('username'),
        'password' => password_hash(Input::Get('password'), PASSWORD_DEFAULT),
    ));
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