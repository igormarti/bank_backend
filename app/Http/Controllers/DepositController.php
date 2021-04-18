<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepositRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepositController extends Controller
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

    function create(CreateDepositRequest $request)
    {
        try {
            $this->transactionService->addTransaction($request->all());

            return response()->json(['status' => true], Response::HTTP_CREATED);
        }catch (\Throwable $error){

            return response()->json([
                'success' => false,
                'errors' => $error->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
