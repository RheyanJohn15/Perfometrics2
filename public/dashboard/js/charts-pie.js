/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
function pieLoad(student, teacher, coordinator){
  const pieConfig = {
    type: 'doughnut',
    data: {
      datasets: [
        {
          data: [student, teacher, coordinator],
          /**
           * These colors come from Tailwind CSS palette
           * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
           */
          backgroundColor: ['#ff5a1f', '#0e9f6e', '#3f83f8'],
          label: 'Population',
        },
      ],
      labels: ['Students', 'Teachers', 'Coordinators'],
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

function RankingBarGraph(data){
   const teacher = [];
   const finalScores = [];
   let array = data.length;

   for(let i= 0; i<array; i++){
    data.sort((a, b) => b[1] - a[1]);
    const teach = data[i];

   
    teacher.push(teach[0]);
    finalScores.push(teach[1]);
   }
  
  const barConfig = {
    type: 'bar',
    data: {
      labels: teacher,
      datasets: [
        {
          label: '',
          backgroundColor: '#ff8a4c',
          // borderColor: window.chartColors.red,
          borderWidth: 1,
          data: finalScores,
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
  const barsCtx = document.getElementById('Rankingbars');
  window.myBar = new Chart(barsCtx, barConfig);
}
function PercentageLine(data){
  const teacher = [];
  const studentScore = [];
  const coordinatorScore =[];
  let array = data.length;

  for(let i= 0; i<array; i++){
   data.sort((a, b) => b[1] - a[1]);
   const teach = data[i];
  
   teacher.push(teach[0]);
   studentScore.push(teach[2]);
   coordinatorScore.push(teach[3]);
  }
 
  const lineConfig = {
    type: 'line',
    data: {
      labels: teacher,
      datasets: [
        {
          label: 'Student Evaluators',
          backgroundColor: '#0694a2',
          borderColor: '#0694a2',
          data: studentScore,
          fill: false,
        },
        {
          label: 'Evaluator Score',
          fill: false,
          backgroundColor: '#7e3af2',
          borderColor: '#7e3af2',
          data: coordinatorScore,
        },
      ],
    },
    options: {
      responsive: true,
      legend: {
        display: false,
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true,
      },
      scales: {
        x: {
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Month',
          },
        },
        y: {
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Value',
          },
          suggestedMin: 0, // Set the suggested minimum value
          suggestedMax: 100, // Set the suggested maximum value
        },
      },
    }
  };
  
  const lineCtx = document.getElementById('linePercentage');
  window.myLine = new Chart(lineCtx, lineConfig);
}
