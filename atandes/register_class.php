<?php
include_once "oop.php";
if (!isset($_SESSION['name'])) {
    echo"<script>window.alert('please login first!');window.location.href='adminlogin.php'</script>";
}
$sql= new oop() ;
if ($_SERVER['REQUEST_METHOD']==="POST") {
    $name = $_POST['name'];
    $teacher=$_POST['teacher'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $stmt=$sql->select('`class_name`','`atendes_class`','`class_name`="'.$name.'"');
    $result=$stmt->get_result();
    if ($result->num_rows === 0) {
        $stmt1=$sql->insertclass($name,$teacher,$start,$end);
        echo"<script>window.alert('Insert class successful!');window.location.href='register_class.php'</script>";
        exit();
    }else{
        echo"<script>window.alert('This class name have been used!')</script>";
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
        <h1>Register Class</h1>
        <label for="">Class name:</label>
        <input type="text" name="name" required>
        <label for="">Class teacher:</label>
        <input type="text" name="teacher" required>
        <label for="">Start time:</label>
        <input type="time" name="start" required>
        <label for="">End Time:</label>
        <input type="time" name="end" required>
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
        margin-top: 8%;
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