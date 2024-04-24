<head>
    <link rel="stylesheet" type="text/css" href="obcenosc-css.css">
</head>
<?php $user_Id = Id_z_url()?>
<form method="GET" action="">
<h3>Wybierz przedmiot ktorego obecnosc chcesz wyswietlic<h3>
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
            obecnosc($user_Id, $wybranyPrzedmiot);         
        }
        function obecnosc($user_Id, $wybranyPrzedmiot) {
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
            $sql = "SELECT * FROM obecnosc o
            JOIN uczniowie using(Id_ucznia)
            JOIN przedmioty using(Id_przedmiotu)
            WHERE Id_Przedmiotu = $wybranyPrzedmiot AND Id_ucznia = $user_Id;";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                if (mysqli_num_rows($res) > 0) {
                    podsumowanieObecnosci($user_Id,$wybranyPrzedmiot);
                    echo "<div class='table-container'>";
                    echo "<table border='1'><tr>
                    <th>Przedmiot</th>
                    <th>Data</th>
                    <th>Godzina</th>
                    <th>Czy_obecny</th></tr>";
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr><td>" . $row["Nazwa_przedmiotu"] . "</td><td>" . $row["Data"] . "</td><td>" . $row["Godzina"] . "</td><td>" . $row["Czy_obecny"] . "</td></tr>";
                    }
                    
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<br>";
                    echo "<br>"; 
                    echo "Brak zapisu obecnosci";
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
        function podsumowanieObecnosci($user_Id,$przedmiotId) {
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
        
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
        
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        
            $sql_tak = "SELECT COUNT(*) as obecnosci_tak FROM obecnosc WHERE Id_Przedmiotu = $przedmiotId AND Czy_obecny = 'tak' AND Id_ucznia = $user_Id";
            $sql_nie = "SELECT COUNT(*) as obecnosci_nie FROM obecnosc WHERE Id_Przedmiotu = $przedmiotId AND Czy_obecny = 'nie' AND Id_ucznia = $user_Id";
            $sql_avg = "SELECT COUNT(*) as total_obecnosci, AVG(CASE WHEN Czy_obecny = 'tak' THEN 100 ELSE 0 END) as srednia_obecnosci FROM obecnosc WHERE Id_Przedmiotu = $przedmiotId AND Id_ucznia = $user_Id";
        
            $result_tak = mysqli_query($conn, $sql_tak);
            $result_nie = mysqli_query($conn, $sql_nie);
            $result_avg = mysqli_query($conn, $sql_avg);
        
            if (mysqli_num_rows($result_avg) > 0) {
                $row_tak = mysqli_fetch_assoc($result_tak);
                $row_nie = mysqli_fetch_assoc($result_nie);
                $row_avg = mysqli_fetch_assoc($result_avg);
        
                $total_obecnosci = $row_avg['total_obecnosci'];
                $srednia_obecnosci = $row_avg['srednia_obecnosci'];
                $obecnosci_tak = $row_tak['obecnosci_tak'];
                $obecnosci_nie = $row_nie['obecnosci_nie'];
        
                // Obliczanie średniej obecności w procentach
                $srednia_obecnosci_procent = round($srednia_obecnosci, 2); // Zaokrąglamy do 2 miejsc po przecinku
        
                echo "<p>Liczba wszystkich zapisów: $total_obecnosci</p>";
                echo "<p>Liczba obecności: $obecnosci_tak</p>";
                echo "<p>Liczba nieobecności: $obecnosci_nie</p>";
                echo "<p>Średnia obecności: $srednia_obecnosci_procent%</p>";
            } else {
                echo "Brak danych obecności.";
            }
        
            mysqli_close($conn);
        }



?>