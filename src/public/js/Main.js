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
            url: Url.base_url+$("#controller").val()+'/destroy/'+Main.id_registro,
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
    }
}