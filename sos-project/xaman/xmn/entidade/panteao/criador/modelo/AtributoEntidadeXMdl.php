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

/**
 * AtributoEntidadeXMdl: Classe que armazena informações de atributo
 * 
 * A classe AtributoEntidadeXMdl é utilizada para armazenar
 * e recuperar informações referentes a um atributo
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.panteao.construtor.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class AtributoEntidadeXMdl extends ModeloXmn
{
    private $visibilidade;
    private $acessibilidade;
    private $abstracao;
    private $arquetipo;

    const   ATRIBUTO_PRIVADO         = 1;
    const   ATRIBUTO_PUBLICO         = 2;
    const   ATRIBUTO_PROTEGIDO       = 4;
    const   ATRIBUTO_ABSTRATO        = 8;
    const   ATRIBUTO_NAO_ABSTRATO    = 16;
    const   ATRIBUTO_ESTATICO        = 32;
    const   ATRIBUTO_NAO_ESTATICO    = 64;
    const   ATRIBUTO_INTEIRO         = 128;
    const   ATRIBUTO_FLUTUANTE       = 256;
    const   ATRIBUTO_TEXTO           = 512;
    const   ATRIBUTO_DATA            = 1024;
    const   ATRIBUTO_BOLEANO         = 2048;
    const   ATRIBUTO_OBJETO          = 4096;

    public function __construct($definicaoAtributo = 0)
    {
        $this->visibilidade      = self::ATRIBUTO_PRIVADO;
        $this->acessibilidade    = self::ATRIBUTO_NAO_ESTATICO;
        $this->abstracao         = self::ATRIBUTO_NAO_ABSTRATO;
        
        /*VERIFICACAO DE VISIBILIDADE DO ATRIBUTO*/
        switch (true) {
        case $definicaoAtributo & self::ATRIBUTO_PRIVADO:
            $this->visibilidade = self::ATRIBUTO_PRIVADO;
            break;

        case $definicaoAtributo & self::ATRIBUTO_PUBLICO:
            $this->visibilidade = self::ATRIBUTO_PUBLICO;
            break;

        case $definicaoAtributo & self::ATRIBUTO_PROTEGIDO:
            $this->visibilidade = self::ATRIBUTO_PROTEGIDO;
            break;
        }

        /*VERIFICACAO DE ABSTRACAO DO ATRIBUTO*/
        switch (true) {
        case $definicaoAtributo & self::ATRIBUTO_ABSTRATO:
            $this->abstracao = self::ATRIBUTO_ABSTRATO;
            break;

        case $definicaoAtributo & self::ATRIBUTO_NAO_ABSTRATO:
            $this->abstracao = self::ATRIBUTO_NAO_ABSTRATO;
            break;
        }

        /*VERIFICACAO DE ACESSIBILIDADE DO ATRIBUTO*/
        switch (true) {    
        case $definicaoAtributo & self::ATRIBUTO_ESTATICO:
            $this->acessibilidade = self::ATRIBUTO_ESTATICO;
            break;

        case $definicaoAtributo & self::ATRIBUTO_NAO_ESTATICO:
            $this->acessibilidade = self::ATRIBUTO_NAO_ESTATICO;
            break;
        }

        /*VERIFICACAO DO ARQUETIPO DO ATRIBUTO*/
        switch (true) {    
        case $definicaoAtributo & self::ATRIBUTO_INTEIRO:
            $this->arquetipo = self::ATRIBUTO_INTEIRO;
            break;

        case $definicaoAtributo & self::ATRIBUTO_FLUTUANTE:
            $this->arquetipo = self::ATRIBUTO_FLUTUANTE;
            break;

        case $definicaoAtributo & self::ATRIBUTO_TEXTO:
            $this->arquetipo = self::ATRIBUTO_TEXTO;
            break;

        case $definicaoAtributo & self::ATRIBUTO_DATA:
            $this->arquetipo = self::ATRIBUTO_DATA;
            break;

        case $definicaoAtributo & self::ATRIBUTO_BOLEANO:
            $this->arquetipo = self::ATRIBUTO_BOLEANO;
            break;

        case $definicaoAtributo & self::ATRIBUTO_OBJETO:
            $this->arquetipo = self::ATRIBUTO_OBJETO;
            break;
        }
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
     * @return   int
     */
    public function pegaVisibilidade()
    {
        return $this->visibilidade;
    }

}
