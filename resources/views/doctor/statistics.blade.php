@extends('layouts.app')

@section('content')
  <div id="app" class="d-flex justify-content-around flex-wrap container">
    <div class="card mb-3">
      <canvas id="messaggi-mese" width="400" height="400"></canvas>
    </div>
    <div class="card mb-3">
      <canvas id="messaggi-anno" width="400" height="400"></canvas>
    </div>
    <div class="card">
      <canvas id="recensioni-mese" width="400" height="400"></canvas>
    </div>
    <div class="card">
      <canvas id="recensioni-anno" width="400" height="400"></canvas>
    </div>
  </div>
  <footer></footer>
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script>
  var data = {!! json_encode($messFirst) !!};
  var labels = {!! json_encode($labelFirst) !!};
  var ctx = document.getElementById('messaggi-mese');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: labels,
          datasets: [{
            label: 'Messaggi',
            data: data,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
      }
  });
  </script>
  <script>
  var data = {!! json_encode($messSecond) !!};
  var labels = {!! json_encode($labelSecond) !!};
  var ctx = document.getElementById('messaggi-anno');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: labels,
          datasets: [{
            label: 'Messaggi',
            data: data,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
      }
  });
  </script>
  <script>
  var data = {!! json_encode($revFirst) !!};
  var labels = {!! json_encode($labelFirst) !!};
  var ctx = document.getElementById('recensioni-mese');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
            label: 'Recensioni',
            data: data,
            backgroundColor: 'rgba(0, 0, 0, 0.2)',
            borderColor: 'rgb(100, 100, 100)',
            borderWidth: 1
          }]
      }
  });
  </script>
  <script>
  var data = {!! json_encode($revSecond) !!};
  var labels = {!! json_encode($labelSecond) !!};
  var ctx = document.getElementById('recensioni-anno');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
            label: 'Recensioni',
            data: data,
            backgroundColor: 'rgba(0, 0, 0, 0.2)',
            borderColor: 'rgb(100, 100, 100)',
            borderWidth: 1
          }]
      }
  });
  </script>

@endsection