<?php

namespace App\Controller;

use App\Entity\Students;

use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiStudentsController extends AbstractController
{
    #[Route('/api/students', methods: ['GET'], name: 'list')]
    public function list(EntityManagerInterface $em): JsonResponse
    {
        $student = $em->getRepository(Students::class)->findAll();
        $data = [];

        foreach ($student as $students) {
            $data[] = [
                'id' => $students->getId(),
                'name' => $students->getName(),
                'surname' => $students->getSurname(),
                'age' => $students->getAge(),
                'studentNumber' => $students->getStudentNumber(),
                'course' => $students->getCourse(),
                'gradeAverage' => $students->getGradeAverage(),
                'enrollmentDate' => $students->getEnrollmentDate(),
                'email' => $students->getEmail(),
            ];
        }
        return new JsonResponse($data);
    }
    #[Route('/api/students/{id}', methods: ['GET'], name: 'show')]
    public function show( Students $student): JsonResponse
    {
        $data = [
            'id' => $student->getId(),
            'name' => $student->getName(),
            'surname' => $student->getSurname(),
            'age' => $student->getAge(),
            'studentNumber' => $student->getStudentNumber(),
            'course' => $student->getCourse(),
            'gradeAverage'=> $student->getGradeAverage(),
            'enrollmentDate' => $student->getEnrollmentDate(),
            'email' => $student->getEmail(),
        ];

        return new JsonResponse($data);
    }
    #[Route('/api/students', methods: ['POST'], name: 'create')]
    public function create(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $student = new Students();
        $student->setName($data['name']);
        $student->setSurname($data['surname']);
        $student->setAge($data['age']);
        $student->setStudentNumber($data['studentNumber']);
        $student->setCourse($data['course']);
        $student->setGradeAverage((float) $data['gradeAverage']);
        $student->setEnrollmentDate(new DateTimeImmutable($data['enrollmentDate']));
        $student->setEmail($data['email']);

        $em->persist($student);
        $em->flush();
        /* PARA CASOS DE PRUEBA

        "birthDate": "2026-01-22 17:32:00"

        */
        return new JsonResponse(['status' => 'ok'], 201);
    }
    #[Route('/api/students/{id}', methods: ['PUT', 'PATCH'], name: 'update')]
    public function update(EntityManagerInterface $em, Request $request, Students $student): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(isset($data['name'])) {
            $student->setName($data['name']);
        }
        if(isset($data['surname'])) {
            $student->setSurname($data['surname']);
        }
        if(isset($data['age'])) {
            $student->setAge($data['age']);
        }
        if(isset($data['studentNumber'])) {
            $student->setStudentNumber($data['studentNumber']);
        }
        if(isset($data['course'])) {
            $student->setCourse($data['course']);
        }
        if (isset($data['gradeAverage'])) {
            $student->setGradeAverage((float) $data['gradeAverage']);
        }
        if(isset($data['email'])) {
            $student->setEmail($data['email']);
        }

        $em->persist($student);
        $em->flush();
        /* PARA CASOS DE PRUEBA

        "birthDate": "2026-01-22 17:32:00"

        */
        return new JsonResponse(['status' => 'ok'], 201);
    }
    #[Route('/api/students/{id}', methods: ['DELETE'], name: 'delete')]
    public function delete(EntityManagerInterface $em, Students $student): JsonResponse
    {

        $em->remove($student);
        $em->flush();

        return new JsonResponse(['status' => 'ok'], 201);
    }
}
