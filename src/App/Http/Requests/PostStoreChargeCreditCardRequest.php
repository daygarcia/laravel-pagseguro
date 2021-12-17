<?php

namespace App\Http\Requests\PagSeguro;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreChargeCreditCardRequest extends FormRequest
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
        return [
            'reference_id'                      => 'required|string',
            'description'                       => 'required|string',
            'amount'                            => 'required',
            'amount.value'                      => 'required|string',
            'amount.currency'                   => 'required|string',
            'payment_method'                    => 'required|string',
            'payment_method.type'               => 'required|string',
            'payment_method.installments'       => 'required|string',
            'payment_method.capture'            => 'required|string',
            'payment_method.soft_descriptor'    => 'required|string',
            'payment_method.card'               => 'required',
            'payment_method.card.number'        => 'required|string',
            'payment_method.card.exp_month'     => 'required|string',
            'payment_method.card.exp_year'      => 'required|string',
            'payment_method.card.security_code' => 'required|string',
            'payment_method.card.holder'        => 'required|string',
            'payment_method.card.holder.name'   => 'required|string',
            'notification_urls'                 => 'required|url',
            'metadata'                          => 'required',
            'metadata.exemplo'                  => 'required|string',
            'metadata.notaFiscal'               => 'required|string',
            'metadata.idComprador'              => 'required|string',
        ];
    }
}
