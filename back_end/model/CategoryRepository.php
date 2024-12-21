<?php
class CategoryRepository
{
    protected function fetch()
    {
        global $conn;
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = new Category($row['id'], $row['name']);
                $categories[] = $category;
            }
        }
        return $categories;
    }

    function getALl() {
        return $this->fetch();
    }
};
