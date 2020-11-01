



		function newDate(days) {
			return moment().add(days, 'd').toDate();
		}

		function newDateString(days) {
			return new Date();
		}

		var color = Chart.helpers.color;
		var hum_config = {
			type: 'line',
			data: {
				datasets: [{
					label: "PULSE",
					backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
					borderColor: window.chartColors.blue,
					fill: true,
					data: [{
						x: newDateString(0),
						y: randomScalingFactor()
					}, {
						x: newDateString(2),
						y: randomScalingFactor()
					}, {
						x: newDateString(4),
						y: randomScalingFactor()
					}, {
						x: newDateString(5),
						y: randomScalingFactor()
					}],
				}]
			},
			options: {
				responsive: true,
                title:{
                    display:true,
                    text:"Pulse Monitor"
                },
				scales: {
					xAxes: [{
						type: "time",
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Date'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Humidity'
						}
					}]
				}
			}
		};
