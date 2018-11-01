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

include_once(JPATH_COMPONENT_SITE.'/helpers/helper.php'); //include helper

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
		$user = JFactory::getUser();
		$mainframe =JFactory::getApplication();

		//filters
		$area = $mainframe->getUserStateFromRequest( "tezza_area", 'tezza_area', '' );

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
				->from($db->quoteName('#__frmtezza_v_user_forms'));

		//Filter area
		if ( $area ){
			$query->where($db->quoteName('id_area')."=".$area);
		}

		// -- Validate user --
		$helper = new FrmTezzaHelper();
		$is_rrhh_boss = $helper->getIsBossRRHH(); // Verify isbooss rrhh

		// if not is boss rrhh filter data
		if ( ! $is_rrhh_boss ){

			$user_area = $helper->getUserArea();
			$is_boss = $helper->getIsBoss($user_area);

			if ( $is_boss ){ //all data from an specific area
				$query->where($db->quoteName('id_area')."=".$user_area);
			} else { //all data of the current user
				$query->where($db->quoteName('id_user')."=".$user->id);
			}

		}

		$query->order('dt_register DESC');

		return $query;
	}


}