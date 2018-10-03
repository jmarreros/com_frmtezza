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
class FrmTezzaControllerSolicitudes extends JControllerAdmin{

    public function customButtonAreas(){
		$this->setRedirect(JRoute::_('index.php?option=com_frmtezza&view=areas', false));
    }

    public function add(){

		$this->setRedirect(JRoute::_('index.php?option=com_frmtezza&view=areas', false));
    }


}