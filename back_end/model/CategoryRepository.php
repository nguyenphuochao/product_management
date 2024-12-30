<?php
class CategoryRepository
{
    public $error;
    protected function fetch($condition = null, $page = null, $item_per_page = null)
    {
        global $conn;
        $sql = "SELECT * FROM categories";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        if($page && $item_per_page) {
            $pageIndex = ($page - 1) * $item_per_page;
            $sql .= "LIMIT $pageIndex, $item_per_page";
        }

        $result = $conn->query($sql);
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = new Category((int)$row['id'], $row['name']);
                $categories[] = $category;
            }
        }

        return $categories;
    }

    function getAll()
    {
        return $this->fetch();
    }

    function find($id)
    {
        $category = $this->fetch("id = $id");
        return current($category);
    }

    function getByPattern($search, $page = null, $item_per_page = null)
    {
        $cond = "name LIKE '%$search%'";
        return $this->fetch($cond, $page, $item_per_page);
    }

    function save($data)
    {
        global $conn;
        $name = $data['name'];
        $sql = "INSERT INTO categories (name) VALUES ('$name')";
        if ($conn->query($sql)) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }

    function update($category)
    {
        global $conn;
        $name = $category->name;
        $id = $category->id;
        $sql = "UPDATE `categories` SET name='$name' WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }

    function delete($id)
    {
        global $conn;
        $sql = "DELETE FROM categories WHERE id = $id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
}
