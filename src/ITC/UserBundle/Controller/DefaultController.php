<?php

namespace ITC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ITCUserBundle:Default:index.html.twig');
    }
}
