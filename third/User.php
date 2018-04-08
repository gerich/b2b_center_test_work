<?php

namespace third;

class User
{
    /**
     * @var mixed $id scalar
     */
    private $id;
    /**
     * @var string $name
     */
    private $name;
    /**
     * Тут возможно был уместен паттерн итератор, но логика работы с коллекцией в данном задании тривиальна
     * @var Article[]
     */
    private $articles = [];

    public function __construct($id, $name, array $articles = [])
    {
        $this->articles = $articles;
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return Article[]
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Тут возможно было бы использовать фабричный метод для статей, но все очень просто
     * @param $text
     * @return Article
     */
    public function createArticle($text): Article
    {
        $article = new Article($this, $text);
        $this->articles[] = $article;

        return $article;
    }

}