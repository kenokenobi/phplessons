<?php
    echo "Hi";
    include_once 'db.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    echo "Hi";

    // template
    $sql = "INSERT INTO users (firstname, lastname, email, username, pwd)
        VALUES (? ? ? ? ?)";

    // prepared statement
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement invalid";
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $pwd);
        mysqli_stmt_execute($stmt);
    }

    echo "Hi";