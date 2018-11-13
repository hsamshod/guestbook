<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GuestBookController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $comment_repo = $this->getDoctrine()->getRepository(Comment::class);

        $paginator = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions($comment_repo->getPaginationOptions());

        try {
            $comments_pager = $paginator->paginate(
                                    $comment_repo->createQueryBuilder('c'),
                                    $request->query->getInt('page', 1),
                                    25
                              );
        } catch (\Exception $e) {
            $comments_pager = null;
        }

        return $this->render('AppBundle:GuestBook:index.html.twig', [
            'comments_pager' => $comments_pager,
            'form' => $this->createForm(CommentType::class)->createView(),
        ]);
    }
}
