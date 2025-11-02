<?php
namespace AP41\Entity;

use AP41\Repository\TaskRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use DateTime;

#[Entity(repositoryClass: TaskRepository::class)]
#[Table(name: 'tareas')]
class Task
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id', type: 'integer')]
    private int $id;


    #[Column (name: 'titulo', type: 'string', length:  '65535')]
    private string $titulo;

    #[Column(name: 'descripcion', type: 'text')]
    private string $descripcion;

    #[Column (name: 'fecha_creacion', type: 'date')]
    private DateTime $fechaCreacion;

    #[Column (name: 'fecha_vencimiento', type: 'date')]
    private DateTime $fechaVencimiento;

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getFechaVencimiento(): DateTime
    {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento(DateTime $fechaVencimiento): void
    {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    public function getFechaCreacion(): DateTime
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(DateTime $fechaCreacion): void
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }
}