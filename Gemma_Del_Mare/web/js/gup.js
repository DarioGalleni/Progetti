/* Utility functions and simple form validator
   Cleaned: removed debug logs and tightened formatting
*/

function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test(email);
}

function GoToScroll(id, tempo) {
  var $target = $("#" + id);
  if ($target.length) {
    $('html,body').animate({ scrollTop: ($target.offset().top) - 60 }, tempo);
  }
}

function GoToScrollElem(elem, tempo) {
  var hheader = $('.navbar').outerHeight() || 0;
  var $elem = $(elem);
  if ($elem.length) {
    $('html,body').animate({ scrollTop: ($elem.offset().top) - hheader }, tempo);
  }
}

(function($) {
  $.fn.validator_form = function(options) {
    var cfg = $.extend({
      testi: {
        'mancano': 'Per inviare il form mancano i seguenti dati',
        'richiesto': 'Questo campo è richiesto'
      },
      classi: {
        riga: 'riga',
        obbligatorio: 'obb',
        voce: 'cosa',
        avviso: 'avviso'
      }
    }, options);

    $(this).find('.validator_error_msg').remove();
    $(this).find('.errore').removeClass('errore');

    var contatore = $(this).find('div.' + cfg.classi.obbligatorio).length;
    var toterrori = 0;

    $(this).find('div.' + cfg.classi.obbligatorio).each(function() {
      var errore = 0;
      var ilcampo = $(this).find('input, textarea, select');
      var tipodato = ilcampo.attr('tipodato');

      switch (tipodato) {
        case 'radio':
          if (ilcampo.filter(':checked').length === 0) errore = 1;
          break;
        case 'checkbox':
          if (ilcampo.filter(':checked').length === 0) errore = 1;
          break;
        case 'textarea':
        case 'text':
        default:
          var ilvalore = ilcampo.val();
          if ($.trim(ilvalore) === '') errore = 1;
          if (ilcampo.attr('name') === 'modulo[Email]' && !validateEmail(ilcampo.val())) errore = 1;
          break;
      }

      if (errore === 1) {
        ilcampo.closest('.' + cfg.classi.riga).addClass('errore');
        toterrori += 1;
      }
    });

    return toterrori === 0;
  };
})(jQuery);
