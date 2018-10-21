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

include_once(JPATH_COMPONENT_SITE.'/helpers/helper.php'); //include model area administrator

/**
 * FrmTezza Model
 *
 * @since  0.0.1
 */
class FrmTezzaModelForm extends JModelForm
{

    /**
	 * Get data current id from #__frmtezza_frm_user from view, Joomla override function
     * @param array necesary for override function
	 * @param bool necesary for override function
	 * @return  object  data for the view
	 */
    public function getForm($data = array(), $loadData = true){
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $jinput = JFactory::getApplication()->input;

        $idform = $jinput->get('idform');

        $query = $db->getQuery(true);

        $query->select('*');
        $query->from($db->quoteName('#__frmtezza_v_user_forms'));
        $query->where($db->quoteName('id') . ' = ' . $idform );

        $db->setQuery($query);

        $result = $db->loadObject();

        return $result;
    }

    /**
	 * Save data form request, data has two parts, for boss and for RRHH boss
     *
	 * @return  bool  data for the view
	 */
    public function save(){

        $jinput = JFactory::getApplication()->input;
        $user = JFactory::getUser();

        // vars to save #_frmtezza_frm_user
        $approval = $jinput->get('tezza_approval');
        $observation = $jinput->get('tezza_observation',null,'STRING');
        $approval_rrhh = $jinput->get('tezza_vb_rrhh');
        $observation_rrhh = $jinput->get('tezza_observation_rrhh',null,'STRING');
        $user = $user->id;
        $idform = $jinput->get('idform');

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);


        // -> Fields to update for boss approval
        $fields = array();
        $fields[] = $db->quoteName('id_boss').' = '.$user;
        $fields[] = $db->quoteName('observation').' = "'. addslashes($observation).'"';
        $fields[] = $db->quoteName('dt_approval'). ' = now() ';

        if ( isset($approval) ){
            $fields[]  = $db->quoteName('approval').' = '.$approval;
        }

        // -> Fields to update for boss rrhh approval
        $fields = array();
        $fields[]  = $db->quoteName('id_boss_rrhh').' = '.$user;
        $fields[]  = $db->quoteName('observation_rrhh').' = "'.addslashes($observation_rrhh).'"';
        $fields[] = $db->quoteName('dt_approval_rrhh'). ' = now() ';

        if ( isset($approval_rrhh) ){
            $fields[]  = $db->quoteName('approval_rrhh').' = 1';
        }

        // -> Conditions for which records should be updated.
        $conditions = array();
        $conditions[] = $db->quoteName('id').' = '.$idform;

        $query->update($db->quoteName('#__frmtezza_frm_user'))->set($fields)->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();

        return $result;
    }


}
