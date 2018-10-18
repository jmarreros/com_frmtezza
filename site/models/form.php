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


}