<?php
function generateFeedbackTable($name, $surname, $email, $phone, $text) {
    $table = '<table style="border-collapse: collapse; width: 100%; max-width: 500px;">';
    $table .= '<tr><td style="padding: 8px; border: 1px solid #ccc;">Фамилия Имя:</td><td style="padding: 8px; border: 1px solid #ccc;">' . $name . ' ' . $surname . '</td></tr>';
    $table .= '<tr><td style="padding: 8px; border: 1px solid #ccc;">Email:</td><td style="padding: 8px; border: 1px solid #ccc;">' . $email . '</td></tr>';
    $table .= '<tr><td style="padding: 8px; border: 1px solid #ccc;">Номер телефона:</td><td style="padding: 8px; border: 1px solid #ccc;">' . $phone . '</td></tr>';
    $table .= '<tr><td style="padding: 8px; border: 1px solid #ccc;">Текст:</td><td style="padding: 8px; border: 1px solid #ccc;">' . $text . '</td></tr>';
    $table .= '</table>';
    return $table;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $properties_file = 'application.properties';
    $properties = parse_ini_file($properties_file);

    function clear_data($val){
        $val = trim($val);
        $val = stripcslashes($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    $name = clear_data($_POST['name']);
    $surname = clear_data($_POST['surname']);
    $email = clear_data($_POST['email']);
    $phone = clear_data($_POST['phone']);
    $text = clear_data($_POST['message']);

    $message = '<html><body>';
    $message .= '<h1>Данные формы обратной связи:</h1>';
    $message .= generateFeedbackTable($name, $surname, $email, $phone, $text);
    $message .= '</body></html>';

    $to = $properties['to_email'];
    $subject = "Feedback";

    $headers = "From: $email \r\n";
    $headers .= "Reply-To: $email \r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";


    if (mail($to, $subject, $message, $headers)) {
        echo '<script>
            alert("Письмо успешно отправлено.");
            window.location.href = "index.html"; // Переход на index.html после закрытия alert
        </script>';
    } else {
        echo '<script>
            alert("Ошибка при отправке письма.");
            window.location.href = "index.html"; // Переход на index.html после закрытия alert
        </script>';
    }
} else {
    echo '<script>alert("Ошибка сервера.");</script>';
}
?>
