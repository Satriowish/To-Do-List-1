<?php
require '../config/db_conn.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Get current checked value
    $query = "SELECT checked FROM todos WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);
    
    if ($stmt) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $newCheckedValue = ($row['checked'] == 1) ? 0 : 1;  // Toggle checked value
        $updateQuery = "UPDATE todos SET checked = ? WHERE id = ?";
        $updateParams = array($newCheckedValue, $id);
        $updateStmt = sqlsrv_query($conn, $updateQuery, $updateParams);
        
        if ($updateStmt) {
            echo $newCheckedValue;
        } else {
            echo "error";
        }
    }
}
?>
