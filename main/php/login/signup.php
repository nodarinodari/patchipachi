<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


<?php
session_start();
//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//成功・エラーメッセージの初期化
$errors = array();

//DB情報
//DB接続
$pdo = new PDO("mysql:dbname=user", "root");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(empty($_GET)) {
	header("Location: http://localhost/main/php/login/signup.mail.php");
	exit();
}else{
	//GETデータを変数に入れる
	$urltoken = isset($_GET["urltoken"]) ? $_GET["urltoken"] : NULL;
	//メール入力判定
	if ($urltoken == ''){
		$errors['urltoken'] = "トークンがありません。";
	}else{
		try{
			// DB接続	
			//flagが0の未登録者 or 仮登録日から24時間以内
			$sql = "SELECT mail FROM pre_user WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour";
           $stm = $pdo->prepare($sql);
			$stm->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
			$stm->execute();
			
			//レコード件数取得
			$row_count = $stm->rowCount();
			
			//24時間以内に仮登録され、本登録されていないトークンの場合
			if( $row_count ==1){
				$mail_array = $stm->fetch();
				$mail = $mail_array["mail"];
				$_SESSION['mail'] = $mail;
			}else{
				$errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が過ぎたかURLが間違えている可能性がございます。もう一度登録をやりなおして下さい。";
			}
			//データベース接続切断
			$stm = null;
		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			die();
		}
	}
}

/**
* 確認する(btn_confirm)押した後の処理
*/
if(isset($_POST['btn_confirm'])){
	if(empty($_POST)) {
		header("Location: registration_mail.php");
		exit();
	}else{
		//POSTされたデータを各変数に入れる
		$kananame = isset($_POST['kananame']) ? $_POST['kananame'] : NULL;
		$name = isset($_POST['name']) ? $_POST['name'] : NULL;
		$password = isset($_POST['password']) ? $_POST['password'] : NULL;
		$zip = isset($_POST['zip']) ? $_POST['zip'] : NULL;
		$kenname = isset($_POST['yuubin']) ? $_POST['yuubin'] : NULL;
		$municipalities = isset($_POST['municipalities']) ? $_POST['municipalities'] : NULL;
		$cityname = isset($_POST['housenumber']) ? $_POST['housenumber'] : NULL;
		$townname = isset($_POST['bulid']) ? $_POST['bulid'] : NULL;
		$phone = isset($_POST['phone']) ? $_POST['phone'] : NULL;

		//セッションに登録
		$_SESSION['kananame']=$kananame;
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;
		$_SESSION['zip'] = $zip;
		$_SESSION['yuubin'] = $kenname;
		$_SESSION['municipalities'] = $municipalities;
		$_SESSION['housenumber'] = $cityname;
		$_SESSION['bulid'] = $townname;
		$_SESSION['phone'] = $phone;

		//アカウント入力判定
		//パスワード入力判定
		if ($password == ''):
			$errors['password'] = "パスワードが入力されていません。";
		else:
			$password_hide = str_repeat('*', strlen($password));
		endif;

		if ($name == ''):
			$errors['name'] = "名前(漢字)が入力されていません。";
		endif;
		
		if($kananame == ''):
			$errors['kananame'] = "平仮名が入力されていません。";
		endif;

		if ($zip == ''):
			$errors['zip'] = "郵便番号が入力されていません。";
		endif;

		
		if ($cityname == ''):
			$errors['housenumber'] = "番地が入力されていません。";
		endif;

		if ($phone == ''):
			$errors['phone'] = "電話番号が入力されていません。";
		endif;
	}
}

if(isset($_POST['btn_submit'])){
	//パスワードのハッシュ化
	$password_hash =  password_hash($_SESSION['password'], PASSWORD_DEFAULT);

	//ここでデータベースに登録する
	try{
		$urltoken = hash('sha256', uniqid(rand(), 1));
        $url = "http://localhost/patchipachi/main/php/login/login.php?urltoken=" . $urltoken;

		$sql = "INSERT INTO main_user (mail,kana_name,name,password,zip,ken_name,city_name,town_name,building_name,phone,status,created_at,updated_at) VALUES (:mail,:kananame,:name,:password_hash,:yuubin,:kenname,:cityname,:townname,:build,:phone,1,now(),now())";
       $stm = $pdo->prepare($sql);
	   $stm->bindValue(':mail', $_SESSION['mail'], PDO::PARAM_STR);
		$stm->bindValue(':kananame', $_SESSION['kananame'], PDO::PARAM_STR);
		$stm->bindValue(':name', $_SESSION['name'], PDO::PARAM_STR);
		$stm->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
		$stm->bindValue(':yuubin', $_SESSION['zip'], PDO::PARAM_STR);
		$stm->bindValue(':kenname', $_SESSION['yuubin'], PDO::PARAM_STR);
		$stm->bindValue(':cityname', $_SESSION['municipalities'], PDO::PARAM_STR);
		$stm->bindValue(':townname',  $_SESSION['housenumber'], PDO::PARAM_STR);
		$stm->bindValue(':build',  $_SESSION['bulid'], PDO::PARAM_STR);
		$stm->bindValue(':phone', $_SESSION['phone'], PDO::PARAM_STR);
		$stm->execute();

		//pre_userのflagを1にする(トークンの無効化)
		$sql = "UPDATE pre_user SET flag=1 WHERE mail=:mail";
		$stm = $pdo->prepare($sql);
		//プレースホルダへ実際の値を設定する
		$stm->bindValue(':mail', $mail, PDO::PARAM_STR);
		$stm->execute();
						
		/*
		* 登録ユーザと管理者へ仮登録されたメール送信
       */

		$mailTo = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
       $body = <<< EOM
       この度はご登録いただきありがとうございます。
		本登録致しました。
		{$url}
EOM;
       mb_language('ja');
       mb_internal_encoding('UTF-8');
   
       //Fromヘッダーを作成
       $header =  "From: from@example.com";
       $subject = '会員登録メール';

       $headers = "From: from@example.com";
       
       if(mb_send_mail($mailTo, $subject, $body, $headers)){          
        
       }else{
           $pdo->rollBack();
           $errors['mail_error'] = "メールの送信に失敗しました。";
		}	

		//データベース接続切断
		$stm = null;

		//セッション変数を全て解除
		$_SESSION = array();
		//セッションクッキーの削除
		if (isset($_COOKIE["PHPSESSID"])) {
				setcookie("PHPSESSID", '', time() - 1800, '/');
		}
		//セッションを破棄する
		session_destroy();

	}catch (PDOException $e){
		//トランザクション取り消し（ロールバック）
		$pdo->rollBack();
		$errors['error'] = "もう一度やりなおして下さい。";
		print('Error:'.$e->getMessage());
	}
}

