<?php

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRequest extends FormRequest {
    public function rules() {
        return [
            'symbol' => 'required|string|max:3',
            'display' => 'required|in:symbol,name',
            'exchangeRate' => 'required|numeric|min:0',
            'isdefault' => 'sometimes|boolean'
        ];
    }
}