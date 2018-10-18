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
 * FrmTezza Model
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
		$area = $mainframe->getUserStateFromRequest( "tezza_area", 'tezza_area', '' );

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
				->from($db->quoteName('#__frmtezza_v_user_forms'));

		//Filter area
		if ( $area ){
			$query->where($db->quoteName('id_area')."=".$area);
		}

		//Filter forms title and user
		if ( $search = trim($search) ){
			$query->where($db->quoteName('name'). ' LIKE \'%'.$search.'%\'' , 'OR');
			$query->where($db->quoteName('title'). ' LIKE \'%'.$search.'%\'');
		}

		$query->order('dt_register DESC');

		return $query;
	}


}