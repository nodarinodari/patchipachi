<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["id"])) {
   header("Location: login.php");
   exit;
}

//DB情報
//DB接続
$pdo = new PDO("mysql:dbname=user", "root");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//エラーメッセージの初期化
$errors = array();
$id = $_SESSION["id"];

try{
   //トランザクション開始
   $pdo->beginTransaction();
   $sql = "SELECT * FROM main_user WHERE id=(:id)";
   $stmt = $pdo->prepare($sql);
   $stmt->bindValue(':id', $id, PDO::PARAM_STR);
   $stmt->execute();
   $result = $stmt->fetch(PDO::FETCH_ASSOC);

}catch (PDOException $e){
	echo $e->getMessage();
}

?>
<?php if (!isset($_SESSION["id"])) { ?>
   <script src="../../js/include.js"></script>
<?php }else{?>
   <script src="../../js/include2.js"></script>
<?php }?>

<h1>会員情報画面</h1>

<?php if(isset($_SESSION['message'])): ?>
   <p class="message"><?php print $_SESSION['message']; ?></p>
   <?php $_SESSION['message'] = NULL?>
<?php endif; ?>

<div>
   <div>
       <p>氏名：<?php print $result["name"]; ?></p>
       <p>メールアドレス：<?php print $result["mail"]; ?></p>
   </div>
</div>

<a href="edit.php">編集</a>
<a href="../login/logout.php">ログアウト</a>
<a href="../home/index.php">ホーム画面に戻る</a>