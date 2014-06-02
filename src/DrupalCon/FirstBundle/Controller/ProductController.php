<?php

namespace DrupalCon\FirstBundle\Controller;

/*use Symfony\Component\HttpFoundation\Response; */
use DrupalCon\FirstBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
  /**
   * Finds and displays a Product entity.
   *
   * @Route("/{id}.json", name="product_show_json")
   * @Method("GET")
   */
  public function showJsonAction($id)
  {
      $em = $this->getDoctrine()->getManager();

      // @var Product $product */
      $product = $em->getRepository('FirstBundle:Product')->find($id);

      if (!$product) {
          throw $this->createNotFoundException('Unable to find Product entity.');
      }

      $data = array(
          'id' => $product->getId(),
          'name' => $product->getName(),
          'price' => $product->getPrice(),
      );
      $json = json_encode($data);

      return new Response($json);
  }

  /**
   * Finds and displays a Product entity.
   *
   * @Route("/details/{id}", name="product_show")
   * @Method("GET")
   */
  public function showDetailsAction($id)
  {
      $product = $this->getDoctrine()
          ->getRepository('FirstBundle:Product')
          ->find($id);

      if (!$product) {
          throw $this->createNotFoundException(
              'No product found for id '.$id
          );
      }

      // ... do something, like pass the $product object into a template
      return new Response('Product id '.$product->getId() . ' found, name is: ' . $product->getName() . '; price is: ' .$product->getPrice());
  }

  /**
   * @Route("/")
   */  public function createAction()
  {
      $product = new Product();
      $product->setName('Product-'.$product->getId());
      $randomDollarAmt = rand(0,50);
      $randomChangeAmt = rand(0,99);
      $product->setPrice($randomDollarAmt . '.' . $randomChangeAmt);

      $em = $this->getDoctrine()->getManager();
      $em->persist($product);
      $em->flush();

      return new Response('Created product id '.$product->getId());
  }

  // $serializer = new ProductSerializer(); equivalent
  $serializer = $this->container->get('my_product_serializer');

}