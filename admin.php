<?php

require_once "core/init.php";

if(!$user->is_loggedIn()){
    Session::flash('flashlogin', 'You should login to access this page!');
    Redirect::to('login');
}

if(!$user->is_admin(Session::get('username'))){
    Session::flash('flashprofile', 'You cannot access this page!');
    Redirect::to('profile');
}

$users = $user->get_users('users');

require_once "templates/header.php";
?>

<div>
<center>
<table border="1">
    <thead>
        <tr>
            <td>No</td>
            <td>User List</td>
        </tr>
    </thead>
    <tbody>
    <?php 
    $no = 1;
    foreach ($users as $_user): 
    $listUser = $_user['username'];    
    echo
        '<tr>
            <td>'.$no++.'</td>
            <td> <a href="profile.php?name='.$listUser.'">'.$listUser.'</a></td>
        </tr>';
    ?>
<?php endforeach; ?>
    </tbody>
</table>
</center>
</div>

<?php require_once "templates/footer.php"; ?>