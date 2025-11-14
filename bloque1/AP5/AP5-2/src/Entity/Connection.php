<?php

namespace AP52\Entity;
use AP52\Repository\ConnectionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use DateTime;
use AP52\Entity\User;
use AP52\Entity\Server;


#[Entity(repositoryClass: ConnectionsRepository::class)]
#[Table(name: 'connections')]
class Connection
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id', type: 'integer')]
    private $id;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'connections')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[Column(name:'ip', type: 'string')]
    private string $ip;

    #[Column(name:'date_connection', type: 'datetime', nullable: true)]
    private ?DateTime $date_connection = null;


    #[ManyToOne(targetEntity: Server::class, inversedBy: 'connections')]
    #[JoinColumn(name: 'server_id', referencedColumnName: 'id', nullable: false)]
    private ?Server $server = null;



}