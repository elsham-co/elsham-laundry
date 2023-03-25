<?php

namespace Modules\Core\Services;

use Modules\Products\Repositories\ProductOptionRepositoryEloquent;
use Modules\Products\Repositories\StockRepositoryEloquent;

class StockService
{
    private $stock;
    private $productOption;

    public function __construct(StockRepositoryEloquent $stock, ProductOptionRepositoryEloquent $productOption)
    {
        $this->stock = $stock;
        $this->productOption = $productOption;
    }

    public function stock($data, $product, $sign, $type = null)
    {

        $options = $this->productOption->where('product_id', $product->id)->pluck('qty', 'option_id');
        $oldStock = $this->stock->where('product_id', $product->id)->first();


        if ((isset($data['size']) && !isset($data['color'])) || ($data['color'] == null && isset($data['qty_per_seri']) && $data['qty_per_seri'] != null)) {

            $sizeData = $this->sizeStock($data, $product, $sign, $type,$options,$oldStock);
            $stockType = $sizeData['type'] ;
            $totalStock =  $sizeData['total_stock'] ;
            $totalStockDetails =  $sizeData['total_stock_details'] ;
            $reservedStock = $sizeData['reserved_stock'] ;
            $reservedStockDetails = $sizeData['reserved_stock_details'] ;
            $remainStock = $sizeData['remain_stock'] ;
            $remainStockDetails = $sizeData['remain_stock_details'] ;
            $totalStandardSeri = $sizeData['total_standard_seri'] ;
            $totalStandardSeriDetails = $sizeData['total_standard_seri_details'] ;
            $reservedStandardSeri = $sizeData['reserved_standard_seri'] ;
            $reservedStandardSeriDetails = $sizeData['reserved_standard_seri_details'] ;
            $remainStandardSeri = $sizeData['remain_standard_seri'] ;
            $remainStandardSeriDetails = $sizeData['remain_standard_seri_details'] ;
            $totalBrokenPieces = $sizeData['total_broken_pieces'] ;
            $totalBrokenPiecesDetails = $sizeData['total_broken_pieces_details'] ;
            $reservedBrokenPieces = $sizeData['reserved_broken_pieces'] ;
            $reservedBrokenPiecesDetails =  $sizeData['reserved_broken_pieces_details'] ;
            $remainBrokenPieces= $sizeData['remain_broken_pieces'] ;
            $remainBrokenPiecesDetails = $sizeData['remain_broken_pieces_details'] ;
        }

        if (isset($data['color'])) {
            $colorData = $this->colorStock($data, $product, $sign, $type,$options,$oldStock);
            $stockType = $colorData['type'] ;
            $totalStock =  $colorData['total_stock'] ;
            $totalStockDetails =  $colorData['total_stock_details'] ;
            $reservedStock = $colorData['reserved_stock'] ;
            $reservedStockDetails = $colorData['reserved_stock_details'] ;
            $remainStock = $colorData['remain_stock'] ;
            $remainStockDetails = $colorData['remain_stock_details'] ;
            $totalStandardSeri = $colorData['total_standard_seri'] ;
            $totalStandardSeriDetails = $colorData['total_standard_seri_details'] ;
            $reservedStandardSeri = $colorData['reserved_standard_seri'] ;
            $reservedStandardSeriDetails = $colorData['reserved_standard_seri_details'] ;
            $remainStandardSeri = $colorData['remain_standard_seri'] ;
            $remainStandardSeriDetails = $colorData['remain_standard_seri_details'] ;
            $totalBrokenPieces = $colorData['total_broken_pieces'] ;
            $totalBrokenPiecesDetails = $colorData['total_broken_pieces_details'] ;
            $reservedBrokenPieces = $colorData['reserved_broken_pieces'] ;
            $reservedBrokenPiecesDetails =  $colorData['reserved_broken_pieces_details'] ;
            $remainBrokenPieces= $colorData['remain_broken_pieces'] ;
            $remainBrokenPiecesDetails = $colorData['remain_broken_pieces_details'] ;

        }
        if($totalStock < $remainStock || $reservedStock < 0  || $totalBrokenPieces < 0 || $remainBrokenPieces < 0 || (!empty($reservedStockDetails['data']) && min($reservedStockDetails['data']) < 0) ||
            (!empty($remainStockDetails['data']) && min($remainStockDetails['data']) < 0 ) || (!empty($totalBrokenPiecesDetails['data']) && min($totalBrokenPiecesDetails['data']) < 0) || (!empty($remainBrokenPiecesDetails['data']) && min($remainBrokenPiecesDetails['data']) < 0)){
            session()->put('error',__('Something went wrong'));
            return redirect()->back();
        }


        $this->stock->updateOrCreate(
            ['product_id' => $product->id],
            [
                'type' => $stockType,
                'total_stock' => $totalStock,
                'total_stock_details' => $totalStockDetails,
                'reserved_stock' => $reservedStock,
                'reserved_stock_details' => $reservedStockDetails,
                'remain_stock' => $remainStock,
                'remain_stock_details' => $remainStockDetails,
                'total_standard_seri' => $totalStandardSeri,
                'total_standard_seri_details' => $totalStandardSeriDetails,
                'reserved_standard_seri' => $reservedStandardSeri,
                'reserved_standard_seri_details' => $reservedStandardSeriDetails,
                'remain_standard_seri' => $remainStandardSeri,
                'remain_standard_seri_details' => $remainStandardSeriDetails,
                'total_broken_pieces' => $totalBrokenPieces,
                'total_broken_pieces_details' => $totalBrokenPiecesDetails,
                'reserved_broken_pieces' => $reservedBrokenPieces,
                'reserved_broken_pieces_details' => $reservedBrokenPiecesDetails,
                'remain_broken_pieces' => $remainBrokenPieces,
                'remain_broken_pieces_details' => $remainBrokenPiecesDetails,

            ]);
    }

