<?php
// Include necessary files
require_once 'includes/functions.php';

// Get the student ID from the URL
$studentId = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch the student's image path
$student = getStudentById($studentId);

// Handle form submission (delete confirmation)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete the student from the database
    deleteStudent($studentId);

    // Delete the image file if it exists
    if ($student['image']) {
        unlink($student['image']);
    }

    // Redirect to the home page
    header('Location: index.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<h1>Delete Student</h1>

<p>Are you sure you want to delete this student?</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $studentId; ?>">
    <button type="submit">Yes, delete</button>
    <a href="index.php">Cancel</a>
</form>

<?php include 'includes/footer.php'; ?>