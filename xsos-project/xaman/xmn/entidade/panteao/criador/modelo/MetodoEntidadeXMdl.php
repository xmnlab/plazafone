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
 * @package    xaman.panteao
 * @subpackage xaman.panteao.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 */

/** ModeloXaman */
include_once $XAMAN . 'modelo/ModeloXmn.php';

/** AtributoXLstMdl */
include_once $XAMAN . 'panteao/criador/modelo/AtributoEntidadeXLstMdl.php';

/**
 * MetodoEntidadeXMdl: Classe que armazena informa��es de m�todo
 * 
 * A classe MetodoEntidadeXMdl � utilizada para armazenar
 * e recuperar informa��es referentes a um m�tddo
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.panteao.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class MetodoEntidadeXMdl extends ModeloXmn
{
    private $arquetipo;
    private $acessibilidade;
    private $abstracao;
    private $parametroXLstMdl;
    private $proposito;
    private $visibilidade;

    const PROPOSITO_NORMAL      = 1;
    const PROPOSITO_ATRIBUICAO  = 2;
    const PROPOSITO_RETORNO     = 3;

    public function __construct()
    {
        $this->parametroXLstMdl = new AtributoEntidadeXLstMdl();
        $this->proposito = self::PROPOSITO_NORMAL;  
    }

   /**
     * 
     *
     * @access   public
     * @param    $acessibilidade
     * @return   void
     */
    public function atribuiAcessibilidade($acessibilidade)
    {
        $this->acessibilidade = $acessibilidade;
    }

    /**
     * 
     *
     * @access   public
     * @param    $abstracao
     * @return   void
     */
    public function atribuiAbstracao($abstracao)
    {
        $this->abstracao = $abstracao;
    }

    /**
     * 
     *
     * @access   public
     * @param    $arquetipo
     * @return   void
     */
    public function atribuiArquetipo($arquetipo)
    {
        $this->arquetipo = $arquetipo;
    }

    /**
     * 
     *
     * @access   public
     * @param    $parametroXLstMdl
     * @return   void
     */
    public function atribuiParametroXLstMdl(AtributoEntidadeXLstMdl $parametroXLstMdl)
    {
        $this->parametroXLstMdl = $parametroXLstMdl;
    }

    /**
     * 
     *
     * @access   public
     * @param    $proposito
     * @return   void
     */
    public function atribuiProposito($proposito)
    {
        switch ($proposito) {
        case self::PROPOSITO_NORMAL:
        case self::PROPOSITO_ATRIBUICAO:
        case self::PROPOSITO_RETORNO:
            $this->proposito = $proposito;
            break;

        default:
            throw new TratamentoXaman();
        }
    }

    /**
     * 
     *
     * @access   public
     * @param    $visibilidade
     * @return   void
     */
    public function atribuiVisibilidade($visibilidade)
    {
        $this->visibilidade = $visibilidade;
    }

    /**
     * 
     *
     * @access   public
     * @return   int
     */
    public function pegaAcessibilidade()
    {
        return $this->acessibilidade;
    }

    /**
     * 
     *
     * @access   public
     * @return   int
     */
    public function pegaAbstracao()
    {
        return $this->abstracao;
    }

    /**
     * 
     *
     * @access   public
     * @return   int
     */
    public function pegaArquetipo()
    {
        return $this->arquetipo;
    }

    /**
     * 
     *
     * @access   public
     * @return   AtributoEntidadeXLstMdl
     */
    public function &pegaParametroXLstMdl()
    {
        return $this->parametroXLstMdl;
    }

   /**
     * 
     *
     * @access   public
     * @return   int
     */
    public function pegaProposito()
    {
        return $this->proposito;
    }

    /**
     * 
     *
     * @access   public
     * @return   int
     */
    public function pegaVisibilidade()
    {
        return $this->visibilidade;
    }
}
