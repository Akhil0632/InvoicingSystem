<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesService extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 'service_name', 'hours', 'hourly_rate', 'amount',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
