/* ****************************************************************** 
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
//ALARMS
$(document).ready(function(){
    $.ajax({

                url: "http://127.0.0.1:8001/alarms_list.php", //mudar
                type: "GET",
                success: function (filipinho){
                    //Sucesso no AJAX
                    var result = JSON.parse(filipinho);
                    var messages="";
                    var i = 0;
                    for(var x=0; x < result.length; x++){
          
                        messages += "<tr><td class=\"loja_table\">" + result[i]["loja"] + "</td>";
                        messages += "<td class=\"mensagem_table\">" + result[i]["mensagem"] + "</td>";
                        messages += "<td class=\"inicio_table\">" + result[i]["inicio"] + "</td></tr>";
                        document.getElementById("alarm_nok").innerHTML = messages;
                        i++;
                    }
                }
            })
});