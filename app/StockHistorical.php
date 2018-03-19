<?php

namespace App;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $stock_id
 * @property string $date
 * @property float $price
 * @property float $avg_6
 * @property float $avg_70
 * @property float $avg_200
 * @property string $created_at
 * @property string $updated_at
 * @property Stock $stock
 */
class StockHistorical extends Model
{
    use ValidationTrait;

    /**
     * @var array
     */
    protected $fillable = ['stock_id', 'date', 'price', 'avg_6', 'avg_70', 'avg_200'];
    protected $hidden = ['created_at', 'updated_at'];

    protected $rules = [
        'stock_id' => 'required|integer',
        'date' => 'required|date_format:Y-m-d',
        'price' => 'required|numeric|unique_with:stock_historicals,date,value',
        'avg_6' => 'required|numeric',
        'avg_70' => 'required|numeric',
        'avg_200' => 'required|numeric',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo('App\Stock');
    }
}
