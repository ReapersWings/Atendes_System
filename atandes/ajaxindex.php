<?php

include_once "oop.php";

date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$sql1=new oop();
$sql2=new oop();
$date=date("H:i:s");
$code=$_POST['code'];
echo $date ;
function alert($name){
    if ($name===1) {
        $_SESSION['alert']='<p style="background-color:green;margin:0px;width:100%">Check Secussful</p>';
        $_SESSION['audio']='audio/seccussfull.mp3';
    }else{
        $_SESSION['alert']='<p style="background-color:red;margin:0px;width:100%">Check Failed</p>';
        $_SESSION['audio']='audio/failed.mp3';
    }
}
$stmt1=$sql1->select("`au_id`","`atendes_user`","`cart_code`='$code'");
$result1=$stmt1->get_result();
if ($result1-> num_rows ===1) {
    $row1=$result1->fetch_assoc() ;
    $id=$row1['au_id'];
    $stmt2=$sql2->select("MAX(`atendes_time`.`insert_time`),`atendes_time`.`time`,`atendes_class`.`end_time`,`atendes_class`.`start_time`","`atendes_time`INNER JOIN `atendes_user` ON `atendes_time`.`user_id`=`atendes_user`.`au_id` INNER JOIN `atendes_class` ON `atendes_user`.`class_id`=`atendes_class`.`c_id`","`date`=DATE(NOW()) AND `user_id`='$id'");
    $result2=$stmt2->get_result();
    $row2=$result2->fetch_assoc();
    if ($date < date("11:45:00") AND  $date > date("06:30:00")) {
        //$row2['MAX(`insert_time`)']==="" ||
        if ( $row2['MAX(`atendes_time`.`insert_time`)']=== NULL) {
            if ($row2['MAX(`atendes_time`.`insert_time`)']===1) {
                if ($date >= strtotime("+10 minutes" , $row2['`atendes_time`.`time`']) ) {
                    $stmt3=$sql2->insertdate($id,2,$date,'checkout');
                    alert($name=1);
                }else{
                    alert($name=2);
                }
            }else{
                if ($date <= date($row['`atendes_class`.`start_time`'])) {
                    $stmt3=$sql2->insertdate($id,1,$date,'checkin');
                    alert($name=1);
                }else{
                    $stmt3=$sql2->insertdate($id,1,$date,'late_checkin');
                    alert($name=1);
                }
                
            }
        }else{
            alert($name=2);
        }
    }elseif ($date >= date("11:45:00") AND $date <= date("13:30:00")) {     
        if ($row2['MAX(`atendes_time`.`insert_time`)']===1) {
            $stmt3=$sql2->insertdate($id,2,$date,'checkout');
            alert($name=1);
        }elseif ($row2['MAX(`atendes_time`.`insert_time`)']===2) {
            $stmt3=$sql2->insertdate($id,3,$date,'checkin');
            alert($name=1);
        }elseif ($row2['MAX(`atendes_time`.`insert_time`)']=== NULL) {
            $stmt3=$sql2->insertdate($id,3,$date,'checkin');
            alert($name=1);
        }else{
            alert($name=2);
        }
    }elseif ($date > date("13:30:00") AND $date <= date("18:00:00")) {
        if ($row2['MAX(`atendes_time`.`insert_time`)'] === 4 ) {
            alert($name=2);
        }else{
            if ($date <= date($row['`atendes_class`.`end_time`'])) {
                $stmt3=$sql2->insertdate($id,4,$date,'early_dismissal');
                alert($name=1);
            }else{
                $stmt3=$sql2->insertdate($id,4,$date,'checkout');
                alert($name=1);
            }
        }
    }
}elseif ($result1 -> num_rows ===0) {
    $_SESSION['alert']='<p style="background-color:red;margin:0px;width:100%">Undefined User</p>';
    $_SESSION['audio']='audio/failed.mp3';
}
header("location:index.php");
//ADD CONSTRAINT `atendes_user` FOREIGN KEY (`atendes_user`.`class_id`)REFERENCES ``
?>