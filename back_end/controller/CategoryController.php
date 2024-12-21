<?php
class CategoryController
{
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    function index()
    {
        $categories = $this->categoryRepository->getAll();
        
        $response = [
            "items" => $categories
        ];

        $response = json_encode($response);
        echo $response;
    }
}
