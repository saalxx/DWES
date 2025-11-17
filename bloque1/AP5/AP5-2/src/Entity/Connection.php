<?php

namespace AP52\Entity;
use AP52\Repository\ConnectionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;
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
    private int $id;

    #[Column(name:'ip', type: 'string', length: 39)]
    private string $ip;

    #[Column(name:'date_connection', type: 'datetime')]
    private DateTime $dateConnection ;

    #[ManyToOne(targetEntity: Server::class, inversedBy: 'connections')]
    #[JoinColumn(name: 'server_id', referencedColumnName: 'id')]
    private Server $server;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'connections')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    public function getDateConnection(): DateTime
    {
        return $this->dateConnection;
    }

    public function setDateConnection(DateTime $dateConnection): void
    {
        $this->dateConnection = $dateConnection;
    }

    public function getServer(): \AP52\Entity\Server
    {
        return $this->server;
    }

    public function setServer(\AP52\Entity\Server $server): void
    {
        $this->server = $server;
    }

    public function getUser(): \AP52\Entity\User
    {
        return $this->user;
    }

    public function setUser(\AP52\Entity\User $user): void
    {
        $this->user = $user;
    }


}