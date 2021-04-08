<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>i-forum</title>
</head>

<body>
<?php include 'partials/_dbconnect.php'; ?>
    <?php
  include 'partials/_header.php';
  ?>
    <?php
            $id=$_GET['thredid'];
              $sql="SELECT * FROM `threds` WHERE thred_id=$id ";
              $result=mysqli_query($conn,$sql);
           
              while($row=mysqli_fetch_assoc($result)){
                  $title=$row['thred_title'];
                  $desc=$row['thred_desc'];
                  $thred_user_id=$row['thred_user_id'];
                  $sql2="SELECT user_email FROM `users` where sno=$thred_user_id";
                      $result2=mysqli_query($conn, $sql2);
                      $row2=mysqli_fetch_assoc($result2);
                      $posted_by=$row2['user_email'];

              }
    ?>
     <?php
    $showalert=false;
    $noresult=true;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // insertion sql in this form 
        $comment=$_POST['comment'];
        $sno=$_POST['sno'];
        
        $sql="INSERT INTO `comments` (`comment_content`, `thred_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
        $noresult=false;
        if($showalert){
            echo'
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your comment has been added!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

    }
    ?>

    <!-- slider start here  -->
    <div class="container my-4">
        <div class="col-md">
            <div class="h-100 p-5 bg-dark text-light border rounded-3 ">
                <h2><?php echo $title; ?> </h2>
                <p class="lead"><?php echo $desc; ?></p>
                <p><b>Posted by :<?php echo $posted_by; ?> </b></p>
            </div>
        </div>
    </div>
    
  
<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '
    <div  class="container my-3">
    <h2 class="py-2"> Post a comment</h2>
        <form  action="'. $_SERVER['REQUEST_URI'] .'" method="post">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"> Add your Comment </label>
                <textarea class="form-control"  id="comment" name="comment" ></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"] .'">
            </div>
            <button type="submit" class="btn btn-success my-3">Post Comment</button>
        </form>

        </div>';

}
else{
    echo '<div class="container">
    <h2 class="py-2"> Post a comment</h2>
    <p class=" lead "> You are not logged in. Please login to be able to start the Discussion.</p>
    </div>';
}
        ?>
<!-- 
    <?php
    $showalert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // insertion sql in this form 
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $sql="INSERT INTO `threds` ( `thred_title`, `thred_desc`, `thred_cat_id`, `thred_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        
        $showalert=true;
        if($showalert){
            echo'
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your thred has been added!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

    }
    ?> -->
    <div class="container mb-4">
        <h1 class="py-2 my-3"> Comment</h1>
        <?php
            $id=$_GET['thredid'];
            $noresult=true;
              $sql="SELECT * FROM `comments` WHERE thred_id=$id ";
              $result=mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($result)){
                  $content=$row['comment_content'];
                  $id=$row['comment_id'];
                  $noresult=false;
                  $comment_time=$row['comment_time'];
                  $thred_user_id=$row['comment_by'];
                  $sql2="SELECT user_email FROM `users` where sno=$thred_user_id";
                  $result2=mysqli_query($conn, $sql2);
                  $row2=mysqli_fetch_assoc($result2);
           
     echo   '<div class="d-flex">
            <div class="flex-shrink-0 mb-4">
                <img src="img/user.jpg" width="34px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 ">
                <p class="font-weight-bold my-0"><b>  '. $row2['user_email'] .'   </b>    at '. $comment_time .'</p> 
                <p> '. $content .' </p>
            </div>
        </div>';
    // </div>
}
?>
<?php
if($noresult){
   echo '<div class="col-md-6 mb-5">
            <div class="h-100 p-5 bg-light border rounded-3 ">
            <p class="display-6 ">No comment found</p>
            <p ><b>Be the first person to comment.</b></p>
            </div>
        </div>
        </div> ';

}
?>


    <!-- category container start here  -->


    <?php include 'partials/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>