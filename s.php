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