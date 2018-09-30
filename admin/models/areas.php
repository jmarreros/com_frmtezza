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

	protected function getListQuery()
	{
		// Initialize variables.
		// $db    = JFactory::getDbo();
		// $query = $db->getQuery(true);

		// // Create the base select statement.
		// $query->select('*')
  //               ->from($db->quoteName('#__helloworld'));
		$query = '';
		return $query;
	}


	public function getMsg()
	{
		// if (!is_array($this->messages))
		// {
		// 	$this->messages = array();
		// }

		// if (!isset($this->messages[$id]))
		// {
		// 	// Request the selected id
		// 	$jinput = JFactory::getApplication()->input;
		// 	$id     = $jinput->get('id', 1, 'INT');

		// 	// Get a TableHelloWorld instance
		// 	$table = $this->getTable();

		// 	// Load the message
		// 	$table->load($id);

		// 	// Assign the message
		// 	$this->messages[$id] = $table->greeting;
		// }

		//$this->message = "Hola como estas?";
		
		return "hola desde modelo";
	}
}