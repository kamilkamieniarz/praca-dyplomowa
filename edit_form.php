<?php
require_once 'login_check.php';
require_once 'connection.php';
$id=$_GET['id'];
$what_edit = $_GET['what_edit'];
$query = mysqli_query($conn,"SELECT * FROM $what_edit WHERE id=$id");
while($row = mysqli_fetch_array($query)){
    switch($what_edit){
        case "users":
            //workers
            echo '<form method="POST" id="form_worker">
                <input type="text" class="form-control" name="login" id="login" value="'.$row[1].'" placeholder="Login"></br>
                <label class="form-label">Admin?</label>
                <select  class="form-control"name="role" id="role">
                    <option value='.$row[3].'></option>
                    <option value="0">NIE</option>
                    <option value="1">TAK</option>
                </select></br>
                <input type="text" class="form-control" name="name" id="name" value="'.$row[4].'" placeholder="Imie"></br>
                <input type="text" class="form-control" name="surname" id="surname" value="'.$row[5].'" placeholder="Nazwisko"></br>
                <input type="text" class="form-control" name="city" id="city" value="'.$row[6].'" placeholder="Miejscowość"></br>
                <input type="text" class="form-control" name="post_code" id="post_code" value="'.$row[7].'" placeholder="Kod pocztowy"></br>
                <input type="text" class="form-control" name="street" id="street" value="'.$row[8].'" placeholder="Ulica"></br>
                <input type="text" class="form-control" name="number" id="number" value="'.$row[9].'" placeholder="Numer budynku"></br>
                <input type="text" class="form-control" name="apartment" id="apartment" value="'.$row[10].'" placeholder="Numer lokalu"></br>
                <input type="button" class="btn" id="add_worker" onclick="edition(\'users\',\''.$id.'\')" value="Edytuj pracownika">
            </form>';
            break;
        case 'tasks':
            //task
            echo '<form method="POST" id="form_task">
                <input type="text" class="form-control" name="name" id="name" value="'.$row[1].'" placeholder="Nazwa zadania"></br>
                <input type="text" class="form-control" name="description" id="description" value="'.$row[2].'" placeholder="Opis zadania"></br>
                <label class="form-label">Kategoria</label>
                </br><select class="form-control" name="category" id="category">
                    <option value='.$row[3].'></option>
                    <option value="1">Finansowe</option>
                    <option value="2">Kosmetyczne</option>
                    <option value="3">Informatyczne</option>
                    <option value="4">Samochodowe</option>
                    <option value="5">Sporotwe</option>
                    <option value="6">Elektryczne</option>
                </select></br>
                <input type="button" class="btn" id="add_task" onclick="edition(\'task\',\''.$id.'\')" value="Edytuj zadanie">
            </form>';
            break;
        case 'clients':
            // client
            echo '<form method="POST" id="form_client">
                <input type="text" class="form-control" name="name" id="name" value="'.$row[1].'" placeholder="Imie"></br>
                <input type="text" class="form-control" name="surname" id="surname" value="'.$row[2].'" placeholder="Nazwisko"></br>
                <input type="text" class="form-control" name="company" id="company" value="'.$row[3].'" placeholder="Firma"></br>
                <input type="number" class="form-control" name="nip" id="nip" value="'.$row[4].'" placeholder="NIP"></br>
                <input type="text" class="form-control" name="description" id="description" value="'.$row[5].'" placeholder="Opis"></br>
                <input type="text" class="form-control" name="city" id="city" value="'.$row[6].'" placeholder="Miejscowość"></br>
                <input type="text" class="form-control" name="post_code" id="post_code" value="'.$row[7].'" placeholder="Kod pocztowy"></br>
                <input type="text" class="form-control" name="street" id="street" value="'.$row[8].'" placeholder="Ulica"></br>
                <input type="text" class="form-control" name="number" id="number" value="'.$row[9].'" placeholder="Numer budynku"></br>
                <input type="text" class="form-control" name="apartment" id="apartment" value="'.$row[10].'" placeholder="Numer lokalu"></br>
                <label class="form-label">Kategoria</label>
                </br><select class="form-control" name="category" id="category">
                    <option value="'.$row[11].'"></option>
                    <option value="1">Finansowe</option>
                    <option value="2">Kosmetyczne</option>
                    <option value="3">Informatyczne</option>
                    <option value="4">Samochodowe</option>
                    <option value="5">Sporotwe</option>
                    <option value="6">Elektryczne</option>
                </select></br>
                <input type="button" class="btn" id="add_client"onclick="edition(\'client\',\''.$id.'\')" value="Edytuj klienta">
            </form>';
            break;
        case 'services':
            // usługi
            echo '<form method="POST" id="form_service">
                <input type="text" class="form-control" name="company" id="company" value="'.$row[1].'" placeholder="Firma"></br>
                <label class="form-label">Usługa</label>
                </br><select class="form-control" name="service" id="service">
                    <option value="'.$row[2].'"></option>
                    <option value="Drukarnia">Drukarnia</option>
                    <option value="Reklamodawca">Reklamodawca</option>
                </select></br>
                <input type="number" class="form-control" name="nip" id="nip" value="'.$row[4].'" placeholder="NIP"></br>
                <input type="text" class="form-control" name="description" id="description" value="'.$row[5].'" placeholder="Opis"></br>
                <input type="text" class="form-control" name="city" id="city" value="'.$row[6].'" placeholder="Miejscowość"></br>
                <input type="text" class="form-control" name="post_code" id="post_code" value="'.$row[7].'" placeholder="Kod pocztowy"></br>
                <input type="text" class="form-control" name="street" id="street" value="'.$row[8].'" placeholder="Ulica"></br>
                <input type="text" class="form-control" name="number" id="number" value="'.$row[9].'" placeholder="Numer budynku"></br>
                <input type="text" class="form-control" name="apartment" id="apartment" value="'.$row[10].'" placeholder="Numer lokalu"></br>
                <input type="button" class="btn" id="add_service"onclick="edition(\'service\',\''.$id.'\')" value="Edytuj usługę">
            </form>';
            break;
        case 'images':
            echo '<form method="POST" id="form_images">
                <label class="form-label">Tytuł</label>
                <input type="text" class="form-control" name="title" id="title" value="'.$row[1].'" placeholder="Tytuł"></br>
                <label class="form-label">Opis</label>
                <input type="text" class="form-control" name="description" id="description" value="'.$row[2].'" placeholder="Opis"></br>
                <label class="form-label">Alteratywny tekst</label>
                <input type="text" class="form-control" name="alt" id="alt" value="'.$row[3].'" placeholder="Alternatywny tekst"></br>
                <label class="form-label">Adres url</label>
                <input type="text" class="form-control" name="adress" id="adress" value="'.$row[4].'" placeholder="Adres url"></br>
                <input type="button" class="btn" id="add_images"onclick="edition(\'images\',\''.$id.'\')" value="Edytuj grafikę">
            </form>';
            break;
        default:
            echo "Błąd w edit_form na switchu";
            break;
    }
}
?>