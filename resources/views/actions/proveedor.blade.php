


 <button class="btn btn-success" data-toggle="modal" data-target="#modal-agregar-planta" 
	data-id="{{$id}}"
	data-razon_social="{{$razon_social}}">

  Agregar planta
<span class="fa fa-industry"> </span>
</button>



 <button class="btn btn-info" data-toggle="modal"  data-target="#modal-show-plantas"  
 data-razon_social="{{$razon_social}}" data-id="{{$id}}">

Gestion planta

<span class="fa fa-pencil"> </span>
</button>



<button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-proveedor"
	data-id="{{$id}}"
	data-razon_social="{{$razon_social}}" 
	data-ruc="{{$ruc}}"
    data-representante="{{$representante}}" >

  
<span class="glyphicon glyphicon-edit"> </span>
</button>


<form style="display:inline" method="POST" action="{{ route('proveedores.destroy', $id) }}">
                            @csrf
                             @method('DELETE')
                              <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
</form>

@include('proveedores.edit')
@include('proveedores.addPlanta')
@include('proveedores.plantasShow')

<script >

$('#modal-edit-proveedor').on('show.bs.modal', function (event) {          
  var id = $(event.relatedTarget).data().id;
  var razon_social = $(event.relatedTarget).data().razon_social;
  var ruc = $(event.relatedTarget).data().ruc;
  var representante = $(event.relatedTarget).data().representante;
 
  
  $(event.currentTarget).find('#razon_social-edit').val(razon_social);
  $(event.currentTarget).find('#ruc-edit').val(ruc);
  $(event.currentTarget).find('#representante-edit').val(representante);
  $(event.currentTarget).find('#id-edit').val(id);

})


$('#modal-agregar-planta').on('show.bs.modal', function (event) {          
  var id = $(event.relatedTarget).data().id;
  var razon_social = $(event.relatedTarget).data().razon_social;

  $(event.currentTarget).find('#proveedor_id-add').val(id);
  $(event.currentTarget).find('#razon_social-add').val(razon_social);
})

//OBTENER DATOS DE UNA QUERY( plantas de 1 proveedor)
//$(document).ready(function(){
  $("#modal-show-plantas").on("show.bs.modal", function(event) {
            var id = $(event.relatedTarget).data().id;
              var razon_social = $(event.relatedTarget).data().razon_social;

          //$(event.currentTarget).find('#proveedor_id-add').val(id);
          $(event.currentTarget).find('#razon_social-show').val(razon_social);

    //var request = new XMLHttpRequest();
   

    $.get('plantas_data/' + id, function( data ) {
      var html = "";
      
      //console.log(data);
      
        data.forEach(function(val) {
          var keys = Object.keys(val);
         console.log(keys);
          
        if( val != null ){ 
            
            html +=  '<div class="row">';
            html +=  '  <div class="col-md-6">';
      
            html +=  '    <div class="box box-success">';
            html +=  '      <div class="box-header with-border">';
            html +=  '        <h3 class="box-title">Datos de la planta</h3>';
            html +=  '      </div>';
            html +=  '      <div class="box-body">';
            html +=  '        <input type="hidden"  name="proveedor_id">';
            html +=  '        <div class="form-group">';
            html +=  '          <label for="planta">Planta</label>';
            html +=  '          <input id="planta" type="text" class="form-control" value="'+val['planta']+
                                    '" name="planta" placeholder="Ingrese planta" required> ';
            html +=  '        </div>';
            html +=  '        <div class="form-group">';
            html +=  '          <label for="direccion_planta">direccion_planta</label>';
            html +=  '          <input id="direccion_planta" type="text" class="form-control" value="'+val['direccion_planta']+'" name="direccion_planta" placeholder="Ingrese direccion_planta" required> ';
            html +=  '        </div>';
            html +=  '      </div>';//box-body
            html +=  '    </div>';//.box
            html +=  '  </div>';//md-6

             html +=  '  <div class="col-md-6">';
      
            html +=  '    <div class="box box-success">';
            html +=  '      <div class="box-header with-border">';
            html +=  '        <h3 class="box-title">Datos secundarios</h3>';
            html +=  '      </div>';
            html +=  '      <div class="box-body">';
            html +=  '        <input type="hidden"  name="proveedor_id">';
            html +=  '        <div class="form-group">';
            html +=  '          <label for="celular_planta">celular_planta</label>';
            html +=  '          <input id="celular_planta" type="text" class="form-control" value="'+val['celular_planta']+'" name="celular_planta" placeholder="Ingrese celular de planta"> ';
            html +=  '        </div>';
            html +=  '      </div>';//box-body
            html +=  '    </div>';//.box
            html +=  '  </div>';//md-6
            html +=  '</div>';// <!-- /.row- -->

            html += '<div class="row">';
            html +=  '  <div class="col-md-12">';

            html +=   '<button type="submit" class="btn btn-sm pull-left btn-success">Guardar Cambios</button>';

            html += '<form style="display:inline" method="get" action="planta_delete/'+val['id']+'">';
            html +=  '<input type="hidden"  name="proveedor_id" value"'+val['id']+'">';
            
            html +=   '<button type="" class="btn btn-sm pull-right btn-danger">Eliminar </button>';
            html +=   '</form>';


            html += '</div>';//md-12 <!-- /.row- -->
            html += '</div>';// <!-- /.row- --> 
            html += '<p></br></p>' ;

                  } //fin if
      else{
        html = "";

        html +=   '<button type="" class="btn btn-lg  btn-success"> NO HAY PLANTAS, AGREGUE UNA !</button>';
         $(".show-plantas").html(html);
           }
            
         });

          
          $(".show-plantas").html(html);
        

    });    

  });
//});

</script>


