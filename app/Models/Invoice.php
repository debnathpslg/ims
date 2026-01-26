<?php

namespace App\Models;

use App\Models\Vendor;
use App\Models\ItemSerial;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
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
        'vendor_id',
        'invoice_no',
        'invoice_date',
        'total_amount',
        'total_tax',
        'gross_amount',
        'round_off',
        'invoice_amount',
        'payment_status',
        'payment_date',
        'remarks',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(
            Vendor::class,
            'vendor_id',
        );
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(
            InvoiceItem::class,
            'invoice_id',
        );
    }

    public function itemSerials(): HasMany
    {
        return $this->hasMany(
            ItemSerial::class,
            'invoice_id',
        );
    }

    protected function invoiceNo(): Attribute
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
