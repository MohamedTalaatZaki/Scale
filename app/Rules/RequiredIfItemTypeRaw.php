<?php

namespace App\Rules;

use App\Models\Items\ItemType;
use Illuminate\Contracts\Validation\Rule;

class RequiredIfItemTypeRaw implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $itemType   =   ItemType::query()->find(request()->get('item_type_id'));

        return optional($itemType)->prefix == 'raw' ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('global.required');
    }
}
