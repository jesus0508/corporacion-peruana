@includeWhen($pedido->estado == 1 , 'actions.pedido.acciones_sin_confirmar')
@includeWhen($pedido->estado == 2 ,'actions.pedido.acciones_confirmado')
@includeWhen($pedido->estado == 3 , 'actions.pedido.acciones_distribuido') 
@includeWhen($pedido->estado == 4 , 'actions.pedido.acciones_amortizado')
@includeWhen($pedido->estado == 5 , 'actions.pedido.acciones_pagado')   
