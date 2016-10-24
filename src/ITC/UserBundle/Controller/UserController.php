<?php

namespace ITC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ITC\UserBundle\Entity\User;
use ITC\UserBundle\Form\UserType;

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
    
    public function addAction()
    {
        $user = new User();
        $form = $this->createCreateForm($user);
        
        return $this->render('ITCUserBundle:User:add.html.twig', array('form'=>$form->createView()));
    }
    
    public function createAction(Request $request)
    {   
        $user = new User();
        $form = $this->createCreateForm($user);
        $form->handleRequest($request); //se obtiene el formulario y procesando con el obj request
        
        if($form->isValid())
        {
            $password = $form->get('password')->getData(); //recupera el password ingresado
            
            $encoder = $this->container->get('security.password_encoder'); //codifica password
            //entidad, password
            $encoder = $encoder->encodePassword($user, $password );
            
            $user->setPassword($encoder); //se coloca el pass ya encriptado
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush(); //guarda c/u de los campos en la bd
            return $this->redirectToRoute('itc_user_index');
        }
        
        return $this->render('ITCUserBundle:User:add.html.twig', array('form'=>$form->createView()));
    }
    
    private function createCreateForm(User $user)
    {
        //formulario, entidad, arreglo de opciones
        $form = $this->createForm(UserType::class, $user, array(
                'action' => $this->generateUrl('itc_user_create'),
                'method'=>'POST'
            ));
            
        return $form;
    }
    
}
