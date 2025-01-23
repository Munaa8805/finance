<?php

@$con = mysqli_connect("127.0.0.1", "root", "", "finance");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} else {
    echo "Connected to MySQL";
}

echo "<br>";    
$sql = "SELECT * FROM users where id>=?";

$stmt = mysqli_prepare($con, $sql);
$filteredId = 3;
mysqli_stmt_bind_param($stmt, "i", $filteredId);
mysqli_stmt_execute($stmt);
$resultset = mysqli_stmt_get_result($stmt);


if (mysqli_errno($con)) {
    echo " MySQL execute from SQL : " . mysqli_error($con);
    exit();
}

if (mysqli_num_rows($resultset) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($resultset)) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . "- Password: ".$row["password"] . "<br>";
    }
} else {
    echo "0 results";
}
mysqli_stmt_close($stmt);
mysqli_close($con);