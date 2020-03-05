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
 * @category   artefato
 * @package    xaman
 * @subpackage xaman.artefato
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ModeloXaman */
include_once $XAMAN . 'modelo/artefato/ArtefatoXMdl.php';

/**
 * ArtefatoXaman: Classe para armazenar Artefatos
 * 
 * A classe ArtefatoXaman tem como int�ito servir como um "objeto"
 * no possui um conteudo e tem um tipo para a sua caracteriza��o
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   artefato
 * @package    xaman.artefato
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class GravuraXMdl extends ArtefatoXMdl
{
    /*
     *  Detalhes: (formato)[valor padrão]
     *  altura        (0px)[0px], 
     *  largura       (0px)[0px], 
     *  min-altura    (0px)[0px], 
     *  max-altura    (0px)[0px], 
     *  min-largura   (0px)[0px], 
     *  max-largura   (0px)[0px],
     *  cor-fundo     (#FFFFFF)[#FFFFFF],
     *  enquadramento (sim/nao)[nao],
     *  localizacao ('/home/usuario/imagem.png')['']
     */
    private $detalhes;

    
    /**
     * @access     public
     * @return     void
     * @param      detalhe
     **/    
    public function atribuiDetalhes($detalhe)
    {
        $this->detalhes = $detalhe;
    }

    /**
     * @access     public
     * @return     int
     **/    
    public function pegaDetalhes()
    {
        return $this->detalhes;
    }
    
    /**
     * @access     public
     * @return     int
     **/
    public function atribuiDetalhe($item, $valor)
    {
        $this->detalhes = EscritaXmn::atribuiValorListaTexto(
            $this->detalhes, $item, $valor);
        
    }
    
    /**
     * @access     public
     * @return     int
     **/
    public function pegaDetalhe($item)
    {
        return EscritaXmn::pegaValorListaTexto($this->detalhes, $item);
    }
}
