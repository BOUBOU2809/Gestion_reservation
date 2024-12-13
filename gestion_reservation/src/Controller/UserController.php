<?php
// src/Controller/UserController.php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user', methods: ['GET'])]
    public function listUsers(UserRepository $userRepository): Response
    {
        // Vérifier si l'utilisateur est administrateur
        if ($this->isGranted('ROLE_ADMIN')) {
            // Administrateurs peuvent voir tous les utilisateurs
            $users = $userRepository->findAll();
            return $this->json($users);  // Retourne les utilisateurs sous forme de JSON (tu peux adapter selon ton besoin)
        }

        // Si l'utilisateur n'est pas admin, il peut accéder à ses propres données
        $user = $this->getUser(); // L'utilisateur connecté
        if (!$user) {
            return $this->json(['error' => 'Utilisateur non authentifié'], 403);
        }

        // Accès uniquement à ses propres données (par exemple son profil)
        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            // Ajouter d'autres informations selon ton entité User
        ]);
    }
}
