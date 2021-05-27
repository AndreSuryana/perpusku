<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./views/css/login.css">
    <title>Selamat Datang!</title>
</head>
<body>
    <?php
    if (isset($_GET['msg']) && $_GET['msg'] == "error") {
        echo "<div class='alert'>Maaf, username atau password salah!<div>";
    }
    ?>
    
    <form action="./resources/validate.php" method="POST">
        <div class="login-box">
            <h1>Selamat Datang</h1>

            <div class="textbox">
                <i class= "fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Your username"
                    name="username" value="">
            </div>

            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Your password"
                    name="password" value="">
            </div>

            <input class="button" type="submit"
                name="login" value="Login">
        </div>
    </form>
</body>
</html>