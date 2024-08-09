<?php
// Include necessary files
require_once 'includes/functions.php';

// Get the student ID from the URL
$studentId = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch the student and class details
$student = getStudentById($studentId);
?>

<?php include 'includes/header.php'; ?>

<h1>Student Details</h1>

<div class="student-details">
    <img src="<?php echo $student['image']; ?>" alt="<?php echo $student['name']; ?>" class="student-image">
    <h2><?php echo $student['name']; ?></h2>
    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
    <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
    <p><strong>Class:</strong> <?php echo $student['class_name']; ?></p>
    <p><strong>Created:</strong> <?php echo $student['created_at']; ?></p>
</div>

<a href="index.php" class="back-link">Back to Student List</a>

<?php include 'includes/footer.php'; ?>