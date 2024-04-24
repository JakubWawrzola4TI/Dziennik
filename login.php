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
        header("Location: nauczyciel/index.html");
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
        header("Location: rodzic/index.php?");
        exit();
    }
    $error = "Nieprawidłowy login lub hasło. Spróbuj ponownie.";
    // Przekierowanie z powrotem do strony logowania w przypadku błędnych danych
    header("Location: logowanie.html?error=1");
    exit();
}
?>
