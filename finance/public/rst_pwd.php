<?php
// configuration
require("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] === "GET")
    render("rst_pwd_form.php", ["title" => "Reset Password"]);
elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    //TODO
    //send email with reference
}