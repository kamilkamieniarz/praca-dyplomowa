<?php
require_once 'login_check.php';
require_once 'connection.php';
$filter='id';
$table= array();
$i=0;
//ustalanie ORDER BY($filter)
if($_GET['filter'] != 'undefined'){$filter=$_GET['filter'];};
//ustalanie nazwy tabeli
$what_filter=$_GET['what_show'];

//TYLKO W PRZYPADKU USŁUGODAWCÓW AKTUALIZACJA ŚREDNIEJ WAŻONEJ
if($what_filter=='services'){
    //sprawdzanie i zmiana wagi ocen względem daty wystawienia oceny
    $query = mysqli_query($conn,"UPDATE ratings SET weight = weight-0.3, added_date = CURRENT_TIMESTAMP WHERE DATEDIFF(CURRENT_TIMESTAMP,added_date)>=30 AND weight>0.1");
    if($query){}
    //sprawdzanie liczby usługodawców
    $count = mysqli_query($conn,"SELECT COUNT(id) FROM services");
    //obliczanie i aktualizacja średnich ważonych
    $query = mysqli_query($conn,"SELECT s.id, CAST(SUM(r.rating*r.weight)/SUM(r.weight) as DECIMAL(65,2)) as average_rating FROM ratings as r INNER JOIN services as s ON s.id = r.services_id GROUP BY services_id");
    while($row = mysqli_fetch_array($query)){
            $id_services = $row[0];
            $average_rating = $row[1];
            $update = mysqli_query($conn,"UPDATE services SET average_rating = $average_rating WHERE id = $id_services");
            if($update){};
    }
}

//przycinanie s z nazwy tabeli aby wiedzieć której klasy użyć oraz ucfirst aby powiększyć pierwsza litere
$class = ucfirst(substr($what_filter,0,-1));
require_once 'class/'.$class.'.php';
//pobieranie listy kolumn
$columns = mysqli_query($conn,"SHOW COLUMNS FROM $what_filter");
while($row = mysqli_fetch_array($columns)){
    //pomijanie kolumny password
    if($row[0]!='password'){
        $table[0][$i]=$row[0]; //nazwa tabeli
        $table_name = $table[0][$i]; //wyciągnięcię wartości z tabeli do zmiennej bo polecenie SELECT nie przepuszcza tabeli
        $result = mysqli_query($conn, "SELECT $table_name FROM $what_filter ORDER BY $filter");
        $j=0;
        while($row_objects = mysqli_fetch_array($result)){
            //tłumaczenia z id na nazwy
            switch($table_name){
                case 'role':
                        $row_objects[0] == '1' ? $table_objects[$j][$i] = 'Szef' : $table_objects[$j][$i] = 'Pracownik';
                    break;
                case 'creator_id':
                    $res = mysqli_query($conn,"SELECT name, surname FROM users WHERE id='".$row_objects[0]."'");
                    if($res){while($row1 = mysqli_fetch_array($res)){$row_objects[0] = $row1['0'].' '.$row1['1'];$table_objects[$j][$i] = $row_objects[0];}}
                    break;
                case 'user_id':
                    $res = mysqli_query($conn,"SELECT name, surname FROM users WHERE id='".$row_objects[0]."'");
                    if($res){while($row1 = mysqli_fetch_array($res)){$row_objects[0] = $row1['0'].' '.$row1['1'];$table_objects[$j][$i] = $row_objects[0];}}
                    break;
                case 'category':
                    $res = mysqli_query($conn,"SELECT name FROM categories WHERE id='".$row_objects[0]."'");
                    if($res){while($row1 = mysqli_fetch_array($res)){$row_objects[0] = $row1['0'];$table_objects[$j][$i] = $row_objects[0];}}
                    break;
                case 'client_id':
                    $res = mysqli_query($conn,"SELECT name, surname FROM clients WHERE id='".$row_objects[0]."'");
                    if($res){while($row1 = mysqli_fetch_array($res)){$row_objects[0] = $row1['0'];$table_objects[$j][$i] = $row_objects[0];}}
                    break;
                default:
                    $table_objects[$j][$i] = $row_objects[0];
                    break;
            }
            $j++;
        }
        $i++;
    }
}
//wyświetlanie nazw kolumn
echo "<table id=".$what_filter." class='table text-left'><tr >";
for ($i=0; $i < count(current($table)); $i++) {
    echo "<th class='blue' id='".$table[0][$i]."' onclick='filter_icon(this.id,this.id)'>".$table[0][$i]."</th>";
    if( (count(current($table))-$i) == 1 ){echo "<th class='blue' id='edit'>Opcje</th>";}
}

//TYLKO W PRZYPADKU ZDJĘĆ
if($what_filter == 'images'){
    //wyświetlanie wszystkich obiektów
    echo "</tr>";
    for ($i=0; $i < count($table_objects); $i++) {
        //co drugi wiersz jest niebieski
        if($i%2 == 0){echo "<tr>";}else{echo "<tr class='info'>";}
        for ($j=0; $j < count(current($table)); $j++) { 
            if($j==4){echo"<td><a href='".$table_objects[$i][$j]."'><img src='".$table_objects[$i][$j]."' width='100' height='100'></a></td>";}
            else{echo"<td>".$table_objects[$i][$j]."</td>";}
        }
        echo"<td><button class='btn btn-warning' onclick=\"edit('".$what_filter."','".$table_objects[$i][0]."')\">Edytuj</button><button class='btn btn-danger' onclick=\"del('".$what_filter."','".$table_objects[$i][0]."')\">Usuń</button></td>
        </tr>";
    }
}
else{
    //wyświetlanie wszystkich obiektów
    echo "</tr>";
    for ($i=0; $i < count($table_objects); $i++) {
        //co drugi wiersz jest niebieski
        if($i%2 == 0){echo "<tr>";}else{echo "<tr class='info'>";}
        for ($j=0; $j < count(current($table)); $j++) { 
            echo"<td>".$table_objects[$i][$j]."</td>";
        }
        echo"<td><button class='btn btn-warning' onclick=\"edit('".$what_filter."','".$table_objects[$i][0]."')\">Edytuj</button><button class='btn btn-danger' onclick=\"del('".$what_filter."','".$table_objects[$i][0]."')\">Usuń</button></td>
        </tr>";
    }
}
?>