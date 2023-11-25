//preenchar campos ao sai do input cep
var App_pecas = function() {

    var envia_imagem_peca = function() {

        $(document).on('change', '[name="peca_foto"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="peca_foto"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('peca_foto', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'pecas/upload_file',
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
                        $('#box-foto-peca').html("<input type='hidden' name='peca_foto_troca' value='" + response.peca_foto_troca + "' > <img src='" + BASE_URL + "uploads/pecas/small/" + response.peca_foto_troca + "' alt=''> ");

                    } else {
                        $('#peca_foto_troca').html(response.mensagem);
                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#peca_foto_troca').html(response.mensagem);

                }

            });

        });

    }

    return {
        init: function() {
            envia_imagem_peca();
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

    App_pecas.init();

});