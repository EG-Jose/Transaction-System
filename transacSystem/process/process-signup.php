<?php

session_start();

$errors = [];

if (empty($_POST["name"])) {
    $errors['name'] = "Name is required";
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Valid email is required";
}

if (strlen($_POST["password"]) < 8) {
    $errors['password'] = "Password must be at least 8 characters";
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

if (empty($errors)) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt->bind_param("sss", 
                        $_POST["name"], 
                        $_POST["email"], 
                        $password_hash);
    if ($stmt->execute()) {
        header("Location: /transacsystem/index.php");
        echo "Redirecting...";
        exit;
    } else {
        if ($mysqli->errno === 1062) {
            $errors['email'] = "Email already taken";
        } else {
            $errors['database'] = $mysqli->error . " " . $mysqli->errno;
        }

        $_SESSION['form_errors'] = $errors;
        header("Location: index.php");
        exit;
    }
} else {
    $_SESSION['form_errors'] = $errors;
    header("Location: index.php");
    exit;
}