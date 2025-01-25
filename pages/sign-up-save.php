<?php


dd($_POST);
$errors = [];
// $name = trim($_POST['username']);
// $email = $_POST['email'];
// $phone = trim($_POST['phone']);
// $password = trim($_POST['password']);
// $confirmpassword = trim($_POST['confirmpassword']);

$name = post('username', 50);
$password = post('password', 10);
$confirmpassword = post('confirmpassword', 10);
$phone = post('phone', 15);
$email = post('email', 150);


// Хэрэглэгчийн нэр шаардлага хангаж буй эсэх
if (mb_strlen($name) < 2) {
    $errors[] = "Хэрэглэгчийн нэрийн урт дор хаяж 2 үсгээс тогтоно";
}

// Ийм утастай хэрэглэгч бүртгэлтэй эсэх
_select(
    $stmt, $count,
    "select count(*) from users where phone=?",
    's',
    [$phone],
    $numberOfPhone
);

_fetch($stmt);

if ($numberOfPhone > 0) {
    $errors[] = "$phone утасны дугаар аль хэдийн бүртгэлтэй байна.";
}

// Ийм имэйлтэй хэрэглэгч бүртгэлтэй эсэх
_select(
    $stmt, $count,
    "select count(*) from users where email=?",
    's',
    [$email],
    $numberOfEmail
);

_fetch($stmt);

if ($numberOfEmail > 0) {
    $errors[] = "$email имэйл аль хэдийн бүртгэлтэй байна.";
}
// Нууц үгүүд хоорондоо таарч буй эсэх
if ($password != $confirmpassword) {
    $errors[] = "Нууц үгүүд хоорондоо таарахгүй байна";
}

// Ямар ч алдаагүй бол базд бүртгэнэ
if (sizeof($errors) == 0) {
    $success = _exec(
        "insert into users set name=?, pass=?, phone=?, email=?",
        'ssss',
        [$name, $password, $phone, $email],
        $count
    );
    if ($success) {
        echo "Successfull saved";
        redirect("/home");
    } else {
        echo "Failed to save";
    }

 
} else {
    dd($errors);
}