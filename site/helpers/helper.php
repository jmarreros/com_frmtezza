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

include_once(JPATH_COMPONENT_ADMINISTRATOR.'/models/areas.php'); //include model area administrator

/**
 * FrmTezza helper
 *
 * @since  0.0.1
 */
class FrmTezzaHelper
{
    /**
	 * Validate if the current user is a boss from an specific area
     *
     * @param int area
     *
	 * @return  bool  true if is boss from an specific area
	 */
    public function getIsBoss( $id_areas ){
        $user = JFactory::getUser();
        $user_id = $user->id;
        $is_boss = false;
        $arr_id_area = array();


        // Get boss group like '%jefe%'
        $area = new FrmTezzaModelAreas();
        $id_area_boss = $area->get_boss_group(); //Get boss group id

        if ( ! $id_area_boss ) return false;

        // Validate is array areas
        if ( ! is_array($id_areas) ){
            $arr_id_area[] = $id_areas;
        } else {
            $arr_id_area = $id_areas;
        }

        foreach ($arr_id_area as $id_area) {
            
            //Get all bosses from an specif area
            $result = $area->get_user_by_groups($id_area_boss, $id_area);

            foreach ($result as $area){
                if ( $area->id == $user_id ){
                    $is_boss = true;
                    break;
                }
            }

            if ($is_boss) break;
        }

        return $is_boss;
    }

    /**
	 * Validate if the current user is a boss from RRHH area
     *
	 * @return  bool  true if is boss from RRHH area
	 */
    public function getIsBossRRHH(){
        $area = new FrmTezzaModelAreas();
        $id_area_rrhh = $area->get_rrhh_group();

        return $this->getIsBoss($id_area_rrhh);
    }


    /**
	 * Get id user boos from an specific area, only the fist one
     *
     * @param int area
     *
	 * @return  int  id user booss area
	 */
    public function getBossArea($id_area){
        // Get boss group like '%jefe%'
        $area = new FrmTezzaModelAreas();
        $id_area_boss = $area->get_boss_group();

        if ( ! $id_area_boss ) return false;

        //Get all bosses from an specif area
        $result = $area->get_user_by_groups($id_area_boss, $id_area);

        if ( isset ($result[0]) ){
            return $result[0]->id;
        }
        return false;
    }

    /**
	 * Get id user boos from RRHH area, only the fist one
     *
     * @param int area
     *
	 * @return  int  id user booss area RRHH
	 */
    public function getBossAreaRRHH(){
        $area = new FrmTezzaModelAreas();
        $id_area_rrhh = $area->get_rrhh_group();

        return $this->getBossArea($id_area_rrhh);
    }


    /**
	 * Get user area, filters only the "first" area found of the current user
     *
     * @param bol once return only one area by default
     *
	 * @return  int  User area
	 */
    public function getUserArea( $once = true ){

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $user = JFactory::getUser();
        $area = 0;

        $query->select('group_id')
            ->from($db->quoteName('#__frmtezza_v_user_area'))
            ->where($db->quoteName('user_id') . ' = '.$user->id);
        $db->setQuery($query);

        if ( $once ){
            $area =  $db->loadResult();            
        } else {
            $area = $db->loadColumn();
        }

        return $area;
    }

    /**
	 * Get user data, additional custom fields, test for BF
     *
	 * @return  object  User data
	 */
    public function getUserData(){
        $db = JFactory::getDbo();
        $user = JFactory::getUser();

        $query = $db->getQuery(true);

        $query->select(array('f.name', 'f.title', 'v.value'))
            ->from($db->quoteName('#__fields','f'))
            ->join('INNER', $db->quoteName('#__fields_values','v').' ON '.$db->quoteName('f.id').'='.$db->quoteName('v.field_id'))
            ->where($db->quoteName('v.item_id').'='.$user->id);

        $db->setQuery($query);
        $user_data =  $db->loadAssocList('name', 'value');

        return $user_data;
    }

    /**
	 * Get user object from idForm, specilla for obtain user author form
     *
	 * @return  mixed  User object, or false
	 */
    public function getUserIdForm($idform){
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select(array('id_user'))
                ->from($db->quoteName('#__frmtezza_frm_user'))
                ->where($db->quoteName('id').'='.$idform);

        $db->setQuery($query);

        $id_user =  $db->loadResult();

        if ( isset($id_user) ){
            $user = JFactory::getUser($id_user);
            return $user;
        }

        return false;
    }


    // Convert 24 format to am - pm time format
    public function time_format( $str ){
        return date( "g:i a", strtotime($str) );
    }


    // Aux function
    public function queryToStr( $query ){
        $db = JFactory::getDbo();
        return $db->replacePrefix((string) $query);
    }
}
