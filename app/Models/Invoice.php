<?php

namespace App\Models;

use App\Models\InvoicesService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_code', 'invoice_date', 'customer_name', 'customer_address',
        'notes','total_amount', 'vat_amount', 'discount_amount', 
        'grand_total',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'total_amount' => 'float',
        'vat_amount' => 'float',
        'discount_amount' => 'float',
        'grand_total' => 'float',
    ];

    public function InvoicesServices()
    {
        return $this->hasMany(InvoicesService::class, 'invoice_id');
    }
}
