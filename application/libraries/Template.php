<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CODEIGNITER template library
 *
 * @author	JŽr™me Jaglale
 * @url		http://maestric.com/doc/php/codeigniter_template
 */

class Template
{
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
		
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
			
			$footer = '<div id="footer">
						<hr size="6" style="background-color: #00aeef; border: none; margin: 0 0 10px 0;" />
						Copyright &copy; 2015 ALTO Network
						<br />
						<a id="link" href="http://www.alto.co.id">www.alto.co.id</a>
					  </div>';
			
			$this->set('background', 'url('.base_url().'asset/admin/background_login.jpg) no-repeat');
			$this->set('header_start', '<div id="header"><a href="'.site_url().'"><img src="'.base_url().'asset/admin/logo.png" width="220px" /></a>');
			$this->set('header_end', '</div>');
			$this->set('footer', $footer);
			return $this->CI->load->view($template, $this->template_data, $return);
		}
}

class Template_Fin
{
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
		
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
			
			$footer = '<div id="footer">
						<hr size="6" style="background-color: #00aeef; border: none; margin: 0 0 10px 0;" />
						Copyright &copy; 2015 ALTO Network
						<br />
						<a id="link" href="http://www.alto.co.id">www.alto.co.id</a>
					  </div>';
			
			$this->set('background', 'url('.base_url().'asset/admin/background_login.jpg) no-repeat');
			$this->set('header_start', '<div id="header"><a href="'.site_url().'"><img src="'.base_url().'asset/admin/logo.png" width="220px" /></a>');
			$this->set('header_end', '</div>');
			$this->set('footer', $footer);
			return $this->CI->load->view($template, $this->template_data, $return);
		}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */