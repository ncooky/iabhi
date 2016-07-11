<?php 

	 
	 
	//Get the navigation bar
	function hooskNav($slug)
	{
		$CI =& get_instance();
		$CI->db->where('navSlug', $slug);
		$query=$CI->db->get('navigation');
		foreach($query->result_array() as $n):
			$totSegments = $CI->uri->total_segments();
			if(!is_numeric($CI->uri->segment($totSegments))){
			$current = "/".$CI->uri->segment($totSegments);
			} else if(is_numeric($CI->uri->segment($totSegments))){
			$current = "/".$CI->uri->segment($totSegments-1);
			}
			if ($current == "/") {$current = BASE_URL;};
			$nav = str_replace('<li><a href="'.$current.'">', '<li class="active"><a href="'.$current.'">', $n['navHTML']);
			echo $nav;
		endforeach;

	}
	
	//Get the Latest 3 news posts
	function getLatest3articles()
	{
		$CI =& get_instance();
        $CI->db->join("post_category", "post_category.categoryID = post.categoryID");
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit(3, 0);
		$query=$CI->db->get('post');
		$posts = '<div class="row box">';
		foreach($query->result_array() as $c):
            $date = date_create($c['datePosted']);
			$posts .= '<div class="col col-md-4">';
            $posts .= ' <div class="bg-entry">';
            $posts .= '  <div class="bg-entry-header"><span class="text-left">Pada <a href="/category/'.$c['categorySlug'].'"><strong style="color:#'.$c['categoryColor'].';">'.$c['categoryTitle'].'</strong></a></span><span><strong></strong>'.date_format($date,'d.m.Y').'</span></div>';
            if ($c['postImage'] != "") {
            $posts .= '<a href="/article/'.$c['postURL'].'"><img src="'.BASE_URL.'/images/'.$c['postImage'].'" alt="'.$c['postTitle'].'"/></a>';
            } else {
            $posts .= '<a href="/article/'.$c['postURL'].'"><img src="'.BASE_URL.'/images/default-article.jpg" alt="'.$c['postTitle'].'"/></a>';
            }
            $posts .= '<h2><a href="/article/'.$c['postURL'].'">'.word_limiter($c['postTitle'],10).'</a></h2></div></div>';
		endforeach;
		$posts .= "</div>";
		echo $posts;
	}
	
	//Get the Latest 5 news posts
	function getLatestNewsSidebar()
	{
		$CI =& get_instance();
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit(5, 0);
		$query=$CI->db->get('post');
		$posts = '<ul class="list-group">';
		foreach($query->result_array() as $c):
			$posts .= '<li class="list-group-item"><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></li>';
		endforeach;
		$posts .= "</ul>";
		echo $posts;
	}
    
	function getLatestNewsSidebarBox()
	{
		$CI =& get_instance();
        $CI->db->join("post_category", "post_category.categoryID = post.categoryID");
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit(3, 0);
		$query=$CI->db->get('post');
		$posts = '<ul class="list-group">';
		foreach($query->result_array() as $c):
            $date = date_create($c['datePosted']);
			$posts .= '<li class="sidebarBox">';
            $posts .= ' <div class="bg-entry">';
            $posts .= '  <div class="bg-entry-header"><span class="text-left">Pada <a href="/category/'.$c['categorySlug'].'"><strong style="color:#'.$c['categoryColor'].';">'.$c['categoryTitle'].'</strong></a></span><span><strong></strong>'.date_format($date,'d.m.Y').'</span></div>';
            if ($c['postImage'] != "") {
            $posts .= '<a href="/article/'.$c['postURL'].'"><img src="'.BASE_URL.'/images/'.$c['postImage'].'" alt="'.$c['postTitle'].'"/></a>';
            } else {
            $posts .= '<a href="/article/'.$c['postURL'].'"><img src="'.BASE_URL.'/images/default-article.jpg" alt="'.$c['postTitle'].'"/></a>';
            }
            $posts .= '<h2><a href="/article/'.$c['postURL'].'">'.word_limiter($c['postTitle'],8).'</a></h2></div></li>';
		endforeach;
		$posts .= "</ul>";
		echo $posts;
	}    

	//Get the Latest 5 news posts
	function getLatestNewsBottom()
	{
		$CI =& get_instance();
        $CI->db->join("post_category", "post_category.categoryID = post.categoryID");
        $CI->db->where("post_category.categoryTitle = 'Berita'");        
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit(5, 0);
		$query=$CI->db->get('post');
		$posts = '<ul class="section-list">';
		foreach($query->result_array() as $c):
			$posts .= '<li class="section-item"><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></li>';
		endforeach;
		$posts .= "</ul>";
		echo $posts;
	} 
    
	function getTop5PartnersBottom()
	{
		$CI =& get_instance();
		$CI->db->order_by("partnerSort", "asc");
		$CI->db->limit(5, 0);
		$query=$CI->db->get('partner');
		$posts = '<ul class="section-list">';
		foreach($query->result_array() as $c):
			$posts .= '<li><a href="'.$c['partnerLink'].'" target="_blank">'.$c['partnerName'].'</a></li>';
		endforeach;
		$posts .= "</ul>";
		echo $posts;
	}    
    	
	//Get the Latest news for the main column
	function getLatestNews($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit($limit, $offset);
		$query=$CI->db->get('post');
		$posts = '';
		foreach($query->result_array() as $c):
			$date = new DateTime($c['datePosted']);
			$posts .= '<div class="row">';
			if ($c['postImage'] != "") {
			$posts .= '<div class="col-md-3"><a href="/article/'.$c['postURL'].'"><img class="img-responsive" src="'.BASE_URL.'/images/'.$c['postImage'].'" alt="'.$c['postTitle'].'"/></a></div>';
			$posts .= '<div class="col-md-9"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';
			} else {
			$posts .= '<div class="col-md-12"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';			}
			$posts .= '</div>';
			$posts .= "</div><hr />";
		endforeach;
		echo $posts;
	}
	
		//Get the categories
	function getCategories()
	{
		$CI =& get_instance();
		$CI->db->order_by("categoryTitle", "asc");
		$query=$CI->db->get('post_category');
		$categories = '<ul class="list-group">';
		foreach($query->result_array() as $c):
			$CI->db->where('categoryID', $c['categoryID']);
			$CI->db->from('post');
			$query = $CI->db->get();
			$totPosts = $query->num_rows();
			if ($totPosts > 0){
			$categories .= '<li class="list-group-item"><a href="/category/'.$c['categorySlug'].'"><span class="badge">'.$totPosts.'</span>'.$c['categoryTitle'].'</a></li>';
			}
		endforeach;
		$categories .= "</ul>";
		echo $categories;
	}
	
		//Get the total posts
	function countPosts($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->from('post');
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		echo "Showing posts ".$offset." - ".$showing." of ".$totPosts;
	}
	
	function countCategoryPosts($categoryID, $limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->from('post');
		$CI->db->where('categoryID', $categoryID);
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		echo "Showing posts ".$offset." - ".$showing." of ".$totPosts;
	}
	function getPrevBtnCategory($categoryID, $limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('post');
		$query = $CI->db->get();
		$CI->db->where('categoryID', $categoryID);
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}

		$prevNum = $offset-$limit;
		if ($prevNum < 0){ $prevNum = 0; }
		if ($prevNum < $offset){
		echo '<a href="'.BASE_URL.$pagURL.'/'.$prevNum.'" class="btn btn-success float-left">Previous</a>';
		}
	}
	
	function getNextBtnCategory($categoryID, $limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('post');
		$CI->db->where('categoryID', $categoryID);
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		$nextNum = $offset+$limit;
		if ($nextNum > $totPosts){
		} elseif ($nextNum <= $totPosts){ 
		$nextNum--;
		echo '<a href="'.BASE_URL.$pagURL.'/'.$nextNum.'" class="btn btn-success float-right">Next</a>';}
	}
	
	function getPrevBtn($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('post');
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}

		$prevNum = $offset-$limit;
		if ($prevNum < 0){ $prevNum = 0; }
		if ($prevNum < $offset){
		echo '<a href="'.BASE_URL.$pagURL.'/'.$prevNum.'" class="btn btn-success float-left">Previous</a>';
		}
	}
	
	function getNextBtn($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('post');
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		$nextNum = $offset+$limit;
		if ($nextNum > $totPosts){
		} elseif ($nextNum <= $totPosts){ 
		$nextNum--;
		echo '<a href="'.BASE_URL.$pagURL.'/'.$nextNum.'" class="btn btn-success float-right">Next</a>';}
	}
	
	//Get the Latest news for the main column
	function getCategoryNews($categoryID,$limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit($limit, $offset);
		$CI->db->where('categoryID', $categoryID);
		$query=$CI->db->get('post');
		$posts = '';
		foreach($query->result_array() as $c):
			$date = new DateTime($c['datePosted']);
			$posts .= '<div class="row">';
			if ($c['postImage'] != "") {
			$posts .= '<div class="col-md-3"><a href="/article/'.$c['postURL'].'"><img class="img-responsive" src="'.BASE_URL.'/images/'.$c['postImage'].'" alt="'.$c['postTitle'].'"/></a></div>';
			$posts .= '<div class="col-md-9"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';
			} else {
			$posts .= '<div class="col-md-12"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';			}
			$posts .= '</div>';
			$posts .= "</div><hr />";
		endforeach;
		echo $posts;
	}
	
	
		//Get the carousel
	function getCarousel($id)
	{
		$CI =& get_instance();
		$CI->db->order_by("slideOrder", "asc");
		$CI->db->where("pageID", $id);
		$query=$CI->db->get('banner');
		$carousel = '<ol class="carousel-indicators">'."\r\n";
		$s = 0;
		foreach($query->result_array() as $c):
			if ($s == 0){
				$carousel .= '<li data-target="#carousel" data-slide-to="'.$s.'" class="active"></li>'."\r\n";
			} else {
				$carousel .= '<li data-target="#carousel" data-slide-to="'.$s.'"></li>'."\r\n";
			}
			$s++;
		endforeach;
		$s = 0;
		$carousel .= '</ol><div class="carousel-inner" role="listbox">'."\r\n";
		foreach($query->result_array() as $c):
			if ($s == 0){
			  $carousel .= '<div class="item active">'."\r\n";
			  if ($c['slideLink'] != "") {
			  	$carousel .= '<a target="_blank" href="'.$c['slideLink'].'">'."\r\n";
			  }
			  $carousel .= '<img src="'.BASE_URL."/uploads/".$c['slideImage'].'" alt="'.$c['slideAlt'].'">'."\r\n";
              $carousel .= '<div class="carousel-caption">'."\r\n";
              $carousel .= '<h3>'.$c['slideTitle'].'</h3>'."\r\n";
              $carousel .= '<p>'.$c['slideText'].'</p>'."\r\n";
              $carousel .= '</div>'."\r\n";
			  if ($c['slideLink'] != "") {
			 	$carousel .= '</a>'."\r\n";
			  }
			  $carousel .= '</div>'."\r\n";
			} else {
			  $carousel .= '<div class="item">'."\r\n";
			  if ($c['slideLink'] != "") {
			  	$carousel .= '<a target="_blank" href="'.$c['slideLink'].'">'."\r\n";
			  }
			  $carousel .= '<img src="'.BASE_URL."/uploads/".$c['slideImage'].'" alt="'.$c['slideAlt'].'">'."\r\n";
              $carousel .= '<div class="carousel-caption">'."\r\n";
              $carousel .= '<h3>'.$c['slideTitle'].'</h3>'."\r\n";
              $carousel .= '<p>'.$c['slideText'].'</p>'."\r\n";
              $carousel .= '</div>'."\r\n";              
			  if ($c['slideLink'] != "") {
			 	$carousel .= '</a>'."\r\n";
			  }
			  $carousel .= '</div>'."\r\n";
			}
			$s++;
		endforeach;
		$carousel .= "</div>"."\r\n";
		echo $carousel;
	}


    // Get Partner Carousel
    
	function getPartnerCarousel()
	{
		$CI =& get_instance();
		$CI->db->order_by("partnerID", "asc");
		$query=$CI->db->get('partner');
        $carousel = '<div class="col col-md-12 col-xs-12"><div class="nbs-flexisel-container">'."\r\n";
		$s = 0;
            $carousel .= '<div class="nbs-flexisel-inner">'."\r\n";
			  $carousel .= '<ul id="partnerLogo" class="nbs-flexisel-ul">'."\r\n";
   
		foreach($query->result_array() as $c):
			if ($s == 0){

              $carousel .= '<li class="nbs-flexisel-item">'."\r\n";
			  if ($c['partnerLink'] != "") {
			  	$carousel .= '<a target="_blank"  href="'.$c['partnerLink'].'" alt="'.$c['partnerName'].'">'."\r\n";
			  }
			  $carousel .= '<img src="'.BASE_URL."/uploads/partners/".$c['partnerImg'].'" alt="'.$c['partnerName'].'">'."\r\n";
			  if ($c['partnerLink'] != "") {
			 	$carousel .= '</a>'."\r\n";
			  }
              $carousel .= '</li>'."\r\n";             
			} else {
              $carousel .= '<li class="nbs-flexisel-item">'."\r\n";
			  if ($c['partnerLink'] != "") {
			  	$carousel .= '<a target="_blank"  href="'.$c['partnerLink'].'" alt="'.$c['partnerName'].'">'."\r\n";
			  }
			  $carousel .= '<img src="'.BASE_URL."/uploads/partners/".$c['partnerImg'].'" alt="'.$c['partnerName'].'">'."\r\n";
			  if ($c['partnerLink'] != "") {
			 	$carousel .= '</a>'."\r\n";
			  }
			  $carousel .= '</li>'."\r\n";

			}
			$s++;
		endforeach;
              $carousel .= '</ul>'."\r\n";
             $carousel .= '</div>'."\r\n";
            $carousel .= '</div></div>'."\r\n";
		echo $carousel;
	}
        
	//Get social
	function getSocial()
	{
		$CI =& get_instance();
		$CI->db->where("socialEnabled", 1);
		$query=$CI->db->get('social');
		$social = '';
		foreach($query->result_array() as $c):
			$social .= '<a href="'.$c['socialLink'].'" target="_blank"><span class="socicon socicon-'.$c['socialName'].'"></span></a>';
		endforeach;
		echo $social;
	}

?>