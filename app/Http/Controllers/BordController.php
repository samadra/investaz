<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BordController extends Controller
{

    /**
     * Bond Interest Maturity Dates.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function payouts(int $id){
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
