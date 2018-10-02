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

	// Requierde for Jmodellist class
	protected function getListQuery()
	{
		return '';
	}

	// Get data from usergrups in combination whith user boss
	public function getData()
	{

		$group_boss = $this->get_boss_group();
		$group_current = 0;
		$result = [];
		$db    = JFactory::getDbo();

		// Load all areas (like 'Area - %')
		$query = $db->getQuery(true);
		$query->select(array('id', 'title'))
				->from($db->quoteName('#__usergroups'))
				->where($db->quoteName('title') . " LIKE 'Area - %'")
				->where('id <> '. $group_boss );

		$db->setQuery($query);
		$data = $db->loadObjectList();

		foreach ($data as $item){
			// $item->id;
			$result['area'][] = $item->id;

// 			SELECT u.id, u.name FROM zd9ri_users u
// INNER JOIN zd9ri_user_usergroup_map ugm ON ugm.user_id = u.id
// WHERE u.block = 0
// AND ugm.group_id = 23
// AND ugm.user_id in (select user_id from zd9ri_user_usergroup_map WHERE group_id = 16);


			// $query = $db->getQuery(true);
			// $query->select(array('id', 'title'))
			// 		->from($db->quoteName('#__usergroups'))
			// 		->where($db->quoteName('title') . " LIKE 'Area - %'")
			// 		->where($db->quoteName('title') . " NOT LIKE '%Jefe%'");

		}


		return $data;

	}


	//Get the boss group (like '%Jefe%')
	private function get_boss_group(){
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id')
				->from($db->quoteName('#__usergroups'))
				->where($db->quoteName('title') . " LIKE '%Jefe%'");

		$db->setQuery($query);
		return $db->loadResult();
	}

	//Get user by two groups, one boss group and other group
	private function get_user_by_groups( $group_boss, $group ){

	}

}

