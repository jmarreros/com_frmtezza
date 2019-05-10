(function( $ ) {

    $( document ).ready(function() {
        $('.msg-approval').hide();


        $('#adminForm input').on('change', function() {
            var tezza_approval = $('input[name=tezza_approval]:checked').val();

            if ( tezza_approval == "1" ){
                $('.msg-approval').show();
                $('.msg-approval').text('Aprobado');
                $('.msg-approval').removeClass('uncheck');
            } else if( tezza_approval == "0" ) {
                $('.msg-approval').show();
                $('.msg-approval').text('No Aprobado');
                $('.msg-approval').addClass('uncheck');
            }

        });

        $('#adminForm input').trigger('change');

        // Warning discart documment, for rrhh boss
        $('#tezza_vb_rrhh_no').on('change',function(){
            var opcion = confirm("¿Estas seguro de desaprobar este documento?");
            if ( ! opcion ){
                $(this).prop('checked', false);
            }
        });

        $('#date_star').prop("readonly", true);
        $('#date_end').prop("readonly", true);

        $('#frm-filter').click(function(e){
            // e.preventDefault();

        });

    });


})( jQuery );

