<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przychodnia</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pacjentSelect').change(function() {
                var idPacjenta = $(this).val();
                if(idPacjenta != "") {
                    $.ajax({
                        url: 'szczegoly_pacjenta.php',
                        method: 'POST',
                        data: {id: idPacjenta},
                        success: function(response) {
                            $('.srodek').html(response);
                        }
                    });
                } else {
                    $('.srodek').html(""); 
                }
            });
        });
    </script>
</head>
<body>
    <style>

.container {
    position: relative; 
}
img{
    width: 100%;
    height: 290px;

}

.left {
    background: #a0daf7;
    width: 450px;
    height: 600px;
    text-align: center;
    font-family: cursive;
    font-size: 15px;
    float: left; 

}

.srodek {
        min-height: 560px;
        background-color: #ebf2f5;
        margin-left: 30vh;
        padding: 20px; 
        width: auto;
}

.stopka {
    background: #51658d;
    height: 5vh; 
    position: absolute; 
    bottom: 0; 
    left: 450px; 
    right: 0;
    text-align: center;
    font-family: cursive;
    font-size: 30px;
}
h1{
    font-size: 20px;
}
select#pacjentSelect {
        width: 80%; 
        padding: 10px; 
        font-size: 16px; 
        cursor: pointer; 
        margin-bottom: 20px;
    }
    </style>
<div class="container">
    <div class="naglowek">
        <img src="gora.jpeg">
    </div>
    <div class="left">
        <div class="lekarze">
            <h1>LEKARZE SPECIALIŚCI</h1>
            <?php
            $serwer = "localhost";
            $uzytkownik = "root"; 
            $haslo = ""; 
            $baza_danych = "przychodnia";

            $polaczenie = new mysqli($serwer, $uzytkownik, $haslo, $baza_danych);

            if ($polaczenie->connect_error) {
                die("Połączenie nieudane: " . $polaczenie->connect_error);
            }

            $sql = "SELECT imie, nazwisko, telefon FROM lekarze";
            $wynik = $polaczenie->query($sql);

            if ($wynik->num_rows > 0) {
                while($wiersz = $wynik->fetch_assoc()) {
                    echo "<p>Imię: " . $wiersz["imie"] . "<br>Nazwisko: " . $wiersz["nazwisko"] . "<br>Telefon: " . $wiersz["telefon"] . "</p>";
                }
            } else {
                echo "Nie znaleziono lekarzy.";
            }

            $polaczenie->close();
            ?>
            <hr style="height: 2px; background: black;">
            <div class="lista">
                <h1>LISTA PACJENTÓW</h1>
                <select id="pacjentSelect">
                    <option value="">Wybierz pacjenta</option>
                    <?php
                    $polaczenie = new mysqli("localhost", "root", "", "przychodnia");
                    if ($polaczenie->connect_error) {
                        die("Połączenie nieudane: " . $polaczenie->connect_error);
                    }

                    $sql = "SELECT id, imie, nazwisko FROM pacjenci";
                    $wynik = $polaczenie->query($sql);

                    if ($wynik->num_rows > 0) {
                        while($wiersz = $wynik->fetch_assoc()) {
                            echo "<option value='" . $wiersz["id"] . "'>" . $wiersz["imie"] . " " . $wiersz["nazwisko"] . "</option>";
                        }
                    } else {
                        echo "<option>Nie znaleziono pacjentów.</option>";
                    }

                    $polaczenie->close();
                    ?>
                </select>
            </div> 

                <div class="terminy">
                <h1>TERMIN WIZYTY</h1>
                <?php
            $polaczenie = new mysqli("localhost", "root", "", "przychodnia");
            if ($polaczenie->connect_error) {
                die("Połączenie nieudane: " . $polaczenie->connect_error);
            }

            $idPacjenta = 1; 
            $idPacjenta = 2; 
            $idPacjenta = 3; // Tutaj możesz ustawić domyślne ID pacjenta lub otrzymać je z formularza/wybieraka
            
            $sql = "SELECT data FROM wizyty WHERE id_pacjenta = $idPacjenta ";
            $wynik = $polaczenie->query($sql);

            if ($wynik->num_rows > 0) {
                while($wiersz = $wynik->fetch_assoc()) {
                    echo "<li>" . $wiersz['data'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "Brak zaplanowanych wizyt dla wybranego pacjenta.";
            }

            $polaczenie->close();
            ?>
                </div>
        </div>
    </div>
    <div class="srodek">

    </div>
    <div class="stopka">
        Wykonał: Kajetan Mika
    </div>
</div>
</body>
</html>
