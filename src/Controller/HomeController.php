<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use DateInterval;

class HomeController extends AbstractController
{
    /**
     * @var AdapterInterface
     */
    private $cache;
    /**
     * @var ArticleRepository
     */
    private $repository;
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * HomeController constructor.
     * @param AdapterInterface $cache
     * @param ArticleRepository $repository
     * @param KernelInterface $kernel
     */
    public function __construct(AdapterInterface $cache,ArticleRepository  $repository,KernelInterface $kernel)
    {
        $this->cache = $cache;
        $this->repository = $repository;
        $this->kernel = $kernel;
    }

    /**
     * @Route("/home", name="home")
     * @throws InvalidArgumentException
     */
    public function index():Response
    {
        $cacheKey = 'thisIsACacheKey';
        $item = $this->cache->getItem($cacheKey);

        $itemCameFromCache = true;
        if (!$item->isHit()) {
            $itemCameFromCache = false;
            $item->set('this is some data to cache');
            $item->expiresAfter(new DateInterval('PT10S')); // the item will be cached for 10 seconds
            $this->cache->save($item);
        }

        return $this->render('home/index.html.twig', [
            'isCached' => $itemCameFromCache ? 'true' : 'false',
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/chrono", name="chrono")
     */
    public function chrono():Response
        {
            return $this->render('home/chronometer.html.twig', []);
        }

    /**
     * @Route("article/{p<\d+>?1}", name="article" ,methods={"GET"})
     * @param Request $request
     * @return Response
     * @throws InvalidArgumentException
     */
    public function article(Request $request):Response
    {
        //TODO update this methode of cache managent and refactore it.
        $page = $request->get('p');
        $isValide=(isset($page) && is_numeric($page) && $page > 0);
        $currentPage= $isValide ? $page :  1;

        $cacheKey = 'thisIsACacheKey';
        $item = $this->cache->getItem($cacheKey);

        if (!$item->isHit()) {
//            dump('create');
            $cacheItems=$this->getPaginateElements($currentPage,$page);
            $cacheItems=array_merge($cacheItems,['page' => $page]);
            $item->set($cacheItems);
            $item->expiresAfter(new DateInterval('PT30S')); // the item will be cached for 10 seconds
            $this->cache->save($item);
        }else{
//            dump('get');
            $cacheItems=$item->get();
            unset($cacheItems['page']);
            unset($cacheItems['StartFrom']);
            unset($cacheItems['next']);
            unset($cacheItems['previous']);
            unset($cacheItems['articles']);
            $cacheItems=array_merge($cacheItems,['page' => $page]);
            $cacheItems=array_merge($cacheItems,['StartFrom' => ($page>0) ? ($page*10)-9: $page=1]);
            $cacheItems=array_merge($cacheItems,['next' => ($page+1)]);
            $cacheItems=array_merge($cacheItems,['previous' => ($page-1)]);
            $cacheItems=$this->getPaginateElements($currentPage,$page);

        }

        dump($cacheItems);
        return $this->render('article/index.html.twig', ['articles' => $cacheItems['articles'], 'nbPages' => $cacheItems['nbPages'],
            'next' =>  $cacheItems['next'],'previous' =>  $cacheItems['previous'], 'page' => (integer)$page]);
    }

    /**
     * @param int $currentPage
     * @param int $page
     * @return array
     */
    public function getPaginateElements(int $currentPage,int $page):array
    {
        $nbrArt=count($this->repository->articlesPerPageNoFilter());
        $limit=10;
        $nbPages = (int)ceil($nbrArt / $limit);
        for ($i = 1; $i <= $nbPages; $i++) {
            $allPages[$i]=$i;
        }
        $StartFrom=($currentPage-1)*$limit;
        $next=$page+1;
        $previous=$page-1;
        $articles=$this->repository->articlesPerPageNoFilter($limit,$StartFrom);
        return compact('nbrArt','limit','nbPages','StartFrom','next','previous','articles','allPages');
    }

















    //***************************************************************
    //**********     Articles List Pagination optimized    **********
    //***************************************************************

//    /**
//     * @Route("article/{p<\d+>?1}", name="article" ,methods={"GET"})
//     * @param Request $request
//     * @return Response
//     */
//    public function article(Request $request):Response
//    {
//        $page = $request->get('p');
//        $isValide=(isset($page) && is_numeric($page) && $page > 0);
//        $currentPage= $isValide ? $page :  1;
//        $cacheItems=$this->getPaginateElements($currentPage,$page);
//
//        return $this->render('article/index.html.twig', ['articles' => $cacheItems['articles'], 'nbPages' => $cacheItems['nbPages'],
//            'next' =>  $cacheItems['next'],'previous' =>  $cacheItems['previous'], 'page' => (integer)$page]);
//    }
//
//    /**
//     * @param int $currentPage
//     * @param int $page
//     * @return array
//     */
//    public function getPaginateElements(int $currentPage,int $page):array
//    {
//        $nbrArt=count($this->repository->articlesPerPageNoFilter());
//        $limit=10;
//        $nbPages = (int)ceil($nbrArt / $limit);
////        for ($i = 1; $i <= $nbPages; $i++) {
////            $inArray[$i]=$i;
////        }
//        $StartFrom=($currentPage-1)*$limit;
//        $next=$page+1;
//        $previous=$page-1;
//        $articles=$this->repository->articlesPerPageNoFilter($limit,$StartFrom);
//        return compact('nbrArt','limit','nbPages','StartFrom','next','previous','articles');
//    }


    //*************************************************************
    //************    Articles List Pagination (1)    *************
    //*************************************************************
    /**
     * @Route("articles/{p<\d+>?1}", name="articles" ,methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function articles(Request $request):Response
    {
        // lien de tuto  https://www.youtube.com/watch?v=dYMi89K1Bsg
        // Récupérer le numéro de la page
        $page = $request->get('p');
        // Vérifier si le numéro de la page exist et un entier a=et supérieur à 0
        $isValide=(isset($page) && is_numeric($page) && $page > 0);
        $currentPage= $isValide ? $page :  1;

        // le nombre d'article dans la Base se donner
        $nbrArt=count($this->repository->articlesPerPage());

        // nombre de colonne afficher dans chaque page
        $limit=10;

        // le nombre des page quand peux afficher de la base de donnée
        $nbPages = (int)ceil($nbrArt / $limit);

        // le 1ere id de la page suivante ou il va commencé le comptage
        $StartFrom=($currentPage-1)*$limit;
        $next=$page+1;
        $previous=$page-1;
        $articles=$this->repository->articlesPerPage($limit,$StartFrom);
        return $this->render('article/articles.html.twig', ['articles' => $articles, 'nbPages' => $nbPages, 'next' =>  $next,'previous' =>  $previous, 'page' => (integer)$page
        ]);
    }

    //*************************************************************
    //************     Articles List Pagination (2)     ***********
    //*************************************************************
    /**
     * @Route("list/{p<\d+>?1}", name="list" ,methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function articleList(Request $request):Response
    {
        $page = (integer) $request->get('p');
        $isValide=(isset($page) && is_numeric($page) && $page > 0);
        $currentPage= $isValide ? $page :  1;
        $nbrArt=count($this->repository->articlesPerPageNoFilter());
        $limit=10;
        $nbPages = (int)ceil($nbrArt / $limit);
        $StartFrom=($currentPage-1)*$limit;
        $next=$page+1;
        $previous=$page-1;
        $list=$this->repository->articlesPerPageNoFilter($limit,$StartFrom);

        return $this->render('article/list.html.twig',compact('list','nbPages' , 'next', 'previous' , 'page'));
    }


    //*************************************************************
    //************         Create New Article         *************
    //*************************************************************
    /**
     * @Route("/create", name="create-article")
     * @param Request $request
     * @return Response
     */
    public function createArticle(Request $request)
        {
            //TODO implement Event OnCreateArticle
            // Exemple : https://github.com/symfony/demo/blob/master/src/EventSubscriber/CommentNotificationSubscriber.php
            // Exemple : https://github.com/symfony/demo/blob/master/src/Event/CommentCreatedEvent.php
            // Exemple : https://github.com/symfony/demo/blob/master/src/Controller/BlogController.php    déclencher l'évent page:114
            $article=new Article();
            $form=$this->createForm(ArticleType::class,$article);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                //return $this->redirect($this->generateUrl('article'));
                return $this->redirectToRoute('article');
            }

            return $this->render('article/new.html.twig', [
                'form' => $form->createView()
            ]);
        }


     //*************************************************************
     //************       Environment  Variables       *************
     //*************************************************************

    /**
     * @Route("/vars", name="vars")
     */
    public function EnvironmentVariables(): Response
    {
        dump(isset($this));              //true,   $this exists
        dump(gettype($this));            //Object, $this is an object
        dump(is_array($this));           //false,  $this isn't an array
        dump(get_object_vars($this));    //true,   $this's variables are an array
        dump(is_object($this));          //true,   $this is still an object
        dump(get_class($this));          //YourProject\YourFile\YourClass
        dump(get_parent_class($this));   //YourBundle\YourStuff\YourParentClass
        dump(gettype($this->container)); //object
        dump(($this));                  //delicious data dump of $this
        dump($this->kernel);
        dump($this->kernel->getProjectDir());
        dump($this->getParameter('kernel.project_dir'));
        dump($this->get('http_kernel'));
        die;

        return new Response('Environment Variables');
    }

}