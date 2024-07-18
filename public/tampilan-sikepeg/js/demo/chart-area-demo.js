// Set new default font family and font color to mimic Bootstrap's default styling
// Dapatkan elemen canvas
var ctx = document.getElementById('myAreaChart').getContext('2d');

// Data yang akan ditampilkan dalam grafik lingkaran
var data = {
    labels: ['PNS', 'PPPK', 'Non ASN'],
    datasets: [{
        data: [30, 40, 30], // Jumlah untuk setiap bagian lingkaran
        backgroundColor: [
          'rgba(220, 25, 25, 0.7)',
          'rgba(246, 194, 62, 0.7)',
          'rgba(37, 196, 43, 0.7)'
      ],
      borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(349, 242, 17,1)',
          'rgba(37, 196, 43, 1)'
      ],
      borderWidth: 1
    }]
};

// Konfigurasi grafik lingkaran
var options = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      position: 'right',
    }
};

// Buat grafik lingkaran
var myAreaChart = new Chart(ctx, {
    type: 'pie',
    data: data,
    options: options
});