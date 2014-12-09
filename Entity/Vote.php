<?php

namespace GS\VoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity(repositoryClass="GS\VoteBundle\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="GS\UtilisateurBundle\Entity\Utilisateur", inversedBy="projects")
     * @ORM\JoinColumn(nullable=true)
     */

    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="GS\VoteBundle\Entity\Project")
     * @ORM\JoinColumn(nullable=false)
     */

    private $project;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set utilisateur
     *
     * @param \GS\UtilisateurBundle\Entity\Utilisateur $utilisateur
     * @return Vote
     */
    public function setUtilisateur(\GS\UtilisateurBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \GS\UtilisateurBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set project
     *
     * @param \GS\VoteBundle\Entity\Project $project
     * @return Vote
     */
    public function setProject(\GS\VoteBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \GS\VoteBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }
}
