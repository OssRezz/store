<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ReporteTipoPagosExport implements FromArray, ShouldAutoSize, WithHeadings, WithEvents, WithProperties, WithTitle, WithColumnFormatting
{
    private $forma_de_pago_total; //Declaramos la propiedad

    public function __construct(array $forma_de_pago_total)
    {
        $this->forma_de_pago_total = $forma_de_pago_total; //Asignamos el valor a la propiedad
    }

    public function array(): array
    {
        return $this->forma_de_pago_total;
    }

    public function headings(): array
    {
        return [
            ["Reporte total forma pago"],
            ["Transacción", "Credito", "Efectivo"]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {



                $event->sheet->getDelegate()->getStyle('A2:C2')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f61b55');


                $event->sheet->getDelegate()->getStyle('A1:C1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f61b55');

                $event->sheet->getStyle('A1:C1')->getFont()
                    ->setSize(14)
                    ->setBold(true)
                    ->getColor()->setRGB('FFFFFF');



                $event->sheet->getStyle('A2:C2')->getFont()
                    ->setSize(12)
                    ->setBold(true)
                    ->getColor()->setRGB('FFFFFF');

                $event->sheet->setAutoFilter('A2:C2');


                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                $event->sheet->getDelegate()->getStyle('A1:C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }

    public function title(): string
    {
        return 'Sin Limite Tienda';
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Sin Limite Tienda',
            'lastModifiedBy' => 'Developer',
            'title'          => 'Reporte',
            'description'    => 'Reporte de venta',
            'subject'        => 'Reporte',
            'keywords'       => 'Reporte,ventas',
            'category'       => 'Reporte',
            'manager'        => 'Sin Limite Tienda',
            'company'        => 'Sin Limite Tienda',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_CURRENCY_USD,
            'B' => NumberFormat::FORMAT_CURRENCY_USD,
            'C' => NumberFormat::FORMAT_CURRENCY_USD,
        ];
    }
}
