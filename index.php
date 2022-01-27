<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Logowanie</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body>
<?php
    session_start();
    if(isset($_SESSION['login'])){
        header("Location: dashboard.php");
    }
    else{
        if(isset($_POST["submit"])){
            if(isset($_POST['login'])){
                if(isset($_POST['password'])){
                    //połączenie z bazą danych
                    require_once "connection.php";
                    $login = $_POST['login'];
                    $password = $_POST['password'];
                    $result = mysqli_query($conn,"SELECT password FROM users WHERE login = '$login'");
                    if($result){
                        while($row=mysqli_fetch_row($result)){
                            $password2=$row['0'];
                        }
                        mysqli_close($conn);
                        if(isset($password2)){
                            if(password_verify($password,$password2) == TRUE){
                                header("Location: dashboard.php");
                                $_SESSION['login'] = $login;
                            }
                            else{
                                echo "Błędne hasło";
                            }
                        }
                        else{
                            echo " Błędny login";
                        }
                    }
                    else {
                        echo "Błędny login";
                    }
                }
                else{echo "Podaj hasło";}
            }
            else{echo "Podaj login";}
        }
    }
?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Login Form -->
    <form method="POST">
        <input type="text"  class="fadeIn first" name="login" placeholder="Podaj login">
        <input type="password" name="password"  class="fadeIn second" placeholder="Podaj hasło">
        <input type="submit" name="submit"  class="fadeIn third" value="Zaloguj">
    </form>
  </div>
</div>

</body>
</html>