<?php
include "protect.php";
include "db.php";

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE employees SET name=?, email=?, phone=?, position=? WHERE id=?");
    $stmt->bind_param("ssssi", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['position'], $id);
    $stmt->execute();
    header("Location: employees.php");
    exit();
}

$emp = $conn->query("SELECT * FROM employees WHERE id=$id")->fetch_assoc();
?>

<form method="POST">
    <input type="text" name="name" value="<?php echo $emp['name']; ?>" required>
    <input type="text" name="email" value="<?php echo $emp['email']; ?>" required>
    <input type="text" name="phone" value="<?php echo $emp['phone']; ?>" required>
    <input type="text" name="position" value="<?php echo $emp['position']; ?>" required>
    <button type="submit">Update</button>
</form>
