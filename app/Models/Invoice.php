<?php

// app/Models/Invoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    protected $fillable = ['date', 'total_amount', 'discount'];

    public function lineItems()
    {
        return $this->hasMany(InvoiceLineItem::class);
    }
}

