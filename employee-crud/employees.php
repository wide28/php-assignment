<?php include "protect.php"; ?>
<?php include "db.php"; ?>

<h3>Welcome, <?php echo $_SESSION['username']; ?></h3>
<a href="logout.php">Logout</a>

<h2>Add Employee</h2>
<form method="POST" action="create.php">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <input type="text" name="position" placeholder="Position" required>
    <button type="submit">Save</button>
</form>

<h2>Employees List</h2>

<?php
$result = $conn->query("SELECT * FROM employees");
while ($row = $result->fetch_assoc()):
?>
    <p>
        <?php echo $row['name']; ?> — <?php echo $row['email']; ?>
        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
    </p>
<?php endwhile; ?>
