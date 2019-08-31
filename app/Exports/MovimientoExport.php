<?php

namespace CorporacionPeru\Exports;

use CorporacionPeru\Movimiento;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MovimientoExport implements FromQuery, WithHeadings, WithMapping, WithTitle
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        //
        return Movimiento::query();
    }

    public function title(): string
    {
        return 'Reporte de Movimientos';
    }

    /**
     * @var Movimiento $movimiento
     */
    public function map($movimiento): array
    {
        return [
            $movimiento->fecha_operacion,
            $movimiento->codigo_operacion,
            $movimiento->monto_operacion,
            $movimiento->banco,
            $movimiento->getEstado(),
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha de operacion',
            'Codigo de operacion',
            'Monto de operacion',
            'Banco',
            'Estado',
        ];
    }
}
