//preenchar campos ao sai do input cep
var App_marcas = function() {

    var envia_imagem_marca = function() {

        $(document).on('change', '[name="marca_foto"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="marca_foto"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('marca_foto', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'marcas/upload_file',
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
                        $('#box-foto-marca').html("<input type='hidden' name='marca_foto_troca' value='" + response.marca_foto_troca + "' > <img src='" + BASE_URL + "uploads/marcas/" + response.marca_foto_troca + "' alt='' class='img-thumbnail mb-2 mr-1'> ");

                    } else {
                        $('#marca_foto_troca').html(response.mensagem);
                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#marca_foto_troca').html(response.mensagem);

                }

            });

        });

    }

    return {
        init: function() {
            envia_imagem_marca();
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

    App_marcas.init();

});