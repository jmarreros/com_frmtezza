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
 * Content solicitudes view.
 *
 * @since  1.6
 */
class FrmTezzaViewSolicitudes extends JViewLegacy
{

	function display($tpl = null){
		$this->addToolBar();
		parent::display($tpl);
	}
	
	protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('Solicitudes'));
		JToolbarHelper::addNew('frmtezza.add');
		JToolbarHelper::editList('frmtezza.edit');
		JToolbarHelper::deleteList('', 'frmtezza.delete');
		// JToolBarHelper::divider();
		// JToolBarHelper::custom('frmtezza.areas', 'checkbox-partial', 'checkbox-partial', 'Areas', true);
	}
}
