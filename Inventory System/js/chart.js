// Get the canvas element
var ctx = document.getElementById('myChart').getContext('2d');

// Create the chart
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: 'Number of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: 'rgba(54, 162, 235, 0.5)', // Set background color for bars
      borderColor: 'rgba(54, 162, 235, 1)', // Set border color for bars
      borderWidth: 1 // Set border width for bars
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


// Get the canvas element
var wh_chartctx = document.getElementById('wh_chart').getContext('2d');

// Create the chart
var wh_chart = new Chart(wh_chartctx, {
  type: 'doughnut',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: 'Number of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: 'rgba(54, 162, 235, 0.5)', // Set background color for bars
      borderColor: 'rgba(54, 162, 235, 1)', // Set border color for bars
      borderWidth: 1 // Set border width for bars
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false, // Disable maintaining aspect ratio
    aspectRatio: 1,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});