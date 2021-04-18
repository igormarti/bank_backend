<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 15/04/21
 * Time: 20:53
 */

namespace App\Services;

use App\Repositories\UserAccountRepository;
use Illuminate\Database\Eloquent\Builder;

class UserAccountService
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * UserAccountService Constructor
     *
     * @param UserAccountRepository $userAccountRepository
     */
    function __construct(UserAccountRepository $userAccountRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * Service get account
     *
     * @param number $id
     * @return Builder
     * @throws
     */
    public function getAccount($id)
    {

        $account = $this->userAccountRepository->getAccount($id);

        if(is_null($account)){
            throw new \Exception('Conta não encontrada.');
        }

        return $account;
    }

    /**
     * Create user account
     *
     * @param array $payload
     * @return void
     * @throws
     */
    public function createAccount($payload)
    {
        $account = $this->userAccountRepository->createAccount($payload);

        if(is_null($account) || !$account){
            throw new \Exception('Usuário criado com sucesso, porém ocorreu um erro na criação da conta');
        }
    }

    /**
     * Update user account
     *
     * @param array $payload
     * @param number $id
     * @return bool|integer
     * @throws
     */
    public function updateAccount($payload,$id)
    {
        $account = $this->userAccountRepository->updateAccount($payload,$id);

        if(is_null($account) || !$account){
            throw new \Exception('Usuário criado com sucesso, porém ocorreu um erro na criação da conta');
        }

        return $account;
    }

}