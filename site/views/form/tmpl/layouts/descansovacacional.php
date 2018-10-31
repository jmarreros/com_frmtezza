
<style>
    .frm-tezza{
        padding-right:16px;
        padding-left:16px;
    }

    .fecha-creacion{
        text-align:right;
    }

    #notasadicionales,
    #fechasdescanso,
    #fechareincorporacion,
    #tipodescanso{
        margin-top:20px;
    }

    #notasadicionales label,
    #fechareincorporacion label,
    #fechasdescanso label,
    #tipodescanso label{
        width:20%;
        float:left;
    }

    #notasadicionales textarea,
    #fechareincorporacion input,
    #fechasdescanso input,
    #tipodescanso input{
        width:80%;
        float:right;
    }

    #notasadicionales textarea{
        height:100px;
        background:white;
        border:none;
    }
</style>

<section class="frm-tezza">
    <section id="cabecera">
        <section id="imagelogo" class="block">
            <p><img src="images/logo-tezza.png" width="218" height="103" /></p>
        </section>
        <section id="tituloformulario" class="block">
            <div>
                <h3>Descanso Vacacional o Compensación Vacacional</h3>
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
                    <input readonly="readonly" type="text" value="<?= $this->dataBF['codigo']; ?>" >
                </div>
            </div>

            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">Tipo Doc</label>
                    <input readonly="readonly" type="text" value="<?= $this->dataBF['tipodocumento']; ?>" >
                </div>
            </div>

            <div class="block">
                <div class="controls form-inline">
                    <label class="control-label">#Documento</label>
                    <input readonly="readonly" type="text" value="<?= $this->dataBF['numerodocumento']; ?>" >
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
                    <input readonly="readonly" type="text" value="<?= $this->dataBF['cargo']; ?>" >
                </div>
            </div>

        </div>

        <div class="clear"></div>
    </fieldset>


    <fieldset id="tipodescanso">
        <legend>Tipo Descanso</legend>
        <div class="block" style="width:100%">
            <div class="controls form-inline">
                <label class="control-label">Tipo</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['tipovacaciones']; ?>" >
            </div>
        </div>

        <div class="clear"></div>
    </fieldset>


    <fieldset id="fechasdescanso">
        <legend>Fechas de Descanso</legend>

        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Desde</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['descansodesde']; ?>" >
            </div>
        </div>

        <div class="block">
            <div class="controls form-inline">
                <label class="control-label">Hasta</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['descansohasta']; ?>" >
            </div>
        </div>

        <div class="clear"></div>
    </fieldset>


    <fieldset id="fechareincorporacion">
        <legend>Fecha Reincorporación</legend>
        <div class="block" style="width:100%">
            <div class="controls form-inline">
                <label class="control-label">Reincorporación</label>
                <input readonly="readonly" type="text" value="<?= $this->dataBF['reincorporacion']; ?>" >
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