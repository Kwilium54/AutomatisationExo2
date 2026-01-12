<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static find($id)
 */
class Company extends Model
{
    protected $table = 'companies';


    public function offices(): HasMany
    {
        return $this->hasMany(Office::class);
    }

    public function headOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'head_office_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
