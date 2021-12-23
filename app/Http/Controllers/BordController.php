<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bond = Bond::find($id);
        return $bond->period;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payouts($id){
        $bond = Bond::find($id);
        $dates['dates'] = [];
        $next_payment =  new Carbon($bond->issue_date);
        $last_date = new Carbon($bond->turnover_date);
        while ($last_date->gt($next_payment)){
            $next_payment = $next_payment->addDays($bond->period);
            if($next_payment->isWeekend()){
                $date = Carbon::parse($next_payment)->next('Monday')->format('Y-m-d');
            }else{
                $date = $next_payment->format('Y-m-d');
            }
            $dates['dates'][]['date'] = $date;
        }
        
        return response()->json( $dates );

    }
}
