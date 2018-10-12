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
class FrmTezzaViewForms extends JViewLegacy
{

	function display($tpl = null)
	{
		$this->addToolBar();

		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		parent::display($tpl);
	}


	protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('Solicitudes'),'stack');
		JToolbarHelper::addNew('forms.add');
		JToolbarHelper::editList('forms.edit');
		JToolbarHelper::deleteList('', 'forms.delete');

		JToolBarHelper::custom('forms.customButtonAreas', 'arrow-right', 'arrow-right', 'Areas', false);
	}
}
