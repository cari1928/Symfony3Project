<?php

namespace ITC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        return new Response('Bienvenido a mi módulo de usuarios');
        //return $this->render('ITCUserBundle:Default:index.html.twig');
    }
    
    // public function articlesAction($page)
    // {
    //     return new Response('This is the article number '.$page);    
    // }
    
    
    
}
