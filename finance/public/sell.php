<?php

require ("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] === "GET")
    render("sell_form.php", ["title" => "Sell Form"]);
elseif ($_SERVER["REQUEST_METHOD"] === "POST"){
    // validate sell input form
    if(empty($_POST["symbol"]))
        apologize("Invalid share.");
    elseif (($stock = lookup($_POST["symbol"])) === false)
        apologize("Share symbol not found.");
    elseif (!preg_match("/^[1-9]\d*$/", $_POST["shares"]))
        apologize('Select positive number of shares.');
    // get user share to be sold
    $stmt = $conn->prepare('SELECT SUM(shares) AS shares FROM portfolio WHERE user_id = ? AND symbol = ? GROUP BY symbol');
    $stmt->execute(array($_SESSION["id"], $stock['symbol']));
    $n = $stmt->fetch();

    if ($n == NULL)
        apologize("Missing stock in portfolio.");
    elseif ($_POST["shares"] > $n['shares'])
        apologize("Too many shares.");
    else {
        $stmt = $conn->prepare('INSERT INTO portfolio (symbol, shares, price, user_id) VALUES(?,?,?,?)');
        $stmt->execute(array($stock['symbol'], -$_POST["shares"], $stock['price'], $_SESSION["id"]));
        // get the amount of money to be updated
        $amount = $_POST["shares"] * $stock['price'];
        // set user cash after selling shares
        $stmt = $conn->prepare('UPDATE users SET cash = cash + ? WHERE id = ?');
        $stmt->execute(array($amount, $_SESSION["id"]));
        $_SESSION["sell"] = TRUE;
        redirect("/finance/public");
    }
}