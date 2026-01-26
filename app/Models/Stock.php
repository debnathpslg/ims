<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
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
        'total_purchased',
        'total_issued',
        'total_scrapped',
        'total_returned_by_employee',
        'total_returned_to_vendor',
        'stock_in_hand',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(
            Item::class,
            'item_id',
        );
    }
}
