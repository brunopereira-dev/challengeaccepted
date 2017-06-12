<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Entity\Person;
use AppBundle\Entity\Phone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadController extends Controller
{  
	private $people = array();
	private $shiporders = array();

	/**
	 * @Route("/upload/xml")
	 */
	public function xmlUploadAction(Request $request)
	{	
		if ($request->getMethod() == 'POST') 
		{
			$arquivos = $_POST['arquivo'];
			foreach($arquivos as $arq)							
				$this->convertXmlToObjetc(base64_decode($arq));	
			$this->persistirPeople();			
			
		
		} else {
			echo 'não foi post';
		}
		
		return $this->render('xml/xml.html.twig', array(
			'number' => "Registro salvo com o id"
		));
	}

	private function persistirPeople()
	{
		$em = $this->getDoctrine()->getManager();
		foreach ($this->people as $people) 				
			$em->persist($people);	
		$em->flush();	
		$this->people = array();
	}

	private function convertXmlToObjetc($stringXml)
	{
		try{        			
			$xml = simplexml_load_string($stringXml, 'SimpleXMLElement');
			if($xml != null)
			{
				if(property_exists($xml, 'shiporder'))
					$this->shiporders[] = $this->prepararShiporder($xml);
				else if(property_exists($xml, 'person'))
					$this->prepararPerson($xml);
			}			
		}catch (\Exception $e){
			echo 'Deu erro';
		}		
	}
	
	private function prepararShiporder($objXml)
	{   		   
		foreach($objXml as $ship)
		{

		}	
	}

	private function prepararPerson($objXml)
	{    
		foreach($objXml as $personXml)
		{
			$person = new Person();
			$person->setId($personXml->personid);
			$person->setName($personXml->personname);			
			foreach($personXml->phones as $phone)
			{
				foreach($phone as $number)
				{
					$phoneTemp = new Phone();
					$phoneTemp->setNumber($number);
					$person->addPhone($phoneTemp);	
				}												
			}		
			array_push($this->people, $person);			
		}		
	}	
}

