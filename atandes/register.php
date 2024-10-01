<?php
include_once "oop.php";
if (!isset($_SESSION['name'])) {
    echo"<script>window.alert('please login first!');window.location.href='adminlogin.php'</script>";
}

$sql= new oop() ;
$data = new oop() ; 
$row=$data->select("`c_id`,`class_name`","atendes_class","1");
$classdata = $row->get_result();
$count=$classdata->num_rows ;
if ($_SERVER['REQUEST_METHOD']==="POST") {
    $name =$_POST['username'];
    $cart=$_POST['cart'];
    $class=$_POST['class'];
    if ($class === "0") {
        echo"<script>window.alert('please insert the class!');window.location.href='register_class.php'</script>";
        exit();
    }
    $stmt=$sql->select("`au_id`","`atendes_user`","`username`='$name'");
    $result=$stmt->get_result();
    if ($result-> num_rows === 0 ) {
        $stmt1=$sql->insertuser($name,$cart,$class);
        echo"<script>window.alert('Insert user successful!');window.location.href='register.php'</script>";
        exit();
    }else{
        echo "<script>window.alert('this username have been used !')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h1>Register new account</h1>
        <label for="">Username:</label><br>
        <input type="text" name="username" autofocus><br>
        <label for="">Cart_code:</label><br>
        <input type="text" name="cart" ><br>
        <label for="">Class :</label><br>
        <select name="class" id="">
        <?php 
            if ($count === 0 ){
                echo "<option value='0'>Not class can be selected</option>";
            }else{
                while ($rows = $classdata->fetch_assoc()) {
                    echo "<option value=".$rows['c_id'].">".$rows['class_name']."</option>";
                }
            }
        ?>
        </select>
        <button type="submit">Submit</button>
        <a href="show.php"><button type="button">Back</button></a>
    </form>
</body>
</html>
<style>
    form{
        border: 2px solid black ;
        padding: 10px;
        background-color: black;
        color: white;
        width: 40%;
        margin-left: 30%;
        margin-right: 30%;
        text-align: center;
        margin-top: 10%;
    }
    select{
        text-align: center;
        width: 100%;
        margin-top: 5px;
        margin-bottom: 5px;
        height: 25px;
    }
    label{
        font-size: large;
    }
    input{
        text-align: center;
        border: white;
        width: 99%;
        margin-top: 5px;
        margin-bottom: 5px;
        height: 25px;
    }
    button{
        width: 99%;
        margin-top: 5px;
        margin-bottom: 5px;
        height: 50px;
        font-size:x-large;
    }
</style>