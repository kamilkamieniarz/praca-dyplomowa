<?php
require_once 'login_check.php';
require_once 'connection.php';
$table = $_GET['table'];
$id = $_GET['id'];
$query = mysqli_query($conn,"DELETE FROM $table WHERE id=$id");
if($query){
    echo "Pomyślnie usunięto";
}
else {
    echo "Nie udało się usunąć";
}

?>