<?php
include 'conn.php';

// czy jest zalgoowany 
if (!isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_COOKIE['user_id'];

// dodawnie gry jesli formularz jest git wyslany
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['game_id'])) {
    $gameId = $_POST['game_id'];

    // jakie gry sa tam
    $stmt = $pdo->prepare("SELECT * FROM game_library WHERE user_id IN (SELECT id FROM users WHERE login = ?) AND game_id = ?");
    $stmt->execute([$userId, $gameId]);
    
    if ($stmt->rowCount() == 0) {
        // dodawanie gry do biblio
        $stmt = $pdo->prepare("INSERT INTO game_library (user_id, game_id) VALUES ((SELECT id FROM users WHERE login = ? LIMIT 1), ?)");
        if ($stmt->execute([$userId, $gameId])) {
            echo "Gra została dodana do Twojej biblioteki!";
        } else {
            echo "Wystąpił problem z dodaniem gry.";
        }
    } else {
        echo "Już posiadasz tę grę w swojej bibliotece.";
    }
}

// jakie gry sa dostepne
$stmt = $pdo->query("SELECT * FROM games");
$games = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zakup Gier</title>
</head>
<body>
    <h1>Dostępne Gry</h1>
    
    <ul>
        <?php foreach ($games as $game): ?>
            <li>
                <?php echo htmlspecialchars($game['name']); ?>
                <form method="post" action="">
                    <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
                    <input type="submit" value="Kup">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <p><a href="my_library.php">Moja Biblioteka Gier</a></p>

</body>
</html>
