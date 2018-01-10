<?php
require ("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] === "GET")
    render("portfolio.php", ["title" => "Portfolio"]);
elseif($_SERVER["REQUEST_METHOD"] === "POST"){
    if(empty($_POST["symbol"]))
        apologize("Missing symbol.");
    elseif(($stock = lookup($_POST["symbol"])) === false)
        apologize("Symbol not found.");
    else render("quote_info.php", ["stock" => $stock, "title" => "Quote"]);
}