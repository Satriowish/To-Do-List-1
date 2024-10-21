<?php
require '../config/db_conn.php';

if (isset($_POST['title']) && !empty($_POST['title'])) {
    $title = $_POST['title'];
    $query = "INSERT INTO todos (title) VALUES (?)";
    $params = array($title);
    $stmt = sqlsrv_query($conn, $query, $params);
    
    if ($stmt) {
        header('Location: ../index.php');
    } else {
        echo "Error inserting data: " . print_r(sqlsrv_errors(), true);
    }
} else {
    header('Location: ../index.php?mess=error');
}
?>
