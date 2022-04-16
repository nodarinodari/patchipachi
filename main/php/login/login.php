<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<?php
session_start();

if (isset($_SESSION["id"])) {
   header('Location: ../mypage/user.php');
   exit;
}

//DB情報
//DB接続
$pdo = new PDO("mysql:dbname=user", "root");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//エラーメッセージの初期化
$errors = array();

// ログインボタンが押されたら
if (isset($_POST['login'])) {

   //エラー文
   if (empty($_POST['mail'])) {
       $errors['mail'] = 'メールアドレスが未入力です。';
   } 
   if (empty($_POST['password'])) {
       $errors['password'] = 'パスワードが未入力です。';
   }
    
   if (!empty($_POST['mail']) && !empty($_POST['password'])) {
       $mail = $_POST['mail'];
       try {
           $pdo->beginTransaction();
           $sql = "SELECT * FROM main_user WHERE mail = :mail"; 
           $stm = $pdo->prepare($sql);
           $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
           $stm->execute();

           $password = $_POST['password'];
           $result = $stm->fetch(PDO::FETCH_ASSOC);

           if (password_verify($password, $result['password'])) {    
               $_SESSION['id'] = $result["id"];
               $_SESSION['mail'] = $mail;
               $_SESSION['message'] = "ログインしました。";
               header('Location: http://localhost/patchipachi/main/php/mypage/user.php');
               exit();
           } else {
               $errors['login'] = 'メールアドレスまたはパスワードに誤りがあります。';
           }
       } catch (PDOException $e) {
           echo $e->getMessage();
       }
   }
}

?>
<link href="../../css/login.css" rel="stylesheet">

<?php if (!isset($_SESSION["id"])) { ?>
   <script src="../../js/include.js"></script>
<?php }else{?>
   <script src="../../js/include2.js"></script>
<?php }?>
    

<h1>ログイン画面</h1>

<div class="form">
<form id="loginForm" name="loginForm" action="" method="POST">
   <?php
       foreach($errors as $error){
           print "<p class='error'>";
           print $error."<br>";
           print "</p>";
       }
   ?>
   
   <div id = "mail">
       <label for="mail">メールアドレス
       <input type="text" id="mail" name="mail" placeholder="メールアドレスを入力" value="<?php if (!empty($_POST["mail"])) {echo htmlspecialchars($_POST["mail"], ENT_QUOTES);} ?>">
       </label>
   </div>
   
   <div id = "pass">
       <label for="password">パスワード
       <input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
       </label>
   </div>
   
   <input type="submit" id="login" name="login" value="ログイン">
</form>
</div>
<a href="signup.mail.php"　>新規登録はこちらへ</a>