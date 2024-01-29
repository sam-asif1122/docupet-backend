<?php

namespace App\Controller;

use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\ORMException;

//use Doctrine\ORM\EntityManagerInterface;
// extends AbstractController{}
class PetApiController extends AbstractController
{

    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $pet = new Pet();
            $pet->setName($data['name']);
            $pet->setType($data['type']);
            $pet->setGender($data['gender']);
            $pet->setBreed($data['breed']);
            $pet->setNo($data['no']);
            $entityManager->persist($pet);
            $entityManager->flush();
            return new JsonResponse(['message' => 'Pet has been registered!'], JsonResponse::HTTP_CREATED);
        } catch (ORMException $e) {

            return new JsonResponse(['error' => 'Database error occurred.'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {

            return new JsonResponse(['error' => 'An error occurred.'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
