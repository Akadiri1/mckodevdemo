<?php
// ── Mike Mahony Contact Form Backend ────────────────────────────────────────
// Saves message to read_mm_messages + sends 2 emails via PHPMailer:
//   1. Auto-reply confirmation to the visitor
//   2. Notification to Mike (site admin email)
//
// SMTP config is pulled from settings_mm_info (editable in ADMC):
//   input_email_from         → your Gmail address
//   input_email_password     → your Gmail App Password
//   input_email_smtp_host    → smtp.gmail.com
//   input_email_smtp_port    → 587
//   input_email_smtp_secure_type → tls

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
    die;
}

// ── SMTP settings — already set globally by index.php from settings_website_info
// $site_email_from, $site_email_smtp_host, $site_email_smtp_secure_type,
// $site_email_smtp_port, $site_email_password, $site_email, $site_name
$smtpFrom     = $site_email_from             ?? '';
$smtpHost     = $site_email_smtp_host        ?? 'smtp.gmail.com';
$smtpSecure   = $site_email_smtp_secure_type ?? 'tls';
$smtpPort     = (int)($site_email_smtp_port  ?? 587);
$smtpPassword = $site_email_password         ?? '';
$adminEmail   = $site_email                  ?? $smtpFrom;
$siteName     = $site_name                   ?? 'Mike Mahony';

// ── Parse + sanitise input ────────────────────────────────────────────────────
$raw  = file_get_contents('php://input');
$data = json_decode($raw, true) ?: [];

