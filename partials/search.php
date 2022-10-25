<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Deliberate! - Home</title>
</head>
<style>
body,
html {
    height: 100%
}

#ques {
    min-height: 87vh;

}
</style>

<body>
    <!-- didnt include last time lmao -->
    <?php include '/var/www/html/frbackend/forum/partials/dbconnect.php';?>
    <?php require '/var/www/html/frbackend/forum/partials/header.php';?>

    <div class="container my-3" id="ques" class="search">
        <h1 class="search-results ">Search Results For: <em><?php echo $_GET['search']; ?></em></h1>
        <?php
        $noresults=false;
        $query = $_GET["search"];
      $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title,thread_desc) against ('$query')" ;
    //   echo $sql;
    //   echo $sql;
      // echo $sql;
      $result = mysqli_query($conn,$sql);
      // echo $sql;
      while($row = mysqli_fetch_assoc($result)){
          $title = $row['thread_title'];
          $desc = $row['thread_desc'];
          $thread_id = $row['thread_id'];
          $noresults = true;
          $url = "/frbackend/forum/thread.php?threadid=".$thread_id;


        echo (
          '<div class="result mt-3">
              <h3><a href="'.$url.'" class="text-dark text-left">'.$title.'</a>
              </h3>
              <p class="text-left">
              '.$desc.'
              </p>'
        );    
    }
    if ($noresult) {
      echo(
          '<div class="jumbotron">
          <div class="container">
          <h1 class="display-4">No Result found</h1>
          <p class="lead"><b>Enter the proper keywords.</b></p>
          </div>
          </div>'
      );
  }
  
    ?>

        <!-- 

        <h3><a href="/categories/ddf" class="text-dark text-left">giberish</a>
        </h3>
        <p class="text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio corrupti dolorem
            enim ad reprehenderit id, earum accusamus possimus itaque esse voluptatum nesciunt modi fuga ea odio,
            dignissimos voluptatibus quia corporis maiores in. ipsum dolor sit amet consectetur adipisicing elit.
            Pariatur qui laborum earum?
        </p> -->
        <!-- <h1 class="text-center">Deliberate - Browse</h1> -->
    </div>


    </div>
    </div>




    <?php require '/var/www/html/frbackend/forum/partials/footer.php'?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>