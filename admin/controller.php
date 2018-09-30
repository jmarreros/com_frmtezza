<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_frmtezza
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * FrmTezza Component Controller
 *
 * @since  1.5
 */
class FrmTezzaController extends JControllerLegacy
{
	protected $default_view = 'solicitudes';
	
	// /**
	//  * Constructor.
	//  *
	//  * @param   array  $config  An optional associative array of configuration settings.
	//  *                          Recognized key values include 'name', 'default_task', 'model_path', and
	//  *                          'view_path' (this list is not meant to be comprehensive).
	//  *
	//  * @since   3.7.0
	//  */
	// public function __construct($config = array())
	// {
	// 	$this->input = JFactory::getApplication()->input;

	// 	// Contact frontpage Editor contacts proxying:
	// 	// if ($this->input->get('view') === 'contacts' && $this->input->get('layout') === 'modal')
	// 	// {
	// 	// 	JHtml::_('stylesheet', 'system/adminlist.css', array(), true);
	// 	// 	$config['base_path'] = JPATH_COMPONENT_ADMINISTRATOR;
	// 	// }

	// 	parent::__construct($config);
	// }

	// /**
	//  * Method to display a view.
	//  *
	//  * @param   boolean  $cachable   If true, the view output will be cached
	//  * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	//  *
	//  * @return  JControllerLegacy  This object to support chaining.
	//  *
	//  * @since   1.5
	//  */
	// public function display($cachable = false, $urlparams = array())
	// {

	// 	// Set the default view name and format from the Request.
	// 	$vName = $this->input->get('view', 'solicitudes');
	// 	$this->input->set('view', $vName);

	// 	parent::display($cachable, $urlparams);

	// 	return $this;
	// }
}
