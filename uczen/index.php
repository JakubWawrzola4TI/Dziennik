<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Ucznia - Moje Oceny</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1> Witaj 
        <?php 
            $user_Id = Id_z_url(); 
            $imie_ucznia= Imie_ucznia_z_userID($user_Id); 
            echo $imie_ucznia; 
        ?>
        !
        </h1>
    </header>
    <main>
        <div class="plan">
            <h2>Plan</h2>
            <?php
                plan($imie_ucznia, Klasa_ucznia_z_userID($user_Id), dzisiejszy_dzien_tygodnia());
            ?>
        </div>
        <div class="oceny-obecnosc">
            <div id="oceny" >
                <h2 class="h22">Oceny</h2>
                <iframe  src="oceny.php?user_id=<?php echo $user_Id?>" frameborder="0" class="ramka"></iframe>
            </div>
            <div id="obecnosc">
                <h2 class="h22">Obecność</h2>
            <iframe  src="obecnosc.php?user_id=<?php echo $user_Id?>" frameborder="0" class="ramka"></iframe>
            </div>    
        </div>
        <div class="Kontakt_do_nauczyciela">
            
        </div>

    </main>


    <?php 
        function oceny($user_Id){
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
            $sql = "SELECT * FROM oceny o
                JOIN przedmioty p using(Id_przedmiotu)
                JOIN nauczyciele n using(Id_nauczyciela)
            where o.id_ucznia = $user_Id;";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                if (mysqli_num_rows($res) > 0) {
                    echo "<table border='1'><tr>
                    <th>Przedmiot</th>
                    <th>Nazwa</th>
                    <th>Opisy</th>
                    <th>Ocena</th></tr>";
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr><td>" . $row["Nazwa_przedmiotu"] . "</td><td>" . $row["Nazwa_oceny"] . "</td><td>" . $row["Opis_oceny"] . "</td><td>" . $row["Wartosc_oceny"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
            } else {
                echo mysqli_error($conn);
            }
        }
        function plan($imie,$id_klasy,$dzien_tygodnia) {
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
            if ($dzien_tygodnia == "Poniedziałek"){
                $sql_Poniedziałek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu AS Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu AS Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu AS Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu AS Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu AS Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu AS Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu AS Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Poniedziałek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu

                WHERE pl.dzien_tygodnia = 'Poniedziałek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_poniedzialek = mysqli_query($conn, $sql_Poniedziałek);
                if($res_poniedzialek == TRUE){
                    $row_poniedzialek = mysqli_fetch_array($res_poniedzialek);
                    echo "<table border='1'>";
                    echo "<tr><th></th>
                            <th>".$row_poniedzialek['Lekcja1']."</th>
                            <th>".$row_poniedzialek['Lekcja2']."</th>
                            <th>".$row_poniedzialek['Lekcja3']."</th>
                            <th>".$row_poniedzialek['Lekcja4']."</th>
                            <th>".$row_poniedzialek['Lekcja5']."</th>
                            <th>".$row_poniedzialek['Lekcja6']."</th>
                            <th>".$row_poniedzialek['Lekcja7']."</th>
                            <th>".$row_poniedzialek['Lekcja8']."</th>";
                            echo "<tr id='trrow'><th>Poniedzialek</th>";
                        echo "<th>".$row_poniedzialek['Lekcja1_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia1']."</th>";
                        echo "<th>".$row_poniedzialek['Lekcja2_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia2']."</th>";
                        echo "<th>".$row_poniedzialek['Lekcja3_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia3']."</th>";
                        echo "<th>".$row_poniedzialek['Lekcja4_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia4']."</th>";
                        echo "<th>".$row_poniedzialek['Lekcja5_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia5']."</th>";
                        echo "<th>".$row_poniedzialek['Lekcja6_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia6']."</th>";
                        echo "<th>".$row_poniedzialek['Lekcja7_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia7']."</th>";
                        echo "<th>".$row_poniedzialek['Lekcja8_Nazwa'];
                            if (!empty($row_poniedzialek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia8']."</th>";
                        echo "</tr>";
                    echo "</table>";
                } else {
                    echo "Nie wyswietlono";
                    mysqli_error($conn);
                }
            } else if($dzien_tygodnia == "Wtorek") {
                $sql_Wtorek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Wtorek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Wtorek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_wtorek = mysqli_query($conn, $sql_Wtorek);
                if ($res_wtorek == TRUE) {
                    $row_wtorek = mysqli_fetch_array($res_wtorek);
                    echo "<table border='1'>";
                        echo "<tr><th></th>
                                <th>".$row_wtorek['Lekcja1']."</th>
                                <th>".$row_wtorek['Lekcja2']."</th>
                                <th>".$row_wtorek['Lekcja3']."</th>
                                <th>".$row_wtorek['Lekcja4']."</th>
                                <th>".$row_wtorek['Lekcja5']."</th>
                                <th>".$row_wtorek['Lekcja6']."</th>
                                <th>".$row_wtorek['Lekcja7']."</th>
                                <th>".$row_wtorek['Lekcja8']."</th>";
                        echo "<tr id='trrow'><th>Wtorek</th>";
                        echo "<th>".$row_wtorek['Lekcja1_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia1']."</th>";
                        echo "<th>".$row_wtorek['Lekcja2_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia2']."</th>";
                        echo "<th>".$row_wtorek['Lekcja3_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia3']."</th>";
                        echo "<th>".$row_wtorek['Lekcja4_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia4']."</th>";
                        echo "<th>".$row_wtorek['Lekcja5_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia5']."</th>";
                        echo "<th>".$row_wtorek['Lekcja6_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia6']."</th>";
                        echo "<th>".$row_wtorek['Lekcja7_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia7']."</th>";
                        echo "<th>".$row_wtorek['Lekcja8_Nazwa'];
                            if (!empty($row_wtorek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia8']."</th>";
                        echo "</tr>";
                    echo "</table>";
                } else {
                    echo "Nie wyswietlono";
                    mysqli_error($conn);
                }
            } else if($dzien_tygodnia == "Środa") {
                $sql_Sroda = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Środa = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Środa' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_Sroda = mysqli_query($conn, $sql_Sroda);
                if ($res_Sroda == TRUE) {
                    $row_sroda = mysqli_fetch_array($res_Sroda);
                    echo "<table border='1'>";
                    echo "<tr><th></th>
                            <th>".$row_sroda['Lekcja1']."</th>
                            <th>".$row_sroda['Lekcja2']."</th>
                            <th>".$row_sroda['Lekcja3']."</th>
                            <th>".$row_sroda['Lekcja4']."</th>
                            <th>".$row_sroda['Lekcja5']."</th>
                            <th>".$row_sroda['Lekcja6']."</th>
                            <th>".$row_sroda['Lekcja7']."</th>
                            <th>".$row_sroda['Lekcja8']."</th>";
                    echo "<tr id='trrow'><th>Środa</th>";
                    echo "<th>".$row_sroda['Lekcja1_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia1']."</th>";
                    echo "<th>".$row_sroda['Lekcja2_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia2']."</th>";
                    echo "<th>".$row_sroda['Lekcja3_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia3']."</th>";
                    echo "<th>".$row_sroda['Lekcja4_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia4']."</th>";
                    echo "<th>".$row_sroda['Lekcja5_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia5']."</th>";
                    echo "<th>".$row_sroda['Lekcja6_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia6']."</th>";
                    echo "<th>".$row_sroda['Lekcja7_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia7']."</th>";
                    echo "<th>".$row_sroda['Lekcja8_Nazwa'];
                    if (!empty($row_sroda['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia8']."</th>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "Nie wyswietlono";
                    mysqli_error($conn);
                }
            } else if($dzien_tygodnia == "Czwartek")  {
                $sql_czwartek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_czwartek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Czwartek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_czwartek = mysqli_query($conn, $sql_czwartek);
                if ($res_czwartek == TRUE) {
                    $row_czwartek = mysqli_fetch_array($res_czwartek);
                    echo "<table border='1'>";
                    echo "<tr><th></th>
                            <th>".$row_czwartek['Lekcja1']."</th>
                            <th>".$row_czwartek['Lekcja2']."</th>
                            <th>".$row_czwartek['Lekcja3']."</th>
                            <th>".$row_czwartek['Lekcja4']."</th>
                            <th>".$row_czwartek['Lekcja5']."</th>
                            <th>".$row_czwartek['Lekcja6']."</th>
                            <th>".$row_czwartek['Lekcja7']."</th>
                            <th>".$row_czwartek['Lekcja8']."</th>";
                    echo "<tr id='trrow'><th>Czwartek</th>";
                    echo "<th>".$row_czwartek['Lekcja1_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia1']."</th>";
                    echo "<th>".$row_czwartek['Lekcja2_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia2']."</th>";
                    echo "<th>".$row_czwartek['Lekcja3_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia3']."</th>";
                    echo "<th>".$row_czwartek['Lekcja4_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia4']."</th>";
                    echo "<th>".$row_czwartek['Lekcja5_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia5']."</th>";
                    echo "<th>".$row_czwartek['Lekcja6_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia6']."</th>";
                    echo "<th>".$row_czwartek['Lekcja7_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia7']."</th>";
                    echo "<th>".$row_czwartek['Lekcja8_Nazwa'];
                    if (!empty($row_czwartek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia8']."</th>";
                    echo "</tr>";
                    echo "</table>";
                }
                 else {
                    echo "Nie wyswietlono";
                    mysqli_error($conn);
                }
            
            } else if($dzien_tygodnia == "Piątek")     {
                $sql_piatek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_piatek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Piątek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_piatek = mysqli_query($conn, $sql_piatek);
                if ($res_piatek == TRUE) {
                    $row_piatek = mysqli_fetch_array($res_piatek);
                    echo "<table border='1'>";
                    echo "<tr><th></th>
                            <th>".$row_piatek['Lekcja1']."</th>
                            <th>".$row_piatek['Lekcja2']."</th>
                            <th>".$row_piatek['Lekcja3']."</th>
                            <th>".$row_piatek['Lekcja4']."</th>
                            <th>".$row_piatek['Lekcja5']."</th>
                            <th>".$row_piatek['Lekcja6']."</th>
                            <th>".$row_piatek['Lekcja7']."</th>
                            <th>".$row_piatek['Lekcja8']."</th>";
                    echo "<tr id='trrow'><th>Piątek</th>";
                    echo "<th>".$row_piatek['Lekcja1_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia1']."</th>";
                    echo "<th>".$row_piatek['Lekcja2_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia2']."</th>";
                    echo "<th>".$row_piatek['Lekcja3_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia3']."</th>";
                    echo "<th>".$row_piatek['Lekcja4_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia4']."</th>";
                    echo "<th>".$row_piatek['Lekcja5_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia5']."</th>";
                    echo "<th>".$row_piatek['Lekcja6_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia6']."</th>";
                    echo "<th>".$row_piatek['Lekcja7_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia7']."</th>";
                    echo "<th>".$row_piatek['Lekcja8_Nazwa'];
                    if (!empty($row_piatek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia8']."</th>";
                    echo "</tr>";
                    echo "</table>";
                }
                 else {
                    echo "Nie wyswietlono";
                    mysqli_error($conn);
                }
            } else if($dzien_tygodnia == "Sobota" or $dzien_tygodnia='Niedziela'){
                //poniedzialek
                $sql_Poniedziałek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Poniedziałek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Poniedziałek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_poniedzialek = mysqli_query($conn, $sql_Poniedziałek);
                //wtorek
                $sql_Wtorek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Wtorek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Wtorek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_wtorek = mysqli_query($conn, $sql_Wtorek);
                //sroda
                $sql_Sroda = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Środa = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Środa' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_sroda = mysqli_query($conn, $sql_Sroda);
                //czwartek
                $sql_czwartek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Czwartek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Czwartek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_czwartek = mysqli_query($conn, $sql_czwartek);
                //piatek
                $sql_piatek = "SELECT *, 
                p1.Nazwa_przedmiotu AS Lekcja1_Nazwa,
                p2.Nazwa_przedmiotu as Lekcja2_Nazwa,
                p3.Nazwa_przedmiotu as Lekcja3_Nazwa,
                p4.Nazwa_przedmiotu as Lekcja4_Nazwa,
                p5.Nazwa_przedmiotu as Lekcja5_Nazwa,
                p6.Nazwa_przedmiotu as Lekcja6_Nazwa,
                p7.Nazwa_przedmiotu as Lekcja7_Nazwa,
                p8.Nazwa_przedmiotu as Lekcja8_Nazwa,
                p1.Id_Pomieszczenia AS Id_Pomieszczenia1,
                p2.Id_Pomieszczenia AS Id_Pomieszczenia2,
                p3.Id_Pomieszczenia AS Id_Pomieszczenia3,
                p4.Id_Pomieszczenia AS Id_Pomieszczenia4,
                p5.Id_Pomieszczenia AS Id_Pomieszczenia5,
                p6.Id_Pomieszczenia AS Id_Pomieszczenia6,
                p7.Id_Pomieszczenia AS Id_Pomieszczenia7,
                p8.Id_Pomieszczenia AS Id_Pomieszczenia8
                FROM uczniowie u
                JOIN klasa k ON u.id_klasy = k.id_klasy
                JOIN plan_klasy pk ON k.plan_klasy_Piątek = pk.id_Planu_l
                JOIN plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
                JOIN plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
                LEFT JOIN przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu
                LEFT JOIN przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu
                LEFT JOIN przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu
                LEFT JOIN przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu
                LEFT JOIN przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu
                LEFT JOIN przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu
                LEFT JOIN przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu
                LEFT JOIN przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu
                WHERE pl.dzien_tygodnia = 'Piątek' 
                AND k.id_klasy = '$id_klasy' 
                AND u.Imie = '$imie';";
                $res_piatek = mysqli_query($conn, $sql_piatek);
                if(($res_poniedzialek == TRUE) or ($res_wtorek == TRUE) or ($res_sroda == TRUE) or ($res_czwartek == TRUE) or ($res_piatek == TRUE) ){
                    $row_poniedzialek = mysqli_fetch_array($res_poniedzialek);
                    $row_wtorek = mysqli_fetch_array($res_wtorek);
                    $row_sroda = mysqli_fetch_array($res_sroda);
                    $row_czwartek = mysqli_fetch_array($res_czwartek);
                    $row_piatek = mysqli_fetch_array($res_piatek);
                    echo "<table border='1'>";
                    echo "<tr><th></th>
                            <th>".$row_poniedzialek['Lekcja1']."</th>
                            <th>".$row_poniedzialek['Lekcja2']."</th>
                            <th>".$row_poniedzialek['Lekcja3']."</th>
                            <th>".$row_poniedzialek['Lekcja4']."</th>
                            <th>".$row_poniedzialek['Lekcja5']."</th>
                            <th>".$row_poniedzialek['Lekcja6']."</th>
                            <th>".$row_poniedzialek['Lekcja7']."</th>
                            <th>".$row_poniedzialek['Lekcja8']."</th>";
                    echo "<tr id='trrow'><th>Poniedzialek</th>";
                            echo "<th>".$row_poniedzialek['Lekcja1_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia1']."</th>";
                            echo "<th>".$row_poniedzialek['Lekcja2_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia2']."</th>";
                            echo "<th>".$row_poniedzialek['Lekcja3_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia3']."</th>";
                            echo "<th>".$row_poniedzialek['Lekcja4_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia4']."</th>";
                            echo "<th>".$row_poniedzialek['Lekcja5_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia5']."</th>";
                            echo "<th>".$row_poniedzialek['Lekcja6_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia6']."</th>";
                            echo "<th>".$row_poniedzialek['Lekcja7_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia7']."</th>";
                            echo "<th>".$row_poniedzialek['Lekcja8_Nazwa'];
                                if (!empty($row_poniedzialek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_poniedzialek['Id_Pomieszczenia8']."</th>";
                            echo "</tr>";      

                            echo "<tr id='trrow'><th>Wtorek</th>";
                            echo "<th>".$row_wtorek['Lekcja1_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia1']."</th>";
                            echo "<th>".$row_wtorek['Lekcja2_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia2']."</th>";
                            echo "<th>".$row_wtorek['Lekcja3_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia3']."</th>";
                            echo "<th>".$row_wtorek['Lekcja4_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia4']."</th>";
                            echo "<th>".$row_wtorek['Lekcja5_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia5']."</th>";
                            echo "<th>".$row_wtorek['Lekcja6_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia6']."</th>";
                            echo "<th>".$row_wtorek['Lekcja7_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia7']."</th>";
                            echo "<th>".$row_wtorek['Lekcja8_Nazwa'];
                                if (!empty($row_wtorek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_wtorek['Id_Pomieszczenia8']."</th>";
                            echo "</tr>";

                            echo "<tr id='trrow'><th>Środa</th>";
                            echo "<th>".$row_sroda['Lekcja1_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia1']."</th>";
                            echo "<th>".$row_sroda['Lekcja2_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia2']."</th>";
                            echo "<th>".$row_sroda['Lekcja3_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia3']."</th>";
                            echo "<th>".$row_sroda['Lekcja4_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia4']."</th>";
                            echo "<th>".$row_sroda['Lekcja5_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia5']."</th>";
                            echo "<th>".$row_sroda['Lekcja6_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia6']."</th>";
                            echo "<th>".$row_sroda['Lekcja7_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia7']."</th>";
                            echo "<th>".$row_sroda['Lekcja8_Nazwa'];
                            if (!empty($row_sroda['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_sroda['Id_Pomieszczenia8']."</th>";
                            echo "</tr>";

                            echo "<tr id='trrow'><th>Czwartek</th>";
                            echo "<th>".$row_czwartek['Lekcja1_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia1']."</th>";
                            echo "<th>".$row_czwartek['Lekcja2_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia2']."</th>";
                            echo "<th>".$row_czwartek['Lekcja3_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia3']."</th>";
                            echo "<th>".$row_czwartek['Lekcja4_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia4']."</th>";
                            echo "<th>".$row_czwartek['Lekcja5_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia5']."</th>";
                            echo "<th>".$row_czwartek['Lekcja6_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia6']."</th>";
                            echo "<th>".$row_czwartek['Lekcja7_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia7']."</th>";
                            echo "<th>".$row_czwartek['Lekcja8_Nazwa'];
                            if (!empty($row_czwartek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_czwartek['Id_Pomieszczenia8']."</th>";
                            echo "</tr>";

                            echo "<tr id='trrow'><th>Piątek</th>";
                            echo "<th>".$row_piatek['Lekcja1_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia1'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia1']."</th>";
                            echo "<th>".$row_piatek['Lekcja2_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia2'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia2']."</th>";
                            echo "<th>".$row_piatek['Lekcja3_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia3'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia3']."</th>";
                            echo "<th>".$row_piatek['Lekcja4_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia4'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia4']."</th>";
                            echo "<th>".$row_piatek['Lekcja5_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia5'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia5']."</th>";
                            echo "<th>".$row_piatek['Lekcja6_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia6'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia6']."</th>";
                            echo "<th>".$row_piatek['Lekcja7_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia7'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia7']."</th>";
                            echo "<th>".$row_piatek['Lekcja8_Nazwa'];
                            if (!empty($row_piatek['Id_Pomieszczenia8'])) echo "<br> Sala: ".$row_piatek['Id_Pomieszczenia8']."</th>";
                            echo "</tr>";
                    echo "</table>";
                } else {
                    echo "Nie wyswietlono";
                    mysqli_error($conn);
                }
            }
        }           
        function dzisiejszy_dzien_tygodnia() { 
                // Ustaw lokalizację na polską
                setlocale(LC_TIME, 'pl_PL.utf8');                
                // Pobierz dzisiejszą datę
                $dzisiaj = date("Y-m-d");             
                // Przekonwertuj dzisiejszą datę na nazwę dnia tygodnia po polsku
                $nazwa_dnia = strftime("%A", strtotime($dzisiaj));
                // Możesz dostosować format nazwy dnia tygodnia, jeśli chcesz
                // Na przykład, zamienić pierwszą literę na wielką
                // $nazwa_dnia = ucfirst($nazwa_dnia);
                $nazwa_dnia = date("l"); // Pobranie dzisiejszej nazwy dnia tygodni
                // Mapowanie nazwy dni tygodnia z języka angielskiego na polski
                if ($nazwa_dnia === "Monday") {
                    $nazwa_dnia_pl = "Poniedziałek";
                } else if ($nazwa_dnia === "Tuesday") {
                    $nazwa_dnia_pl = "Wtorek";
                } else if ($nazwa_dnia === "Wednesday") {
                    $nazwa_dnia_pl = "Środa";
                } else if ($nazwa_dnia === "Thursday") {
                    $nazwa_dnia_pl = "Czwartek";
                } else if ($nazwa_dnia === "Friday") {
                    $nazwa_dnia_pl = "Piątek";
                } else if ($nazwa_dnia === "Saturday") {
                    $nazwa_dnia_pl = "Sobota";
                } else if ($nazwa_dnia === "Sunday") {
                    $nazwa_dnia_pl = "Niedziela";
                } else {
                    $nazwa_dnia_pl = "Nieznany dzień";
                }
                return $nazwa_dnia_pl;
        }
        function Id_z_url() {
                // Sprawdź, czy istnieje parametr 'user_id' w tablicy $_GET i zwróć jego wartość
                if (isset($_GET['user_id'])) {
                    return $_GET['user_id'];
                } else {
                    return null;
                }
        }
        function Imie_ucznia_z_userID($userId) {
                // Połączenie z bazą danych
                $DBHOST = "localhost";
                $DBUSER = "admin";
                $DBPASS = "admin";
                $DBNAME = "dziennik3";
                $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);      
                // Zapytanie SQL
                $sql = "SELECT Imie  FROM uczniowie WHERE id_ucznia = $userId";
            
                // Wykonanie zapytania
                $result = mysqli_query($conn, $sql);
            
                // Sprawdzenie, czy istnieje wynik
                if (mysqli_num_rows($result) > 0) {
                    // Pobranie danych z wyniku zapytania
                    $row = mysqli_fetch_assoc($result);
                    $userName = $row['Imie'];
            
                    // Zwolnienie pamięci wyniku i zamknięcie połączenia z bazą danych
                    mysqli_free_result($result);
                    mysqli_close($conn);
            
                    return $userName;
                } else {
                    // Jeśli nie ma wyników, zwróć null
                    mysqli_close($conn);
                    return null;
                }
        }
        function Klasa_ucznia_z_userID($userId) {
            // Połączenie z bazą danych
            $DBHOST = "localhost";
            $DBUSER = "admin";
            $DBPASS = "admin";
            $DBNAME = "dziennik3";
            $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);      
            // Zapytanie SQL
            $sql = "SELECT id_klasy  FROM uczniowie WHERE id_ucznia = $userId";
        
            // Wykonanie zapytania
            $result = mysqli_query($conn, $sql);
        
            // Sprawdzenie, czy istnieje wynik
            if (mysqli_num_rows($result) > 0) {
                // Pobranie danych z wyniku zapytania
                $row = mysqli_fetch_assoc($result);
                $id_klasy = $row['id_klasy'];
        
                // Zwolnienie pamięci wyniku i zamknięcie połączenia z bazą danych
                mysqli_free_result($result);
                mysqli_close($conn);
        
                return $id_klasy;
            } else {
                // Jeśli nie ma wyników, zwróć null
                mysqli_close($conn);
                return null;
            }
    }
    ?>
</body>
</html>
