<?
	$this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
?>
<div class="canvas" style="width: 500px; margin-top: 80px; text-align:center;">
	<img src="<?=base_url('assets/img/grow-logo.png')?>" style="width:130px;" />
	<br /><br />
	<h1>Registro</h1>
	<?=form_open(base_url( 'index.php/registro/signup' ))?>
	<table class="registro" cellspacing="0" cellpadding="0">
		</tr>
			<td>
				<?=form_input( $form_nombre )?>
				<?=form_error('nombre');?>
			</td>
		</tr>
		</tr>
			<td>
				<?=form_input( $form_email )?>
				<?=form_error('email');?>
			</td>
		</tr>
		</tr>
			<td>
				<?=form_input( $form_password )?>
				<?=form_error('password');?>
			</td>
		</tr>
		</tr>
			<td>
				<?=form_input( $form_grow_id )?>
				<?=form_error('grow_id');?>
			</td>
		</tr>
		<tr class="submit">
			<td>
				<br />
				<?=form_submit('mysubmit', 'Registrar Planta')?>
				<br />
				<br />
				<br />
				<div style="text-align:left;"><a href="<?=base_url( 'index.php/registro/login' )?>">Login</a></div>
			</td>
		</tr>
	</table>
	<?=form_close()?>
</div>