<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT pass FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $hashedPassword = $stmt->fetchColumn();

    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        setcookie("user_id", $login, time() + (86400 * 30), "/");
        header("Location: my_library.php");
        exit();
    } else {
        echo "Niepoprawny login lub hasło.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>
    <h1>Logowanie</h1>
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" name="login" required><br>
        <label for="password">Hasło:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Zaloguj się">
    </form>
</body>
</html>