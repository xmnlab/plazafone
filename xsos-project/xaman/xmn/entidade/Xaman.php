<?php
/**
 * Xaman - Estrutura de Desenvolvimento
 * Copyright (C) 2008  Ivan Ogassavara  
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   xaman
 * @package    xaman
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** EstruturaXaman */
include_once $XAMAN . 'EstruturaXmn.php';

/** DirecaoXMdl */
include_once $XAMAN . 'modelo/DirecaoXMdl.php';

/** ReencarnacaoXMdl */
include_once $XAMAN . 'modelo/ReencarnacaoXMdl.php';

/** TratamentoXaman */
include_once $XAMAN . 'tratamento/TratamentoXmn.php';

/** PanteaoXaman */
include_once $XAMAN . 'panteao/PanteaoXmn.php';

/** EspelhoXaman */
include_once $XAMAN . 'panteao/MascaraXmn.php';

/**
 * Xaman: Classe Mestre
 * 
 * A classe Xaman tem como int�ito promover � Classe extendida métodos
 * essenciais para receber os dados de requisi��o e processar e
 * acionar as classes de fluxo necess�rias � entrega da requisi��o 
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   xaman
 * @package    xaman
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 * @static
 */
class Xaman implements EstruturaXmn
{
    /**
     * A aldeia armazena o endere�o f�sico da ra�z das classes
     * da estrutura de desenvolvimento Xaman
     *
     * @access private
     * @var    string
     * @static 
     */
    private static $aldeia = array();

    /**
     * O numeroReencarnacao
     *
     * @access private
     * @var    string
     * @static 
     */
    private static $reencarnacaoXMdl;
    
    /**
     * Portal
     *
     * @access private
     * @var    array
     * @static 
     */
    public static $portal = array();

    /**
     * Atribui valor para a ra�z das classes da estrutura xaman
     *
     * @access public
     * @param  string $aldeiaXaman
     * @return void
     * @static
     */
    public static function atribuiAldeia($caminho, $aldeiaXaman)
    {
        self::$aldeia[$caminho]= (string) $aldeiaXaman;
    }

    /**
     * Atribui valor para a ra�z das classes da estrutura xaman
     * 
     * @abstract
     * @param DirecaoXMdl
     * @return void
     * @static
     */
    public static function iniciaJornada(DirecaoXMdl &$direcaoMdl)
    {
    }
    
