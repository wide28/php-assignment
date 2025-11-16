<?php
include "protected.php";
include "db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ERROR: Employee ID is missing.");
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $conn->prepare("UPDATE employees 
                            SET name=?, email=?, phone=?, position=? 
                            WHERE id=?");

    $stmt->bind_param("ssssi", 
        $_POST['name'], 
        $_POST['email'], 
        $_POST['phone'], 
        $_POST['position'], 
        $id
    );

    $stmt->execute();
    header("Location: employees.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$emp = $stmt->get_result()->fetch_assoc();
if (!$emp) {
    die("ERROR: Employee not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>

    <!-- Beautiful CSS styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 450px;
            margin: 60px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 16px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Employee</h2>

    <form method="POST">
        <input type="text" name="name" value="<?php echo $emp['name']; ?>" required>
        <input type="email" name="email" value="<?php echo $emp['email']; ?>" required>
        <input type="text" name="phone" value="<?php echo $emp['phone']; ?>" required>
        <input type="text" name="position" value="<?php echo $emp['position']; ?>" required>

        <button type="submit">Update</button>

        <a class="back-link" href="employees.php">← Back to Employee List</a>
    </form>
</div>

</body>
</html>
