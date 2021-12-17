<?php

/* TO IMPLEMENT */

namespace App\Http\Requests\PagSeguro\Webhooks;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreNotificationRequest extends FormRequest
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
            /* 'id'                                => 'required|string',
            'reference_id'                      => 'required|string',
            'status'                            => 'required|string',
            'created_at'                        => 'required|date',
            'paid_at'                           => 'required|date',
            'description'                       => 'required',
            'amount.currency'                   => 'required|numeric',
            'amount.summary'                    => 'required|numeric',
            'amount.summary.total'              => 'required|numeric',
            'amount.summary.paid'               => 'required|numeric',
            'amount.summary.refunded'           => 'required|numeric',
            'payment_response'                  => 'required',
            'payment_response.code'             => 'required|string',
            'payment_response.message'          => 'required|string',
            'payment_method'                    => 'required',
            'payment_method.type'               => 'required|string',
            'payment_method.installments'       => 'required|integer',
            'payment_method.capture'            => 'required|boolean',
            'payment_method.capture'            => 'required|boolean', */];
    }
}
