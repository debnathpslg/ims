<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
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
        'employee_code',
        'employee_name',
        'employee_designation',
        'employee_email',
        'employee_mobile',
        'employee_status',
    ];

    protected function employeeCode(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? strtoupper($value) : null
        );
    }

    protected function employeeName(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucwords(strtolower($value)) : null
        );
    }

    protected function employeeDesignation(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? ucwords(strtolower($value)) : null
        );
    }

    protected function employeeEmail(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? strtolower($value) : null
        );
    }

    public function isActive(): bool
    {
        return $this->employee_status === 'Active';
    }
}
