<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\UserRepository")
 */
class User
{
    const ROLE_USER = "ROLE_USER";
    const ROLE_ADMIN = "ROLE_ADMIN";
    const ROLE_MODERATOR = "ROLE_MODERATOR";
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=32, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=32)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="userEmitter")
     */
    private $messagesSent;
    
    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="userReceiver")
     */
    private $messagesReceived;

    /**
     * @ORM\OneToMany(targetEntity="Ad", mappedBy="user")
     */
    private $ads;
    
    /**
     * ORM\OneToMany(targetEntity="Payment", mappedBy="userEmitter")
     */
    private $paymentsSent;
    
    /**
     * ORM\OneToMany(targetEntity="Payment", mappedBy="userReceiver")
     */
    private $paymentsReceived;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messagesSent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->messagesReceived = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add messagesSent
     *
     * @param \MainBundle\Entity\Message $messagesSent
     * @return User
     */
    public function addMessagesSent(\MainBundle\Entity\Message $messagesSent)
    {
        $this->messagesSent[] = $messagesSent;

        return $this;
    }

    /**
     * Remove messagesSent
     *
     * @param \MainBundle\Entity\Message $messagesSent
     */
    public function removeMessagesSent(\MainBundle\Entity\Message $messagesSent)
    {
        $this->messagesSent->removeElement($messagesSent);
    }

    /**
     * Get messagesSent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessagesSent()
    {
        return $this->messagesSent;
    }

    /**
     * Add messagesReceived
     *
     * @param \MainBundle\Entity\Message $messagesReceived
     * @return User
     */
    public function addMessagesReceived(\MainBundle\Entity\Message $messagesReceived)
    {
        $this->messagesReceived[] = $messagesReceived;

        return $this;
    }

    /**
     * Remove messagesReceived
     *
     * @param \MainBundle\Entity\Message $messagesReceived
     */
    public function removeMessagesReceived(\MainBundle\Entity\Message $messagesReceived)
    {
        $this->messagesReceived->removeElement($messagesReceived);
    }

    /**
     * Get messagesReceived
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessagesReceived()
    {
        return $this->messagesReceived;
    }

    /**
     * Add ads
     *
     * @param \MainBundle\Entity\Ad $ads
     * @return User
     */
    public function addAd(\MainBundle\Entity\Ad $ads)
    {
        $this->ads[] = $ads;

        return $this;
    }

    /**
     * Remove ads
     *
     * @param \MainBundle\Entity\Ad $ads
     */
    public function removeAd(\MainBundle\Entity\Ad $ads)
    {
        $this->ads->removeElement($ads);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAds()
    {
        return $this->ads;
    }
    
    public function __toString() {
        
        return $this->email;
    }
}
