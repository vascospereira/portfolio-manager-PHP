<?php

require ("../includes/config.php");

$stmt = $conn->prepare('SELECT * FROM portfolio WHERE user_id = ?');
$stmt->execute(array($_SESSION["id"]));
$rows = $stmt->fetchAll();

render("history_logs.php", ["logs" => $rows, "title" => "History"]);