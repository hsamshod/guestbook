<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends Controller
{
    /**
     * @Route("comments/store", name="comments.store", methods={"POST"})
     */
    public function storeAction(Request $request)
    {
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* @var \AppBundle\Entity\Comment $comment */
            $comment = $form->getData();
            $comment->setIp($request->getClientIp());
            $comment->setBrowser($request->headers->get('User-Agent'));

            try {
                $this->getDoctrine()->getRepository(Comment::class)->store($comment);
                $this->addFlash('success', 'Comment saved');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Something went wrong!');
            }
        } else {
            $this->addFlash('danger', (string)$form->getErrors(true));
        }

        return $this->redirectToRoute('home');
    }
}
