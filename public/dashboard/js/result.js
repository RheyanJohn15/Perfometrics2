function student(header, scores){

    const barConfig = {
        type: 'bar',
        data: {
          labels: header,
          datasets: [
            {
              label: 'Mean Scores',
              backgroundColor: '#0694a2',
              borderWidth: 1,
              data: scores,
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
                  suggestedMin: 0, // Set your desired minimum value here
                  suggestedMax: 4, // Set your desired maximum value here
                },
              },
            ],
          },
        },
      };
      
      const barsCtx = document.getElementById('barStudent');
      window.myBar = new Chart(barsCtx, barConfig);
      
      
}

function coordinator(header, scores){


    const barConfig = {
        type: 'bar',
        data: {
          labels: header,
          datasets: [
            {
              label: 'Mean Scores',
              backgroundColor: '#7e3af2',
              borderWidth: 1,
              data: scores,
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
                  suggestedMin: 0, // Set your desired minimum value here
                  suggestedMax: 4, // Set your desired maximum value here
                },
              },
            ],
          },
        },
      };
      
      const barsCtx = document.getElementById('barCoordinator');
      window.myBar = new Chart(barsCtx, barConfig);
  
}

function ranking(header, scores, teacher) {
  // Combine header, scores, and teacher into an array of objects
  const dataPoints = header.map((label, index) => ({
      label,
      score: scores[index],
      isTeacher: label === teacher,
  }));

  // Sort the dataPoints array in descending order based on scores
  dataPoints.sort((a, b) => b.score - a.score);

  // Extract sorted labels, scores, and background colors
  const sortedLabels = dataPoints.map(dataPoint => dataPoint.label);
  const sortedScores = dataPoints.map(dataPoint => dataPoint.score);

  // Define an array to store background colors
  const backgroundColors = dataPoints.map(dataPoint =>
      dataPoint.isTeacher ? '#ff5a1f' : '#D3D3D3'
  );

  const barConfig = {
      type: 'bar',
      data: {
          labels: sortedLabels,
          datasets: [
              {
                  label: 'Mean Scores',
                  backgroundColor: backgroundColors,
                  borderWidth: 1,
                  data: sortedScores,
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

  const barsCtx = document.getElementById('ranking');
  window.myBar = new Chart(barsCtx, barConfig);
}


function population(student, coordinator){
    const pieConfig = {
        type: 'doughnut',
        data: {
          datasets: [
            {
              data: [student, coordinator],
              /**
               * These colors come from Tailwind CSS palette
               * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
               */
              backgroundColor: ['#047481', '#7e3af2'],
              label: 'Evaluators',
            },
          ],
          labels: ['Students', 'Coordinators'],
        },
        options: {
          responsive: true,
          cutoutPercentage: 80,
          /**
           * Default legends are ugly and impossible to style.
           * See examples in charts.html to add your own legends
           *  */
          legend: {
            display: false,
          },
        },
      }
      
      // change this to the id of your chart element in HMTL
      const pieCtx = document.getElementById('pie');
      window.myPie = new Chart(pieCtx, pieConfig);
}


function studentFrequencyDistributionGraph(frequency){
    let array = frequency.length;

    for(let i= 0; i< array; i++){

      const data = frequency[i];
      const barConfig = {
        type: 'bar',
        data: {
          labels: [0,1,2,3,4],
          datasets: [
            {
              label: 'Frequency',
              backgroundColor: '#0694a2',
              borderWidth: 1,
              data: data,
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
                  suggestedMin: 0, // Set your desired minimum value here
                 
                },
              },
            ],
          },
        },
      };
      const num = i+1;
      const barsCtx = document.getElementById('studentIndivGraph'+num);
      window.myBar = new Chart(barsCtx, barConfig);
    }

}



function coordinatorFrequencyDistributionGraph(frequency){
  let array = frequency.length;

  for(let i= 0; i< array; i++){

    const data = frequency[i];
    const barConfig = {
      type: 'bar',
      data: {
        labels: [0,1,2,3,4],
        datasets: [
          {
            label: 'Frequency',
            backgroundColor: '#7e3af2',
            borderWidth: 1,
            data: data,
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
                suggestedMin: 0, // Set your desired minimum value here
             
              },
            },
          ],
        },
      },
    };
    const num = i+1;
    const barsCtx = document.getElementById('coordinatorIndivGraph'+num);
    window.myBar = new Chart(barsCtx, barConfig);
  }

}

function TeacherPerformanceTrend(data, index) {
  const barConfig = {
    type: 'bar',
    data: {
      labels: [
        'SY 2023-2024(1st Semester)',
        'SY 2023-2024(2nd Semester)',
        'SY 2024-2025(1st Semester)',
        'SY 2024-2025(2nd Semester)',
        'SY 2025-2026(1st Semester)',
        'SY 2025-2026(2nd Semester)',
        'SY 2026-2027(1st Semester)',
        'SY 2026-2027(2nd Semester)',
        'SY 2027-2028(1st Semester)',
        'SY 2027-2028(2nd Semester)',
      ],
      datasets: [
        {
          label: 'Mean Scores',
          backgroundColor: [
            '#0694a2', // Default color for bars
            '#0694a2',
            '#0694a2',
            '#0694a2',
            '#0694a2',
            '#0694a2',
            '#0694a2',
            '#0694a2',
            '#0694a2',
            '#0694a2',
          ],
          borderWidth: 1,
          data: data,
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
              suggestedMax: 100,
              callback: function (value) {
                return value + '%';
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%';
          },
        },
      },
    },
  };

  // Change color for the specific index
  if (index >= 0 && index < barConfig.data.datasets[0].backgroundColor.length) {
    barConfig.data.datasets[0].backgroundColor[index] = '#7e3af2';
  }

  const barsCtx = document.getElementById('barsPerformanceTrend');
  window.myBar = new Chart(barsCtx, barConfig);
}
