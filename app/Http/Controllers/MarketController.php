<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Market;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function show($id)
    {
        $market = Market::find($id);

        return view('markets.show')
            ->withTitle('Market detail')
            ->with('market', $market);
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

    public function edit($id)
    {
        $market = Market::findOrFail($id);
        return view('markets.edit')
            ->withTitle('Edit market')
            ->with('market', $market);
    }

    public function update(Request $request, $id)
    {
        $market = Market::find($id);

        $input = $request->all();

        if($market->validate($input)) {
            $market->name = $request->name;
            $market->description = $request->description;
            $market->active = (bool)$request->active;
            $market->save();

            Session::flash('status_message','The market has been updated!');

            return redirect('markets');
        }
        return back()->withInput($input)->withErrors($market->errors);
    }

    public function destroy($id)
    {
        try {
            $market = Market::findOrFail($id);
            $market->delete();
            $status_message = 'The market was deleted';

        } catch (ModelNotFoundException $e) {
            $status_message = 'No market with that id';
        }

        Session::flash('status_message',$status_message);
        return redirect('markets');
    }
}
