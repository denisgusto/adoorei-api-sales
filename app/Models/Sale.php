<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['amount'];
    protected $appends = ['amount'];

    /**
     * The products that belong to the sale.
     * 
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_sales')->withPivot('amount');
    }

    /**
     * Calcula o total da venda.
     *
     * @return float
     */
    public function getAmountAttribute(): float
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->amount * $product->price;
        });
    }
}
