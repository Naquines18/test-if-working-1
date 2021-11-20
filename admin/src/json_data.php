<?php
require_once '../../src/config.php';
    $browser_log = mysqli_query($conn, "SELECT * FROM browser_logs");
    while ($row = mysqli_fetch_array($browser_log)) {
        $browser[] = $row['browser'];

    }

    echo json_encode($browser);
?>