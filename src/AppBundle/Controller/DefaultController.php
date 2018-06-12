<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AdminBundle:Page')->findAll();
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", requirements={"id" = "\d+"}, defaults={"id" = null})
     */
    public function createOrEditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        if($id){
            $article = $em->getRepository('AdminBundle:Page')->find($id);
        }
        else{
            $article = new Article();
        }
        $form = $this->container->get('form.factory')->createBuilder(ArticleType::class, $article)->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($article);
            $em->flush();
        }
        return $this->render('@App/article/create.html.twig', array('form' => $form->createView()));
    }
}
