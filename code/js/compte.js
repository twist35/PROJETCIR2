'use strict';

ajaxRequest('GET', 'php/requete.php/fs/', (data)=>{
    for (let fs of data){
            $('.fs').append('<option value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
    }
});