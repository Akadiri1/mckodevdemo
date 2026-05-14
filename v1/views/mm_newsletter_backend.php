<?php
header('Content-Type: application/json');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false]);
    die;
}

$new = [
    'hash_id'      => rand(10000, 99999) . rand(10000, 99999),
    'input_email'  => $email,
    'visibility'   => 'show',
    'date_created' => date('Y-m-d'),
    'time_created' => date('H:i:s'),
    'created_by'   => 'visitor',
];
insertSafe($conn, 'read_mm_newsletter', $new);

echo json_encode(['success' => true]);
