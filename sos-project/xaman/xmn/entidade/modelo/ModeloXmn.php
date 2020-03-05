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
 * @category   modelo
 * @package    xaman
 * @subpackage xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/**
 * ModeloXaman: Classe prim�ria do tipo Modelo
 * 
 * A classe ModeloXaman tem como prop�sito servir para armazenar informa��es
 * de determinado grupo para transitar entre as diversas camadas do sistema
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class ModeloXmn
{
	
    private $id   = 0;
    private $nome = '';
    
    private static $saidaPadrao    = array();
    private static $entradaPadrao  = array();
    
    const UTF8          = 1;
    const ISO88591      = 2;
    const CAIXA_ALTA    = 4;
    const CAIXA_MEDIA   = 8;
    const CAIXA_BAIXA   = 16;

    public function atribuiId($id)
    {
        $this->id = $id;
    }
    
    public function atribuiNome($nome)
    {
        $this->nome = $nome;
    }

    public function pegaId()
    {
        return $this->id;
    }
    
    public function pegaNome()
    {
        return $this->nome;
    }
    
    public static function atribuiSaidaPadrao($xaman, $saidaPadrao)
    {
    	self::$saidaPadrao[$xaman] = $saidaPadrao;
    }
    
    public static function aplicaSaidaPadrao($xaman, $texto)
    {
        if (self::$saidaPadrao[$xaman] == self::CAIXA_ALTA) {
            return strtoupper($texto);
            
        } else if (self::$saidaPadrao[$xaman] == self::CAIXA_BAIXA) {
            return strtolower($texto);
            
        } else if (self::$saidaPadrao[$xaman] == self::CAIXA_MEDIA) {
            return ucfirst($texto);
            
        } else {
            return $texto;
        }
    }
    
    public static function pegaXml(ModeloXmn $modelo,
        $lstAtributos = array())
    {
        $xml = '<modeloXml>';
        foreach ($lstAtributos as $indice => $valor) {
            $xml .= '<' . $valor['atributo'] . '>';
            
            eval ("\$xml .= \$modelo->" . $valor['metodo'] . ";");
            
            $xml .= '</' . $valor['atributo'] . '>';
        }
        $xml .= '</modeloXml>';
        return $xml;
    }
}
