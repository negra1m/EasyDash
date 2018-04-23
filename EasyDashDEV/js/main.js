/* ****************************************************************** 
//  ***** ***** ***** ********* Easy Dash ********* ***** ***** *****
//
//  Description: A tool to show Easy Vision data into Charts powered by
//  Chart-JS.
//
//  Author: Vinícius Negrão e Filipe Aparecido 
//  Company: GreenYellow do Brasil.
//  Git: www.github.com/vinegrao95/EasyDash
/* ****************************************************************** */
//  JS commands and AJAX comunication with PHP server.
/* ****************************************************************** */

//Show all the charts into the page.
$(document).ready(function(){
  $('#btn-painel-show').change(function() {
    $("#painel-pie").toggle("slow");
  });
});

var corAuto = 'rgba(34, 229, 112, 0.8)'; //green
var corManu = 'rgba(255, 0, 0, 0.5)'; //red
var corNeutra = 'rgba(146, 163, 168, 0.6)'; //grey

var corFrio = "rgba(255, 125, 0, 0.8)"; //orange
var corIlu = "rgba(0, 200, 200, 0.8)"; //blue
var corAC = "rgba(100, 29, 147, 0.8)"; //purple

//Recover the week number to build the bar-chart. 
Date.prototype.getWeekNumber = function(){
    var d = new Date(
        Date.UTC(
            this.getFullYear(), this.getMonth(), this.getDate()
        )
    );
    var dayNum = d.getUTCDay() || 7;
    d.setUTCDate(d.getUTCDate() + 4 - dayNum);
    var yearStart = new Date(
        Date.UTC(d.getUTCFullYear(),0,1)
    );
    return Math.ceil((((d - yearStart) / 86400000) + 1)/7)
};
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
}
if(mm<10){
    mm='0'+mm;
} 
var today = dd+'/'+mm+'/'+yyyy; //Format date in dd/mm/yyyy format.

/*BAR CHART FOR STORES IN MANUAL STATUS per EQUIPMENT*/
$(document).ready(function aa(){
    document.getElementById("bar_waiting").setAttribute('style', 'display: block'); //set the waiting animation when the request is running.
    $.ajax({
url: "http://10.155.130.229:8090", //IP EasyVision
type: "GET",
success: function (filipinho){
    //Sucesso no AJAX
    var atual_semana = new Date().getWeekNumber();
    switch (atual_semana) { //This switch is used to correct the week number if it's on the 3 first weeks of the year.
    case 1:
        var semana_1 = 52;
        var semana_2 = semana_1-1;
        var semana_3 = semana_2-1;
    break;
    case 2:
        var semana_1 = 1;
        var semana_2 = 52;
        var semana_3 = semana_2 - 1;
    break;
    case 3:
        var semana_1 = 2;
        var semana_2 = 1;
        var semana_3 = 52;
    break;
    default:
        var semana_1 = atual_semana-1;
        var semana_2 = atual_semana-2;
        var semana_3 = atual_semana-3;
    } 
    document.getElementById("bar_waiting").setAttribute('style', 'display: none'); //set the waiting bar invisible.
    
    var result = JSON.parse(filipinho); //parse it to JSON structure.
    
    var barChartData = {
        labels: [ "Semana: "+semana_3, "Semana: "+semana_2, "Semana: "+semana_1, "Semana Atual "], //labels for the bar chart. (bottom)
        datasets: [{
            label: 'Iluminação', //label for the bar
            borderWidth: 1,
            data: [result.il_man_3, result.il_man_2, result.il_man_1, result.il_man_atual],
            backgroundColor: corIlu //referred in this document first lines.
        }, {
            label: 'Ar condicionado',
            borderWidth: 1,
            data: [result.ac_man_3, result.ac_man_2, result.ac_man_1, result.ac_man_atual],
            backgroundColor: corAC
        }, {
            label: 'Frio Alimentar',
            borderWidth: 1,
            data: [result.fa_man_3, result.fa_man_2, result.fa_man_1, result.fa_man_atual],
            backgroundColor: corFrio
        }]
    }
    
    var ctx = document.getElementById("bar").getContext("2d"); //Retrive the context into canvas tag for the bar chart.
    window.myBar = new Chart(ctx, {
        type: 'bar', //cfg for the chart type
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            title: {
                display: true,
                text: 'Lojas com Status em Manual '+ today
            },
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        suggestedMin: 0
                    }
                }]
            }                            
        }//end options properties
    });// end new chart Object
} // end ajax success
}); //end ajax request
}); //end onReady page load function

/* PIE CHART PARA STATUS DE ILUMINAÇÃO */
$(document).ready(function(){
    document.getElementById("pie_ilu_waiting").setAttribute('style', 'display: block');
    $.ajax({


                url: "http://127.0.0.1:8080/pie.php",
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.querySelector("#pie_ilu_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho); //retrieve all data by a query in database file 'pie.php'                    
                    console.log(result); 
                    var total = result.il_man + result.ac_auto;
                    var manu = ((result.il_man*100)/total).toFixed(2);
                    var auto = ((result.il_auto*100)/total).toFixed(2);
                    var teste_pie_integration = {
                        type: 'pie',
                        data: {
                          labels: ["Manual %", "Automático %"],
                          datasets: [
                            {
                              label: "Lojas",
                              backgroundColor: [corManu, corAuto],
                              data: [manu, auto]
                            }
                          ]
                        },
                        options: {
                            percentageInnerCutout: 80,
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                            display: true,
                            text: 'Iluminação em: '+today
                          },
                          responsive: true
                        }
                    }
                    new Chart(document.querySelector("#doughnut_il"), teste_pie_integration); //end new chart declaration
                }//end AJAX success
            })//end AJAX request
});

