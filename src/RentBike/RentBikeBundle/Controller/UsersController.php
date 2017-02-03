<?php

namespace RentBike\RentBikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use RentBike\RentBikeBundle\Entity\Users;

class UsersController extends Controller
{

	public function loginAction()
    {
    	$em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        //Obtenemos los datos que nos envia el cliente
        $data = $request->getContent();
        $data = json_decode($data, true);

        //print_r($data);

        $email = $data['email'];
        $password = $data['password'];

        $user = $em->getRepository('RentBikeBundle:Users')->findOneBy(array('email'=>$email));

        //print_r($user);


        if($user){
        	if($user->getPassword() == $password){
        		return new JsonResponse(array('status'=> 200, 'msj' =>'Acceso Correcto'));
        	}else{
        		return new JsonResponse(array('status'=> 500, 'msj' =>'Contraseña errada'));
        	}
        }else{
        	return new JsonResponse(array('status'=> 500, 'msj' =>'El usuario no existe'));
        }
    }

	/**
	 * Guardar un usuario 
	 */
	public function saveAction()
	{
		$em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        //Obtenemos los datos que nos envia el cliente
        $data = $request->getContent();
        $data = json_decode($data, true);
	
        if(count($data) > 0){
        	
        	$user = new Users();

        	$user->setEmail($data['email']);
        	$user->setPassword($data['password']);
        	$user->setName($data['name']);
        	$user->setLastname($data['lastname']);
        	$user->setType('ADMIN');

        	$em->persist($user);
        	$em->flush();

        }
	}

	/**
	 * Listar usuarios
	 */
	public function listAction()
	{
		$em = $this->get("doctrine")->getManager();

		$query = $em->createQuery('SELECT u FROM RentBikeBundle:Users u');

		$data = $query->getArrayResult();	

		//print_r($data);

		if($data){
			return new JsonResponse(array('total' => count($data), 'data' => $data));
		}else{
			return new JsonResponse(array('Ha ocurrido un error.'));
		}

	}
}
