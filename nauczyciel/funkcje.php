<?php

    //Zwraca dzisiejszy dzień tygodnia
        function dzisiejszy_dzien_tygodnia() { 
            setlocale(LC_TIME, 'pl_PL.utf8');                
            $dzisiaj = date("Y-m-d");             
            $nazwa_dnia = strftime("%A", strtotime($dzisiaj));
            $nazwa_dnia = date("l"); 
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
                $nazwa_dnia_pl = "Weekend";
            } else if ($nazwa_dnia === "Sunday") {
                $nazwa_dnia_pl = "Weekend";
            } else {
                $nazwa_dnia_pl = "Nieznany dzień";
            }
            return $nazwa_dnia_pl;
    } 

    //Zmienne bazy danych
    $DBHOST = "localhost";
    $DBUSER = "admin";
    $DBPASS = "admin";
    $DBNAME = "dziennik3";
    $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);



?>