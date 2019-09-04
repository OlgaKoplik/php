<?php 
$page_title = 'Login';
include('includes/header.html');
if(isset($errors) && !empty($errors)){
    echo '<p id="err_msq">Opps! Problem:<br/>';
    foreach($errors as $msg){
        echo "$msg<br/>";
    }
    echo '</p>';
}
?>
<h1>Sign in</h1>
<form action="login_action.php" method="POST">
    <p>
        <label>Email:</label><br/> <input type="text" name="email">
    </p><p>
    <label>Password:</label><br/> <input type="password" name="pass">
    </p><p>
        <input type="submit" value="Sign in">
    </p>
</form>
<?php
echo'<p>
        No account yet? <a href="register.php">Registration</a>
    </p>';
?>