<?php

namespace Theodo\NewOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Theodo\NewOfficeBundle\Form\NewOfficeType;

use Theodo\NewOfficeBundle\Entity\NewOffice;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="_home")
     * @Template()
     * @Cache(expires="+2 days", smaxage="172800")
     */
    public function indexAction()
    {

        $new_office = new NewOffice();

        $form = $this->createForm(new NewOfficeType(), $new_office);

        $result = array('moyenne' => array());

        $request = $this->get('request');
        if ($request->query->get('new_office')) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $origins = json_decode($new_office->origin, true);
                $destinations = json_decode($new_office->destination);
                foreach($origins as $user => $coords) {
                    $result[$user] = array();
                    foreach($destinations as $address => $coords2) {
                        $result[$user][$address] = $this->get('theodo_new_office.itinerary')->getMinTime($coords, $coords2);
                        if (!array_key_exists($address, $result['moyenne'])) {
                            $result['moyenne'][$address] = 0;
                        }
                        $result['moyenne'][$address] += ($result[$user][$address] / count($origins));
                    }
                }
            }
        }

        return array('form' => $form->createView(), 'result' => $result);
    }
}
