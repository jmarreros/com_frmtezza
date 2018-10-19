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

/**
 * FrmTezza Model
 *
 * @since  0.0.1
 */
class FrmTezzaModelForm extends JModelForm
{

    //Get data current id form
    public function getForm($data = array(), $loadData = true){

        $object = new StdClass;
        $object->nombre = 'bar';

        return $object;
    }


    public function save(){

        $jinput = JFactory::getApplication()->input;

        // Fields to save #_frmtezza_frm_user
        $approval = $jinput->get('tezza_approval');
        $observation = $jinput->get('tezza_observation');
        $vb_rrhh = $jinput->get('tezza_vb_rrhh');
        $observation_rrhh = $jinput->get('tezza_observation_rrhh');

        return $approval.'-'.$observation.'-'.$vb_rrhh.'-'.$observation_rrhh;
    }

}