<?php

session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum"> i- Discuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum/index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/forum/about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        
        $sql="select category_name,category_id  from `categories` limit 3";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          echo '
          <li><a class="dropdown-item" href="thredlist.php?catid='. $row["category_id"] .'"> '. $row["category_name"] .'</a></li>';
          
        }
        echo '  </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/forum/contact.php" tabindex="-1" >Contact</a>
      </li>
    </ul>
   ';

   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
     echo '
    <form class="d-flex column" action="search.php" method="get">
      <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      <p class="text-light mx-2"> welcome:'.   $_SESSION['useremail'] .' </p>
      <a  href="partials/_logout.php" class="btn btn-outline-success py-2" >Logout</a>
    </form>';
   } 
   else{ 
     echo '
        <form class="d-flex column">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        <button class="btn btn-outline-success mx-1 my-2 ml-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
        <button class="btn btn-outline-success  my-2 ml-2" data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button>';
   }


echo '
    </div>
      </div>
      </nav>';
include 'partials/_login.php';
include 'partials/_signup.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '
  <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success! </strong> Your can now login!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else{ 
  if(isset($_GET['error'])){
  $error=$_GET['error'];
  echo '
  <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error! </strong> '. $error .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
  echo '
  <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong> Success! </strong> You are logged in!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>