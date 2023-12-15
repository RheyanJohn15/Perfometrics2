function loadStudentResult(question, score){
  const barConfig = {
    type: 'bar',
    data: {
      labels: question,
      datasets: [
        {
          label: '',
          backgroundColor: '#0694a2',
          // borderColor: window.chartColors.red,
          borderWidth: 1,
          data: score,
          
        },
      ],
    },
    options: {
      responsive: true,
      legend: {
        display: false,
      },
      scales: {
        yAxes: [
            {
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 4,
                },
            },
        ],
    },
    },
  };
  
  const barsCtx = document.getElementById('barsStudent');
  window.myBar = new Chart(barsCtx, barConfig);
  
      
}


function loadTeacherResult(question, score){
  const barConfig = {
    type: 'bar',
    data: {
      labels: question,
      datasets: [
        {
          label: '',
          backgroundColor: '#7e3af2',
          // borderColor: window.chartColors.red,
          borderWidth: 1,
          data: score,
          
        },
      ],
    },
    options: {
      responsive: true,
      legend: {
        display: false,
      },
      scales: {
        yAxes: [
            {
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 4,
                },
            },
        ],
    },
    },
  };
  
  const barsCtx = document.getElementById('barsTeacher');
  window.myBar = new Chart(barsCtx, barConfig);
  
      
}