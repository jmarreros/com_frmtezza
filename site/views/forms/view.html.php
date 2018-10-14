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
 * HTML View class for the frmtezza Component
 *
 * @since  0.0.1
 */
class FrmTezzaViewForms extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = $this->get('Msg');

		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');


// $view->setModel($this->getModel('MyAdminModel'));



		// Display the view
		parent::display($tpl);
	}
}


// public function __construct() {
// 	parent::__construct();

// 	$this->addModelPath(JPATH_COMPONENT_ADMINISTRATOR.'/models');

// 	$view = &$this->getView('Forms', 'html');
// 	$view->setModel($this->getModel('Areas'));
// 	$view->display();
// }
