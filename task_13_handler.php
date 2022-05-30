<meta charset="utf-8">
<?php
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    require_once('connect_bd.php');

    // запрос, с меткой на которую передадим переменную
    $query = "SELECT * FROM `users-13` WHERE email=:email";

    // нужно подготовить запрос, для безопасной отправки в бд
    $statement = $pdo->prepare($query);

    // в запросе, на метку передаём переменную и выполняем его
    $statement -> execute(['email' => $email]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    // данные пришли, значит такой емаил в бд есть
    
    if (!empty($result)) { // если $result - не пустой
        // записываем Ошибку в Сессию
        $_SESSION['error'] = "Этот эл. адрес уже занят другим пользователем";
        // возращаемся на главную
        // header ('location: /task_13.php');
        // прекращаем дальнейщее исполнение скрипта
        exit;

    }
    
    // если данные по запросу НЕ пришли
    // записываем в емаил в бд
    // возращаемся на главную
?>