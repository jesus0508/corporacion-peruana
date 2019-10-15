<div class="row">
	<div class="col-xs-11">
		<H3>SELECCIONE LOS FLETES QUE DESEA PAGAR:
			 <button type="submit" href="{{route('faltante.store')}}"
      class="btn btn-primary btn-lg pull-right" > <span class="fa  fa-arrow-right"></span> &nbsp;Continuar </button>	
			<input type="hidden" value={{$id_transportista}} name="id_transportista">
		</H3>
		
	</div>
</div>
<div class="row">
	<div class="col-md-1">	
	</div>
	<div class="col-md-2">
			<button type="submit" class="btn bg-maroon" id="calcMontoFlete" > <span class="fa  fa-magic"></span> Calcular Monto</button>		
	</div>
	<div class="col-md-3">
		<div class="form-group">
				<label for="">Monto a Pagar</label>
				<input type="text" class="form-control" id="montoFlete" readonly="true">				
		</div>
	</div>
</div>
