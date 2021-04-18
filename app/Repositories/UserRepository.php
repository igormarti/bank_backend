<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 15/04/21
 * Time: 22:23
 */

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{
    /**
     * Set User Model
     *
     * @var $modelClass
     */
    protected $modelClass = User::class;

    /**
     * Service get User
     *
     * @param number $id
     * @return Builder
     */
    public function getUser($id)
    {
        $query = $this->newQuery();
        $query->find($id);
        $query->with('useraccount');
        return $query->select(['users.id','users.name','users.email'])->first();
    }

    /**
     * Service Create User
     *
     * @param array $payload
     * @return Builder
     */
    public function createUser($payload)
    {
        $query = $this->newQuery();
        return $query->create($payload);
    }

    /**
     * Service Update User
     *
     * @param array $payload
     * @param number $id
     * @return bool|integer
     */
    public function updateUser($payload,$id)
    {
        $query = $this->newQuery();

        return $query->find($id)->update($payload);
    }
}