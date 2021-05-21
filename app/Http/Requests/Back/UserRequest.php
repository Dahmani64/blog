<?php
namespace App\Http\Requests\Back;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $id = basename($this->url());
        return $rules = [
            'name' => 'required|max:255|unique:users,name,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id
        ];
    }
}