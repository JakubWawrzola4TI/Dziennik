<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="wybor_ucznia.css">
</head>
<body>

    <header>
        <h1>Wybierz ucznia:</h1>
    </header>

    <div class="lista">
        <?php
        $conn = mysqli_connect("localhost", "admin", "admin", "dziennik3");
        if (!$conn) {
            die("Connection failed: ". mysqli_connect_error());
        }
        $user_id = $_GET['user_id'];
        $query_students = "SELECT Id_ucznia, imie, nazwisko FROM uczniowie WHERE Id_rodzica = '$user_id'";
        $result_students = mysqli_query($conn, $query_students);
        if (!$result_students) {
            die("Database query failed: ". mysqli_error($conn));
        }
        $num_students = mysqli_num_rows($result_students);
        echo "<ul>";
            for ($i = 0; $i <= $num_students; $i++) {
                $row_students = mysqli_fetch_assoc($result_students);
                if ($row_students) {
                    echo "<li ><a href='index.php?parent_id=$user_id&user_id=". $row_students['Id_ucznia']. "' class='href'>". $row_students['imie']. " ". $row_students['nazwisko']. "</a></li>";
                }
            }
            echo "</ul>";
        mysqli_close($conn);
        ?>
    </div>

</body>
</html>