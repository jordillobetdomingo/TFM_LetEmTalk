<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Response\ReadRolesResponse;
use LetEmTalk\Component\Domain\Authorization\Repository\RoleRepository;

class ReadRolesUseCase
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function execute(): ReadRolesResponse
    {
        $roles = $this->roleRepository->getAllRoles();
        return new ReadRolesResponse($roles);
    }
}