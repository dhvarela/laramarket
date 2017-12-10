<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $market_id
 * @property string $name
 * @property string $acronym
 * @property string $created_at
 * @property string $updated_at
 * @property Market $market
 */
class Stock extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['market_id', 'name', 'acronym'];

    protected $hidden = ['created_at', 'updated_at'];

    static public function getAllStocksAndMarkets() {
        return self::with('market')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo('App\Market');
    }
}
