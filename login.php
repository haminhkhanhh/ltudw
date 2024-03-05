<?php
require "inc/init.php";
ini_set('display_errors', 'off');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $conn = require "inc/db.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(User::authenticate($conn, $username, $password)){
        Auth::login();
        header("Location: index.php");
    }else{
        Dialog::show("Invalid username or password");
    }
}
?>
<?php
    require "inc/header.php";
?>
<div class="content">
    <form name="frmLOGIN" action="" method="post" id="frmLOGIN">

        <fieldset>
            <legend>Login System</legend>
            <div class="row">
                <label for="username">Username:</label>
                <span class="error">*</span>
                <input name="username" id="username" type="text" placeholder="Input your Username">
            </div>
            <div class="row">
                <label for="password">Password:</label>
                <span class="error">*</span>
                <input name="password" id="password" type="password" placeholder="Input your Password">
            </div>
            <div class="row">
                <input type="submit" value="Login">
                <input type="reset" value="Cancel">
            </div>
        </fieldset>
    </form>
</div>
<?php require "inc/footer.php";?>