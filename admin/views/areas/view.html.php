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
		// $model = &$this->getModel('FrmTezza');
		// $model = JModel::getInstance('Areas', 'FrmTezza');
		// $model      = $this->getModel();
		// $abc = $model->abc_list();
		// var_dump($model);
		$this->msg = $this->get('Msg');
		// $this->msg = $model->getMsg();

		// $this->msg = $this->get('Msg');

		$this->addToolBar();
		parent::display($tpl);
	}
	
	protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('Areas'));
	}

}
