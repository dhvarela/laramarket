<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarketController extends Controller
{
    public function index($status='default')
    {
        if ($status == 'active') {
            $markets = Market::getActiveMarkets();
        } else {
            $markets = Market::getAllMarkets();
        }

        return view('markets.index', [
                    'markets'   => $markets,
                    'title'     => 'Market title'
                ]);
    }

    public function create()
    {
        return view('markets.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:255|min:5',
            'description'   => 'required|max:255',
            'active' => 'bool'
        ]);

        if ($validator->fails()) {
            return redirect('/markets/create')
                ->withInput()
                ->withErrors($validator);
        }

        Market::create($request->all());
        return redirect('markets');
    }
}
