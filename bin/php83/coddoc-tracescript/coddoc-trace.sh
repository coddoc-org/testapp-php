#!/bin/bash

# Diretório a ser monitorado
diretorio_monitorado=/tmp

# Arquivo de saída
arquivo_saida="$diretorio_monitorado/trace.txt"

# Função para criar arquivo de saída se não existir
criar_arquivo_saida() {
    if [ ! -e "$arquivo_saida" ]; then
        touch "$arquivo_saida"
    fi
}

# Função para remover arquivos existentes
remover_arquivos_existente() {
    rm -f "$arquivo_saida" "$diretorio_monitorado"/trace.*.xt.gz "$diretorio_monitorado"/trace.*.xt
}

# Função para descompactar arquivo e concatenar ao arquivo de saída
descompactar_arquivo_e_concatenar() {
    arquivo="$1"

    # Verificar tamanho do arquivo a cada segundo para determinar se a escrita terminou
    tamanho_atual=$(stat -c %s "$arquivo")
    while true; do
        sleep 1
        tamanho_novo=$(stat -c %s "$arquivo")
        if [ "$tamanho_atual" -eq "$tamanho_novo" ]; then
            break
        else
            tamanho_atual="$tamanho_novo"
        fi
    done

    # Descompacta o arquivo
    gzip -d "$arquivo"

    # Criar arquivo de saída se não existir
    criar_arquivo_saida

    # Concatenar conteúdo ao arquivo de saída
    cat "${arquivo%.xt.gz}.xt" >> "$arquivo_saida"

    # Apagar o arquivo .xt após concatenação
    rm "${arquivo%.xt.gz}.xt"

    # Apagar o arquivo .gz após descompactação
    rm "$arquivo"
}

# Remover arquivos existentes
remover_arquivos_existente

while true; do
    arquivo_novo=$(inotifywait -e create -e moved_to --format "%f" "$diretorio_monitorado")
    # Verificar se o arquivo começa com "trace." e termina com ".xt.gz"
    if [[ "$arquivo_novo" == trace.*.xt.gz ]]; then
        descompactar_arquivo_e_concatenar "$diretorio_monitorado/$arquivo_novo"
    fi
done
