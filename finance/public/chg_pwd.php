<?php
// configuration
require("../includes/config.php");
// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] === "GET")
    // else render form
    render("chg_pwd_form.php", ["title" => "Change Password"]);
// else if user reached page via POST (as by submitting a form via POST)
else if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute(array($_SESSION["id"]));
    $row = $stmt->fetch();
    // validate pwd chg form
    if (empty($_POST["pw"]))
        apologize("You must provide your password.");
    elseif (!password_verify($_POST["pw"], $row['hash']))
        apologize("Password incorrect.");
    elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-z!@#$%]{4,50}$/', $_POST["new_pw"]))
        apologize("Minimum of 4 characters (letters and digits).");
    elseif (password_verify($_POST["new_pw"], $row['hash']))
        apologize("Your password should be different from the last one.");
    else if ($_POST["new_pw"] !== $_POST["rep_new_pw"])
        apologize("New passwords do not match.");

    $stmt = $conn->prepare('UPDATE users SET hash = ? WHERE id = ?');
    $stmt->execute(array(password_hash($_POST["new_pw"], PASSWORD_DEFAULT), $_SESSION["id"]));
    $_SESSION["pw"] = TRUE;

    redirect("/finance/public");
}