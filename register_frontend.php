<?php include 'header.html'; ?>
<div class="container">
    <div class="well bs-component">
        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend>Register user</legend>
                <div class="form-group">
                    <label for="username" name="username" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" name="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm-password" name="confirm_password" class="col-lg-2 control-label">Confirm Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm-Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" name="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" name="register" class="btn btn-default">Register</button>
                        <button type="submit" value="Login" class="btn btn-primary">Login</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
