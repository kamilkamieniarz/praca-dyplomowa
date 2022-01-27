<?php
    require_once 'login_check.php';
    require_once 'connection.php';
    $id = $_GET['id'];
    switch($_GET['what_edit']){
        case 'users':
            $login = $_POST['login'];$role = $_POST['role'];$name = $_POST['name'];$surname = $_POST['surname']; $city = $_POST['city']; $post_code = $_POST['post_code']; $street = $_POST['street']; $number = $_POST['number']; $apartment = $_POST['apartment']; 
            $query = mysqli_query($conn,"UPDATE users SET `login`='$login',`role`='$role',`name`='$name',`surname`='$surname',`city`='$city',`post_code`='$post_code',`street`='$street',`number`='$number',`apartment`='$apartment' WHERE id=$id");
            break;
        case 'tasks':
            $name = $_POST['name'];$description = $_POST['description'];$category = $_POST['category'];
            $query = mysqli_query($conn,"UPDATE tasks SET `name`='$name',`description`='$description',`category`='$category' WHERE id=$id");
            break;
        case 'clients':
            $name = $_POST['name'];$surname = $_POST['surname'];$company = $_POST['company'];$nip = $_POST['nip'];$description = $_POST['description'];$city = $_POST['city'];$post_code = $_POST['post_code'];$street = $_POST['street'];$number = $_POST['number'];$apartment = $_POST['apartment'];$category = $_POST['category'];
            $query = mysqli_query($conn,"UPDATE clients SET `name`='$name',`surname`='$surname',`company`='$company',`nip`='$nip',`description`='$description', `city`='$city', `post_code`='$post_code', `street`='$street', `number`='$number', `apartment`='$apartment', `category`='$category' WHERE id=$id");
            break;
        case 'services':
            $company = $_POST['company'];$service = $_POST['service'];$nip = $_POST['nip'];$description = $_POST['description'];$city = $_POST['city'];$post_code = $_POST['post_code'];$street = $_POST['street'];$number = $_POST['number'];$apartment = $_POST['apartment']; 
            $query = mysqli_query($conn,"UPDATE services SET `company`='$company', `service`='$service', `nip`='$nip', `description`='$description', `city`='$city', `post_code`='$post_code', `street`='$street', `number`='$number', `apartment`='$apartment' WHERE id=$id");
            break;
        case 'images':
            $title = $_POST['title'];$description = $_POST['description'];$alt = $_POST['alt'];$url = $_POST['adress'];
            $query = mysqli_query($conn,"UPDATE images SET `title`='$title', `description`='$description', `alt`='$alt', `url`='$url' WHERE id=$id");
            break;
        default:
            echo "Błąd w edit_update na switchu";
            break;
    }
    $array = array();
    if ($query) {
        $array[0] = '0';
    } 
    else {
        echo $conn -> error;
        $array[0] = '1';
    }
    echo json_encode($array);
    mysqli_close($conn);
        ?>