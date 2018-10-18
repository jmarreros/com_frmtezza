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

// var_dump($this->form);
?>

<form action="index.php?option=com_frmtezza&view=form" method="post" id="adminForm" name="adminForm" class="form">
    <div class="msg-approval"></div>
    <section class="well top-bar" >

        <div class="fields">
            <div class="control-group">

                <p><strong>Aprobar Solicitud: </strong><p>

                <div>
                    <input type="radio" name="tezza_approval" id="tezza_approval_yes" value="1" />
                    <label for="tezza_approval_yes"> ✅ Aprobar</label>
                </div>
                <div>
                    <input type="radio" name="tezza_approval" id="tezza_approval_no" value="0" />
                    <label for="tezza_approval_no"> ❌ No Aprobar</label>
                </div>

            </div>

            <div class="control-group">
                <label for="tezza_observation"><strong>Observación: </strong></label>
                <textarea name="tezza_observation" id="tezza_observation" class="tezza_observation" cols="50" rows="10"></textarea>
            </div>
        </div>

        <div class="buttons">
            <input class="btn btn-primary validate" type="submit" value="Guardar">
            <a class="btn" href="" title="Cancelar">Cancelar</a>
        </div>

    </section>



    <section class="well form">
        <input type="text" value="">
    </section>


    <input type="hidden" name="idform" value="<?php echo $this->idform; ?>">
</form>




