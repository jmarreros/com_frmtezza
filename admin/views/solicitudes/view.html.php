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
		JToolbarHelper::title(JText::_('Solicitudes'),'stack');
		JToolbarHelper::addNew('solicitudes.add');
		JToolbarHelper::editList('solicitudes.edit');
		JToolbarHelper::deleteList('', 'solicitudes.delete');

		// $bar = JToolBar::getInstance('toolbar');
		// $bar->appendButton( 'Link', 'cube', 'Areas', 'index.php?option=com_frmtezza&view=areas' );

		JToolBarHelper::custom('solicitudes.customButtonAreas', 'arrow-right', 'arrow-right', 'Areas', false);
	}
}
