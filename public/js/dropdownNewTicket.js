
 $(function(){

    $('#clients').on('change', function(event)
    {


        $.get("/JuanitaHieleraWeb/public/admin/clients/vehicles/"+event.target.value+"",function(data)
        {

                let html_select='  <option value="">Seleccionar Vehiculo </option>';
                for (let i=0; i<data.length ; ++i){
                    html_select += '  <option value="'+data[i].id +'">'+ data[i].patent +'</option>';
                    $('#vehicles').html(html_select);
                }


        });


    });

 $('#vehicles').on('change', function(event){

     let vehiculo= document.getElementById("vehicles");


     $.get("/JuanitaHieleraWeb/public/admin/NoSePorqueSiLeAgregoEstoAnda/vehicles/"+event.target.value +"", function(data)
    {
                console.log(data);
                let tarita=document.getElementById("tara");
                 tarita.value=data[0].tara;
    });

    });


  });
