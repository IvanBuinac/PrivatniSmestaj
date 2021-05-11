<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class SmartUrl
{
    //file
    private $m_file="";
    public function setFile($value)
    {
        $this->m_file = $value;
    }
    public function getFile()
    {
        return $this->m_file;
    }
    
    //text
    private $m_text="";
    public function setText($value)
    {
        $this->m_text = $value;
    }
    public function getText()
    {
        return $this->m_text;
    }
    //internal variables
    private $m_baseUrl;
    private $m_parameters=array();
    
    //constructor
    function __construct($baseUrl)
    {
        $this->m_baseUrl=$baseUrl;
    }
    
    //add parameters
    public function add_parameter($parameterName,$parameterValue)
    {
        $this->m_parameters[$parameterName]=$parameterValue;
    }
    
    public function render(){
        $r="";
        
        $base_url=$this->m_baseUrl;
        $parameters=  $this->m_parameters;
        $file=  $this->m_file;
        

        //build it
        if(trim($file))
        {
            $r.=$base_url."/".$file;
        }
        else
        {
            $r.=$base_url;
        }
        
        
        //add parameters
        if(count($parameters)>0)
        {
            $r.="?";
            $index=0;
            foreach ($parameters as $parameterKey => $parameterValue)
            {
                //add & if not first time
                if($index>=1)
                {
                    $r.="&";
                }
                
                //build
                $r.=$parameterKey."=".$parameterValue;
                
                //increment
                $index++;
            }
        }
        return $r;
    }
    
    public function renderLink()
    {
        $r="";
        $textToDisplay="";
        //variables
        $url=  $this->render();
        $text = $this->m_text;
        if(trim($text)=="")
        {
            $textToDisplay=$url;
        }
        else
        {
            $textToDisplay=$text;
        }
        //build the link
        $r.="<a href='$url' title='$textToDisplay'>$textToDisplay</a>";
        return $r;
    }
    
    public static function BuildLink($url,$file,$parameters,$text,$link)
    {
        $r.="";
        $smartUrl=new SmartUrl($url);
        $smartUrl->setFile($file);
        
        if(count($parameters)>0)
        {
            foreach ($parameters as $parameterKey => $parameterValue)
            {
                $smartUrl->add_parameter($parameterKey, $parameterValue);
            }
        }
        
        if($link==TRUE)
        {
        $smartUrl->setText($value);
        $r.=$smartUrl->renderLink();
        }
        else
        {
        $r.=$smartUrl->render();
        }
        
        return $r;
    }
}