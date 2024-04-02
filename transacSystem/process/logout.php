<?php
session_start();

session_destroy();

header("Location: " . __DIR__ . "/index.php");
exit;
?>

<script>
    setTimeout(function() {
        window.location.reload();
    }, 1000);
</script>