$(function() {
    //支払い方法

    let eroorCard;
    let card;
    let code
    let Expiry

    $('[name=pay]').change(function() {
        let val = $('[name=pay]').val();
        if (val === "1") {
            $('input[name="creditnumber"]').removeAttr("disabled");
            $('input[name="card"]').removeAttr("disabled");
            $('input[name="code"]').removeAttr("disabled");
            eroorCard = false;
            card = false
            code = false
            Expiry = false
        } else if (val === "2") {
            $('input[name="creditnumber"').attr("disabled", "disabled").val("");
            $('input[name="card"').attr("disabled", "disabled").val("");
            $('input[name="code"').attr("disabled", "disabled").val("");
            eroorCard = true;
            card = true
            code = true
            Expiry = true
        } else {
            $('input[name="creditnumber"').attr("disabled", "disabled").val("");
            $('input[name="card"').attr("disabled", "disabled").val("");
            $('input[name="code"').attr("disabled", "disabled").val("");
            eroorCard = false;
            card = false
            code = false
            Expiry = false
        }
    });

    // 入力チェック（リアルタイム）


    $("input[name='creditnumber']").blur(function() {
        var txt = $(this).val();
        var pay = $('[name=pay]').val();
        if (pay === "1") {
            if ($(this).val() == "") {
                $(this).css("background-color", "#FFCCCC");
                $("#errorCard").text("入力してください。")
                eroorCard = false
                card = false
            } else if (!$(this).val().match(/^[0-9]+$/)) {
                $(this).css("background-color", "#FFCCCC");
                $("#errorCard").text("数字以外入力しないでください。")
                eroorCard = false
                card = false
            } else if (19 < txt.length) {
                $(this).css("background-color", "#FFCCCC");
                $("#errorCard").text("19文字以上のクレジットカードはありません。")
                eroorCard = false
                card = false
            } else if (txt.length < 14) {
                $(this).css("background-color", "#FFCCCC");
                $("#errorCard").text("14文字以下のクレジットカードはありません。")
                eroorCard = false
                card = false
            } else {
                $(this).css("background-color", "#CCFFCC");
                $("#errorCard").text(" ")
                eroorCard = true
                card = true
            }
        } else {
            $("#errorCard").text(" ")
            eroorCard = true;
            card = true
        }
    });

    $("input[name='card']").blur(function() {
        var pay = $('[name=pay]').val();
        if (pay === "1") {
            if ($(this).val() == "") {
                $(this).css("background-color", "#FFCCCC");
                $("#errorExpiry").text("入力してください。")
                eroorCard = false
                Expiry = false
            } else {
                $(this).css("background-color", "#CCFFCC");
                $("#errorExpiry").text(" ")
                eroorCard = true
                Expiry = true
            }
        } else {
            $("#errorExpiry").text(" ")
            eroorCard = true;
            Expiry = true
        }
    });

    $("input[name='code']").blur(function() {
        var pay = $('[name=pay]').val();
        var txt = $(this).val();
        if (pay === "1") {
            if ($(this).val() == "") {
                $(this).css("background-color", "#FFCCCC");
                $("#errorCode").text("入力してください。")
                eroorCard = false
                code = false
            } else if (!$(this).val().match(/^[0-9]+$/)) {
                $(this).css("background-color", "#FFCCCC");
                $("#errorCode").text("数字以外入力しないでください。")
                eroorCard = false
                code = false
            } else if (!(3 === txt.length)) {
                $(this).css("background-color", "#FFCCCC");
                $("#errorCode").text("セキュリティコードは3文字です。")
                eroorCard = false
                code = false
            } else {
                $(this).css("background-color", "#CCFFCC");
                $("#errorCode").text(" ")
                eroorCard = true
                code = true
            }
        } else {
            $("#errorCode").text(" ")
            eroorCard = true;
            code = true
        }
    });

    $('#submit-btn').prop("disabled", true);

    $('table').change(function() {
        if (eroorCard === false) {
            $('#submit-btn').prop("disabled", true);
        } else if (code === false || card === false || Expiry === false) {
            $('#submit-btn').prop("disabled", true);
        } else {
            $('#submit-btn').prop("disabled", false);
        }
    });
});