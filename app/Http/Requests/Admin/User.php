<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class User extends FormRequest
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
        $inputs['document'] = str_replace(['.', '-'], '', $this->request->all()['document']);
        if (array_key_exists('spouse_document', parent::all())) {
            $inputs['spouse_document'] = str_replace(['.', '-'], '', $this->request->all()['spouse_document']);
        }
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
            'name' => 'required|min:3|max:191',
            'nationality' => 'required|min:3|max:191',
            'genre' => 'in:masculino,feminino,outros',
            'document' => (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:users,document,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:users,document'),
            'document_secondary' => 'required|min:5|max:20',
            'document_secondary_complement' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'place_of_birth' => 'required',
            'civil_status' => 'required|in:Casado,Separado/Desquitado,Solteiro,União Estável,União Homoafetiva,Divorciado,Separado Judicialmente,Viúvo',
            'cover' => 'image',

            // Income
//            'occupation' => 'required',
//            'lessor' => 'required',
//            'lessee' => 'required',
//            'income' => 'required',
//            'company_work' => 'required',

            // Address
            'zipcode' => 'required|min:8|max:10',
            'street' => 'required',
//            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',

            // Contact
//            'cell' => 'required',

            // Access
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:users,email,' . $this->request->all()['id'] : 'required|email|unique:users,email'),
            'password' => (empty($this->request->all()['id']) ? 'required' : ''),

            // Spouse
            'type_of_communion' => 'required_if:civil_status,Casado|in:Comunhão Parcial de Bens,Comunhão Universal de Bens,Participação Final de Aquestos,Separação Convencional de Bens,Separação Total de Bens,Separação Obrigatória de Bens',
//            'spouse_name' => 'required_if:civil_status,Casado|min:3|max:191',
//            'spouse_genre' => 'required_if:civil_status,Casado|in:masculino,feminino,outros',
//            'spouse_document' => (!empty($this->request->all()['id']) ? 'required_if:civil_status,Casado|min:11|max:14|unique:users,spouse_document,' . $this->request->all()['id'] : 'required_if:civil_status,Casado|min:11|max:14|unique:users,spouse_document'),
//            'spouse_document_secondary' => 'required_if:civil_status,Casado|min:5|max:20',
//            'spouse_document_secondary_complement' => 'required_if:civil_status,Casado',
//            'spouse_date_of_birth' => 'required_if:civil_status,Casado|date_format:d/m/Y',
//            'spouse_place_of_birth' => 'required_if:civil_status,Casado',
//            'spouse_occupation' => 'required_if:civil_status,Casado',
//            'spouse_income' => 'required_if:civil_status,Casado',
//            'spouse_company_work' => 'required_if:civil_status,Casado',
        ];
    }
}
