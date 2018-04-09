<?php

namespace App;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $stock_id
 * @property int $user_id
 * @property Stock $stock
 * @property User $user
 */
class UserStocks extends Model
{
    use ValidationTrait;

    /**
     * @var array
     */
    protected $fillable = ['stock_id', 'user_id'];

    public $timestamps = false;

    protected $rules = [
        'user_id' => 'required|integer',
        'stock_id' => 'required|integer|exists:stocks,id|unique_with:user_stocks,user_id,stock_id',
    ];

    public static function getUserStocks($user_id)
    {
        return self::where('user_id', $user_id)->get()->KeyBy('stock_id')->toArray();
    }

    public static function getStockFollowers($stock_id)
    {
        return self::where('stock_id', $stock_id)->get()->pluck('user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo('App\Stock');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
