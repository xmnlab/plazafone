<?php
class ClassXmlArray
{   private static $encoding= 'ISO-8859-1';
    private static $version = '1.0';
    private static $html    = false;
    private static $ln      = '';
 
    public static function array2xml($arr,$file=NULL)
    {   $xml ='<?xml version="'.self::$version.'" encoding="'.self::$encoding.'" ?>'.self::$ln;
        $xml.="\n<listaXml>";
        $xml.=self::arrXml($arr);
        $xml.="\n</listaXml>";
        if($file && ($fp=fopen($file,'w')))
        {   fwrite($fp,$xml); 
            fclose($fp);  
            return true; 
        }else return $xml;
    }
 
    private static function arrXml($ar)
    {   if(is_array($ar))
        {   if(count($ar))
            {   $xml='';
                foreach($ar as $k=>$v)
                {   $p='';              
                    $key=is_numeric($k)?'modeloXml':$k;
                    if(is_array($v))
                    {   foreach($v as $pk=>$pv)//Propiedades
                        {   if($pk{0}=='@')
                            {   $p.=' '.str_replace('@','',$pk).'="'.($pv).'"';
                                unset($v[$pk]);
                            }                       
                        } $tm=self::arrXml($v);                                
                    }else $tm=$v;
                    $xml.="\n<$key$p>".($tm)."</$key>";                                           
                }return $xml;   
            }else return '';    
        }else return $ar;
    }
    
    public static function xml2array($file,$html=true)
    {   self::$html=$html;
        if(file_exists($file))
        {   $xxm=simplexml_load_file($file);
            //return self::$xml2arr($xxm);
            return self::_xml2Array($xxm);
            //print_r(self::_xml2Array($xxm));
        }else return false;
    }   
 
    private static function _xml2Array($xml,$attribsAsElements=0) 
    {  if (get_class($xml) == 'SimpleXMLElement') 
       {   $attributes = $xml->attributes();
           foreach($attributes as $k=>$v) {  if ($v) $a[$k] =(string)$v; }
           $x = $xml;
           $xml = get_object_vars($xml);
       }   
       if (is_array($xml)) 
       {   if (count($xml) == 0) return (string)$x;
           foreach($xml as $key=>$value) 
           {   $r[$key] = self::_xml2Array($value,$attribsAsElements);
               if (!is_array($r[$key])) $r[$key] = (string)$r[$key];                
           }
           if (isset($a)) 
           {  if($attribsAsElements) $r = array_merge($a,$r);
              else 
              { foreach($a as $k=>$v)$r['@'.$k]=(string)$v;                                                             
                unset($r['@attributes']);              
              }
           }
           return $r;
       }
       return (string) $xml;
    } 
}