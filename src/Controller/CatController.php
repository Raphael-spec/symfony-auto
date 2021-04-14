<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatController extends AbstractController
{
     /**
     * 
     *@Route("/add_cat", name="add_cat")
     */
    public function add(Request $request){// Obligatoire Pour recupere et traiter le formulaire

        
        $cat = new Categorie();
        
        $form = $this->createForm(CatType::class, $cat);//Pas e builder puisqu'il est deja construit autotype est bindé lié à $car
       
        $form->handleRequest($request); //on recupere le request pour le lié
       
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
                $em->persist($cat);
                $em->flush();
                

                $this->addFlash('success', 'Categorie enregistrée');
                return $this->redirectToRoute("list_cat");
            }
      
       
       return $this->render('cat/add_cat.html.twig', [
        'form'=> $form->createView() ]);
    }
    /**
     * 
     *@Route("/list_cat", name="list_cat")
     */
    public function getCats(){

        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $cats = $repo->findAll();
       // dd($cars); //dump et die

       return $this->render("cat/list_cat.html.twig", ["tabCats" => $cats]);
    }

      /**
     * 
     *@Route("/delete_cat/{id}", name="app_delete_cat")
     */
    public function deleteCat($id){
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Categorie::class)-> find($id);
        if(!$cat){
            throw $this->createNotFoundException(
                'Aucune categorie ne correspond a votre demande'
            );
        }
        $em->remove($cat);
        $em->flush();
        
        $this->addFlash('success', 'Categorie supprimée');
        return $this->redirectToRoute("list_cat");

    }
}
