<?php
// Includi PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carica i file di PHPMailer
require 'vendor/autoload.php'; // Assicurati che il percorso a vendor/autoload.php sia corretto

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Raccolta dati del form
    $firstName = htmlspecialchars($_POST['first-name']);
    $lastName = htmlspecialchars($_POST['last-name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);
    
    // Crea una nuova istanza di PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configurazione server SMTP per Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Server SMTP di Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'bagonails5@gmail.com'; // Il tuo indirizzo Gmail
        $mail->Password = 'GeraltOfRivia1.'; // La tua password di app o la tua password Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Abilita TLS
        $mail->Port = 587; // Porta per la connessione SMTP

        // Destinatari
        $mail->setFrom($email, "$firstName $lastName");
        $mail->addAddress('bagonails5@gmail.com'); // Il tuo indirizzo email di destinazione
        
        // Contenuto dell'email
        $mail->isHTML(false); // Imposta come testo semplice
        $mail->Subject = "Nuovo messaggio dal contatto";
        $mail->Body    = "
            Nome: $firstName $lastName\n
            Email: $email\n
            Numero di telefono: $phone\n
            Messaggio:\n$message
        ";

        // Invia l'email
        $mail->send();
        echo "Messaggio inviato con successo!";
    } catch (Exception $e) {
        echo "C'è stato un errore nell'invio del messaggio. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Metodo non supportato.";
}
?>
