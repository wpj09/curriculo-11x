<?php

namespace App\Models;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Curriculum extends Model
{
    use HasFactory;
    protected $table = 'curriculums';

    public function curriculumObject()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Accerssors and Mutators
     */
    public function getUrlCoverAttribute()
    {
        if (!empty($this->cover)) {
            return Storage::url(Cropper::thumb($this->cover, 500, 500));
        }

        return '';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value === true || $value === 'on' ? 1 : 0);
    }

    public function getStartDateAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return date('m/Y', strtotime($value));
    }

    public function getFinalDateAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return date('m/Y', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return date('d/m/Y', strtotime($value));
    }
}