$name    = htmlspecialchars(trim($data['name']    ?? ''), ENT_QUOTES, 'UTF-8');
$email   = filter_var(trim($data['email']   ?? ''), FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars(trim($data['subject'] ?? ''), ENT_QUOTES, 'UTF-8');
$service = htmlspecialchars(trim($data['service'] ?? ''), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(trim($data['message'] ?? ''), ENT_QUOTES, 'UTF-8');

if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
    echo json_encode(['success' => false, 'error' => 'Name, valid email, and message are required.']);
    die;
}

// ── Save to database ──────────────────────────────────────────────────────────
insertSafe($conn, 'read_mm_messages', [
    'hash_id'       => uniqid('msg_', true),
    'input_name'    => $name,
    'input_email'   => $email,
    'input_subject' => $subject,
    'input_service' => $service,
    'text_message'  => $message,
    'visibility'    => 'show',
    'date_created'  => date('Y-m-d'),
    'time_created'  => date('H:i:s'),
    'created_by'    => 'visitor',
]);

// ── Send emails via PHPMailer ─────────────────────────────────────────────────
// If SMTP is not configured yet, skip email silently (DB save still happened)
if (empty($smtpFrom) || empty($smtpPassword)) {
    echo json_encode(['success' => true, 'note' => 'Saved. Configure SMTP in ADMC to enable email notifications.']);
    die;
}

$result = [];

try {
    require APP_PATH . '/phpm/PHPMailerAutoload.php';

    // ── 1. Auto-reply to the visitor ────────────────────────────────────────
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpFrom;
    $mail->Password   = $smtpPassword;
    $mail->SMTPSecure = $smtpSecure;
    $mail->Port       = $smtpPort;
    $mail->setFrom($smtpFrom, $siteName);
    $mail->addAddress($email, $name);
    $mail->addReplyTo($adminEmail, $siteName);
    $mail->isHTML(true);
    $mail->Subject = "Message Received — {$siteName}";
    $mail->Body = "
    <div style='font-family:Inter,Arial,sans-serif;max-width:600px;margin:0 auto;background:#050a14;color:#f9fafb;padding:40px 32px;border-radius:12px;'>
      <div style='margin-bottom:28px;'>
        <span style='font-size:22px;font-weight:800;color:#FFBF00;'>{$siteName}</span>
        <span style='font-size:13px;color:#9ca3af;margin-left:8px;'>Fractional CTO</span>
      </div>
      <h2 style='font-size:20px;margin-bottom:16px;'>Hey {$name}, message received!</h2>
      <p style='color:#d1d5db;line-height:1.8;margin-bottom:24px;'>
        Thanks for reaching out. Mike reads every message personally and will get back to you within 1 business day.
      </p>
      <div style='background:#0a1128;border:1px solid rgba(255,191,0,0.2);border-radius:8px;padding:20px 24px;margin-bottom:28px;'>
        <p style='font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;margin-bottom:8px;'>Your message</p>
        <p style='color:#d1d5db;line-height:1.7;margin:0;'>" . nl2br($message) . "</p>
      </div>
      <p style='color:#9ca3af;font-size:14px;line-height:1.7;'>
        In the meantime, connect on
        <a href='https://www.linkedin.com/in/michaeljmahony/' style='color:#FFBF00;'>LinkedIn</a>
        or listen to the
        <a href='https://gtle.show' style='color:#FFBF00;'>GTLE Podcast</a>.
      </p>
      <hr style='border:none;border-top:1px solid rgba(255,255,255,0.1);margin:28px 0;'>
      <p style='font-size:12px;color:#6b7280;margin:0;'>
        &copy; " . date('Y') . " {$siteName} &middot; North Las Vegas, Nevada
      </p>
    </div>";
    $mail->AltBody = "Hey {$name}, thanks for reaching out. Mike will reply within 1 business day.";

    // ── 2. Notification to admin (Mike) ─────────────────────────────────────
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
    $mail2->addReplyTo($email, $name);
    $mail2->isHTML(true);
    $mail2->Subject = "New Contact Message — {$name}";

    $subjectLine = !empty($subject) ? $subject : '(No subject)';
    $serviceLine = !empty($service) ? $service : '—';

    $mail2->Body = "
    <div style='font-family:Inter,Arial,sans-serif;max-width:600px;margin:0 auto;background:#050a14;color:#f9fafb;padding:40px 32px;border-radius:12px;'>
      <div style='margin-bottom:28px;border-bottom:2px solid #FFBF00;padding-bottom:20px;'>
        <span style='font-size:22px;font-weight:800;color:#FFBF00;'>New Contact Message</span>
      </div>
      <table style='width:100%;border-collapse:collapse;margin-bottom:24px;'>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:13px;text-transform:uppercase;letter-spacing:0.8px;width:35%;border-bottom:1px solid rgba(255,255,255,0.08);'>Name</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>{$name}</td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:13px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Email</td>
          <td style='padding:10px 14px;border-bottom:1px solid rgba(255,255,255,0.08);'>
            <a href='mailto:{$email}' style='color:#FFBF00;'>{$email}</a>
          </td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:13px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Subject</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>{$subjectLine}</td>
        </tr>
        <tr>
          <td style='padding:10px 14px;font-weight:700;color:#9ca3af;font-size:13px;text-transform:uppercase;letter-spacing:0.8px;border-bottom:1px solid rgba(255,255,255,0.08);'>Topic</td>
          <td style='padding:10px 14px;color:#f9fafb;border-bottom:1px solid rgba(255,255,255,0.08);'>{$serviceLine}</td>
        </tr>
      </table>
      <div style='background:#0a1128;border:1px solid rgba(255,191,0,0.2);border-radius:8px;padding:20px 24px;margin-bottom:28px;'>
        <p style='font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#9ca3af;margin:0 0 10px;'>Message</p>
        <p style='color:#d1d5db;line-height:1.8;margin:0;'>" . nl2br($message) . "</p>
      </div>
      <a href='mailto:{$email}' style='display:inline-block;padding:12px 28px;background:#FFBF00;color:#000;font-weight:700;border-radius:999px;text-decoration:none;font-size:14px;'>
        Reply to {$name}
      </a>
      <hr style='border:none;border-top:1px solid rgba(255,255,255,0.1);margin:28px 0;'>
      <p style='font-size:12px;color:#6b7280;margin:0;'>Sent from your website contact form &middot; {$siteName}</p>
    </div>";
    $mail2->AltBody = "New contact from {$name} ({$email}): {$message}";

    if ($mail->send() && $mail2->send()) {
        $result['success'] = true;
    } else {
        $result['success'] = false;
        $result['error']   = 'Mail send failed. Please try again.';
    }

} catch (Exception $e) {
    $result['success'] = false;
    $result['error']   = 'Mail error. Your message was saved — Mike will follow up.';
    // Log for debug: error_log($e->getMessage());
}

echo json_encode($result);
