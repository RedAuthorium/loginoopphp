<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login with OOP PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1><center>Learning PHP OOP</center></h1>
        <nav>
            <?php if(Session::exist('username')){ ?>
                <a href="logout.php">LogOut</a>
            <?php }else{ ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php } ?>
                <a href="profile.php">Profile</a>
        </nav>
    </header>