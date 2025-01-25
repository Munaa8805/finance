<?php



$success = _exec("UPDATE users SET name = ?, password = ?  WHERE id = ?", "ssi", array("TestBat", "test1234", 3), $count);

// $deleteSuccess = _deleteExec("DELETE FROM users WHERE id = ?", "i", array(4), $countDelete);

// echo "Count Delete: $countDelete";


$insertSuccess = _execInsert("INSERT INTO users (name, password) VALUES (?, ?)", "ss", array("TestbAACHKA", "test1234"), $countInsert);

echo "Count Insert: $countInsert";

// /// name =col1, password = col2
$stmt = _select($stmt, $count, "SELECT name, password FROM users where id>=? and password=?", "is", array(2, "test1234"), $col1, $col2);


$allUsers = _selectAll($stmt, $count, "SELECT name, password FROM users", $col1, $col2);
echo "Count SELECT ALL: $count";
echo "<br>";

// echo "Count: $count";
// echo "<br>";
while (_fetch($stmt)) {
    echo "Name: $col1, Password: $col2";
    echo "<br>";
}

_close($stmt);
_connectionClose();