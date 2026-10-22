<?php
// Test PHP upload limits
echo "<h2>PHP Upload Configuration Test</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Setting</th><th>Current Value</th><th>Required</th><th>Status</th></tr>";

$settings = [
    'upload_max_filesize' => ['current' => ini_get('upload_max_filesize'), 'required' => '10M'],
    'post_max_size' => ['current' => ini_get('post_max_size'), 'required' => '12M'],
    'max_execution_time' => ['current' => ini_get('max_execution_time'), 'required' => '300'],
    'memory_limit' => ['current' => ini_get('memory_limit'), 'required' => '256M']
];

foreach ($settings as $setting => $data) {
    $current = $data['current'];
    $required = $data['required'];
    $status = ($current >= $required) ? '✅ OK' : '❌ Too Low';
    echo "<tr><td>{$setting}</td><td>{$current}</td><td>{$required}</td><td>{$status}</td></tr>";
}

echo "</table>";

echo "<h3>File Upload Test</h3>";
echo "<form method='post' enctype='multipart/form-data'>";
echo "<input type='file' name='test_file' accept='.mp4'><br><br>";
echo "<input type='submit' value='Test Upload' name='test_upload'>";
echo "</form>";

if (isset($_POST['test_upload']) && isset($_FILES['test_file'])) {
    $file = $_FILES['test_file'];
    echo "<h4>Upload Test Results:</h4>";
    echo "File name: " . $file['name'] . "<br>";
    echo "File size: " . number_format($file['size'] / 1024 / 1024, 2) . " MB<br>";
    echo "File type: " . $file['type'] . "<br>";
    echo "Upload error: " . $file['error'] . "<br>";
    
    if ($file['error'] === 0) {
        echo "<span style='color: green;'>✅ Upload successful!</span>";
    } else {
        echo "<span style='color: red;'>❌ Upload failed with error code: " . $file['error'] . "</span>";
    }
}
?>
