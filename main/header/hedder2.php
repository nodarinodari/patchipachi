<?php
session_start();
//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
//DB情報

//エラーメッセージの初期化
$errors = array();
//DB接続
$pdo = new PDO("mysql:dbname=user", "root");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_SESSION["id"];
try{
   //トランザクション開始
   $pdo->beginTransaction();
   $sql = "SELECT name FROM main_user WHERE id=(:id)";
   $stmt = $pdo->prepare($sql);
   $stmt->bindValue(':id', $id, PDO::PARAM_STR);
   $stmt->execute();
   $result = $stmt->fetch(PDO::FETCH_ASSOC);

}catch (PDOException $e){
    echo $e->getMessage();
}
?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/hedder.css">

    </head>
    <header class="header-menu">
        <!-- header内のコンテンツの横縦並びの制御用 -->

        <div class="site-title-container">
            <!-- サイト名ロゴ -->
            <h1>
                <a href="../home/index.php">
                    <!-- サイト名ロゴとか挿入 -->
                    <img src="" alt="会社ロゴ">
                </a>
            </h1>
        </div>

        <div class="sns-link-container">
            <!-- SNSへのリンク３種twitter, facebook, Line -->
            <ul>
                <li>
                    <a href="">
                        <img src="../../../img/LINE_Brand_icon.png" alt="Lineへのリンク">
                    </a>
                </li>

                <li>
                    <a href="">
                        <img src="../../../img/Logo blue.svg" alt="Twitterへのリンク">
                    </a>
                </li>

                <li>
                    <a href="">
                        <img src="../../../img/f_logo_RGB-Blue_1024.png" alt="Facebookへのリンク">
                    </a>
                </li>
            </ul>

        </div>
        <nav>
            <div class="member-register-contaier">
                <!-- ナビゲーションの縦並び制御用 -->

                <p>電話番号×××-×××-×××</p>
                <ul class="member-register-lists">
                    <!-- ナビゲーションの横並び制御用 -->

                    <li>
                        <a href="../mypage/user.php">
                            <?php 
                            print $result['name'];
                            ?>　様
                        </a>
                    </li>
                    <li><a href="#">カートを見る</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <body>
    </body>

    </html>