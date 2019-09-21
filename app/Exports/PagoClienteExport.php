<?php

namespace CorporacionPeru\Exports;

use CorporacionPeru\PagoCliente;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagoClienteExport implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    use Exportable;

    protected $pagos;
 
    public function __construct($pagos = null)
    {
        $this->pagos = $pagos;
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        //
        return $this->products ?:PagoCliente::query();
    }

    public function title(): string
    {
        return 'Reporte de Pagos de Clientes';
    }

    /**
     * @var PagoCliente $pago_cliente
     */
    public function map($pago_cliente): array
    {
        return [
            $pago_cliente->fecha_operacion,
            $pago_cliente->codigo_operacion,
            $pago_cliente->monto_operacion,
            $pago_cliente->saldo,
            $pago_cliente->banco,
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha de operacion',
            'Codigo de operacion',
            'Monto de operacion',
            'Saldo',
            'Banco',
        ];
    }
}
