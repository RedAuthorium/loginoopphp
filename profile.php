<?php

require_once "core/init.php";
if(!Session::exist('username')){
    header("location: register.php");
}

require_once "templates/header.php";

?>

<h1><?php echo "Selamat datang " . Session::get('username'); ?></h1>

<?php require_once "templates/footer.php"; ?>