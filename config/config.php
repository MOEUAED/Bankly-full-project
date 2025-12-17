<?php

    $connect = mysqli_connect ("localhost", "root", "", "bankly_v2");
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>