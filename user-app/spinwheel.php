<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Source Code Of Spin Wheel</title>
    <!---------------  CSS  --------------------->
    <!-- <link rel="stylesheet" href="style.css"> -->
     <style>
        @import url('https://fonts.googleapis.com/css2?family=PT+Serif&display=swap');

/*-----------------  VARIABLES  -----------------*/
:root {
    /* Colors */ 
    --white_color : rgb(255, 255, 255);
    --gold_color: rgb(255, 215, 0);
    --green_color: rgb(45, 252, 26);
    --body_background: linear-gradient(to right, #141e30, #243b55);
    --spin_background: linear-gradient(to right, #fc4a1a, #f7b733);
}
/*-----------------  Base  -----------------*/
* {
    box-sizing: border-box;
    padding: 0;
    margin: 0;
    font-family: 'PT Serif', serif;
}
body {
  height: 100vh;
  background: var(--body_background);
}
/*-----------------  Styling Start  -----------------*/
h1 {
  position: absolute;
  font-size: 4rem;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: var(--gold_color);
}
.container {
  width: 90%;
  max-width: 34.37rem;
  margin-top: 3rem;
  max-height: 90vh;
  position: absolute;
  transform: translate(-50%, -50%);
  top: 50%;
  left: 50%;
  padding: 3rem; 
  border-radius: 1rem;
}
.wheel_box {
  position: relative;
  width: 100%;
  height: 100%;
}
#spinWheel {
  max-height: inherit;
  width: inherit;
  transform: rotate(270deg);
}
#spin_btn {
  position: absolute;
  transform: translate(-50%, -50%);
  top: 50%;
  left: 50%;
  height: 26%;
  width: 26%;
  border-radius: 50%;
  cursor: pointer;
  border: 0;
  background: var(--spin_background);
  color: var(--white_color);
  text-transform: uppercase;
  font-size: 1.8rem;
  letter-spacing: 0.1rem;
  font-weight: 600;
}
.fa-solid {
  position: absolute;
  top: -8%;
  left: 43.7%;
  font-size: 4rem;
  color: var(--green_color);
  transform: rotate(-225deg);
}
#text {
  font-size: 1.5rem;
  text-align: center;
  margin-top: 1.5rem;
  color: var(--gold_color);
  font-weight: 500;
}

     </style>
    <!---------------  Font Aewsome  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!---------------  Chart JS  --------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!---------------  Chart JS Plugin  --------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script> 
</head>
<body>
  <h1>JACKPOT</h1>
  <div class="container">
     <div class="wheel_box">
      <canvas id="spinWheel"></canvas>
      <button id="spin_btn">Spin</button>
      <i class="fa-solid fa-location-arrow"></i>
     </div> 
    <div id="text"><p>Wheel Of Fortune</p></div>
  </div>
  <!---------------  SCRIPT  --------------------->
  <!-- <script src="script.js"></script>   -->
   <script>
    /* --------------- Spin Wheel  --------------------- */
const spinWheel = document.getElementById("spinWheel");
const spinBtn = document.getElementById("spin_btn");
const text = document.getElementById("text");
/* --------------- Minimum And Maximum Angle For A value  --------------------- */
const spinValues = [
  { minDegree: 61, maxDegree: 90, value: 100 },
  { minDegree: 31, maxDegree: 60, value: 200 },
  { minDegree: 0, maxDegree: 30, value: 300 },
  { minDegree: 331, maxDegree: 360, value: 400 },
  { minDegree: 301, maxDegree: 330, value: 500 },
  { minDegree: 271, maxDegree: 300, value: 600 },
  { minDegree: 241, maxDegree: 270, value: 700 },
  { minDegree: 211, maxDegree: 240, value: 800 },
  { minDegree: 181, maxDegree: 210, value: 900 },
  { minDegree: 151, maxDegree: 180, value: 1000 },
  { minDegree: 121, maxDegree: 150, value: 1100 },
  { minDegree: 91, maxDegree: 120, value: 1200 },
];
/* --------------- Size Of Each Piece  --------------------- */
const size = [10, 10, 10, 10, 10, 10, 10, 10];
/* --------------- Background Colors  --------------------- */
var spinColors = [
  "#E74C3C",
  "#7D3C98",
  "#2E86C1",
  "#138D75",
  "#F1C40F",
  "#D35400",
  "#138D75",
  "#F1C40F",
  "#b163da",
  "#E74C3C",
  "#7D3C98",
  "#138D75",
];
/* --------------- Chart --------------------- */
/* --------------- Guide : https://chartjs-plugin-datalabels.netlify.app/guide/getting-started.html --------------------- */
let spinChart = new Chart(spinWheel, {
  plugins: [ChartDataLabels],
  type: "pie",
  data: {
    labels: [1, 2, 3, 4, 5, 6, 7, 8],
    datasets: [
      {
        backgroundColor: spinColors,
        data: size,
      },
    ],
  },
  options: {
    responsive: true,
    animation: { duration: 0 },
    plugins: {
      tooltip: false,
      legend: {
        display: false,
      },
      datalabels: {
        rotation: 90,
        color: "#ffffff",
        formatter: (_, context) => context.chart.data.labels[context.dataIndex],
        font: { size: 24 },
      },
    },
  },
});
/* --------------- Display Value Based On The Angle --------------------- */
const generateValue = (angleValue) => {
  for (let i of spinValues) {
    if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
      text.innerHTML = `<p>Congratulations, You Have Won $${i.value} ! </p>`;
      spinBtn.disabled = false;
      break;
    }
  }
};
/* --------------- Spinning Code --------------------- */
let count = 0;
let resultValue = 101;
spinBtn.addEventListener("click", () => {
  spinBtn.disabled = true;
  text.innerHTML = `<p>Best Of Luck!</p>`;
  let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
  let rotationInterval = window.setInterval(() => {
    spinChart.options.rotation = spinChart.options.rotation + resultValue;
    spinChart.update();
    if (spinChart.options.rotation >= 360) {
      count += 1;
      resultValue -= 5;
      spinChart.options.rotation = 0;
    } else if (count > 15 && spinChart.options.rotation == randomDegree) {
      generateValue(randomDegree);
      clearInterval(rotationInterval);
      count = 0;
      resultValue = 101;
    }
  }, 10);
});
/* --------------- End Spin Wheel  --------------------- */
   </script>
</body>   
</html>