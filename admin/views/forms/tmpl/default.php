<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_frmtezza
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<form action="index.php?option=com_frmtezza&view=forms" method="post" id="adminForm" name="adminForm">
	<div class="row-fluid" style="text-align:right">

		<div class="btn-wrapper input-append">
			<input type="text" name="tezza_search" id="tezza_search" value="<?php echo $this->tezza_search; ?>" placeholder="Buscar" data-original-title="" title="">
				<button type="submit" class="btn hasTooltip" title="" aria-label="Buscar" data-original-title="Buscar">
				<span class="icon-search" aria-hidden="true"></span>
			</button>
		</div>

		<select id="tezza_area" name="tezza_area" onchange="this.form.submit();">
			<option value="" selected="selected">- Todas las Áreas -</option>
			<option value="1">1</option>
		</select>
	</div>

	<hr>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="1%">#</th>
				<th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
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
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
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
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>

</form>