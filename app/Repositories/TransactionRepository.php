<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 15/04/21
 * Time: 22:23
 */

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository extends BaseRepository
{
    /**
     * Set Transaction Model
     *
     * @var $modelClass
     */
    protected $modelClass = Transaction::class;


    /**
     * Service get Transactions by account_id
     *
     * @param number $account_id
     * @param int|number $limit
     * @param boolean $paginate
     * @return Collection
     */
    public function getTransactionByAccount($account_id,$limit=10,$paginate=true)
    {
        $query = $this->newQuery();
        $query->where('useraccount_id',$account_id);
        return $this->doQuery($query,$limit, $paginate);
    }

    /**
     * Service Create Transaction
     *
     * @param array $payload
     * @return Builder
     */
    public function createTransaction($payload)
    {
        $query = $this->newQuery();
        return $query->create($payload);
    }

}