<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Grafiki</title>
</head>

<body>
    <?php
        require_once "menu.php";

        if(isset($_POST['wyszukaj'])){
        //super wyszukiwanie zdjęć po kategorii   
        }

        if(isset($_POST['dodaj'])){
        //super dodawanie zdjęć do galerii
        }

    ?>

    <form method="POST" name="search">
        Kategoria</br>
        <select name="category">
            <option></option>
            <?php
                $result = mysqli_query($conn,"SELECT id, name FROM categories");
                if($result){
                    while($row=mysqli_fetch_row($result)){
                        echo "<option value='".$row['0']."'>".$row['1']."</option>";
                    }
                }
            ?>
        </select></br>
        <input type='submit' name='wyszukaj' value='Wyszukaj'/>
    </form>

    <form method="POST" name="add">
                
    </form>

</body>
</html>