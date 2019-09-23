<?php

namespace App\Rules;

use App\Models\Scales\Scale;
use Illuminate\Contracts\Validation\Rule;

class ScaleUniqueIpAddress implements Rule
{
    protected $id   =   0;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id   =   $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  integer  $id
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if( request()->has('is_active')) {
            $scale = Scale::query()
                ->where('id' , '!=' , $this->id)
                ->where('is_active' , 1)
                ->where('ip_address' , $value)
                ->first();
            return  $scale ? false : true;
        }
        return  true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('global.scale_ip_address_error');
    }
}
