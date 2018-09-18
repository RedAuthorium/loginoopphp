<?php

require_once "core/init.php";

if(!$user->is_loggedIn()){
    Redirect::to('login');
}

if(Session::exist('flashprofile')){
    echo Session::flash('flashprofile');
}

$user_data = $user->get_data(Session::get('username'));
$errors = array();
$validation = new Validation();

if(Input::get('submit')){
    if(Token::check(Input::get('token'))){

    $validation = $validation->check(array(
        'password'          => array('required' => true),
        'new_password'      => array(
                                'required' => true,
                                'min' => 3,
                            ),
        'password_verify'    => array(
                                'required' => true,
                                'match' => 'new_password',
                            )
        ));

        if($validation->passed()){
            if(password_verify(Input::get('password'), $user_data['password'])){
                $user->update_user(array(
                    'password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)
                ), $user_data['id']);

                Session::flash('flashprofile', 'Congratulations! Your password is already changed!');
                Redirect::to('profile');
            }else {
                $errors[] = 'Your Old Password is Wrong!';
            }
            
        }else {
            $errors = $validation->errors();        
        }
    }
}

require_once "templates/header.php";

?>

<h1>Change Password Menu</h1><br>
<form action="change_password.php" method="POST">

    <label>Password</label>
    <input type="password" name="password"> <br>

    <label>New Password</label>
    <input type="password" name="new_password"> <br>

    <label>Re-Enter New Password</label>
    <input type="password" name="password_verify"> <br>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> <br>
    <input type="submit" name="submit" value="Change">
    <?php if(!empty($errors)){ ?>
        <div id="errors">
            <?php foreach ($errors as $error) { ?>
            <li><?php echo $error; ?></li>
            <?php } ?>
        </div>
    <?php } ?>
</form>

<?php require_once "templates/footer.php"; ?>