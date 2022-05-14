<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomFieldRequest;
use App\Http\Resources\v1\FieldResource;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    //
    public function getFields(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return FieldResource::collection(Field::availableFields()->get());
    }

    public function createCustomField(CustomFieldRequest $request){
        $validated = $request->safe()->only(['name', 'label', 'type']);
        $field = Field::create([
            'name' => $validated['name'],
            'label' => $validated['label'],
            'type' => $validated['type'],
            'user_id' => auth()->id(),
        ]);
        $field->save();
        return new FieldResource($field);
    }
}
