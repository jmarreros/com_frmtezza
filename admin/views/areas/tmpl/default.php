<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_frmtezza
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
var_dump($this->items);
?>

<form action="index.php?option=com_frmtezza&view=areas" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="50%">
				<?php echo JText::_('Área') ;?>
			</th>
			<th width="50%">
				<?php echo JText::_('Jefe'); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : ?>
					<tr>
						<td>
							<?php echo $row->title; ?>
						</td>
						<td>
							<?php echo 'Jefe'; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</form>
