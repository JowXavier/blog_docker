var Main = {
    modal : function(tipo, mensagem)
    {
        $("#mensagem_"+tipo).html(mensagem);
        $('#modal_'+tipo).modal({
            keyboard: true,
            backdrop : 'static',
        });

        if(tipo == "aviso")
        {
            $('#modal_aviso').on('shown.bs.modal', function () {
                $('#bt_close_modal_aviso').trigger('focus')
            })
        }
        else if(tipo == "confirm")
        {
            $('#modal_confirm').on('shown.bs.modal', function () {
                $('#bt_confirm_modal').trigger('focus')
            })
        }
    },
    id_registro : "",
    confirm_delete : function(id)
    {
        Main.id_registro = id;

        Main.modal("confirm", "Deseja realmente excluir o registro selecionado?");
    },
    delete_registro : function()
    {
        $.ajax({
            url: Url.base_url+$("#controller").val()+'/delete/'+Main.id_registro,
            dataType:'json',
            cache: false,
            type: 'GET',
            success: function (data) {
                location.reload();
            }
        }).fail(function(msg){
            setTimeout(function(){
                $("#modal_confirm").modal('hide');
                Main.modal("aviso", "Houve um erro ao processar sua requisição.");
            },500);
        });
    },
    method : '',
    form : '',
    method_redirect : '',
    create_edit : function ()
    {
        Main.modal("aguardar", "Aguarde... processando dados.");
        //QUANDO NÃO FOR DEFINIDO NENHUM MÉTODO NO 'init.js', POR DEFAULT É CONSIDERADO O METÓDO STORE PARA RECEBER OS DADOS

        if(Main.method == "" || Main.method == null)
            Main.method = "store";

        //QUANDO NÃO HÁ NECESSIDADE DE COLOCAR UM NOME ESPECÍFICO PRO FORMULÁRIO, USA O NOME PADRÃO ESPECIFICADO ABAIXO
        if(Main.form == "" || Main.form == null)
            Main.form = "form_cadastro";

        //QUANDO O MÉTODO DE REDIRECT NÃO É ESPECIFICADO, CONSIDERAR O PADRÃO index
        if(Main.method_redirect == "" || Main.method_redirect == null)
            Main.method_redirect = "";

        $.ajax({
            url: Url.base_url+$("#controller").val()+'/'+Main.method,
            data: $("#"+$("form[name="+Main.form+"]").attr("id")).serialize(),
            dataType:'json',
            cache: false,
            type: 'POST',
            success: function (msg) {
                if(msg.response == "sucesso")
                {
                    $("#mensagem_aguardar").html("Dados salvos com sucesso");
                    if(Main.method_redirect == "refresh")
                        location.reload();
                    else
                        window.location.assign(Url.base_url+$("#controller").val()+"/"+ Main.method_redirect);
                }
                else
                {
                    setTimeout(function(){
                        $("#modal_aguardar").modal('hide');
                        Main.modal("aviso", msg.response);
                    },500);
                }
            }
        }).fail(function(msg){
            setTimeout(function(){
                $("#modal_aguardar").modal('hide');
                Main.modal("aviso", "Houve um erro ao processar sua requisição. Verifique sua conexão com a internet.");
            },500);
        });
    },
    show_error : function(form, error, class_error)
    {
        if(class_error != "")
            document.getElementById(form).className = "form-control "+class_error;
        if(error != "" && document.getElementById(form) != undefined)
            document.getElementById(form).focus();

        document.getElementById("error-"+form).innerHTML = error;
    },
    post_validar : function ()
    {
        if($("#title").val() == "")
            Main.show_error("title", 'Informe o título do post', 'is-invalid');
        else if($("#description").val() == "")
            Main.show_error("description", 'Informe a descrição do post', 'is-invalid');
        else if($("#form_cadastro_"+$("#controller").val()).find("input[name='tag[]']:checked").length == 0)
            Main.show_error("tag", 'Selecione pelo menos uma tag', '');
        else
            Main.create_edit();
    },
    tag_validar : function ()
    {
        if($("#title").val() == "")
            Main.show_error("title", 'Informe o título da tag', 'is-invalid');
        else if($("#url").val() == "")
            Main.show_error("url", 'Informe a url da tag', 'is-invalid');
        else
            Main.create_edit();
    },
    comentario_validar : function ()
    {
        Main.method_redirect = "refresh";
        Main.method = "storeComment";
        if($("#description").val() == "")
            Main.show_error("description", 'Informe o seu comentário', 'is-invalid');
        else
            Main.create_edit();
    }
}