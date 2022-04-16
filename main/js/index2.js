$(function() {
    //index2.js
    //郵便番号
    var eroorPost = true;

    $("input[name='post']").blur(function() {
        $hyphen = $(this).val().replace(/[━.*‐.*―.*－.*\–.*ー.*\-]/gi, '');
        $(this).val($hyphen)

        if ($(this).val() == "") {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpost").text("入力してください。")
            eroorPost = false
        } else if (!$(this).val().match(/^[0-9\-]+$/)) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpost").text("数字、ハイフン以外入力しないでください。")
            eroorPost = false
        } else if (!$(this).val().match(/^[0-9]{3}[0-9]{4}$/)) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpost").text("正規表現で入力してください。")
            eroorPost = false
        } else {
            $(this).css("background-color", "#CCFFCC");
            $("#errorpost").text(" ")
            eroorPost = true
        }
    });
    //submit-btn(住所選択の)
    //ボタン　非活性・活性
    //始めにjQueryで送信ボタンを無効化する
    $('#submit-btn').prop("disabled", true);

    //入力欄の操作時
    $('table input:required').blur(function() {
        //必須項目が空かどうかフラグ
        //必須項目をひとつずつチェック
        $('table input:required').each(function(e) {
            //もし必須項目が空なら
            if ($('table input:required').eq(e).val() === "") {
                $('#submit-btn').prop("disabled", true);
            } else if (eroorPost === false) {
                $('#submit-btn').prop("disabled", true);
            } else {
                $('#submit-btn').prop("disabled", false);
            }
        });
    });
});