<?php

// src/DrupalCon/FirstBundle/Controller/HelloController.php
namespace DrupalCon\FirstBundle\Controller;

/*use Symfony\Component\HttpFoundation\Response; */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
  public function indexAction($name)
    {
        /*return new Response('<html><body>Hello '.$name.'!</body></html>');*/
        return $this->render(
          'FirstBundle:Hello:index.html.twig',
          array('name' => $name)
        );
        // render a PHP template instead
        // return $this->render(
        //     'AcmeHelloBundle:Hello:index.html.php',
        //     array('name' => $name)
        // );        
    }
    
}
