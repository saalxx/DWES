<?php
namespace AP41\Entity;
use AP41\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;


#[Table(name: 'users')]
#[Entity(repositoryClass: UserRepository::class)]
class User
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id', type: 'integer')]
    private int $id;

    #[Column(name: 'titulo', type: 'string', length: '255')]
    private string $titulo;
}