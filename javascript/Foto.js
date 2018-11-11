
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $img = $('<img/>').attr('src', e.target.result);
            $(input).after($img);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function verificaMostraBotao() {
    $('input[type=file]').each(function(index){
        if ($('input[type=file]').eq(index).val() != "")
            $('.hide').show();
    });
}

$('body').on("change", "input[type=file]", function() {
    verificaMostraBotao();
    readURL(this);
});

$('.hide').on("click", function() {
    $(document.body).append($('<input />', {type: "file" }).change(verificaMostraBotao));
    $('.hide').hide();
});
