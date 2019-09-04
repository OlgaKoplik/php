<?php
function load($page = 'login.php'){
    $url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url,'\/');
    $url.='/'.$page;
    header("Location:$url");
    exit();
}

function validate($dbc, $email="", $pwd=""){
    $errors=array();
    #email validation
    if(empty($email)){
        $errors[]='Enter Email.';
    }else{
        $e = mysqli_real_escape_string($dbc, trim($email));
    }

    #pass validation
    if(empty($pwd)){
        $errors[]='Enter password.';
    }else{
        $p = mysqli_real_escape_string($dbc, trim($pwd));
    }

    # NO errors
    if(empty($errors)){
        $q = "SELECT user_id, first_name, last_name
        FROM users
        WHERE email='$e'
        AND pass = SHA2('$p',256)";
        $r = mysqli_query($dbc, $q);
        if(mysqli_num_rows($r) == 1){
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
            return array(true, $row);
        }else{
            $errors[]='Email or password not found.';
        }
    }
    return array(false, $errors);
}
?>