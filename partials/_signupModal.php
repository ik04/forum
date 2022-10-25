<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signupModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign up for a new account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/frbackend/forum/partials/_handlesignup.php" method="POST">
                <div class=" modal-body">
                    <div class="form-group">
                        <label for="emailsignup">Username</label>
                        <!-- <input type="email" class="form-control" id="emailsignup" aria-describedby="emailHelp"
                            name="emailsignup"> -->
                        <input type="text" class="form-control" id="emailsignup" aria-describedby="emailHelp"
                            name="emailsignup">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone -->
                        <!-- else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="signuppassword" name="signuppassword">
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="signupcpassword" name="signupcpassword">
                    </div>

                    <button type="submit" class="btn btn-primary">Sign-up</button>
                </div>
                <div class="modal-footer">
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>