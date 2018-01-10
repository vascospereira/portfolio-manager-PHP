<?php
// configuration
require("../includes/config.php");
// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] === "GET")
    // else render form
    render("login_form.php", ["title" => "Log In"]);
// else if user reached page via POST (as by submitting a form via POST)
else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // validate submission
    if (empty($_POST["username"]))
        apologize("You must provide your username.");
    else if (empty($_POST["password"]))
        apologize("You must provide your password.");

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($_POST["username"]));
    $user = $stmt->fetch();
    // if we found user, check password
    if ($user !== false) {
        // compare hash of user's input against hash that's in database
        if (password_verify($_POST["password"], $user['hash'])) {
            // remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $user['id'];
            $_SESSION["username"] = $_POST["username"];
            // redirect to portfolio
            redirect("/finance/public");
        }
    }
    // else apologize
    apologize("Invalid username and/or password.");
}