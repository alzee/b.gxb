<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/api/login", name="api_login", methods={"POST"})
     */
    public function apiLogin()
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')){
            $resp = [
                "code" => 1
            ];
        }
        else {
            $user = $this->getUser();
            $uid = $user->getId();
            $avatar = $user->getAvatar();
            $username = $user->getUsername();
            $gxb = $user->getGxb();
            $data = [
                "id" => $uid,
                "avatar" => $avatar,
                "username" => $username,
                "gxb" => $gxb
            ];
            $resp = [
                "code" => 0,
                "data" => $data
            ];
        }
        return $this->json($resp);
    }
}
