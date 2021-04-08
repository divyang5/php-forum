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
            $id=$_GET['catid'];
              $sql="SELECT * FROM `categories` WHERE category_id=$id ";
              $result=mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($result)){
                  $catname=$row['category_name'];
                  $catdesc=$row['category_description'];
              }
    ?>

    <?php
    $showalert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // insertion sql in this form 
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $sno=$_POST['sno'];
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
    ?>

    <!-- slider start here  -->
    <div class="container my-4">
        <div class="col-md">
            <div class="h-100 p-5 bg-dark text-light border rounded-3 ">
                <h2>welcome to <?php echo $catname; ?> forum </h2>
                <p class="lead"><?php echo $catdesc; ?></p>
                <button class="btn btn-outline-success" type="button">Learn More</button>
            </div>
        </div>
    </div>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo '
    <div  class="container my-3">
    <h2 class="py-2"> Start a discussion</h2>
        <form  action="'. $_SERVER[ "REQUEST_URI" ] .'" method="post">
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Problem title</label>
                <input type="text" class="form-control" id="title"  name="title" aria-describedby="title">
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible.</div>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"] .'">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Eloborate your problem</label>
                <textarea class="form-control"  id="desc" name="desc" ></textarea>
                <!-- <label for="floatingTextarea">Comments</label> -->
            </div>
            <button type="submit" class="btn btn-success my-3">Submit</button>
        </form>

        </div>';
}
else{
    echo '<div class="container">
    <h2 class="py-2"> Start a discussion</h2>
    <p class=" lead "> You are not logged in. Please login to be able to start the Discussion.</p>
    </div>';
}
?>

    <div class="container my-4">
        <h2 class="py-2"> Browse the question</h2>
        <?php
            $id=$_GET['catid'];
              $sql="SELECT * FROM `threds` WHERE thred_cat_id=$id ";
              $result=mysqli_query($conn,$sql);
              $noresult=true;
              while($row=mysqli_fetch_assoc($result)){
                  $noresult=false;
                  $title=$row['thred_title'];
                  $desc=$row['thred_desc'];
                  $id=$row['thred_id'];
                  $thred_time=$row['timestamp'];
                  $thred_user_id=$row['thred_user_id'];
                  $sql2="SELECT user_email FROM `users` where sno=$thred_user_id";
                  $result2=mysqli_query($conn, $sql2);
                  $row2=mysqli_fetch_assoc($result2);
                  
           
     echo   '<div class=" d-flex my=3">
            <div class="flex-shrink-0  my-3">
                <img src="img/user.jpg" width="34px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 my-3">
                <h5 class="mt-0"> <a href="thred.php?thredid='. $id .'">'. $title .'</a></h5>
                '. $desc .'
            </div>
            <p class=" mb-2"><b>Asked by: '. $row2['user_email'] .'   </b> at '. $thred_time .'</p> 
        </div>';

}
if($noresult){
   echo '<div class="col-md-6 mb-5">
            <div class="h-100 p-5 bg-light border rounded-3">
            <p class="display-6">No thred found</p>
            <p ><b>Be the first person to ask question</b></p>
            </div>
        </div>
        </div>';

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