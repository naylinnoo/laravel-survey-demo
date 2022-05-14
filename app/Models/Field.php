<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'label', 'name', 'type', 'user_id'
    ];

    public function templates()
    {
        return $this->belongsToMany(Template::class);
    }

    public function scopeOnlyMyFields()
    {
        return $this->where('user_id', auth()->id());
    }

    public function scopeAvailableFields()
    {
        return $this->whereNull('user_id')->orWhere('user_id', auth()->id());
    }

    public function scopeTemplateSpecificFields($query, $templateId)
    {
        return $query->where('isUniqueToTemplate', true)->whereHas('templates', function ($query) use ($templateId) {
            $query->where('id', $templateId);
        });
    }

    public function scopeUserFields()
    {
        return $this->where('user_id', auth()->id());
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
