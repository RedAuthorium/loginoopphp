<?php

require_once "core/init.php";

if(Session::exist('username')){
    Redirect::to('profile');
}

$errors = array();
$validation = new Validation();

if(Input::get('submit')){
    $validation = $validation->check(array(
        'username' => array(
                            'required' => true,
                            'min' => 5,
                            'max' => 15
                        ),
        'password' => array(
                            'required' => true,
                            'min' => 3,
                        ),

        'password_verify' => array(
                            'required' => true,
                            'match' => 'password',
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

            Session::flash('flashprofile', 'Congratulations! Your account is ready!');
            Session::set('username', Input::get('username'));
            Redirect::to('profile');
        }else {
            $errors = $validation->errors();   
        }
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

    <label>Re-Password</label>
    <input type="password" name="password_verify"> <br>
    
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