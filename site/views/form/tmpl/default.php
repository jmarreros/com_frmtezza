<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Add style css file
JHtml::_('jquery.framework', true, true);
$jinput = JFactory::getApplication()->input;
$document = JFactory::getDocument();

$document->addScript($this->baseurl.'/media/system/js/core.js');
$document->addStyleSheet('components/'.$jinput->get('option').'/css/style.css');
$document->addScript('components/'.$jinput->get('option').'/js/script.js');

// var_dump($this->validateSave);

if ( $this->validateForm == -1 ) {
    echo "<div class='alert alert-error'>No tiene acceso a ver este formulario</div>";
    echo "<a href=". JRoute::_('index.php?option=com_frmtezza').">Regresar</a>";
    return false;
}

// var_dump(file_exists( $_SERVER{'DOCUMENT_ROOT'} .'layouts/descansovacacional.php'));
// var_dump( file_exists(dirname(__FILE__).'/layouts/descansovacacional.php' ));
// var_dump( $this->dataBF );
// var_dump($this->sendmail);
?>

<form method="post" id="adminForm" name="adminForm" class="form">
    <div class="msg-approval"></div>
    <section class="well top-bar" >

        <?php if ( $this->validateForm >= 1 ): ?>
        <fieldset class="fields" <?php echo !is_null($this->form->approval)?"disabled":"";  ?> >
            <div class="control-group">

                <p><strong>Aprobar Solicitud: </strong><p>

                <div>
                    <input type="radio" name="tezza_approval" id="tezza_approval_yes" value="1" <?php echo (!is_null($this->form->approval) && $this->form->approval==1)?"checked":""; ?> />
                    <label for="tezza_approval_yes"> <i class="fa fa-check-square ico-approval"></i> Aprobar</label>
                </div>
                <div>
                    <input type="radio" name="tezza_approval" id="tezza_approval_no" value="0"  <?php echo (!is_null($this->form->approval) && $this->form->approval==0)?"checked":""; ?> />
                    <label for="tezza_approval_no"> <i class="fa fa-window-close ico-approval"></i> No Aprobar</label>
                </div>

            </div>

            <div class="control-group">
                <label for="tezza_observation"><strong>Observación: </strong></label>
                <textarea name="tezza_observation" id="tezza_observation" class="tezza_observation" cols="50" rows="10"><?php echo $this->form->observation; ?></textarea>
            </div>
            <div class='meta-group'>
                <?php
                    if (!is_null($this->form->approval) ){
                        echo "<i> Por: ".$this->form->boss."<br>";
                        echo date("d/m/Y h:i:s A",strtotime($this->form->dt_approval))."</i>";
                    }
                ?>
            </div>
        </fieldset>
        <?php endif; // >=1 ?>

        <?php if ( $this->validateForm == 2 ): ?>
        <fieldset class="fields" <?php echo !is_null($this->form->approval_rrhh)?"disabled":"";  ?>>
            <div class="control-group">

                <p><strong>RRHH: </strong><p>
                <div>
                    <input type="checkbox" name="tezza_vb_rrhh" id="tezza_vb_rrhh" value="1" <?php echo (!is_null($this->form->approval_rrhh) && $this->form->approval_rrhh==1)?"checked":""; ?> />
                    <label for="tezza_vb_rrhh">VB RRHH</label>
                </div>

            </div>

            <div class="control-group">
                <label for="tezza_observation_rrhh"><strong>Observación: </strong></label>
                <textarea name="tezza_observation_rrhh" id="tezza_observation_rrhh" class="tezza_observation" cols="50" rows="5"><?php echo $this->form->observation_rrhh; ?></textarea>
            </div>

            <div class='meta-group'>
                <?php
                    if (!is_null($this->form->approval_rrhh) ){
                        echo "<i> Por: ".$this->form->boss_rrhh."<br>";
                        echo date("d/m/Y h:i:s A",strtotime($this->form->dt_approval_rrhh))."</i>";
                    }
                ?>
            </div>
        </fieldset>
        <?php endif; // ==2 ?>

        <fieldset class="buttons">
            <?php if ($this->validateSave): ?>
                <input class="btn btn-primary validate" type="submit" value="Guardar" onclick="Joomla.submitbutton('form.save')" >
            <?php endif; ?>
            <a class="btn" title="Cancelar" href="<?php echo JRoute::_('index.php?option=com_frmtezza'); ?>">Cancelar</a>
        </fieldset>

    </section>


    <input type="hidden" name="idform" value="<?php echo $this->idform; ?>">
    <input type = "hidden" name = "task" value = "" />
	<input type = "hidden" name = "option" value = "com_frmtezza" />
</form>

<?php
    // Load Layout, according to the form name
    // ----------------------------------------
    $layout = $this->form->frmname;
    if ( file_exists(dirname(__FILE__).'/layouts/'.$layout.'.php') ){
        include_once('layouts/'.$layout.'.php');
    } else {
        echo "<div>No existe layout para este formulario 🔥</div>";
    }
?>

