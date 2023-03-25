<?php

namespace Modules\ProductionComponents\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;


class FabricsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $user;
    protected $categoryfabrics;
    protected $Fabric_info;
    

    public function __construct(FabricInfoRepositoryEloquent $Fabric_info,FabricsCategoryRepositoryEloquent $categoryfabrics,
UserRepositoryEloquent $user)
    {
        $this->user = $user;
        $this->categoryfabrics = $categoryfabrics;
        $this->Fabric_info= $Fabric_info;
    }

    public function headings(): array
    {
        return [[__('Fabrics Report')],[__('Fabrics ID'),__('Fabrics Name'),__('Fabrics Category'),__('Created_by')]];
    }

    public function collection()
    {
        // $FabricsExpert = $this->Fabric_info->orderBy('id','desc')->get();
        
        $FabricsExpert = $this->Fabric_info->join('fabric_category','fabric.categoryFabric','fabric_category.id')
        ->join('users','fabric.created_by','users.id')
        ->where('fabric_category.deleted_at',null)
        ->select('fabric.*')->orderBy('id','desc')->get();


        $allData = [];
        foreach($FabricsExpert as $FabricExpert)
        {
            $data = [];

            $data['fabric_code'] = $FabricExpert->fabric_code;
            $data['fabricName'] = $FabricExpert->fabricName;
            $data['Categoryfab_name'] = $this->categoryfabrics->where('Categoryfab_code',$FabricExpert->categoryFabric)->first()?$this->categoryfabrics->where('Categoryfab_code',$FabricExpert->categoryFabric)->first()->Categoryfab_name:'';
            $data['created_by'] = $this->user->where('id',$FabricExpert->created_by)->first()?$this->user->where('id',$FabricExpert->created_by)->first()->username:'';
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
                $cellRange = 'A1:D1'; // set header font size/ font Bold/ MergeCells
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(16);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->mergeCells('A1:D1');

                $cellRange2 = 'A2:D2'; // set All headers column font size/ font Bold / 
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange2)->getFont()->setBold(true);
//  After fill data from DB Add new row / merge cells / set font Type Bold / get username/ get expert time
                $event->sheet->getDelegate()->mergeCells("A".($event->sheet->getHighestRow()+1).":D".($event->sheet->getHighestRow()+1));
                $event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()), __('Username')." : ".auth()->user()->username." ".__('PrintTime').": ".Now());
                $event->sheet->getDelegate()->getStyle('A'. ($event->sheet->getHighestRow()))->getFont()->setBold(true);

// set Borders Around Cell Contain Data /  set WrapText to all Cells
                $cellRange3      = 'A1:D' . ($event->sheet->getHighestRow());
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
