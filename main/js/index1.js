$(function() {
    // 入力チェック（リアルタイム）
    //エラーフラグチェック変数
    var errorName = true;
    var errorFuri = true;
    var errorPhone = true;
    var errorPass = true;
    var errorPass2 = true;

    //エンターを押下後に次のフォーム移動
    $('.form-text').on("keydown", function(e) {
        var n = $('.form-text').length;
        if (e.which == 13) {
            e.preventDefault();
            var Index = $('.form-text').index(this);
            var nextIndex = $('.form-text').index(this) + 1;
            if (nextIndex < n) {
                $('.form-text')[nextIndex].focus(); // 次の要素へフォーカスを移動
            } else {
                $('.form-text')[Index].blur(); // 最後の要素ではフォーカスを外す
            }
        }
    });

    //名前
    $("input[name='name']").blur(function() {
        if ($(this).val() == "") {
            $(this).css("background-color", "#FFCCCC");
            $("#errorname").text("入力してください。")
            errorName = false
        } else if (!$(this).val().match(/^[ぁ-んァ-ヶー一-龠]+$/)) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorname").text("※ふりがな、カタカナ、漢数字、漢字以外入力しないでください")
            errorName = false
        } else {
            $(this).css("background-color", "#CCFFCC");
            $("#errorname").text(" ")
            errorName = true
        }
    });
    //フリガナ
    $("input[name='furigana']").blur(function() {
        if ($(this).val() == "") {
            $(this).css("background-color", "#FFCCCC");
            $("#errorfuri").text("入力してください。")
            errorFuri = false
        } else if (!$(this).val().match(/^[ァ-ロワヲンー]*$/)) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorfuri").text("カタカナ以外入力しないでください")
            errorFuri = false
        } else {
            $(this).css("background-color", "#CCFFCC");
            $("#errorfuri").text(" ")
            errorFuri = true
        }
    });
    //電話
    $("input[name='電話']").blur(function() {
        $hyphen = $(this).val().replace(/[━.*‐.*―.*－.*\–.*ー.*\-]/gi, '');
        $(this).val($hyphen)

        if ($(this).val() == "") {
            $(this).css("background-color", "#FFCCCC");
            $("#errorphone").text("入力してください。")
            errorPhone = false
        } else if (!$(this).val().match(/^[0-9]+$/)) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorphone").text("数字以外入力しないでください。")
            errorPhone = false
        } else if (!$(this).val().match(/^\d{2,4}\d{2,4}\d{4}$/)) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorphone").text("正規表現で入力してください。")
            errorPhone = false
        } else {
            $(this).css("background-color", "#CCFFCC");
            $("#errorphone").text(" ")
            errorPhone = true
        }
    });
    //パスワード
    $("input[name='パスワード']").blur(function() {
        var txt = $(this).val();
        if ($(this).val() == "") {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass").text("入力してください。")
            errorPass = false
        } else if (!$(this).val().match(/[0-9a-zA-Z]/)) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass").text("半角英数字のみしてください。")
            errorPass = false
        } else if (16 < txt.length) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass").text("16文字以下でパスワードを入力してください。")
            errorPass = false
        } else if (8 > txt.length) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass").text("8文字以上でパスワードを入力してください。")
            errorPass = false
        } else if (!($(this).val().match(/([a-zA-Z])/) && $(this).val().match(/([0-9])/))) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass").text("半角英字と数字を1文字以上入力してください。")
            errorPass = false
        } else if (!($(this).val().match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass").text("半角英字の大文字と小文字を1文字以上入力してください。")
            errorPass = false
        } else {
            $(this).css("background-color", "#CCFFCC");
            $("#errorpass").text(" ")
            errorPass = true
        }
    });
    //パスワードを可視化
    //チェックボックスの変化時関数
    $("#password-check").change(function() {
        if ($(this).prop("checked")) {
            //チェックONの場合
            $("input[name='パスワード']").attr("type", "text");
        } else {
            //チェックOFFの場合
            $("input[name='パスワード']").attr("type", "password");
        }
    });
    //パスワード(再入力)
    $("input[name='パスワード(再)']").blur(function() {
        var txt = $(this).val();
        if ($(this).val() == "") {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass2").text("入力してください。")
            errorPass2 = false
        } else if (!(txt === $('input[name="パスワード"]').val())) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass2").text("上記のパスワードと同じパスワードを入力してください。")
            errorPass2 = false
        } else if (errorPass === false) {
            $(this).css("background-color", "#FFCCCC");
            $("#errorpass2").text("上記のパスワードを修正してください。")
            errorPass2 = false
        } else {
            $(this).css("background-color", "#CCFFCC");
            $("#errorpass2").text(" ")
            errorPass2 = true
        }
    });
    //パスワードを可視化
    //チェックボックスの変化時関数
    $("#password-check2").change(function() {
        if ($(this).prop("checked")) {
            //チェックONの場合
            $("input[name='パスワード(再)']").attr("type", "text");
        } else {
            //チェックOFFの場合
            $("input[name='パスワード(再)']").attr("type", "password");
        }
    });
    //スクロールイベント
    $('#agree-check').prop('disabled', true);
    $('.privacy-policy').on('scroll', function() {
        var innerHeight = $('.privacy-policy-aaa').innerHeight(), //内側の要素の高さ
            outerHeight = $('.privacy-policy').innerHeight(), //外側の要素の高さ
            outerBottom = innerHeight - outerHeight; //内側の要素の高さ - 外側の要素の高さ
        if (outerBottom <= $('.privacy-policy').scrollTop()) {
            //指定した要素の一番下までスクロールした時に実行
            $('#agree-check').prop('disabled', false);
        }
    });

    //submit-btn
    //ボタン　非活性・活性
    //始めにjQueryで送信ボタンを無効化する
    $('#submit-btn').prop("disabled", true);

    //始めにjQueryで必須欄を加工する
    $('table input:required').each(function() {
        $(this).prev("label").addClass("required");
    });

    //入力欄の操作時
    //必須項目が空かどうかフラグ
    let flag;
    $('table input:required').blur(function() {
        //必須項目をひとつずつチェック
        $('table input:required').each(function(e) {
            //もし必須項目が空なら
            if ($('table input:required').eq(e).val() === "") {
                flag = false;
            } else if (errorName === false || errorFuri === false || errorPhone === false || errorPass === false || errorPass2 === false) {
                flag = false;
            } else {
                flag = true
            }
        });
    });

    //全て埋まっていたら
    $(document).on('click', '#agree-check', function() {
        if ($(this).prop('checked') == true) {
            if (flag === true) {
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#submit-btn').prop('disabled', true);
            }
        } else {
            $('#submit-btn').prop('disabled', true);
        }
    });
});