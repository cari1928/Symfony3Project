<?php

namespace ITC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager(); //para traer los objetos de la BD
        $users = $em->getRepository('ITCUserBundle:User')->findAll(); //trae todos los registros
        
        // Renderizar hacia una vista
        // Bundle:Directorio:Archivo
        return $this->render('ITCUserBundle:User:index.html.twig', array('users'=>$users));
    }
    
    public function viewAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('ITCUserBundle:User');
        // $user = $repository->find($id);
        $user = $repository->findOneById($id);
        // $user = $repository->findOneByUsername($nombre);
        
        return new Response('Usuario: '.$user->getUserName()." - Email: ".$user->getEmail());
    }
}
