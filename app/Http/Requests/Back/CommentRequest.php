<?php
namespace App\Http\Requests\Back;
use Illuminate\Foundation\Http\FormRequest;
class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return ['body' => 'required|max:2000'];
    }
}