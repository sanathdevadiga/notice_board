



		function newDate(days) {
			return moment().add(days, 'd').toDate();
		}

		function newDateString(days) {
			return new Date();
		}

		var color = Chart.helpers.color;
		var temp_config = {
			type: 'line',
			data: {
				datasets: [{
					label: "TEMP",
					backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
					borderColor: window.chartColors.red,
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
                    text:"Temerature Monitor"
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
							labelString: 'Temp'
						}
					}]
				}
			}
		};
