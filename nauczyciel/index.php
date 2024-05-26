<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" type="image/x-icon" href="../favicon.svg">
    
</head>
<body>
    <?php 
        //sesja
        session_start();
        //podłączenie plików z funkcjami
        require('funkcje.php');
        //zmienne
        $inactive = 2300;
        $user_id = $_SESSION['user_id'];  
        $dzien_tygodnia = dzisiejszy_dzien_tygodnia();
        //wygaszenie sesji
        $_SESSION['expire'] = time() + $inactive;
        if(time() > $_SESSION['expire']){  
            session_unset();
            session_destroy(); 
        }
    ?>


    <header>
        Witaj 
            <?Php   
                $sql = "SELECT Imie FROM nauczyciele WHERE Id_nauczyciela = '$user_id'";
                $wynik_imie = mysqli_query($conn, $sql);
                $imie_nauczyciela = mysqli_fetch_assoc($wynik_imie);
                echo ($imie_nauczyciela['Imie']);
            ?> !
    </header>
    <nav>
        <div class="plan" id="plan">
            
        </div>
    </nav>
    

    <nav>
        <?php
            if($dzien_tygodnia!='Weekend') {
                wyswietl_plan_nauczyciela($conn,$user_id,$dzien_tygodnia);
            } else {
                $dni_tygodnia = array("Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek");
                for ($i = 0; $i < count($dni_tygodnia); $i++) {
                    wyswietl_plan_nauczyciela($conn, 5, $dni_tygodnia[$i]);
                }
            }
        ?>
    </nav>

    <main class="none">
        <ul>
            <li>
                <a href="uczniowie-mgmt.php" class="button">Zarządzanie uczniami</a>
            </li>
            <li>
                <a href="uczniowie-mgmt.php" class="button">Zarządzanie ocenami</a>
            </li>
            <li>
                <a href="uczniowie-mgmt.php" class="button">Zarządzanie obecnością</a>
            </li>
            <li>
                <a href="uczniowie-mgmt.php" class="button">Zarządzanie uczniami</a>
            </li>

        </ul>
    </main>
    
    <?php
        function wyswietl_plan_nauczyciela($conn, $id_nauczyciela,$dzien_tygodnia) {
            $sql = "SELECT 
            *,
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
            p8.Id_Pomieszczenia AS Id_Pomieszczenia8,
            k.Nazwa_Klasy AS Numer_klasy
        FROM 
            nauczyciele n
        JOIN 
            klasa k ON n.Id_nauczyciela = k.Wychowawca
        JOIN 
            plan_klasy pk ON k.plan_klasy_$dzien_tygodnia = pk.id_Planu_l
        JOIN 
            plan_lekcjowy pl ON pk.Id_planu_l = pl.Id_planu_l
        JOIN 
            plan_godzinowy pg ON pk.Id_Planu_g = pg.Id_planu_g
        LEFT JOIN 
            przedmioty p1 ON pl.Lekcja1_P = p1.Id_przedmiotu AND p1.Id_nauczyciela = '$id_nauczyciela'
        LEFT JOIN 
            przedmioty p2 ON pl.Lekcja2_P = p2.Id_przedmiotu AND p2.Id_nauczyciela = '$id_nauczyciela'
        LEFT JOIN 
            przedmioty p3 ON pl.Lekcja3_P = p3.Id_przedmiotu AND p3.Id_nauczyciela = '$id_nauczyciela'
        LEFT JOIN 
            przedmioty p4 ON pl.Lekcja4_P = p4.Id_przedmiotu AND p4.Id_nauczyciela = '$id_nauczyciela'
        LEFT JOIN 
            przedmioty p5 ON pl.Lekcja5_P = p5.Id_przedmiotu AND p5.Id_nauczyciela = '$id_nauczyciela'
        LEFT JOIN 
            przedmioty p6 ON pl.Lekcja6_P = p6.Id_przedmiotu AND p6.Id_nauczyciela = '$id_nauczyciela'
        LEFT JOIN 
            przedmioty p7 ON pl.Lekcja7_P = p7.Id_przedmiotu AND p7.Id_nauczyciela = '$id_nauczyciela'
        LEFT JOIN 
            przedmioty p8 ON pl.Lekcja8_P = p8.Id_przedmiotu AND p8.Id_nauczyciela = '$id_nauczyciela'
        WHERE 
            pl.dzien_tygodnia = '$dzien_tygodnia';";
        
        $res = mysqli_query($conn, $sql);
        if($res == TRUE){
            $row = mysqli_fetch_array($res);
            echo "<table border='1'>";
            echo "<tr><th></th>
                    <th>".$row['Lekcja1']."</th>
                    <th>".$row['Lekcja2']."</th>
                    <th>".$row['Lekcja3']."</th>
                    <th>".$row['Lekcja4']."</th>
                    <th>".$row['Lekcja5']."</th>
                    <th>".$row['Lekcja6']."</th>
                    <th>".$row['Lekcja7']."</th>
                    <th>".$row['Lekcja8']."</th>";
                    echo "<tr id='trrow'><th>$dzien_tygodnia</th>";
                echo "<th>".$row['Lekcja1_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia1'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia1']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "<th>".$row['Lekcja2_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia2'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia2']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "<th>".$row['Lekcja3_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia3'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia3']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "<th>".$row['Lekcja4_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia4'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia4']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "<th>".$row['Lekcja5_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia5'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia5']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "<th>".$row['Lekcja6_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia6'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia6']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "<th>".$row['Lekcja7_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia7'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia7']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "<th>".$row['Lekcja8_Nazwa'];
                    if (!empty($row['Id_Pomieszczenia8'])) { 
                        echo "<br> Sala: ".$row['Id_Pomieszczenia8']; 
                        echo "<br> Klasa: ".$row['Numer_klasy']."</th>";
                    };
                echo "</tr>";
            echo "</table>";
        } else {
            echo "Nie wyswietlono";
            mysqli_error($conn);
        }}
        ?>
    
 
</body>
</html>
