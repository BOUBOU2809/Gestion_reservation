<?php
// src/Controller/AuthController.php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface; // Assure-toi d'importer la bonne classe EntityManagerInterface
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AuthController extends AbstractController
{
    private $entityManager;

    // Injecte l'EntityManagerInterface dans le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hashage du mot de passe et enregistrement
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));

            $user->setRoles(['ROLE_USER']);  // Ajoute cette ligne

            // Utilise l'EntityManager pour persister l'utilisateur
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // Redirige l'utilisateur vers la page de connexion après l'enregistrement
            return $this->redirectToRoute('app_login');
        }

        return $this->render('auth/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'app_login')]
public function login(): Response
{
    // Symfony gère automatiquement l'authentification via le formulaire
    return $this->render('auth/login.html.twig');
}


    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Symfony gère automatiquement la déconnexion
    }
}
