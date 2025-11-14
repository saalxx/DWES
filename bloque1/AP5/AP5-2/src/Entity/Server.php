<?php

namespace AP52\Entity;

use AP52\Repository\ServersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;
use AP52\Entity\Connection;
use AP52\Entity\User;



#[Entity(repositoryClass: ServersRepository::class)]
#[Table(name: "servers")]
class Server
{
    #[GeneratedValue]
    #[Id]
    #[Column(name: "id", type: 'integer')]
    private $id;

    #[Column(name:'url', type:'string', length: 250)]
    private string $url;

    #[Column(name:'country_server', type:'string', length: 4)]
    private string $countryServer;

    #[Column(name:'observation', type:'string', nullable: true)]
    private ?string $observation = null;

    #[Column(name:'domain', type:'string', length: 250)]
    private string $domain;
    #[Column(name:'ip', type:'string', length: 40)]
    private string $ip;

    #[OneToMany(targetEntity: Connection::class, mappedBy:'server')]
    private Collection $server;
    public function __construct() {
        $this->server = new ArrayCollection();
    }
}