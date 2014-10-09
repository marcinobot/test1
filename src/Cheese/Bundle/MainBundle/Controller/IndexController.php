<?php

namespace Cheese\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cheese\Bundle\MainBundle\Form\Type\UserType;
use Cheese\Bundle\MainBundle\Entity\User;
use Cheese\Bundle\MainBundle\Entity\TotalVisits;

class IndexController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, defaults={"id" = null})
     * @Template()
     */
    public function indexAction($id, Request $request)
    {
        if (!empty($id)) {
            $user = $this->getDoctrine()
            ->getRepository('CheeseMainBundle:User')
            ->find($id);
            
            $this->visit($user);
        } else {
            $user = new User();
        }
        
        $this->totalVisit();
        
        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);
        
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            return $this->redirect($this->generateUrl(
                'cheese_main_index_user', 
                ['id' => $user->getId()]
            ));
        }
        
        return array(
            'user' => $user,
            'form' => $form->createView()
        );
    }
    
    
    /**
     * @Route("/user/{id}")
     * @Template()
     */
    public function userAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('CheeseMainBundle:User')
            ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'Not found!'
            );
        }
        
        $this->visit($user);
        $this->totalVisit();
        
        $risk = $this->get('risk_calculator');
        $risk->setAge($user->getDateOfBirth());
            
        return [
            'user' => $user,
            'risk' => $risk->getRisk(),
            'mortgageRisk' => $risk->getMortgageRisk(),
            'uri' => $this->generateUrl(
                'cheese_main_index_index', 
                ['id' => $user->getId()]
            )
        ];
    }
    
    /**
     * @Template()
     */
    public function visitsAction($id)
    {
        if (!empty($id)) {
            $user = $this->getDoctrine()
            ->getRepository('CheeseMainBundle:User')
            ->find($id);
        } else {
            $user = new User();
            $user->visit();
        }
        
        return [
            'user' => $user->getVisits(),
            'unique' => 10,
            'total' => $this->getTotalVisit()
        ];
    }

    protected function visit($user)
    {
        $em = $this->getDoctrine()->getManager();
        $user->visit();
        $em->persist($user);
        $em->flush();
    }
    
    protected function totalVisit()
    {
        $total = $this->getDoctrine()
            ->getRepository('CheeseMainBundle:TotalVisits')
            ->findAll();
        
        $em = $this->getDoctrine()->getManager();
        $total[0]->visit();
        $em->persist($total[0]);
        $em->flush();
    }
    
    protected function getTotalVisit()
    {
        $total = $this->getDoctrine()
            ->getRepository('CheeseMainBundle:TotalVisits')
            ->findAll();
        
        $em = $this->getDoctrine()->getManager();
        return $total[0]->getTotal();
    }
        
}
