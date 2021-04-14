<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Form\AutoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AutoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

     /**
     * 
     *@Route("/add", name="app_add")
     */
    public function add(Request $request){// Obligatoire Pour recupere et traiter le formulaire

        
        $car = new Auto();
        
        $form = $this->createForm(AutoType::class, $car);//Pas e builder puisqu'il est deja construit autotype est bindé lié à $car
       
        $form->handleRequest($request); //on recupere le request pour le lié
       
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
                $em->persist($car);
                $em->flush();
                

                $this->addFlash('success', 'Voiture enregistrée');
                return $this->redirectToRoute("app_list");
            }
        // $auto1 = new Auto();
        
        // $auto1->setMarque("Peugeot");
        // $auto1->setModele("5008");
        // $auto1->setPays("France");
        // $auto1->setPrix(2200);
        // $auto1->setDescription("Peugeot 5008 est une voiture résistante");

        // $auto2 = new Auto();
        
        // $auto2->setMarque("Renault");
        // $auto2->setModele("Megane");
        // $auto2->setPays("Suisse");
        // $auto2->setPrix(5400);
        // $auto2->setDescription("Renault Mégane 5008 est une belle voiture");

       

        // $em->persist($auto1);// il prepare l'objet equivalente, regarde si tout est ok 
        // $em->persist($auto2);

        //$em->flush();// il execute la requete dans la base de donnée et on aura une ligne de plus dans la base de donne

       // return new Response("Voitures ajoutées!!!");
       
       return $this->render('admin/add.html.twig', [
        'form'=> $form->createView() ]);
    }

    /**
     * 
     *@Route("/list", name="app_list")
     */
    public function getAutos(){

        $repo = $this->getDoctrine()->getRepository(Auto::class);
        $cars = $repo->findAll();
       // dd($cars); //dump et die

       return $this->render("admin/list.html.twig", ["tabCars" => $cars]);
    }
    
    /**
     * 
     *@Route("/edit/{id}", name="app_edit")
     */
    // public function editAuto($id, AutoRepository $autoRepo){// ou 2eme methode on appelle directement le repository
    //     // $car = $this->getDoctrine()->getRepository(Auto::class)->find($id);// 1er methode
    //     $car = $autoRepo->find($id);//2eme methode

    //     dd($car);
    //     return;

    // }
    public function editAuto(Auto $car, Request $request, EntityManagerInterface $em){//3 eme grace a la route il sait qu'on veut un id, donc il envoie l'objet equivalent //le request c'est pour la modification
        // construire un formulaire lié à $car
       $form =  $this->createFormBuilder($car)
                    ->add('marque')
                    ->add('modele')
                    ->add('pays')
                    ->add('prix', NumberType::class)
                    ->add('description')
                    // ->add('Modifier', SubmitType::class)
                    ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $updateCar = $form->getData();
            // $em = $this->getDoctrine()->getManager(); //plus besoin de cette phrase si on ecrit entitymanager interface
            $em->flush();
            $this->addFlash('success', 'Voiture modifiéé');
            return $this->redirectToRoute("app_list");

        }
        //dd($car);
        return $this->render('admin/edit.html.twig',[

            'form_car'=> $form->createView(),//creer une vue correspondant a ce formulaire
             'car'=>$car
        ]);

    }

     /**
     * 
     *@Route("/delete/{id}", name="app_delete")
     */
    public function deleteAuto($id){
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository(Auto::class)-> find($id);
        if(!$car){
            throw $this->createNotFoundException(
                'Aucune voiture ne correspond a votre demande'
            );
        }
        $em->remove($car);
        $em->flush();
        
        $this->addFlash('success', 'Voiture supprimée');
        return $this->redirectToRoute("app_list");

    }
}
