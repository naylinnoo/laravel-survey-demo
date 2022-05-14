<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateRequest;
use App\Http\Resources\v1\TemplateResource;
use App\Models\Field;
use App\Models\Template;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    //
    public function index(){
        $templates = Template::with('fields')->where('user_id', auth()->id())->get();
        return TemplateResource::collection($templates);
    }

    public function create(TemplateRequest $request){

        $validated = $request->only(['form_name']);

        $template = Template::create([
            'name' => $validated['form_name'],
            'user_id' => auth()->id(),
            'link' => Str::uuid(),
        ]);

        try {
            $template->fields()->attach($request->fields);
        } catch (QueryException $e) {
            $template->delete();
            return response()->json([
                'message' => 'One of the fields id is not valid',
            ], 500);
        }


        return TemplateResource::make($template);
    }
}
