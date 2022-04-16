<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PachiFre トップページ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/885c2710d5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../home/styles/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../home/scripts/libs/open-menu.js"></script>
    <script src="../home/scripts/main.js"></script>
</head>
<header>
    <div  class="header-menu" id="top-page">
        <!-- header内のコンテンツの横縦並びの制御用 -->
        <div class="site-title-container">
            <!-- サイト名ロゴ -->
            <h1>
                <a href="index.html">
                    <!-- サイト名ロゴとか挿入 -->
                    <img src="../home/img/title-logo.png" alt="会社ロゴ">
                    <div class="shop-title">
                        <p>パチスロ中古販売店</p>
                        <p>Pachinko Friends</p>
                    </div>
                </a>
                
            </h1>
        </div>
        
        <div class="sns-link-container">
            <!-- SNSへのリンク３種twitter, facebook, Line -->
            <ul>
                <li>
                    <a href="#">
                        <img src="../home/img/LINE_Brand_icon.png" alt="LINEへのリンク">
                        <p>LINE</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="../home/img/Logo blue.svg" alt="Twitterへのリンク">
                        <p>Twitter</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="../home/img/f_logo_RGB-Blue_1024.png" alt="Facebookへのリンク">
                        <p>Facebook</p>
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
                    
                    <li><a href="../login/signup.mail.php">会員登録</a></li>
                    <li><a href="../login/login.php">マイページ</a></li>
                    <li><a href="#">カートを見る</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ヘッダーメニューモバイル用 -->
    <div class="mobile-container">
        <header class="header">
            <div class="header__title">
                <a href="#global-container">
                    <img src="./img/title-logo.png" alt="タイトルロゴ">
                    <p>パチスロ中古販売店</p>
                </a>
            </div>
            <!-- バーガーメニュー -->
            <div class="mobile-menu__container">
                <button class="mobile-menu__btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <p>メニュー</p>
            </div>
        </header>
        <nav class="mobile-menu">
            <ul class="mobile-menu__main">
                <div class="shopping-basket">
                    <p>こんにちわ<span>Gest</span>様</p>
                    <i class="fas fa-shopping-cart fa-2x"></i><p>カート</p>
                </div>
                <li class="mobile-menu__item">
                    <a class="mobile-menu__link" href="#">
                        <p>jon</p>
                    </a>
                </li>
                <li class="mobile-menu__item">
                    <a class="mobile-menu__link" href="#">
                        <p>tinko</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
</html>