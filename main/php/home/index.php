<?php
session_start();
?>
    
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<?php if (!isset($_SESSION["id"])) { ?>
   <script src="../../js/include.js"></script>
<?php }else{?>
   <script src="../../js/include2.js"></script>
<?php }?>
<body>
    <div class="container">
        <!-- ヘッダー以下の左右レイアウト調整用 -->
        <div class="nav-lists-container">
            <nav>
                <ul class="nav-lists">
                    <li><a href="">パチスロ一覧</a></li>
                    <li><a href="">メーカー別</a></li>
                    <li><a href="">オプション品</a></li>
                    <li><a href="">買い取り・下取り</a></li>
                    <li><a href=""><i class="fa fa-commenting-o"></i>お問い合わせ</a></li>
                </ul>
            </nav>
        </div>
        <section>
            <!-- トップページのコンテンツ slide show-->
            <div class="slide-show-container">
                <img src="../../../img/sample1.jpg" alt="sapmle">
            </div>

        </section>

        <div class="content-wrap">
            <!-- articlとmain分割比率用 -->

            <main>
                <div class="main-container">
                    <!-- メインのレイアウト調整用 -->

                </div>
            </main>

            <div class="side-bar">
                <div class="side-bar-container">
                    <!-- サイドバーのレイアウト調整用 -->
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>

        <footer></footer>
    </div>

</body>

</html>