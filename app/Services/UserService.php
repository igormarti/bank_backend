<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 15/04/21
 * Time: 20:46
 */

namespace App\Services;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserService
{

    /**
     *
     * @var $userRepository
     */
    private $userRepository;
    /**
     *
     * @var $userAccountService
     */
    private $userAccountService;

    /**
     * Service Constructor
     *
     * @param UserRepository $userRepository
     * @param UserAccountService $userAccountService
     */
    function __construct(UserRepository $userRepository,UserAccountService $userAccountService)
    {
        $this->userRepository = $userRepository;
        $this->userAccountService = $userAccountService;
    }

    /**
     * Service get user
     *
     * @param number $id
     * @return Builder
     * @throws
     */
    public function getUser($id)
    {

        $user = $this->userRepository->getUser($id);

        if(is_null($user)){
            throw new \Exception('Usuário não encontrado.');
        }

        return $user;
    }

    /**
     * Service Constructor
     *
     * @param array $payload
     * @return void
     * @throws
     */
    public function createUser($payload)
    {
        $payload['password'] = bcrypt($payload['password']);
        $user = $this->userRepository->createUser($payload);

        if(!$user){
            throw new \Exception('Requisição mal formatada, erro na criação do usuário.');
        }

        $this->userAccountService->createAccount([
           'number_account' => rand(10000000,99999999),
           'agency' => 1303,
           'balance' => 0,
           'user_id' => $user->id
        ]);

    }

    /**
     * Service Constructor
     *
     * @param array $payload
     * @param number $id
     * @return User
     * @throws
     */
    public function updateUser($payload,$id)
    {
        $user = $this->userRepository->update($payload,$id);

        if(!$user){
            throw new \Exception('Requisição mal formatada, erro na criação do usuário.');
        }

        return $user;
    }



}