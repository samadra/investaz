<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use App\Repositories\BondRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BordController extends Controller
{


    /**
     * @var BondRepository
     */
    private $bondRepository;

    public function __construct(BondRepository $bondRepository)
    {
        $this->bondRepository = $bondRepository;
    }

    /**
     * Bond Interest Maturity Dates.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function payouts(int $id){


        return response()->json( $this->bondRepository->getPayouts($id));

    }
}
