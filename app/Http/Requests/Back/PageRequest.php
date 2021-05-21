<?php
namespace App\Http\Requests\Back;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;
class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $id = basename($this->url());
        return $rules = [
            'title' => 'required|max:255',
            'body' => 'required|max:65000',
            'slug' => ['required', 'max:255', new Slug, 'unique:posts,slug,' . $id],
        ];
    }
}