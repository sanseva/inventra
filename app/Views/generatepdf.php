<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
 
// Fetch record (same as before)

// For demo:
$customer = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '9999999999'
];

$dompdf = new Dompdf();
$html = "
    <h1>Customer Details</h1>
    <p><strong>Name:</strong> {$customer['name']}</p>
    <p><strong>Email:</strong> {$customer['email']}</p>
    <p><strong>Phone:</strong> {$customer['phone']}</p>
";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Stream it directly
$dompdf->stream("customer_details.pdf", ["Attachment" => false]); // false = open in browser
exit;
?>