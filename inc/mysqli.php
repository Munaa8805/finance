<?php



////  https://www.php.net/manual/en/book.mysqli.php

// phpinfo();

@$con = mysqli_connect("127.0.0.1", "root", "", "finance");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} else {
    echo "Connected to MySQL";
}
echo "<br>";
$sql = "SELECT * FROM users";

$resultset = mysqli_query($con, $sql);

if (mysqli_errno($con)) {
    echo " MySQL execute from SQL : " . mysqli_error($con);
    exit();
}
$sql = "INSERT INTO users (name,phone,job, password) VALUES ('test', '88888888', 'test', 'test1234')";
// $insertResult = mysqli_query($con, $sql);
if (mysqli_errno($con)) {
    echo " MySQL execute from SQL : " . mysqli_error($con);
    exit();
}


if (mysqli_num_rows($resultset) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($resultset)) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " " . "<br>";
    }
} else {
    echo "0 results";
}
mysqli_close($con);