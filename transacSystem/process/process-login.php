<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require __DIR__ . "/database.php";

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!$email) {
        $is_invalid = true;
    } else {
        $sql = "SELECT id, name, email, password_hash FROM user WHERE email = ? LIMIT 1";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user && password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: /transacsystem/index.php");
            exit;
        } else {
            $is_invalid = true;
        }
    }
}
