<?php
// configuration
require("../includes/config.php");
// select all shares from portfolio
$stmt = $conn->prepare('SELECT symbol, SUM(shares) AS shares FROM portfolio WHERE user_id = ? GROUP BY symbol HAVING SUM(shares) > 0');
$stmt->execute(array($_SESSION["id"]));
$rows = $stmt->fetchAll();
$stmt = $conn->prepare('SELECT cash FROM users WHERE id = ?');
$stmt->execute(array($_SESSION["id"]));
$account = $stmt->fetch();
// gets the user cash and adds it to the portfolio value
$total = $account['cash'];
$stocks = [];

for ($i=0,$n=count($rows);$i<$n;$i++){
    $stock=lookup($rows[$i]['symbol']);
    if($stock !== false){
        $total+=$rows[$i]['shares']*$stock['price'];
        $stocks[] = [
            'name'=>$stock['name'],
            'price'=>$stock['price'],
            'share'=>$rows[$i]['shares'],
            'symbol'=>$rows[$i]['symbol']
        ];
    }
}
// render portfolio
render("portfolio.php", ["stocks" => $stocks, "account" => $account, "total" => $total, "title" => "Portfolio"]);
