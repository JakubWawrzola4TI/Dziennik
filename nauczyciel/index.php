<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" type="image/x-icon" href="../favicon.svg">
    <script src="script.js" defer></script>
</head>
<body>
    <?php 
        session_start();
        require('funkcje.php');
        $inactive = 2300;
        $user_id = $_SESSION['user_id'];  
        $dzien_tygodnia = dzisiejszy_dzien_tygodnia();
        $_SESSION['expire'] = time() + $inactive;
        if(time() > $_SESSION['expire']){  
            session_unset();
            session_destroy(); 
        }
    ?>


    <header>
        <h1>
            Witaj 
                <?Php   
                    $sql = "SELECT Imie FROM nauczyciele WHERE Id_nauczyciela = '$user_id'";
                    $wynik_imie = mysqli_query($conn, $sql);
                    $imie_nauczyciela = mysqli_fetch_assoc($wynik_imie);
                    echo ($imie_nauczyciela['Imie']);
                ?> !
        </h1>
    </header>
    <nav>
        <?php
                wyswietl_plan_nauczyciela($conn,$user_id,'Czwartek');
        ?>
    </nav>
    <main>
        <iframe src="sidebar.php" frameborder="0">
        </iframe>
        <iframe src="ramka.php" frameborder="0">
        </iframe>
    </main>


    
    <?php
        function wyswietl_plan_nauczyciela($conn, $id_nauczyciela, $dzien_tygodnia) {
            $dni_tygodnia = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek'];
            if ($dzien_tygodnia == 'Weekend') {
                $dni_do_wyswietlenia = $dni_tygodnia;
            } else {
                $dni_do_wyswietlenia = [$dzien_tygodnia];
            }
            echo "<table border='1'>";
            foreach ($dni_do_wyswietlenia as $dzien) {
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
                    klasa k
                JOIN 
                    plan_klasy pk ON k.plan_klasy_$dzien = pk.id_Planu_l
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
                    pl.dzien_tygodnia = '$dzien';";
                
                $res = mysqli_query($conn, $sql);
                if($res == TRUE){
                    $lekcje = array_fill(1, 8, []);
                    $sale = array_fill(1, 8, []);
                    $klasy = array_fill(1, 8, []);
                    while($row = mysqli_fetch_array($res)) {
                        for ($i = 1; $i <= 8; $i++) {
                            if (!empty($row["Lekcja{$i}_Nazwa"])) {
                                $lekcje[$i][] = $row["Lekcja{$i}_Nazwa"];
                                $sale[$i][] = !empty($row["Id_Pomieszczenia{$i}"]) ? "Sala: ".$row["Id_Pomieszczenia{$i}"] : '';
                                $klasy[$i][] = !empty($row["Numer_klasy"]) ? "Klasa: ".$row["Numer_klasy"] : '';
                            }
                        }
                    }
                    if ($dzien == reset($dni_do_wyswietlenia)) {
                        echo "<tr><th></th>";
                        for ($i = 1; $i <= 8; $i++) {
                            echo "<th>Lekcja $i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "<tr id='trrow'><th>$dzien</th>";
                    for ($i = 1; $i <= 8; $i++) {
                        $id = 'komorka'.$i;
                        echo "<th id='$id'>";
                        if (!empty($lekcje[$i])) {
                            foreach ($lekcje[$i] as $key => $nazwa) {
                                echo $nazwa;
                                if (!empty($sale[$i][$key])) {
                                    echo "<br>" . $sale[$i][$key];
                                }
                                if (!empty($klasy[$i][$key])) {
                                    echo "<br>" . $klasy[$i][$key];
                                }
                                if ($key < count($lekcje[$i]) - 1) {
                                    echo "<a class='separator'>";
                                }
                            }
                        }
                        echo "</th>";
                    }
                    echo "</tr>";
                } else {
                    echo "Nie wyswietlono";
                    echo mysqli_error($conn);
                }
            }
            echo "</table>";
        }
    ?>
    
 
</body>
</html>
