<?php
    namespace App\Controller;

    use App\Entity\Budynki;
    use App\Entity\Osoby;
    use App\Entity\ObiektyNajmu;
    use App\Entity\Spoldzielnie;
    use App\Entity\Umowy;
    use App\Entity\Wyposazenie;
    use App\Entity\Zwierzeta;

    use Doctrine\ORM\EntityRepository;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use App\Form\BudynkiFormType;
    use App\Form\OsobyFormType;
    use App\Form\ObiektyNajmuFormType;
    use App\Form\SpoldzielnieFormType;
    use App\Form\UmowyFormType;
    use App\Form\WyposazenieFormType;
    use App\Form\ZwierzetaFormType;
    use Doctrine\ORM\EntityManagerInterface;

    class MenuController extends AbstractController {
        /*
         * @Route("/", name="main_menu")
         */
        public function index() {
            return $this->render('menu.html.twig');
        }

        /**
         * @Route("/WyswietlUmowy", name="showUmowy")
         * @Method({"GET"})
         */
        public function showUmowy(){
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findAll();
            return $this->render('showUmowy.html.twig', array('umowy' => $umowy));
        }

        /**
         * @Route("/WyswietlObiektyNajmu", name="showObiektyNajmu")
         * @Method({"GET"})
         */
        public function showObiektyNajmu(){
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->findAll();
            return $this->render('showObiektyNajmu.html.twig', array('obiektynajmu' => $obiektynajmu));
        }

        /**
         * @Route("/WyswietlOsoby", name="showOsoby")
         * @Method({"GET"})
         */
        public function showOsoby(){
            $osoby = $this->getDoctrine()->getRepository(Osoby::class)->findAll();
            return $this->render('showOsoby.html.twig', array('osoby' => $osoby));
        }

        /**
         * @Route("/WyswietlSpoldzielnie", name="showSpoldzielnie")
         * @Method({"GET"})
         */
        public function showSpoldzielnie(){
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->findAll();
            return $this->render('showSpoldzielnie.html.twig', array('spoldzielnie' => $spoldzielnie));
        }

        /**
         * @Route("/WyswietlBudynki", name="showBudynki")
         * @Method({"GET"})
         */
        public function showBudynki(){
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->findAll();
            return $this->render('showBudynki.html.twig', array('budynki' => $budynki));
        }

        /**
         * @Route("/WyswietlWyposazenie", name="showWyposazenie")
         * @Method({"GET"})
         */
        public function showWyposazenie(){
            $wyposazenie = $this->getDoctrine()->getRepository(Wyposazenie::class)->findAll();
            return $this->render('showWyposazenie.html.twig', array('wyposazenie' => $wyposazenie));
        }

        /**
         * @Route("/WyswietlZwierzeta", name="showZwierzeta")
         * @Method({"GET"})
         */
        public function showZwierzeta(){
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->findAll();
            return $this->render('showZwierzeta.html.twig', array('zwierzeta' => $zwierzeta));
        }

        /**
         * @Route("/WyswietlUmowy/{id}", name="showdetailedUmowy")
         */
        public function showdetailedUmowy($id){
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->find($id);
            $lokatorzy = $this->getDoctrine()->getRepository(Osoby::class)->find($umowy->getLokator());
            $wynajmujacy = $this->getDoctrine()->getRepository(Osoby::class)->find($umowy->getWynajmujacy());
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($umowy->getMieszkanie());
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->findby(array('Id_umowy' => $umowy->getId()));
            return $this->render('showdetailedUmowy.html.twig', array('umowy' => $umowy, 'lokatorzy' => $lokatorzy,  'wynajmujacy' => $wynajmujacy, 'obiektynajmu' => $obiektynajmu, 'zwierzeta' => $zwierzeta));
        }

        /**
         * @Route("/WyswietlUmowy/delete/{id}", name="deleteUmowy")
         * @Method({"DELETE"})
         */
        public function deleteUmowy(Request $request, $id) {
            $umowa = $this->getDoctrine()->getRepository(Umowy::class)->find($id);
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->findBy(array('Id_umowy' => $umowa->getId()));
            
            if(count($zwierzeta) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z innymi! Nie możesz go usunąć.');
                return $this->redirectToRoute('showUmowy');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($umowa);
            $entityManager->flush();
  
            return $this->redirectToRoute('showUmowy');
        }

        /**
         * @Route("/WyswietlObiektyNajmu/{id}", name="showdetailedObiektyNajmu")
         */
        public function showdetailedObiektyNajmu($id){
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($id);
            $budynek = $this->getDoctrine()->getRepository(Budynki::class)->find($obiektynajmu->getAdres());
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->find($budynek->getNazwa());
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->find($obiektynajmu->getNrMieszkania());
            $wyposazenia = $this->getDoctrine()->getRepository(Wyposazenie::class)->findBy(array('Mieszkanie' => $obiektynajmu->getNrMieszkania()));
            return $this->render('showdetailedObiektyNajmu.html.twig', array('obiektynajmu' => $obiektynajmu, 'budynek' => $budynek,  'spoldzielnie' => $spoldzielnie, 'umowy' => $umowy, 'wyposazenia' => $wyposazenia));
        }

        /**
         * @Route("/WyswietlOsoby/{id}", name="showdetailedOsoby")
         */
        public function showdetailedOsoby($id){
            $osoby = $this->getDoctrine()->getRepository(Osoby::class)->find($id);
            $umowylokator = $this->getDoctrine()->getRepository(Umowy::class)->findby(array('Lokator' => $osoby->getPESEL()));
            $umowywynajmujacy = $this->getDoctrine()->getRepository(Umowy::class)->findby(array('Wynajmujacy' => $osoby->getPESEL()));
            return $this->render('showdetailedOsoby.html.twig', array('osoby' => $osoby, 'umowylokator' => $umowylokator,  'umowywynajmujacy' => $umowywynajmujacy));
        }

        /**
         * @Route("/WyswietlZwierzeta/{id}", name="showdetailedZwierzeta")
         */
        public function showdetailedZwierzeta($id){
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->find($id);
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->find($zwierzeta->getIdUmowy());
            return $this->render('showdetailedZwierzeta.html.twig', array('zwierzeta' => $zwierzeta, 'umowy' => $umowy));
        }

        /**
         * @Route("/WyswietlSpoldzielnie/{id}", name="showdetailedSpoldzielnie")
         */
        public function showdetailedSpoldzielnie($id){
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->find($id);
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->findby(array('Nazwa' => $spoldzielnie->getNazwa()));
            return $this->render('showdetailedSpoldzielnie.html.twig', array('spoldzielnie' => $spoldzielnie, 'budynki' => $budynki));
        }

        /**
         * @Route("/WyswietlWyposazenie/{id}", name="showdetailedWyposazenie")
         */
        public function showdetailedWyposazenie($id){
            $wyposazenie = $this->getDoctrine()->getRepository(Wyposazenie::class)->find($id);
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($wyposazenie->getMieszkanie());
            return $this->render('showdetailedWyposazenie.html.twig', array('wyposazenie' => $wyposazenie, 'obiektynajmu' => $obiektynajmu));
        }

        /**
         * @Route("/WyswietlBudynki/{id}", name="showdetailedBudynki")
         */
        public function showdetailedBudynki($id){
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->find($id);
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->find($budynki->getNazwa());
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->findby(array('Adres' => $spoldzielnie->getAdres()));
            return $this->render('showdetailedBudynki.html.twig', array('budynki' => $budynki, 'spoldzielnie' => $spoldzielnie, 'obiektynajmu' => $obiektynajmu));
        }

                 /**
         * @Route("/WyswietlOsoby/delete/{id}", name="deleteUmowy")
         * @Method({"DELETE"})
         */
        public function deleteOsoby(Request $request, $id) {
            $osoby = $this->getDoctrine()->getRepository(Osoby::class)->find($id);
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Lokator' => $osoby->getPESEL()));
            
            if(count($umowy) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z innymi! Nie możesz go usunąć.');
                return $this->redirectToRoute('showOsoby');
            }

            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Wynajmujacy' => $osoby->getPESEL()));
            
            if(count($umowy) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z innymi! Nie możesz go usunąć.');
                return $this->redirectToRoute('showOsoby');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($osoby);
            $entityManager->flush();
  
            return $this->redirectToRoute('showOsoby');
        }

        /**
         * @Route("/WyswietlObiektyNajmu/delete/{id}", name="deleteObiektyNajmu")
         * @Method({"DELETE"})
         */
        public function deleteObiektyNajmu(Request $request, $id) {
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($id);
            $wyposazenia = $this->getDoctrine()->getRepository(Wyposazenie::class)->findBy(array('Mieszkanie' => $obiektynajmu->getMieszkanie()));

            if(count($wyposazenia) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z innymi! Nie możesz go usunąć.');
                return $this->redirectToRoute('showObiektyNajmu');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($obiektynajmu);
            $entityManager->flush();
  
            return $this->redirectToRoute('showObiektyNajmu');
        }

        /**
         * @Route("/WyswietlBudynki/delete/{id}", name="deleteBudynki")
         * @Method({"DELETE"})
         */
        public function deleteBydynki(Request $request, $id) {
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->find($id);
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->findBy(array('Adres' => $budynki->getAdres()));

            if(count($obiektynajmu) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z innymi! Nie możesz go usunąć.');
                return $this->redirectToRoute('showBudynki');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($budynki);
            $entityManager->flush();
  
            return $this->redirectToRoute('showBudynki');
        }

        /**
         * @Route("/WyswietlSpoldzielnie/delete/{id}", name="deleteSpoldzielnie")
         * @Method({"DELETE"})
         */
        public function deleteSpoldzielnie(Request $request, $id) {
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->find($id);
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->findBy(array('Nazwa' => $spoldzielnie->getNazwa()));

            if(count($budynki) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z innymi! Nie możesz go usunąć.');
                return $this->redirectToRoute('showSpoldzielnie');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spoldzielnie);
            $entityManager->flush();
  
            return $this->redirectToRoute('showSpoldzielnie');
        }

        /**
         * @Route("/WyswietlWyposazenie/delete/{id}", name="deleteWyposazenie")
         * @Method({"DELETE"})
         */
        public function deleteWyposazenie(Request $request, $id) {
            $wyposazenie = $this->getDoctrine()->getRepository(Wyposazenie::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wyposazenie);
            $entityManager->flush();
  
            return $this->redirectToRoute('showWyposazenie');
        }

        /**
         * @Route("/WyswietlZwierzeta/delete/{id}", name="deleteZwierzeta")
         * @Method({"DELETE"})
         */
        public function deleteZwierzeta(Request $request, $id) {
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($zwierzeta);
            $entityManager->flush();
  
            return $this->redirectToRoute('showZwierzeta');
        }

        /**
         * @Route("/NowaOsoba", name="newOsoba")
         * @Method({"GET", "POST"})
         */
        public function newOsoba(EntityManagerInterface $em, Request $request){

            $form = $this->createForm(OsobyFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $osoby = $form->getData();

                $em->persist($osoby);
                $em->flush();
            }
            
            return $this->render('new.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/NowyBudynek", name="newBudynek")
         * @Method({"GET", "POST"})
         */
        public function newBudynek(EntityManagerInterface $em, Request $request){

            $form = $this->createForm(BudynkiFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $budynek = $form->getData();

                $em->persist($budynek);
                $em->flush();
            }
            
            return $this->render('new.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/NowyObiektNajmu", name="newObiektNajmu")
         * @Method({"GET", "POST"})
         */
        public function newObiektNajmu(EntityManagerInterface $em, Request $request){

            $form = $this->createForm(ObiektyNajmuFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $obiektnajmu = $form->getData();

                $em->persist($obiektnajmu);
                $em->flush();
            }
            
            return $this->render('new.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/NowaSpoldzielnia", name="newSpoldzielnia")
         * @Method({"GET", "POST"})
         */
        public function newSpoldzielnia(EntityManagerInterface $em, Request $request){

            $form = $this->createForm(SpoldzielnieFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $spoldzielnie = $form->getData();

                $em->persist($spoldzielnie);
                $em->flush();
            }
            
            return $this->render('new.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/NowaUmowa", name="newUmowa")
         * @Method({"GET", "POST"})
         */
        public function newUmowa(EntityManagerInterface $em, Request $request){

            $form = $this->createForm(UmowyFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $umowy = $form->getData();

                $em->persist($umowy);
                $em->flush();
            }
            
            return $this->render('new.html.twig', array('form' => $form->createView()));
        }

        /**
         * @Route("/NoweWyposazenie", name="newWyposazenie")
         * @Method({"GET", "POST"})
         */
        public function newWyposazenie(EntityManagerInterface $em, Request $request){

            $form = $this->createForm(WyposazenieFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $wyposazenie = $form->getData();

                $em->persist($wyposazenie);
                $em->flush();
            }
            
            return $this->render('new.html.twig', array('form' => $form->createView()));
        }
        
        /**
         * @Route("/NoweZwierze", name="newZwierze")
         * @Method({"GET", "POST"})
         */
        public function newZwierze(EntityManagerInterface $em, Request $request){

            $form = $this->createForm(ZwierzetaFormType::class);


            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $zwierze = $form->getData();

                $em->persist($zwierze);
                $em->flush();
            }
            
            return $this->render('new.html.twig', array('form' => $form->createView()));
        }
    }