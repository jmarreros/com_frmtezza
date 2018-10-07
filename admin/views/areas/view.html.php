<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_frmtezza
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
// jimport( 'joomla.application.component.model' );

/**
 * Content areas view.
 *
 * @since  1.6
 */
class FrmTezzaViewAreas extends JViewLegacy
{

	function display($tpl = null){

		$this->items= $this->get('Data');
		// $this->area = $this->get('AreaUser');

		$this->addToolBar();
		parent::display($tpl);
	}

	protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('Areas'), 'cube');
		$bar = JToolBar::getInstance('toolbar');
		$bar->appendButton( 'Link', 'arrow-right', 'Solicitudes', 'index.php?option=com_frmtezza' );
	}

}
