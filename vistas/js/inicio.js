// GRAFICO PORCENTAJE CLASIFICACION

  // let data = {
  //   labels: ['Flacas', 'Buenas', 'Buenas+', 'Muy Buenas', 'Apenas Gordas', 'Gordas'],
  //   datasets: [
  //     {
  //       label: 'Dataset 1',
  //       data: [49,6,14,25,3,2],
  //       backgroundColor:[
  //         '#dd4b39',
  //         'rgb(137 221 113)',
  //         '#00a65a',
  //         '#00a65a',
  //         '#f39c12 ',
  //         '#dd4b39'

  //       ],
  //     }
  //   ]
  // };

  // const config = {

  //     type: 'pie',
  // 	plugins:[ChartDataLabels],
  //     data: data,
  //     options: {
  //       plugins:{
  //         datalabels: {
  //                 /* anchor puede ser "start", "center" o "end" */
  //             anchor: "center",
  //             /* Podemos modificar el texto a mostrar */
  //             formatter: (dato) => dato + "%",
  //             /* Color del texto */
  //             color: "black",
  //             /* Formato de la fuente */
  //             font: {
  //             family: '"Calibri", sans-serif',
  //             size: "18",
  //             weight: "bold",
  //             },
            
  //         },
  //         layout:{
  //           padding:{
  //             top:0
  //           }
  //         },
  //         legend: {
  //           display: true,
  //           position:'top'
  //        },
  //        tooltips: {
  //           enabled: false
  //        }

  //       },

  //     },

  // }
  // const ctx = document.getElementById('chart-area').getContext('2d');

  // let myChart = new Chart(ctx, config);

// CAMBIAR ESTILO ULTIMA COLUMNA TABLA CLASIFICACION

const rows = document.querySelectorAll('.tablaClasificacion tbody tr')

for (const row of rows) {
    
     row.lastElementChild.style.textAlign = 'center'

}