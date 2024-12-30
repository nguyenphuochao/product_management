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
        $page = $_GET['page'] ?? 1;
        $item_per_page = 5;
        $pattern = $_GET['search'] ?? '';

        $allCategories = $this->categoryRepository->getByPattern($pattern);

        $totalItem = count($allCategories);
        $totalPage = ceil($totalItem / $item_per_page);

        $list = $_GET['list'] ?? null;

        if($list == "all") {
            $categories = $this->categoryRepository->getByPattern($pattern);
            $totalPage = 1;
         } else {
            $categories = $this->categoryRepository->getByPattern($pattern, $page, $item_per_page);
        }

        $response = [
            "items" => $categories,
            "totalItem" => $totalItem,
            "pagination" => [
                "page" => (int)$page,
                "totalPage" => $totalPage
            ]
        ];

        $response = json_encode($response);
        echo $response;
    }

    function show($params)
    {
        $id = $params['id'];
        $category = $this->categoryRepository->find($id);
        echo json_encode($category);
    }

    function store()
    {
        $info = json_decode(file_get_contents('php://input'));
        $data = [];
        $data['name'] = $info->name;
        $result = $this->categoryRepository->save($data);
        if ($result) {
            $category = $this->categoryRepository->find($result);
            $response = json_encode($category);
        } else {
            $response = json_encode($this->categoryRepository->error);
        }

        echo $response;
    }

    function update($params)
    {
        $info = json_decode(file_get_contents('php://input'));
        $id = $params['id'];
        $category = $this->categoryRepository->find($id);
        $name = $info->name ?? $category->name;

        // cập nhật ô nhập liệu
        $category->name = $name;
        $result = $this->categoryRepository->update($category);

        if ($result) {
            $response = json_encode($category);
        } else {
            $response = json_encode($this->categoryRepository->error);
        }

        echo $response;
    }

    function destroy($params) {
        $id = $params['id'];
        $result = $this->categoryRepository->delete($id);

        if ($result) {
            $response = json_encode('Đã xóa danh mục thành công');
        } else {
            $response = json_encode($this->categoryRepository->error);
        }

        echo $response;
    }
}
