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
$document->addStyleSheet('components/'.$jinput->get('option').'/css/style.css');
$document->addScript('components/'.$jinput->get('option').'/js/script.js');

var_dump($this->is_rrhh_boss);
// var_dump($this->form);
?>

<jdoc:include type="message" />

<form method="post" id="adminForm" name="adminForm" class="form">
    <div class="msg-approval"></div>
    <section class="well top-bar" >

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
                        echo $this->form->dt_approval."</i>";
                    }
                ?>
            </div>
        </fieldset>

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
                <textarea name="tezza_observation_rrhh" id="tezza_observation_rrhh" class="tezza_observation" cols="50" rows="10"><?php echo $this->form->observation_rrhh; ?></textarea>
            </div>

            <div class='meta-group'>
                <?php
                    if (!is_null($this->form->approval_rrhh) ){
                        echo "<i> Por: ".$this->form->boss_rrhh."<br>";
                        echo $this->form->dt_approval_rrhh."</i>";
                    }
                ?>
            </div>
        </fieldset>


        <fieldset class="buttons">
            <input class="btn btn-primary validate" type="submit" value="Guardar" onclick="Joomla.submitbutton('form.save')" <?php echo !is_null($this->form->approval_rrhh)?"style='display:none;'":"";  ?> >
            <a class="btn" title="Cancelar" href="<?php echo JRoute::_('index.php?option=com_frmtezza'); ?>"><?php echo !is_null($this->form->approval_rrhh)?"Regresar":"Cancelar";  ?></a>
        </fieldset>

    </section>

    <section class="well form">
        <input type="text" value="">
    </section>

    <input type="hidden" name="idform" value="<?php echo $this->idform; ?>">
    <input type = "hidden" name = "task" value = "" />
	<input type = "hidden" name = "option" value = "com_frmtezza" />
</form>




