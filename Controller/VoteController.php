<?php
namespace GS\VoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\VoteBundle\Entity\Project;
use GS\VoteBundle\Entity\Vote;

class VoteController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VoteBundle:Default:index.html.twig', array('name' => $name));
    }

    public function IncreaseVoteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('VoteBundle:Project')->findOneBy(array('id' =>$id));

        $nbvote = $project->getNbVote();

        //Verification di le user a deja voté
        $vote = $this->checkVote($id);

        if ($vote)
            $this->get('session')->getFlashBag()->add(
                                'notice',
                                'Vous avez deja voté'
                            );
        else {
        $project->setNbVote($project->getNbVote() + 1);

        $em->persist($project);

        $vot = new Vote();
        $vot->setUtilisateur($this->getUser());
        $vot->setProject($project);
        $em->persist($vot);



        $em->flush();
    }
        return $this->redirect($this->generateUrl('project'));
    }

    public function DecreaseVoteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('VoteBundle:Project')->findOneBy(array('id' =>$id));

        $nbvote = $project->getNbVote();
         $vote = $this->checkVote($id);

                if ($vote)
                    $this->get('session')->getFlashBag()->add(
                                        'notice',
                                        'Vous avez deja voté'
                                    );
                else {
        if($nbvote == 0){
         $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Vous ne pouvez avoir de vote negatif'
                );
            $this->createNotFoundException('Vous ne pouvez avoir de vote negatif');
            }else{
        $project->setNbVote($project->getNbVote() - 1);

        $em->persist($project);
        $em->flush();
}
}
        return $this->redirect($this->generateUrl('project'));
    }

    public function checkVote($id)
    {
        $em = $this->getDoctrine()->getManager();
        $vote = $em->getRepository('VoteBundle:Vote')->findOneBy(array('project' => $id, 'utilisateur' => $this->getUser()));

        return $vote;
    }
}