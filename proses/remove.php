<?php
require '../config/db_conn.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM todos WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);
    
    if ($stmt) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
