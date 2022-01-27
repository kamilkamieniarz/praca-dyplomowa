<?php
    require_once 'login_check.php';
    require_once "connection.php";
?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://kit.fontawesome.com/43ada936c8.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><b><?php echo $_SESSION['login']?></b></h1></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Wyloguj</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php">Start</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Klienci <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li><a href="#" onclick="add('clients')">Dodaj Klienta</a></li>
                        <li><a href="#" onclick="show('clients')">Wszyscy Klienci</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usługi <b class="caret"></b></a>
                    <ul class="dropdown-menu">  
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Drukarnie i Reklamodawcy</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="add('ratings')">Wystaw ocenę</a></li>
                                <li><a href="#" onclick="add('services')">Dodaj Usługę</a></li>
                                <li><a href="#" onclick="show('services')">Wszystkie Usługi</a></li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grafiki</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="add('images')">Dodaj grafikę</a></li>
                                <li><a href="#" onclick="show('images')">Wszystkie grafiki</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#" onclick="show('tasks')">Zadania</a></li>
                <!-- admin -->
                <?php
                    $login = $_SESSION['login'];
                    $result = mysqli_query($conn,"SELECT role, id FROM users WHERE login = '$login'");
                    if($result){
                        while($row=mysqli_fetch_row($result)){
                            $role=$row['0'];
                            $id=$row['1'];
                        }
                        if(isset($role)){
                            if($role == 1){
                                echo '
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                                    <ul class="dropdown-menu">  
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pracownicy</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" onclick="add(\'users\')">Dodaj Pracownika</a></li>
                                                <li><a href="#" onclick="show(\'users\')">Wszyscy Pracownicy</a></li>
                                            </ul>
                                        </li>
                                        <li class="divider"></li>

                                        <li><a href="#" onclick="add(\'tasks\')">Przydziel Zadanie</a></li>
                                    </ul>
                                </li>';
                            }
                        }
                    }
                ?>
                <!-- admin end -->
            </ul>
        </div>
    </div>
</div>