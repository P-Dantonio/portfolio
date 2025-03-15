<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHMailer\Exception;

require 'vendor/autoload.php'; // Assicurati che il percorso sia corretto

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Raccolta dei dati dal form
    $firstName = htmlspecialchars($_POST['first-name']);
    $lastName = htmlspecialchars($_POST['last-name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Configurazione del server SMTP con PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurazione del server SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bagonails5@gmail.com'; // La tua email per inviare il messaggio
        $mail->Password   = 'njem wboq lvfk kgzu'; // Usa la password generata per l'app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Mittente e destinatario
        $mail->setFrom('bagonails5@gmail.com', 'Bagonails5'); // La tua email
        $mail->addAddress('bagonails5@gmail.com', 'Bagonails5'); // La tua email come destinatario

        // Contenuto dell'email
        $mail->isHTML(true);
        $mail->Subject = "Nuovo messaggio da: $firstName $lastName";
        $mail->Body    = "<h1>Messaggio di $firstName $lastName</h1>
                          <p>Email: $email</p>
                          <p>Telefono: $phone</p>
                          <p>Messaggio: $message</p>";
        $mail->AltBody = "Messaggio di $firstName $lastName\nEmail: $email\nTelefono: $phone\nMessaggio: $message";

        // Invia l'email
        if ($mail->send()) {
            $message = "Messaggio inviato con successo!";
            $message_type = "success"; // Successo
        } else {
            $message = "Errore nell'invio del messaggio.";
            $message_type = "error"; // Errore
        }
    } catch (Exception $e) {
        $message = "Errore: {$mail->ErrorInfo}";
        $message_type = "error"; // Errore
    }
}
?>


<?php if ($message): ?>
  <div id="message" class="modal <?php echo $message_type; ?>">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p><?php echo $message; ?></p>
    </div>
  </div>
<?php endif; ?>
