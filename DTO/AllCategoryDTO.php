<?php
namespace DTO;
class AllCategoryDTO
{
    private $category_name;
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category_name;
    }




}