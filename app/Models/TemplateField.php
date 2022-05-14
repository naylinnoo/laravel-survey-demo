<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TemplateField extends Pivot
{
    //
    protected $fillable = ['template_id', 'field_id', 'required', 'placeholder'];

    public function field()
    {
        return $this->belongsTo('App\Models\Field');
    }

    public function template()
    {
        return $this->belongsTo('App\Models\Template');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
