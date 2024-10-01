<?php
include_once "oop.php";
$sql=new oop();
if ($_SERVER['REQUEST_METHOD']==="POST") {
    $name=$_POST['user'];
    $pwd=$_POST['pwd'];
    $stmt=$sql->select("`password`","`atendes_admin`","`username`='$name'");
    $result=$stmt->get_result();
    if ($result-> num_rows === 1) {
        $row = $result-> fetch_assoc();
        if (password_verify($pwd,$row['password'])) {
            $_SESSION['name']="admin";
            header("location:show.php");
            $stmt->close();
            exit();
        }
    }else{
        echo "<script>window.alert('undefined this user!')</script>";
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
        <h1>Login Admin</h1>
        <label for="">Username:</label>
        <input type="text" name="user" require>
        <label for="">Password:</label>
        <input type="password" name="pwd" require>
        <input type="submit" name="submit">
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
    label{
        font-size: large;
    }
    input{
        border: white;
        width: 99%;
        margin-top: 5px;
        margin-bottom: 5px;
        height: 25px;
    }
    input[type='submit']{
        width: 99%;
        margin-top: 5px;
        margin-bottom: 5px;
        height: 50px;
        font-size:x-large;
    }
</style>