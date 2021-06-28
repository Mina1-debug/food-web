// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
var ctx = document.getElementById("myPieChart");
var config = {
  type: 'doughnut',
  data: {
    labels: ["Least", "Fast"],
    datasets: [{
      data: [100, 100],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
}
var pieChart = new Chart(ctx, config);

$(document).ready(function() {
  $.ajax({
    url: "core/chart_data.php",
    method: "post",
    dataType: "json",
    data: {
      chart: "pie"
    },
    error: function (e) {
    },
    beforeSend: function () {
    },
    success: function (response) {
      if(response['status'] == "OK") {
        pieChart.data.datasets[0].data = [
          response["data"]['fast']['count'] ?? 0,
          response["data"]['least']['count'] ?? 0
        ];
        pieChart.data.labels = [
          "Fast Moving Food("+ response["data"]['fast']['name'] +")",
          "Least Moving Food("+ response["data"]['least']['name'] +")"
        ];
        pieChart.update();
        $("#fast_food").text(response["data"]['fast']['name'])
        $("#least_food").text(response["data"]['least']['name'])
      }
    }
  })
})

