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
<p>
Las áreas se crean en los <a href="index.php?option=com_users&view=groups">Grupos de Usuarios</a>.
<br>
<ul>
<li>Todos los grupos que empiecen con <i>'Area - '</i>, son considerados áreas</li>
<li>Para asignar jefes el usuario también debe pertencer al área <i>'Area - JEFE AREA'</i></li>
<li>Para cambiar/asignar el jefe de un área se debe hacer desde la <a href="index.php?option=com_users&view=users">administración de usuarios</a>,
<br> buscar el usuario, al editarlo, buscar el tab de <i>Grupo de Usario asignados</i></li>
</p>

<p style="text-align:center;background-color:#f9f9f9;padding:16px;margin-top:20px;text-transform:uppercase"><strong>Asignaciones de jefes por área</strong></p>

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
				<?php foreach ($this->items as $row) : ?>
					<tr>
						<td>
							<?php echo $row['area'] ?>
						</td>
						<td>
							<?php
								if ( ! empty($row['boss']) ){
									foreach ( $row['boss'] as $i => $boss){
										if ( $i ) echo "<br>";
										echo $boss->name;
									}
								} else {
									echo "<a href='index.php?option=com_users&view=users'>Asignar Jefe</a>";
								}
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</form>
