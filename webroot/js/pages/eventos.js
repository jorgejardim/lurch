$(document).ready(function() {
    
    $( "#EventoLocalPrivado" ).change(function() {
        chama_contato_privado();
    });
    chama_contato_privado();
    
    var cache = {};
    $( ".autocomplete_local" ).autocomplete({
        minLength: 2,
        source: function( request, response ) {            
            
            var term = request.term;
            if ( term in cache ) {
                response( cache[ term ] );
                return;
            }
            params = $(".autocomplete").attr('rel');
            $.getJSON( www+controller+'/autocomplete/'+request.term+'/'+params , request, function( data, status, xhr ) {
                cache[ term ] = data;
                response( data );
            });
        },
        select: function( event, ui ) {
            
            $( "#LocaiId" ).val(ui.item.id);
            $( "#EventoLocal" ).val(ui.item.value);
            $( "#EventoCep" ).val(ui.item.cep);
            $( "#EventoEndereco" ).val(ui.item.endereco);
            $( "#EventoNumero" ).val(ui.item.numero);
            $( "#EventoComplemento" ).val(ui.item.complemento);
            $( "#EventoBairro" ).val(ui.item.bairro);
            $( "#EventoCidade" ).val(ui.item.cidade);
            $( "#EventoEstado" ).val(ui.item.estado);
            $( "#LocaiContatoNome" ).val(ui.item.contato_nome);
            $( "#LocaiContatoEmail" ).val(ui.item.contato_email);
            $( "#LocaiContatoTelefone" ).val(ui.item.contato_telefone);                        
            $( "#EventoStatus" ).focus();
        }
    });
});

function chama_contato_privado() {
    if( $( "#EventoLocalPrivado" ).val()==0 ) {
        $( ".contato_privado" ).show();
    } else {
        $( ".contato_privado" ).hide();
    }
}