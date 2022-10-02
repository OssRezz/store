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


class FacturaCompraExport implements FromArray, ShouldAutoSize, WithHeadings, WithEvents, WithProperties, WithTitle, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $compra; //Declaramos la propiedad

    public function __construct(array $compra)
    {
        $this->compra = $compra; //Asignamos el valor a la propiedad
    }

    public function array(): array
    {
        return $this->compra;
    }

    public function headings(): array
    {
        return [
            ["Reporte compras"],
            ["Comprador", "Factura", "Fecha", "Producto", "Codigo", "Cantidad", "Valor", "Valor total compra", "Observaciones"]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {



                $event->sheet->getDelegate()->getStyle('A2:I2')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f61b55');


                $event->sheet->getDelegate()->getStyle('A1:I1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f61b55');

                $event->sheet->getStyle('A1:I1')->getFont()
                    ->setSize(14)
                    ->setBold(true)
                    ->getColor()->setRGB('FFFFFF');



                $event->sheet->getStyle('A2:I2')->getFont()
                    ->setSize(12)
                    ->setBold(true)
                    ->getColor()->setRGB('FFFFFF');

                $event->sheet->setAutoFilter('A2:I2');


                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                $event->sheet->getDelegate()->getStyle('A1:I1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
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
            'description'    => 'Reporte de compra',
            'subject'        => 'Reporte',
            'keywords'       => 'Reporte,compras',
            'category'       => 'Reporte',
            'manager'        => 'Sin Limite Tienda',
            'company'        => 'Sin Limite Tienda',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_CURRENCY_USD,
            'H' => NumberFormat::FORMAT_CURRENCY_USD,
        ];
    }
}
