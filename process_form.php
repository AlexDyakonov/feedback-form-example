<?php

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

    $message = 'Фамилия Имя: ' . $name." " .  $surname."\n" . 'Email: ' . $email."\n" . 'Номер телефона: ' . $phone."\n" . 'Текст: ' . $text;

    $to = "shram.monolit@mail.ru";
    $subject = "Feedback";

    $headers = "From: site@example.com\r\n";
    $headers .= "Reply-To: site@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo '<script>alert("Письмо успешно отправлено.");</script>';
      } else {
        echo '<script>alert("Ошибка при отправке письма.");</script>';
      }
} else {
    echo '<script>alert("Ошибка сервера.");</script>';
}
?>