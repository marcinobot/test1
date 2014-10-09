<?php

namespace Cheese\Bundle\MainBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Description of User
 * repositoryClass="Cheese\Bundle\MainBundle\Entity\UserRepository")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="test_user")
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=500)
     * 
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;
    
    /**
     * @var integer
     * @ORM\Column(name="dob", type="integer")
     * 
     * @Assert\NotBlank()
     * @Assert\Type(type="numeric")
     * @Assert\Range(
     *      min = 18,
     *      max = 100    
     * )
     */
    protected $dateOfBirth;
    
    /**
     * @var string
     * @ORM\Column(name="account", type="string", length=34)
     * 
     * @Assert\NotBlank()
     * @Assert\Type(type="numeric")
     * @Assert\Length(
     *      min = 8,
     *      max = 34    
     * )
     */
    protected $accountNumber;
    
    /**
     * @var integer
     * @ORM\Column(name="visits", type="integer", options={"default" = 1})
     */
    protected $visits;
    
    /**
     * @var string
     * @ORM\Column(name="reference", type="string", length=15, nullable=true)
     */
    protected $referenceNumber;

    public function __construct($email='', $dob='', $accountNumber='')
    {
        $this->email = $email;
        $this->dateOfBirth = $dob;
        $this->accountNumber = $accountNumber;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getVisits()
    {
        return $this->visits;
    }

    public function setVisits($visits)
    {
        $this->visits = $visits;
        return $this;
    }
    
    public function visit()
    {
        $this->visits++; 
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }
    
    /**
     * @ORM\PostPersist
     * @ORM\PostUpdate
     */
    public function onPrePersist(\Doctrine\ORM\Event\LifecycleEventArgs $e)
    {
        $accountPrefix = substr($this->accountNumber, 0, 4);
        $this->referenceNumber = $accountPrefix . '-' . $e->getEntity()->getId(); 
        $e->getEntityManager()->flush();
    }
    
}
