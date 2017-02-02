<?php

namespace RentBike\RentBikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use RentBike\RentBikeBundle\Entity\Users;
use RentBike\RentBikeBundle\Entity\Bike;

class BikeController extends Controller
{
	/**
	 * Guardar bicicleta 
	 *	{
		  "email": "lizethcabrales@gmail.com",
		  "password": "rentbike123",
		  "name": "lizeth",
		  "lastname": "rodriguez",
		  "type": "ADMIN"
		}
	 */
	public function saveAction()
	{
		$em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        //Obtenemos los datos que nos envia el cliente
        $data = $request->getContent();
        $data = json_decode($data, true);
	
        if(count($data) > 0){
        	
        	$bike = new Bike();

        	$bike->setCode($data['code']);
        	$bike->setDescription($data['description']);
        	$bike->setState('DISPONIBLE');

        	$em->persist($bike);
        	$em->flush();

        	return new JsonResponse(array('msj' => 'Registro guardado'));

        }
	}

	/**
	 * Listar usuarios
	 */
	public function listAction()
	{
		$em = $this->get("doctrine")->getManager();

		$query = $em->createQuery('SELECT b FROM RentBikeBundle:Bike b');

		$data = $query->getArrayResult();	

		//print_r($data);

		return new JsonResponse(array('total' => count($data), 'data' => $data));
	
	}

	/**
	 * Listar usuarios
	 */
	public function getAction()
	{

		$request = $this->get('request');

       	$id = $request->get('id');
     
		$em = $this->get("doctrine")->getManager();

		$query = $em->createQuery('SELECT b FROM RentBikeBundle:Bike b
								   WHERE b.id = '.$id);

		$data = $query->getArrayResult();	

		//print_r($data);

		return new JsonResponse(array('total' => count($data), 'data' => $data));
	
	}

	public function updateAction()
	{
		$em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        $id = $request->get('id');

        $bike = $em->getRepository('RentBikeBundle:Bike')->find($id);

        if($bike){
        	//Obtenemos los datos que nos envia el cliente
	        $data = $request->getContent();
	        $data = json_decode($data, true);
		
	        if(count($data) > 0){
	        	
	        	//$bike = new Bike();

	        	$bike->setCode($data['code']);
	        	$bike->setDescription($data['description']);
	        	//$bike->setState($data['state']);

	        	//$em->persist($bike);
	        	$em->flush();

	        	return new JsonResponse(array('msj' => 'Registro actualizado'));

	        }
        }else{
        	return new JsonResponse(array('msj' => 'Registro no encontrado'));
        }

	}

	public function searchBike()
	{
		# code...
	}
}
