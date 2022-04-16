<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="../../css/index.css">
<link rel="stylesheet" href="../../css/index1.css">
<script src="../../js/add.js"></script>
<script src="../../js/index1.js"></script>
<script src="../../js/.js"></script>

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
if(isset($_POST['1'])){
	if(empty($_POST)) {
		header("Location: registration_mail.php");
		exit();
	}else{
	//POSTされたデータを各変数に入れる
    //１ページ目
		$kananame = isset($_POST['kananame']) ? $_POST['kananame'] : NULL;
		$name = isset($_POST['name']) ? $_POST['name'] : NULL;
		$password = isset($_POST['パスワード']) ? $_POST['パスワード'] : NULL;
        $phone = isset($_POST['電話']) ? $_POST['電話'] : NULL;
        $index1 = isset($_SESSION['index1']) ? $_SESSION['index1'] : NULL;
    //２ページ目
        $zip = isset($_POST['zip']) ? $_POST['zip'] : NULL;
		$kenname = isset($_POST['yuubin']) ? $_POST['yuubin'] : NULL;
		$municipalities = isset($_POST['municipalities']) ? $_POST['municipalities'] : NULL;
		$cityname = isset($_POST['housenumber']) ? $_POST['housenumber'] : NULL;
		$townname = isset($_POST['bulid']) ? $_POST['bulid'] : NULL;
     //セッションに登録
     //１ページ目
        $_SESSION['kananame']=$kananame;
		$_SESSION['name'] = $name;
		$_SESSION['電話'] = $phone;
		$_SESSION['password'] = $password;
        $_SESSION['index1'] = $index1;
     //２ページ目
		$_SESSION['zip'] = $zip;
		$_SESSION['yuubin'] = $kenname;
		$_SESSION['municipalities'] = $municipalities;
		$_SESSION['housenumber'] = $cityname;
		$_SESSION['bulid'] = $townname;
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

<body class="result">
    <ul class="progressbar">
        <li class="active">名前の入力</li>
        <li>住所入力</li>
        <li>支払い方法入力</li>
        <li>確認</li>
    </ul>

    <!-- 入力フォーム -->
    <table class="contact-table">
        <tr>
            <th class="contact-item">名前</th>
            <td class="contact-body">
                <p>漢字</p>
                <input type="text" name="name" class="form-text" requiredonKeyDown="return next_text(1);" value="<?php if( !empty($_SESSION['name']) ){ echo $_SESSION['name']; } ?>"/>
                <p class="error" id="errorname"></p>
                <p class="message">*例）山田太郎</p>
                <p>フリガナ</p>
                <input type="text" name="kananame" class="form-text"  value="<?php if( !empty($_SESSION['kananame']) ){ echo $_SESSION['kananame']; } ?>" required/>
                <p class="error" id="errorfuri"></p>
                <p class="message">*例）ヤマダタロウ</p>
                <p class="message">*カタカナのみで入力してください。</p>
            </td>
        </tr>
        <tr>
            <th class="contact">性別</th>
            <td class="contact-body">
                <label class="contact-sex">
                <input type="radio" name="性別" />
                <span class="contact-sex-txt">男</span>
            </label>
                <label class="contact-sex">
                <input type="radio" name="性別" />
                <span class="contact-sex-txt">女</span>
            </label>
                <label class="contact-sex">
                <input type="radio" name="性別" />
                <span class="contact-sex-txt">指定しない</span>
            </label>
            </td>
        </tr>
        <tr>
            <th class="contact-item">電話</th>
            <td class="contact-body">
                <input type="tel" name="電話" class="form-text" value="<?php if( !empty($_SESSION['電話']) ){ echo $_SESSION['電話']; } ?>"required/>
                <p class="error" id="errorphone"></p>
                <p class="message">*例）0000000</p>
                <p class="message">*半角英数字で入力してください。</p>
                <p class="message">*ハイフンは必要ないです。</p>
            </td>
        </tr>
        <tr>
            <th class="contact-item">パスワード</th>
            <td class="contact-body">
                <input type="password" name="パスワード" class="form-text" required/>
                <input type="checkbox" id="password-check" />
                <p class="error" id="errorpass"></p>
                <p class="message">*8文字以上16文字以下で入力してください。</p>
                <p class="message">*英数字で、大文字・小文字・数字をそれぞれ1文字以上組み合わせて入力してください。</p>
                <p class="message">*全角英数字・半角記号は使用できません。</p>
            </td>
        </tr>
        <tr>
            <th class="contact-item">パスワード（再入力）</th>
            <td class="contact-body">
                <input type="password" name="パスワード(再)" class="form-text" required/>
                <input type="checkbox" id="password-check2" />
                <p class="error" id="errorpass2"></p>
                <p class="message">*8文字以上16文字以下で入力してください。</p>
                <p class="message">*英数字で、大文字・小文字・数字をそれぞれ1文字以上組み合わせて入力してください。</p>
                <p class="message">*全角英数字・半角記号は使用できません。</p>
            </td>
        </tr>
    </table>

    <div class="privacy-policy">
        <div class="privacy-policy-aaa">
            <p class="privacy-policy__item__title">プライバシーポリシー</p>
            <p class="privacy-policy__item__desc">＿＿＿＿＿＿＿＿（以下，「当社」といいます。）は，本ウェブサイト上で提供するサービス（以下,「本サービス」といいます。）における，ユーザーの個人情報の取扱いについて，以下のとおりプライバシーポリシー（以下，「本ポリシー」といいます。）を定めます。</p>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第1条（個人情報）</p>
                <p class="privacy-policy__item__desc">「個人情報」とは，個人情報保護法にいう「個人情報」を指すものとし，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。</p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第2条（個人情報の収集方法）</p>
                <p class="privacy-policy__item__desc">当社は，ユーザーが利用登録をする際に氏名，生年月日，住所，電話番号，メールアドレス，銀行口座番号，クレジットカード番号，運転免許証番号などの個人情報をお尋ねすることがあります。また，ユーザーと提携先などとの間でなされたユーザーの個人情報を含む取引記録や決済に関する情報を,当社の提携先（情報提供元，広告主，広告配信先などを含みます。以下，｢提携先｣といいます。）などから収集することがあります。 </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第3条（個人情報を収集・利用する目的）</p>
                <p class="privacy-policy__item__desc">「当社が個人情報を収集・利用する目的は，以下のとおりです。
                    <ol>
                        <li>当社サービスの提供・運営のため</li>
                        <li>ユーザーからのお問い合わせに回答するため（本人確認を行うことを含む）</li>
                        <li>ユーザーが利用中のサービスの新機能，更新情報，キャンペーン等及び当社が提供する他のサービスの案内のメールを送付するため</li>
                        <li>メンテナンス，重要なお知らせなど必要に応じたご連絡のため</li>
                        <li>利用規約に違反したユーザーや，不正・不当な目的でサービスを利用しようとするユーザーの特定をし，ご利用をお断りするため</li>
                        <li>ユーザーにご自身の登録情報の閲覧や変更，削除，ご利用状況の閲覧を行っていただくため</li>
                        <li>有料サービスにおいて，ユーザーに利用料金を請求するため</li>
                        <li>上記の利用目的に付随する目的</li>
                    </ol>
                </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第4条（利用目的の変更）</p>
                <p class="privacy-policy__item__desc">
                    <ol>
                        <li>当社は，利用目的が変更前と関連性を有すると合理的に認められる場合に限り，個人情報の利用目的を変更するものとします。</li>
                        <li>利用目的の変更を行った場合には，変更後の目的について，当社所定の方法により，ユーザーに通知し，または本ウェブサイト上に公表するものとします。</li>
                    </ol>
                </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第5条（個人情報の第三者提供）</p>
                <p class="privacy-policy__item__desc">
                    <ol>
                        <li>当社は，次に掲げる場合を除いて，あらかじめユーザーの同意を得ることなく，第三者に個人情報を提供することはありません。ただし，個人情報保護法その他の法令で認められる場合を除きます。</li>
                        <ol>
                            <li>人の生命，身体または財産の保護のために必要がある場合であって，本人の同意を得ることが困難であるとき</li>
                            <li>公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって，本人の同意を得ることが困難であるとき</li>
                            <li>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって，本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</li>
                            <li>予め次の事項を告知あるいは公表し，かつ当社が個人情報保護委員会に届出をしたとき</li>
                            <ol>
                                <li>利用目的に第三者への提供を含むこと</li>
                                <li>第三者に提供されるデータの項目</li>
                                <li>第三者への提供の手段または方法</li>
                                <li>本人の求めに応じて個人情報の第三者への提供を停止すること</li>
                                <li>本人の求めを受け付ける方法</li>
                            </ol>
                        </ol>
                        <li>前項の定めにかかわらず，次に掲げる場合には，当該情報の提供先は第三者に該当しないものとします。</li>
                        <ol>
                            <li>当社が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合</li>
                            <li>合併その他の事由による事業の承継に伴って個人情報が提供される場合</li>
                            <li>個人情報を特定の者との間で共同して利用する場合であって，その旨並びに共同して利用される個人情報の項目，共同して利用する者の範囲，利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について，あらかじめ本人に通知し，または本人が容易に知り得る状態に置いた場合</li>
                        </ol>

                    </ol>
                </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第6条（個人情報の開示）</p>
                <p class="privacy-policy__item__desc">
                    <ol>
                        <li>当社は，本人から個人情報の開示を求められたときは，本人に対し，遅滞なくこれを開示します。ただし，開示することにより次のいずれかに該当する場合は，その全部または一部を開示しないこともあり，開示しない決定をした場合には，その旨を遅滞なく通知します。なお，個人情報の開示に際しては，1件あたり1，000円の手数料を申し受けます。</li>
                        <ol>
                            <li>本人または第三者の生命，身体，財産その他の権利利益を害するおそれがある場合</li>
                            <li>当社の業務の適正な実施に著しい支障を及ぼすおそれがある場合</li>
                            <li>その他法令に違反することとなる場合</li>
                        </ol>
                        <li>前項の定めにかかわらず，履歴情報および特性情報などの個人情報以外の情報については，原則として開示いたしません。</li>
                    </ol>
                </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第7条（個人情報の訂正および削除）</p>
                <p class="privacy-policy__item__desc">
                    <ol>
                        <li>ユーザーは，当社の保有する自己の個人情報が誤った情報である場合には，当社が定める手続きにより，当社に対して個人情報の訂正，追加または削除（以下，「訂正等」といいます。）を請求することができます。</li>
                        <li>当社は，ユーザーから前項の請求を受けてその請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の訂正等を行うものとします。</li>
                        <li>当社は，前項の規定に基づき訂正等を行った場合，または訂正等を行わない旨の決定をしたときは遅滞なく，これをユーザーに通知します。</li>
                    </ol>
                </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第8条（個人情報の利用停止等）</p>
                <p class="privacy-policy__item__desc">
                    <ol>
                        <li>当社は，本人から，個人情報が，利用目的の範囲を超えて取り扱われているという理由，または不正の手段により取得されたものであるという理由により，その利用の停止または消去（以下，「利用停止等」といいます。）を求められた場合には，遅滞なく必要な調査を行います。</li>
                        <li>前項の調査結果に基づき，その請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の利用停止等を行います。</li>
                        <li>当社は，前項の規定に基づき利用停止等を行った場合，または利用停止等を行わない旨の決定をしたときは，遅滞なく，これをユーザーに通知します。</li>
                        <li>前2項にかかわらず，利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって，ユーザーの権利利益を保護するために必要なこれに代わるべき措置をとれる場合は，この代替策を講じるものとします。</li>
                    </ol>
                </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第9条（プライバシーポリシーの変更）</p>
                <p class="privacy-policy__item__desc">
                    <ol>
                        <li>本ポリシーの内容は，法令その他本ポリシーに別段の定めのある事項を除いて，ユーザーに通知することなく，変更することができるものとします。</li>
                        <li>当社が別途定める場合を除いて，変更後のプライバシーポリシーは，本ウェブサイトに掲載したときから効力を生じるものとします。</li>
                    </ol>
                </p>
            </div>
            <div class="privacy-policy__item">
                <p class="privacy-policy__item__title">第10条（お問い合わせ窓口）</p>
                <p class="privacy-policy__item__desc">「本ポリシーに関するお問い合わせは，下記の窓口までお願いいたします。</p>
                <p class="privacy-policy__item__desc">住所：〇〇〇〇</p>
                <p class="privacy-policy__item__desc">社名：ユニコーン</p>
                <p class="privacy-policy__item__desc">担当部署：開発部署</p>
                <p class="privacy-policy__item__desc">Eメールアドレス：〇〇〇〇</p>
            </div>
        </div>
    </div>
    <div class="form-item">
        <input type="checkbox" name="agree" id="agree-check" required/>同意する
    </div>
    <input type="button" class="sample_btn" value="住所入力" name="1" id="submit-btn">
</body>