<form data-toggle="validator" action="login.php" method="post">
    <div class="form-group">
        <input type="text"  class="form-control" data-error="Enter username please." id="inputName" placeholder="Username" name="username" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" data-error="Password needed" id="inputPassword" placeholder="Password" name="password" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Log in</button>
    </div>
</form>
<a href="/finance/public/rst_pwd.php">Reset password</a>



