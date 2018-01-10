<?php

require ("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] === "GET")
    render("buy_form.php", ["title" => "Buy Form"]);
elseif ($_SERVER["REQUEST_METHOD"] === "POST"){
    # validate form
    if(empty($_POST["symbol"]))
        apologize("Invalid share.");
    elseif (($stock = lookup($_POST["symbol"])) === false)
        apologize("Share symbol not found");
    elseif (!preg_match("/^[1-9]\d*$/", $_POST["shares"]))
        apologize('Select positive number of shares.');
    // total price the user spend to buy some number of shares
    $price = $_POST["shares"] * $stock["price"];
    // gets the user available cash
    $stmt = $conn->prepare('SELECT cash FROM users WHERE id = ?');
    $stmt->execute(array($_SESSION["id"]));
    $amount = $stmt->fetch();
    // must have cash in the account
    if($amount["cash"] < $price) {
        apologize("You don't have enough cash.");
    } else {
        // adds shares to the user's portfolio
        $stmt = $conn->prepare('INSERT INTO portfolio (symbol, shares, price, user_id) VALUES(?, ?, ?, ?)');
        $stmt->execute(array($stock['symbol'], $_POST["shares"], $stock['price'], $_SESSION["id"]));
        // updates the user's account
        $stmt = $conn->prepare('UPDATE users SET cash = cash - ? WHERE id = ?');
        $stmt->execute(array($price, $_SESSION["id"]));
        $_SESSION["buy"] = TRUE;
        // goes to the user's portfolio after buy operation
        redirect("/finance/public");
    }
}