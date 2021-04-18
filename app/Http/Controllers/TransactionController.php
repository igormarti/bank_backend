<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * @var TransactionService
     */
    private $transactionService;

    /**
     * Controller Constructor
     *
     * @param TransactionService $transactionService
     */
    function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    function index(Request $request)
    {
        try {
            $transactions = $this->transactionService
                ->getTransactionByAccount(auth('api')->user()->userAccount->id,$request->get('limit'),$request->get('paginate'));

            return response()->json(['status' => true, 'transactions' => $transactions], Response::HTTP_OK);
        }catch (\Throwable $error){

            return response()->json([
                'success' => false,
                'errors' => $error->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
