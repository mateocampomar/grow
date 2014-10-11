<?
	$this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
?>
<div class="canvas" style="width: 500px; margin-top: 80px; text-align:center;">
	<img src="<?=base_url('assets/img/grow-logo.png')?>" style="width:130px;" />
	<br /><br />
	<h1>Login</h1>
	<?=form_open(base_url( 'index.php/registro/login' ))?>
	<table class="registro" cellspacing="0" cellpadding="0">
		</tr>
			<td>
				<?=form_input( $form_email )?>
				<?=form_error('email');?>
				<?
					if ( $invalidLogin )
					{
						?><div class="form_error">Login Inválido</div><?
					}
				?>
			</td>
		</tr>
		</tr>
			<td>
				<?=form_input( $form_password )?>
				<?=form_error('password');?>
			</td>
		</tr>
		<tr class="submit">
			<td>
				<br />
				<?=form_submit('mysubmit', 'Login')?>
				<br />
				<br />
				<br />
				<div style="text-align:left;"><a href="<?=base_url( 'index.php/registro/signup' )?>">Registro</a></div>
			</td>
		</tr>
	</table>
	<?=form_close()?>
</div>