<?php

namespace Cheese\Bundle\MainBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of User
 * @ORM\Table(name="test_user")
 * @ORM\Entity(repositoryClass="Cheese\Bundle\MainBundle\Entity\UserRepository")
 * @author marcin
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
     * @var integer
     * @ORM\Column(name="account", type="integer")
     * 
     * @Assert\NotBlank()
     * @Assert\Type(type="numeric")
     * @Assert\Length(
     *      min = 8,
     *      max = 34    
     * )
     */
    protected $accountNumber;

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
}
