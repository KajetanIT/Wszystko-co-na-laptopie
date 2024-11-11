<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $polaczenie = new mysqli("localhost", "root", "", "przychodnia");
    if ($polaczenie->connect_error) {
        die("Połączenie nieudane: " . $polaczenie->connect_error);
    }

    $sql = $polaczenie->prepare("SELECT nazwisko, imie, adres, data_urodzenia FROM pacjenci WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $wynik = $sql->get_result()->fetch_assoc();

    if($wynik) {
        echo "<p>Imię: " . $wynik['imie'] . "</p>";
        echo "<p>Nazwisko: " . $wynik['nazwisko'] . "</p>";
        echo "<p>Adres: " . $wynik['adres'] . "</p>";
        echo "<p>Data urodzenia: " . $wynik['data_urodzenia'] . "</p>";
    } else {
        echo "Nie znaleziono pacjenta.";
    }

    $polaczenie->close();
}
?>
