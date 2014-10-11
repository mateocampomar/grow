<img src="<?=base_url('assets/img/ico-luz.png')?>" class="flipicon" />
<a href="javascript:dashboardUnFlip('luz')"><img src="<?=base_url('assets/img/ico-cross.png')?>" class="unflip" /></a>
<h2>Configuración de Luz</h2>
<?=form_open(base_url( 'index.php/dashboard/flip_luz' ))?>
	<table class="flip_form" border="0">
		<tr>
			<td>Horas de LUZ por día</td>
			<td align="right">
				<?=form_dropdown('por_dia', $porDiaOptions, $porDiaSelected, 'id = "por_diaSelect"')?>
			</td>
		</tr>
		<tr>
			<td>Prende a las</td>
			<td align="right">
				<?=form_dropdown('horaHH', $horaHHOptions, $horaHHSelected, 'id = "horaHHSelect"')?> : <?=form_dropdown('horaMM', $horaMMOptions, $horaMMSelected, 'id = "horaMMSelect"')?>
			</td>
		</tr>
		<tr class="submit">
			<td colspan="2">
				<br />
				<?=form_submit('mysubmit', 'Guardar')?>
			</td>
		</tr>
	</table>
<?=form_close();?>