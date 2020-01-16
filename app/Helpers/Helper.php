<?php

if ( ! function_exists('isItemTypeRaw')) {
    function isItemTypeRaw($id) {
        return  \App\Models\Items\ItemType::query()
            ->where('prefix' , 'raw')
            ->where('id' , $id)
            ->exists();
    }
}
if ( ! function_exists('editQcDetailsRow')) {
    function qcRowElement($row)
    {
        if(key_exists('element' , $row)) {
            $element    =   $row['element'];
        } else {

            $element    =   \App\Models\QC\QcElement::query()->find($row['qc_element_id'])->toArray();

        }
        return $element;
    }
}
if ( ! function_exists('nextRowOrder')) {
    function nextRowOrder() {
        $itemType   =   \App\Models\Items\ItemType::query()->find(request()->input('item_type_id'));
        if(! $itemType || $itemType->prefix == 'raw') {
            return null;
        } elseif ($itemType->prefix == 'scrap') {
            $order      =   \App\Models\Security\Transports::query()->scrapOrder('DESC')->select('order')->first();
            $nextOrder  =   $order ? $order->order + 1 : 1;
            return $nextOrder;
        } elseif( $itemType->prefix == 'finish' ) {
            $order      =   \App\Models\Security\Transports::query()->finishOrder('DESC')->select('order')->first();
            $nextOrder  =   $order ? $order->order + 1 : 1;
            return $nextOrder;
        } else {
            return null;
        }
    }
}

if( !function_exists("check_app_for_brake_key")) {
    function check_app_for_brake_key()
    {
        $key = base64_decode(env('LICENSE_KEY'));
        return $key == 'SanaSoftWareLicenceSuccess2020@#$';
    }

}
