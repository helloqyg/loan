<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>

    </header>
    <main class="main">

        <div class="section">
            <!--时间-->
            <div class="time">
                <ul>
                </ul>

                <form action="" method="post">
                    <div class="pai">
                        账号：  <input placeholder="请输入账号" name="username" style="background: #bdf5ff;color: #241bff;" type="text" >
                    </div>

                    <div class="pai">
                        <input style="background: #7dffcd;color: red" type="submit"  >
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
</body>
</html>
<script>
    $('.icon-fanhui').click(function(){
        window.history.go(-1);
    })
    $('.head li').click(function(){
        $(this).addClass('y').siblings().removeClass('y');
    })
</script>