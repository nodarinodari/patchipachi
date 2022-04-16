<ul class="progressbar">
    <li class="complete">名前入力</li>
    <li class="active">住所入力</li>
    <li>支払い方法入力</li>
    <li>確認</li>
</ul>
<!-- 入力フォーム -->
<table class="contact-table">
    <tr>
        <th class="contact-item">郵便番号</th>
        <td class="contact-body">
            <input type="number" name="post" class="form-text" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','Prefectures','addr11');" required/>
            <p class=" error" id="errorpost"></p>
            <p class="error" id="errorPost"></p>
            <p class="message">*例）1234567</p>
            <p class="message">*半角英数字以外入力しないでください。</p>
            <p class="message">*ハイフンは必要ないです。</p>
        </td>
    </tr>

    <tr>
        <th class="contact-item">都道府県</th>
        <td class="contact-body">
            <input type="text" name="Prefectures" class="form-text" size="20" readonly>
            <p class="message">*ここは自動的に割り振りされます。</p>
            <p class="message">*入力はできません。</p>
        </td>
    </tr>

    <tr>
        <th class="contact-item">市区町村</th>
        <td class="contact-body">
            <input type="text" name="addr11" class="form-text" size="60" readonly/>
            <p class="error" id="errorAdd11"></p>
            <p class="message">*ここは自動的に割り振りされます。</p>
            <p class="message">*入力はできません。</p>
        </td>
    </tr>

    <tr>
        <th class="contact">番地</th>
        <td class="contact-body">
            <input type="number" name="address" class="form-text" size="30">
            <p class="message">*例）1-1-1</p>
        </td>
    </tr>

    <tr>
        <th class="contact">建物</th>
        <td class="contact-body">
            <input type="text" name="build" class="form-text" size="30">
            <p class="error" id="errorAddress"></p>
            <p class="message">*例）山田ビル</p>
        </td>
    </tr>
</table>
<input type="button" class="sample_btn" id="submit-btn" value="支払い方法入力" name="2">
<script src="../../js/index2.js"></script>