<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 15/04/21
 * Time: 22:23
 */

namespace App\Repositories;

use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Builder;

class UserAccountRepository extends BaseRepository
{
    /**
     * Set UserAccount Model
     *
     * @var $modelClass
     */
    protected $modelClass = UserAccount::class;

    /**
     * Service get Account
     *
     * @param number $id
     * @return Builder
     */
    public function getAccount($id)
    {
        $query = $this->newQuery();
        return $query->find($id);
    }

    /**
     * Service Create Transaction
     *
     * @param array $payload
     * @return Builder
     */
    public function createAccount($payload)
    {
        $query = $this->newQuery();
        return $query->create($payload);
    }

    /**
     * Service Create Transaction
     *
     * @param array $payload
     * @param number $id
     * @return bool|integer
     */
    public function updateAccount($payload,$id)
    {
        $query = $this->newQuery();

        return $query->find($id)->update($payload);
    }
    
}