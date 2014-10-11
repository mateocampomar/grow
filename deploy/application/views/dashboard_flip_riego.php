<img src="<?=base_url('assets/img/ico-riego.png')?>" class="flipicon" />
<a href="javascript:dashboardUnFlip('riego')"><img src="<?=base_url('assets/img/ico-cross.png')?>" class="unflip" /></a>
<h2>Configuración de Riego</h2>
<?=form_open(base_url( 'index.php/dashboard/flip_riego' ))?>
	<table class="flip_form" border="0">
		<tr>
			<td>Humedad Mínima</td>
			<td align="right">
				<?=form_dropdown('min_hum', $minHumOptions, $minHumSelected, 'id = "min_humSelect"')?>
			</td>
		</tr>
		<tr>
			<td>Humedad Máxima</td>
			<td align="right">
				<?=form_dropdown('max_hum', $maxHumOptions, $maxHumSelected, 'id = "max_humSelect"')?>
			</td>
		</tr>
		<tr class="submit">
			<td colspan="2">
				<br />
				<?=form_submit('mysubmit', 'Guardar valores para Riego')?>
			</td>
		</tr>
	</table>
<?=form_close();?>