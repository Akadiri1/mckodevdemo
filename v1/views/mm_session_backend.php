<?php
// ── Mike Mahony Strategy Session Booking Backend ────────────────────────────
// Saves booking to read_mm_sessions + sends 2 emails via PHPMailer:
//   1. Confirmation to the person who booked
//   2. Full booking notification to Mike (admin)
//
// SMTP config from settings_mm_info — editable in ADMC admin panel.

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
    die;
}

// ── SMTP settings — already set globally by index.php from settings_website_info
$smtpFrom     = $site_email_from             ?? '';
$smtpHost     = $site_email_smtp_host        ?? 'smtp.gmail.com';
$smtpSecure   = $site_email_smtp_secure_type ?? 'tls';
$smtpPort     = (int)($site_email_smtp_port  ?? 587);
$smtpPassword = $site_email_password         ?? '';
$adminEmail   = $site_email                  ?? $smtpFrom;
$siteName     = $site_name                   ?? 'Mike Mahony';
$bookUrl      = $websiteInfo[0]['input_book_session_url'] ?? 'https://GetYourVirtualCTO.com/StrategySession';

// ── Parse + sanitise input ────────────────────────────────────────────────────
$raw  = file_get_contents('php://input');
$data = json_decode($raw, true) ?: [];

$hs = fn($v) => htmlspecialchars(trim($v ?? ''), ENT_QUOTES, 'UTF-8');

$firstName = $hs($data['first_name'] ?? '');
$lastName  = $hs($data['last_name']  ?? '');
$email     = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$company   = $hs($data['company']   ?? '');
$role      = $hs($data['role']      ?? '');
$phone     = $hs($data['phone']     ?? '');
$service   = $hs($data['service']   ?? '');
$revenue   = $hs($data['revenue']   ?? '');
$challenge = $hs($data['challenge'] ?? '');
$heard     = $hs($data['heard']     ?? '');
$fullName  = trim("{$firstName} {$lastName}");

if (empty($firstName) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($service) || empty($challenge)) {
    echo json_encode(['success' => false, 'error' => 'Required fields are missing.']);
    die;
}

// ── Save to database ──────────────────────────────────────────────────────────
insertSafe($conn, 'read_mm_sessions', [
    'hash_id'          => uniqid('sess_', true),
    'input_first_name' => $firstName,
    'input_last_name'  => $lastName,
    'input_email'      => $email,
    'input_company'    => $company,
    'input_role'       => $role,
    'input_phone'      => $phone,
    'input_service'    => $service,
    'input_revenue'    => $revenue,
    'input_heard'      => $heard,
    'text_challenge'   => $challenge,
    'visibility'       => 'show',
    'date_created'     => date('Y-m-d'),
    'time_created'     => date('H:i:s'),
    'created_by'       => 'visitor',
]);

// ── Skip email if SMTP not configured ────────────────────────────────────────
if (empty($smtpFrom) || empty($smtpPassword)) {
    echo json_encode(['success' => true, 'note' => 'Saved. Configure SMTP in ADMC to enable email notifications.']);
    die;
}

// ── Service label map ─────────────────────────────────────────────────────────
$serviceLabels = [
    'netsuite'  => 'NetSuite Reporting Chaos',
    'dcat'      => 'Team Bottlenecks / DCAT Method',
    'cto'       => 'Fractional CTO Services',
    'strategy'  => 'General Technology Strategy',
    'other'     => 'Other / Not Sure Yet',
];
$serviceLabel = $serviceLabels[$service] ?? $service;

$revenueLabels = [
    'under5' => 'Under $5M', '5-10' => '$5M – $10M',
    '10-20'  => '$10M – $20M', '20-50' => '$20M – $50M', '50plus' => '$50M+',
];
$revenueLabel = $revenueLabels[$revenue] ?? ($revenue ?: '—');

$result = [];

