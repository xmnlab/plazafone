<?php
$mes            = $_SERVER['argv'][1];
$mesHex         = dechex($mes);
$anoDec         = $_SERVER['argv'][2];
$anoHex         = dechex($anoDec);
$nomeMes        = '';
$raiz           = '/home/plazafone/.stoq/cat52.plz';
$dataHoraEcf    = '20081014104327';
$e12            = 0; # INDICADOR DO CAMPO DE IMPOSTO
$imposto        = array();
$totalCupom     = array();

$listaMes = array (
    'janeiro', 
    'fevereiro',
    'março',
    'abril',
    'maio',
    'junho',
    'julho',
    'agosto',
    'setembro',
    'outubro',
    'novembro',
    'dezembro');
    
if (!($mes >= 1 && $mes <= 12)) {
    echo "[ERRO]Mês inválido\n";
    exit;
}

$nomeMes = $listaMes[((int) $mes) - 1];
$lstRegistroCancelado = array();

echo 'Mês selecionado: ' . $nomeMes . "\n";

exec("ls $raiz |grep ^B;", $resultado);
exec("mkdir $raiz/$nomeMes");

#
# LAÇO PARA CORRIGIR ARQUIVO POR ARQUIVO
#
foreach ($resultado as $registro => $arquivo) {
    
    # FILTRA ARQUIVO POR MÊS E ANO
    if ($arquivo{10} . $arquivo{11} == strtoupper($mesHex . $anoHex)) {
    
        # ABRE ARQUIVO
        $conteudoArquivo = file_get_contents("$raiz/$arquivo");

        # CRIA VETOR COM O CONTEUDO DO ARQUIVO
        $vetorConteudoArquivo = split("\n", $conteudoArquivo);
        
        # VARRE VETOR PARA CORREÇÃO DE VALORES
        foreach($vetorConteudoArquivo as $chave_vetor => $linha) {

            if (substr($linha, 0, 3) == 'E01') {

                # ALTERAR O REG(E01), COLOCAR A DATA E HORA DA 
                # GRAVAÇÃO DO SB COL(96) EX: "20060915150323" 
                $linha = substr_replace($linha, $dataHoraEcf, 81, 14);

                $vetorConteudoArquivo[$chave_vetor] = $linha;

            } else if (substr($linha, 0, 3) == 'E02') {
                # ALTERAR O REG(E02), COLOCAR DOIS ZEROS(0) COL(245) 
                # REFERENTE AOS SEGUNDOS
                #$linha = substr_replace($linha, '00', 245, 0);

                #$vetorConteudoArquivo[$chave_vetor] = $linha;

            } else if (substr($linha, 0, 3) == 'E12') {
                # ALTERAR O REG(E12), COLOCAR DOIS ZEROS(0) COL(245) 
                # REFERENTE AOS SEGUNDOS
                #$linha = substr_replace($linha, '00', 85, 0);

                #$vetorConteudoArquivo[$chave_vetor] = $linha;
                
                # VERIFICA O MENOR INDICADOR PARA O CAMPO DO IMPOSTO
                if ($e12 > (int) substr($linha, 48, 4)) {
                    $e12 = (int) substr($linha, 48, 4);
                }
                
            } else if (substr($linha, 0, 3) == 'E15') {
                # ALTERAR O REG(E15)
                # ALTERA REGISTRO CASO O VALOR DE PEÇA = 10000
                
                if (substr($linha, 178, 4) == '0000') {
                    # ALTERA VALOR DE QUANTIDADE
                    $tmp = str_pad(((int) substr($linha, 175, 7)) / 1000, 7, '0', 
                        STR_PAD_LEFT);
                    $linha = substr_replace($linha, $tmp, 175, 7);
                    
                    # ALTERA VALOR UNITARIO
                    $tmp = str_pad(((int) substr($linha, 185, 8)) / 100, 8, '0', 
                        STR_PAD_LEFT);
                    $linha = substr_replace($linha, $tmp, 185, 8);
                    
                    # ALTERA VALOR TOTAL
                    $tmp = str_pad(((float) substr($linha, 209, 14)) / 10000, 14, '0', 
                        STR_PAD_LEFT);
                    $linha = substr_replace($linha, $tmp, 210, 14);
                    
                    # CALCULA O VALOR DO IMPOSTO
                    if (!isset($totalCupom[substr($linha, 223, 7)])) {
                        $totalCupom[substr($linha, 223, 7)] = 0;
                    }
                    $totalCupom[substr($linha, 223, 7)] += (int) $tmp;
                }

                $vetorConteudoArquivo[$chave_vetor] = $linha;

            } else if (substr($linha, 0, 3) == 'E16') {
                # ALTERAR O REG(E16) */
                
                # REMOVE DUAS POSIÇÕES
                $linha = substr_replace($linha, '', 72, 2);
                
                # ACRESCEMTA DOIS CARACTERES 0
                $linha = substr_replace($linha, '00', 88, 0);

                $vetorConteudoArquivo[$chave_vetor] = $linha;
                
            } else if (substr($linha, 0, 3) == 'E21') {
                # REGISTRAR OS VALORES PARA A CORREÇÃO DO REGISTRO 21
                
                # DIMINUIR DOIS CARACTERES 0 DO CAMPO
                $tmp = substr( $linha, 79, 11);

                $vetorConteudoArquivo[$chave_vetor] = substr_replace(
                    $vetorConteudoArquivo[$chave_vetor], 
                    str_pad($tmp, 13, '0', STR_PAD_LEFT), 79, 13);

                if (substr($linha, 92, 1) == 'S') {
                    $lstRegistroCancelado[] = substr($linha, 54, 4);

                    # DIMINUIR DOIS CARACTERES 0 DO VALOR ESTORNADO
                    $tmp = (int) substr( $linha, 93, 13);
                    if ($tmp > 0) {
                        $tmp = $tmp / 100;
                    }

                    $vetorConteudoArquivo[$chave_vetor] = substr_replace(
                        $vetorConteudoArquivo[$chave_vetor], 
                        str_pad($tmp, 13, '0', STR_PAD_LEFT), 93, 13); 
                }
            }
        }
        
        # RETORNA AO LAÇO PARA CORRIGIR OS PRIMEIROS CAMPOS
        foreach ($vetorConteudoArquivo as $chave_vetor => &$linha) {
            if (substr($linha, 0, 3) == 'E14') {
                foreach ($lstRegistroCancelado as $lstCanChave => $lstCanVal) {
                    if (substr($linha, 48, 4) == $lstCanVal) {
                        $linha = substr_replace($linha, 'S', 122, 1);
                    }
                }
            }
        }
        
        $conteudoArquivo = implode("\n", $vetorConteudoArquivo);
        file_put_contents("$raiz/$nomeMes/$arquivo", $conteudoArquivo);

        echo "$arquivo - OK\n";
    }
}

exec("cd $raiz;zip -r /home/plazafone/Área\ de\ Trabalho/{$nomeMes}.zip $nomeMes");

exit;
