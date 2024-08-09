<?php
// Include necessary files
require_once 'includes/functions.php';

// Handle form submission (add new class)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_name'])) {
    $className = $_POST['class_name'];
    createClass($className);
    header('Location: classes.php');
    exit;
}

// Handle class deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_class_id'])) {
    $classId = $_POST['delete_class_id'];
    deleteClass($classId);
    header('Location: classes.php');
    exit;
}

// Fetch all classes
$classes = getAllClasses();
?>

<?php include 'includes/header.php'; ?>

<h1>Manage Classes</h1>

<h2>Add a New Class</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="class_name">Class Name:</label>
    <input type="text" id="class_name" name="class_name" required>
    <button type="submit">Add Class</button>
</form>

<h2>Class List</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Class Name</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($classes as $class) : ?>
        <tr>
            <td><?php echo $class['id']; ?></td>
            <td><?php echo $class['name']; ?></td>
            <td>
                <a href="edit_class.php?id=<?php echo $class['id']; ?>">Edit</a>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline;">
                    <input type="hidden" name="delete_class_id" value="<?php echo $class['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'includes/footer.php'; ?>