try {
    require APP_PATH . '/phpm/PHPMailerAutoload.php';

    // ── 1. Confirmation to visitor ───────────────────────────────────────────
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpFrom;
    $mail->Password   = $smtpPassword;
    $mail->SMTPSecure = $smtpSecure;
    $mail->Port       = $smtpPort;
    $mail->setFrom($smtpFrom, $siteName);
    $mail->addAddress($email, $fullName);
    $mail->addReplyTo($adminEmail, $siteName);
    $mail->isHTML(true);
    $mail->Subject = "Strategy Session Request Received — {$siteName}";
    $mail->Body = "
    <div style='font-family:Inter,Arial,sans-serif;max-width:600px;margin:0 auto;background:#050a14;color:#f9fafb;padding:40px 32px;border-radius:12px;'>
      <div style='margin-bottom:28px;'>
        <span style='font-size:22px;font-weight:800;color:#FFBF00;'>{$siteName}</span>
        <span style='font-size:13px;color:#9ca3af;margin-left:8px;'>Fractional CTO</span>
      </div>
      <h2 style='font-size:20px;margin-bottom:16px;'>Hey {$firstName}, your session request is in!</h2>
      <p style='color:#d1d5db;line-height:1.8;margin-bottom:20px;'>
        Mike's team will review your request and confirm a time within <strong style='color:#FFBF00;'>1 business day</strong>.
        You'll receive a calendar invite once confirmed.
      </p>
      <div style='background:#0a1128;border:1px solid rgba(255,191,0,0.2);border-radius:8px;padding:20px 24px;margin-bottom:24px;'>
        <p style='font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;margin:0 0 12px;'>Your booking summary</p>
        <table style='width:100%;border-collapse:collapse;'>
          <tr>
            <td style='padding:6px 0;color:#9ca3af;font-size:13px;width:40%;'>Topic</td>
            <td style='padding:6px 0;color:#f9fafb;font-size:13px;'>{$serviceLabel}</td>
          </tr>
          <tr>
            <td style='padding:6px 0;color:#9ca3af;font-size:13px;'>Company</td>
            <td style='padding:6px 0;color:#f9fafb;font-size:13px;'>" . ($company ?: '—') . "</td>
          </tr>
        </table>
      </div>
      <p style='color:#d1d5db;line-height:1.8;margin-bottom:24px;'>
        Want to book a time right now? You can pick a slot directly on Mike's calendar:
      </p>
      <a href='{$bookUrl}' style='display:inline-block;padding:12px 28px;background:#FFBF00;color:#000;font-weight:700;border-radius:999px;text-decoration:none;font-size:14px;'>
        Open Booking Calendar
      </a>
      <hr style='border:none;border-top:1px solid rgba(255,255,255,0.1);margin:28px 0;'>
      <p style='font-size:12px;color:#6b7280;margin:0;'>
        &copy; " . date('Y') . " {$siteName} &middot; North Las Vegas, Nevada
      </p>
    </div>";
    $mail->AltBody = "Hey {$firstName}, your strategy session request has been received. Mike will confirm within 1 business day.";

    // ── 2. Full notification to admin ────────────────────────────────────────
    $mail2 = new PHPMailer;
    $mail2->isSMTP();
    $mail2->Host       = $smtpHost;
    $mail2->SMTPAuth   = true;
    $mail2->Username   = $smtpFrom;
    $mail2->Password   = $smtpPassword;
    $mail2->SMTPSecure = $smtpSecure;
    $mail2->Port       = $smtpPort;
    $mail2->setFrom($smtpFrom, $siteName);
    $mail2->addAddress($adminEmail, $siteName);
    $mail2->addReplyTo($email, $fullName);
    $mail2->isHTML(true);
    $mail2->Subject = "New Strategy Session Request — {$fullName}";

    $heardLabel = ucfirst($heard ?: 'Not specified');
    $phoneShow  = !empty($phone) ? "<a href='tel:{$phone}' style='color:#FFBF00;'>{$phone}</a>" : '—';

    $mail2->Body = "
    <div style='font-family:Inter,Arial,sans-serif;max-width:600px;margin:0 auto;background:#050a14;color:#f9fafb;padding:40px 32px;border-radius:12px;'>
      <div style='margin-bottom:28px;border-bottom:2px solid #FFBF00;padding-bottom:20px;'>
        <span style='font-size:22px;font-weight:800;color:#FFBF00;'>New Strategy Session Request</span>
      </div>
      <table style='width:100%;border-collapse:collapse;margin-bottom:24px;'>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;width:35%;border-bottom:1px solid rgba(255,255,255,0.08);'>Name</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>{$fullName}</td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Email</td>
          <td style='padding:10px 14px;border-bottom:1px solid rgba(255,255,255,0.08);'>
            <a href='mailto:{$email}' style='color:#FFBF00;'>{$email}</a>
          </td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Phone</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>{$phoneShow}</td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Company</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>" . ($company ?: '—') . "</td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Role</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>" . ($role ?: '—') . "</td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Revenue</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>{$revenueLabel}</td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Topic</td>
          <td style='padding:10px 14px;border-bottom:1px solid rgba(255,255,255,0.08);'>
            <span style='background:#FFBF00;color:#000;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:700;'>{$serviceLabel}</span>
          </td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:12px;text-transform:uppercase;letter-spacing:0.8px;'>Heard via</td>
          <td style='padding:10px 14px;color:#f9fafb;'>{$heardLabel}</td>
        </tr>
      </table>
      <div style='background:#0a1128;border:1px solid rgba(255,191,0,0.2);border-radius:8px;padding:20px 24px;margin-bottom:28px;'>
        <p style='font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;margin:0 0 10px;'>Their Biggest Challenge</p>
        <p style='color:#d1d5db;line-height:1.8;margin:0;'>" . nl2br($challenge) . "</p>
      </div>
      <a href='mailto:{$email}' style='display:inline-block;padding:12px 28px;background:#FFBF00;color:#000;font-weight:700;border-radius:999px;text-decoration:none;font-size:14px;margin-right:12px;'>
        Reply to {$firstName}
      </a>
      <a href='{$bookUrl}' style='display:inline-block;padding:12px 28px;background:transparent;color:#FFBF00;font-weight:700;border-radius:999px;text-decoration:none;font-size:14px;border:1px solid rgba(255,191,0,0.4);'>
        Open Your Calendar
      </a>
      <hr style='border:none;border-top:1px solid rgba(255,255,255,0.1);margin:28px 0;'>
      <p style='font-size:12px;color:#6b7280;margin:0;'>Submitted via strategy session form &middot; {$siteName}</p>
    </div>";
    $mail2->AltBody = "New session request from {$fullName} ({$email}). Topic: {$serviceLabel}. Challenge: {$challenge}";

    if ($mail->send() && $mail2->send()) {
        $result['success'] = true;
    } else {
        $result['success'] = false;
        $result['error']   = 'Mail send failed. Booking was saved — Mike will follow up.';
    }

} catch (Exception $e) {
    $result['success'] = false;
    $result['error']   = 'Mail error. Booking was saved — Mike will follow up.';
    // error_log($e->getMessage());
}

echo json_encode($result);
