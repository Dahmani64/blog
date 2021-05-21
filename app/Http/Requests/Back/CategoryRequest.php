<?php
namespace App\Http\Requests\Back;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;
class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $id = $this->method() === 'PUT' ? ',' . basename($this->url()) : '';
        return $rules = [
            'title' => 'required|max:255',
            'slug' => ['required', 'max:255', new Slug, 'unique:posts,slug' . $id],
        ];
    }
}