<?php

namespace App\Controller;

use App\Entity\Comentarios;
use App\Entity\Posts;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(PaginatorInterface $paginator,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
            $query = $em->getRepository(Posts::class)->BuscarTodosLosPosts();
            //$comentarios = $em->getRepository(Comentarios::class)->BuscarComentarios($user->getId());//Consulto los comentarios con el id del
            $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
            );
    
            return $this->render('dashboard/index.html.twig', [
                'pagination' => $pagination
            ]);
        //$user = $this->getUser(); //OBTENGO AL USUARIO ACTUALMENTE LOGUEADO
        

    }
}
