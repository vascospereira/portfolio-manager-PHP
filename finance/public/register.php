<?php
// configuration
require("../includes/config.php");
// if user reached page via GET (as by clicking a link or via redirect)
if($_SERVER["REQUEST_METHOD"] === "GET")
    // else render form
    render("register_form.php", ["title" => "Register"]);
// else if user reached page via POST (as by submitting a form via POST)
elseif($_SERVER["REQUEST_METHOD"] === "POST") {

    if(empty($_POST["username"]))
        apologize("Missing username.");
    else if(!preg_match('/^[a-z]{2,16}$/i', $_POST["username"]))
        apologize("Minimum of 2 none special characters.");
    else if (!preg_match('/^(?=.*\d)(?=.*[A-z])[0-9A-z!@#$%]{4,50}$/', $_POST["password"]))
        apologize("Minimum of 4 characters (letters and digits).");
    else if ($_POST["password"] !== $_POST["confirmation"])
        apologize("Passwords do not match.");
    //verify if username already exists
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($_POST["username"]));
    $user = $stmt->fetch();

    if($user !== false)
        apologize("Username already exists.");
    else {
        $stmt = $conn->prepare('INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)');
        $stmt->execute(array($_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)));
        $_SESSION['id'] = $conn->lastInsertId();
        $_SESSION['username'] = $_POST["username"];
        // redirect to portfolio
        redirect("/finance/public");
    }
}