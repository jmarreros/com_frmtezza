<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$jinput = JFactory::getApplication()->input;
$document = JFactory::getDocument();
$document->addStyleSheet('components/'.$jinput->get('option').'/css/style.css');

?>

<form action="index.php?option=com_frmtezza&view=forms" method="post" id="adminForm" name="adminForm">

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="1%">#</th>
				<th width="20%">
					Formulario
				</th>
				<th width="20%">
					Usuario
				</th>
				<th width="20%">
					Area
				</th>
				<th width="10%">
					Fecha
				</th>
				<th width="10%">
					Aprobado
				</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : ?>

					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo $row->title; ?>
						</td>
						<td>
							<?php echo $row->name; ?>
						</td>
						<td>
							<?php echo $row->area; ?>
						</td>
						<td>
							<?php echo $row->dt_register; ?>
						</td>
						<td align="center">
							<?php echo $row->approval; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>

</form>

<script>

document.getElementById("tezza_limpiar").addEventListener("click", function(){
	document.getElementById("tezza_search").value = '';
	document.getElementById("adminForm").submit();
});

</script>


