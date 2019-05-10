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

		// Filters
		$jinput = JFactory::getApplication()->input;

		$pending_rrhh = $jinput->get( "pending_rrhh", false, 'BOOL');
		$date_star = $jinput->get( "date_star", '', 'STRING');
		$date_end = $jinput->get( "date_end", '', 'STRING');
		$indicio_nombre = trim($jinput->get( "indicio_nombre", '', 'STRING'));
		$filter_document = $jinput->get( "filter_document", '', 'STRING');

		$area= '';

		error_log (print_r($date_star,true), 3, 'error_log.txt');
		// error_log (print_r($date_end,true), 3, 'error_log.txt');


		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
				->from($db->quoteName('#__frmtezza_v_user_forms'));

		//Filter area
		// if ( $area ){
		// 	$query->where($db->quoteName('id_area')."=".$area);
		// }

		// -- Validate user --
		$helper = new FrmTezzaHelper();
		$is_rrhh_boss = $helper->getIsBossRRHH(); // Verify isbooss rrhh

		// if not is boss rrhh filter data
		if ( ! $is_rrhh_boss ){

			$user_area = $helper->getUserArea(false); //parameter $once = false , array of user_area
			$is_boss = $helper->getIsBoss($user_area);

			if ( $is_boss ){ //all data from one or more areas
				$query->where($db->quoteName('id_area')." in (". implode(",", $user_area ). ")");

			} else { //all data of the current user
				$query->where($db->quoteName('id_user')."=".$user->id);
			}

		}

		$query->order('dt_register DESC');

		return $query;
	}


}


// $mainframe =JFactory::getApplication();
// $area = $mainframe->getUserStateFromRequest( "tezza_area", 'tezza_area', '' );


		//filters
		// $area='';
		// $filter_document = $mainframe->getUserStateFromRequest( "filter_document", 'filter_document', '' );
		// $check = filter_var($filter_document, FILTER_VALIDATE_BOOLEAN);
		// $pending_approve = $mainframe->getUserStateFromRequest( "pending_approve", 'pending_approve', '' );

		// error_log (print_r($pending_rrhh,true), 3, 'error_log.txt');
		// error_log('--',3, 'error_log');
		// error_log(print_r($filter_document,true), 3, 'error_log');
		// error_log($pending_rrhh);
		// print_r($pending_approve,true);
