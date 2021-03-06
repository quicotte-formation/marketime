<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;
    
    /**
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn
     */
    private $userEmitter;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn
     */
    private $userReceiver;
    
    

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
     * Set amount
     *
     * @param integer $amount
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set userEmitter
     *
     * @param \MainBundle\Entity\User $userEmitter
     * @return Payment
     */
    public function setUserEmitter(\MainBundle\Entity\User $userEmitter = null)
    {
        $this->userEmitter = $userEmitter;

        return $this;
    }

    /**
     * Get userEmitter
     *
     * @return \MainBundle\Entity\User 
     */
    public function getUserEmitter()
    {
        return $this->userEmitter;
    }

    /**
     * Set userReceiver
     *
     * @param \MainBundle\Entity\User $userReceiver
     * @return Payment
     */
    public function setUserReceiver(\MainBundle\Entity\User $userReceiver = null)
    {
        $this->userReceiver = $userReceiver;

        return $this;
    }

    /**
     * Get userReceiver
     *
     * @return \MainBundle\Entity\User 
     */
    public function getUserReceiver()
    {
        return $this->userReceiver;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Payment
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }
}
