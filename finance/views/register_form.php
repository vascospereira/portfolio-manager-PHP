<form data-toggle="validator" action="register.php" method="post">
    <div class="form-group">
        <input type="text" pattern="^[A-z0-9]{2,}$" maxlength="16" class="form-control" data-error="Minimum of 2 none special characters." id="inputName" placeholder="Username" name="username" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <input type="password" pattern="^(?=.*\d)(?=.*[A-z])[0-9A-z!@#$%]{4,}$" maxlength="25" class="form-control" data-error="Minimum of 4 characters (letters and digits)." id="inputPassword" placeholder="Password" name="password" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Passwords don't match" placeholder="Confirm" name="confirmation" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>