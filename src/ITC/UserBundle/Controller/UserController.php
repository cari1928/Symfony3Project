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
        
        // Para mostrar los datos
        $res = 'Lista de usuarios: <br/>';
        foreach ($users as $user) 
        {
            $res .= 'Usuario '.$user->getUserName()." - Email: ".$user->getEmail()."<br/>"; 
        }
    
        return new Response($res);
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
