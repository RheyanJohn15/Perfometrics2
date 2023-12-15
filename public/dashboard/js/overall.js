function dataAnalytics(student, teacher, overall, filter) {
 if(filter==="9"){
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
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: student,
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: teacher,
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: overall,
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="1"){

  const barConfig = {
    type: 'bar',
    data: {
      labels: [
        'SY 2023-2024(1st Semester)',
        'SY 2023-2024(2nd Semester)',
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[0], student[1]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[0], teacher[1]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[0], overall[1]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="2"){

  const barConfig = {
    type: 'bar',
    data: {
      labels: [
        'SY 2024-2025(1st Semester)',
        'SY 2024-2025(2nd Semester)',
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[2], student[3]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[2], teacher[3]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[2], overall[3]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="3"){

  const barConfig = {
    type: 'bar',
    data: {
      labels: [
        'SY 2025-2026(1st Semester)',
        'SY 2025-2026(2nd Semester)',
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[4], student[5]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[4], teacher[5]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[4], overall[5]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="4"){

  const barConfig = {
    type: 'bar',
    data: {
      labels: [
        'SY 2026-2027(1st Semester)',
        'SY 2026-2027(2nd Semester)',
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[6], student[7]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[6], teacher[7]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[6], overall[7]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="5"){

  const barConfig = {
    type: 'bar',
    data: {
      labels: [
        'SY 2027-2028(1st Semester)',
        'SY 2027-2028(2nd Semester)',
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[8], student[9]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[8], teacher[9]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[8], overall[9]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="6"){

  const barConfig = {
    type: 'bar',
    data: {
      labels: [
        'SY 2023-2024(1st Semester)',
        'SY 2023-2024(2nd Semester)',
        'SY 2024-2025(1st Semester)',
        'SY 2024-2025(2nd Semester)',
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[0], student[1], student[2], student[3]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[0], teacher[1],teacher[2], teacher[3]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[0], overall[1], overall[2], overall[3]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="7"){

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
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[0], student[1], student[2], student[3], student[4], student[5]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[0], teacher[1],teacher[2], teacher[3],teacher[4], teacher[5]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[0], overall[1], overall[2], overall[3],overall[4], overall[5]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }else if(filter==="8"){

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
      ],
      datasets: [
        {
          label: 'Students Evaluation',
          backgroundColor: '#0694a2',
          borderWidth: 1,
          data: [student[0], student[1], student[2], student[3], student[4], student[5],student[6], student[7]]
        },
        {
          label: 'Coordinators Evaluation',
          backgroundColor: '#7e3af2',
          borderWidth: 1,
          data: [teacher[0], teacher[1],teacher[2], teacher[3],teacher[4], teacher[5],teacher[6], teacher[7]],
        },
        {
          label: 'Overall Score',
          backgroundColor: '#ff8a4c',
          borderWidth: 1,
          data: [overall[0], overall[1], overall[2], overall[3],overall[4], overall[5],overall[6], overall[7]],
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
                return value + '%'; // Add percent sign to tick labels
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + tooltipItem.yLabel + '%'; // Add percent sign to tooltip
          },
        },
      },
    },
  };

  const barsCtx = document.getElementById('bars');
  window.myBar = new Chart(barsCtx, barConfig);
 }
}

function getRandomHexColor() {
  const letters = '0123456789ABCDEF';
  let color = '#';
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function LineStudent(question, teacher, scores, color) {

  
 const datasets = [];
 const legend = document.getElementById('legend');
 for(let c= 0; teacher.length>c; c++){
  
  const divElement = document.createElement('div');
  divElement.classList.add("flex", "items-center");

  const spanElement1 = document.createElement('span');
  spanElement1.classList.add("inline-block", "w-3", "h-3", "mr-1","rounded-full");
  spanElement1.style.backgroundColor = color[c];

  const spanElement2 = document.createElement('span');
  spanElement2.textContent = teacher[c];

  divElement.appendChild(spanElement1);
  divElement.appendChild(spanElement2);
  
  legend.appendChild(divElement);
}
 for (let i = 0; i < teacher.length; i++) {
   datasets.push({
     label: teacher[i],
     backgroundColor: color[i],
     borderColor: color[i],
     data: scores[i],
     fill: false,
   });
 }

  const lineConfig = {
    type: 'line',
    data: {
      labels: question,
      datasets: datasets,
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
        yAxes: {
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Value',
          },
          suggestedMin: 0, 
          suggestedMax: 4, 
        },
      },
    },
  }

  const lineCtx = document.getElementById('lineStudent');
  window.myLine = new Chart(lineCtx, lineConfig);
}

function LineCoordinator(question, teacher, scores, color) {

 const datasets = [];

 for (let i = 0; i < teacher.length; i++) {
   datasets.push({
     label: teacher[i],
     backgroundColor: color[i],
     borderColor: color[i],
     data: scores[i],
     fill: false,
   });
 }
 

  const lineConfig = {
    type: 'line',
    data: {
      labels: question,
      datasets: datasets,
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
        yAxes: {
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Value',
          },
          suggestedMin: 0, 
          suggestedMax: 4, 
        },
      },
    },
  }

  const lineCtx = document.getElementById('lineCoordinator');
  window.myLine = new Chart(lineCtx, lineConfig);
}