<?php
require "inc/init.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usernameError = "";
  $passwordError = "";

  $username = $_POST["username"];
  if (!preg_match("/^[A-Za-z]*$/", $username)) {
    $usernameError = "Only contains [A-Za-z]";
  }

  $password = $_POST["password"];
  if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*()_+]{8,}$/", $password)) {
    $passwordError = "Password is invalid";
  }

  if ($usernameError == "" && $passwordError == "") {
    $conn = require "inc/db.php";
    $user = new User($username, $password);
    try {
      if ($user->addUser($conn)) {
        Dialog::show("Add user successfully!");
      } else {
        Dialog::show("Cannot add user");
      }
    } catch (PDOException $e) {
      // Solution added: header to error.php
      Dialog::show($e->getMessage());
    }
  } else {
    Dialog::show('Error...');
  }
}
if (isset($_SESSION['logged_in'])) {
  header("Location: index.php");
}
?>


<?php require "inc/header.php"; ?>
<div class="content">
  <form name="frmADDUSER" action="" method="post" id='fromADDUSER'>
    <fieldset>
      <legend>User Information</legend>
      <div class="row">
        <label for="username">User name:</label>
        <span class="error">*</span>
        <input name="username" id="username" type="text" placeholder="Input your Username">
        <? echo "<span class = 'error'> $usernameError </span>"; ?>
      </div>
      <div class="row">
        <label for="password">Password:</label>
        <span class="error">*</span>
        <input name="password" id="password" type="password" placeholder="Input your Password">
        <? echo "<span class = 'error'> $passwordError </span>"; ?>
      </div>
      <div class="row">
        <input type="submit" value="Save">
        <input type="reset" value="Cancel">
      </div>
    </fieldset>
  </form>
</div>
<?php require "inc/footer.php"; ?>