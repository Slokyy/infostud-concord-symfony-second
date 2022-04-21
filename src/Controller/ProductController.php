<?php

  namespace App\Controller;

  use App\Entity\Product;
  use App\Repository\ProductRepository;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  #[Route('/product', name: 'product-')]
  class ProductController extends AbstractController
  {
    #[Route('/', name: 'all')]
    public function all(ProductRepository $productRepo): Response
    {

      $products = $productRepo->findAll();

      return $this->render("base.html.twig", [
        "products" => $products
      ]);
    }

    #[Route('/show/{slug}', name: 'show', methods: 'GET')]
    public function show($slug, ProductRepository $productRepository): Response
    {
      $product = $productRepository->findOneBy(['slug' => $slug]);
      return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    #[Route('/create', name: 'form-submit', methods: ['POST', 'GET'])]
    public function createProduct(Request $request, ProductRepository $prRepo): Response
    {
      if($request->getMethod() == "POST" && $request->request->has('createProductSubmit'))
      {
        $product = new Product();
        $newProductData = $request->request->all();
        $product->setName(trim($newProductData['productName']));
        $product->setDescription(trim($newProductData['productDescription']));
        $product->setPrice(trim($newProductData['productPrice']));
        $date = new \DateTime();
        $date->setTime(0,0);
        $product->setDateAdded($date);
        $slug = strtolower(str_replace(" ", "-", $newProductData['productName']));
        $product->setSlug($slug);
        $prRepo->add($product);
        return $this->redirect('/product');
      }
      return $this->render("product/create.html.twig");


    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    #[Route('/edit/{slug}', name: 'edit', methods: ['GET', 'POST'])]
    public function editProduct($slug, Request $request, Product $product, ProductRepository $prRepo): Response
    {
     if($request->headers->get('referer') == null)
      {
        return $this->redirect('/product');
      }
      if($request->getMethod() == "POST" && $request->request->has('editProductSubmit'))
      {
        $editProductData = $request->request->all();
        $product->setName(trim($editProductData['editProductName']));
        $product->setDescription(trim($editProductData['editProductDescription']));
        $product->setPrice(trim($editProductData['editProductPrice']));
        $date = new \DateTime();
        $date->setTime(0,0);
        $product->setDateAdded($date);
        $slug = strtolower(str_replace(" ", "-", trim($editProductData['editProductName']."-".$product->getId())));
        $product->setSlug($slug);
        $prRepo->add($product);
        return $this->redirect("$slug");
      }
      $editUserOldData = [
        "name" => $product->getName(),
        "price" => $product->getPrice(),
        "description" => $product->getDescription(),
        "slug" => $product->getSlug()
      ];
      return $this->render('product/edit.html.twig', ['editUserData' => $editUserOldData]);
    }


    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    #[Route('/edit/{slug}', name: 'edit-update', methods: ['PUT'])]
    public function editPutProduct($slug, Request $request, Product $product, ProductRepository $prRepo): Response
    {
      return new Response("Bonzai");
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    #[Route('/delete/{id}', name: "delete")]
    public function delete($id, ProductRepository $prRepo): Response
    {
      $product = $prRepo->find($id);
      if($product == null) {
        throw $this->createNotFoundException("No product with ID: $id");
      }
      $prRepo->remove($product);
      return $this->redirect('/product');
    }


    #[Route('/sorted-data', name: 'sorted-data')]
    public function getSortedData(Request $request, ProductRepository $productRepository): Response
    {
      $sortType = $request->query->get('sort_type');
      $products = $productRepository->sort($sortType);
      return $this->json($products);
    }

    #[Route('/price-limit', name: 'limit-price', methods: 'POST')]
    public function getPriceLimited(Request $request, ProductRepository $productRepository)
    {
      $parameters = json_decode($request->getContent(), true);
      $minValue = $parameters['minValue'];
      $maxValue = $parameters['maxValue'];
      $products = $productRepository->getPriceWithinLimit($minValue, $maxValue);
      return $this->json(['success' => $products]);
    }
  }
