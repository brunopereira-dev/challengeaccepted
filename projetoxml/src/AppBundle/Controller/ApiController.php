<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 *
 * @Route("/api/resources")
 */
class ApiController extends Controller
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/getships", name="resources_api_ships")
     * @Method("GET")
     */
    public function shipsAction(Request $request)
    {
        $ships = $this->getDoctrine()->getRepository('AppBundle:Shiporder')->findAll();	
        $retorno = array();
        foreach($ships as $ship)                    
            array_push($retorno, $this->createObjShipOrder($ship));            
                
        return $this->createJsonResponse(array(
            'resource' => $retorno,
        ));
    }

    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/getpersons", name="resources_api_persons")
     * @Method("GET")
     */
    public function personAction(Request $request)
    {
        $persons = $this->getDoctrine()->getRepository('AppBundle:Person')->findAll();
        $retorno = array();
        foreach($persons as $person)                    
            array_push($retorno, $this->createObjPerson($person));            
                
        return $this->createJsonResponse(array(
            'resource' => $retorno,
        ));
    }

    /**
     *
     * @param array $data
     * @param int $code
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function createJsonResponse(array $data, $code = 200, array $headers = array())
    {
        $response = new Response(json_encode($data), $code, $headers);
        $response->headers->set('Content-type', 'application/json');
        return $response;
    }

    /**
     *
     * @param \AppBundle\Entity\Shiporder $ship
     * @return \stdClass
     */
    private function createObjShipOrder($ship)
    {
        $temp = new \stdClass();
        $temp->id = $ship->getId();
        $temp->shiptoname = $ship->getShiptoname();
        $temp->shiptoaddress = $ship->getShiptoaddress();
        $temp->shiptocity = $ship->getShiptocity();
        $temp->shiptocountry = $ship->getShiptocountry();
        return $temp;
    }

    /**
     *
     * @param \AppBundle\Entity\Person $person
     * @return \stdClass
     */
    private function createObjPerson($person)
    {
        $temp = new \stdClass();
        $temp->id = $person->getId();
        $temp->name = $person->getName();
        return $temp;
    }
}