    private function sizeStock($data,$product,$sign,$type,$options,$oldStock)
    {
        $totalStock = 0;
        $totalStockDetails = [];
        $reservedStock = 0;
        $reservedStockDetails = [];
        $remainStock = 0;
        $remainStockDetails = [];
        $totalStandardSeri = 0;
        $totalStandardSeriDetails = [];
        $reservedStandardSeri = 0;
        $reservedStandardSeriDetails = [];
        $remainStandardSeri = 0;
        $remainStandardSeriDetails = [];
        $totalBrokenPieces = 0;
        $totalBrokenPiecesDetails = [];
        $reservedBrokenPieces = 0;
        $reservedBrokenPiecesDetails = [];
        $remainBrokenPieces = 0;
        $remainBrokenPiecesDetails = [];
        $arr = [];
        $one = 1;
        $totalStockDetails['type'] = 'size';
        $reservedStockDetails['type'] = 'size';
        $remainStockDetails['type'] = 'size';
        $totalStandardDetails['type'] = 'size';
        $reservedStandardSeriDetails['type'] = 'size';
        $remainStandardSeriDetails['type'] = 'size';
        $totalBrokenPiecesDetails['type'] = 'size';
        $reservedBrokenPiecesDetails['type'] = 'size';
        $remainBrokenPiecesDetails['type'] = 'size';
        $totalStockDetails['data'] = [];
        $reservedStockDetails['data'] = [];
        $remainStockDetails['data'] = [];
        $totalStandardDetails['data'] = [];
        $reservedStandardSeriDetails['data'] = [];
        $remainStandardSeriDetails['data'] = [];
        $totalBrokenPiecesDetails['data'] = [];
        $reservedBrokenPiecesDetails['data'] = [];
        $remainBrokenPiecesDetails['data'] = [];
        if ($type != 'barcode') {
            foreach ($data['size'] as $key => $size) {
                if ($size['qty'] != 0) {
                    if($type != 'refund'){
                        $totalStock += $size['qty'];
                        $totalStockDetails['data']['k-' . $size['id']] = $size['qty'];
                    }else{
                        $totalStock = $oldStock->total_stock;
                        $totalStockDetails['data']['k-' . $size['id']] = $oldStock->total_stock_details['data']['k-' . $size['id']];

                    }

                    if (!isset($oldStock)) {
                        $remainStock += $size['qty'];
                        $remainStockDetails['data']['k-' . $size['id']] = $size['qty'];
                    } else {
                        if ($type == 'increase') {
                            $reservedStock = $oldStock?$oldStock->reserved_stock:0;
                            $reservedStockDetails = $oldStock?$oldStock->reserved_stock_details:'';
                        }elseif($type == 'refund'){
                            $reservedStock =  $oldStock->reserved_stock - $data['qty'] ;
                            $reservedStockDetails['data']['k-' . $size['id']] = $oldStock->reserved_stock_details['data']['k-' . $size['id']] - $size['qty'];

                        }
                        $remainStock = $totalStock - $reservedStock;
                        $remainStockDetails['data']['k-' . $size['id']] = $totalStockDetails['data']['k-' . $size['id']] - (isset($reservedStockDetails['data']) && isset($reservedStockDetails['data']['k-' . $size['id']]) ? $reservedStockDetails['data']['k-' . $size['id']] : 0);

                    }
                }
            }

        } else {

            $totalStock = $oldStock->total_stock;
            $totalStockDetails = $oldStock->total_stock_details;
            if ($data['qty_per_seri'] != null) {

                $reservedStock = $oldStock->reserved_stock + (int)($sign . $product->seri_count);
            } else {
                $reservedStock = $oldStock->reserved_stock + (int)($sign . $one);
            }

            $remainStock = $oldStock->total_stock - $reservedStock;
            foreach ($totalStockDetails['data'] as $key => $size) {
                if ($data['qty_per_seri'] != null) {

                    $reservedStockDetails['data'][$key] = (!empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key] : 0) + (int)($sign . $options[explode('k-', $key)[1]]);
                } else {
                    if (explode('k-', $key)[1] == $data['size']) {
                        $reservedStockDetails['data'][$key] = (!empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key] : 0) + (int)($sign . $one);

                    } else {
                        $reservedStockDetails['data'][$key] = !empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key] : 0;
                    }
                }

