<div class="row">
	<div class="col-xs-11">
		<H3>SELECCIONE LOS FLETES QUE DESEA PAGAR:
			 <button type="submit" href="{{route('faltante.store')}}"
      class="btn btn-danger btn-lg pull-right" > PAGAR</button>	
			<input type="hidden" value={{$id_transportista}} name="id_transportista">
		</H3>
		
	</div>
</div>
<div class="row">
	<div class="col-md-6">
			<button type="submit" id="calcMontoFlete" > Calcular Monto de Seleccionados</button>
			<input type="text" id="montoFlete" readonly="true">
	</div>
</div>
