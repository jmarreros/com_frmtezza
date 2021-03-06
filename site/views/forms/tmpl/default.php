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

// Pending field
function field_pending( $is_boss_rrhh, $pending ){
	$name_class="approve";
	$text = "Mostrar sólo pendientes aprobación";
	$checked = $pending?'checked':'';

 	if ( $is_boss_rrhh ){
		$name_class="rrhh";
		$text = "Mostrar sólo pendientes aprobación RRHH";
	}

	return "<div class='container-pending'>
				<input id=\"pending-$name_class\" name=\"pending_$name_class\" type='checkbox' $checked />
				<label for=\"pending-$name_class\" >$text</label>
			</div>";
}

// Document field
function field_document_type($filter_document){
	$documents = [
		'' => 'Todos los documentos',
		'solicitudcambioturno' => 'Cambio de turno',
		'solicituddescansovacacional' => 'Descanzo vacacional',
		'solicitudhorasextra' => 'Horas extra',
		'solicitudpermisonorecuperable' => 'Permiso No recuperable',
		'solicitudpermisorecuperable' => 'Permiso recuperable',
	];

	$cad = "<select class='filter-document' id='filter-document' name='filter_document'>";
	foreach($documents as $key => $value){
		$sel = $filter_document == $key ? 'selected' : '';
		$cad .= "<option $sel value='$key'>$value</option>";
	}
	$cad .= "</select>";

	return $cad;
}

// Area field
function field_area($is_boss_rrhh, $is_boss, $user_area, $areas, $filter_area){

	$cad = "<select class='filter-area' id='filter-area' name='filter_area'>";
	if ( $is_boss_rrhh || ( $is_boss && count($user_area) > 1 ) ){
		$cad .= "<option value='0' ! $filter_area ? 'selected':'' >- Todas las Áreas -</option>";
	}

	if ( !empty($areas) ) {
		foreach($areas as $item){
			if ( $is_boss_rrhh || ( $is_boss && in_array($item->id, $user_area) ) ){
				$cad .= "<option value='".$item->id."' ";
				$cad .= $filter_area == $item->id?"selected":"";
				$cad .= " >";
				$cad .= $item->title;
				$cad .= "</option>";
			}
		}
	}
	$cad .= '</select>';

	return $cad;

		// if ( !empty($this->areas) ) :
		// 	foreach ($this->areas as $i => $area) :
		// 		if ( $this->is_boss_rrhh || ( $this->is_boss && in_array($area->id, $this->user_area) ) ){
		// 			echo "<option value='".$area->id."' ";
		// 			echo $this->tezza_area == $area->id?"selected":"";
		// 			echo " >";
		// 			echo $area->title;
		// 			echo "</option>";
		// 		}
		// 	endforeach;
		// endif;
}
?>

<jdoc:include type="message" />

<form action="index.php?option=com_frmtezza&view=forms" method="post" id="adminForm" name="adminForm">
	<div class="container-filter" <?= !$this->user_id?"style='display:none;'":''; ?> >
		<div class="row">
			<div class="col-sm-5 col-md-5">
				<?php
					if ($this->is_boss_rrhh || $this->is_boss){
						echo field_pending($this->is_boss_rrhh, $this->pending_rrhh || $this->pending_approve);
					} else {
						echo field_document_type($this->filter_document);
					}
				?>
			</div>
			<div class="col-sm-7 col-md-7">
				<div class = "container-date">
					<div>
						<span>Desde: </span>
						<?php
						$date_star = '';
						if ( $this->date_star ) $date_star = DateTime::createFromFormat('d/m/Y', $this->date_star)->format('m/d/Y');
						echo JHTML::_('calendar', $date_star, 'date_star', 'date_star','%d/%m/%Y', array('placeholder'=>'dd/mm/yyyy'));
						?>
					</div>
					<div>
						<span>Hasta: </span>
						<?php
						$date_end = '';
						if ( $this->date_end ) $date_end = DateTime::createFromFormat('d/m/Y', $this->date_end)->format('m/d/Y');
						echo JHTML::_('calendar', $date_end, 'date_end', 'date_end','%d/%m/%Y', array('placeholder'=>'dd/mm/yyyy'));
						?>
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
					<input type="text" maxlength="80" id="indicio-nombre" value="<?= $this->indicio_nombre?$this->indicio_nombre:''; ?>" name="indicio_nombre" placeholder="Indicio nombre" />
				<?php else: //not boss?>
					<?= field_pending($this->is_boss_rrhh, $this->pending_approve); ?>
				<?php endif; ?>
			</div>

			<?php if ( $this->is_boss_rrhh || $this->is_boss ): ?>
				<div class="col-sm-3 col-md-3">
					<?= field_document_type($this->filter_document); ?>
				</div>
			<?php endif; ?>

			<?php if ( $this->is_boss_rrhh || $this->is_boss ): ?>
				<div class="col-sm-3 col-md-3">
					<?= field_area($this->is_boss_rrhh, $this->is_boss, $this->user_area, $this->areas, $this->filter_area) ?>
				</div>
			<?php endif; ?>

			<div class="col-sm-3 col-md-3">
				<button class="btn btn-primary" type="submit" id="frm-filter">Filtrar</button>
				<a href="#" id="clear-filter">Limpiar</a>
			</div>

		</div>

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



