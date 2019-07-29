$('#treeview-transportistas').on('click',function(event){
  $('#treeview-clientes').removeClass("active");
  $('#treeview-pagos').removeClass("active");
  $('#treeview-ventas').removeClass("active");
  $('#treeview-reportes').removeClass("active");
  $('#treeview-transportistas').addClass("active");
})