<?php
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get the raw POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Prepare data
$excelData = [
    'Name' => $data['name'],
    'Email' => $data['email'],
    'Contact' => $data['contact'],
    'Company' => $data['company'],
    'Interests' => $data['interests'] ?? 'None selected',
    'Registration Date' => date('Y-m-d H:i:s')
];

// Define CSV file path
$csvFile = 'registrations.csv';

// Write to CSV
$csvHeader = !file_exists($csvFile);
$fp = fopen($csvFile, 'a');

if ($csvHeader) {
    fputcsv($fp, array_keys($excelData));
}
fputcsv($fp, $excelData);
fclose($fp);

echo json_encode(['success' => true]);
?>