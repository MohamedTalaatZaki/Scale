<?php

namespace App\Rules;

use App\Models\Items\ItemType;
use Illuminate\Contracts\Validation\Rule;

class RequiredIfItemTypeRaw implements Rule
{
    protected $attribute;
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
        $this->attribute    =   $attribute;
        $idNotRaw   =   ItemType::query()->where('prefix' , '!=' , 'raw')->where('id' , request()->get('item_type_id'))->exists();
        return isItemTypeRaw(request()->get('item_type_id')) || $idNotRaw;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans("global.{$this->attribute}")." ".trans('global.required');
    }
}
