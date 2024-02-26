<?php

namespace Model\Entity;

abstract class BaseEntity
{
    protected $id;
    protected $created_at;
    protected $updated_at;
    protected $is_deleted;


    public function __toString()
    {
        // return the class name from its namespase
        // exemple : Model\Entity\Product
        $class = get_called_class();

        // Cut a string of characters as soon as it encounters a specific character here it is the "\"
        // It then returns an indexed array containing the elements in the character string
        // Exemple :
        // ["Model","Entity","Product"]

        $class = explode("\\", $class);
        $table = $class[count($class) - 1];
        // strtolower = set all characters in a string to lowercase
        return strToLower($table);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get the value of is_deleted
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * Set the value of is_deleted
     *
     * @return  self
     */
    public function setIsDeleted($isDeleted)
    {
        $this->is_deleted = $isDeleted;

        return $this;
    }

}