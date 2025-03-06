<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer-master/src/Exception.php'; // Correct path
require 'PHPMailer-master/src/PHPMailer.php'; // Correct path
require 'PHPMailer-master/src/SMTP.php'; // Correct path


// Collect form data
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$PlantName = $_POST['PlantName'];
$Price = $_POST['Price'];
$Adress = $_POST['Adress'];
$Contact = $_POST['Contact'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'webherbal');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO product(Name, Email, PlantName, Price, Adress, Contact) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $Name, $Email, $PlantName, $Price, $Adress, $Contact);
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
            $mail->setFrom('pranjals0865@gmail.com', 'Herbs&Herbal'); // Sender
            $mail->addAddress($Email, $Name); // Recipient

            // Email content
            $mail->isHTML(false); // Set email format to plain text
            $mail->Subject = 'Order Placed Successfully';
            $mail->Body = "Dear $Name,\n\n"
                . "Thank you for placing an order with Herbs&Herbal.\n\n"
                . "Your order details are as follows:\n"
                . "Plant Name: $PlantName\n"
                . "Price: $Price\n"
                . "Address: $Adress\n"
                . "Contact: $Contact\n\n"
                . "We will process your order shortly.\n\n"
                . "Best regards,\nHerbs&Herbal Team";

            // Send the email
            $mail->send();
            echo "Order placed successfully! A confirmation email has been sent to $Email.";
        } catch (Exception $e) {
            echo "Order placed successfully, but the confirmation email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to place the order. Please try again.";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>