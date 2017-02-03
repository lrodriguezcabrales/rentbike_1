<?php

namespace RentBike\RentBikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use RentBike\RentBikeBundle\Entity\Users;

class UsersController extends Controller
{

	public function loginAction($value='')
	{
		$em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        //Obtenemos los datos que nos envia el cliente
        $data = $request->getContent();
        $data = json_decode($data, true);

        $email = $data['email'];
        $password = $data['password'];

        $user = $em->getRepository('RentBikeBundle:Users')->findBy(array('email'=>$email));

        if($user){
        	if($user->getPassword() == $password){
        		echo "Acceso correcto";
        	}else{
        		echo "Contraseña errada";
        	}
        }else{
        	echo "El usuario no existe";
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
