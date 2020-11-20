<div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
  window.onload = function() {
    let charts = {!! json_encode($charts) !!};
    console.log(charts);
    charts.forEach(chart => {
      var myChart = new Chart(document.getElementById(chart.name).getContext('2d'), {
        type: chart.type,
        data: {
          labels: chart.data.labels,
          datasets: [{
            label: chart.data.datasets.label,
            data: chart.data.datasets.data,
            backgroundColor: chart.data.datasets.backgroundColor,
            borderColor: chart.data.datasets.borderColor,
            borderWidth: chart.data.datasets.borderWidth
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    });
  }
</script>
<div class="grid grid-cols-{{$col}} col-gap-6 row-gap-6">
  @foreach ($charts as $chart)
    <div>
      <p class="mb-6 font-semibold capitalize">{{$chart->name}}</p>
      <canvas id="{{$chart->name}}"></canvas>
    </div>
  @endforeach
</div>
</div>
