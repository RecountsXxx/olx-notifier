<?php

function check_exists_url($var_olx_url, $var_email, $conn)
{
    $olx_url = $conn->real_escape_string($var_olx_url);
    $email = $conn->real_escape_string($var_email);

    $checkQuery = 'SELECT COUNT(*) as count FROM subscribe_table WHERE olx_url = ? and email = ?';
    $checkStmt =  $conn->prepare($checkQuery);

    if ($checkStmt === false) {
        die("Error in prepared statement: " .  $conn->error);
    }

    $checkStmt->bind_param('ss', $olx_url, $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $count = $checkResult->fetch_assoc()['count'];

    $checkStmt->close();

    if ($count > 0) {
        return true;
    }
    else{
        return false;
    }
}