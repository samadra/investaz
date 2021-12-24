<?php
namespace App\Repositories;

use App\Interfaces\BondRepositoryInterface;
use App\Models\Bond;
use App\Models\Order;
use Carbon\Carbon;

class BondRepository implements BondRepositoryInterface
{
    public function getPayouts($bond_id){
        $bond = $this->getBond($bond_id);
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
        return $dates;
    }

    public function getBond($id){
        return Bond::find($id);
    }
    public function getOrder($order_id){
        return Order::find($order_id);
    }

    public function getPercent($bond_id){
        $bond = $this->getBond($bond_id);
        return $bond->percent;

    }

    public function accumulatedInterest($payouts,$percent,$order_count,$order_date){

        $data = [];
        $last = $order_date;
        foreach ($payouts['dates'] as $period=>$py){
            $pastday = $this->pastDays($order_date,$py['date']);
            if($period == 0){

                $last = $py['date'];
            }else{
                $last = $py['date'];
            }


            $data['payouts'][$period]['date'] = $py['date'];
            $amount = $percent * $pastday * $order_count;
            $data['payouts'][$period]['amount'] =round($amount, 2);
        }

        return $data;
    }

    public function pastDays($last,$next){
        $last = new Carbon($last);
        $next = new Carbon($next);
        return $last->diffInDays($next);
    }
}
