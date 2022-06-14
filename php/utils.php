<?php
require "config.php";

// connect to database function
function database_connection()
{
    $conn = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME) or die(mysqli_error($conn));
    if ($conn->connect_error) {
        return false;
    }
    return $conn;
}

// sanitizing user input function
function testing_input($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data, ENT_QUOTES);
    $data = nl2br($data);
    return $data;
}

// select query SQL command
function sql_select($conn, $query, $format = false, ...$vars)
{
    $statement = $conn->prepare($query);
    if ($format) {
        $statement->bind_param($format, ...$vars);
    }

    if ($statement->execute()) {
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }

    $statement->close();
    return false;
}

// insert query SQL command
function sql_insert($conn, $query, $format = false, ...$vars)
{
    $statement = $conn->prepare($query);
    if ($format) {
        $statement->bind_param($format, ...$vars);
    }

    if ($statement->execute()) {
        $id = $statement->insert_id;
        $statement->close();
        return $id;
    }

    $statement->close();
    return -1;
}

// update query SQL command
function sql_update($conn, $query, $format = false, ...$vars)
{
    $statement = $conn->prepare($query);
    if ($format) {
        $statement->bind_param($format, ...$vars);
    }

    if ($statement->execute()) {
        $statement->close();
        return true;
    }

    $statement->close();
    return false;
}

// delete query SQL command
function sql_delete($conn, $query, $format = false, ...$vars)
{
    $statement = $conn->prepare($query);
    if ($format) {
        $statement->bind_param($format, ...$vars);
    }

    if ($statement->execute()) {
        $statement->close();
        return true;
    }

    $statement->close();
    return false;
}

// ----------------------------------------------------------------------------
//  CSRF Token Functions

// Encode safe url
function url_encoding($url)
{
    return rtrim(strtr(base64_encode($url), '+/', '-_'), '=');
}

// Decode safe url
function url_decoding($url)
{
    return base64_decode(strtr($url, '-_', '+/'));
}

// Generating Token for CSRF attack protection
function generating_token()
{
    $seed = url_encoding(random_bytes(8));
    $time = time();

    $data = session_id() . $seed . $time;
    $hash = url_encoding(hash_hmac("sha256", $data, CSRF_TOKEN_KEY, true));
    return url_encoding($hash . '|' . $seed . '|' . $time);
}

// Validating Token
function validating_token($token)
{
    $split_part = explode("|", url_decoding($token));
    if (count($split_part) === 3) {
        $data = session_id() . $split_part[1] . $split_part[2];
        $hash = hash_hmac("sha256", $data, CSRF_TOKEN_KEY, true);
        if (hash_equals($hash, url_decoding($split_part[0]))) {
            return true;
        }
    }
    return false;
}

// ----------------------------------------------------------------------------
