<?php
namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;
class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'message' => 'required|max:1000',
        ];
    }
}