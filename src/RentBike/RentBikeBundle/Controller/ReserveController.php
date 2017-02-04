<?php

namespace RentBike\RentBikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use RentBike\RentBikeBundle\Entity\Users;
use RentBike\RentBikeBundle\Entity\Bike;
use RentBike\RentBikeBundle\Entity\Reserve;

class ReserveController extends Controller
{
	/**
	 * Guardar reserva
	 */
	public function saveAction()
	{
		$em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        //Obtenemos los datos que nos envia el cliente
        $data = $request->getContent();
        $data = json_decode($data, true);
	
        if(count($data) > 0){
        	
        	$reserve = new Reserve();

        	$reserve->setName($data['name']);
        	$reserve->setLastname($data['lastname']);
        	$reserve->setIdentification($data['identification']);
        	$reserve->setIdentification($data['identification']);
        	$reserve->setEmail($data['email']);
        	$reserve->setPhone($data['phone']);
        	//$reserve->setDate($data['date']);

        	$date = new \DateTime($data['date']);
        	$reserve->setDate($date);

        	$reserve->setStartTime($data['startTime']);
        	$reserve->setEndTime($data['endTime']);

        	$reserve->setState('PENDIENTE');

        	$em->persist($reserve);
        	$em->flush();

        	return new JsonResponse(array('msj' => 'Registro guardado'));

        }
	}

	/**
	 * Listar reservas
	 */
	public function listAction()
	{
		$em = $this->get("doctrine")->getManager();

		$query = $em->createQuery('SELECT r FROM RentBikeBundle:Reserve r');

		$data = $query->getArrayResult();	

		//print_r($data);

		return new JsonResponse(array('total' => count($data), 'data' => $data));
	
	}

    public function searchReserveAction($text)
    {
        $em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        //Obtenemos los datos que nos envia el cliente
        $data = $request->getContent();
        $data = json_decode($data, true);

     	$query = $em->createQuery("SELECT r FROM RentBikeBundle:Reserve r
                WHERE r.id LIKE '%".$text."%' 
                OR r.name LIKE '%".$text."%'
                OR r.lastname LIKE '%".$text."%'
                OR r.identification = '".$text."'
                OR r.email LIKE '%".$text."%'");

        $data = $query->getArrayResult();   

        //print_r($data);

        //if($data){
            return new JsonResponse(array('total' => count($data), 'data' => $data));
        //}else{
            //return new JsonResponse(array('total' => count($data), 'data' => $data));
        //}
    }
}
