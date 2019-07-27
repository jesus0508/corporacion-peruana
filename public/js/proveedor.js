$('#treeview-proveedores').on('click',function(event){
  $('#treeview-clientes').removeClass("active");
  $('#treeview-proveedores').addClass("active");
})


$(document).ready(function() {
    $('#tabla-proveedores').DataTable({
          "processing": true,
          "serverSide": true,
          "pagingType": "full_numbers",

          
          "ajax": {
              "url": "proveedores_data",
              "type": 'get'},

        
          "columns": [
            {data: 'id'},            
            {data: 'razon_social'},
            {data: 'ruc'},
            {data: 'representante'},
            {data: 'btn' , "bSortable": false },
            ],
              "order": [[ 0, "desc" ]],
      
        'language': {
        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
      }
    });
} );


