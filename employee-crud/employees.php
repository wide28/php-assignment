<?php 
include "protected.php";   // FIXED include path
include "db.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

    <!-- Internal CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h3 {
            color: #333;
        }

        .logout-btn {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 6px 10px;
            border-radius: 4px;
        }

        .logout-btn:hover {
            background: #0056b3;
        }

        form {
            background: white;
            padding: 20px;
            width: 350px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
            margin-bottom: 30px;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        form button:hover {
            background: darkgreen;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px #ccc;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #007bff;
            color: white;
        }

        .action-btn {
            padding: 5px 8px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
        }

        .edit-btn {
            background: orange;
        }

        .delete-btn {
            background: red;
        }

        .edit-btn:hover { background: darkorange; }
        .delete-btn:hover { background: darkred; }

    </style>
</head>
<body>

<h3>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></h3>
<a class="logout-btn" href="logout.php">Logout</a>

<h2>Add Employee</h2>

<form method="POST" action="create.php">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <input type="text" name="position" placeholder="Position" required>
    <button type="submit">Save</button>
</form>

<h2>Employees List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Position</th>
        <th>Actions</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM employees");
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['position']; ?></td>
        <td>
            <a class="action-btn edit-btn" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a class="action-btn delete-btn" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>



