<?php
namespace AP41\Entity;

use AP41\Repository\TaskRepository;




#[ORM\Table(name: 'tareas')]

#[Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id', type: 'integer')]
    private int $id;

    #[Column(name: 'titulo', type: 'string', length: '255')]
    private string $titulo;

    #[Column(name: 'fecha_creacion', type: 'date')]
    private string $fechaCreacion;

    #[Column(name: 'fecha_vencimiento', type: 'date')]
    private string $fechaVencimiento;
}