<?php

namespace App\Models;

use App\Models\Stock;
// use App\Models\ItemSerial;
use Illuminate\Support\Str;
// use App\Models\ItemMovement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
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

        static::created(function ($item) {
            $item->stock()->create([
                'total_purchased' => 0,
                'total_issued' => 0,
                'total_scrapped' => 0,
                'total_returned_by_employee' => 0,
                'total_returned_to_vendor' => 0,
                'stock_in_hand' => 0,
            ]);
        });
    }

    protected $fillable = [
        'item_code',
        'item_name',
        'item_type',
        'item_has_serial_no',
        'item_unit',
        'item_reorder_quantity',
        'is_item_scrapable',
        'is_item_refundable',
        'item_status',
    ];

    protected function itemCode(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? strtoupper($value) : null
        );
    }

    protected function itemName(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucwords(strtolower($value)) : null
        );
    }

    protected function itemUnit(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucwords(strtolower($value)) : null
        );
    }

    public function isConsumable(): bool
    {
        return $this->item_type === 'Consumable';
    }

    public function itemHasSerialNo(): bool
    {
        return (bool) $this->item_has_serial_no;
    }

    public function isItemScrapable(): bool
    {
        return (bool) $this->is_item_scrapable;
    }

    public function isItemRefundable(): bool
    {
        return (bool) $this->is_item_refundable;
    }

    public function isActive(): bool
    {
        return $this->item_status === 'Active';
    }

    public function stock(): HasOne
    {
        return $this->hasOne(
            Stock::class,
            'item_id',
        );
    }

    public function itemMovements(): HasMany
    {
        return $this->hasMany(
            ItemMovement::class,
            'item_id',
        );
    }

    public function itemSerials(): HasMany
    {
        return $this->hasMany(
            Item::class,
            'item_id',
        );
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(
            Item::class,
            'item_id',
        );
    }

    public function canBeInactivated(): bool
    {
        return $this->stock && $this->stock->stock_in_hand == 0;
    }
}
