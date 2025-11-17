<?php

namespace AP52\Entity;

use AP52\Repository\ServerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;
use AP52\Entity\Connection;
use AP52\Entity\User;



#[Entity(repositoryClass: ServerRepository::class)]
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

    #[Column(name:'observation', type:'text', nullable: true)]
    private ?string $observation = null;

    #[Column(name:'domain', type:'string', length: 250)]
    private string $domain;
    #[Column(name:'ip', type:'string', length: 40, nullable: true)]
    private ?string $ip;

    #[OneToMany(targetEntity: Connection::class, mappedBy:'server')]
    private Collection $connections;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getCountryServer(): string
    {
        return $this->countryServer;
    }

    public function setCountryServer(string $countryServer): void
    {
        $this->countryServer = $countryServer;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): void
    {
        $this->observation = $observation;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function getConnections(): Collection
    {
        return $this->connections;
    }

    public function setConnections(Collection $connections): void
    {
        $this->connections = $connections;
    }

}