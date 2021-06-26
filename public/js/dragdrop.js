$(document).ready(function () {
    var id;
    $(".click").hover(function () {
        id = $(this).children("#id").first().text();
    });

    $(".sortable").sortable({
        update: function (event, ui) {
            var postData = $(this).sortable('toArray');
            console.log(postData);
            $.ajax({
                type: "POST",
                url: 'changeStatus',
                data: {
                    data: postData,
                    id: id
                },
                dataType: "json",
                async: false,
            });
        }
    });
});