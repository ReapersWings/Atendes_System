<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ajaxindex.php" method="post">
        <input type="text" name="code" style="width:100%"  autofocus>
        <input type="submit" name="submit" style="width:100%">
        <h1 id="time"></h1>
        <h4 id="date"></h4>
        <h1 id="alert"></h1>
    </form>
    
    <?php
        session_start();
        if (isset($_SESSION['alert']) AND isset($_SESSION['audio'])) {
            echo "<script> var alert = '".$_SESSION['alert']."';</script>";
        }else{
            $_SESSION['alert']="";
        }
    ?>
    <audio autoplay >
    <source  src="<?=$_SESSION['audio']?>" type="audio/mpeg">
    </audio>
</body>
</html>
<script>
    var timer = 1 ;
    function time() {
        var time = new Date()
        var hour = time.getHours();
        var minutes = time.getMinutes();
        var secound = time.getSeconds();
        minutes = (minutes <10 ? "0" : "") + minutes
        secound = (secound<10 ? "0" : "") + secound
        hour =(hour < 10 ? "0" : "" ) + hour
        document.getElementById("time").innerHTML = ""+ hour+":"+minutes+":"+secound 
        
        var year = time.getFullYear();
        var month = time.getMonth()+1;
        var day = time.getDate();
        document.getElementById("date").innerHTML=""+day+" - "+month+" - "+year 

        if (alert === "") {
            document.getElementById("alert").innerHTML="" ;
        } else if(timer < 2) {
            document.getElementById("alert").innerHTML= alert ;
            timer++ ;
        }else{
            alert = "" ;
            return alert
        }
    }
    time();
    setInterval( time , 500);
</script>
<style>
    input{
        height:50px;
        text-align:center;
        font-size:30px;
    }
    #time{
        text-align:center;
        margin:0px;
        font-size:250px ;
    }
    #date{
        margin:0px;
        text-align:center;
        font-size:75px
    }
    #alert{
        width: 100%;
        height: 100px ;
        margin:0px;
    }
    p{
        width: 100%;
        font-size:75px ;
        text-align:center;
    }
</style>