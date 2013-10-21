/*
* Redireciona a pagina com o ID selecionado de parametro
*/
function redirect_id(v) {    
    action = action.replace('admin_', '');
    if(admin) {
        admin = 'admin/';
    } else {
        admin = '';
    }   
    document.location.href = host + www + admin + controller + '/' + action + '/' + v;
}

/*
* LARGURA E ALTURA DA TELA
*/
var WIDTH  = $(window).width();
var HEIGHT = $(window).height();

/*
* DOCUMENTO READY
*/
$(document).ready(function() {
    
    /*
    * Mascaras
    */
    $(".telefone").mask("(99)9999-9999?9",{placeholder:''});
    $(".cpf").mask("999.999.999-99",{placeholder:''});
    $(".cep").mask("99999-999",{placeholder:''});
    $(".estado").mask("aa",{placeholder:''});
    $(".numeric").mask("9?9999999999999",{placeholder:''});
    $(".numeric1").mask("9",{placeholder:''});
    $(".numeric2").mask("9?9",{placeholder:''});
    $(".numeric3").mask("9?99",{placeholder:''});  
    $(".alpha").mask("a?aaaaaaaaaaaaaaaaaaaaaaa",{placeholder:''});
    $(".alpha1").mask("a",{placeholder:''});
    $(".alpha2").mask("a?a",{placeholder:''});
    $(".alpha3").mask("a?aa",{placeholder:''});
    $(".alphanumeric1").mask("*",{placeholder:''});
    $(".alphanumeric2").mask("*?*",{placeholder:''});
    $(".alphanumeric3").mask("*?**",{placeholder:''});
    $(".moeda").priceFormat({thousandsSeparator:'', centsSeparator:'.', prefix: ''});
    $(".maskhora").mask("99:99",{placeholder:''}); 
    $(".number_prodesp").mask("999.999.999",{placeholder:''});
    $(".data, input.nascimento").mask("99/99/9999",{placeholder:''});
    
    /*
    * DatePicker
    */  
    $.datepicker.regional['pt'] = {
            closeText: 'Fechar',
            prevText: 'Anterior',
            nextText: 'Seguinte',
            currentText: 'Hoje',
            monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
            dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
            weekHeader: 'Sem',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['pt']);        
    $( "input.data" ).datepicker();
    $( "input.nascimento" ).datepicker({ 
        dateFormat: 'dd/mm/yy',
        maxDate: 0,
        defaultDate: '01/01/1980'
    }); 
    $( "input.datatime" ).datetimepicker({ 
        dateFormat: 'dd/mm/yy',
        addSliderAccess: true,
        sliderAccessArgs: {touchonly: false}}); 
    $( "input.datatime30" ).datetimepicker({ 
        stepMinute: 30,
        dateFormat: 'dd/mm/yy',
        addSliderAccess: true,
        sliderAccessArgs: {touchonly: false}});         
    $('input.hora').timepicker({
        addSliderAccess: true,
        sliderAccessArgs: {touchonly: false}, 
        hourMin: 0,
        hourMax: 23});        
    $('input.hora30').timepicker({
        stepMinute: 30,
        addSliderAccess: true,
        sliderAccessArgs: {touchonly: false}, 
        hourMin: 0,
        hourMax: 23}); 
    
    /*
    * CEP
    */          
    $(".cep").keyup(function(e) {
        var v = $(this).val().replace('_','').replace('_','');
        if(v.length >= 8) {
            $('.loading-cep').show();
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$(".cep").val(), function(){  
                if(resultadoCEP["tipo_logradouro"]){  
                    $(".endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));  
                    $(".bairro").val(unescape(resultadoCEP["bairro"]));  
                    $(".cidade").val(unescape(resultadoCEP["cidade"]));  
                    $(".estado").val(unescape(resultadoCEP["uf"]));
                    $(".numero").focus();
                }
                $('.loading-cep').hide();
            });
        }
    }); 

    /*
    * DIALOG
    */  
    $( "#dialog" ).dialog({
        modal: true,
        buttons: {
            Ok: function() {
                $( this ).dialog( "close" );
            }
        }
    });   
    
    /*
    * AUTOCOMPLETE
    */ 
    var cache = {};
    $( ".autocomplete" ).autocomplete({
        minLength: 2,
        source: function( request, response ) {
            var term = request.term;
            if ( term in cache ) {
                response( cache[ term ] );
                return;
            }
            params = $(".autocomplete").attr('rel');
            alert(www+controller+'/autocomplete/'+request.term+'/'+params);
            $.getJSON( www+controller+'/autocomplete/'+request.term+'/'+params , request, function( data, status, xhr ) {
                cache[ term ] = data;
                response( data );
            });
        },
        select: function( event, ui ) {
            //alert( ui.item.value )
            //alert( ui.item.label )
            //$( ".autocomplete" ).blur();
        }
    });
    
    /*
    * SUBSTITUI ENTER POR TAB
    */ 
    $('input').live("keypress", function(e) {
        /* ENTER PRESSED*/
        if (e.keyCode == 13) {
            /* FOCUS ELEMENT */
            var inputs = $(this).parents("form").eq(0).find(":input:visible");
            var idx = inputs.index(this);
            if($(this).attr('type')=='submit') {
                return true;
            } if($(this).attr('class')=='submit') {
                return true;
            } if($(this).attr('class')=='sel-nota') {
                return true;
            }
            if (idx == inputs.length - 1) {
                inputs[0].select()
            } else {
                idx = idx + 1;
                inputs[idx].focus();
            }
            return false;
        }
    });    

    /*
    * MANTEM SESSAO ABERTA
    */
    setInterval('maintain_session_open()',120000);
    
    /*
    * TOOLTIP
    */
    $('.tooltip').tooltip({
        track: true
    });
    
    /*
    * CHECKBOX SELECT ALL
    */
    $('.checkbox_all').click(function () {
        $('.list').find(':checkbox').attr('checked', this.checked);
    });
    
    /*
    * CKEDITOR
    */
    var ckeditor = {
        filebrowserBrowseUrl      : www+'webroot/js/kcfinder/browse.php?type=files',
        filebrowserImageBrowseUrl : www+'webroot/js/kcfinder/browse.php?type=images',
        filebrowserFlashBrowseUrl : www+'webroot/js/kcfinder/browse.php?type=flash',
        filebrowserUploadUrl      : www+'webroot/js/kcfinder/upload.php?type=files',
        filebrowserImageUploadUrl : www+'webroot/js/kcfinder/upload.php?type=images',
        filebrowserFlashUploadUrl : www+'webroot/js/kcfinder/upload.php?type=flash',
        language : 'pt-BR',
        forcePasteAsPlainText : true,
        disableReadonlyStyling : true,
        font_defaultLabel : 'Verdana',
        font_names : 'Verdana',
        height: '100px',
        toolbar :
        [
            { name: 'styles', items : [ 'Styles','Format','FontSize' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] },
            { name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar' ] },
            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
            '/',
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] }
        ]
    };
    $( '.ckeditor' ).ckeditor( ckeditor );
});

/*
* DIALOG COM AJAX
* AINDA NAO ESTA SENDO USADO
* PODE SER RECONFIGURADO TOTALMENTE
*/  
function ajax_dialog(el, url) {
    $('.'+el.id).dialog({
        modal: true,
        open: function () {
            $(this).load(url);
        }
    });    
}

/*
* REQUISICOES AJAX PARA MANTER A SESSAO ABERTA
*/
function maintain_session_open() {
    $.get(www+'pages/blank', function(data) {});
}