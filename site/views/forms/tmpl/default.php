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
JHtml::_('jquery.framework', true, true);
$jinput = JFactory::getApplication()->input;
$document = JFactory::getDocument();

// $document->addScript($this->baseurl.'/media/system/js/core.js');
$document->addStyleSheet('components/'.$jinput->get('option').'/css/style.css');
$document->addScript('components/'.$jinput->get('option').'/js/script.js');

// var_dump($this->userData);
print_r($this->user_area);
var_dump($this->is_boss);

function field_pending( $is_boss_rrhh ){
	$name_class="approve";
	$text = "Mostrar sólo pendientes aprobación";
	$checked = "";

 	if ( $is_boss_rrhh ){
		$name_class="rrhh";
		$text = "Mostrar sólo pendientes aprobación RRHH";
		$$checked = "checked";
	}

	return "<div class='container-pending'>
				<input id=\"pending-$name_class\" type='checkbox' $checked />
				<label for=\"pending-$name_class\" >$text</label>
			</div>";
}

function field_document_type(){
	return "<select class='filter-document' id='filter-document' name='filter_document'>
			<option value='0'>Todos los documentos</option>
		</select>";
}
?>

<jdoc:include type="message" />

<form action="index.php?option=com_frmtezza&view=forms" method="post" id="adminForm" name="adminForm">
	<div class="container-filter">
		<div class="row">
			<div class="col-sm-5 col-md-5">
				<?php
					if ($this->is_boss_rrhh || $this->is_boss){
						echo field_pending($this->is_boss_rrhh);
					} else {
						echo field_document_type();
					}
				?>
			</div>
			<div class="col-sm-7 col-md-7">
				<div class = "container-date">
					<div>
						<span>Desde: </span>
						<?php echo JHTML::_('calendar', '', 'date_star', 'date_star','%d-%m-%Y', array('placeholder'=>'dd-mm-yyyy')); ?>
					</div>
					<div>
						<span>Hasta: </span>
						<?php echo JHTML::_('calendar', '', 'date_end', 'date_end','%d-%m-%Y', array('placeholder'=>'dd-mm-yyyy')); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
				$x = 3;
				$is_only_user = ! $this->is_boss_rrhh && ! $this->is_boss;
				if ( $is_only_user ) $x = 9;
			?>
			<div class="<?= "col-sm-$x col-md-$x"?>">
				<?php if ( $this->is_boss_rrhh || $this->is_boss ): ?>
					<input type="text" placeholder="nombre usuario" />
				<?php else: ?>
					<?= field_pending($this->is_boss_rrhh); ?>
				<?php endif; ?>
			</div>

			<?php if ( $this->is_boss_rrhh || $this->is_boss ): ?>
				<div class="col-sm-3 col-md-3">
					<?= field_document_type(); ?>
				</div>
			<?php endif; ?>

			<?php if ( $this->is_boss_rrhh || $this->is_boss ): ?>
				<div class="col-sm-3 col-md-3">
					<select class="filter-area" id="filter-area" name="filter_area" >

						<?php if ( $this->is_boss_rrhh || ( $this->is_boss && count($this->user_area) > 1 ) ): ?>
							<option value="0" <?php echo !$this->tezza_area?"selected":"" ?> >- Todas las Áreas -</option>
						<?php endif; ?>

						<?php
							if ( !empty($this->areas) ) :
								foreach ($this->areas as $i => $area) :
									if ( $this->is_boss_rrhh ){
										echo "<option value='".$area->id."' ";
										echo $this->tezza_area == $area->id?"selected":"";
										echo " >";
										echo $area->title;
										echo "</option>";
									} else if( $this->is_boss ) {
										if ( in_array($area->id, $this->user_area) ){
											echo "<option value='".$area->id."' ";
											echo $this->tezza_area == $area->id?"selected":"";
											echo " >";
											echo $area->title;
											echo "</option>";
										}
									}
								endforeach;
							endif;
						?>
					</select>
				</div>
			<?php endif; ?>

			<div class="col-sm-3 col-md-3">
				<button class="btn btn-primary" type="submit">Filtrar</button>
			</div>

		</div>




		<?php if (false && $this->is_boss_rrhh ): ?>
			<!-- Filter all area -->
			<select class="filter-area" id="filter-area" name="filter_area">
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

		<?php endif; ?>
	</div>
	<hr>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="10%">
					Fecha
				</th>
				<th width="20%">
					Formulario
				</th>
				<th width="10%">
					Aprobado
				</th>
				<th width="10%">
					RRHH
				</th>
				<th width="20%">
					Usuario
				</th>
				<th width="20%">
					Area
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
							<?php echo date("d/m/Y",strtotime($row->dt_register)); ?>
						</td>
						<td>
							<?php echo $row->title; ?>
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
						<td align="center">
							<?php
								if ( ! is_null($row->approval_rrhh) ){
									if ( $row->approval_rrhh == 1){
										?><i class="fa fa-check-square ico-approval"></i><?php
									}
									else if ($row->approval_rrhh == 0){
										?><i class="fa fa-window-close ico-approval"></i><?php
									}
								}
							?>
						</td>
						<td>
							<?php echo $row->name; ?>
						</td>
						<td>
							<?php echo $row->area; ?>
						</td>
						<td>
							<?php $url = "index.php?option=com_frmtezza&view=form&idform=".$row->id; ?>
							<a class="btn btn-primary small" href="<?php echo $url ?>" >Ver</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="7">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>

</form>



