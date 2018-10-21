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
    public function getIsBoss( $id_area ){
        $user = JFactory::getUser();
        $user_id = $user->id;
        $is_boss = false;


        // Get boss group like '%jefe%'
        $area = new FrmTezzaModelAreas();
        $id_area_boss = $area->get_boss_group();


        //Get all bosses from an specif area
        $result = $area->get_user_by_groups($id_area_boss, $id_area);

        foreach ($result as $area){
            if ( $area->id == $user_id ){
                $is_boss = true;
                break;
            }
        }

        return $is_boss;
    }

    /**
	 * Validate if the current user is a boss from RRHH area
     *
     *
	 * @return  bool  true if is boss from RRHH area
	 */
    public function getIsBossRRHH(){
        $area = new FrmTezzaModelAreas();
        $id_area_rrhh = $area->get_rrhh_group();

        return $this->getIsBoss($id_area_rrhh);
    }

    /**
	 * Get user area, filters only the first area found of the current user
     *
     *
	 * @return  int  User area
	 */
    public function getUserArea(){

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $user = JFactory::getUser();
        $area = 0;

        $query->select('group_id')
            ->from($db->quoteName('#__frmtezza_v_user_area'))
            ->where($db->quoteName('user_id') . ' = '.$user->id)
            ->setLimit(1);
        $db->setQuery($query);

        $area =  $db->loadResult();

        return $area;
    }
}
