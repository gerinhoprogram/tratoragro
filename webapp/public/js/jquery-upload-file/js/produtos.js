$(document).ready(function() {
    $("#fileuploader").uploadFile({
        url: BASE_URL + "produtos/upload",
        fileName: "foto_produto",
        returnType: "json",
        onSuccess: function(files, data) {

            if (data.erro === 0) {
                $("#uploaded_image").append('<div class="col-md-3 text-center box"><img src="' + BASE_URL + 'uploads/produtos/' + data.uploaded_data['file_name'] + '" class="img-thumbnail mb-2 mr-1"><input type="hidden" name="fotos_produtos[]" value="' + data.foto_nome + '"><div class="btn btn-block btn-sm btn-danger btn-remove btn-icon">Retirar</div><div><input type="radio" name="foto_principal" value="' + data.foto_nome + '"/>&nbsp;Foto principal</div></div>');
            } else {

                $("#erro_uploaded").html(data.mensagem);
            }

        },
    });


    $('#uploaded_image').on('click', '.btn-remove', function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-danger text-white ml-2',
                cancelButton: 'btn bg-primary text-white mr-20'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Tem certeza da exclusão?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-exclamation-circle"></i>&nbsp;Excluir!',
            cancelButtonText: '<i class="fa fa-arrow-circle-left"></i>&nbsp;Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $(this).parent().remove();
            } else {
                return false;
            }
        })
    });

});