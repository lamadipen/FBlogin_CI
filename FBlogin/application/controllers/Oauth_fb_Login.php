<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 
//include the facebook.php from libraries directory
require_once APPPATH . 'libraries/Facebook/autoload.php';


use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;

class Oauth_fb_Login extends CI_Controller {
    
    public $user ="";
    private $app_id ="1545133145805354";
    private $app_secret ="e2f35895f03c06a6a757ff30f267dc43";
    private $redirect_url ="http://localhost:8080/FBlogin/index.php/";
    function Oauth_fb_Login()
    {
        
        parent::__construct();
        $this->load->library('session');
        
        //$this->load->library('Facebook\facebook', array('app_id' => '1545133145805354', 'app_secret' => 'e2f35895f03c06a6a757ff30f267dc43'));
        
        //$this->user = $this->facebook->getUser();
        

    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
        /**
	public function index()
	{
		
        
        if ($this->user) {
            try {
                $data['user_profile'] = $this->facebook
                    ->api('/me');
                    
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }
 
        if ($this->user) {
            $data['logout_url'] = $this->facebook
                ->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook
               ->getLoginUrl();
               
            print_r($data['login_url']);   
        }

        $this->load->view('fb_login',$data);
  
   
    }
     **/
    /** from codezone4.wordpress.com 
        url =>https://codezone4.wordpress.com/2013/05/19/codeigniter-facebook-login-tutorial-using-facebook-php-sdk/
    **/ 
    
    function fbtest()
    {        
        $facebook = new Facebook(array('app_id' => '1545133145805354', 'app_secret' => 'e2f35895f03c06a6a757ff30f267dc43', 'default_graph_version' => 'v2.3'));
        
        // Choose your app context helper
        $helper = $facebook->getCanvasHelper();
        //$helper = $fb->getPageTabHelper();
        //$helper = $fb->getJavaScriptHelper();
        
        $signed_in = $helper->getSignedRequest();
        
        // Get the user ID if signed request exists
        $user = $signed_in ? $signed_in->getUserId() : null;
        print_r($signed_in);
        
    }
    
    function fbLogin()
    {   
        // Initialize the SDK.
        //FacebookSession::setDefaultApplication($this->app_id, $this->app_secret);
        $facebook = new Facebook(array('app_id' => '1545133145805354', 'app_secret' => 'e2f35895f03c06a6a757ff30f267dc43', 'default_graph_version' => 'v2.3'));
        
        //$redirectHelper = new FacebookRedirectLoginHelper($this->redirect_url);
        
        $access_token_session = $this->session->userdata('access_token');
        //Authorize the user
        try
        {
            
        }
        catch( FacebookRequestException $ex )
        {
            // When Facebook returns an error.
            print_r( $ex );
        }
        catch(\Exception $ex)
        {
             // When validation fails or other local issues.
            print_r( $ex );
        }
        
        if(isset($access_token_session))
        {
            
        }
        else
        {
            // Generate the login URL for Facebook authentication.
            //$login_url = $redirectHelper->getLoginUrl();
            $helper = $facebook->getRedirectLoginHelper();
            
            $login_url = $helper->getLoginUrl("http://localhost:8080/FBlogin/index.php/"."/Oauth_fb_Login/");
            $data['login_url'] = $login_url;
            $this->load->view('fb_login',$data);
            print_r($login_url);
        }
    }
    

    
     
}
