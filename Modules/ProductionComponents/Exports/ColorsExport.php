<?php

namespace Modules\ProductionComponents\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;


class ColorsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $user;
    protected $categorycolors;
    protected $Color_info;
    

    public function __construct(ColorInfoRepositoryEloquent $Color_info,ColorsCategoryRepositoryEloquent $categorycolors,
UserRepositoryEloquent $user)
    {
        $this->user = $user;
        $this->categorycolors = $categorycolors;
        $this->Color_info= $Color_info;
    }

    public function headings(): array
    {
        return [[__('Colors Report')],[__('Color ID'),__('Colors Name'),__('Colors Category'),__('Created_by')]];
    }

    public function collection()
    {
        // $FabricsExpert = $this->Fabric_info->orderBy('id','desc')->get();
        
        $ColorsExpert = $this->Color_info->join('colorscategory','colors_stages.colcategcode','colorscategory.id')
        ->join('users','colors_stages.created_by','users.id')
        ->where('colorscategory.deleted_at',null)
        ->select('colors_stages.*')->orderBy('id','desc')->get();


        $allData = [];
        foreach($ColorsExpert as $ColorExpert)
        {
            $data = [];

            $data['colorcode'] = $ColorExpert->colorcode;
            $data['colorname'] = $ColorExpert->colorname;
            $data['CategoryCol_name'] = $this->categorycolors->where('CategoryCol_code',$ColorExpert->colcategcode)->first()?$this->categorycolors->where('CategoryCol_code',$ColorExpert->colcategcode)->first()->CategoryCol_name:'';
            $data['created_by'] = $this->user->where('id',$ColorExpert->created_by)->first()?$this->user->where('id',$ColorExpert->created_by)->first()->username:'';
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
