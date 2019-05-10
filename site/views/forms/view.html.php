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
include_once(JPATH_COMPONENT_ADMINISTRATOR.'/models/areas.php'); //include model area administrator
include_once(JPATH_COMPONENT_SITE.'/helpers/helper.php'); //include helper

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

		$user = JFactory::getUser();
		if ( ! $user->id ){
			$application = JFactory::getApplication();
			$application->enqueueMessage('Tienes que estar conectado para ver esta pantalla <a href="'.JURI::base().'">Conectarse</a>','Error');
		}

		// Filters
		$jinput = JFactory::getApplication()->input;

		$this->pending_rrhh = $jinput->get( "pending_rrhh", false, 'BOOL');
		$this->date_star = $jinput->get( "date_star", '', 'STRING');
		if ($this->date_star =="0000-00-00 00:00:00") $this->date_star = '';
		$this->date_end = $jinput->get( "date_end", '', 'STRING');
		if ($this->date_end =="0000-00-00 00:00:00") $this->date_end = '';
		$this->indicio_nombre = trim($jinput->get( "indicio_nombre", '', 'STRING'));
		$this->filter_document = $jinput->get( "filter_document", '', 'STRING');

		$this->tezza_area = '';


		// $mainframe =JFactory::getApplication();
		// $this->tezza_area = $mainframe->getUserStateFromRequest( "tezza_area", 'tezza_area', '' );




		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		$area = new FrmTezzaModelAreas();
		$this->areas = $area->get_all_areas();

		$helper = new FrmTezzaHelper();
		$this->is_boss_rrhh = $helper->getIsBossRRHH();

		// Get areas for the user
		$this->user_area = $helper->getUserArea(false);

		// Get is boss if
		$this->is_boss = $helper->getIsBoss($this->user_area); // is boss

		// Display the view
		parent::display($tpl);
	}

}



// tmp
// $this->userData = $helper->getUserData();


// public function __construct() {
// 	parent::__construct();

// 	$this->addModelPath(JPATH_COMPONENT_ADMINISTRATOR.'/models');

// 	$view = &$this->getView('Forms', 'html');
// 	$view->setModel($this->getModel('Areas'));
// 	$view->display();
// }
