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
<?php include 'partials/_dbconnect.php'; 
  
  include 'partials/_header.php';
  ?>

    <!-- search results start here  -->

    <div class="container my-3">
    <h3 class="py-3">Search results for <?php echo $_GET['search']; ?></h3> 
    <?php
            $noresult=true;
            $query=$_GET["search"];
            $sql="SELECT * FROM `threds` WHERE MATCH(thred_title,thred_desc) against ('$query') ";
            $result=mysqli_query($conn,$sql);
            
            while($row=mysqli_fetch_assoc($result)){
                $title=$row['thred_title'];
                $desc=$row['thred_desc'];
                $thred_id=$row['thred_id'];
                $noresult=false;
                $url="thred.php?thredid=". $thred_id ;
                echo '    <div class="result ">
                <h3 ><a href="'.$url.'" class="text-dark ">'. $title .'</a> </h3>
                <p> '. $desc .'</p>
                </div>
                ';
            }
            if($noresult){
                echo '<div class="col-md-6 mb-5">
                         <div class="h-100 p-5 bg-light border rounded-3 ">
                         <p class="display-6 ">No result found</p>
                         <p ><b>- did not match any documents.</b>

                         <div> Suggestions:
                         <ul>
                        <li> Make sure that all words are spelled correctly.</li>
                        <li> Try different keywords.</li>
                        <li> Try more general keywords</li></ul>
                        </p>
                         </div>
                     </div>
                     </div> ';
            }
  ?>
    <!-- <div class="result">
    <h3><a href="/categories/div" class="text-dark"> can't install </a> </h3>
    <p>
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente natus saepe aspernatur beatae, possimus voluptatum repudiandae iure reprehenderit, esse excepturi magni. Sit similique voluptas mollitia soluta eligendi deleniti rerum incidunt.</p>
    </div>
    </div> -->


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