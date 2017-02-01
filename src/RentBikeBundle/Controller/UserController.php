<?php

namespace RentBikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

	/**
	 * Guardar usuario
	 */
	public function saveAction()
	{
		echo "entro aqui";
		
		$em = $this->get("doctrine")->getManager();

        $request = $this->get('request');

        $data = $request->getContent();
        $data = json_decode($data, true);

        print_r($data);

        return new JsonResponse(array('success'=> false, 'message'=> 'jajaja'));

	}
}
