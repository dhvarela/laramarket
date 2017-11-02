<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $input = $request->all();

        $market = new Market();

        if ($market->validate($input)) {

            if(!isset($input['active'])) {
                $input['active'] = 0;
            }

            Market::create($request->all());

            Session::flash('status_message', 'Market has been added');

            return redirect('markets');

        }

        return redirect('/markets/create')
            ->withInput()
            ->withErrors($market->errors);

    }
}
