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

    });

})( jQuery );