<?php

// Format student name (remove spaces + capitalize)
function formatName($name) {
    return ucwords(trim($name));
}

// Validate email address
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Convert skills string to clean array
function cleanSkills($string) {
    $skills = explode(',', $string);
    return array_map('trim', $skills);
}

// Save student data into students.txt
function saveStudent($name, $email, $skillsArray) {
    $line = $name . "|" . $email . "|" . implode(',', $skillsArray) . "\n";
    file_put_contents("students.txt", $line, FILE_APPEND);
}

// Upload portfolio file with validation
function uploadPortfolioFile($file) {

    $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['size'] > $maxSize) {
        throw new Exception("File size must be less than 2MB");
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedTypes)) {
        throw new Exception("Only PDF, JPG, PNG files are allowed");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Uploads folder not found");
    }

    // Rename file
    $newFileName = "portfolio_" . time() . "." . $extension;

    if (!move_uploaded_file($file['tmp_name'], "uploads/" . $newFileName)) {
        throw new Exception("File upload failed");
    }

    return $newFileName;
}

?>
