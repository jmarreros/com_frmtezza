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
                    validate_time24(horainicio0) && validate_time24(horafin0) &&
                    validate_time24(rhorainicio0) && validate_time24(rhorafin0) &&
                    validate_time24(rhorainicio1) && validate_time24(rhorafin1) &&
                    validate_time24(rhorainicio2) && validate_time24(rhorafin2)
                    ){

                    var dif0 = difference_time(horainicio0.val(), horafin0.val());
                    var rdif0 = difference_time(rhorainicio0.val(), rhorafin0.val());
                    var rdif1 = difference_time(rhorainicio1.val(), rhorafin1.val());
                    var rdif2 = difference_time(rhorainicio2.val(), rhorafin2.val());

                    total0.val(dif0);
                    rtotal0.val(rdif0);
                    rtotal1.val(parseInt(rdif1) > 0 ? rdif1 : '');
                    rtotal2.val(parseInt(rdif2) > 0 ? rdif2 : '');


                    if ( parseInt(dif0) >= 0 && parseInt(rdif0) >= 0 && parseInt(rdif1)>=0 && parseInt(rdif2)>=0 ){
                        ff_validate_submit(this,'click');
                    }
                    else {
                        alert ( 'Error diferencia de horas ');
                    }
            }
                else {
                    alert ( 'Error en el formato de hora ingresado, debe ser formato 00:00 (24 horas)');
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
    // function validate_time(input){
    //     if ( input.val() == '' ) return true;

    //     var inputvalidate = input.val().match(/^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/);
    //     if (!inputvalidate){
    //         input.css('background', '#fdd');
    //     } else {
    //         input.css('background', 'transparent');
    //     }
    //     return inputvalidate;
    // }

    function validate_time24(input){
        if ( input.val() == '' ) return true;


        if (input.val().toLowerCase().includes("am") || input.val().toLowerCase().includes("pm")) return false;

        // Autocomplete 0 before
        var completeTime = input.val().split(':');
        if (completeTime.length != 2) return false;

        if ( parseInt(completeTime[0]) <= 9 ) completeTime[0] = '0' + parseInt(completeTime[0]);
        if ( parseInt(completeTime[1]) <= 9 ) completeTime[1] = '0' + parseInt(completeTime[1]);

        completeTime = completeTime[0] + ':' + completeTime[1];

        var inputvalidate = completeTime.match(/^$|^(([01][0-9])|(2[0-3])):[0-5][0-9]$/);
        if (!inputvalidate){
            input.css('background', '#fdd');
        } else {
            input.css('background', 'transparent');
        }

        input.val(completeTime);
        return inputvalidate;
    }

    // función para retornar la diferencia de tiempo
    function difference_time( time_inicio, time_fin ){
        var cad = '';

        hInicio = parseInt(time_inicio);
        hFin = parseInt(time_fin);

        if (hInicio > hFin){
            var timeStart = new Date("01/01/2000 " + time_inicio);
            var timeEnd = new Date("01/02/2000 " + time_fin);
        } else {
            var timeStart = new Date("01/01/2000 " + time_inicio);
            var timeEnd = new Date("01/01/2000 " + time_fin);
        }

        var diff = (timeEnd - timeStart) / 60000;
        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;

        cad = hours + ' h';
        cad += (minutes) ? ' - ' + minutes + ' m' : '';

        return cad;
    }


    // function timeConvertor(time) {
    //     return time;

    //     var part = time.split(':');

    //     if ( part.length != 2 ) return '';

    //     var hour = part[0];
    //     var min = part[1].toLowerCase();
    //     var meridiane = min.substr(min.length-2);

    //     if ( meridiane.match('pm') ) {
    //         hour = 12 + parseInt(hour,10);
    //         min = min.replace('pm', '');
    //     } else {
    //         min = min.replace('am', '');
    //     }

    //     return (hour + ':' + min );
    // }



})( jQuery );


