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

        $fields = array();
        $validateShowSaveButton = $this->ValidateShowSaveButton();

        // -> Fields to update for boss approval
        if ( $validateShowSaveButton == 1 ){
            $fields[] = $db->quoteName('id_boss').' = '.$user;
            $fields[] = $db->quoteName('observation').' = "'. addslashes($observation).'"';
            $fields[] = $db->quoteName('dt_approval'). ' = now() ';

            if ( isset($approval) ){
                $fields[]  = $db->quoteName('approval').' = '.$approval;
            }
        }

        // -> Fields to update for boss rrhh approval
        if ( $validateShowSaveButton == 2 ){
            $fields[]  = $db->quoteName('id_boss_rrhh').' = '.$user;
            $fields[]  = $db->quoteName('observation_rrhh').' = "'.addslashes($observation_rrhh).'"';
            $fields[] = $db->quoteName('dt_approval_rrhh'). ' = now() ';

            if ( isset($approval_rrhh) ){
                $fields[]  = $db->quoteName('approval_rrhh').' = 1';
            }
        }

        // -> Conditions for which records should be updated.
        $conditions = array();
        $conditions[] = $db->quoteName('id').' = '.$idform;

        $query->update($db->quoteName('#__frmtezza_frm_user'))->set($fields)->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();

        // Sending mail
        $this->SendMailApprobal($approval);

        return $result;
    }

    /**
	 * Sending email for approbal
     * @param bool for validation
	 * @return  bool  return success or not
	 */
    public function SendMailApprobal( $approval ){

        if ( isset($approval) ){

            $mailer = JFactory::getMailer();
            $config = JFactory::getConfig();
            $user = JFactory::getUser();

            $sender = array(
                $config->get( 'mailfrom' ),
                $config->get( 'fromname' )
            );

            $recipient1 = $user->email;
            $subject = "Se registró una neuva solicitud";
            $body = "Una nueva solicitud se ha creado, puedes verla en la intranet";

            $mailer->setSender($sender);
            $mailer->addRecipient($recipient1);

            $mailer->setSubject($subject);
            $mailer->setBody($body);

            return $mailer->Send();
        }

    }

    /**
	 * Validate if user has access to watch centain parts of the details form
     *
	 * @return  int
     * -1 : not show at all
     * 0 : not show fieldset
     * 1 : show only first fieldset
     * 2 : show both fieldset
	 */
    public function ValidateShowForm(){

        $user = JFactory::getUser();
        $helper = new FrmTezzaHelper();
        $form = $this->getForm();

        $id_user = $user->id;
        $is_approval = $form->approval;
        $is_approval_rrhh = $form->approval_rrhh;

        // RRHH
        $is_rrhh_boss = $helper->getIsBossRRHH();

        if ( $is_rrhh_boss ) {
            if ( $is_approval )
                return 2;
            else
                return 1;
        }

        // Boss area
        $id_area = $helper->getUserArea();
        $is_boss = $helper->getIsBoss($id_area);
        $id_form_area = $form->id_area;

        if ( $id_area != $id_form_area ) return -1;

        if ( $is_boss ){
            if ( $is_approval && $is_approval_rrhh )
                return 2;
            else
                return 1;
        }

        // Common user
        if ( $is_approval && $is_approval_rrhh ) {
            return 2;
        } else if ( is_null($is_approval) ){
            return 0;
        } else {
            return 1;
        }

    }



    /**
	 * Validate if form show save button, and validate for saving function
     *
	 * @return  mixed
     *  false - not boss
     * 1 - boss aproval
     * 2- boss rrhh aproval
     *
	 */
    public function ValidateShowSaveButton(){

        $helper = new FrmTezzaHelper();
        $id_area = $helper->getUserArea();
        $form = $this->getForm();

        // Approbal
        $is_approval = $form->approval;
        $is_approval_rrhh = $form->approval_rrhh;

        // Boss area
        $is_boss = $helper->getIsBoss($id_area);
        $is_rrhh_boss = $helper->getIsBossRRHH();

        // First part show for saving
        if ( $is_boss && is_null($is_approval) ){
            return 1;
        }

        // Second part show for saving
        if ( $is_rrhh_boss && is_null($is_approval_rrhh) && $is_approval ){
            return 2;
        }

        return false;
    }


    /**
	 * Get data from Breezing Forms
     *
     * @param int id_record id record Breezing Forms
     *
	 * @return  Object
     *
	 */
    public function getDataRecordBF( $id_record ){
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select( array($db->quoteName('name'), $db->quoteName('value')) );
        $query->from($db->quoteName('#__facileforms_subrecords'));
        $query->where($db->quoteName('record') . ' = ' . $id_record );

        $db->setQuery($query);

        $result =  $db->loadAssocList('name', 'value');

        return $result;
    }

}






// $title = JFactory::getDocument()->getTitle();
// $url = JURI::base()."administracion-formularios.html";
// $id_jefe = ff_getSubmit('id_jefe');
// $user_jefe = JFactory::getUser($id_jefe);

// $config = JFactory::getConfig();
// $sender = array(
// 	$config->get( 'mailfrom' ),
// 	$config->get( 'fromname' )
// );

// $recipient1 = $user->email;
// $recipient2 = $user_jefe->email;

// if ( $recipient1 ){
// 	$subject = "Creaste una nueva solicitud - ".$title;
// 	$body = "<p>Puedes hacer un seguimiento de la solicitud de ".$title." en la intranet</p>";
// 	$body .= "<a href='".$url."' target='_blank'>Ver Solicitud</a>";

// 	$mailer1 = JFactory::getMailer();
// 	$mailer1->isHtml(true);
// 	$mailer1->Encoding = 'base64';

// 	$mailer1->setSender($sender);
// 	$mailer1->addRecipient( $recipient1 );

// 	$mailer1->setSubject($subject);
// 	$mailer1->setBody($body);

// 	$mailer1->Send();
// }





// // -- Obtener el ID del área de Jefes

// $query = $db->getQuery(true);
// $query->select(array('id'))
// 	->from($db->quoteName('#__usergroups'))
// 	->where($db->quoteName('title') . " LIKE '%Area%JEFE%'")
// 	->setLimit(1);

// $db->setQuery($query);

// $area_jefes =  $db->loadResult();
// $area_user = $area->group_id;
// $id_jefe = 0;

// // -- Obtener el ID del jefe de área

// $subQuery = $db->getQuery(true);
// $query    = $db->getQuery(true);

// // Create the base subQuery select statement.
// $subQuery->select(array('user_id'))
// 	->from($db->quoteName($db->getPrefix().'user_usergroup_map'))
// 	->where($db->quoteName('group_id') . ' = ' . $area_jefes);

// // Create the base select statement.
// $query->select(array('user_id'))
// 	->from($db->quoteName('#__frmtezza_v_user_area'))
// 	->where($db->quoteName('group_id') . ' = ' . $area_user)
// 	->where($db->quoteName('user_id') . ' IN (' . $subQuery . ')');

// $db->setQuery($query);
// $id_jefe = $db->loadResult();

// ff_setValue('id_jefe',$id_jefe); //Asignar el valor del id jefe al campo

