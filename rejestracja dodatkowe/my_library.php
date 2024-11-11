<?php
include 'conn.php';

// czy jestem zalogowany
if (!isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_COOKIE['user_id'];

// ciagne gry 
$stmt = $pdo->prepare("SELECT g.name FROM game_library gl JOIN games g ON gl.game_id = g.id WHERE gl.user_id IN (SELECT id FROM users WHERE login = ?)");
$stmt->execute([$userId]);
$games = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moja Biblioteka Gier</title>
</head>
<body>
    <h1>Moja Biblioteka Gier</h1>

    <?php if ($games): ?>
        <ul>
            <?php foreach ($games as $game): ?>
                <li><?php echo htmlspecialchars($game['name']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nie masz jeszcze żadnych gier w bibliotece.</p>
    <?php endif; ?>

    <p><a href="buy_game.php">Kup nowe gry</a></p>

</body>
</html>
