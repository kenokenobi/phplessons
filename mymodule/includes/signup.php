<?php
    if (!isset($_POST["signup"]))
    {
        header("Location: ../index.php?signup=invalidrequest");
        exit();
    }
    else
    {
        include_once 'db.php';

        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $uid = mysqli_real_escape_string($conn, $_POST['username']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

        if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd))
        {
            header("Location: ../index.php?signup=empty");
            exit();
        }
        else
        {
            $valid_name_regex = "/^[a-zA-Z\s]*$/";
            if (!preg_match($valid_name_regex, $first) || !preg_match($valid_name_regex, $last))
            {
                header("Location: ../index.php?signup=invalidname");
                exit();
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                header("Location: ../index.php?signup=invalidemail");
                exit();
            }
            else
            {
                addAccount($conn, $first, $last, $email, $uid, $pwd);
                header("Location: ../index.php?signup=success");
            }
        }
    }

    function addAccount($conn, $first, $last, $email, $uid, $pwd)
    {
        // template
        $sql = "INSERT INTO logindata (firstname, lastname, email, username, pwd)
            VALUES (?, ?, ?, ?, ?)";
    
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
    }
