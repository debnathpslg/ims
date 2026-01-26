<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Invoice;
use App\Models\Employee;
use Illuminate\Support\Str;
use App\Models\ItemMovement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemSerial extends Model
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
        'invoice_id',
        'serial_no',
        'status',
        'current_holder_type',
        'current_holder_id',
        'remarks',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(
            Item::class,
            'item_id',
        );
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(
            Invoice::class,
            'invoice_id',
        );
    }

    protected function serialNo(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? strtoupper($value) : null
        );
    }

    protected function remarks(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucfirst(strtolower($value)) : null
        );
    }
}
