<?php
session_start();
?>
    
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
    <link rel="stylesheet" href="./styles/style.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<body>
    <div id="global-container">
        <div id="container" class="global-wrap">
            <!-- ヘッダーメニューモバイルサイズ以上の場合に表示 -->
            <div  class="header-menu" id="top-page">
                <!-- header内のコンテンツの横縦並びの制御用 -->
            
                <div class="site-title-container">
                    <!-- サイト名ロゴ -->
                    <h1>
                        <a href="index.html">
                            <!-- サイト名ロゴとか挿入 -->
                            <img src="./img/title-logo.png" alt="会社ロゴ">
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
                                <img src="./img/LINE_Brand_icon.png" alt="LINEへのリンク">
                                <p>LINE</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="./img/Logo blue.svg" alt="Twitterへのリンク">
                                <p>Twitter</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="./img/f_logo_RGB-Blue_1024.png" alt="Facebookへのリンク">
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

            <div class="search-container">
                <h2>商品検索</h2>
                <div class="wrapper">
                    <form action="#">
                        <input class="search-box" type="search" placeholder="キーワードを入力">
                        <button class="search-btn" type="submit" name="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <div class="sample">
                        <ul>
                            <li>例</li>
                            <li>・ま〇か</li>
                            <li>・番〇</li>
                            <li>・バジ〇スク</li>
                            <li>・ハー〇ス</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mobile-layout">
            
                <div class="nav-lists">
                    <h2>Menu</h2>
                    <nav>
                        <ul class="nav-lists__container">
                            <li><a href="#">パチスロ一覧</a></li>
                            <li><a href="#">メーカー別</a></li>
                            <li><a href="#">オプション品</a></li>
                            <li><a href="#">買い取り・下取り</a></li>
                            <li><a href="#"><i class="fa fa-commenting-o"></i>お問い合わせ</a></li>
                        </ul>
                    </nav>
                </div>
            
                <!-- トップページのコンテンツ slide show-->
                <section class="slide-show-container">
                    <div class="swiper">
                        <!-- スライドメニュー -->
                        <div class="swiper-wrapper">
                            <!-- スライドメニュー内容を個々に追加してください -->
                            <div class="swiper-slide">
                                <img src="./img/open-pos.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="./img/option-pos.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="./img/clean-pos.png" alt="">    
                            </div>
                            <div class="swiper-slide">
                                <img src="./img/kaitori-pos.png" alt="">
                            </div>
        
                            </div>  <!-- スライドのページネーション表示 -->
                            <div class="swiper-pagination"></div>
                            <!-- 「次へ」や「戻る」のアイコン表示 -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <!-- スクロールバーの表示 -->
                            <div class="swiper-scrollbar">
                        </div>
                    </section>
            </div>
        
        
            <div class="content-wrap">
        <!-- sidebarとmain分割比率用 -->
        
            <div class="sidebar-wrap">
                <div class="sidebar-container">
                    <!-- サイドバーのレイアウト調整用 -->
                    <div class="shopping-basket">
                        <p>こんにちわ<span>Gest</span>様</p>
                        <i class="fas fa-shopping-cart fa-2x"></i><p>カート</p>
                    </div>
                    <nav class="shopping-category">
                        <ul class="drop-menu">
                            <!-- メニュータイトル -->
                            <p class="drop-menu__list">購入前に</p>
                            <li class="drop-menu__item"><a href="#">送料</a></li>
                            <!-- メニュータイトル -->
                            <p class="drop-menu__list">商品カテゴリー</p>
                            <li class="drop-menu__item"><a href="#">新台/人気台から探す</a></li>
                            <li class="drop-menu__item"><a href="#">オプションから探す</a></li>
                            <!--aアコーディオンメニュー  -->
                            <li class="drop-menu__item">
                                <button class="btnOpen-1"><span class="gh-sign-1"></span>メーカー別から探す</button>
                                <!-- 全体収納用ul -->
                                    <ul class="maker-company-menu-1">
                                        <button class="btnOpen-2"><span class="gh-sign-2"></span>あ行</button>
                                            <ul class="maker-company-menu-2">
                                                <li><a href="#">あいうえ社</a></li>
                                                <li><a href="#">あかさたな社</a></li>
                                            </ul>
                                        <button class="btnOpen-3"><span class="gh-sign-3"></span>か行</button>
                                            <ul class="maker-company-menu-3">
                                                <li><a href="#">A社</a></li>
                                                <li><a href="#">A-2社</a></li>
                                            </ul>
                                        <button class="btnOpen-4"><span class="gh-sign-4"></span>さ行</a></button>
                                            <ul class="maker-company-menu-4">
                                                <li><a href="#">S社</a></li>
                                                <li><a href="#">S-1社</a></li>
                                            </ul>
                                        <button class="btnOpen-5"><span class="gh-sign-5"></span>た行</button>
                                            <ul class="maker-company-menu-5">
                                                <li><a href="#">T社</a></li>
                                            </ul>
                                        <button class="btnOpen-6"><span class="gh-sign-6"></span>な行</button>
                                            <ul class="maker-company-menu-6">
                                                <li><a class="link-none" href="#">該当なし</a></li>
                                            </ul>
                                        <button class="btnOpen-7"><span class="gh-sign-7"></span>は行</button>
                                            <ul class="maker-company-menu-7">
                                                <li><a href="#">HH社</a></li>
                                            </ul>
                                        <button class="btnOpen-8"><span class="gh-sign-8"></span>ま行</button>
                                            <ul class="maker-company-menu-8">
                                                <li><a href="#">M社</a></li>
                                            </ul>
                                        <button class="btnOpen-9"><span class="gh-sign-9"></span>や行</button>
                                            <ul class="maker-company-menu-9">
                                                <li><a href="#">Y社</a></li>
                                            </ul>
                                        <button class="btnOpen-10"><span class="gh-sign-10"></span>ら行</button>
                                            <ul class="maker-company-menu-10">
                                                <li><a class="link-none" href="#">該当なし</a></li>
                                            </ul>
                                        <button class="btnOpen-11"><span class="gh-sign-11"></span>わ行</button>
                                            <ul class="maker-company-menu-11">
                                                <li><a class="link-none" href="#">該当なし</a></li>
                                            </ul>
                                        </ul>
                                    <button class="btnOpen-12 bg-color"><span class="gh-sign-12"></span>特価商品から探す</button>
                                    <ul class="maker-company-menu-12">
                                            <li><a class="link-none" href="#">該当なし</a></li>
                                    </ul>
                        </ul>
                    </nav>
                </div>
            </div>
        
            <main class="main-wrap">
                <div class="main-container">
                    <article class="news-container">
                        <h2>新着情報</h2>
                        <div class="news-wrap">
                            <div class="news-article">
                                <div class="news-article__title">
                                    <p>〇月〇日</p>
                                </div>
                                <div class="news-article__item">
                                    <p>新規サイト開設致しました！<br>毎週日曜日に更新予定</p>
                                </div>
                            </div>
                            <div class="news-article">
                                <div class="news-article__title">
                                    <p>〇月〇〇日</p>
                                </div>
                                <div class="news-article__item">
                                    <p>最新機種を導入しました！</p>
                                </div>
                            </div>    
                            <div class="news-article">
                                <div class="news-article__title">
                                    <p>〇月〇〇日<span class="new-icon">NEW</span></p>
                                </div>
                                <div class="news-article__item">
                                    <p>なつかしのあの機種を導入しました！</p>
                                </div>
                            </div>    
                        </div>
                        
                    </article>
        
                    <!-- メインのレイアウト調整用 -->
                    <h2>新着台情報</h2>
                    <div class="shopping-contents">
                        <div class="shopping-contents__item">
                            <span class="new-icon point">NEW</span>
                            <a href="slot.html"><img src="./img-grid/baji.png" alt=""></a>
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                        </div>
        
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/banchou.png" alt=""></a>
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                        </div>
        
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/gaisen.png" alt=""></a>
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                        </div>
                    
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/hades.png" alt=""></a>
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                        </div>
        
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/monhan.png" alt="">
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                            </a>
                        </div>
        
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/sadako.png" alt="">
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                            </a>
                        </div>
        
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/madoka1.png" alt="">
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                            </a>
                        </div>
        
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/madoka.png" alt="">
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                            </a>
                        </div>
            
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/garufure.png" alt="">
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                            </a>
                        </div>
        
                        <div class="shopping-contents__item">
                            <a href="slot.html"><img src="./img-grid/rizero.png" alt="">
                            <p>パチスロ〇〇〇〇〇〇</p>
                            <p>￥〇〇〇〇〇(税込み)</p>
                            </a>
                        </div>
                        <div class="more-box">
                            <a href="#">もっと見る</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="option">
            <h2>オプション</h2>
            <div class="option__items">
                <a href="#">
                    <img src="./img/sample1.jpg" alt="">
                    <p>〇〇〇〇〇〇</p>
                    <p>￥〇〇〇〇〇(税込み)</p>
                </a>
                <a href="#">
                    <img src="./img/sample2.jpg" alt="">
                    <p>〇〇〇〇〇〇</p>
                    <p>￥〇〇〇〇〇(税込み)</p>
                </a>
                <a href="#">
                    <img src="./img/sample3.jpg" alt="">
                    <p>〇〇〇〇〇〇</p>
                    <p>￥〇〇〇〇〇(税込み)</p>
                </a>
                <a href="#">
                    <img src="./img/sample4.jpg" alt="">
                    <p>〇〇〇〇〇〇</p>
                    <p>￥〇〇〇〇〇(税込み)</p>
                </a>
            </div>
            <div class="more-box">
                <a href="#">もっと見る</a>
            </div>
        </div>
        
            <footer></footer>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="crossorigin="anonymous"></script>
<script src="./scripts/libs/open-menu.js"></script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="./scripts/libs/swiper-setting.js"></script>
<script src="./scripts/libs/drop-down.js"></script>
<script src="./scripts/main.js"></script>
</body>

</html>