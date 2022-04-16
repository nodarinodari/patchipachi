<?php
    session_start()
?>
<ul class="progressbar">
    <li class="complete">名前入力</li>
    <li class="complete">住所入力</li>
    <li class="complete">支払い方法入力</li>
    <li class="active">確認</li>
</ul>
<p>メールアドレス：<?=htmlspecialchars($mail, ENT_QUOTES, 'UTF-8')?></p>
				<p>名前：<input type="text" name="name" value="<?php if( !empty($_SESSION['name']) ){ echo $_SESSION['name']; } ?>"></p>
				<p>ひらがな：<input type="text" name="kananame" value="<?php if( !empty($_SESSION['kananame']) ){ echo $_SESSION['kananame']; } ?>"></p>
                <p>性別：<input type="tel" name="phone"value="<?php if( !empty($_SESSION['contact-sex-txt']) ){ echo $_SESSION['contact-sex-txt']; } ?>"></p>
                <p>電話番号：<input type="tel" name="phone"value="<?php if( !empty($_SESSION['phone']) ){ echo $_SESSION['phone']; } ?>"></p>
                <p>パスワード：<input type="password" name="password"value="<?php if( !empty($_SESSION['password']) ){ echo $_SESSION['password']; } ?>"></p>
				<p>郵便番号：<input type="text" name="post" size="10" maxlength="8"  value="<?php if( !empty($_SESSION['post']) ){ echo $_SESSION['post']; } ?>"></p>
				<p>都道府県：<input type="text" name="Prefectures"value="<?php if( !empty($_SESSION['Prefectures']) ){ echo $_SESSION['Prefectures']; } ?>"></p>
				<p>市区町村：<input type="text" name="addr11"value="<?php if( !empty($_SESSION['addr11']) ){ echo $_SESSION['addr11']; } ?>"></p>
				<p>番地：<input type="text" name="address"value="<?php if( !empty($_SESSION['address']) ){ echo $_SESSION['address']; } ?>"></p>
				<p>建物等：<input type="text" name="bulid"value="<?php if( !empty($_SESSION['bulid']) ){ echo $_SESSION['bulid']; } ?>"></p>
				<p>支払い方法：<input type="text" name="pay"value="<?php if( !empty($_SESSION['pay']) ){ echo $_SESSION['pay']; } ?>"></p>

                <input type="hidden" name="token" value="<?=$token?>">
				<input type="button" name="btn_submit" value="登録">