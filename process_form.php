<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["validationServer01"];
    $surname = $_POST["validationServer02"];
    $email = $_POST["exampleFormControlInput1"];
    $phone = $_POST["phone-input"];
    $message = $_POST["exampleFormControlTextarea1"];

    $to = $properties['to_email'];

    $subject = "Сообщение с веб-формы";

    $message_body = "Имя: $name\nФамилия: $surname\nEmail: $email\nНомер телефона: $phone\nСообщение:\n$message";

    if (mail($to, $subject, $message_body)) {
        echo "Сообщение успешно отправлено.";
    } else {
        echo "Произошла ошибка при отправке сообщения.";
    }
} else {
    echo "Доступ запрещен.";
}
?>
