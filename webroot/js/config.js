var config = {}
    $.get("../js/config.json").success(function(data){
         config = data
    });
