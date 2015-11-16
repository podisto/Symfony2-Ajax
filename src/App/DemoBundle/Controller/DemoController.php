<?php

namespace App\DemoBundle\Controller;

use App\DemoBundle\Entity\Institut;
use App\DemoBundle\Form\InstitutType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DemoController extends Controller
{
    public function indexAction()
    {
        $institut = new Institut();
        $form = $this->get('form.factory')->create(new InstitutType(), $institut);
        return $this->render('DemoBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function remplirVilleAction()
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        //Vérifie la présence d'une requete Ajax
        if($request->isXmlHttpRequest())
        {
            $id = $request->request->get('idReg');

            if($id != null)
            {
                $villes = $em->getRepository('DemoBundle:Ville')->getVillesWhere($id);

                $tabVilles = array();
                $i = 0;

                foreach($villes as $ville)
                {
                    $tabVilles[$i]['id'] = $ville->getId();
                    $tabVilles[$i]['nom'] = $ville->getNom();
                    $i++;
                }

                $response = new Response();
                $data = json_encode($tabVilles);

                $response->headers->set('Content-Type', 'application/json');
                $response->setContent($data);

                return $response;
            }
        }
        return new Response('Erreur');
    }
}
