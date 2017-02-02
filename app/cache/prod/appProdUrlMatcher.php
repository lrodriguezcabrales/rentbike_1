<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // rent_bike_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'rent_bike_homepage');
            }

            return array (  '_controller' => 'RentBike\\RentBikeBundle\\Controller\\DefaultController::indexAction',  '_route' => 'rent_bike_homepage',);
        }

        if (0 === strpos($pathinfo, '/user')) {
            // rent_bike_save_user
            if ($pathinfo === '/user/save') {
                return array (  '_controller' => 'RentBike\\RentBikeBundle\\Controller\\UsersController::saveAction',  '_route' => 'rent_bike_save_user',);
            }

            // rent_bike_list_user
            if ($pathinfo === '/user/list') {
                return array (  '_controller' => 'RentBike\\RentBikeBundle\\Controller\\UsersController::listAction',  '_route' => 'rent_bike_list_user',);
            }

        }

        if (0 === strpos($pathinfo, '/bike')) {
            // rent_bike_save_bike
            if ($pathinfo === '/bike/save') {
                return array (  '_controller' => 'RentBike\\RentBikeBundle\\Controller\\BikeController::saveAction',  '_route' => 'rent_bike_save_bike',);
            }

            // rent_bike_list_bike
            if ($pathinfo === '/bike/list') {
                return array (  '_controller' => 'RentBike\\RentBikeBundle\\Controller\\BikeController::listAction',  '_route' => 'rent_bike_list_bike',);
            }

            // rent_bike_get_bike
            if (preg_match('#^/bike/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'rent_bike_get_bike')), array (  '_controller' => 'RentBike\\RentBikeBundle\\Controller\\BikeController::getAction',));
            }

            // rent_bike_update_bike
            if (0 === strpos($pathinfo, '/bike/update') && preg_match('#^/bike/update/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'rent_bike_update_bike')), array (  '_controller' => 'RentBike\\RentBikeBundle\\Controller\\BikeController::updateAction',));
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
