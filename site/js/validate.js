(function( $ ) {

    $( document ).ready(function() {


        // --- Formulario de vacaciones consistencia ---
        if ( $('.frm-tezza.vacaciones').length ){

            var ddesde =  $('[name="ff_nm_descansodesde[]"]');
            var dhasta = $('[name="ff_nm_descansohasta[]"]');
            var dretorno = $('[name="ff_nm_reincorporacion[]"]');
            var id_jefe = $('[name="ff_nm_id_jefe[]"]');

            if ( ! id_jefe.val() ) {
                alert('El Usario No tiene que tener un área asignada');
                $('[name="ff_nm_enviar[]"]').prop('disabled', true);
            }

            //Establecer a readonly las fechas
            ddesde.prop('readonly', true);
            dhasta.prop('readonly', true);
            dretorno.prop('readonly', true);

            // Evento para validar fechas antes y después
            $('[name="ff_nm_enviar[]"]').on('click',function(){

                var fdesde = convert_date(ddesde.val());
                var fhasta = convert_date(dhasta.val());
                var fretorno = convert_date(dretorno.val());


                if ( fhasta < fdesde) {
                    alert('Existe un error en las fechas desde - hasta');
                } else if ( fretorno < fhasta ){
                    alert('Existe un error en las fecha de vacaciones y de retorno');
                } else {
                    ff_validate_submit(this,'click');
                }

            });

        } // fin formulario vacaciones

    });

    function convert_date( strDate ){
        var dateParts = strDate.split("/");
        var dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
        return dateObject;
    }


})( jQuery );







        // $('#ff_form5').submit(function (evt) {
        //     evt.preventDefault();
        //     // alert('prevent subimit');
        // });


        // $('#ff_elem377').on('change', function() {
        //     // var fecha = new Date($('#ff_elem377').value).toISOString().slice(0,10);
        //     alert('hola');
        // });




        // $('#bfSubmitButton').on('click',function(e){
        //     e.preventDefault();
        // })

        // $('ff_form5').submit(function(event){
        //     event.preventDefault();
        // });

        // $('#ff_form5').on('submit',function(){


        // });

        // $('#ff_elem377').on('change', function() {
        //     // var fecha = new Date($('#ff_elem377').value).toISOString().slice(0,10);
        //     alert('hola');
        // });


        // Para el formulario de Vacaciones
        // if (
        //     $('#ff_elem326').length > 0 &&
        //     $('#ff_elem569').length > 0 &&
        //     $('#ff_elem377').length > 0){
        // }

