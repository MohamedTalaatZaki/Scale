<?php

if ( ! function_exists('isItemTypeRaw')) {
    function isItemTypeRaw($id) {
        return  \App\Models\Items\ItemType::query()
            ->where('prefix' , 'raw')
            ->where('id' , $id)
            ->exists();
    }
}
