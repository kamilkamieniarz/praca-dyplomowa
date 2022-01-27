<?php
require_once 'login_check.php';
require_once 'connection.php';
switch($_GET['what_add']){
    case "users":
        //workers
        echo '<form method="POST" id="form_worker">
            <input type="text" class="form-control" name="login" id="login" placeholder="Login"></br>
            <input type="text" class="form-control" name="text" id="password" placeholder="Hasło"></br>
            <label class="form-label">Admin?</label>
            <select  class="form-control"name="role" id="role">
                <option value="0">NIE</option>
                <option value="1">TAK</option>
            </select></br>
            <input type="text" class="form-control" name="name" id="name" placeholder="Imie"></br>
            <input type="text" class="form-control" name="surname" id="surname" placeholder="Nazwisko"></br>
            <input type="text" class="form-control" name="city" id="city" placeholder="Miejscowość"></br>
            <input type="text" class="form-control" name="post_code" id="post_code" placeholder="Kod pocztowy"></br>
            <input type="text" class="form-control" name="street" id="street" placeholder="Ulica"></br>
            <input type="text" class="form-control" name="number" id="number" placeholder="Numer budynku"></br>
            <input type="text" class="form-control" name="apartment" id="apartment" placeholder="Numer lokalu"></br>
            <input type="button" class="btn" id="add_worker" onclick="insert(\'users\')" value="Dodaj pracownika">
        </form>';
        break;
    case 'tasks':
        //task
        echo '<form method="POST" id="form_task">
            <input type="text" class="form-control" name="name" id="name" placeholder="Nazwa Zadania"></br>
            <input type="text" class="form-control" name="description" id="description" placeholder="Opis zadania"></br>
            <label class="form-label">Kategoria</label>
            </br><select class="form-control" name="category" id="category">
                <option value=""></option>
                <option value="1">Finansowe</option>
                <option value="2">Kosmetyczne</option>
                <option value="3">Informatyczne</option>
                <option value="4">Samochodowe</option>
                <option value="5">Sporotwe</option>
                <option value="6">Elektryczne</option>
            </select></br>
            <label class="form-label">Komu przydzielić zadanie (pracownik)</label>
            </br><select class="form-control" name="user_id" id="user_id">
                <option value=""></option>';
                    $result = mysqli_query($conn,"SELECT id, name, surname FROM users");
                    if($result){
                        while($row=mysqli_fetch_row($result)){
                            echo "<option value='".$row['0']."'>".$row['1']." ".$row['2']."</option>";
                        }
                    }
            echo '</select></br>
            <label class="form-label">Kogo dotyczy zadanie (klient)</label>
            </br><select class="form-control" name="client_id" id="client_id">
                <option value=""></option>';
                    $result = mysqli_query($conn,"SELECT id, name, surname FROM clients");
                    if($result){
                        while($row=mysqli_fetch_row($result)){
                            echo "<option value='".$row['0']."'>".$row['1']." ".$row['2']."</option>";
                        }
                    }
            echo '</select></br></br>
            <input type="button" class="btn" id="add_task" onclick="insert(\'task\')" value="Przydziel zadanie">
        </form>';
        break;
    case 'clients':
        // client
        echo '<form method="POST" id="form_client">
            <input type="text" class="form-control" name="name" id="name" placeholder="Imie"></br>
            <input type="text" class="form-control" name="surname" id="surname" placeholder="Nazwisko"></br>
            <input type="text" class="form-control" name="company" id="company" placeholder="Firma"></br>
            <input type="number" class="form-control" name="nip" id="nip" placeholder="NIP"></br>
            <input type="text" class="form-control" name="description" id="description" placeholder="Opis"></br>
            <input type="text" class="form-control" name="city" id="city" placeholder="Miejscowość"></br>
            <input type="text" class="form-control" name="post_code" id="post_code" placeholder="Kod pocztowy"></br>
            <input type="text" class="form-control" name="street" id="street" placeholder="Ulica"></br>
            <input type="text" class="form-control" name="number" id="number" placeholder="Numer budynku"></br>
            <input type="text" class="form-control" name="apartment" id="apartment" placeholder="Numer lokalu"></br>
            <label class="form-label">Kategoria</label>
            </br><select class="form-control" name="category" id="category">
                <option value=""></option>
                <option value="1">Finansowe</option>
                <option value="2">Kosmetyczne</option>
                <option value="3">Informatyczne</option>
                <option value="4">Samochodowe</option>
                <option value="5">Sporotwe</option>
                <option value="6">Elektryczne</option>
            </select></br>
            <input type="button" class="btn" id="add_client"onclick="insert(\'client\')" value="Dodaj klienta">
        </form>';
        break;
    case 'services':
        // usługi
        echo '<form method="POST" id="form_service">
            <input type="text" class="form-control" name="company" id="company" placeholder="Firma"></br>
            <label class="form-label">Usługa</label>
            </br><select class="form-control" name="service" id="service">
                <option value=""></option>
                <option value="Drukarnia">Drukarnia</option>
                <option value="Reklamodawca">Reklamodawca</option>
            </select></br>
            <input type="number" class="form-control" name="nip" id="nip" placeholder="NIP"></br>
            <input type="text" class="form-control" name="description" id="description" placeholder="Opis"></br>
            <input type="text" class="form-control" name="city" id="city" placeholder="Miejscowość"></br>
            <input type="text" class="form-control" name="post_code" id="post_code" placeholder="Kod pocztowy"></br>
            <input type="text" class="form-control" name="street" id="street" placeholder="Ulica"></br>
            <input type="text" class="form-control" name="number" id="number" placeholder="Numer budynku"></br>
            <input type="text" class="form-control" name="apartment" id="apartment" placeholder="Numer lokalu"></br>
            <input type="button" class="btn" id="add_service"onclick="insert(\'service\')" value="Dodaj usługę">
        </form>';
        break;
    case 'ratings':
        //oceny
        echo '<form method="POST" id="form_rating">
            <label class="form-label">Ocena (0-5)</label>
            <input type="number" step="1" min="1" max="5" class="form-control" name="rating" id="rating" placeholder=""></br>
            <label class="form-label">Komu wystawiasz ocenę</label>
            </br><select class="form-control" name="services_id" id="services_id">
                <option value=""></option>';
                    $result = mysqli_query($conn,"SELECT id, company FROM services");
                    if($result){
                        while($row=mysqli_fetch_row($result)){
                            echo "<option value='".$row['0']."'>".$row['1']."</option>";
                        }
                    }
            echo '</select></br>
            <input type="button" class="btn" id="add_rating" onclick="insert(\'rating\')" value="Wystaw ocenę">
        </form>';
        break;
        //grafiki
    case 'images':
        echo '<form method="POST" id="form_images">
            <label class="form-label">Tytuł</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Tytuł"></br>
            <label class="form-label">Opis</label>
            <input type="text" class="form-control" name="description" id="description"placeholder="Opis"></br>
            <label class="form-label">Alteratywny tekst</label>
            <input type="text" class="form-control" name="alt" id="alt" placeholder="Alternatywny tekst"></br>
            <label class="form-label">Adres url</label>
            <input type="text" class="form-control" name="adress" id="adress" placeholder="Adres url"></br>
            <input type="button" class="btn" id="add_images"onclick="insert(\'images\')" value="Dodaj grafikę">
        </form>';
        break;
    default:
        echo "Błąd w add_form na switchu";
        break;
}
?>