<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Invoice;
use App\Models\ItemSerial;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemMovement extends Model
{
    //
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    protected $fillable = [
        'item_id',
        'serial_id',
        'quantity',
        'source_of_movement',
        'source_of_movement_id',
        'where_it_comes_from_type',
        'where_it_comes_from_id',
        'where_it_moves_to_type',
        'where_it_moves_to_id',
        'remarks',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(
            Item::class,
            'item_id',
        );
    }

    protected function remarks(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucfirst(strtolower($value)) : null
        );
    }
}
