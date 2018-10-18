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
class FrmTezzaViewForm extends JViewLegacy
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
		//Get id table form
		$jinput = JFactory::getApplication()->input;
		$this->idform = $jinput->get('idform');

		//Get data form
		$this->form = $this->get('Form');

		// Display the view
		parent::display($tpl);
	}
}