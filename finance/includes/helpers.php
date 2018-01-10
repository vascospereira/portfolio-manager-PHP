<?php

/**
 * helpers.php
 *
 * Computer Science 50
 * 
 * Helper functions.
 */

require_once("config.php");

/**
 * Apologizes to user with message.
 * @param $message Phrase to be used as message to the user
 */
function apologize($message)
{
    render("apology.php", ["message" => $message]);
}

/**
 * To process forms with security
 *
 * Avoid Cross-site scripting (XSS) - get rid unnecessary characters (extra space, tab, newline),
 * backslashes (\) and replace HTML characters like < and > with &lt; and &gt
 *
 * @param $data To be validate
 * @return string Data validated
 *
 */
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Facilitates debugging by dumping contents of argument(s)
 * to browser.
 */
function dump()
{
    $arguments = func_get_args();
    require("../views/dump.php");
    exit;
}

/**
 * Logs out current user, if any.  Based on Example #1 at
 * http://us.php.net/manual/en/function.session-destroy.php.
 */
function logout()
{
    // unset any session variables
    $_SESSION = [];
    // expire cookie
    if (!empty($_COOKIE[session_name()]))
        setcookie(session_name(), "", time() - 42000);
    // destroy session
    session_destroy();
}

/**
 * @param $url stock info API
 *
 * https://stackoverflow.com/questions/3979802/
 *
 * @return url content otherwise null
 */
function url_get_contents ($url) {
    if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

/**
 * Returns a stock by symbol (case-insensitively) else false if not found.
 * @param $symbol Stock symbol
 * @return array|bool Array with stock information or false otherwise
 */
function lookup($symbol) {

    // reject symbols that start with ^ or symbols that contain commas
    if (preg_match("/^\^/", $symbol) || preg_match("/,/", $symbol))
        return false;

    $url = url_get_contents("https://api.iextrading.com/1.0/stock/{$symbol}/quote?filter=symbol,companyName,latestPrice");

    $stock_data = json_decode($url, true);

    // ensure stock exists
    if ($stock_data === NULL)
        return false;

    return [
        "name" => $stock_data['companyName'],
        "price" => floatval($stock_data['latestPrice']),
        "symbol" => strtoupper($stock_data['symbol'])
    ];

}

/**
 * Redirects user to location, which can be a URL or
 * a relative path on the local host.
 *
 * http://stackoverflow.com/a/25643550/5156190
 *
 * Because this function outputs an HTTP header, it
 * must be called before caller outputs any HTML.
 */
function redirect($location)
{
    if (headers_sent($file, $line))
        trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
    header("Location: {$location}");
    // Make sure that code below does not get executed when we redirect.
    exit;
}

/**
 * Renders view, passing in values.
 * @param $view file to be rendered
 * @param array $values Local variables
 */
function render($view, $values = [])
{
    // if view exists, render it
    if (file_exists("../views/{$view}")) {
        // extract variables into local scope
        // This function uses array keys as variable names and values as variable values.
        // For each element it will create a variable in the current symbol table
        extract($values);
        // render view (between header and footer)
        require("../views/header.php");
        require("../views/{$view}");
        require("../views/footer.php");
        exit;
    } // else err
    else
        trigger_error("Invalid view: {$view}", E_USER_ERROR);
}
