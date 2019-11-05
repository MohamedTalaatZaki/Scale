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
