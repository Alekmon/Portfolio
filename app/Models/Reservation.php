<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'tel_number',
        'res_date',
        'table_id',
        'guest_number',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }
}
