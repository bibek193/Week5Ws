<?php
include 'header.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skills = $_POST['skills'];

        if (empty($name) || empty($email) || empty($skills)) {
            throw new Exception("All fields are required");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email address");
        }

        $skillsArray = cleanSkills($skills);
        saveStudent($name, $email, $skillsArray);

        echo "<p>Student information saved successfully!</p>";
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<form method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Skills (comma separated):<br>
    <input type="text" name="skills"><br><br>
    <button type="submit">Save Student</button>
</form>

<?php include 'footer.php'; ?>
