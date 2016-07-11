<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
   
   public function is_unique($str, $field)
   {
      if (substr_count($field, '.')==3)
      {
         list($table,$field,$id_field,$id_val) = explode('.', $field);
         $query = $this->CI->db->limit(1)->where($field,$str)->where($id_field.' != ',$id_val)->get($table);
      } else {
         list($table, $field)=explode('.', $field);
         $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
      }
      
      return $query->num_rows() === 0; 
    }
    /**
     * Validate URL
     *
     * @access    public
     * @param    string
     * @return    string
     */
    function valid_url($url)
    {
        $pattern = "/^((ht|f)tp(s?)\:\/\/|~/|/)?([w]{2}([\w\-]+\.)+([\w]{2,5}))(:[\d]{1,5})?/";
        if (!preg_match($pattern, $url))
        {
            return FALSE;
        }
    
        return TRUE;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Real URL
     *
     * @access    public
     * @param    string
     * @return    string
     */
    function real_url($url)
    {
        return @fsockopen("$url", 80, $errno, $errstr, 30);
    }     
  
}
// END MY Form Validation Class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */  