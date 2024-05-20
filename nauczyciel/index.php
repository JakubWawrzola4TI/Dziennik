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
    
    <main>
        <plan-nauczyciela class="plan" id="plan">
            <?php 
                $sql_IDLekcji = 'SELECT Id';
            
            ?>
        </plan-nauczyciela>
    </main>








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
    
    
</body>
</html>