/*PIE CHART DE FRIO ALIMENTAR*/
$(document).ready(function(){
    document.getElementById("pie_fa_waiting").setAttribute('style', 'display: block');
    $.ajax({

                url: "http://127.0.0.1:8080/pie.php",
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("pie_fa_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    var total = result.fa_man + result.fa_auto;
                    var manu = ((result.fa_man*100)/total).toFixed(2);
                    var auto = ((result.fa_auto*100)/total).toFixed(2);
                    new Chart(document.getElementById("doughnut_fa"), {
                        type: 'pie',
                        data: {
                          labels: ["% Manual", "% Automático"],
                          datasets: [
                            {
                              label: "Lojas",
                              backgroundColor: [corManu, corAuto],
                              data: [manu, auto]
                            }
                          ]
                        },
                        options: {
                          legend: {
                                position: 'bottom'
                          },
                          title: {
                            display: true,
                            text: 'Frio Alimentar em: '+today
                          },
                          responsive: true
                        }
                    });
                }
            })
});
/*PIE CHART DE AC*/
$(document).ready(function(){
    document.getElementById("pie_ac_waiting").setAttribute('style', 'display: block');
    $.ajax({

                //url: "http://10.155.130.229:8090/pie.php", //
                url: "http://127.0.0.1:8080/pie.php",
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("pie_ac_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    var total = result.ac_man + result.ac_auto;
                    var manu = ((result.ac_man*100)/total).toFixed(2);
                    var auto = ((result.ac_auto*100)/total).toFixed(2);
                    var pie_ac = new Chart(document.getElementById("doughnut_ac"), {
                        type: 'pie',
                        //onAnimationProgress: drawSegmentValues,
                        data: {
                          labels: ["Manual %", "Automático %"],
                          datasets: [
                            {
                              label: "Lojas",
                              backgroundColor: [corManu, corAuto],
                              data: [manu, auto]
                            }
                          ]
                        },
                        options: {
                           legend: {
                                position: 'bottom'
                          },
                          title: {
                            display: true,
                            text: 'Ar condicionado em: '+today
                          },
                          responsive: true
                        }
                    });                   
                }
            })
});
/*PIE CHART DE ECONOMIA DAS LOJAS (DADOS EMIS)*/
$(document).ready(function(){
    document.getElementById("pie_emis").setAttribute('style', 'display: block');
    $.ajax({

                url: "http://10.155.130.229:8090/emis.php", //mudar
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("bar_emis").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    var total_lojas = result.loja_vermelha + result.loja_verde + result.loja_neutra;
                    console.log(total_lojas);
                    document.getElementById("nmr_lojas").innerHTML="  "+ total_lojas+ ' Lojas Integradas';
                    var pie_ac = new Chart(document.getElementById("pie_emis"), {
                        type: 'pie',
                        data: {
                          labels: ["Abaixo da Performance", "Acima da Performance", "Dentro da Performance"],
                          datasets: [
                            {
                              label: "Lojas",
                              backgroundColor: [corManu, corAuto, corNeutra],
                              data: [result.loja_vermelha, result.loja_verde, result.loja_neutra]
                            }
                          ]
                        },
                        options: {
                           legend: {
                                position: 'bottom'
                          },
                          title: {
                            display: false,
                            text: 'Status de economia Atual das Lojas: '
                          },
                          responsive: true
                        }
                    });
                    var atual_semana = new Date().getWeekNumber();
                    document.querySelector("#economia").innerHTML = "Performance Semana: "+ atual_semana; //Escreve o número da semana no gráfico de pizza
                }
            })
});
  var data_plan = Date("YYYY/MM/DD");
  $('#btn-download-ilu').click(function(){
    var condicao = 1;
    $.ajax({
                url: "http://10.155.130.229:8090/download.php?condicao="+condicao, //mudar
                type: "GET",
                success: function (result){
                  var a = document.createElement('a');
                  a.href = "iluminacao.csv";
                  a.setAttribute('download', "Iluminacao em "+data_plan+".csv");
                  document.body.appendChild(a);
                  a.click();
                }
            })});


  $('#btn-download-frio').click(function(){
    var condicao = 2;
    $.ajax({
                url: "http://10.155.130.229:8090/download.php?condicao="+condicao, //mudar
                type: "GET",
                success: function (result){
                  var a = document.createElement('a');
                  a.href = "frio-alimentar.csv";
                  a.setAttribute('download', "Frio Alimentar em "+data_plan+".csv");
                  document.body.appendChild(a);
                  a.click();
                }
            })});

  $('#btn-download-ac').click(function(){
    var condicao = 3;
    $.ajax({
                url: "http://10.155.130.229:8090/download.php?condicao="+condicao, //mudar
                type: "GET",
                success: function (result){
                  var a = document.createElement('a');
                  a.href = "ar-condicionado.csv";
                  a.setAttribute('download', "Ar Condicionado em "+data_plan+".csv");
                  document.body.appendChild(a);
                  a.click();
                }
            })
  });