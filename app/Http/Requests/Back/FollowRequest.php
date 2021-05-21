<?php
namespace App\Http\Requests\Back;
use Illuminate\Foundation\Http\FormRequest;
class FollowRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return $rules = [
            'title' => 'required|max:255',
            'href' => 'required|url|max:255',
        ];
    }
}