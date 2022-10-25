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
        height: 100%
    }

    #ques {
        min-height: 100%;

    }

    #comment {
        transition: .5s;
    }

    #comment:hover {
        border: green 1px solid;
    }
    </style>

    <title>Deliberate! - Thread</title>

</head>

<body>
    <!-- didnt include last time lmao -->
    <?php include '/var/www/html/frbackend/forum/partials/dbconnect.php';?>
    <?php include '/var/www/html/frbackend/forum/partials/header.php';?>

    <?php
    $id = $_GET['threadid'];   
    $sql = "SELECT * FROM `threads` WHERE `thread_id`={$id}";
    // echo $sql;
    $result = mysqli_query($conn,$sql);
    // echo $sql;
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
    ?>
    <?php
$showAlert = false;
$method = $_SERVER['REQUEST_METHOD'];
if($method == 'POST'){
    $comment= $_POST['comment'];
    // $th_desc = $_POST['desc'];
    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '0', CURRENT_TIMESTAMP);";

    $result = mysqli_query($conn,$sql);
    $showAlert = true;
    if($showAlert){
        echo ('<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Kadavale!</strong> your Comment has been Added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>');
    }
}
?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title?></h1>
            <p class="lead"><?php echo $desc?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p><b>Posted By: Ishaan</b></p>
        </div>


        <?php
    if ($_SESSION['loggedin'] == true) {
        echo(
            '<div class="container">
        <h1 class="py-2">Start a discussion</h1>
        <!-- very cool -->
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
        
        <div class="form-group">
        <label for="desc">Comments</label>
        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Post comment</button>
        </form>
        </div>'
    );
}
else {
    echo(
        '<div class="jumbotron">
        <div class="container">
        <h1 class="display-4">You Are Not Logged-in</h1>
        <p class="lead"><b>Either create an account or login first</b></p>
        </div>
        </div>'
    );
    
    
    
}
?>
    </div>




    <div class="container mb-5" id="ques">
        <h1 class="py-2">Discussions</h1>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE `thread_id`=$id; ";
            $result = mysqli_query($conn,$sql);
            $noResult = true;

        //   echo $sql;
        //   echo '<pre>'.print_r($result).'</pre>'; 

        
            while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            
            echo (
                '
                <div class="media my-3">
                <img src="/frbackend/forum/partials/img/username.png" width="50px" class="mr-3" alt="...">
                <div class="media-body">
                    <p class="font-weight-bold my-0">Name at '.$comment_time.' </p>
                        
                    '.$content.'
                      
                    </div>
                </div>
                
                '
            );
            }
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