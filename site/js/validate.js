(function( $ ) {

    $( document ).ready(function() {

        var id_jefe = $('[name="ff_nm_id_jefe[]"]');

        if ( ! id_jefe.val() ) {
            alert('El Usario No tiene área asignada');
            $('[name="ff_nm_enviar[]"]').prop('disabled', true);
        }

        // --- Formulario de vacaciones consistencia ---
        if ( $('.frm-tezza.descansovacacional').length ){

            var ddesde =  $('[name="ff_nm_descansodesde[]"]');
            var dhasta = $('[name="ff_nm_descansohasta[]"]');
            var dretorno = $('[name="ff_nm_reincorporacion[]"]');

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

        }
        // --- Formulario de permiso recuperable ---
        else if ( $('.frm-tezza.permisorecuperable').length ){
            var horainicio0 = $('[name="ff_nm_horainicio0[]"]');
            var horafin0 = $('[name="ff_nm_horafin0[]"]');
            var total0 = $('[name="ff_nm_total0[]"]');

            var rhorainicio0 = $('[name="ff_nm_horainiciorecuperacion0[]"]');
            var rhorafin0 = $('[name="ff_nm_horafinrecuperacion0[]"]');
            var rtotal0 = $('[name="ff_nm_horatotalrecuperacion0[]"]');

            var rhorainicio1 = $('[name="ff_nm_horainiciorecuperacion1[]"]');
            var rhorafin1 = $('[name="ff_nm_horafinrecuperacion1[]"]');
            var rtotal1 = $('[name="ff_nm_horatotalrecuperacion1[]"]');

            var rhorainicio2 = $('[name="ff_nm_horainiciorecuperacion2[]"]');
            var rhorafin2 = $('[name="ff_nm_horafinrecuperacion2[]"]');
            var rtotal2 = $('[name="ff_nm_horatotalrecuperacion2[]"]');

            $('[name="ff_nm_enviar[]"]').on('click',function(){
                if (
                    validate_time(horainicio0) && validate_time(horafin0) &&
                    validate_time(rhorainicio0) && validate_time(rhorafin0) &&
                    validate_time(rhorainicio1) && validate_time(rhorafin1) &&
                    validate_time(rhorainicio2) && validate_time(rhorafin2)
                    ){

                    var dif0 = difference_time(horainicio0.val(), horafin0.val());
                    var rdif0 = difference_time(rhorainicio0.val(), rhorafin0.val());
                    var rdif1 = difference_time(rhorainicio1.val(), rhorafin1.val());
                    var rdif2 = difference_time(rhorainicio2.val(), rhorafin2.val());

                    total0.val(dif0);
                    rtotal0.val(rdif0);
                    rtotal1.val(parseInt(rdif1) > 0 ? rdif1 : '');
                    rtotal2.val(parseInt(rdif2) > 0 ? rdif2 : '');

                    ff_validate_submit(this,'click');
            }
                else {
                    alert ( 'Error en el formato de hora ingresado ');
                }

            });
        }
        // --- Resto de formularios ---
        else{ // --- Para cualquier otro formulario ---
            $('[name="ff_nm_enviar[]"]').on('click',function(){
                ff_validate_submit(this,'click');
            });
        }


    }); // document ready

    // función para convertir la fecha en un formato de BD
    function convert_date( strDate ){
        var dateParts = strDate.split("/");
        var dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
        return dateObject;
    }

    // función para validad que el dato ingresado sea un formato de hora tipo: hh:mm (am|pm)
    function validate_time(input){
        if ( input.val() == '' ) return true;

        var inputvalidate = input.val().match(/^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/);
        if (!inputvalidate){
            input.css('background', '#fdd');
        } else {
            input.css('background', 'transparent');
        }
        return inputvalidate;
    }

    // función para retornar la diferencia de tiempo
    function difference_time( time_inicio, time_fin ){
        var cad = '';
        var timeStart = new Date("01/01/2000 " + time_inicio);
        var timeEnd = new Date("01/01/2000 " + time_fin);

        var diff = (timeEnd - timeStart) / 60000;
        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;

        // if ( diff < 0 ) return false;

        cad = hours + ' h';
        cad += (minutes) ? ' - ' + minutes + ' m' : '';

        return cad;
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

