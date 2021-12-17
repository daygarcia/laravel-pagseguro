<?php

namespace App\Http\Requests\PagSeguro;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreChargeRequest extends FormRequest
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
        $general_rules = array(
            'reference_id'                      => 'required|string',
            'description'                       => 'required|string',
            'amount'                            => 'required',
            'amount.value'                      => 'required|numeric',
            'amount.currency'                   => 'required|string',
            'payment_method'                    => 'required',
            'payment_method.type'               => 'required|string',
            'notification_urls.*'               => 'required|url',
            'metadata'                          => 'required',
            'metadata.Exemplo'                  => 'required|string',
            'metadata.NotaFiscal'               => 'required|string',
            'metadata.idComprador'              => 'required|string',
        );
        $payment_method_rules = array(
            'CREDIT_CARD' => [
                'payment_method.installments'       => 'required|integer',
                'payment_method.capture'            => 'required|boolean',
                'payment_method.soft_descriptor'    => 'required|string',
                'payment_method.card'               => 'required',
                'payment_method.card.number'        => 'required|string',
                'payment_method.card.exp_month'     => 'required|string',
                'payment_method.card.exp_year'      => 'required|string',
                'payment_method.card.security_code' => 'required|string',
                'payment_method.card.holder.*'      => 'required|string',
                'payment_method.card.holder.name'   => 'required|string',
            ],
            'BOLETO' => [
                'payment_method.boleto'                     => 'required',
                'payment_method.boleto.due_date'            => 'required|date',
                'payment_method.boleto.instruction_lines'   => 'required',
                'payment_method.boleto.instruction_lines.line_1'   => 'required|string',
                'payment_method.boleto.instruction_lines.line_2'   => 'required|string',

                'payment_method.boleto.holder'                      => 'required',
                'payment_method.boleto.holder.name'                 => 'required|string',
                'payment_method.boleto.holder.tax_id'               => 'required|string',
                'payment_method.boleto.holder.email'                => 'required|email',
                'payment_method.boleto.holder.address'              => 'required',
                'payment_method.boleto.holder.address.country'      => 'required|string',
                'payment_method.boleto.holder.address.region_code'  => 'required|string',
                'payment_method.boleto.holder.address.region'       => 'required|string',
                'payment_method.boleto.holder.address.city'         => 'required|string',
                'payment_method.boleto.holder.address.postal_code'  => 'required|string',
                'payment_method.boleto.holder.address.street'       => 'required|string',
                'payment_method.boleto.holder.address.country'      => 'required|string',
                'payment_method.boleto.holder.address.number'       => 'required|string',
                'payment_method.boleto.holder.address.locality'     => 'required|string',
            ]
        );

        return array_merge($general_rules, $payment_method_rules[$this->input('payment_method.type')]);
    }
}
