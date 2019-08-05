@includeWhen($this->isConfirmed(), 'pedido_clientes.partials.acciones_confirmado')
@includeWhen(!$this->isConfirmed(), 'pedido_clientes.partials.acciones_sin_confirmar')
