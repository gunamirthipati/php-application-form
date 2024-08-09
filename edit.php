<?php
// Include necessary files
require_once 'includes/functions.php';

// Get the student ID from the URL
$studentId = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch the student and class details
$student = getStudentById($studentId);
$classes = getAllClasses();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class'];
    $image = $_FILES['image'];

    // Validate input
    $errors = [];
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (!empty($image['name']) && !validateImage($image)) {
        $errors[] = 'Invalid image format. Only JPG and PNG are allowed.';
    }

    // If no errors, process the form
    if (empty($errors)) {
        // Upload the image if a new one is provided
        $imagePath = $student['image'];
        if (!empty($image['name'])) {
            // Delete the old image file if it exists
            if (file_exists($student['image'])) {
                unlink($student['image']);
            }
            $imagePath = uploadImage($image);
        }

        // Update the student in the database
        updateStudent($studentId, $name, $email, $address, $class_id, $imagePath);
        header('Location: index.php');
        exit;
    }
}
?>

<?php include 'includes/header.php'; ?>

<h1>Edit Student</h1>

<?php if (!empty($errors)) : ?>
    <div class="error-message">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $studentId; ?>" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required>

    <label for="address">Address:</label>
    <textarea id="address" name="address" required>