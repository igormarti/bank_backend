<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 15/04/21
 * Time: 21:54
 */

namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    /**
     * Transaction repository
     *
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * UserAccount Service
     *
     * @var UserAccountService
     */
    private $userAccountService;

    /**
     * Service Constructor
     *
     * @param TransactionRepository $transactionRepository
     * @param UserAccountService $userAccountService
     */
    function __construct(TransactionRepository $transactionRepository,UserAccountService $userAccountService)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userAccountService = $userAccountService;
    }


    /**
     * Service get Transactions by account_id
     *
     * @param number $account_id
     * @param int|number $limit
     * @param boolean $paginate
     * @return Collection
     * @throws
     */
    public function getTransactionByAccount($account_id,$limit,$paginate)
    {
        $transactions = $this->transactionRepository->getTransactionByAccount($account_id,$limit,$paginate);

        if(is_null($transactions)){
            throw new \Exception('Nenhuma Transação encontrada.');
        }

        return $transactions;
    }

    /**
     * Service create transaction
     *
     * @param number $new_balance
     * @param Builder $account
     * @return void
     * @throws
     */
    public function createTransaction($value,$new_balance,$account)
    {
        if($new_balance<0){
            throw new \Exception('Saldo insuficiente.');
        }

        $transaction = $this->transactionRepository->createTransaction([
            'old_balance' => $account->balance,
            'new_balance' => $new_balance,
            'value' => $value,
            'useraccount_id' => $account->id
        ]);

        if(is_null($transaction) || !$transaction){
            throw new \Exception('Falha na criação da transação.');
        }

        $this->userAccountService->updateAccount(['balance'=>$new_balance],$transaction->useraccount_id);
    }

    /**
     * Service transaction sub
     *
     * @param array $payload
     * @return void
     * @throws
     */
    public function subtTransaction($payload){

        $account_id = auth('api')->user()->userAccount->id;

        $account = $this->userAccountService->getAccount($account_id);

        $value = $payload['value'] * -1;

        $new_balance = $value+$account->balance;

        $this->createTransaction($value, $new_balance, $account);
    }

    /**
     * Service transaction add
     *
     * @param array $payload
     * @return void
     * @throws
     */
    public function addTransaction($payload){

        $account_id = auth('api')->user()->userAccount->id;

        $account = $this->userAccountService->getAccount($account_id);

        $new_balance = $payload['value']+$account->balance;

        $this->createTransaction($payload['value'], $new_balance, $account);
    }

}