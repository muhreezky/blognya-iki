<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationHistory extends Model
{
    use HasFactory;

    protected $months;

    public function __construct(array $attributes = [])
    {
        $this->months = array_map(
            fn ($v) => __("times/months.{$v}"),
            [0,1,2,3,4,5,6,7,8,9,10,11]
        );
    }

    protected $appends = [
        'start',
        'end',
    ];

    protected function start(): Attribute
    {
        return Attribute::make(
            fn ($value, $attributes) => "{$attributes['start_month']}, {$attributes['start_year']}"
        );
    }

    protected function end(): Attribute
    {
        return Attribute::make(
            fn ($value, $attributes) => "{$attributes['end_month']}, {$attributes['end_year']}"
        );
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
