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
 * @package    xaman.modelo
 * @subpackage xaman.modelo.comum
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ModeloXaman */ 
include_once $XAMAN . 'modelo/ModeloXmn.php';

/** CidadeModelo */ 
include_once $XAMAN . 'modelo/comum/CidadeXMdl.php';

/** ZonaModelo */ 
include_once $XAMAN . 'modelo/comum/ZonaXMdl.php';

/**
 * BairroModelo: Classe modelo para armazenar bairro
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo.comum
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class BairroXMdl extends ModeloXmn
{
    /**
     * O atributo zonaXMdl armazena o modelo referente 
     * à zona a qual o bairro pertence
     *
     * @access private
     * @var    string
     */
    private $zonaXMdl;

    /**
     * O atributo cidadeXMdl armazena o modelo referente 
     * à cidade a qual o bairro pertence
     *
     * @access private
     * @var    string
     */
    private $cidadeXMdl;
 
    /**
     * O construtor da Classe instancia cidadeXMdl e zonaXMdl 
     * para que os atributos fiquem prontos assim que a classe
     * for instanciada
     *
     * @access public
     */   
    public function __construct()
    {
        $this->cidadeXMdl = new CidadeXMdl();
        $this->zonaXMdl   = new ZonaXMdl();
    }

    /**
     * Atribui um modelo de cidade ao bairro
     *
     * @access public
     * @param  CidadeXMdl $cidadeXMdl
     * @return void
     */
    public function atribuiCidadeXMdl(CidadeXMdl $cidadeXMdl)
    {
        $this->cidadeXMdl = $cidadeXMdl;
    }

    /**
     * Atribui um modelo de zona ao bairro
     *
     * @access public
     * @param  ZonaXMdl $zonaXMdl
     * @return void
     */
    public function atribuiZonaXMdl(ZonaXMdl $zonaXMdl)
    {
        $this->zonaXMdl = $zonaXMdl;
    }

    /**
     * Pega o modelo da cidade do bairro
     *
     * @access public
     * @return CidadeXMdl
     */
    public function &pegaCidadeXMdl()
    {
        return $this->cidadeXMdl;
    }

    /**
     * Pega o modelo da zona do bairro
     *
     * @access public
     * @return ZonaXMdl
     */
    public function &pegaZonaXMdl()
    {
        return $this->zonaXMdl;
    }

    
}
