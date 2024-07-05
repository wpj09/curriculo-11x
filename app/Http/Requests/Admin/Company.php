<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Company extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * @param $keys
     * @return array
     */
    public function all($keys = null)
    {
        return $this->validateFields(parent::all());
    }

    /**
     * @param array $inputs
     * @return array
     */
    public function validateFields(array $inputs)
    {
        $inputs['document_company'] = str_replace(['.', '-', '/'], '', $this->request->all()['document_company']);
        return $inputs;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'social_name' => 'required|min:5|max:191',
            'alias_name' => 'required',
            'document_company' => (!empty($this->request->all()['id']) ? 'required|min:14|max:18|unique:companies,document_company,' . $this->request->all()['id'] : 'required|min:14|max:18|unique:companies,document_company'),
//            'document_company_secondary' => 'required',

            // Address
            'zipcode' => 'required|min:8|max:9',
            'street' => 'required',
//            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',
        ];
    }
}
