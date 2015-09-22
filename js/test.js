/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    $('#hw').on('click', function () {
        $.ajax({
            url: "http://192.168.1.34/parse.php?page=bills",
            type: "POST",
            data: "getStatsBills=true",
            dataType: 'json', // JSON
            success: function (data) { // tout est ok, check précédemment
                
                $.each(data, function(key, value){
                    $('#hw2').append('<tr class="success"><td>'+value.id+'</td><td>'+value.numFac+'</td><td>'+value.date+'</td><td>'+value.tva+'</td></tr>');
                    //$('#hw2').append(' Année => '+ value.annee+" Somme => "+ value.factures);
                });
            },
            error: function(e){
                alert('Fail '+e);
            }
        });
    });


});