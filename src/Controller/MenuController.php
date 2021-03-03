<?php
    namespace App\Controller;

    use App\Entity\Budynki;
    use App\Entity\Osoby;
    use App\Entity\ObiektyNajmu;
    use App\Entity\Spoldzielnie;
    use App\Entity\Umowy;
    use App\Entity\Wyposazenie;
    use App\Entity\Wyszukiwanie;
    use App\Entity\Zwierzeta;

    use Doctrine\ORM\EntityRepository;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use App\Form\BudynkiFormType;
    use App\Form\OsobyFormType;
    use App\Form\ObiektyNajmuFormType;
    use App\Form\SpoldzielnieFormType;
    use App\Form\UmowyFormType;
    use App\Form\WyposazenieFormType;
    use App\Form\WyszukiwanieFormType;
    use App\Form\ZwierzetaFormType;
    use Doctrine\ORM\EntityManagerInterface;

    class MenuController extends AbstractController {
        /**
         * @Route("/", name="main_menu")
         */
        public function index() {
            return $this->render('menu.html.twig');
        }

        /**
         * @Route("/WyswietlUmowy", name="showUmowy")
         * @Method({"GET"})
         */
        public function showUmowy(Request $request){
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findAll();

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);;
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showUmowy');
                }

                return $this->redirectToRoute('findUmowy', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('showUmowy.html.twig', array('form' => $form->createView(), 'umowy' => $umowy, 'ok' => false));
        }

        /**
         * @Route("/WyswietlUmowy/find/{id}", name="findUmowy")
         * @Method({"GET"})
         */
        public function findUmowy(Request $request, $id){
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findByRegex($id);

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showUmowy');
                }

                return $this->redirectToRoute('findUmowy', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('find/findUmowy.html.twig', array('form' => $form->createView(), 'umowy' => $umowy, 'ok' => false));
        }

        /**
         * @Route("/WyswietlObiektyNajmu", name="showObiektyNajmu")
         * @Method({"GET"})
         */
        public function showObiektyNajmu(Request $request){
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->findAll();

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);;
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showObiektyNajmu');
                }

                return $this->redirectToRoute('findObiektyNajmu', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('showObiektyNajmu.html.twig', array('form' => $form->createView(), 'obiektynajmu' => $obiektynajmu, 'ok' => false));
        }

        /**
         * @Route("/WyswietlObiektyNajmu/find/{id}", name="findObiektyNajmu")
         * @Method({"GET"})
         */
        public function findObiektyNajmu(Request $request, $id){
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->findByRegex($id);

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showObiektyNajmu');
                }

                return $this->redirectToRoute('findObiektyNajmu', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('find/findObiektyNajmu.html.twig', array('form' => $form->createView(), 'obiektynajmu' => $obiektynajmu, 'ok' => false));
        }

        /**
         * @Route("/WyswietlOsoby", name="showOsoby")
         * @Method({"GET"})
         */
        public function showOsoby(Request $request){
            $osoby = $this->getDoctrine()->getRepository(Osoby::class)->findAll();

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);;
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showOsoby');
                }

                return $this->redirectToRoute('findOsoby', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('showOsoby.html.twig', array('form' => $form->createView(), 'osoby' => $osoby, 'ok' => false));
        }

        /**
         * @Route("/WyswietlOsoby/find/{id}", name="findOsoby")
         * @Method({"GET"})
         */
        public function findOsoby(Request $request, $id){
            $osoby = $this->getDoctrine()->getRepository(Osoby::class)->findByRegex($id);

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showOsoby');
                }

                return $this->redirectToRoute('findOsoby', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('find/findOsoby.html.twig', array('form' => $form->createView(), 'osoby' => $osoby, 'ok' => false));
        }

        /**
         * @Route("/WyswietlSpoldzielnie", name="showSpoldzielnie")
         * @Method({"GET"})
         */
        public function showSpoldzielnie(Request $request){
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->findAll();

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);;
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showSpoldzielnie');
                }

                return $this->redirectToRoute('findSpoldzielnie', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('showSpoldzielnie.html.twig', array('form' => $form->createView(), 'spoldzielnie' => $spoldzielnie, 'ok' => false));
        }

        /**
         * @Route("/WyswietlSpoldzielnie/find/{id}", name="findSpoldzielnie")
         * @Method({"GET"})
         */
        public function findSpoldzielnie(Request $request, $id){
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->findByRegex($id);

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showSpoldzielnie');
                }

                return $this->redirectToRoute('findSpoldzielnie', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('find/findSpoldzielnie.html.twig', array('form' => $form->createView(), 'spoldzielnie' => $spoldzielnie, 'ok' => false));
        }

        /**
         * @Route("/WyswietlBudynki", name="showBudynki")
         * @Method({"GET"})
         */
        public function showBudynki(Request $request){
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->findAll();

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);;
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showBudynki');
                }

                return $this->redirectToRoute('findBudynki', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('showBudynki.html.twig', array('form' => $form->createView(), 'budynki' => $budynki, 'ok' => false));
        }

        /**
         * @Route("/WyswietlBudynki/find/{id}", name="findBudynki")
         * @Method({"GET"})
         */
        public function findBudynki(Request $request, $id){
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->findByRegex($id);

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showBudynki');
                }

                return $this->redirectToRoute('findBudynki', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('find/findBudynki.html.twig', array('form' => $form->createView(), 'budynki' => $budynki, 'ok' => false));
        }

        /**
         * @Route("/WyswietlWyposazenie", name="showWyposazenie")
         * @Method({"GET"})
         */
        public function showWyposazenie(Request $request){
            $wyposazenie = $this->getDoctrine()->getRepository(Wyposazenie::class)->findAll();

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showWyposazenie');
                }

                return $this->redirectToRoute('findWyposazenie', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('showWyposazenie.html.twig', array('form' => $form->createView(), 'wyposazenie' => $wyposazenie, 'ok' => false));
        }

        /**
         * @Route("/WyswietlWyposazenie/find/{id}", name="findWyposazenie")
         * @Method({"GET"})
         */
        public function findWyposazenie(Request $request, $id){
            $wyposazenie = $this->getDoctrine()->getRepository(Wyposazenie::class)->findByRegex($id);

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showWyposazenie');
                }

                return $this->redirectToRoute('findWyposazenie', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('find/findWyposazenie.html.twig', array('form' => $form->createView(), 'wyposazenie' => $wyposazenie, 'ok' => false));
        }

        /**
         * @Route("/WyswietlZwierzeta", name="showZwierzeta")
         * @Method({"GET"})
         */
        public function showZwierzeta(Request $request){
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->findAll();

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showZwierzeta');
                }

                return $this->redirectToRoute('findZwierzeta', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('showZwierzeta.html.twig', array('form' => $form->createView(), 'zwierzeta' => $zwierzeta, 'ok' => false));
        }

        /**
         * @Route("/WyswietlZwierzeta/find/{id}", name="findZwierzeta")
         * @Method({"GET"})
         */
        public function findZwierzeta(Request $request, $id){
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->findByRegex($id);

            $szukaj = new Wyszukiwanie();
            $form = $this->createForm(WyszukiwanieFormType::class, $szukaj);
  
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $szukaj = $form->getData();

                if($szukaj->getAnswer()=="")
                {
                    return $this->redirectToRoute('showZwierzeta');
                }

                return $this->redirectToRoute('findZwierzeta', ['id' => $szukaj->getAnswer()]);
            }
            
            return $this->render('find/findZwierzeta.html.twig', array('form' => $form->createView(), 'zwierzeta' => $zwierzeta, 'ok' => false));
        }

        /**
         * @Route("/WyswietlUmowy/{id}", name="showdetailedUmowy")
         */
        public function showdetailedUmowy($id){
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->find($id);
            $lokatorzy = $this->getDoctrine()->getRepository(Osoby::class)->find($umowy->getLokator());
            $wynajmujacy = $this->getDoctrine()->getRepository(Osoby::class)->find($umowy->getWynajmujacy());
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($umowy->getMieszkanie());
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->findBy(array('Id_umowy' => $umowy->getId()));
            return $this->render('showdetailedUmowy.html.twig', array('umowy' => $umowy, 'lokatorzy' => $lokatorzy,  'wynajmujacy' => $wynajmujacy, 'obiektynajmu' => $obiektynajmu, 'zwierzeta' => $zwierzeta));
        }

        /**
         * @Route("/WyswietlObiektyNajmu/{id}", name="showdetailedObiektyNajmu")
         */
        public function showdetailedObiektyNajmu($id){
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($id);
            $budynek = $this->getDoctrine()->getRepository(Budynki::class)->find($obiektynajmu->getAdres());
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->find($budynek->getNazwa());
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Mieszkanie' => $obiektynajmu->getMieszkanie()));
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
            $ile = $this->getDoctrine()->getRepository(Osoby::class)->showIle_umow($osoby->getPESEL());
            return $this->render('showdetailedOsoby.html.twig', array('osoby' => $osoby, 'umowylokator' => $umowylokator,  'umowywynajmujacy' => $umowywynajmujacy, 'ile' => $ile));
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
         * @Route("/WyswietlUmowy/delete/{id}", name="deleteUmowy")
         * @Method({"DELETE"})
         */
        public function deleteUmowy(Request $request, $id) {
            $umowa = $this->getDoctrine()->getRepository(Umowy::class)->find($id);
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->findBy(array('Id_umowy' => $umowa->getId()));
            
            if(count($zwierzeta) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym zwierzęciem! Nie możesz go usunąć.');
                return $this->redirectToRoute('showUmowy');
            }

            if($umowa != null)
                $this->getDoctrine()->getRepository(Umowy::class)->deleteRozwiaz_umowy($umowa->getNrumowy());
            else
                $this->addFlash('error', 'Ten obiekt nie istnieje w bazie danych! Nie możesz go usunąć.');

            $this->addFlash('success', 'Pomyślnie usunięto umowę z bazy danych!');
  
            return $this->redirectToRoute('showUmowy');
        }


        /**
         * @Route("/WyswietlSpoldzielnie/edit/{id}", name="editSpoldzielnie")
         * Method({"GET", "POST"})
         */
        public function editSpoldzielnie(Request $request, $id) {
            $spoldzielnie = new Spoldzielnie();
            $nazwa = "Edytuj spółdzielnię";
            $spoldzielnie = $this->getDoctrine()->getRepository(Spoldzielnie::class)->find($id);
            $nazwap = $spoldzielnie->getNazwa();
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->findBy(array('Nazwa' => $spoldzielnie->getNazwa()));
  
            $form = $this->createForm(SpoldzielnieFormType::class, $spoldzielnie);

            $form->handleRequest($request);

            if(count($budynki) > 0 && $nazwap != $spoldzielnie->getNazwa()){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym budynkiem! Nie możesz zmienić jego nazwy.');
                return $this->redirectToRoute('editSpoldzielnie', ['id' => $nazwap]);
            }

            if($form->isSubmitted() && $form->isValid()){
                $spoldzielnie = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success', 'Zaktualizowano spółdzielnię w bazie danych!');

                return $this->redirectToRoute('showSpoldzielnie');
            }
            
            return $this->render('new/newSpoldzielnie.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => true));
        }

        /**
         * @Route("/WyswietlZwierzeta/edit/{id}", name="editZwierzeta")
         * Method({"GET", "POST"})
         */
        public function editZwierzeta(Request $request, $id) {
            $zwierzeta = new Zwierzeta();
            $nazwa = "Edytuj zwierzęta";
            $zwierzeta = $this->getDoctrine()->getRepository(Zwierzeta::class)->find($id);

            $form = $this->createForm(ZwierzetaFormType::class, $zwierzeta);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $zwierzeta = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success', 'Zaktualizowano zwierzę w bazie danych!');

                return $this->redirectToRoute('showZwierzeta');
            }
            
            return $this->render('new/newZwierzeta.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => true));
        }

        /**
         * @Route("/WyswietlWyposazenie/edit/{id}", name="editWyposazenia")
         * Method({"GET", "POST"})
         */
        public function editWyposazenia(Request $request, $id) {
            $wyposazenia = new Wyposazenie();
            $nazwa = "Edytuj wyposażenie";
            $wyposazenia = $this->getDoctrine()->getRepository(Wyposazenie::class)->find($id);

            $form = $this->createForm(WyposazenieFormType::class, $wyposazenia);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $wyposazenia = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success', 'Zaktualizowano wyposażenie w bazie danych!');

                return $this->redirectToRoute('showWyposazenie');
            }
            
            return $this->render('new/newWyposazenie.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => true));
        }

        /**
         * @Route("/WyswietlBudynki/edit/{id}", name="editBudynki")
         * Method({"GET", "POST"})
         */
        public function editBudynki(Request $request, $id) {
            $budynki = new Budynki();
            $nazwa = "Edytuj budynek";
            $budynki = $this->getDoctrine()->getRepository(Budynki::class)->find($id);
            $adres = $budynki->getAdres();
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->findBy(array('Adres' => $budynki->getAdres()));
  
            $form = $this->createForm(BudynkiFormType::class, $budynki);

            $form->handleRequest($request);

            if(count($obiektynajmu) > 0 && $adres != $budynki->getAdres()){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym obiektem najmu! Nie możesz zmienić jego adresu.');
                return $this->redirectToRoute('editBudynki', ['id' => $adres]);
            }

            if($form->isSubmitted() && $form->isValid()){
                $budynki = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success', 'Zaktualizowano budynek w bazie danych!');

                return $this->redirectToRoute('showBudynki');
            }
            
            return $this->render('new/newBudynki.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => true));
        }

        /**
         * @Route("/WyswietlObiektyNajmu/edit/{id}", name="editObiektyNajmu")
         * Method({"GET", "POST"})
         */
        public function editObiektyNajmu(Request $request, $id) {
            $obiektynajmu = new ObiektyNajmu();
            $nazwa = "Edytuj obiekt najmu";
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($id);
            $mieszkanie = $obiektynajmu->getMieszkanie();
            $adres = $obiektynajmu->getadres();
            $nrmieszkania = $obiektynajmu->getNrMieszkania();
            $wyposazenie = $this->getDoctrine()->getRepository(Wyposazenie::class)->findBy(array('Mieszkanie' => $obiektynajmu->getMieszkanie()));
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Mieszkanie' => $obiektynajmu->getMieszkanie()));
  
            $form = $this->createForm(ObiektyNajmuFormType::class, $obiektynajmu);

            $form->handleRequest($request);

            if(count($wyposazenie) > 0 && count($umowy) > 0 && ($adres != $obiektynajmu->getAdres() || $nrmieszkania != $obiektynajmu->getNrMieszkania())){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym wyposażeniem oraz umową! Nie możesz zmienić jego adresu.');
                return $this->redirectToRoute('editObiektyNajmu', ['id' => $mieszkanie]);
            }
            
            if(count($wyposazenie) > 0 && ($adres != $obiektynajmu->getAdres() || $nrmieszkania != $obiektynajmu->getNrMieszkania())){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym wyposażeniem! Nie możesz zmienić jego adresu.');
                return $this->redirectToRoute('editObiektyNajmu', ['id' => $mieszkanie]);
            }

            if(count($umowy) > 0 && ($adres != $obiektynajmu->getAdres() || $nrmieszkania != $obiektynajmu->getNrMieszkania())){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową! Nie możesz zmienić jego adresu.');
                return $this->redirectToRoute('editObiektyNajmu', ['id' => $mieszkanie]);
            }

            if($form->isSubmitted() && $form->isValid()){
                $obiektynajmu = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success', 'Zaktualizowano obiekt najmu w bazie danych!');

                return $this->redirectToRoute('showObiektyNajmu');
            }
            
            return $this->render('new/newObiektyNajmu.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => true));
        }

        /**
         * @Route("/WyswietlUmowy/edit/{id}", name="editUmowy")
         * Method({"GET", "POST"})
         */
        public function editUmowy(Request $request, $id) {
            $umowy = new Umowy();
            $nazwa = "Edytuj umowę";
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->find($id);
            $idx = $umowy->getId();
            $nrumowy = $umowy->getNrUmowy();
            $zwierze = $this->getDoctrine()->getRepository(Zwierzeta::class)->findBy(array('Id_umowy' => $umowy->getId()));
  
            $form = $this->createForm(UmowyFormType::class, $umowy);

            $form->handleRequest($request);

            if(count($zwierze) > 0 && $nrumowy != $umowy->getNrUmowy()){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym zwierzęciem! Nie możesz zmienić jego numeru.');
                return $this->redirectToRoute('editUmowy', ['id' => $idx]);
            }

            if($form->isSubmitted() && $form->isValid()){
                $umowy = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success', 'Zaktualizowano umowę w bazie danych!');

                return $this->redirectToRoute('showUmowy');
            }
            
            return $this->render('new/newUmowy.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => true));
        }

        /**
         * @Route("/WyswietlOsoby/edit/{id}", name="editOsoby")
         * Method({"GET", "POST"})
         */
        public function editOsoby(Request $request, $id) {
            $osoby = new Osoby();
            $nazwa = "Edytuj osobę";
            $osoby = $this->getDoctrine()->getRepository(Osoby::class)->find($id);
            $pesel = $osoby->getPESEL();
            $lokator = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Lokator' => $osoby->getPESEL()));
            $wynajmujacy = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Wynajmujacy' => $osoby->getPESEL()));
  
            $form = $this->createForm(OsobyFormType::class, $osoby);

            $form->handleRequest($request);

            if(count($lokator) > 0 && count($wynajmujacy) > 0 && $pesel != $osoby->getPESEL()){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową jako lokator oraz jako wynajmujący! Nie możesz zmienić jego PESELU.');
                return $this->redirectToRoute('editOsoby', ['id' => $pesel]);
            }

            if(count($lokator) > 0 && $pesel != $osoby->getPESEL()){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową jako lokator! Nie możesz zmienić jego PESELU.');
                return $this->redirectToRoute('editOsoby', ['id' => $pesel]);
            }

            if(count($wynajmujacy) > 0 && $pesel != $osoby->getPESEL()){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową jako wynajmujący! Nie możesz zmienić jego PESELU.');
                return $this->redirectToRoute('editOsoby', ['id' => $pesel]);
            }

            if($form->isSubmitted() && $form->isValid()){
                $osoby = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success', 'Zaktualizowano osobę w bazie danych!');

                return $this->redirectToRoute('showOsoby');
            }
            
            return $this->render('new/newOsoby.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => true));
        }

        /**
         * @Route("/WyswietlOsoby/delete/{id}", name="deleteOsoby")
         * @Method({"DELETE"})
         */
        public function deleteOsoby(Request $request, $id) {
            $osoby = $this->getDoctrine()->getRepository(Osoby::class)->find($id);
            $umowy1 = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Lokator' => $osoby->getPESEL()));
            $umowy2 = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Wynajmujacy' => $osoby->getPESEL()));
            
            if(count($umowy1) > 0 && count($umowy2) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową jako lokator oraz jako wynajmujący! Nie możesz go usunąć.');
                return $this->redirectToRoute('showOsoby');
            }

            if(count($umowy1) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową jako lokator! Nie możesz go usunąć.');
                return $this->redirectToRoute('showOsoby');
            }
            
            if(count($umowy2) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową jako wynajmujący! Nie możesz go usunąć.');
                return $this->redirectToRoute('showOsoby');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($osoby);
            $entityManager->flush();

            $this->addFlash('success', 'Pomyślnie usunięto osobę z bazy danych!');
  
            return $this->redirectToRoute('showOsoby');
        }

        /**
         * @Route("/WyswietlObiektyNajmu/delete/{id}", name="deleteObiektyNajmu")
         * @Method({"DELETE"})
         */
        public function deleteObiektyNajmu(Request $request, $id) {
            $obiektynajmu = $this->getDoctrine()->getRepository(ObiektyNajmu::class)->find($id);
            $wyposazenia = $this->getDoctrine()->getRepository(Wyposazenie::class)->findBy(array('Mieszkanie' => $obiektynajmu->getMieszkanie()));
            $umowy = $this->getDoctrine()->getRepository(Umowy::class)->findBy(array('Mieszkanie' => $obiektynajmu->getMieszkanie()));

            if(count($wyposazenia) > 0 && count($umowy) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym wyposażeniem  oraz jedną umową! Nie możesz go usunąć.');
                return $this->redirectToRoute('showObiektyNajmu');
            }
            if(count($wyposazenia) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym wyposażeniem! Nie możesz go usunąć.');
                return $this->redirectToRoute('showObiektyNajmu');
            }
            if(count($umowy) > 0){
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jedną umową! Nie możesz go usunąć.');
                return $this->redirectToRoute('showObiektyNajmu');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($obiektynajmu);
            $entityManager->flush();

            $this->addFlash('success', 'Pomyślnie usunięto obiekt najmu z bazy danych!');
  
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
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym obiektem najmu! Nie możesz go usunąć.');
                return $this->redirectToRoute('showBudynki');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($budynki);
            $entityManager->flush();

            $this->addFlash('success', 'Pomyślnie usunięto budynek z bazy danych!');
  
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
                $this->addFlash('error', 'Ten obiekt ma powiązanie z przynajmniej jednym budynkiem! Nie możesz go usunąć.');
                return $this->redirectToRoute('showSpoldzielnie');
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spoldzielnie);
            $entityManager->flush();

            $this->addFlash('success', 'Pomyślnie usunięto spółdzielnię z bazy danych!');
  
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

            $this->addFlash('success', 'Pomyślnie usunięto wyposażenie z bazy danych!');
  
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

            $this->addFlash('success', 'Pomyślnie usunięto zwierzę z bazy danych!');
  
            return $this->redirectToRoute('showZwierzeta');
        }

        /**
         * @Route("/NowaOsoba", name="newOsoba")
         * @Method({"GET", "POST"})
         */
        public function newOsoba(EntityManagerInterface $em, Request $request){
            $nazwa = "Dodaj osobę";

            $form = $this->createForm(OsobyFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $osoby = $form->getData();

                $em->persist($osoby);
                $em->flush();

                $this->addFlash('success', 'Dodano nową osobę do bazy danych!');

                return $this->redirectToRoute('newOsoba');
            }
            
            return $this->render('new/newOsoby.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => false));
        }

        /**
         * @Route("/NowyBudynek", name="newBudynek")
         * @Method({"GET", "POST"})
         */
        public function newBudynek(EntityManagerInterface $em, Request $request){
            $nazwa = "Dodaj budynek";

            $form = $this->createForm(BudynkiFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $budynek = $form->getData();

                $em->persist($budynek);
                $em->flush();

                $this->addFlash('success', 'Dodano nowy budynek do bazy danych!');

                return $this->redirectToRoute('newBudynek');
            }
            
            return $this->render('new/newBudynki.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => false));
        }

        /**
         * @Route("/NowyObiektNajmu", name="newObiektNajmu")
         * @Method({"GET", "POST"})
         */
        public function newObiektNajmu(EntityManagerInterface $em, Request $request){
            $nazwa = "Dodaj obiekt najmu";

            $form = $this->createForm(ObiektyNajmuFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $obiektnajmu = $form->getData();

                $em->persist($obiektnajmu);
                $em->flush();

                $this->addFlash('success', 'Dodano nowy obiekt najmu do bazy danych!');

                return $this->redirectToRoute('newObiektNajmu');
            }
            
            return $this->render('new/newObiektyNajmu.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => false));
        }

        /**
         * @Route("/NowaSpoldzielnia", name="newSpoldzielnia")
         * @Method({"GET", "POST"})
         */
        public function newSpoldzielnia(EntityManagerInterface $em, Request $request){
            $nazwa = "Dodaj spółdzielnię";

            $form = $this->createForm(SpoldzielnieFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $spoldzielnie = $form->getData();

                $em->persist($spoldzielnie);
                $em->flush();

                $this->addFlash('success', 'Dodano nową spółdzielnię do bazy danych!');

                return $this->redirectToRoute('newSpoldzielnia');
            }
            
            return $this->render('new/newSpoldzielnie.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => false));
        }

        /**
         * @Route("/NowaUmowa", name="newUmowa")
         * @Method({"GET", "POST"})
         */
        public function newUmowa(EntityManagerInterface $em, Request $request){
            $nazwa = "Dodaj umowę";

            $form = $this->createForm(UmowyFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $umowy = $form->getData();

                $em->persist($umowy);
                $em->flush();

                $this->addFlash('success', 'Dodano nową umowę do bazy danych!');

                return $this->redirectToRoute('newUmowa');
            }
            
            return $this->render('new/newUmowy.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => false));
        }

        /**
         * @Route("/NoweWyposazenie", name="newWyposazenie")
         * @Method({"GET", "POST"})
         */
        public function newWyposazenie(EntityManagerInterface $em, Request $request){
            $nazwa = "Dodaj wyposażenie";

            $form = $this->createForm(WyposazenieFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $wyposazenie = $form->getData();

                $em->persist($wyposazenie);
                $em->flush();

                $this->addFlash('success', 'Dodano nowe wyposażenie do bazy danych!');

                return $this->redirectToRoute('newWyposazenie');
            }
            
            return $this->render('new/newWyposazenie.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => false));
        }
        
        /**
         * @Route("/NoweZwierze", name="newZwierze")
         * @Method({"GET", "POST"})
         */
        public function newZwierze(EntityManagerInterface $em, Request $request){
            $nazwa = "Dodaj zwierzę";

            $form = $this->createForm(ZwierzetaFormType::class);


            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $zwierze = $form->getData();

                $em->persist($zwierze);
                $em->flush();

                $this->addFlash('success', 'Dodano nowe zwierzę do bazy danych!');

                return $this->redirectToRoute('newZwierze');
            }
            
            return $this->render('new/newZwierzeta.html.twig', array('form' => $form->createView(), 'nazwa' => $nazwa, 'ok' => false));
        }
    }
