@extends('admin.dashboard')
@section('content')
<ul class="nav nav-tabs" id="myTab0" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link bg-light" id="home-tab0" data-bs-toggle="tab" data-bs-target="#home0" type="button" role="tab" aria-controls="home" aria-selected="true">
        DashBoard
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link bg-light" id="profile-tab0" data-bs-toggle="tab" data-bs-target="#profile0" type="button" role="tab" aria-controls="profile" aria-selected="false">
        Statistik
      </button>
    </li>
  
  </ul>
  <div class="tab-content bg-light" id="myTabContent0">
    <div class="tab-pane fade show active w-100 text-dark" id="home0" role="tabpanel" aria-labelledby="home-tab0">
        <center>
            <br><br><br>
            <br><br><br>
            <h3>Selamat datang kembali, {{auth()->user()->username}}</h3>
            <br><br><br>
            <br><br><br>
        </center>
    </div>
    <div class="tab-pane fade bg-light text-dark w-100" id="profile0" role="tabpanel" aria-labelledby="profile-tab0">
       <div class="container">
        <br>
        <label for="" class="mb-3">Daftar Produk paling di minati :</label>
        <canvas id="myChart" width="400" height="150"></canvas>
       </div>
    </div>
  
  </div>
  <script>
      var data = @json($data);
      var frekuensi = [];
      var lbl =[];
      for (let i = 0; i < data.length; i++) {
          const element = data[i];
          frekuensi.push(element.total);
          lbl.push(element.product);
      }
     
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: lbl,
              datasets: [{
                  label: '# of Votes',
                  data: frekuensi,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  </script>
@stop