<?php
include "protect.php";
include "db.php";

$stmt = $conn->prepare("INSERT INTO employees(name, email, phone, position) VALUES(?, ?, ?, ?)");
$stmt->bind_param("ssss",
    $_POST['name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['position']
);
$stmt->execute();

header("Location: employees.php");
exit();
?>
