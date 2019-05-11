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
		$helper = new FrmTezzaHelper();

		// Filters
		$jinput = JFactory::getApplication()->input;
		$pending_rrhh = $jinput->get( "pending_rrhh", false, 'BOOL');
		$pending_approve = $jinput->get( "pending_approve", false, 'BOOL');
		$date_star = $jinput->get( "date_star", '', 'STRING');
		$date_end = $jinput->get( "date_end", '', 'STRING');
		$indicio_nombre = trim($jinput->get( "indicio_nombre", '', 'STRING'));
		$filter_document = $jinput->get( "filter_document", '', 'STRING');
		$filter_area = $jinput->get( "filter_area",0,'INT');

		// Validation filters
		$app = JFactory::getApplication();
		if ( $date_star && $date_end ) {

			$date_star = $helper->dateDBFormat($date_star);
			if ( ! $date_star ) $app->enqueueMessage('Fecha de inicio no válida','Error');

			$date_end = $helper->dateDBFormat($date_end);
			if ( ! $date_end ) $app->enqueueMessage('Fecha final no válida','Error');

			if ( strtotime($date_star) > strtotime($date_end) ){
				$app->enqueueMessage('La fecha final debe ser mayor que la fecha de inicio','Error');
			}
		}

		// BD
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
				->from($db->quoteName('#__frmtezza_v_user_forms'));


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


		// Filters
		if ( $date_star && $date_end ){
			$query->where($db->quoteName('dt_register')." BETWEEN '$date_star' AND DATE_ADD('$date_end', INTERVAL 1 DAY)");
		}
		if ($filter_area){
			$query->where($db->quoteName('id_area')."=$filter_area");
		}
		if ( $filter_document ){
			$query->where($db->quoteName('frmname')."='$filter_document'");
		}
		if ( $pending_rrhh ) {
			$query->where($db->quoteName('approval_rrhh')." is NULL");
		}
		if ( $pending_approve ){
			$query->where($db->quoteName('approval')." is NULL");
		}
		if ( $indicio_nombre ){
			$query->where($db->quoteName('name')." LIKE '%$indicio_nombre%'");
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
