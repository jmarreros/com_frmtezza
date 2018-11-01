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
 * FrmTezza Model
 *
 * @since  0.0.1
 */
class FrmTezzaModelAreas extends JModelList
{

	// Requiered for Jmodellist class
	protected function getListQuery()
	{
		return '';
	}


	/**
	 * Get data from usergrups in combination whith user boss
	 *
	 * @return  array  Array of An associative array object, area - users boss
	 *
	 */
	public function getData()
	{

		$group_boss = $this->get_boss_group();
		$result = [];

		//Get all areas
		$data = $this->get_all_areas($group_boss);

		foreach ($data as $item){
			$bosses = $this->get_user_by_groups( $group_boss, $item->id);
			$result[] = array( 'area' => $item->title, 'boss' => $bosses );
		}

		return $result;

	}

	/**
	 * Get the the all the areas (like 'Area - %') except area boss
	 *
	 * @return  object  List of areas
	 *
	 */
	public function get_all_areas( $group_boss = 0 ){

		if ( $group_boss == 0)  $group_boss = $this->get_boss_group();

		if ( ! $group_boss ) return null;

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select(array('id', 'title'))
				->from($db->quoteName('#__usergroups'))
				->where($db->quoteName('title') . " LIKE 'Area - %'")
				->where('id <> '. $group_boss )
				->order($db->quoteName('title') . ' ASC');

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	/**
	 * Get the boss group (like '%Jefe%'), in #__user_gropus joomla table, should exists only one register
	 *
	 * @return  int  id user that is boss
	 *
	 */
	public function get_boss_group(){
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id')
				->from($db->quoteName('#__usergroups'))
				->where($db->quoteName('title') . " LIKE '%JEFE%'");

		$db->setQuery($query);
		return $db->loadResult();
	}


	/**
	 * Get the RRHH area group (like '%RRHH%'), in #__user_gropus joomla table
	 *
	 * @return  int  id user that is boss
	 *
	 */
	public function get_rrhh_group(){
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id')
				->from($db->quoteName('#__usergroups'))
				->where($db->quoteName('title') . " LIKE '%RRHH%'");

		$db->setQuery($query);
		return $db->loadResult();
	}



	/**
	 * Get user by two groups, one boss group and other group
	 *
	 * @param int $group_boss boss group
	 * @param int $group user group
	 *
	 * @return  object  list of object user data
	 *
	 */
	public function get_user_by_groups( $group_boss, $group ){
		$db       = JFactory::getDbo();
		$subQuery = $db->getQuery(true);
		$query    = $db->getQuery(true);

		// Create the base subQuery, get all user belongs to an area
		$subQuery->select('user_id')
				->from($db->quoteName('#__user_usergroup_map'))
				->where($db->quoteName('group_id') . ' = ' . $group);

		// Main query, get user(s) that is area boss
		$query->select(array('u.id', 'u.name'))
				->from($db->quoteName('#__users','u'))
				->join('INNER', $db->quoteName('#__user_usergroup_map','ugm').' ON '.$db->quoteName('ugm.user_id').'='. $db->quoteName('u.id'))
				->where($db->quoteName('u.block') . ' = 0')
				->where($db->quoteName('ugm.group_id') . ' = '.$group_boss)
				->where($db->quoteName('ugm.user_id') . ' IN (' . $subQuery . ')');

		// Set the query and load the result.
		$db->setQuery($query);

		return $db->loadObjectList();
	}


}




	// public function getAreaUser( $user ){
	// 	$db       = JFactory::getDbo();
	// 	$query    = $db->getQuery(true);

	// 	$query->select('group_id')
	// 		->from($db->quoteName('#__v_user_area'))
	// 		->where($db->quoteName('user_id') . ' = '.$user)
	// 		->setLimit(1);

	// 	$db->setQuery($query);
	// 	return $db->loadResult();
	// }