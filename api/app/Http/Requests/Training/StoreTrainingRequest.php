<?php

namespace App\Http\Requests\Training;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Training;
use App\Models\TrainingPart;

class StoreTrainingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Training::class);
    }

    public function prepareForValidation()
    {
        $this->merge([
            'enableTrainingPartStore' => true,
        ]);

        // 既に同じ名前の部位名が存在する場合は、新規に登録しない
        $enableTrainingPartStore = TrainingPart::query()
            ->where(function ($query) {
                return $query->where('user_id', null)
                    ->orWhere('user_id', $this->user()->id);
            })
            ->where('name', $this->part_name)
            ->exists();

        if ($enableTrainingPartStore) {
            $this->merge([
                'enableTrainingPartStore' => false,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('trainings', 'name')->where(function ($query) {
                    return $query->where('user_id', null)
                        ->orWhere('user_id', $this->user()->id);
                }),
            ],
            'part_name' => [
                'required',
                'string',
            ],
            'enableTrainingPartStore' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'トレーニング名',
            'part_name' => '部位名',
        ];
    }
}
