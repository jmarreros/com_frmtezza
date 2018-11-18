<style>
    .frm-tezza{
        padding-right:16px;
        padding-left:16px;
    }

    .fecha-creacion{
        text-align:right;
    }

    #notasadicionales,
    #turnoprogramado,
    #nuevoturno{
        margin-top:20px;
    }

    #notasadicionales label,
    #turnoprogramado label,
    #nuevoturno label{
        width:20%;
        float:left;
    }

    #notasadicionales textarea,
    #turnoprogramado input,
    #nuevoturno input{
        width:80%;
        float:right;
    }

    #notasadicionales textarea{
        height:50px;
        background:white;
        border:none;
    }

    #turnoprogramado .block,
    #nuevoturno .block{
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
                <h3>Solicitud de cambio de turno</h3>
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


    <fieldset id="turnoprogramado">
        <legend>Turno Programado (No va a venir)</legend>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Día</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['diaprogramado']; ?>" >
            </div>
        </div>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hora inicio</label>
                <input readonly="readonly" type="text" value="<?= $helper->time_format($this->dataBF['horainicioprogramada']); ?>" >
            </div>
        </div>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hora fin</label>
                <input readonly="readonly" type="text" value="<?= $helper->time_format($this->dataBF['horafinprogramada']); ?>" >
            </div>
        </div>

        <div class="clear"></div>
    </fieldset>



    <fieldset id="nuevoturno">
        <legend>Nuevo Turno</legend>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Día</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['dianuevoturno']; ?>" >
            </div>
        </div>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hora inicio</label>
                <input readonly="readonly" type="text" value="<?= $helper->time_format($this->dataBF['horainicionuevoturno']); ?>" >
            </div>
        </div>
        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hora fin</label>
                <input readonly="readonly" type="text" value="<?= $helper->time_format($this->dataBF['horafinnuevoturno']); ?>" >
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