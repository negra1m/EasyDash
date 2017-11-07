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
Date.prototype.getWeekNumber = function(){
                      var d = new Date(Date.UTC(this.getFullYear(), this.getMonth(), this.getDate()));
                      var dayNum = d.getUTCDay() || 7;
                      d.setUTCDate(d.getUTCDate() + 4 - dayNum);
                      var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
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
					var today = dd+'/'+mm+'/'+yyyy;
/*BAR CHART PARA LOJAS COM STATUS EM MANUAL*/
$(document).ready(function(){
    document.getElementById("bar_waiting").setAttribute('style', 'display: block');
    $.ajax({

                url: "http://10.155.131.16:8090",
                type: "GET",
                success: function (filipinho){
                  console.log(filipinho);
                  console.log(today);
                  var atual_semana = new Date().getWeekNumber();
                  var semana_1 = atual_semana-1;
                  var semana_2 = atual_semana-2;
                  var semana_3 = atual_semana-3;

                  //var label = "Visualização Instantânea de: "+today;
                    //Sucesso no AJAX
                    document.getElementById("bar_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    console.log(result);
                    var barChartData = {
                    //label vem do BD

                    labels: [ "Semana: "+semana_3, "Semana: "+semana_2, "Semana: "+semana_1, "Semana Atual "],
                    //["Semana 42", "Semana 43", "Semana 44", "Semana 45", "Semana 46", "Semana 47", "Semana 48"],
                    datasets: [{
                        label: 'Iluminação',
                        //backgroundColor: #fff,
                        //borderColor: red,
                        borderWidth: 1,
                        data: [result.il_man_3, result.il_man_2, result.il_man_1, result.il_man_atual],
                        backgroundColor: 'rgba(0, 200, 200, 0.8)'
                    }, {
                        label: 'Ar condicionado',
                        //backgroundColor: #fff,
                        //borderColor: blue,
                        borderWidth: 1,
                        data: [result.ac_man_3, result.ac_man_2, result.ac_man_1, result.ac_man_atual],
                        backgroundColor: 'rgba(0, 200, 0, 0.8)'
                    }, {
                        label: 'Frio Alimentar',
                        //backgroundColor: #fff,
                        //borderColor: blue,
                        borderWidth: 1,
                        data: [result.fa_man_3, result.fa_man_2, result.fa_man_1, result.fa_man_atual],
                        backgroundColor: 'rgba(255, 125, 0, 0.8)'
                    }]
                    //color: ['green', 'red']
                }
                    var ctx = document.getElementById("bar").getContext("2d");
                    window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: barChartData,
                        backgroundColor: ['green', 'red'],
                        borderColor: ['green', 'red'],
                        options: {
                            responsive: false,
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: true,
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

                url: "http://10.155.131.16:8090/pie.php",
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("pie_ilu_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    console.log(result.il_man);
                    console.log(result.il_all);
                    var total = result.il_all - result.il_man;
                    new Chart(document.getElementById("doughnut_il"), {
                        type: 'pie',
                        data: {
                          labels: ["Manual", "Automático"],
                          datasets: [
                            {
                              label: "Lojas",
                              backgroundColor: ["rgba(44, 203, 247, 0.8)", "rgba(34, 229, 112, 0.8)"],
                              data: [result.il_man, total]
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: 'Status Iluminação em: '+today
                          },
                          responsive: false
                        }
                    });
                }
            })
});

/*PIE CHART DE FRIO ALIMENTAR*/
$(document).ready(function(){
    document.getElementById("pie_fa_waiting").setAttribute('style', 'display: block');
    $.ajax({

                url: "http://10.155.131.16:8090/pie.php",
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("pie_fa_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    console.log(result.ac_man);
                    console.log(result.ac_all);
                    var total = result.fa_all - result.fa_man;
                    new Chart(document.getElementById("doughnut_fa"), {
                        type: 'pie',
                        data: {
                          labels: ["Manual", "Automático"],
                          datasets: [
                            {
                              label: "Lojas",
                              backgroundColor: ["rgba(44, 203, 247, 0.8)", "rgba(34, 229, 112, 0.8)"],
                              data: [result.fa_man, total]
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: 'Status Frio Alimentar em: '+today
                          },
                          responsive: false
                        }
                    });
                }
            })
});
/*PIE CHART DE AC*/
$(document).ready(function(){
    document.getElementById("pie_ac_waiting").setAttribute('style', 'display: block');
    $.ajax({

                url: "http://10.155.131.16:8090/pie.php",
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    document.getElementById("pie_ac_waiting").setAttribute('style', 'display: none');
                    var result = JSON.parse(filipinho);
                    console.log(result.ac_man);
                    console.log(result.ac_all);
                    var total = result.ac_all - result.ac_man;
                    new Chart(document.getElementById("doughnut_ac"), {
                        type: 'pie',
                        data: {
                          labels: ["Manual", "Automático"],
                          datasets: [
                            {
                              label: "Lojas",
                              backgroundColor: ["rgba(44, 203, 247, 0.8)", "rgba(34, 229, 112, 0.8)"],
                              data: [result.ac_man, total]
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: 'Status Ar condicionado em: '+today
                          },
                          responsive: false
                        }
                    });
                }
            })
});