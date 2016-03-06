<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Message;
use MainBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use DateTime;

/**
 * Message controller.
 *
 * @Route("/message")
 */
class MessageController extends Controller
{
    /**
     * Lists all Message entities.
     *
     * @Route("/", name="message_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        // Finds users in session
        $userId = (new Session())->get('userLogged')->getId();
        
        // Gets all unread messages
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('MainBundle:Message');
        $messagesReceived = $repository->findMessages(null, $userId, null);
        $messagesSent = $repository->findMessages($userId, null, null);

        return $this->render('message/index.html.twig', array(
            'messagesReceived' => $messagesReceived,
            'messagesSent' => $messagesSent
        ));
    }

    /**
     * Creates a new Message entity.
     *
     * @Route("/new", name="message_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $message = new Message();
        $form = $this->createForm('MainBundle\Form\MessageType', $message);
        $form->handleRequest($request);

        // Save the message as emitted by user in session with creation date now
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $session = new Session();
            $user = $em->find(User::class, $session->get('userLogged')->getId());
            $user->addMessagesSent( $message );
            $message->setUserEmitter($user);
            $message->setCreateDatetime( new DateTime() );
            $message->setRead(false);
            
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('message_show', array('id' => $message->getId()));
        }

        return $this->render('message/new.html.twig', array(
            'message' => $message,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Message entity.
     *
     * @Route("/{id}", name="message_show")
     * @Method("GET")
     */
    public function showAction(Message $message)
    {
        $deleteForm = $this->createDeleteForm($message);

        return $this->render('message/show.html.twig', array(
            'message' => $message,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Message entity.
     *
     * @Route("/{id}/edit", name="message_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Message $message)
    {
        $deleteForm = $this->createDeleteForm($message);
        $editForm = $this->createForm('MainBundle\Form\MessageType', $message);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('message_edit', array('id' => $message->getId()));
        }

        return $this->render('message/edit.html.twig', array(
            'message' => $message,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Message entity.
     *
     * @Route("/{id}", name="message_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Message $message)
    {
        $form = $this->createDeleteForm($message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('message_index');
    }

    /**
     * Creates a form to delete a Message entity.
     *
     * @param Message $message The Message entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Message $message)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('message_delete', array('id' => $message->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
