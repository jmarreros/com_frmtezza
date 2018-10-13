<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_FrmTezza
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * FrmTezza Model, solicitudes
 *
 * @since  0.0.1
 */
class FrmTezzaModelForms extends JModelList
{

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{

		$mainframe =JFactory::getApplication();

		$search = $mainframe->getUserStateFromRequest( "tezza_search", 'tezza_search', '' );

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
                ->from($db->quoteName('#__frmtezza_v_user_forms'));

		return $query;
	}

}