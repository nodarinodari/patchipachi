<ul class="progressbar">
    <li class="complete">名前入力</li>
    <li class="complete">住所入力</li>
    <li class="active">支払い方法入力</li>
    <li>確認</li>
</ul>
<table class="contact-table">
    <tr>
        <th class="contact-item">支払い方法</th>
        <td class="contact-body">
            <p>支払い方法選択</p>
            <select class="form-text" name="pay">
                <option value="" hidden disabled selected></option>
                <option value="1">クレジットカード払い</option>
                <option value="2">現金払い</option>
            </select>
        </td>
    </tr>
    <tr>
        <th class="contact-item">クレジットカード情報</th>
        <td class="contact-body">
            <p>クレジット番号</p>
            <input type="number" name="creditnumber" id="card" class="form-text" size="20" />
            <p class="error" id="errorCard"></p>

            <p>カード有効期限</p>
            <input type="month" name="card" class="form-text" id="card" size="60" />
            <p class="error" id="errorExpiry"></p>

            <p>セキュリティコード</p>
            <input type="number" name="code" class="form-text" id="card" size="30" />
            <p class="error" id="errorCode"></p>
        </td>
    </tr>
</table>
<input type="button" class="sample_btn" id="btn_confirm" value="確認" name="3">
<script src="../../js/index3.js"></script>