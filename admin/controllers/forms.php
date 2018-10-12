<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Clients list controller class.
 *
 * @since  1.6
 */
class FrmTezzaControllerForms extends JControllerAdmin{

    // Return to areas screen
    public function customButtonAreas(){
        $this->setRedirect(JRoute::_('index.php?option=com_frmtezza&view=areas', false));
    }


    public function add(){

        $model = $this->getModel('forms');
        $mensaje = $model->mensaje_model();

        // Message
        $application = JFactory::getApplication();
        $application->enqueueMessage($mensaje, 'success');

        $jinput = JFactory::getApplication()->input;
        $select = $jinput->get('cid');

        var_dump($select);
        //$this->setRedirect(JRoute::_('index.php?option=com_frmtezza&view=solicitudes', false));

    }


}