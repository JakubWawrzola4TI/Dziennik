<head>
    <link rel="stylesheet" type="text/css" href="oceny-css.css">
</head>
<?php $user_Id = Id_z_url()?>
<form method="GET" action="">
<h3>Wybierz przedmiot ktorego oceny chcesz wyswietlic<h3>
<select name="przedmiot" id="przedmiot">
    <?php
        formularz();
    ?>
</select>
<input type="hidden" value=<?php echo $user_Id ?> name="user_id">
<input type="submit" name="submit" value="Wybierz">
</form>

<?php

if(isset($_GET['submit'])) {
            $wybranyPrzedmiot = $_GET['przedmiot'];
            $user_Id = Id_z_url();
            oceny($user_Id, $wybranyPrzedmiot);         
        }
        function oceny($user_Id, $wybranyPrzedmiot) {
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
            $sql = "SELECT * FROM oceny o
            JOIN uczniowie using(Id_ucznia)
            JOIN przedmioty using(Id_przedmiotu)
            WHERE Id_Przedmiotu = $wybranyPrzedmiot AND Id_ucznia = $user_Id;";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                if (mysqli_num_rows($res) > 0) {
                    podsumowanieOcen($user_Id,$wybranyPrzedmiot);
                    echo "<div class='table-container'>";
                    echo "<table border='1'><tr>
                    <th>Nazwa_oceny</th>
                    <th>Opis_oceny</th>
                    <th>Wartosc oceny</th></tr>";
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>
                        <td>" . $row["Nazwa_oceny"] . "</td>
                        <td>" . $row["Opis_oceny"] . "</td>
                        <td>" . $row["Wartosc_oceny"] . "</td>";
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<br>";
                    echo "<br>"; 
                    echo "Brak zapisu ocen";
                }
            } else {
                echo mysqli_error($conn);
            }
        }
        function formularz() {
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
            $sql = "SELECT * FROM przedmioty";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $selected = isset($_GET['przedmiot']) && $_GET['przedmiot'] == $row['Id_przedmiotu'] ? 'selected' : ''; // Dodajemy selected jeśli wartość odpowiada wyborowi użytkownika
                    echo "<option value='" . $row['Id_przedmiotu'] . "' $selected>" . $row['Nazwa_przedmiotu'] . "</option>";
                }
            } else {
                echo "<option value=''>Brak przedmiotów</option>";
            }
        }
        function Id_z_url() {
            if (isset($_GET['user_id'])) {
                return $_GET['user_id'];
            } else {
                return null;
            }
        }
        function podsumowanieOcen($user_Id, $przedmiotId) {
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
        
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
        
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        
            $sql_oceny = "SELECT AVG(wartosc_oceny) as srednia_ocen FROM oceny WHERE Id_przedmiotu = $przedmiotId AND Id_ucznia = $user_Id";
        
            $result_oceny = mysqli_query($conn, $sql_oceny);
        
            if (mysqli_num_rows($result_oceny) > 0) {
                $row_oceny = mysqli_fetch_assoc($result_oceny);
                $srednia_ocen = $row_oceny['srednia_ocen'];
                $srednia_ocen_procent = round($srednia_ocen, 2);
                echo "<p>Średnia ocen: $srednia_ocen_procent</p>";
            } else {
                echo "Brak danych ocen.";
            }
            mysqli_close($conn);
        }
        



?>