<script type="text/javascript">

	var flipped = Array();

	function dashboardFlip(obj, flipObject)
	{
		if (flipObject == 'luz' || flipObject == 'riego')
		{
			if ( !flipped[flipObject] )
			{
				var url = baseurl + 'index.php/dashboard/flip_' + flipObject;
		
				$.ajax({
					url: url,
					beforeSend: function( ) {
		
					}
				})
				.done(function( data )
				{
					flipped[flipObject] = obj;

					$(obj).flip({
							direction:'rl',
							content: data,
							color: 'white',
							onEnd: function(){
								
								if ( flipped[flipObject] )
								{
									$(obj).addClass( "nobg" );
								}
								else
								{
									$(obj).css( "background-color", '' );
								}
							}
						});
						
					
				});
			}
		}
		else
		{
			var url = baseurl + 'index.php/dashboard/chart';
	
			$.fancybox({
				'href':		url,
				'type':		'iframe',
				'autoSize':	false,
				'width':	1200,
				'height':	700
			});
		}
	}
	
	function dashboardUnFlip(flipObject)
	{
		$(flipped[flipObject]).removeClass( "nobg" );	

		$(flipped[flipObject]).revertFlip();
		
		flipped[flipObject]= false;
	}

</script>
<div class="canvas" style="margin-top:0;">
	<table border="0" width="100%" height="620">
		<tr>
			<td width="40%">
				<div class="fondoBlanco">
					<h1><?=$plantaObj->nombre?></h1>
					<div class="subh1">Ultima sincronización: <?=$plantaObj->fechaAuto?></div>
					<div style="text-align:center;">
						<img src="<?=base_url('assets/img/temp/la-planta.png')?>" style="width:350px;" />
					</div>
				</div>
			</td>
			<td>
				<table align="center" cellpadding="8">
					<tr>
						<td>
							<div class="dashboard_icon editar" onclick="dashboardFlip(this, 'luz');">
								<img src="<?=base_url('assets/img/ico-luz.png')?>" class="icon" />
								<div class="status">ON</div>
								<div class="description">
									<?=( $plantaObj->luz_por_dia / 60 ) ?>hrs / día<br />
									<small>desde las <?=substr($plantaObj->luz_hora_encendido, 0, -3)?></small>
								</div>
							</div>
						</td>
						<td>
							<div class="dashboard_icon editar" onclick="dashboardFlip(this, 'riego');">
								<img src="<?=base_url('assets/img/ico-riego.png')?>" class="icon" />
								<div class="status">OFF</div>
								<div class="description">
									22ml / día<br />
									<small>a las 18:25</small>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="dashboard_icon graficar" onclick="dashboardFlip(this, 'humedad');">
								<img src="<?=base_url('assets/img/ico-humedad.png')?>" class="icon" />
								<div class="status"><?=$plantaObj->hum?>%</div>
								<div class="description">
									Todo Ok<br/>
									<small>La humedad se mantiene en rangos normales.</small>
								</div>
							</div>
						</td>
						<td>
							<div class="dashboard_icon graficar" onclick="dashboardFlip(this, 'temperatura');">
								<img src="<?=base_url('assets/img/ico-temperatura.png')?>" class="icon" />
								<div class="status"><?=$plantaObj->temp?> ºC</div>
								<div class="description">
									Todo Ok<br/>
									<small>La temperatura se mantiene en rangos normales.</small>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>