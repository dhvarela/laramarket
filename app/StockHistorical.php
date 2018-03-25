<?php

namespace App;

use App\Traits\ValidationTrait;
use Carbon\Carbon;
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

    protected $dates = ['date'];

    protected $rules = [
        'stock_id' => 'required|integer|unique_with:stock_historicals,date',
        'date' => 'required|date_format:Y-m-d',
        'price' => 'required|numeric',
        'avg_6' => 'required|numeric',
        'avg_70' => 'required|numeric',
        'avg_200' => 'required|numeric',
    ];

    public static function getStockHistorical($stock_id, $start_date = null, $end_date = null)
    {
        $query = self::where('stock_id', $stock_id);

        if (!is_null($start_date)) {
            $query->where('date', '>=', $start_date);
        }
        if (!is_null($end_date)) {
            $query->where('date', '<=', $start_date);
        }

        return $query->orderBy('date','DESC')->get();
    }

    public static function StockHasAlreadyBeSavedToday($stock_id)
    {
        return (bool)self::where('stock_id', $stock_id)
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo('App\Stock');
    }
}
