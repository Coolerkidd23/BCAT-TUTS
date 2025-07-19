<?php
// Ensure upload folder exists
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Connect to SQLite DB (create if missing)
$db = new SQLite3('materials.db');
$db->exec('CREATE TABLE IF NOT EXISTS materials (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    filename TEXT NOT NULL,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $file = $_FILES['file'];

    if (!$title) {
        die('Title is required.');
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Error uploading file.');
    }

    // Sanitize filename and generate unique name
    $originalName = basename($file['name']);
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
    $newFilename = $safeName . '_' . time() . '.' . $ext;

    $destination = $uploadDir . '/' . $newFilename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        // Insert into DB
        $stmt = $db->prepare('INSERT INTO materials (title, filename) VALUES (:title, :filename)');
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':filename', $newFilename, SQLITE3_TEXT);
        $stmt->execute();

        header('Location: index.html');
        exit;
    } else {
        die('Failed to move uploaded file.');
    }
} else {
    die('Invalid request method.');
}