?>

<?php if (!isset($_SESSION["id"])) { ?>
   <script src="../../js/include.js"></script>
<?php }else{?>
   <script src="../../js/include2.js"></script>
<?php }?>

<h1>会員登録画面</h1>

<?php if(isset($_POST['btn_submit']) && count($errors) === 0): ?>
本登録されました。

<?php elseif (isset($_POST['btn_confirm']) && count($errors) === 0): ?>
	<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>?urltoken=<?php print $urltoken; ?>" method="post">
		<p>メールアドレス：<?=htmlspecialchars($_SESSION['mail'], ENT_QUOTES)?></p>
		<p>パスワード：<?=$password_hide?></p>
		<p>平仮名：<?=htmlspecialchars($kananame, ENT_QUOTES)?></p>
		<p>漢字名：<?=htmlspecialchars($name, ENT_QUOTES)?></p>
		<p>郵便番号：<?=htmlspecialchars($zip, ENT_QUOTES)?></p>
		<p>都道府県：<?=htmlspecialchars($kenname, ENT_QUOTES)?></p>
		<p>市区町村<?=htmlspecialchars($municipalities, ENT_QUOTES)?></p>
		<p>番地：<?=htmlspecialchars($cityname, ENT_QUOTES)?></p>
		<p>建物等：<?=htmlspecialchars($townname, ENT_QUOTES)?></p>
		<p>電話番号：<?=htmlspecialchars($phone, ENT_QUOTES)?></p>

		<input type="submit" name="btn_back" value="戻る">
		<input type="hidden" name="token" value="<?=$_POST['token']?>">
		<input type="submit" name="btn_submit" value="登録する">
	</form>

<?php else: ?>

	<?php if(count($errors) > 0): ?>
       <?php
       foreach($errors as $value){
           echo "<p class='error'>".$value."</p>";
       }
       ?>
   <?php endif; ?>
		<?php if(!isset($errors['urltoken_timeover'])): ?>
			<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>?urltoken=<?php print $urltoken; ?>" method="post">

				<p>メールアドレス：<?=htmlspecialchars($mail, ENT_QUOTES, 'UTF-8')?></p>
				<p>パスワード：<input type="password" name="password"></p>
				<p>かな名前：<input type="text" name="kananame" value="<?php if( !empty($_SESSION['kananame']) ){ echo $_SESSION['kananame']; } ?>"></p>
				<p>名前：<input type="text" name="name" value="<?php if( !empty($_SESSION['name']) ){ echo $_SESSION['name']; } ?>"></p>
				<p>郵便番号：<input type="text" name="zip" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','yuubin','municipalities');" value="<?php if( !empty($_SESSION['zip']) ){ echo $_SESSION['zip']; } ?>"></p>
				<p>都道府県：<input type="text" name="yuubin"value="<?php if( !empty($_SESSION['yuubin']) ){ echo $_SESSION['yuubin']; } ?>" readonly ></p>
				<p>市区町村：<input type="text" name="municipalities"value="<?php if( !empty($_SESSION['municipalities']) ){ echo $_SESSION['municipalities']; } ?>" readonly></p>
				<p>番地：<input type="text" name="housenumber"value="<?php if( !empty($_SESSION['housenumber']) ){ echo $_SESSION['housenumber']; } ?>"></p>
				<p>建物等：<input type="text" name="bulid"value="<?php if( !empty($_SESSION['bulid']) ){ echo $_SESSION['bulid']; } ?>"></p>
				<p>電話番号：<input type="tel" name="phone"value="<?php if( !empty($_SESSION['phone']) ){ echo $_SESSION['phone']; } ?>"></p>

				<input type="hidden" name="token" value="<?=$token?>">
				<input type="submit" name="btn_confirm" value="確認する">
			</form>
		<?php endif ?>
<?php endif; ?>