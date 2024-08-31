function l(a){
    console.log(a);
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}

function GoToScroll(id,tempo){
   $('html,body').animate({scrollTop: ($("#"+id).offset().top)-60  },tempo);
}

function GoToScrollElem(elem,tempo){
    var hheader = $('.navbar').outerHeight();
    $('html,body').animate({scrollTop: ($(elem).offset().top) - hheader  },tempo);
}

(function ( $ ) {
  $.fn.validator_form = function( options ) {

    var cfg = $.extend({
      testi : {
        'mancano' : 'Per inviare il form mancano i seguenti dati',
        'richiesto' : 'Questo campo è richiesto'
      },
      classi : {
          riga : 'riga',
          obbligatorio : 'obb',
          voce : 'cosa',
          avviso : 'avviso'
      }
    }, options );
    var ritorno = false;

    $(this).find('.validator_error_msg').remove();
    $(this).find('.errore').removeClass('errore');
    var contatore = $(this).find('div.'+cfg.classi.obbligatorio).length;
    var conta = 1;
    var toterrori = 0;
    $(this).find('div.'+cfg.classi.obbligatorio).each(function(){
      errore = 0;
      //controllo i tipi di errore
      var ilcampo = $(this).find('input, textarea, select');
      var tipodato = $(ilcampo).attr('tipodato');
      //alert(tipodato)                        ;

      switch(tipodato){
        case 'radio':
          $(ilcampo).each( function(){
            if($(this).hasClass('obb') && !$(ilcampo).is(":checked") ){
                errore = 1;
            }
          });

        break;
        case 'checkbox':
          //alert( $(ilcampo).attr('name'));
          $(ilcampo).each( function(){
                        if($(this).hasClass('obb') && !$(this).is(":checked")){
                          errore = 1;
                        }
                        });
        break;

        case 'textarea':
        case 'text':
        default:
          var ilvalore = $(ilcampo).val();
          if($.trim(ilvalore) == '') {errore = 1;}
          if($(ilcampo).attr('name') == 'modulo[Email]'){
              if(!validateEmail( $(ilcampo).val()) ){
                  errore = 1;
              }
          }
        break;
      }
      if(errore == 1){
        //alert(cosa);
        $(ilcampo).closest('.riga').addClass('errore');
        var cosa = $(this).find('.'+cfg.classi.voce).text();
        cosa = cosa.replace(":","");
        ritorno = false;
        toterrori = toterrori+1;
      }
      if(conta == contatore){
        //return ritorno;
      }
      conta++;
    });
    //console.log('form'+toterrori);
    if(toterrori==0){
      //console.log('và?');
      //grecaptcha.execute();
      return true;
    }else{
      return false;  
    }
    
  };
}( jQuery ));
