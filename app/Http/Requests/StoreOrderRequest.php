<?php

namespace App\Http\Requests;

use App\Models\Bond;
use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $bond = Bond::find($this->route('id'));
        $start = $bond->issue_date;
        $end = $bond->turnover_date;
        return [
            'order_date' => 'required|date|before:'.$end.'|after:'.$start,
            'bonds_purchased' => 'required|integer|min:1',
        ];
    }
}
