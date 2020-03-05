# coding: latin-1
from pydaruma.pydaruma import iImprimirTexto_DUAL_DarumaFramework
from ctypes import create_string_buffer


Texto = create_string_buffer(2000)
Texto = ''.join([
    "<ce>Avançando 5 Linhas</ce><sl>5</sl>Inserindo<sp>10</sp>10 espaços em Branco<sl>2</sl>",
    "Formatação Normal</ce><l></l>DARUMA AUTOMAÇÃO!!<sl>2</sl><ce>Negr+Ital+Subl+Expand</ce><l></l>",
    "<b><i><s><e>DARUMA AUTOMAÇÃO!!</b></i></s></e><sl>2</sl><ce>Negr+Ital+Subl+Condensado</ce><l></l>",
    "<b><i><s><c>DARUMA AUTOMAÇÃO!!</b></i></s></c><sl>2</sl><ce>Negr+Ital+Subl+Normal</ce><l></l>",
    "<b><i><s><n>DARUMA AUTOMAÇÃO!!</b></i></s></n><sl>2</sl><ce>Expandido</ce><l></l>",
    "<e>DARUMA AUTOMAÇÃO!!</e><sl>2</sl><ce>Condensado</ce><l></l>",
    "<c>DARUMA AUTOMAÇÃO!!</c><sl>2</sl><ce>Negrito+Expandido</ce><l></l>",
    "<b><e>DARUMA AUTOMAÇÃO!!</b></e><sl>2</sl><ce>Itálico+Expandido</ce><l></l>",
    "<i><e>DARUMA AUTOMAÇÃO!!</i></e><sl>2</sl><ce>Sublinhado+Expandido</ce><l></l>",
    "<s><e>DARUMA AUTOMAÇÃO!!</s></e><sl>2</sl><ce>Negrito+Condensado</ce><l></l>",
    "<b><c>DARUMA AUTOMAÇÃO!!</b></c><sl>2</sl><ce>Itálico+Condensado</ce><l></l>",
    "<i><c>DARUMA AUTOMAÇÃO!!</i></c><sl>2</sl><ce>Sublinhado+Condensado</ce><l></l>",
    "<s><c>DARUMA AUTOMAÇÃO!!</s></c><sl>2</sl><ce>Negrito+Normal</ce><l></l>",
    "<b><n>DARUMA AUTOMAÇÃO!!</n></b><l></l>"
])
iImprimirTexto_DUAL_DarumaFramework(Texto,0)
