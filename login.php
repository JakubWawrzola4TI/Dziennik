<?php
session_start();

// Sprawdź, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Połączenie z bazą danych
    $DBHOST = "localhost";
    $DBUSER = "admin";
    $DBPASS = "admin";
    $DBNAME = "dziennik3";
    $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

    // Pobranie danych z formularza
    $login = $_POST['username'];
    $password = $_POST['password'];

    // Zapytanie SQL do sprawdzenia danych logowania dla nauczyciela
    $query_teacher = "SELECT Id_nauczyciela FROM nauczyciele WHERE Login='$login' AND Haslo='$password'";
    $result_teacher = mysqli_query($conn, $query_teacher);

    // Sprawdzenie czy użytkownik jest nauczycielem
    if (mysqli_num_rows($result_teacher) == 1) {
        $row = mysqli_fetch_assoc($result_teacher);
        $user_id = $row['Id_nauczyciela'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = 'nauczyciel'; // Ustawienie roli nauczyciela
        session_write_close();
        header("Location: nauczyciel/index.php");
        exit();
    }

    // Zapytanie SQL do sprawdzenia danych logowania dla ucznia
    $query_student = "SELECT Id_ucznia FROM uczniowie WHERE Login='$login' AND Haslo='$password'";
    $result_student = mysqli_query($conn, $query_student);

    // Sprawdzenie czy użytkownik jest uczniem
    if (mysqli_num_rows($result_student) == 1) {
        $row = mysqli_fetch_assoc($result_student);
        $user_id = $row['Id_ucznia'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = 'uczen'; // Ustawienie roli ucznia
        session_write_close();
        header("Location: uczen/index.php?user_id=$user_id");
        exit();
    }

    // Zapytanie SQL do sprawdzenia danych logowania dla rodzica
    $query_parent = "SELECT Id_rodzica FROM rodzice WHERE Login='$login' AND Haslo='$password'";
    $result_parent = mysqli_query($conn, $query_parent);
    
    // Sprawdzenie czy użytkownik jest rodzicem
    if (mysqli_num_rows($result_parent) == 1) {
        $row = mysqli_fetch_assoc($result_parent);
        $user_id = $row['Id_rodzica'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = 'rodzic'; // Ustawienie roli rodzica
        session_write_close();

        $sql = "SELECT Id_ucznia FROM uczniowie WHERE Id_rodzica = '$user_id'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $id_ucznia_zmienna = $row['Id_ucznia'];

            // Sprawdzenie ilości uczniów przypisanych do rodzica
                $query_students = "SELECT COUNT(Id_ucznia) AS num_students FROM uczniowie WHERE Id_rodzica = '$user_id'";
                $result_students = mysqli_query($conn, $query_students);
                $row_students = mysqli_fetch_assoc($result_students);
                $num_students = $row_students['num_students'];
                
                if ($num_students == 1) {
                    header("Location: rodzic/index.php?user_id=$id_ucznia_zmienna&parent_id=$user_id");

                } else {
                    // Rodzic jest przypisany do wielu uczniów
                    header("Location: rodzic/wybor_ucznia.php?user_id=$user_id");
                }

        exit();
    }


    $error = "Nieprawidłowy login lub hasło. Spróbuj ponownie.";
    // Przekierowanie z powrotem do strony logowania w przypadku błędnych danych
    header("Location: logowanie.html?error=1");



    exit();
}
?>
