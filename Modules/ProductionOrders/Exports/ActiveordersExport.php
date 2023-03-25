<?php

namespace Modules\ProductionOrders\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;


use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;

class ActiveordersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $user;
    protected $movements_info;
    public $customer_info;
    public $Fabric_info;
    public $Color_info;

    public function __construct(StoreRepositoryEloquent $movements_info,
UserRepositoryEloquent $user,CustomerInfoRepositoryEloquent $customer_info,ColorInfoRepositoryEloquent $Color_info,
FabricInfoRepositoryEloquent $Fabric_info)
    {
        $this->user = $user;
        $this->movements_info = $movements_info;
        $this->customer_info = $customer_info;
        $this->Fabric_info = $Fabric_info;
        $this->Color_info = $Color_info;

    }

    public function headings(): array
    {
        return [[__('Libra Store')],[__('Production Order'),__('Number Voucher'),__('Customer Name'),__('Colors Name'),
        __('Fabrics Name'),__('Fabrics Pieces'),__('Fashion Count'),__('Location'),__('Created_at')]];
        
    }

    public function collection()
    {
        
        $movementsExpert = $this->movements_info
        ->join('customers','stores.customer_id','customers.customers_code')
        ->join('fabric','stores.fabrics_code','fabric.fabric_code')
        ->join('colors_stages','stores.colors_code','colors_stages.colorcode')
        ->select('stores.*')->distinct()->orderBy('id','desc')->get();


        $allData = [];
        foreach($movementsExpert as $moveExpert)
        {
            $data = [];
            $data['Production Order'] = $moveExpert->production_order;
            $data['Number Voucher'] = $moveExpert->number_voucher;
            $data['Customer Name'] = $this->customer_info->where('customers_code',$moveExpert->customer_id)->first()?$this->customer_info->where('customers_code',$moveExpert->customer_id)->first()->customers_name:'';
            $data['Colors Name'] = $this->Color_info->where('colorcode',$moveExpert->colors_code)->first()?$this->Color_info->where('colorcode',$moveExpert->colors_code)->first()->colorname:'';
            $data['Fabrics Name'] = $this->Fabric_info->where('fabric_code',$moveExpert->fabrics_code)->first()?$this->Fabric_info->where('fabric_code',$moveExpert->fabrics_code)->first()->fabricName:'';
            $data['Fabrics Pieces'] = $moveExpert->total;
            $data['Fashion Count'] = $moveExpert->totalfashion;
            $data['Stage Type'] = $moveExpert->location;
            $data['Created_at'] = $moveExpert->created_at;
            array_push($allData,$data);
        }

        return collect($allData);
    }


    public function registerEvents(): array
    {
        return [
// set sheet dirction from LeftToRight
            BeforeSheet::class  =>function(BeforeSheet $event){
                $event->getDelegate()->setRightToLeft(true);
            },
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:J1'; // set header font size/ font Bold/ MergeCells
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(16);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->mergeCells('A1:J1');

                $cellRange2 = 'A2:J2'; // set All headers column font size/ font Bold / 
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setBold(true);
//  After fill data from DB Add new row / merge cells / set font Type Bold / get username/ get expert time
                $event->sheet->getDelegate()->mergeCells("A".($event->sheet->getHighestRow()+1).":J".($event->sheet->getHighestRow()+1));
                $event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()), __('Username')." : ".auth()->user()->username." ".__('PrintTime').": ".Now());
                $event->sheet->getDelegate()->getStyle('A'. ($event->sheet->getHighestRow()))->getFont()->setBold(true);

// set Borders Around Cell Contain Data /  set WrapText to all Cells
                $cellRange3      = 'A1:J' . ($event->sheet->getHighestRow());
                $event->sheet->getDelegate()->getStyle($cellRange3)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ])->getAlignment()->setWrapText(true);
                // set  Alignment cells to center
                $event->sheet->getDelegate()->getStyle($cellRange3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRange3)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            },
        ];

                    
    }

    public function array2csv($data, $delimiter = ',', $enclosure = '"', $escape_char = "\\")
    {
        $f = fopen('php://memory', 'r+');
        foreach ($data as $item) {
            fputcsv($f, $item, $delimiter, $enclosure, $escape_char);
        }
        rewind($f);
        return stream_get_contents($f);
    }

}
