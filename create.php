<?php
// Include necessary files
require_once 'includes/functions.php';

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
    if (!validateImage($image)) {
        $errors[] = 'Invalid image format. Only JPG and PNG are allowed.';
    }

    // If no errors, process the form
    if (empty($errors)) {
        $imagePath = uploadImage($image);
        createStudent($name, $email, $address, $class_id, $imagePath);
        header('Location: index.php');
        exit;
    }
}

// Fetch classes for the dropdown
$classes = getAllClasses();
?>

<?php include 'includes/header.php'; ?>

<h1>Create Student</h1>

<?php if (!empty($errors)) : ?>
    <div class="error-message">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea>

    <label for="class">Class:</label>
    <select id="class" name="class" required>
        <option value="">Select a class</option>
        <?php foreach ($classes as $class) : ?>
            <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="image">Image:</label>
    <input type="file" id="image" name="image" required>

    <button type="submit">Create Student</button>
</form>

<?php include 'includes/footer.php'; ?>