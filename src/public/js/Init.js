$(document).ready(
    //inicializa o html adicionando os envetos js especificados abaixo
    function()
    {
        $('#bt_delete').click(function()
        {
            Main.delete_registro();
        });

        $("#form_cadastro_post").submit(function(event)
        {
            event.preventDefault();
            Main.post_validar();
        });

        $("#form_cadastro_tag").submit(function(event)
        {
            event.preventDefault();
            Main.tag_validar();
        });

        $("#form_cadastro_comment").submit(function(event)
        {
            event.preventDefault();
            Main.comentario_validar();
        });

        $('#title').blur(function()
        {
            if (this.value != '') Main.show_error("title", '', 'is-valid');
        });

        $('#description').blur(function()
        {
            if (this.value != '') Main.show_error("description", '', 'is-valid');
        });

        $('#url').blur(function()
        {
            if (this.value != '') Main.show_error("url", '', 'is-valid');
        });

        $(document).ready(function() {
            $('.file-upload').file_upload();
        });
    }
);