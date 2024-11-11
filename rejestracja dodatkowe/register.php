<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (login, pass) VALUES (?, ?)");
    if ($stmt->execute([$login, $password])) {
        echo "Rejestracja zakończona sukcesem!";
    } else {
        echo "Wystąpił problem z rejestracją.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>
<body>
    <h1>Rejestracja</h1>
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" name="login" required><br>
        <label for="password">Hasło:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Zarejestruj się">
        <a href="login.php">Logowanie</a>
    </form>
</body>
</html>