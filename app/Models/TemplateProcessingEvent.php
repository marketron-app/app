<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateProcessingEvent extends Model
{
    use HasFactory;
    public const UPDATED_AT = null;

    protected $casts = [
        "metadata" => "json"
    ];
    protected $guarded = [];
    public function template(){
        return $this->belongsTo(Template::class);
    }
}
