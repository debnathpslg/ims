<?php

namespace App\Models;

// use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
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
        'vendor_code',
        'vendor_name',
        'vendor_address',
        'vendor_city',
        'vendor_state',
        'vendor_pin',
        'vendor_mobile',
        'vendor_email',
        'vendor_gst_no',
        'vendor_status',
    ];

    protected function vendorCode(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? strtoupper($value) : null
        );
    }

    protected function vendorName(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucwords(strtolower($value)) : null
        );
    }

    protected function vendorAddress(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucfirst(strtolower($value)) : null
        );
    }

    protected function vendorCity(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucwords(strtolower($value)) : null
        );
    }

    protected function vendorState(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucwords(strtolower($value)) : null
        );
    }

    protected function vendorEmail(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? strtolower($value) : null
        );
    }

    protected function vendorGstNo(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? strtoupper($value) : null
        );
    }

    public function isActive(): bool
    {
        return $this->vendor_status === 'Active';
    }
}
