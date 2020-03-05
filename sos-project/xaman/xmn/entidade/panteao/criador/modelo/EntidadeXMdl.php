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

include_once $XAMAN . 'panteao/criador/modelo/AtributoEntidadeXLstMdl.php';
include_once $XAMAN . 'panteao/criador/modelo/AutorEntidadeXMdl.php';
include_once $XAMAN . 'panteao/criador/modelo/MetodoEntidadeXLstMdl.php';

/**
 * EntidadeXMdl: Classe que armazena informa��es de uma entidade
 * 
 * A classe EntidadeXMdl tem como objetivo promover acesso para
 * popular informa��es referentes a classe
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.panteao.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class EntidadeXMdl extends ModeloXmn
{
    
    private $estadoAbstracao;
    
    private $acessiblidade;

    private $arquetipo; //INTERFACE OU CLASSE

    private $autorXMdl;
    
    /**
     * O atributoXLstMdl armazena a lista dos atributos da entidade
     *
     * @access private
     * @var    AtributoXLstMdl
     */
    private $atributoXLstMdl;

    /**
     * O atributo categoria armazena o nome da categoria da entidade
     *
     * @access private
     * @var    subPacote
     */
    private $categoria;

    /**
     * O atributo descricao � utilizado para armazenar a descri��o
     * da classe que ser� utilizado dentro do coment�rio dentro da
     * documenta��o de c�digo
     *
     * @access private
     * @var    string
     */
    private $descricao;

    /**
     * O diretorioArmazenamento armazena o endereço onde a entidade
     * deve ser/estar armazenada
     *
     * @access private
     * @var    string
     */
    private $diretorioArmazenamento;

    /**
     * A extensaoXMdl armazena a entidade na qual a entidade corrente
     * irá estender as características e métodos
     *
     * @access private
     * @var    AtributoXLstMdl
     */
    private $extensaoXMdl;

    private $interfaceXMdl;

    /**
     * A introducaoArtefato armazena o texto/comentário que será inserido
     * no início do artefato
     *
     * @access private
     * @var    AtributoXLstMdl
     */
    private $introducaoArtefato;

    /**
     * A introducaoEntidade armazena o texto/comentário que será inserido
     * no início da entidade
     *
     * @access private
     * @var    AtributoXLstMdl
     */
    private $introducaoEntidade;

    /**
     * O metodoXLstMdl armazena a lista dos métodos da entidade
     *
     * @access private
     * @var    AtributoXLstMdl
     */
    private $metodoXLstMdl;

    /**
     * O atributo pacote armazena o nome do pacote da entidade
     *
     * @access private
     * @var    pacote
     */
    private $pacote;

    /**
     * O atributo subPacote armazena o nome do subPacote da entidade
     *
     * @access private
     * @var    subPacote
     */
    private $subPacote;

    /**
     * O atributo visibilidade armazena o tipo de visibilidade da entidade
     *
     * @access private
     * @var    AtributoXLstMdl
     */
    private $visibilidade;

    const ENTIDADE_INTERFACE        = 1;
    const ENTIDADE_CLASSE           = 3;
    const ENTIDADE_CLASSE_MODELO    = 2;

    public function __construct()
    {
        $this->atributoXLstMdl  = new AtributoEntidadeXLstMdl();
        $this->autorXMdl        = new AutorEntidadeXMdl();
        $this->metodoXLstMdl    = new MetodoEntidadeXLstMdl();
    }

    /**
     * Atribui valor para a ra�z das classes do sistema
     * 
     * @access public
     * @param  string $raizEntidade
     * @return void
     **/
    public function atribuiAtributoXLstMdl(AtributoEntidadeXLstMdl $atributoXLstMdl)
    {
        $this->atributoXLstMdl = $atributoXLstMdl;
    }

    /**
     * @access public
     **/
    public function atribuiAutorXMdl(AutorEntidadeXMdl $autorXMdl)
    {
        $this->autorXMdl = $autorXMdl;
    }

    /**
     * @access public
     **/    
    public function atribuiArquetipo($arquetipo)
    {
        $this->arquetipo = $arquetipo;
    }

    /**
     * @access public
     **/
    public function atribuiCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @access public
     **/
    public function atribuiDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * 
     * @access public
     * @return void
     **/
    public function atribuiEstadoAbstracao($estadoAbstracao)
    {
        $this->estadoAbstracao = (bool) $estadoAbstracao;
    }

    /**
     * @access public
     **/
    public function atribuiExtensaoXMdl(EntidadeXMdl $extensaoXMdl)
    {
        $this->extensaoXMdl = $extensaoXMdl;
    }
    
    /**
     * @access public
     **/
    public function atribuiIntroducaoArtefato($introducaoArtefato)
    {
        $this->introducaoArtefato = (string) $introducaoArtefato;
    }
    
    /**
     * @access public
     **/
    public function atribuiIntroducaoEntidade($introducaoEntidade)
    {
        $this->introducaoEntidade = (string) $introducaoEntidade;
    }

    /**
     * @access public
     **/
    public function atribuiMetodoXLstMdl(MetodoEntidadeXLstMdl $metodoXLstMdl)
    {
        $this->metodoXLstMdl = $metodoXLstMdl;
    }

    /**
     * @access public
     **/
    public function atribuiPacote($pacote)
    {
        $this->pacote = $pacote;
    }

    /**
     * @access public
     **/
    public function atribuiSubPacote($subPacote)
    {
        $this->subPacote = $subPacote;
    }

    /**
     * @access public
     **/
    public function atribuiVisibilidade($visibilidade)
    {
        $this->visibilidade = $visibilidade;
    }

    /**
     * @access public
     **/
    public function pegaArquetipo()
    {
        return $this->arquetipo;
    }

    /**
     * @access public
     **/
    public function &pegaAtributoXLstMdl()
    {
        return $this->atributoXLstMdl;
    }

    /**
     * @access public
     **/
    public function &pegaAutorXMdl()
    {
        return $this->autorXMdl;
    }

    /**
     * @access public
     **/
    public function pegaCategoria()
    {
        return $this->categoria;
    }

    /**
     * @access public
     **/
    public function pegaDescricao()
    {
        return $this->descricao;
    }

    /**
     * @access public
     **/
    public function pegaEstadoAbstracao()
    {
        return $this->estadoAbstracao;
    }    

    /**
     * @access public
     **/
    public function &pegaExtensaoXMdl()
    {
        return $this->extensaoXMdl;
    }
    
    /**
     * @access public
     **/
    public function pegaIntroducaoArtefato()
    {
        return $this->introducaoArtefato;
    }
    
    /**
     * @access public
     **/
    public function pegaIntroducaoEntidade()
    {
        return $this->introducaoEntidade;
    }

    /**
     * @access public
     **/
    public function &pegaMetodoXLstMdl()
    {
        return $this->metodoXLstMdl;
    }

    /**
     * @access public
     **/
    public function pegaPacote()
    {
        return $this->pacote;
    }
    
    /**
     * @access public
     **/
    public function pegaSubPacote()
    {
        return $this->subPacote;
    }

    /**
     * @access public
     **/
    public function pegaVisibilidade()
    {
        return $this->visibilidade;
    }
}
