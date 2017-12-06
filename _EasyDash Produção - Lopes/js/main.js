/* ****************************************************************** 
//
//  ***** ***** ***** ********* Easy Dash ********* ***** ***** *****
//
//  Description: A tool to show Easy Vision data into Charts powered by
//  Chart-JS.
//
//  Author: Vinícius Negrão e Filipe Aparecido 
//  Company: GreenYellow do Brasil.
//  Git: www.github.com/vinegrao95/EasyDash
//
/* ****************************************************************** */
/* ****************************************************************** 
//
//  JS commands and AJAX comunication with PHP server.
//
/* ****************************************************************** */

$(document).ready(function(){
  $('#btn-painel-show').change(function() {
    $("#painel-pie").toggle("slow");
});
});

var corAuto = 'rgba(49, 176, 213, 0.8)';
var corManu = 'rgba(200, 0, 10, 0.6)';
var corNeutra = 'rgba(146, 163, 168, 0.6)';

Date.prototype.getWeekNumber = function(){
  var d = new Date(Date.UTC(this.getFullYear(), this.getMonth(), this.getDate()));
  var dayNum = d.getUTCDay() || 7;
  d.setUTCDate(d.getUTCDate() + 4 - dayNum);
  var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
  return Math.ceil((((d - yearStart) / 86400000) + 1)/7)
};
var today = new Date();
var dd = today.getDate();
					var mm = today.getMonth()+1; //janeiro é 0!
					var yyyy = today.getFullYear();
					if(dd<10){
                       dd='0'+dd;
                   } 
                   if(mm<10){
                       mm='0'+mm;
                   } 
                   var today = dd+'/'+mm+'/'+yyyy;

                   /*BAR CHART PARA LOJAS COM STATUS EM MANUAL*/
                   $(document).ready(function aa(){
                    document.getElementById("bar_waiting").setAttribute('style', 'display: block');
                    $.ajax({

                        url: "http://13.90.144.116:8090",
                        type: "GET",
                        success: function (filipinho){
                          var atual_semana = new Date().getWeekNumber();
                          var semana_1 = atual_semana-1;
                          var semana_2 = atual_semana-2;
                          var semana_3 = atual_semana-3;
                          document.getElementById("bar_waiting").setAttribute('style', 'display: none');
                          var result = JSON.parse(filipinho); //passa os valores retornados do banco de dados para JSON.
                    var barChartData = {
                        //configurações de dados do gráfico
                    labels: [ "Semana: "+semana_3, "Semana: "+semana_2, "Semana: "+semana_1, "Semana Atual "],
                    datasets: [{
                        label: 'Iluminação',
                        borderWidth: 1,
                        data: [result.il_man_3, result.il_man_2, result.il_man_1, result.il_man_atual], //captura os valores dentro do JSON
                        backgroundColor: 'rgba(0, 200, 200, 0.8)'
                    },{
                        label: 'Frio Alimentar',
                        borderWidth: 1,
                        data: [result.fa_man_3, result.fa_man_2, result.fa_man_1, result.fa_man_atual],
                        backgroundColor: 'rgba(255, 125, 0, 0.8)'
                    }]
                }
                var ctx = document.getElementById("bar").getContext("2d");
                window.myBar = new Chart(ctx, {
                    //configurações de estilo do gráfico
                    type: 'bar',
                    data: barChartData,
                    backgroundColor: ['green', 'red'],
                    borderColor: ['green', 'red'],
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: false,
                            text: 'Lojas com Status em Manual '+today
                        },
                        scales: {
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0
                              }
                          }]
                      }                            
                  }
              });
            }
        });
                });
                   /* PIE CHART PARA STATUS DE ILUMINAÇÃO */
                   $(document).ready(function(){
                    document.getElementById("pie_ilu_waiting").setAttribute('style', 'display: block');
                    $.ajax({


                        url: "http://13.90.144.116:8090/pie.php",
                        type: "GET",
                        success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("pie_ilu_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    var total = result.il_all - result.il_man;
                    new Chart(document.getElementById("doughnut_il"), {
                        type: 'pie',
                        data: {
                          labels: ["Manual", "Automático"],
                          datasets: [
                          {
                              label: "Lojas",
                              backgroundColor: [corManu, corAuto],
                              data: [result.il_man, total]
                          }
                          ]
                      },
                      options: {
                          legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Iluminação em: '+today
                        },
                        responsive: true
                    }
                });
                }
            })
                });

                   /*PIE CHART DE FRIO ALIMENTAR*/
                   $(document).ready(function(){
                    document.getElementById("pie_fa_waiting").setAttribute('style', 'display: block');
                    $.ajax({

                        url: "http://13.90.144.116:8090/pie.php",
                        type: "GET",
                        success: function (filipinho){
                    document.getElementById("pie_fa_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    var total = result.fa_all - result.fa_man;
                    new Chart(document.getElementById("doughnut_fa"), {
                        type: 'pie',
                        data: {
                          labels: ["Manual", "Automático"],
                          datasets: [
                          {
                              label: "Lojas",
                              backgroundColor: [corManu, corAuto],
                              data: [result.fa_man, total]
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
        /*PIE CHART DE ECONOMIA DAS LOJAS (DADOS EMIS)*/
        $(document).ready(function(){
            document.getElementById("pie_emis").setAttribute('style', 'display: block');
            $.ajax({

                url: "http://13.90.144.116:8090/emis.php", //mudar
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("bar_emis").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    // console.log(result.ac_man);
                    // console.log(result.ac_all);
                    //var total = result.ac_all - result.ac_man;
                    var pie_ac = new Chart(document.getElementById("pie_emis"), {
                        type: 'pie',
                        onAnimationProgress: drawSegmentValues,
                        data: {
                          labels: ["Fora da Performance", "Dentro da Performance", "Loja em Estado Neutro"],
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
                    //test write data into chart (% values);
                    function drawSegmentValues()
                    {
                        var total = 0;
                        for(var i=0; i<pie_ac.segments.length; i++) {
                            total+= pie_ac.segments[i].value;
                            console.log(total);
                        }
                        for(var i=0; i<pie_ac.segments.length; i++) 
                        {
                            ctx.fillStyle="white";
                            var textSize = '15px';
                            //console.log();
                            ctx.font= textSize+"px Verdana";
                            // Get needed variables
                            var value = roundToTwo((pie_ac.segments[i].value/total)*100);
                            value = value + "%";
                            var startAngle = pie_ac.segments[i].startAngle;
                            var endAngle = pie_ac.segments[i].endAngle;
                            var middleAngle = startAngle + ((endAngle - startAngle)/2);

                            // Compute text location
                            var posX = (radius/2) * Math.cos(middleAngle) + midX;
                            var posY = (radius/2) * Math.sin(middleAngle) + midY;

                            // Text offside by middle
                            var w_offset = ctx.measureText(value).width/2;
                            var h_offset = textSize/4;

                            ctx.fillText(value, posX - w_offset, posY + h_offset);
                        }
                    }
                    var radius = pie_ac.outerRadius;
                    function roundToTwo(num) {    
                        return +(Math.round(num + "e+0")  + "e-0");
                    }
                }
            })
        });