<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\SurveyDataResource;
use App\Models\Form;
use App\Models\Template;
use Illuminate\Http\Request;

class FormController extends Controller
{
    //
    public function surveys(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $forms = Form::with(['answers'])->whereHas('answers')->get();

        return SurveyDataResource::collection($forms);
    }

    public function submitForm(Request $request)
    {

        $template = Template::with('fields')->where('link', $request->link)->first();

        if (!$template) {
            return response()->json([
                'message' => 'This link doesn\'t exist'
            ], 404);
        }

        $inputs = $request->except(['link']);

        if (!$inputs) {
            return response()->json([
                'message' => 'There are no fields'
            ], 404);
        }

        $form = new Form();
        $form->template_id = $template->id;
        $form->save();

        foreach ($inputs as $key => $value) {

            $field = Template::where('link', $request->link)->whereHas('fields', function ($query) use ($key) {
                $query->where('name', '=', $key);
            })->exists();

            if (!$field) {
                return response()->json([
                    'message' => 'Field name ' . $key . ' doesn\'t exist in this form'
                ], 404);
            }

            $form->answers()->create([
                'form_id' => $form->id,
                'question' => $key,
                'answers' => $value
            ]);
        }


    }
}
