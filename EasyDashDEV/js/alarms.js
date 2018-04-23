/* ****************************************************************** 
//  ***** ***** ***** ********* Easy Dash ********* ***** ***** *****
//
//  Description: A tool to show Easy Vision data into Charts powered by
//  Chart-JS.
//
//  Author: Vinícius Negrão
//  Company: GreenYellow do Brasil.
//  Git: www.github.com/vinegrao95/EasyDash
//
/* ****************************************************************** */
/* ****************************************************************** 
//
//  JS commands and AJAX comunication with PHP server.
//
/* ****************************************************************** */
//ALARMS
$(document).ready(function(){
    $.ajax({

                url: "http://10.155.130.229:8090/alarms_list.php", //mudar
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    var result = JSON.parse(filipinho);
                    var messages="";
                    var i = 0;
                    for(var x=0; x < 40; x++){

                        messages += "<div class=\"Rtable-cell\"><h3>" + result[i]["loja"] + "</h3></div>";
                        messages += "<div class=\"Rtable-cell\"><h4>" + result[i]["mensagem"] + "</h4></div>";
                        messages += "<div class=\"Rtable-cell\"><h4>" + result[i]["inicio"] + "</h4></div>";
                        document.getElementById("alarm_nok").innerHTML = messages;
                        i++;
                    }
                }
            })
});

$(document).ready(function(){
    $.ajax({

                url: "http://10.155.130.229:8090/alarms_nrb.php", //mudar
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    var result = JSON.parse(filipinho);
                    console.log(result);
                    var data_ilu=[];
                    var data_com=[];
                    var labels=[];
                    var indice = result[0].length;
                    var check = parseInt(indice/3);
                    for (var i = indice-1; i > 0; i--) {
                       data_ilu.push(result[0][i].ALARMS_QTY_OPEN_ILU);
                       data_com.push(result[1][i].ALARMS_QTY_OPEN_COM);
                       labels.push(result[1][i].ALARMS_DATE);
                   }
                   new Chart(document.getElementById("alarms_graph"), {
                      type: 'line',
                      data: {
                        labels: labels,
                        datasets: [{ 
                            data: data_ilu,
                            label: "Iluminação em Manual",
                            borderColor: "#3300dd",
                            fill: false
                        },
                        { 
                            data: data_com,
                            label: "Lojas Sem Comunicação",
                            borderColor: "#F00",
                            fill: false
                        }],
                        
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true
                                }
                            }],
                            yAxes: [{
                              ticks : {
                                max : 100
                            },
                            display: true,
                            scaleLabel: {
                                display: false
                            }
                        }]
                    }
                }
            });
            }
        })
});
