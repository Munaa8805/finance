<?php
@$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} 

function _exec($sql, $types, $sqlParams, &$count)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    $success = mysqli_stmt_execute($stmt);
    $count = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $success;
   
}
function _deleteExec($sql, $types, $sqlParams, &$countDelete)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    $success = mysqli_stmt_execute($stmt);
    $countDelete = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $success;
}
function _execInsert($sql, $types, $sqlParams, &$countInsert)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    $success = mysqli_stmt_execute($stmt);
    $countInsert = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);
    return $success;
}
/// &$stmt = zaaltaar damjuulj bn

function _select(&$stmt, &$count, $sql, $types,  $sqlParams, &...$bindParams)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, ...$bindParams);
    
}

function _selectAll(&$stmt, &$count, $sql,&...$bindParams)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, ...$bindParams);

}




function _fetch($stmt)
{
   return mysqli_stmt_fetch($stmt);
}
function _close($stmt)
{
    mysqli_stmt_close($stmt);
}
function _connectionClose()
{
    global $con;
    mysqli_close($con);
}