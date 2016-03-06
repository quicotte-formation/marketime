<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\MessageRepository")
 */
class Message
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messagesSent")
     * @ORM\JoinColumn(name="useremitter_id")
     */
    private $userEmitter;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messagesReceived")
     * @ORM\JoinColumn(name="userreceiver_id")
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
     * Set title
     *
     * @param string $title
     * @return Message
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set userEmitter
     *
     * @param \MainBundle\Entity\User $userEmitter
     * @return Message
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
     * @return Message
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
}
