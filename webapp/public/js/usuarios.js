//preenchar campos ao sai do input cep
var App_usuarios = function() {

    var envia_imagem_usuario = function() {

        $(document).on('change', '[name="prod_imagem"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="prod_imagem"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('prod_imagem', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'produtos/upload_file',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    //definir disables
                    $('#user_foto').html('');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#box-foto-usuario').html("<input type='hidden' name='user_foto' value='" + response.user_foto + "' > <img src='" + BASE_URL + "uploads/usuarios/small/" + response.user_foto + "' alt=''> ");

                    } else {
                        $('#user_foto').html(response.mensagem);
                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#user_foto').html(response.mensagem);

                }

            });

        });

    }

    var carrega_categoria = function() {

        $(document).on('change', '[name="prod_cat_principal"]', function() {


            var id = $('select[name=prod_cat_principal]').val();
            // alert(id);

            $.ajax({
                url: BASE_URL + "subcategorias/carregar/",
                dataType: "json",
                type: "post",
                data: {
                    id: id,
                },
                success: function(response) {

                    if (response.error === 0) {

                        document.getElementById("box").innerHTML = "";

                        for (var cont = 0; cont < 25; cont++) {

                            document.getElementById("box").innerHTML += "<option value='" + response[cont].scat_id + "'>" + response[cont].scat_titulo + "</option>";

                        }

                    } else {
                        document.getElementById("box").innerHTML = "";
                    }

                },
                error: function(response) {
                    // alert("erro");
                }
            }).always(function(res) {
                // alert("sempre");
            });

        });

    }

    return {
        init: function() {
            envia_imagem_usuario();
            carrega_categoria();
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

    App_usuarios.init();

});