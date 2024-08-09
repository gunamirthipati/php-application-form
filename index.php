<?php
// Include necessary files
require_once 'includes/functions.php';

// Fetch all students with their class names
$students = getAllStudents();
?>

<?php include 'includes/header.php'; ?>

<h1>Student List</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Class</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($students as $student) : ?>
        <tr>
            <td><a href="view.php?id=<?php echo $student['id']; ?>"><?php echo $student['name']; ?></a></td>
            <td><?php echo $student['email']; ?></td>
            <td><?php echo $student['class_name']; ?></td>
            <td><?php echo $student['created_at']; ?></td>
            <td>
                <a href="view.php?id=<?php echo $student['id']; ?>">View</a>
                <a href="edit.php?id=<?php echo $student['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $student['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="create.php">Create Student</a>

<?php include 'includes/footer.php'; ?>