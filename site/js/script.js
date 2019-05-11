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
            // validate dates
            if ( ( $('#date_star').val() && ! $('#date_end').val() ) ||
                 ( ! $('#date_star').val() && $('#date_end').val() ) ){
                e.preventDefault();
                alert('Tienes que completar ambas fechas');
            }
        });

        $('#clear-filter').click(function(e){
            e.preventDefault();
            $('#pending-approve').prop("checked", false);
            $('#pending-rrhh').prop("checked", false);
            $('#date_star').val('');
            $('#date_star').attr('data-alt-value','');
            $('#date_end').val('');
            $('#date_end').attr('data-alt-value','');
            $('#indicio-nombre').val('');
            $('#filter-document').val('');
            $('#filter-area').val('0');
        });

    });


})( jQuery );

