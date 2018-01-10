<?php

/**
 * config.php
 *
 * Configures app.
 */
// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);
// requirements
require("helpers.php");
require ('../vendor/init.php');
// enable sessions
session_start();
// require authentication for all pages except login.php, logout.php, register.php and rst_pwd.php
// requires users to log in if they aren’t logged in already (and if they aren’t already at one of those pages)
if (!preg_match("{(?:login|logout|register|rst_pwd).php$}", $_SERVER["PHP_SELF"]))
    if (empty($_SESSION["id"]))
        redirect("login.php");