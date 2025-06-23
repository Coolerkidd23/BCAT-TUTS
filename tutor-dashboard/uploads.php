<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = htmlspecialchars($_POST['title']);

  if (isset($_FILES['material']) && $_FILES['material']['error'] == 0) {
    $uploadDir = 'uploads/';
    $filename = basename($_FILES['material']['name']);
    $uploadPath = $uploadDir . $filename;

    // Optional: Check allowed file types
    $allowedTypes = ['pdf', 'docx', 'pptx', 'mp4', 'png', 'jpg'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array(strtolower($ext), $allowedTypes)) {
      echo "File type not allowed.";
      exit;
    }

    // Move file to upload folder
    if (move_uploaded_file($_FILES['material']['tmp_name'], $uploadPath)) {
      echo "✅ Material '$title' uploaded successfully!";
    } else {
      echo "❌ Failed to move the file.";
    }
  } else {
    echo "❌ No file uploaded or upload error.";
  }
}
?>
