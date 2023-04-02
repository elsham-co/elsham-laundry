<?php

namespace Modules\ProductionOrders\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\ProductionComponents\Entities\Color;
use Modules\ProductionOrders\Entities\Store;
use Modules\OtherTable\Entities\OtherTable;

class libraTransactionExport implements FromView
{
    use Exportable;

    protected $date_from; 
    protected $date_to;
    protected $customer_type; 
    protected $fabric; 
    protected $colors; 
    protected $stage1; 

    function __construct($date_from,$date_to,$customer_type,$fabric,$colors,$stage1) {
            $this->date_from = $date_from;
            $this->date_to = $date_to;
            $this->customer_type = $customer_type;
            $this->fabric = $fabric;
            $this->colors = $colors;
            $this->stage1 = $stage1;
    }
    
    public function view(): View
    {       
        $storeQuery = Store::query()->join('colors_stages','stores.colors_code','colors_stages.colorcode');
        if (!empty($this->date_from) && !empty($this->date_to)) 
        {
            $dateFrom = strtotime($this->date_from);
            $dateTo = strtotime($this->date_to);
            $from = date('Y-m-d', $dateFrom);
            $to = date('Y-m-d', $dateTo);
            $storeQuery->whereBetween('stores.created_at', [$from, $to]);
        }

        if ($this->customer_type) {
            $storeQuery->where('customer_id', $this->customer_type);
        }

        if ($this->fabric) {
            $storeQuery->where('fabrics_code', $this->fabric);
        }
        
        if ($this->colors) {
            $storeQuery->where('colcategcode', $this->colors);
        }

        if ($this->stage1) {
            $storeQuery->where('stage1', $this->stage1);
        }

        $storeData = $storeQuery->get();



        return view('productionorders::pro_follow_up.export_activeorders_table', [
            'Store' => $storeData,
        ]);

        
    }
}
