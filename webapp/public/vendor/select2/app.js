$(document).ready(function() {


    $('.categorias').select2({
        placeholder: "Digite ou escolha",
        allowClear: true,
        "language": {
            "noResults": function() {
                return '<span class="text-danger">Categoria não encontrada</span> <a href="' + BASE_URL + 'categorias/adicionar" target="_parent" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });

    $('.subcategorias').select2({
        placeholder: "Digite ou escolha",
        allowClear: true,
        "language": {
            "noResults": function() {
                return '<span class="text-danger">Subcategoria não encontrada</span> <a href="' + BASE_URL + 'subcategorias/adicionar" target="_parent" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });

    $('.marcas').select2({
        placeholder: "Digite ou escolha",
        allowClear: true,
        "language": {
            "noResults": function() {
                return '<span class="text-danger">Marca não encontrada</span> <a href="' + BASE_URL + 'marcas/adicionar" target="_parent" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });

});