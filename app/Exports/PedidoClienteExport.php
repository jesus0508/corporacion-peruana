<?php

namespace CorporacionPeru\Exports;

use CorporacionPeru\PedidoCliente;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PedidoClienteExport implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        //
        return PedidoCliente::query();
    }

    public function title(): string
    {
        return 'Reporte de Pedidos de Clientes';
    }

    /**
     * @var PedidoCliente $pedido_cliente
     */
    public function map($pedido_cliente): array
    {
        return [
            $pedido_cliente->created_at,
            $pedido_cliente->cliente->razon_social,
            $pedido_cliente->cliente->ruc,
            $pedido_cliente->galones,
            $pedido_cliente->precio_galon,
            $pedido_cliente->fecha_descarga,
            $pedido_cliente->horario_descarga,
            $pedido_cliente->saldo,
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha de Registro',
            'Razon Social',
            'RUC',
            'Numero de galones',
            'Precio por galon',
            'Fecha de descarga',
            'Horario de descarga',
            'Saldo',
        ];
    }
}
