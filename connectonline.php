<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Collect form data
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$PlantName = $_POST['PlantName'];
$Price = $_POST['Price'];
$Adress = $_POST['Adress'];
$Contact = $_POST['Contact'];
$Upi = $_POST['Upi'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'webherbal');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO online(Name, Email, PlantName, Price, Adress, Contact, Upi) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssii", $Name, $Email, $PlantName, $Price, $Adress, $Contact, $Upi);
    $execval = $stmt->execute();

    if ($execval) {
        // Send email confirmation using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP(); // Use SMTP
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'pranjals0865@gmail.com'; // Your Gmail address
            $mail->Password = 'xljvzxbhsznutncm'; // Your Gmail password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('pranjals865@gmail.com', 'Herbs&Herbal'); // Sender
            $mail->addAddress($Email, $Name); // Recipient

            // Email content
            $mail->isHTML(false); // Set email format to plain text
            $mail->Subject = 'Online Order Placed Successfully';
            $mail->Body = "Dear $Name,\n\n"
                . "Thank you for placing an online order with Herbs&Herbal.\n\n"
                . "Your order details are as follows:\n"
                . "Plant Name: $PlantName\n"
                . "Price: $Price\n"
                . "Address: $Adress\n"
                . "Contact: $Contact\n"
                . "UPI: $Upi\n\n"
                . "We will process your order shortly.\n\n"
                . "Best regards,\nHerbs&Herbal Team";

            // Send the email
            $mail->send();
            echo "Online order placed successfully! A confirmation email has been sent to $Email.";
        } catch (Exception $e) {
            echo "Online order placed successfully, but the confirmation email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to place the online order. Please try again.";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>