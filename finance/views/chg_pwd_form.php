<form data-toggle="validator" action="chg_pwd.php" method="post">
    <div class="form-group">
        <input autocomplete="off" autofocus class="form-control" name="pw" placeholder="Password" type="password"/>
    </div>
    <div class="form-group">
        <input type="password" pattern="^(?=.*\d)(?=.*[A-z])[0-9A-z!@#$%]{4,}$" maxlength="25" class="form-control" data-error="Minimum of 4 characters (letters and digits)." id="inputPassword" placeholder="Password" name="new_pw" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" name="rep_new_pw" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Change password</button>
    </div>
</form>