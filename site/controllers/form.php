<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_frmtezza
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Frm Tezza Component Controller
 *
 * @since  0.0.1
 */
class FrmTezzaControllerForm extends JControllerLegacy
{
    public function save()
    {
        //send message
        $application = JFactory::getApplication();

        $model = $this->getModel('form');
        $val = $model->save();

        // if ( $val ){
        //     $application->enqueueMessage('OK');
        // } else {
        //     $application->enqueueMessage('Error','error');
        // }

        $application->enqueueMessage($val);

        $this->setRedirect(JRoute::_('index.php?option=com_frmtezza&view=forms'));
    }

    public function cancel()
    {
        $this->setRedirect(JRoute::_('index.php?option=com_frmtezza&view=forms', false));
    }

}