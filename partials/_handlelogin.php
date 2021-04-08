<?php
$showError="false";
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $email=$_POST['loginEmail'];
    $pass=$_POST['loginPass'];
    $sql="select * from `users` where user_email='$email'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    
    if($numRows==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass'])){
            $_SESSION['loggedin']=true;
            $_SESSION['sno']=$row['sno'];
            $_SESSION['useremail']=$email;
            header("location:/forum/index.php?loginsuccess=true");
            exit();
        }
        else{
            $_SESSION['loggedin']=false;
            $showError=" password is wrong";
            header("location:/forum/index.php?error=$showError");
        }
    }
    else{
        $_SESSION['loggedin']=false;
        $showError=" user does not exist";
        header("location:/forum/index.php?error=$showError");
    }

}
?>