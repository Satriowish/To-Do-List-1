<?php
    $serverName = "SATRIOWISNU\SQLEXPRESS";  // SQL Sever saya
    $connectionInfo = array(
        "Database" => "todolist",                  // Nama database
        "TrustServerCertificate" => true,             // 
        "UID" => "",                                  // 
    );

    try {
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if ($conn === false) {
            // Jika koneksi gagal
            throw new Exception('Connection failed: ' . print_r(sqlsrv_errors(), true));
        }

        // echo "Connected successfully to SQL Server";
        
    } catch (Exception $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
