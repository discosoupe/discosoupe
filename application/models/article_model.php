<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Article_model extends CI_Model
{
	private $table = 'article';
	
	public function array_article($articles){
		$resultat = NULL;
		$idarticle = 0;
		$i = 0;
		$url_temp = NULL;
		$theme_temp = NULL;
		foreach ($articles as $article) {
			if($idarticle == $article->idarticle){
				if($article->url != $url_temp && !in_array($article->url, $resultat[$i - 1]->url)){
					array_push($resultat[$i - 1]->url, $article->url);
				}
				if($article->theme != $theme_temp && !in_array($article->theme, $resultat[$i - 1]->theme)){
					array_push($resultat[$i - 1]->theme, $article->theme);
				}
			}else{
				$resultat[$i]->idarticle = $article->idarticle;
				$resultat[$i]->titre = $article->titre;
				$resultat[$i]->date = $article->date;
				$resultat[$i]->description = $article->description;
				$resultat[$i]->image = $article->image;
				$resultat[$i]->piecejointe = $article->piecejointe;
				if($article->url != NULL){
					$url[0] = $article->url;
					$resultat[$i]->url = $url;
				}
				else{
					$resultat[$i]->url = NULL;
				}
				if($article->theme != NULL){
					$theme[0] = $article->theme;
					$resultat[$i]->theme = $theme;
				}
				else{
					$resultat[$i]->theme = NULL;
				}
				$i = $i+1;
			}
			$idarticle = $article->idarticle;
			$url_temp = $article->url;
			$theme_temp = $article->theme;
		}
		return $resultat;
	}
	
	public function save_article($titre, $date, $description, $image, $piecejointe)
    {
		$this->db->set('titre', $titre);
		$this->db->set('date', $date);
		$this->db->set('description', $description);
		$this->db->set('image', $image);
		$this->db->set('piecejointe', $piecejointe);
		$this->db->insert($this->table);
		return $this->db->insert_id($this->table);
    }
	
	public function get_article_by_id($idarticle)
	{
		if(is_numeric($idarticle)){
			$articles = $this->db->select('idarticle, titre, date, article.description, image, piecejointe, url, theme.nom as theme')
				->from($this->table)
				->join('lienexterne', 'lienexterne.idarticlelienexterne = article.idarticle', 'left outer')
				->join('theme', 'theme.idarticletheme = article.idarticle', 'left outer')
				->where('idarticle', $idarticle)
				->get()
				->result();
			return $this->array_article($articles);
		}
	}
	
	public function get_article_by_theme($nomtheme)
	{
		$articles = $this->db->select('idarticle, titre, date, article.description, image, piecejointe, url, theme.nom as theme')
			->from($this->table)
			->join('lienexterne', 'lienexterne.idarticlelienexterne = article.idarticle', 'left outer')
			->join('theme', 'theme.idarticletheme = article.idarticle', 'left outer')
			->where('theme.nom', $nomtheme)
			->get()
			->result();
		return $this->array_article($articles);
	}
	
	public function get_article_by_search($search)
	{
		$articles = $this->db->select('idarticle, titre, date, article.description, image, piecejointe, url, theme.nom as theme')
			->from($this->table)
			->join('lienexterne', 'lienexterne.idarticlelienexterne = article.idarticle', 'left outer')
			->join('theme', 'theme.idarticletheme = article.idarticle', 'left outer')
			->like('article.description', $search)
			->or_like('article.titre', $search)
			->get()
			->result();
		return $this->array_article($articles);
	}
	
	public function get_article($nb = 10, $debut = 0)
    {
		$articles = $this->db->select('idarticle, titre, date, article.description, image, piecejointe, url, theme.nom as theme')
			->from($this->table)
			->join('lienexterne', 'lienexterne.idarticlelienexterne = article.idarticle', 'left outer')
			->join('theme', 'theme.idarticletheme = article.idarticle', 'left outer')
			->order_by('date', 'desc')
			->limit($nb, $debut)
			->get()
			->result();
		return $this->array_article($articles);
    }
	
	public function get_nb_page()
	{
		return ceil(($this->db->select('idarticle, titre, date, article.description, image, piecejointe, url, theme.nom as theme')
			->from($this->table)
			->join('lienexterne', 'lienexterne.idarticlelienexterne = article.idarticle', 'left outer')
			->join('theme', 'theme.idarticletheme = article.idarticle', 'left outer')
			->count_all_results())/10);
	}
	
	public function get_article_by_page($page, $nb = 10)
    {
		$articles = $this->db->select('idarticle, titre, date, article.description, image, piecejointe, url, theme.nom as theme')
			->from($this->table)
			->join('lienexterne', 'lienexterne.idarticlelienexterne = article.idarticle', 'left outer')
			->join('theme', 'theme.idarticletheme = article.idarticle', 'left outer')
			->order_by('date', 'desc')
			->limit($nb, $page * $nb)
			->get()
			->result();
		return $this->array_article($articles);
    }

	public function get_archive()
    {
    	return $this->db->select('idarticle, titre, date')
			->from($this->table)
			->order_by("date", "desc")
			->get()
			->result();
	}

	public function update_article($idarticle, $titre, $date, $description, $image, $piecejointe){
		$data = array(
	           'idarticle' => $idarticle,
	           'titre' => $titre,
	           'date' => $date,
	           'description' => $description,
	        );
		if($image != NULL){
			$data['image'] = $image;
		}
		if($piecejointe != NULL){
			$data['piecejointe'] = $piecejointe;
		}
		$this->db->where('idarticle', $idarticle);
		$this->db->update($this->table, $data); 
	}
	
	public function delete_article($idarticle){
		$this->db->delete($this->table, array('idarticle' => $idarticle)); 
	}
}