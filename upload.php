<?php
include 'header.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $newFile = uploadPortfolioFile($_FILES['portfolio']);
        echo "<p>File uploaded successfully: $newFile</p>";
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    Select Portfolio File:
    <input type="file" name="portfolio"><br><br>
    <button type="submit">Upload File</button>
</form>

<?php include 'footer.php'; ?>
