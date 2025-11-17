<?php 
include "protected.php"; // same
include "db.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

    <!-- Modern UI Design Only (NO PHP changes) -->
    <style>
        body {
            font-family: Poppins, Arial, sans-serif;
            background: #eef1f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #004aad;
            color: white;
            padding: 18px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }

        header h3 {
            margin: 0;
        }

        .logout-btn {
            background: #ff4d4d;
            padding: 8px 14px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .logout-btn:hover {
            background: #d90000;
        }

        h2 {
            margin-top: 30px;
            color: #333;
        }

        /* Form Styling */
        form {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #bbb;
            border-radius: 6px;
            font-size: 15px;
        }

        form button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            border: none;
            color: white;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }
        form button:hover {
            background: #1e7e34;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }

        th {
            background: #004aad;
            color: white;
            padding: 14px;
            font-size: 15px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f7faff;
        }

        .action-btn {
            padding: 6px 10px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .edit-btn { background: #ff9800; }
        .edit-btn:hover { background: #c77700; }

        .delete-btn { background: #e60000; }
        .delete-btn:hover { background: #990000; }

    </style>
</head>
<body>

<div class="container">

<header>
    <h3>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></h3>
    <a class="logout-btn" href="logout.php">Logout</a>
</header>

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

</div>

</body>
</html>
