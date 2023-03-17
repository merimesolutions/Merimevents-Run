$(document).on('click','#reminder',function(e){
      $.ajax({    
        type: "GET",
        url: "fetch.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#table-container").html(data); 
           
        }
    });
});