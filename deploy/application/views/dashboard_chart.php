<div id="continuous_date_chart">
	<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.0','packages':['corechart']}]}"></script>
	<script type="text/javascript">

		google.setOnLoadCallback(drawContinuousDateChart);
	
	function drawContinuousDateChart()
	{
		// Create and populate the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('datetime', 'Fecha y Hora');
		data.addColumn('number', 'Max Hum');
		data.addColumn('number', 'Min Hum');
		data.addColumn('number', 'Max Temp');
		data.addColumn('number', 'Min Temp');
		data.addColumn('number', 'Luz');
		data.addColumn('number', 'Riego');
		data.addColumn('number', 'Hum (%)');
		data.addColumn('number', 'Temp (ºC)');
		data.addRows([
			<?
				foreach( $planta_log as $log )
				{
					echo "[new Date(" . date("Y", strtotime($log->fechaAuto)) . ", " . ( (int) date("n", strtotime($log->fechaAuto) )  - 1 ) . ", " . date("d", strtotime($log->fechaAuto)) . ", " . date("H", strtotime($log->fechaAuto)) . ", " . date("i", strtotime($log->fechaAuto)) . ", 0), ". round($log->avg_max_hum, 1) . ", ". round($log->avg_min_hum, 1) . ", 25, 35, ". $log->sum_luz . ", ". $log->sum_riego . ", ". round($log->avg_hum, 1) . ", ". round($log->avg_temp, 1) . "]," . "\n";
				}
			?>
		]);
	
		var options = {
						title: 'Magnolia - Historial de Temperatura y Humedad',
						width: 1200, height: 700,
						legend: 'bottom',
						hAxis: {title: 'Fecha', format: 'dd MMM HH:mm', textStyle: { fontSize: 9 }},
						vAxis: {title: 'Hum (%) - Temp (ºC)', minValue: 0},
						curveType: 'function',
						chartArea: {width: '80%', height: '80%'},
						series: {
							0: { lineDashStyle: [5, 5], color: '#66cccc', visibleInLegend: false },
							1: { lineDashStyle: [5, 5], color: '#66cccc', visibleInLegend: false },
							2: { lineDashStyle: [5, 5], color: '#ffcccc', visibleInLegend: false },
							3: { lineDashStyle: [5, 5], color: '#ffcccc', visibleInLegend: false },
							4: { lineWidth: 4, color: '#ffff99', type: "bars", visibleInLegend: false },
							5: { lineWidth: 4, color: '#ccffff', type: "bars", visibleInLegend: false },
							6: { lineWidth: 4, color: '#003399' },
							7: { lineWidth: 4, color: 'red' },
						}
		};
	
		// Create and draw the visualization.
		var chart= new google.visualization.LineChart(document.getElementById('continuous_date_chart'));
		chart.draw(data, options);
	}
	</script>
</div>