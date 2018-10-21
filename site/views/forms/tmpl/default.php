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

// Add style css file
$jinput = JFactory::getApplication()->input;
$document = JFactory::getDocument();
$document->addStyleSheet('components/'.$jinput->get('option').'/css/style.css');

?>

<jdoc:include type="message" />

<form action="index.php?option=com_frmtezza&view=forms" method="post" id="adminForm" name="adminForm">

	<?php if ( $this->is_boss_rrhh ): ?>
		<div class="container-filter">

			<select class="tezza-area" id="tezza_area" name="tezza_area" onchange="this.form.submit();">
				<option value="0" <?php echo !$this->tezza_area?"selected":"" ?> >- Todas las Áreas -</option>
				<?php
					if ( !empty($this->areas) ) :
						foreach ($this->areas as $i => $area) :
							echo "<option value='".$area->id."' ";
							echo $this->tezza_area == $area->id?"selected":"";
							echo " >";
							echo $area->title;
							echo "</option>";
						endforeach;
					endif;
				?>
			</select>

		</div>
		<hr>
	<?php endif; ?>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
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
				<th width="10%">
					Detalle
				</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : ?>

					<tr>
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
							<?php
								if ( ! is_null($row->approval) ){
									if ( $row->approval == 1){
										?><i class="fa fa-check-square ico-approval"></i><?php
									}
									else if ($row->approval == 0){
										?><i class="fa fa-window-close ico-approval"></i><?php
									}
								}
							?>
						</td>
						<td>
							<?php $url = "index.php?option=com_frmtezza&view=form&idform=".$row->id; ?>
							<a href="<?php echo $url ?>" >Ver</a>
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



