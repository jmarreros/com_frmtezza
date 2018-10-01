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
	/**
	 * @var array messages
	 */
	protected $message;

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	// public function getTable($type = 'FrmTezzaAreas', $prefix = 'FrmTezzaTable', $config = array())
	// {
	// 	return JTable::getInstance($type, $prefix, $config);
	// }

// 	SELECT u.id, u.name FROM zd9ri_users u
// INNER JOIN zd9ri_user_usergroup_map ugm ON ugm.user_id = u.id
// INNER JOIN zd9ri_usergroups ug ON ug.id = ugm.group_id
// WHERE u.block = 0;

	protected function getListQuery()
	{
		// // Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select(array('ug.title as title, ug.id'))
				->from($db->quoteName('#__usergroups') .' as ug')
				->where($db->quoteName('title') . " LIKE 'Area - %'")
				->where($db->quoteName('title') . " NOT LIKE '%Jefe%'");
		$query->order('title ASC');

		// return $query;

		return "hola";
	}


	// public function getData()
	// {
	// 	//$this->message = "Hola como estas?";
	// 	$db    = JFactory::getDbo();
	// 	$query = $db->getQuery(true);

	// 	// Create the base select statement.
	// 	$query->select('*')
	// 			->from($db->quoteName('#__usergroups'))
	// 			->where($db->quoteName('title') . " LIKE 'Area - %'")
	// 			->where($db->quoteName('title') . " NOT LIKE '%Jefe%'");

	// 	// $query->select($db->quoteName(array('user_id', 'profile_key', 'profile_value', 'ordering')))
    // 	// 	  ->from($db->quoteName('#__user_profiles'));

	// 	$db->setQuery($query);
	// 	$results = $db->loadObjectList();

	// 	return $results;
	// }

}