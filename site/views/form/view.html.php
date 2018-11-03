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
		// validation
		$user = JFactory::getUser();
		if ( ! $user->id ) return false;

		//Assign model
		$model = $this->getModel();
		$jinput = JFactory::getApplication()->input;


		$this->idform = $jinput->get('idform'); //Get id table form
		$this->form = $model->getForm(); //Get form data (from the view all fields)

		$this->validateForm = $model->ValidateShowForm();
		$this->validateSave = $model->ValidateShowSaveButton();
		$this->dataBF = $model->getDataRecordBF($this->form->id_record);

		//$this->sendmail = $model->SendMailApprobal(true);

		// $id_area = $this->form->id_area;
		// $this->is_area_boss = $model->getIsBoss($id_area); //get area if the user is boss
		// $this->is_rrhh_boss = $model->getIsBossRRHH(); // if the user is RRHH boss

		// Display the view
		parent::display($tpl);
	}

}