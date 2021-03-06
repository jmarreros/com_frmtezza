<style>
    .frm-tezza{
        padding-right:16px;
        padding-left:16px;
    }

    .fecha-creacion{
        text-align:right;
    }

    #notasadicionales,
    #diasausencia,
    #motivoausencia,
    #permisohoras{
        margin-top:20px;
    }

    #notasadicionales label,
    #diasausencia label,
    #motivoausencia label{
        width:20%;
        float:left;
    }

    #notasadicionales textarea,
    #diasausencia input,
    #motivoausencia input{
        width:80%;
        float:right;
    }

    #notasadicionales textarea{
        height:50px;
        background:white;
        border:none;
    }

    #diasausencia .block,
    #motivoausencia .block{
        width:33%;
    }
</style>

<div class="top-icons">
    <?php $url = "index.php?option=com_frmtezza&view=form&idform=".$this->idform."&tmpl=component" ?>
    <a href="<?php echo $url ?>" target="_blank">
        <span><i class="fa fa-print"></i> Imprimir</span>
    </a>
</div>

<section class="frm-tezza">
    <section id="cabecera">
        <section id="imagelogo" class="block">
            <p><img src="images/logo-tezza.png" width="218" height="103" /></p>
        </section>
        <section id="tituloformulario" class="block">
            <div>
                <h3>Solicitud de Permiso No Recuperado</h3>
            </div>
            <div class="fecha-creacion">
                <?php
                    setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
                    $dt_register = $this->form->dt_register;
                    echo strftime("%A, %d de %B de %Y", strtotime($dt_register));
                ?>
            </div>
        </section>
    </section>

    <div class="clear"></div>

    <fieldset id="datospersonales">
        <legend>Datos Personales</legend>

        <div>
            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">Nombres</label>
                    <input readonly="readonly" type="text" value="<?= $this->dataBF['nombres']; ?>" >
                </div>
            </div>

            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">Código</label>
                    <input readonly="readonly" type="text" value="<?= isset($this->dataBF['codigo'])?$this->dataBF['codigo']:''; ?>" >
                </div>
            </div>

            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">Tipo Doc</label>
                    <input readonly="readonly" type="text" value="<?= isset($this->dataBF['tipodocumento'])?$this->dataBF['tipodocumento']:''; ?>" >
                </div>
            </div>

            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">#Documento</label>
                    <input readonly="readonly" type="text" value="<?= isset($this->dataBF['numerodocumento'])?$this->dataBF['numerodocumento']:''; ?>" >
                </div>
            </div>

            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">Area</label>
                    <input readonly="readonly" type="text" value="<?= $this->dataBF['area']; ?>" >
                </div>
            </div>

            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">Cargo</label>
                    <input readonly="readonly" type="text" value="<?= isset($this->dataBF['cargo'])?$this->dataBF['cargo']:''; ?>" >
                </div>
            </div>

        </div>

        <div class="clear"></div>
    </fieldset>


    <fieldset id="diasausencia">
        <legend>Día(s) Ausencia</legend>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Desde</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['diadesde']; ?>" >
            </div>
        </div>

        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hasta</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['diahasta']; ?>" >
            </div>
        </div>

        <div class="clear"></div>
    </fieldset>



    <fieldset id="motivoausencia">
        <legend>Motivo de Ausencia</legend>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Motivo</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['motivo']; ?>" >
            </div>
        </div>

        <?php if ( isset($this->dataBF['motivootros']) ):?>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Otro</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['motivootros']; ?>" >
            </div>
        </div>
        <?php endif; ?>

        <div class="clear"></div>
    </fieldset>

    <fieldset id="permisohoras">
        <legend>Horas</legend>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hora salida</label>
                <input readonly="readonly" type="text" value="<?= $helper->time_format($this->dataBF['horasalida']); ?>" >
            </div>
        </div>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hora retorno</label>
                <input readonly="readonly" type="text" value="<?= $helper->time_format($this->dataBF['horaretorno']); ?>" >
            </div>
        </div>

        <div class="clear"></div>
    </fieldset>


    <fieldset id="notasadicionales">
        <legend>Notas adicionales</legend>
        <div class="block" style="width:100%">
            <div class="controls form-inline">
                <label class="control-label">Notas</label>
                <textarea readonly="readonly"><?php
                    if ( isset($this->dataBF['notas']) ){
                        echo $this->dataBF['notas'];
                    }
                ?></textarea>
            </div>
        </div>

        <div class="clear"></div>
    </fieldset>


    <fieldset id="aprobacion">
        <?php if ( $this->validateForm >= 1 ): ?>
            <div class="block">
                <?php
                    if (!is_null($this->form->approval) && $this->form->approval==1):
                        echo "<div>";
                        echo "<i> Aprobado por: ".$this->form->boss."<br>";
                        echo date("d/m/Y h:i:s A",strtotime($this->form->dt_approval))."</i>";
                        echo "</div>";
                    endif;
                ?>
            </div>
        <?php endif; ?>

        <?php if ( $this->validateForm == 2 ): ?>
            <div class="block">
                <?php
                    if (!is_null($this->form->approval_rrhh)):
                        echo "<div>";
                        echo "<i> VB RRHH por: ".$this->form->boss_rrhh."<br>";
                        echo date("d/m/Y h:i:s A",strtotime($this->form->dt_approval_rrhh))."</i>";
                        echo "</div>";
                    endif;
                ?>
            </div>
        <?php endif; ?>

    </fieldset>

    <div class="clear"></div>

</section>

<div class="clear"></div>