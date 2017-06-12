<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Entity\Person;
use AppBundle\Entity\Phone;
use AppBundle\Entity\Shiporder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadController extends Controller
{  
	private $people = array();
	private $shiporders = array();
    private $message = "";
	private $sucesso = false;
	/**
	 * @Route("/upload/xml")
	 */
	public function xmlUploadAction(Request $request)
	{	
		$this->message = "";
		if ($request->getMethod() == 'POST') 
		{
			try{
				$arquivos = $_POST['arquivo'];					
				$this->persistirXml($arquivos);	
				
				if($this->message == "")					
					$this->message = 'Arquivo(s) importado(s) com sucesso!';
				
			} catch (\Exception $e){				
				$this->message = 'Ocorreu um erro na inserção dos dados.					 
								  Verifique se esse arquivo já foi importado ou depende da inclusão de outro arquivo.';
				$this->sucesso = false;						
			}		
		} 
		
		$ships = $this->getDoctrine()->getRepository('AppBundle:Shiporder')->findAll();
		$person = $this->getDoctrine()->getRepository('AppBundle:Person')->findAll();

		$parametro = array('sucesso' => $this->sucesso, 'ships' => $ships, 'person' => $person);
		if($this->message != "")
			$parametro['message'] = $this->message;

		return $this->render('xml/xml.html.twig', $parametro);
	}

	private function persistirXml($arquivos)
	{	  	
		$listaShipOrderXml = array();
		$listaPersonXml = array();

		foreach($arquivos as $arq){			
			$xml = @simplexml_load_string(base64_decode($arq), 'SimpleXMLElement');
			if($xml != null && $xml != "")
			{
				if(property_exists($xml, 'shiporder'))
					array_push($listaShipOrderXml, $xml);
				else if(property_exists($xml, 'person'))
					array_push($listaPersonXml, $xml);	
			} else {
				$this->message = 'Ocorreu um erro na leitura do(s) arquivo(s). Por favor verifique se o(s) arquivo(s) está(ão) no formato correto e tente novamente.';
				$this->sucesso = false;
				break;
			}	
		}							

		if($this->message == ""){	
			foreach($listaPersonXml as $objXml){
				$this->prepararPerson($objXml);
			}
			$this->persistirPerson();

			foreach($listaShipOrderXml as $objXml){
				$this->prepararShiporder($objXml);
			}
			$this->persistirShiporders();
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
	private function persistirPerson()
	{
		$em = $this->getDoctrine()->getManager();
		foreach ($this->people as $people) 				
			$em->persist($people);	
		$em->flush();	
		$this->people = array();
	}

	private function prepararShiporder($objXml)
	{   
		foreach($objXml as $shipXml)
		{			
			$shiporder = new Shiporder();
			$shiporder->setId($shipXml->orderid);
			$shiporder->setShiptoname($shipXml->shipto->name);
			$shiporder->setShiptoaddress($shipXml->shipto->address);
			$shiporder->setShiptocity($shipXml->shipto->city);
			$shiporder->setShiptocountry($shipXml->shipto->country);
			
			$person = $this->getDoctrine()->getRepository('AppBundle:Person')->find($shipXml->orderperson);			
			$shiporder->setPerson($person);
			
			foreach($shipXml->items as $items)
			{	
				foreach($items as $item)
				{								
					$itemTemp = new Item();
					$itemTemp->setTitle($item->title);
					$itemTemp->setNote($item->note);
					$itemTemp->setQuantity($item->quantity);
					$itemTemp->setPrice($item->price);					
					$shiporder->addIten($itemTemp);	
				}															
			}	
			array_push($this->shiporders, $shiporder);			
		}			
	}
	private function persistirShiporders()
	{
		$em = $this->getDoctrine()->getManager();		
		foreach ($this->shiporders as $shiporder) 				
			$em->persist($shiporder);	
		$em->flush();	
		$this->shiporders = array();
	}		
}

