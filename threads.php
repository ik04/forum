<?php
session_start();
print_r($_SESSION[''])

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
    body,
    html {
        min-height: 100%
    }

    #ques {
        min-height: 100%;

    }
    </style>

    <title>Deliberate! - Threads</title>

</head>

<body>
    <!-- didnt include last time lmao -->
    <?php include '/var/www/html/frbackend/forum/partials/dbconnect.php';?>
    <?php require '/var/www/html/frbackend/forum/partials/header.php';?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id`={$id}";
    // echo $sql;
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];

    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $th_thread = $_POST['title'];
        $th_desc = $_POST['desc'];
        // $id = $_SESSION['id'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`, `thread_id`) VALUES ('$th_thread', '$th_desc', '$id', '0', CURRENT_TIMESTAMP, NULL);";

        $result = mysqli_query($conn,$sql);
        $showAlert = true;
        if($showAlert){
            echo ('<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Kadavale!</strong> your thread has been stored.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome To <?php echo $catname?> Forums</h1>
            <p class="lead"><?php echo $catdesc?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            <?php
            // echo $_SERVER['REQUEST_URI'];
            ?>
        </div>

        <?php
    if ($_SESSION['loggedin'] == true) {
        
        
        echo(
        '
        <div class="container">
        <h1 class="py-2">Start a discussion</h1>
        <form action="/frbackend/forum/threads.php?catid='.$id.'" method="post">
        <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
        <small id="emailHelp" class="form-text text-muted">Keep your Title as short and crisp as
        possible.</small>
        </div>
        <div class="form-group">
                    <label for="desc">Ellaborate Your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    </div>'
                );
            }
            else {
                echo(
                    '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <h1 class="display-4">You Are Not Logged-in</h1>
                    <p class="lead"><b>Either create an account or login first</b></p>
                    </div>
                    </div>'
                );
                
                
                
            }
            ?>
    </div>



    </div>

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE `thread_cat_id`=$id; ";
            $result = mysqli_query($conn,$sql);
            //   echo $sql;
            //   echo '<pre>'.print_r($result).'</pre>'; 
            $noResult = true;
            
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $title = $row['thread_title'];
                $id = $row['thread_id'];
                $desc = $row['thread_desc'];
                $time = $row['timestamp'];
                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT `user_email` FROM `users` WHERE sno = $thread_user_id; ";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);


                $title = str_replace("<","&lt;",$title);
                $title = str_replace(">","&gt;",$title);

                $desc = str_replace("<","&lt;",$desc);
                $desc = str_replace(">","&gt;",$desc);
                

            
            
            echo (
                '
                <div class="media my-3">
                <img src="/frbackend/forum/partials/img/username.png" width="50px" class="mr-3" alt="...">
                <div class="media-body">
                <p class="font-weight-bold my-0">'.$row2['user_email'].' at '.$time.'</p>
                        <h5 class="mt-0"><a href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                        <p>'.$desc.'</p>
                    </div>
                </div>
                
                '
            );
            }
            // return var_dump($noResult);
            if($noResult){
                echo('<div class="jumbotron jumbotron-fluid ">
                <div class="container">
                  <h1 class="display-4">No Result Found</h1>
                  <p class="lead"><b>Be The First to Ask</b></p>
                </div>
              </div>');
            }
            ?>
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




<!-- 
<div class="container">
        <h1 class="py-2">Start a discussion</h1>

        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                <small id="emailHelp" class="form-text text-muted">Keep your Title as short and crisp as
                    possible.</small>
            </div>
            <div class="form-group">
                <label for="desc">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div> -->