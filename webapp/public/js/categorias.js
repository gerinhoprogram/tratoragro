//preenchar campos ao sai do input cep
var App_categorias = function() {

    var envia_imagem_categoria = function() {

        $(document).on('change', '[name="cat_imagem"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="cat_imagem"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('cat_imagem', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'categorias/upload_file',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    //definir disables
                    $('#carregando').html('<img src="' + BASE_URL + '/public/img/ajax-loader.gif">');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#carregando').html('');
                        $('#box-foto-categoria').html("<input type='hidden' name='cat_foto' value='" + response.cat_foto + "' > <img src='" + BASE_URL + "uploads/categorias/small/" + response.cat_foto + "' alt='' class='img-thumbnail mb-2 mr-1'> ");

                    } else {
                        $('#cat_foto').html(response.mensagem);
                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#cat_foto').html(response.mensagem);

                }

            });

        });

    }

    return {
        init: function() {
            envia_imagem_categoria();
        }
    }

}(); //inicializa ao carregar a view

jQuery(document).ready(function() {

    $(window).keydown(function() {

        if (event.keyCode === 13) {

            event.preventDefault();
            return false;

        }

    });

    App_categorias.init();

});