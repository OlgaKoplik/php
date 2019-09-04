<?php 
$page_title = 'Register';
include('includes/header.html');
if($_SERVER['REQUEST_METHOD']=='POST'){
    require('../connect_db.php');
    $errors = array();
    #first_name validation
    if(empty($_POST['first_name'])){
        $errors[]='Enter your first name.';
    }
    else{
        $fn = mysqli_real_escape_string($dbc,trim($_POST['first_name']));
    }
    #last_name validation
    if(empty($_POST['last_name'])){
        $errors[]='Enter your last name.';
    }
    else{
        $ln = mysqli_real_escape_string($dbc,trim($_POST['last_name']));
    }
    #email validation
    if(empty($_POST['email'])){
        $errors[]='Enter your email address.';
    }
    else{
        $e = mysqli_real_escape_string($dbc,trim($_POST['email']));
    }
    #pass validation
    if(!empty($_POST['pass1'])){
        if($_POST['pass1'] != $_POST['pass2']){
            $errors[]='Passwords do not match';
        }
        else{
            $p = mysqli_real_escape_string($dbc,trim($_POST['pass1']));
        }
    }
    else{$errors[]='Enter your password.';}
    #if user alredy registered
    if(empty($errors)){
        $q = "select user_id from users where email='$e'";
        $r = mysqli_query($dbc, $q);
        if(mysqli_num_rows($r) != 0){
            $errors[]='Email address alredy registrered. <a href="login.php">Login</a>';
        }
    }
    #if all fields are valid
    if(empty($errors)){
        $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) 
        VALUES ('$fn','$ln','$e',SHA2('$p',256),NOW())";
        $r = mysqli_query($dbc, $q);
        if($r){
            echo'<h1>Registration is successful!</h1>
            <p><a href="login.php">Sign in</a></p>';
        }
        mysqli_close($dbc);
        exit();
    }
    #show errors
    else{
        echo '<h1>Error!</h1>
        <p id="err_msg">The following error(s) occurred:<br/>';
        foreach($errors as $msg){
            echo "-$msg<br/>";
        }
        echo 'Please try again.</p>';
        mysqli_close($dbc);
    }

}

?>
<h1>Registration</h1>
<form action="register.php" method="POST">
    <p>
        Last Name:<br/> <input type="text" name="first_name" 
        value="<?php if(isset($_POST['first_name']))
        echo $_POST['first_name'];?>"/>
    </p>
    <p>
        First Name:<br/> <input type="text" name="last_name" 
        value="<?php if(isset($_POST['last_name']))
        echo $_POST['last_name'];?>"/>
    </p><p>
        Email:<br/> <input type="text" name="email" 
        value="<?php if(isset($_POST['email']))
        echo $_POST['email'];?>"/>
    </p><p>
        Password:<br/> <input type="password" name="pass1" 
        value="<?php if(isset($_POST['pass1']))
        echo $_POST['pass1'];?>"/>
    </p><p>
    
        Confirm password:<br/> <input type="password" name="pass2" 
        value="<?php if(isset($_POST['pass2']))
        echo $_POST['pass2'];?>"/>
    </p><p>
        <input type="submit" value="Registration">
    </p>
</form>


