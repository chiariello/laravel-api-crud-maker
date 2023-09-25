<?php

namespace Chiariello\LaravelApiCrudMaker\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbstractRequest extends FormRequest
{
    protected string $model;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [];
    }

    public function persist()
    {
        $data = $this->except('id');
        if ($this->id) {
            return $this->model::findOrFail($this->id)->update($data);
        }

        return $this->model::create($data);
    }
}
