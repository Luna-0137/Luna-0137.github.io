<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Queries_Articles extends loresite_Queries
{
    protected $Queries;

    public function __construct()
    {
        $this->Queries = new loresite_Queries;
    }

    public function get_articles()
    {
        $data = $this->Queries->select('articles', []);

        return $data;
    }

    public function get_short_articles()
    {
        $data = $this->Queries->select(
            'articles',
            [],
            'title, slug, updated_at, created_at'
        );

        return $data;
    }

    public function get_article_by_slug($slug)
    {
        $data = $this->Queries->select('articles', ['slug' => $slug]);

        return $data;
    }

        public function get_article_by_id($id)
    {
        $data = $this->Queries->select('articles', ['id' => $id]);

        return $data;
    }

    public function insert_article($data)
    {
        $id = $this->Queries->insert('articles', $data);

        return $id;
    }

    public function update_article($data)
    {
        $conditions = ['id' => $data['id']];
        $this->Queries->update('articles', $data, $conditions);

        return $data['id'];
    }

    public function delete_article($id)
    {
        $conditions = ['id' => $id];
        $this->Queries->delete('articles', $conditions);

        return $id;
    }

}