                $remainStockDetails['data'][$key] = $oldStock->total_stock_details['data'][$key] - $reservedStockDetails['data'][$key];
            }
        }

        $sizeRatio = [];
        foreach ($remainStockDetails['data'] as $key => $size) {

            $sizeOp = floor($size / $options[explode('k-', $key)[1]]);
            array_push($sizeRatio, $sizeOp);
        }
        $totalStandardSeri = min($sizeRatio);
        if (isset($data['qty_per_seri']) && $data['qty_per_seri'] != null) {
            $totalStandardSeri = $oldStock->total_standard_seri;
            $reservedStandardSeri = ($oldStock->reserved_standard_seri + (int)($sign . $one) < 0 ? 0 : $oldStock->reserved_standard_seri + (int)($sign . $one));
            $remainStandardSeri = $totalStandardSeri - $reservedStandardSeri;
        } else {
            $remainStandardSeri = min($sizeRatio);
        }
        if (isset($data['qty_per_seri']) && $data['qty_per_seri'] != null) {
            $totalBrokenPieces = $remainStock - ($remainStandardSeri * $product->seri_count);

        }else{
            $totalBrokenPieces = $remainStock - ($totalStandardSeri * $product->seri_count);

        }
        if($type == 'refund' || $type == 'increase'){
            $totalBrokenPieces = $totalStock - ($totalStandardSeri * $product->seri_count);
        }
        if (isset($data['qty_per_seri']) && $data['qty_per_seri'] != null) {

            foreach ($remainStockDetails['data'] as $key => $size) {

                $broken = $size - ($remainStandardSeri * $options[explode('k-', $key)[1]]);
                $totalBrokenPiecesDetails['data'][$key] = (int)$broken;

            }
        }else{

            foreach ($remainStockDetails['data'] as $key => $size) {

                $broken = $size - ($totalStandardSeri * $options[explode('k-', $key)[1]]);
                $totalBrokenPiecesDetails['data'][$key] = (int)$broken;

            }
        }

        if ($type == 'barcode' && $data['qty_per_seri'] == null) {

            if ($remainStandardSeri < $oldStock->remain_standard_seri) {
                $totalBrokenPieces = $totalStock - ($remainStandardSeri * $product->seri_count);
                foreach ($totalStockDetails['data'] as $key => $item) {
                    $broken = $item - ($remainStandardSeri * $options[explode('k-', $key)[1]]);
                    $totalBrokenPiecesDetails['data'][$key] = (int)$broken;
                }
            } else{
                $totalBrokenPieces = $totalStock - ($totalStandardSeri * $product->seri_count);
                foreach ($totalStockDetails['data'] as $key => $item) {
                    $broken = $item - ($totalStandardSeri * $options[explode('k-', $key)[1]]);
                    $totalBrokenPiecesDetails['data'][$key] = (int)$broken;
                }
            }
        }

        if ($type == 'barcode' && $data['qty_per_seri'] == null) {
            $reservedBrokenPieces = $oldStock->reserved_broken_pieces + (int)($sign . $one) < 0 ? 0 : $oldStock->reserved_broken_pieces + (int)($sign . $one);
            $remainBrokenPieces = $totalBrokenPieces - $reservedBrokenPieces;
            foreach ($totalBrokenPiecesDetails['data'] as $key => $value) {
                if ($key == 'k-' . $data['size']) {
                    $reservedBrokenPiecesDetails['data'][$key] = isset($oldStock->reserved_broken_pieces_details['data'][$key]) ? $oldStock->reserved_broken_pieces_details['data'][$key] + (int)($sign . $one) : 1;
                } else {
                    $reservedBrokenPiecesDetails['data'][$key] = $oldStock->reserved_broken_pieces_details['data'][$key] ?? 0;
                }
                $remainBrokenPiecesDetails['data'][$key] = $totalBrokenPiecesDetails['data'][$key] - $reservedBrokenPiecesDetails['data'][$key];
            }
        } else {
                if($type == 'refund'){
                    $reservedBrokenPieces = ($oldStock?$oldStock->reserved_broken_pieces:0) - $data['qty'];

                }elseif($type == 'increase'){
                    $reservedBrokenPieces = $oldStock?$oldStock->reserved_broken_pieces:0;
                }
            if($type == 'refund' || $type == 'increase'){
                foreach ($data['size'] as $key => $value) {
                    if($type == 'refund') {
                        $reservedBrokenPiecesDetails['data']['k-' . $value['id']] = ($oldStock && isset($oldStock->reserved_broken_pieces_details['data'])?$oldStock->reserved_broken_pieces_details['data']['k-' . $value['id']]:0) - $value['qty'];
                    }elseif($type == 'increase') {
                        $reservedBrokenPiecesDetails['data']['k-' . $value['id']] = $oldStock && isset($oldStock->reserved_broken_pieces_details['data'])?$oldStock->reserved_broken_pieces_details['data']['k-' . $value['id']]:0;

                    }
                    $remainBrokenPieces = $totalBrokenPieces - $reservedBrokenPieces;
                    $remainBrokenPiecesDetails['data']['k-'.$value['id']]= $totalBrokenPiecesDetails['data']['k-'.$value['id']] - $reservedBrokenPiecesDetails['data']['k-'.$value['id']];
                }
            }else{
                $reservedBrokenPieces = isset($oldStock) ? $oldStock->reserved_broken_pieces : 0;
                $reservedBrokenPiecesDetails = isset($oldStock) ? $oldStock->reserved_broken_pieces_details : [];
                $remainBrokenPieces = $totalBrokenPieces;
                $remainBrokenPiecesDetails = $totalBrokenPiecesDetails;
            }


        }

        $sizeData = [];
        $sizeData['type'] = 'size';
        $sizeData['total_stock'] = $totalStock;
        $sizeData['total_stock_details'] = $totalStockDetails;
        $sizeData['reserved_stock'] = $reservedStock;
        $sizeData['reserved_stock_details'] = $reservedStockDetails;
        $sizeData['remain_stock'] = $remainStock;
        $sizeData['remain_stock_details'] = $remainStockDetails;
        $sizeData['total_standard_seri'] = $totalStandardSeri;
        $sizeData['total_standard_seri_details'] = $totalStandardSeriDetails;
        $sizeData['reserved_standard_seri'] = $reservedStandardSeri;
        $sizeData['reserved_standard_seri_details'] = $reservedStandardSeriDetails;
        $sizeData['remain_standard_seri'] = $remainStandardSeri;
        $sizeData['remain_standard_seri_details'] = $remainStandardSeriDetails;
        $sizeData['total_broken_pieces'] = $totalBrokenPieces;
        $sizeData['total_broken_pieces_details'] = $totalBrokenPiecesDetails;
        $sizeData['reserved_broken_pieces'] = $reservedBrokenPieces;
        $sizeData['reserved_broken_pieces_details'] = $reservedBrokenPiecesDetails;
        $sizeData['remain_broken_pieces'] = $remainBrokenPieces;
        $sizeData['remain_broken_pieces_details'] = $remainBrokenPiecesDetails;
        return $sizeData;
    }


    private function colorStock($data,$product,$sign,$type,$options,$oldStock)
    {
        $totalStock = 0;
        $totalStockDetails = [];
        $reservedStock = 0;
        $reservedStockDetails = [];
        $remainStock = 0;
        $remainStockDetails = [];
        $totalStandardSeri = 0;
        $totalStandardSeriDetails = [];
        $reservedStandardSeri = 0;
        $reservedStandardSeriDetails = [];
        $remainStandardSeri = 0;
        $remainStandardSeriDetails = [];
        $totalBrokenPieces = 0;
        $totalBrokenPiecesDetails = [];
        $reservedBrokenPieces = 0;
        $reservedBrokenPiecesDetails = [];
        $remainBrokenPieces = 0;
        $remainBrokenPiecesDetails = [];
        $arr = [];
        $one = 1;
        $totalStockDetails['type'] = 'color';
        $reservedStockDetails['type'] = 'color';
        $remainStockDetails['type'] = 'color';
        $totalStandardDetails['type'] = 'color';
        $reservedStandardSeriDetails['type'] = 'color';
        $remainStandardSeriDetails['type'] = 'color';
        $totalBrokenPiecesDetails['type'] = 'color';
        $reservedBrokenPiecesDetails['type'] = 'color';
        $remainBrokenPiecesDetails['type'] = 'color';
        $totalStockDetails['data'] = [];
        $reservedStockDetails['data'] = [];
        $remainStockDetails['data'] = [];
        $totalStandardDetails['data'] = [];
        $reservedStandardSeriDetails['data'] = [];
        $remainStandardSeriDetails['data'] = [];
        $totalBrokenPiecesDetails['data'] = [];
        $reservedBrokenPiecesDetails['data'] = [];
        $remainBrokenPiecesDetails['data'] = [];
        if ($type != 'barcode'  && $type != 'refund' && $type != 'refundColorSize') {
            foreach ($data['color'] as $key => $color) {
                foreach ($color['size_color'] as $clrkey => $clr) {
                    if ($clr['qty'] != 0) {
                        $totalStock += $clr['qty'];
                        $totalStockDetails['data']['k-' . $color['color']]['k-' . $clr['id']] = $clr['qty'];
                        if (!isset($oldStock)) {
                            $remainStock += $clr['qty'];
                            $remainStockDetails['data']['k-' . $color['color']]['k-' . $clr['id']] = $clr['qty'];
                        } else {
                            if ($type == 'increase') {
                                $reservedStock = $oldStock?$oldStock->reserved_stock:0;
                                $reservedStockDetails = $oldStock?$oldStock->reserved_stock_details:'';
                                $remainStock = $totalStock - $reservedStock;
                                $remainStockDetails['data']['k-' . $color['color']]['k-' . $clr['id']] = $totalStockDetails['data']['k-' . $color['color']]['k-' . $clr['id']] - (isset($reservedStockDetails['data']['k-' . $color['color']]) && isset($reservedStockDetails['data']['k-' . $color['color']]['k-' . $clr['id']]) ? $reservedStockDetails['data']['k-' . $color['color']]['k-' . $clr['id']] : 0);
                            }
                        }
                    }
                }

            }
        } else {
            $totalStock = $oldStock->total_stock;
            $totalStockDetails = $oldStock->total_stock_details;
            if ($data['qty_per_seri'] != null) {
                $reservedStock = $oldStock->reserved_stock + (int)($sign . $product->seri_count);
            }
            elseif($type == 'refund'){
                $reservedStock = $oldStock->reserved_stock - ($data['qty'] * $product->seri_count);
            }
            elseif($type == 'refundColorSize'){
                $reservedStock = $oldStock->reserved_stock - $data['qty'];
            }
            else {
                $reservedStock = $oldStock->reserved_stock + (int)($sign . $one);
            }

            $remainStock = $oldStock->total_stock - $reservedStock;

            foreach ($totalStockDetails['data'] as $key => $color) {
                foreach ($color as $sizeKey => $value) {
                    if ($data['qty_per_seri'] != null) {

                        if (($key == 'k-' . $data['color'])) {

                            $reservedStockDetails['data'][$key][$sizeKey] = (!empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key][$sizeKey] : 0) + (int)($sign . $options[explode('k-', $sizeKey)[1]]);
                        }
                        else {

                            $reservedStockDetails['data'][$key][$sizeKey] = !empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key][$sizeKey] : 0;
                        }

                    }
                    elseif($type == 'refund' || $type == 'refundColorSize'){

                            if (in_array(explode('k-',$key)[1],array_keys($data['color']))) {
                                    if(isset($data['color'][explode('k-',$key)[1]]['sizes'])){
                                        $reservedStockDetails['data'][$key][$sizeKey] = (!empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key][$sizeKey] : 0) -(($data['color'][explode('k-',$key)[1]]['sizes'][explode('k-',$sizeKey)[1]] ?? 0) * $options[explode('k-', $sizeKey)[1]]);
                                    }elseif($type == 'refund'){
                                        $reservedStockDetails['data'][$key][$sizeKey] = (!empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key][$sizeKey] : 0) -($data['color'][explode('k-',$key)[1]] * $options[explode('k-', $sizeKey)[1]]);
                                    }
                            }
                            else {

                                $reservedStockDetails['data'][$key][$sizeKey] = !empty($oldStock->reserved_stock_details['data']) ? $oldStock->reserved_stock_details['data'][$key][$sizeKey] : 0;
                            }
                        } else {

                        if (($key == 'k-' . $data['color']) && ($sizeKey == 'k-' . $data['size'])) {

                            $reservedStockDetails['data'][$key][$sizeKey] = (!empty($oldStock->reserved_stock_details) && !empty($oldStock->reserved_stock_details['data'])? $oldStock->reserved_stock_details['data'][$key][$sizeKey] : 0) + (int)($sign . $one);

                        } else {
                            $reservedStockDetails['data'][$key][$sizeKey] = !empty($oldStock->reserved_stock_details) && !empty($oldStock->reserved_stock_details['data'])? $oldStock->reserved_stock_details['data'][$key][$sizeKey] : 0;
                        }
                    }

                    $remainStockDetails['data'][$key][$sizeKey] = $oldStock->total_stock_details['data'][$key][$sizeKey] - ($reservedStockDetails['data'][$key] && $reservedStockDetails['data'][$key][$sizeKey]? $reservedStockDetails['data'][$key][$sizeKey] : 0);

                }

            }

        }

        $sizeRatio = [];
        foreach ($remainStockDetails['data'] as $key => $color) {
            $colorRatio = [];
            foreach ($color as $sizeKey => $value) {
                $sizeOp = floor($value / $options[explode('k-', $sizeKey)[1]]);
                array_push($colorRatio, $sizeOp);
            }
            array_push($sizeRatio, min($colorRatio));
            $totalStandardSeriDetails['data'][$key] = min($colorRatio);
            if ((isset($data['qty_per_seri']) && $data['qty_per_seri'] != null) || $type == 'refund') {
                $totalStandardSeriDetails['data'][$key] = $oldStock->total_standard_seri_details['data'][$key];
                $remainStandardSeriDetails['data'][$key] = min($colorRatio);
                $reservedStandardSeriDetails['data'][$key] = $totalStandardSeriDetails['data'][$key] - $remainStandardSeriDetails['data'][$key];
            } else {
                $remainStandardSeriDetails['data'][$key] = min($colorRatio);
            }
        }

        $totalStandardSeri = array_sum($sizeRatio);
        $totalBrokenPieces = $remainStock - ($totalStandardSeri * $product->seri_count);
        if($type == 'increase'){
            $totalBrokenPieces = $totalStock - ($totalStandardSeri * $product->seri_count);
        }
        if ((isset($data['qty_per_seri']) && $data['qty_per_seri'] != null) || $type == 'refund') {

            $totalStandardSeri = $oldStock->total_standard_seri;
            $remainStandardSeri = array_sum($sizeRatio);
            $reservedStandardSeri = $totalStandardSeri - $remainStandardSeri;

        } else {
            $remainStandardSeri = array_sum($sizeRatio);
        }
        foreach ($remainStockDetails['data'] as $key => $color) {
            foreach ($color as $sizeKey => $item) {
                $broken = $item - ((float)$totalStandardSeriDetails['data'][$key] * $options[explode('k-', $sizeKey)[1]]);
                $totalBrokenPiecesDetails['data'][$key][$sizeKey] = (int)$broken;
                if( $type == 'increase'){
                    if($remainStockDetails['data'][$key][$sizeKey] == $totalStandardSeriDetails['data'][$key]){
                        $totalBrokenPiecesDetails['data'][$key][$sizeKey] = $totalStockDetails['data'][$key][$sizeKey] - $remainStockDetails['data'][$key][$sizeKey];
                    }
                }
            }
        }
        if ((isset($data['qty_per_seri']) && $data['qty_per_seri'] != null) || $type == 'refund') {
            $totalBrokenPieces = $oldStock->total_broken_pieces;
            $totalBrokenPiecesDetails = $oldStock->total_broken_pieces_details;
        }

        if (($type == 'barcode' && $data['qty_per_seri'] == null) || $type == 'refundColorSize') {
            if ($remainStandardSeri < $oldStock->remain_standard_seri) {
                $totalBrokenPieces = $totalStock - ($remainStandardSeri * $product->seri_count);
                foreach ($totalStockDetails['data'] as $key => $color) {
                    foreach ($color as $sizeKey => $item) {
                        $broken = $item - ($remainStandardSeriDetails['data'][$key] * $options[explode('k-', $sizeKey)[1]]);
                        $totalBrokenPiecesDetails['data'][$key][$sizeKey] = (int)$broken;
                    }

                }
            } elseif ($remainStandardSeri >= $oldStock->remain_standard_seri) {
                $totalBrokenPieces = $totalStock - ($totalStandardSeri * $product->seri_count);
                foreach ($totalStockDetails['data'] as $key => $color) {
                    foreach ($color as $sizeKey => $item) {
                        $broken = $item - ($totalStandardSeriDetails['data'][$key] * $options[explode('k-', $sizeKey)[1]]);
                        $totalBrokenPiecesDetails['data'][$key][$sizeKey] = (int)$broken;

                    }
                }
            }


        }



        if (($type == 'barcode' && $data['qty_per_seri'] == null) || $type == 'refundColorSize') {
            $reservedBrokenPieces = $oldStock->reserved_broken_pieces + (int)($sign . $one) < 0 ? 0 : $oldStock->reserved_broken_pieces + (int)($sign . $one);
            if($type == 'refundColorSize'){
                $reservedBrokenPieces = $oldStock->reserved_broken_pieces - $data['qty'];
            }
            $remainBrokenPieces = $totalBrokenPieces - $reservedBrokenPieces;

            foreach ($totalBrokenPiecesDetails['data'] as $key => $color) {
                foreach($color as $sizeKey=>$value){

                    if ( $type != 'refundColorSize' && ($key == 'k-'.$data['color']) && $sizeKey == 'k-' . $data['size']) {
                        $reservedBrokenPiecesDetails['data'][$key][$sizeKey] = isset($oldStock->reserved_broken_pieces_details['data'][$key][$sizeKey]) ? $oldStock->reserved_broken_pieces_details['data'][$key][$sizeKey] + (int)($sign . $one) : 1;
                    }
                    elseif($type == 'refundColorSize' && (in_array(explode('k-',$key)[1],array_keys($data['color']))) && (in_array(explode('k-',$sizeKey)[1],array_keys($data['color'][explode('k-',$key)[1]]['sizes'])))){
                        $reservedBrokenPiecesDetails['data'][$key][$sizeKey] = isset($oldStock->reserved_broken_pieces_details['data'][$key][$sizeKey]) ? $oldStock->reserved_broken_pieces_details['data'][$key][$sizeKey] - ($data['color'][explode('k-',$key)[1]]['sizes'][explode('k-',$sizeKey)[1]] * $options[explode('k-', $sizeKey)[1]]): 1;
                    }
                    else {
                        $reservedBrokenPiecesDetails['data'][$key][$sizeKey] = $oldStock->reserved_broken_pieces_details['data'][$key][$sizeKey] ?? 0;
                    }
                    $remainBrokenPiecesDetails['data'][$key][$sizeKey] = $totalBrokenPiecesDetails['data'][$key][$sizeKey] - $reservedBrokenPiecesDetails['data'][$key][$sizeKey];
                }

            }
        } else {

            if($type == 'increase'){
                $reservedBrokenPieces = $oldStock?$oldStock->reserved_broken_pieces:0;
                $reservedBrokenPiecesDetails = $oldStock?$oldStock->reserved_broken_pieces_details:'';
                $remainBrokenPieces = $totalBrokenPieces - $reservedBrokenPieces;
                foreach($data['color'] as $key=> $color){
                    foreach ($color['size_color'] as $clrKey=> $clr){
                        $remainBrokenPiecesDetails['data']['k-'.$color['color']]['k-'.$clr['id']] = $totalBrokenPiecesDetails['data']['k-'.$color['color']]['k-'.$clr['id']] - (!empty($reservedBrokenPiecesDetails['data'])?$reservedBrokenPiecesDetails['data']['k-'.$color['color']]['k-'.$clr['id']]:0);
                    }
                }
            }else{
                $reservedBrokenPieces = isset($oldStock) ? $oldStock->reserved_broken_pieces : 0;
                $reservedBrokenPiecesDetails = isset($oldStock) ? $oldStock->reserved_broken_pieces_details : [];
                $remainBrokenPieces = $totalBrokenPieces;
                $remainBrokenPiecesDetails = $totalBrokenPiecesDetails;
            }


        }

        $colorData = [];
        $colorData['type'] = 'color';
        $colorData['total_stock'] = $totalStock;
        $colorData['total_stock_details'] = $totalStockDetails;
        $colorData['reserved_stock'] = $reservedStock;
        $colorData['reserved_stock_details'] = $reservedStockDetails;
        $colorData['remain_stock'] = $remainStock;
        $colorData['remain_stock_details'] = $remainStockDetails;
        $colorData['total_standard_seri'] = $totalStandardSeri;
        $colorData['total_standard_seri_details'] = $totalStandardSeriDetails;
        $colorData['reserved_standard_seri'] = $reservedStandardSeri;
        $colorData['reserved_standard_seri_details'] = $reservedStandardSeriDetails;
        $colorData['remain_standard_seri'] = $remainStandardSeri;
        $colorData['remain_standard_seri_details'] = $remainStandardSeriDetails;
        $colorData['total_broken_pieces'] = $totalBrokenPieces;
        $colorData['total_broken_pieces_details'] = $totalBrokenPiecesDetails;
        $colorData['reserved_broken_pieces'] = $reservedBrokenPieces;
        $colorData['reserved_broken_pieces_details'] = $reservedBrokenPiecesDetails;
        $colorData['remain_broken_pieces'] = $remainBrokenPieces;
        $colorData['remain_broken_pieces_details'] = $remainBrokenPiecesDetails;
        return $colorData;

    }


}
