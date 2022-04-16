$(function() {
    //.sampleをクリックしてajax通信を行う
    let request = [{
        url: "index1.php"
    }, {
        url: "index2.php"
    }, {
        url: "index3.php"
    }, {
        url: "index4.php"
    }, ];
    let i;
    $(document).on('click', '.sample_btn', function() {
        let name = $('input[type="button"]').attr('name');

        if (name == '1') {
            i = 1;
        } else if (name == '2') {
            i = 2;
        } else if (name == '3') {
            i = 3;
        } else if (name == '4') {
            i = 0;
        }

        $.ajax({
            url: request[i].url,
            type: 'GET',
            dataType: 'text'
        }).done(function(data) {
            /* 通信成功時 */
            $('.result').html(data); //取得したHTMLを.resultに反映
        }).fail(function(data) {
            /* 通信失敗時 */
            alert('通信失敗！');
        });
    });
});