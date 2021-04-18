<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWithDrawRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WithDrawController extends Controller
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

    function create(CreateWithDrawRequest $request)
    {
        try {
            $this->transactionService->subtTransaction($request->all());

            return response()->json(['status' => true], Response::HTTP_CREATED);
        }catch (\Throwable $error){

            return response()->json([
                'success' => false,
                'errors' => $error->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
