<?php

namespace AP52\Entity;
use AP52\Entity\Connection;
use AP52\Repository\ServerRepository;
use AP52\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;
use AP52\Entity\Server;

#[Entity(repositoryClass: UserRepository::class)]
#[table(name: "users")]
class User
{
    #[GeneratedValue]
    #[id]
    #[Column(name: "id", type: 'integer')]
    private string $id;

    #[Column(name: "username", type: 'string', length: 30)]
    private string $username;

    #[Column(name: "first_subname", type: 'string', length: 100)]
    private string $firstSubname;


    #[Column(name: "second_subname", type: 'string', length: 100, nullable: true)]
    private ?string $secondSubname;
    #[Column(name: "address", type: 'string', length: 250, nullable: true)]
    private ?string $address;

    #[Column(name: "telephone", type: 'string', length: 13 , nullable: true)]
    private ?string $telephone;

    #[Column(name: "city", type: 'string', length: 250 , nullable: true)]
    private ?string $city;


    #[Column(name: "country", type: 'string', length: 4)]
    private string $country;

    #[Column(name:'observation', type:'text', nullable: true)]
    private ?string $observation = null;

    #[Column(name:'email', type:'string', length: 250)]
    private string $email;

    #[Column(name: 'name', type:'string', length: 30)]
    private string $name;

    #[OneToMany(targetEntity: Connection::class, mappedBy:'user')]
    private Collection $connections;

    //#[OneToOne(targetEntity: Dni::class)]
    //#[]
    //private DNI $dni;
    //ESTO ES DNI

    public function __construct(){
        $this->connections = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getFirstSubname(): string
    {
        return $this->firstSubname;
    }

    public function setFirstSubname(string $firstSubname): void
    {
        $this->firstSubname = $firstSubname;
    }

    public function getSecondSubname(): ?string
    {
        return $this->secondSubname;
    }

    public function setSecondSubname(?string $secondSubname): void
    {
        $this->secondSubname = $secondSubname;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): void
    {
        $this->observation = $observation;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

}