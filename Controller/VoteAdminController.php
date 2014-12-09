<?php
namespace GS\VoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\VoteBundle\Entity\Project;

class VoteAdminController extends Controller
{

    public function validerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('VoteBundle:Project')->findOneBy(array('id' => $id));
        if($project->getValid() == ""){
            $project->setValid(1);
            $em->persist($project);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Le projet est bien validé'
        );
        return $this->redirect($this->generateUrl('project'));

    }
}