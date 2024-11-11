<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>BIBLIOTEKA</h1>
<div class="parent">
<div class="ksiazki"> Dostępne Książki
<?php
        $sql = "SELECT tytul, autor FROM ksiazki";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["tytul"] . " - " . $row["autor"] . "</li>";
        }
        } 
?>
</div>
<div class="wypozczenia">Kto wypozyczył
<?php
        $sql = "SELECT ksiazki.tytul, czlonkowie.imie, czlonkowie.nazwisko 
                FROM wypozyczenia 
                JOIN ksiazki ON wypozyczenia.ksiazkaID = ksiazki.ID
                JOIN czlonkowie ON wypozyczenia.ImieID = czlonkowie.ID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["tytul"] . " wypożyczyl " . $row["imie"] . " " . $row["nazwisko"] . "</li>";
        }
        }
    ?>
</div>

<div class="zwroty">Zwroty 
    <?php
        $sql = "SELECT ksiazki.tytul, czlonkowie.imie, czlonkowie.nazwisko, wypozyczenia.zwroty
                FROM wypozyczenia 
                JOIN ksiazki ON wypozyczenia.ksiazkaID = ksiazki.ID
                JOIN czlonkowie ON wypozyczenia.ImieID = czlonkowie.ID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $zwrot = $row["zwroty"] ? "tak" : "nie";
        echo "<li>" . $row["tytul"] . " - " . $row["imie"] . " " . $row["nazwisko"] . " - Zwrot: " . $zwrot . "</li>";
        }
        }
    ?>
    </div>
    <div class="terminy">Terminy
    <?php
        $sql = "SELECT termin_zwrotu
                FROM wypozyczenia";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["termin_zwrotu"] . "</li>";
        }
        }
    ?>
    </div>
</div>
</body>
</html>