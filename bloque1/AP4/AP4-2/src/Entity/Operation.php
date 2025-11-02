<?php

namespace AP42\Entity;

use AP42\Repository\UserRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use DateTime;

#[Entity(repositoryClass: UserRepository::class)]
#[Table(name: 'user')]
class Operation
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id', type: 'integer')]
    private int $id;

    #[Column (name: 'resultado', type: 'float')]
    private float $resultado;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'operations')]
    #[JoinColumn(name: 'usuario')]
    private User $user;

    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * @param mixed $resultado
     */
    public function setResultado($resultado): void
    {
        $this->resultado = $resultado;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

}




