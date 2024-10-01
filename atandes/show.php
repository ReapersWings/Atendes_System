<?php
include_once "oop.php";
if (!isset($_SESSION['name'])) {
    echo"<script>window.alert('please login first!');window.location.href='adminlogin.php'</script>";
}
$sql = new oop() ;
$stmt=$sql->select("`username`,`time`,`insert_time`","`atendes_user`LEFT JOIN `atendes_time` ON `atendes_time`.`user_id`=`atendes_user`.`au_id`","`date`=DATE(NOW()) ORDER BY `atendes_user`.`au_id` ASC");
$result=$stmt->get_result();

$sql1 = new oop() ;
$stmt1=$sql1->select("`atendes_user`.`au_id`,`atendes_user`.`username`,`atendes_user`.`cart_code`,`atendes_class`.`class_name`","`atendes_user`LEFT JOIN `atendes_class` ON `atendes_user`.`class_id`=`atendes_class`.`c_id`","1");
$result1=$stmt1->get_result();

$sql2 = new oop() ;
$stmt2=$sql2->select("`c_id`,`class_name`,`class_teacher`,`start_time`,`end_time`","`atendes_class`","1");
$result2=$stmt2->get_result();

$sql3 = new oop() ;
if ($_SERVER['REQUEST_METHOD']==="POST") {
    if (isset($_POST['user_id'])) {
        $sql3->deletedata('`atendes_user`','`au_id`='.$_POST['user_id']);
    }else{
        $sql3->deletedata('`atendes_class`','`c_id`='.$_POST['class_id']);
    }
    echo"<script>window.alert('Delete successfull!');window.location.href='show.php'</script>";
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
<a href="register.php"><button style="width: 49.8%;height:75px;margin:0px"><h1>Register user</h1></button></a>
<a href="register_class.php"><button style="width: 49.8%;height:75px;margin:0px"><h1>Register class</h1></button></a>
    <table style="float:left;width:40%">
        <thead>
            <th colspan="5"><h1 style="margin: 0px;">Attendes</h1></th>
        </thead>
            <tr>
                <th>Username</th>
                <th>Time 1</th>
                <th>Time 2</th>
                <th>Time 3</th>
                <th>Time 4</th>
            </tr>
            <?php
            $match = "" ;
            $timer = "" ;
            while ($row=$result->fetch_assoc()) { 
                if ($row['username'] === $match) {
                    if ($row['insert_time'] == $timer) {
                        echo "<td>".$row['time']."</td>";
                        
                    }else{
                        for ($i=0; $i < $row['insert_time']-=$timer; $i++) { 
                            echo "<td></td>";
                        }
                        echo "<td>".$row['time']."</td>";
                    }
                    $timer=$row['insert_time']+1;
                }else{    
                    echo "</tr><tr><th>".$row['username']."</th>";
                    $max = $row['insert_time']-1 ;
                    for ($i=0; $i < $max; $i++) { 
                        echo"<td></td>";
                    }
                    echo "<td>".$row['time']."</td>";
                    $timer=$row['insert_time']+1;
                    $match=$row['username'];
                }
            } 
            ?>
        
    </table>
    <table  style="float:left;width:30%">
        <thead>
            <th colspan="4"><h1 style="margin: 0px;">User</h1></th>
        </thead>
        <tr>
            <th>Username:</th>
            <th>Cart code:</th>
            <th>Class :</th>
            <th>delete</th>
        </tr>
        <tbody>
            <?php while ($row1=$result1->fetch_assoc()) { ?>
            <tr>
                <td><?=$row1['username']?></td>
                <td><?=$row1['cart_code']?></td>
                <td><?=$row1['class_name']?></td>
                <td><form method="post"><button type="submit" style="width: 100%;" name="user_id" value="<?=$row1['au_id']?>">Delete</button></form></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <table style="width: 30%;">
        <thead>
            <th colspan="5"><h1 style="margin: 0px;">Class</h1></th>
        </thead>
        <tr>
            <th>name:</th>
            <th>teacher:</th>
            <th>start:</th>
            <th>end:</th>
            <th>delete</th>
        </tr>
        <?php while ($row2 = $result2->fetch_assoc()) { ?>
            <tr>
                <td><?=$row2['class_name']?></td>
                <td><?=$row2['class_teacher']?></td>
                <td><?=$row2['start_time']?></td>
                <td><?=$row2['end_time']?></td>
                <td><form method="post"><button type="submit" style="width: 100%;" name="class_id" value="<?=$row2['c_id']?>">Delete</button></form></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<style>
    *{
        text-align: center;
        background-color: black;
        color: white;
    }
    button{
        border: 2px solid white;
    }
    table,th,td{
        border:2px solid white ;
    }
</style>