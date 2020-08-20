<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use DateInterval;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CasheFiltersController extends AbstractController
{
    /**
     * @var ArticleRepository
     */
    private $repository;
    /**
     * @var AdapterInterface
     */
    private $cache;

    public function __construct(ArticleRepository  $repository,AdapterInterface $cache)
    {

        $this->repository = $repository;
        $this->cache = $cache;
    }
    //*************************************************************
    //************            Articles List             ***********
    //*************************************************************
    /**
     * @Route("/cashe/filters", name="cashe_filters")
     * @param Request $request
     * @return Response
     * @throws InvalidArgumentException
     */
    public function articleList(Request $request):Response
    {
        $cacheKey = 'thisIsACacheKey';
        $item = $this->cache->getItem($cacheKey);
        $cashItems=$item->get();
        if ($item->isHit()) {
            $articles = $cashItems['articles'] ? $cashItems['articles'] : null;
            $enabledArticles = $cashItems['enabledArticles'] ? $cashItems['enabledArticles'] : null;
            if ($request->isMethod('POST')) {
                $start=$request->get("form")["start"]-1;
                $end  =$request->get("form")["end"]+1   ;
                $articleList = array_slice($articles, $start, $end);
            }
        }

        $formBuilder=self::FormMaker();
        $form = $formBuilder->getForm();
        if (!$item->isHit()) {
            $articles=$this->repository->articlesPerPageNoFilter();
            $enabledArticles=$this->repository->enabledArticles();
            //********************************************************
            $articleList=null;
            if ($request->isMethod('POST')) {
                $start=$request->get("form")["start"]-1;
                $end  =$request->get("form")["end"]+1;
                $articleList=$this->repository->articlesPerPageNoFilter($end,$start);
            }
            //********************************************************
            $item->set(['articles' => $articles,'enabledArticles' => $enabledArticles,'articleList' => $articleList]);
            $item->expiresAfter(new DateInterval('PT60S')); // the item will be cached for 10 seconds
            $this->cache->save($item);
        }

        unset($formBuilder);
        return $this->render('cashe_filters/index.html.twig', [
            'articles' => $articles,
            'list' => $articleList,
            'enabledArticles' => $enabledArticles,
            'form' => $form->createView()
        ]);
    }


    /**
     * @return FormInterface
     */
    public function changeFormName()
    {
        // Rename the form   ==>   https://stackoverflow.com/a/37009914/10212386
        $formFactory = $this->get('form.factory');
       return $formFactory = $formFactory->createNamed('ArticleList');
        //$formFactory = $formFactory->createNamedBuilder('ArticleList');
    }


    /**
     * @return FormBuilderInterface
     */
    public function FormMaker(): FormBuilderInterface
    {
        $attr=['style' => 'width: 160px', 'autofocus' => true, 'min' => 1, 'max' => 1000,'placeholder' => 'Entrer un Id'];
        $formBuilder=$this->createFormBuilder();
        return $formBuilder
            ->add('start',IntegerType::class,[
                'help' => 'The start code for your search filter.',
                //'disabled' => true, 'data' => '2',
                'label' =>'item Start',
                'label_attr' => ['style' => "color:#467BFE;border:2px solid #467BFE;border-radius: 25% 10%;padding:1px;width:100px;text-align:center"],
                'attr' => $attr
            ])
            ->add('end',IntegerType::class,[
                'help' => 'The end code for your search filter.',
                'label' =>'item End',
                'label_attr' => ['style' => "color:#467BFE;border:2px solid #467BFE;border-radius: 25% 10%;padding:1px;width:100px;text-align:center"],
                'attr' => $attr
            ])
            ->add('search', SubmitType::class,[
                'attr' => [
                    'style' => 'width: 120px',
                ]]);
    }
    
    /**
     * @param string $no1
     * @param int $no2
     * @param string $no3
     * @return int|string
     */

    function calculateNumbers(string $no1,int $no2,string $no3):string
    {
        return $no1.$no2.$no3;
    }

    // execute the calculateNumbers function as Splat Operator (...)
    //  $res = $this->calculateNumbers(...$numbers);
    //  dump($res);
    //  die;


}
