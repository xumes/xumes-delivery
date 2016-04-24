<?php

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientServices
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ClientServices constructor.
     * @param ClientRepository $clientRepository
     * @param UserRepository $userRepository
     */
        public function __construct(ClientRepository  $clientRepository, UserRepository $userRepository)
        {
            $this->clientRepository = $clientRepository;
            $this->userRepository = $userRepository;
         }

    public function update(array $data, $id)
    {
       $this->clientRepository->update($data, $id);
        $user_id = $this->clientRepository->find($id, ['user_id'])->user_id;
        $this->userRepository->update($data['user'],$user_id );
    }

    public function create(array $data)
    {
        $data['user']['password']=bcrypt(123456);
        $user = $this->userRepository->create($data['user'] );

        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);

    }

}