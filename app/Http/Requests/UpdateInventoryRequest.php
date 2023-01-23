<?php

namespace App\Http\Requests;

use App\Models\Image;
use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class UpdateInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->deleteOldImageIds){
            $imagesCount = Image::where('imageable_id', Store::where('id', $this->id)->first()->id)
                                ->whereIn('id', $this->deleteOldImageIds)->count();
            return count($this->deleteOldImageIds) ===  $imagesCount;
        }
        return true;
    }

    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function ($validator) {
            $this->after($validator);
        });
    }

    protected function after($validator)
    {
        session()->flash('persists');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->isMethod('POST')) {
            return [
                'name' => ['required', 'string', 'max:100'],
                'price' => ['required', 'numeric', 'min:1'],
                'category_id' => ['required', ValidationRule::exists('categories', 'id')],
                'description' => ['nullable'],
            ];
        }

        return [];
    }
}
