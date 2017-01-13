<h1><?= $error; ?></h1>
<?php include 'header.html'; ?>
<div class="container">
    <div class="well bs-component">
        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend>Login</legend>
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
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="register" class="btn btn-default">Register</button>
                        <button type="submit" value="Login" class="btn btn-primary">Login</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
<?php include 'footer.html'; ?>
