<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="GBK">
    <title>城市天气查询</title>
</head>
<style>
    *{
	    padding: 0;
    	margin: 0;
        font-size: 18px;
        font-family: "微软雅黑";
    }
    #main{
        width: 800px;
        height: 525px;
        margin: 15px auto;
        background-color: #7D99BD;
        position: relative;
    }
    h2{
        text-align: center;
        padding: 25px 0 25px 0;
        font-size: 35px;
        color: #0F769F;
    }
    form{
        text-align: center;
    }
    form #input{
        padding: 5px 15px 5px 15px;
        width: 175px;
        height: 25px;
        border: 0 solid lightsteelblue;
        border-radius: 10px;
        position: relative;
        left: 30px;
    }
    form #sub{
        width: 55px;
        height: 30px;
        border: 0 solid lightsteelblue;
        border-radius: 5px;
        background-color: #3a768f;
        color: #3e3e3e;
        cursor: pointer;
        font-weight: bolder;
        position: relative;
        top:50px;
        right: 100px;
    }
    form #sub:hover{
        color: whitesmoke;
        background-color: royalblue;
    }
    #info{
        width: 275px;
        margin: 75px 0 0 300px;
    }
    p{
        font-size: 25px;
        font-weight: bold;
        text-align: left;
        margin: 15px 15px 10px 15px;
    }
    h3{
        font-size: 15px;
        font-weight: 500;
        text-align: center;
        color: #6c6761;
        position: absolute;
        left: 300px;
        bottom: 5px;
    }
</style>
<body>
<div id="main">
    <h2>城市天气查询</h2>
    <form action="index.php" method="post">
        <input type="text" name="city" id="input" placeholder="请输入要查询的城市"/>
        <input type="submit" name='submit' id="sub" value="查询">
    </form>
    <div id="info">
        <?php
        header("content-Type: text/html; charset=utf-8");
        if(isset($_POST['city']) && isset($_POST['submit'])) {
            //转码
            $_city = mb_convert_encoding($_POST['city'],'GBK','UTF-8');
            $_info = array();
            exec('weather.py ' . $_city, $_info);
            if(isset($_info[0]) && isset($_info[1]) && isset($_info[2]) && isset($_info[3]) && isset($_info[4])){
                //转码
                $i=0;
                foreach ($_info as $_value){
                    $_info[$i]=mb_convert_encoding($_value, "UTF-8", "GBK");
                    $i++;
                }
            ?>
            <p>城市：<?php echo $_info[0];?></p>
            <p>日期：<?php echo $_info[1];?></p>
            <p>天气：<?php echo $_info[2];?></p>
            <p>气温：<?php echo $_info[3];?></p>
            <p>风速：<?php echo $_info[4];?></p>
        <?php }else{
                echo '<p>没有找到该城市</p>';
            }
        }?>
    </div>
    <h3>Powered By Horol<br />本程序调用Python脚本实现爬虫</h3>
</div>
</body>
</html>
