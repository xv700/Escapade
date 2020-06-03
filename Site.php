<?php
/* 
 * 菜鸟教程 RESTful 演示实例
 * RESTful 服务类
 */
Class Site {
	
	private $sites = array(
		0 => 'no data',  
		1 => 'TaoBao',  
		2 => 'Google',  
		3 => 'Runoob',  			
		4 => 'Baidu',  			
		5 => 'Weibo',  
		6 => 'Sina'
			
	);
		
	
	public function getAllSite(){
		return $this->sites;
	}
	
	public function getSite($id){
		return array($id => (isset($this->sites[$id])) ? $this->sites[$id] : $this->sites[0]);
	}	
}
?>