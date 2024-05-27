<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" type="text/css" href="ramka.css">
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
    echo $dzien_tygodnia;
    echo '<br>';
    echo $user_id;
    ?>
</body>

</html>