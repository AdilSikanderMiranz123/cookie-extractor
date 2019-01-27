<?php
function extractCookies ($string) {
    $cookies = array();
    $lines = explode("\n", $string);
    // iterate over lines
    foreach ($lines as $line) {
        // we only care for valid cookie def lines
        if (isset($line[0]) && substr_count($line, "\t") == 6) {
            // get tokens in an array
            $tokens = explode("\t", $line);
            // trim the tokens
            $tokens = array_map('trim', $tokens);
            $cookie = array();
            // Extract the data
            $cookie['domain'] = $tokens[0];
            $cookie['flag'] = (bool) $tokens[1];
            $cookie['path'] = $tokens[2];
            $cookie['secure'] = (bool) $tokens[3];
            // Convert date to a readable format
            $cookie['expiration'] = date('Y-m-d h:i:s', $tokens[4]);
            $cookie['name'] = $tokens[5];
            $cookie['value'] = $tokens[6];
            // Record the cookie.
            $cookies[] = $cookie;
        }
    }
    return $cookies;
}