    public static function preparaJornada(SimpleXMLElement $origem)
    {
        $xaman                    = array();
        $roteiro                  = '';
        
        $xaman['lista_aldeia']    = array();
        $xaman['lista_atributo']  = array();
        
        $raiz      = $origem->xpath('/origem');
        
        foreach($raiz as $chave => $conteudo) {
            if (get_class($conteudo) == 'SimpleXMLElement') {
                $atributos = $conteudo->attributes();
                
                $xaman['nome']    = $atributos['xaman'];
                $xaman['raiz']    = $atributos['raiz'];
                $xaman['aldeia']  = $atributos['aldeia'];
                $xaman['caminho'] = $atributos['caminho'];
                
                $roteiro .= 'static $' . $xaman['raiz']
                        . " = '" . $xaman['caminho'] . "';\n";
            }
        }
        
        $raiz = $origem->xpath('/origem/atributo');
        
        foreach($raiz as $chave => $conteudo) {
            if (get_class($conteudo) == 'SimpleXMLElement') {
                $atributos = $conteudo->attributes();
                
                if ($atributos['aldeia'] != '') {
                    $aldeia  = array();
                    
                    $aldeia['nome'] = $atributos['aldeia'];
                    $aldeia['raiz'] = 
                          $xaman['raiz'] . '_'
                        . $atributos['nome'];
                    $aldeia['caminho'] = $atributos['caminho'];
                    
                    $roteiro .= 'static $' . $aldeia['raiz']
                        . " = '" . $aldeia['caminho'] . "';\n";
                    
                    $xaman['lista_aldeia'][] = $aldeia;
                    
                } else {
                    $atributo  = array();
                    
                    $atributo['nome']           = 
                      $xaman['raiz'] . '_' . $atributos['nome'];
                    $atributo['valor']          = $atributos['valor'];
                    $xaman['lista_atributo'][]  = $atributo;
                    
                    $roteiro .= 'static $' 
                        . $atributo['nome']
                        . " = '" . $atributo['valor'] 
                        . "';\n";
                }
                
            }
        }
        
        /** INVOCAÇÃO DO XAMAN */
        
        $roteiro .= 'include_once $' 
            . $xaman['raiz'] . " . '"
            . $xaman['nome'] . ".php';\n";
        
        $roteiro .= "MascaraXmn::adicionaParametro('RAIZ','"
            . $xaman['raiz'] . "');\n";
            
        $roteiro .= "MascaraXmn::adicionaParametro('"
            .  $xaman['raiz'] . "',"
            . '$' . $xaman['raiz'] . ");\n";
            
        /** ATRIBUI INFORMACOES DOS CAMINHOS DAS ALDEIAS */
        foreach ($xaman['lista_aldeia'] as $chave => $conteudo)
        {
            $roteiro .= $xaman['nome'] 
                . "::atribuiAldeia('" . $conteudo['nome'] . "',"
                . '$' . $conteudo['raiz'] . ");\n";
                
            $roteiro .= "MascaraXmn::adicionaParametro('"
            .  $conteudo['raiz'] . "',"
            . '$' . $conteudo['raiz'] . ");\n";
            
        }
        
        /** ATRIBUI INFORMACOES DOS PARAMETROS */
        foreach ($xaman['lista_atributo'] as $chave => $conteudo)
        {
            $roteiro .= "MascaraXmn::adicionaParametro('"
                . $conteudo['nome'] . "','"
                . $conteudo['valor'] . "');\n";
            
        }
        
        /** CHAMADA DO PANTEAO */
        $roteiro .= '$panteao = simplexml_load_file($' 
            . $xaman['raiz'] . "_RITUAL . 'base/panteao.xmn');\n";
        
        $roteiro .= "PanteaoXmn::criaPanteao(\$panteao);\n";
        
        $raiz      = $origem->xpath('/origem/panteao');
        
        foreach($raiz as $chave => $conteudo) {
            if (get_class($conteudo) == 'SimpleXMLElement') {
                $atributos = $conteudo->attributes();
                
                if ($atributos['invoca'] != '') {
                    $roteiro .= "PanteaoXmn::invoca('"
                        . $atributos['invoca']
                        . "');\n";
                }
            }
        }
        
        return $roteiro;
    }
    
    
    /**
     * Atribui valor para a ra�z das classes da estrutura xaman
     * 
     * @param string
     * @return void
     * @static
     */
    public static function mudaJornada($jornada)
    {
        header('Location: ' . $jornada);
    }
    
    /**
     * Pega valor para a ra�z das classes da estrutura xaman
     * 
     * @access public
     * @return string
     * @static
     */
    public static function pegaAldeia($caminho, $direcao = '')
    {
        return self::$aldeia[$caminho] . (string) $direcao;
    }
    
    /**
     * Pega valor de parametros do Xaman
     *
     * @access public
     * @param  string $aldeiaXaman
     * @return void
     * @static
     */
    public static function pegaAtributo($atributo)
    {
        return self::$portal[session_id()]["listaParametro"][$atributo];
    }
    
    /**
     * Atribui valor para a ra�z das classes da estrutura xaman
     * 
     * @param string
     * @return void
     * @static
     */
    public static function pegaDirecaoEstruturada($direcao)
    {
        $direcao = str_replace('?', '%3F', $direcao);
        $direcao = str_replace('=', '%3D', $direcao);
        $direcao = str_replace('&', '%26', $direcao);
        return $direcao;
    }

    public static function exibeTratamentoXaman()
    {
        self::adicionaCaminhoJornada(
            self::pegaAldeiaMascara('/tratamento/tratamento.phtml'));
    }

}