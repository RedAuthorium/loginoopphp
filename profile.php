<?php

require_once "core/init.php";

if(!Session::exist('username')){
    Session::flash('flashlogin', 'You should login to access this page!');
    Redirect::to('login');
}

if(Session::exist('flashprofile')){
    echo Session::flash('flashprofile');
}

require_once "templates/header.php";

?>

<h1><?php echo "Selamat datang " . Session::get('username'); ?></h1>

<?php require_once "templates/footer.php"; ?>