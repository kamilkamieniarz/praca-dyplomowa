<?php
    require_once 'login_check.php';
    require_once 'connection.php';
    switch($_GET['what_add']){
        case 'users':
            $login = $_POST['login'];$role = $_POST['role'];$name = $_POST['name'];$surname = $_POST['surname']; $city = $_POST['city']; $post_code = $_POST['post_code']; $street = $_POST['street']; $number = $_POST['number']; $apartment = $_POST['apartment'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);    
            $query = mysqli_query($conn,"INSERT INTO users (login, password, role, name, surname, city, post_code, street, number, apartment) VALUES ('$login','$password','$role','$name','$surname','$city','$post_code','$street','$number','$apartment')");
            break;
        case 'task':
            $name = $_POST['name'];$description = $_POST['description'];$category = $_POST['category'];$user_id = $_POST['user_id']; $client_id = $_POST['client_id']; $creator_id = $_POST['creator_id'];
            $query = mysqli_query($conn,"INSERT INTO tasks (name, description, category, creator_id, user_id, client_id) VALUES ('$name','$description','$category','$creator_id','$user_id','$client_id')");
            break;
        case 'client':
            $name = $_POST['name'];$surname = $_POST['surname'];$company = $_POST['company'];$nip = $_POST['nip'];$description = $_POST['description'];$city = $_POST['city'];$post_code = $_POST['post_code'];$street = $_POST['street'];$number = $_POST['number'];$apartment = $_POST['apartment'];$category = $_POST['category'];$creator_id = $_POST['creator_id']; 
            $query = mysqli_query($conn,"INSERT INTO clients (name, surname, company,nip, description, city, post_code, street, number, apartment, category, creator_id) VALUES ('$name', '$surname','$company','$nip','$description','$city','$post_code','$street','$number','$apartment','$category','$creator_id')");
            break;
        case 'service':
            $company = $_POST['company'];$service = $_POST['service'];$nip = $_POST['nip'];$description = $_POST['description'];$city = $_POST['city'];$post_code = $_POST['post_code'];$street = $_POST['street'];$number = $_POST['number'];$apartment = $_POST['apartment'];$creator_id = $_POST['creator_id']; 
            $query = mysqli_query($conn,"INSERT INTO services (company, service, nip, description, city, post_code, street, number, apartment, creator_id) VALUES ('$company','$service','$nip','$description','$city','$post_code','$street','$number','$apartment','$creator_id')");
            break;
        case 'images':
            $title = $_POST['title'];$description = $_POST['description'];$alt = $_POST['alt'];$url = $_POST['adress'];$creator_id = $_POST['creator_id']; 
            $query = mysqli_query($conn,"INSERT INTO images (title, description, alt, url, creator_id) VALUES ('$title','$description','$alt','$url','$creator_id')");
            break;
        case 'rating':
            $rating = $_POST['rating'];$services_id = $_POST['services_id'];$creator_id = $_POST['creator_id'];
            $query = mysqli_query($conn,"INSERT INTO ratings (rating, services_id, creator_id) VALUES ('$rating','$services_id','$creator_id')");
            //AKTUALIZACJA ŚREDNIEJ WAŻONEJ
            if($query){
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
            break;
        
        default:
            echo "Błąd w add_insert na switchu";
            break;
    }
    $array = array();
    if ($query) {
        $array[0] = '0';
    } 
    else {
        $array[0] = '1';
    }
    echo json_encode($array);
    mysqli_close($conn);
        ?>