#!/bin/bash
clear

echo "==============="
echo "CodDoc - Configuração"
echo "==============="

# Solicitar o ID do trace via prompt
read -p "# Insira a URL da CodDoc: " codedoc_url

clear

echo "==============="
echo "CodDoc - Rastreamento"
echo "==============="

# Solicitar o ID do trace via prompt
read -p "# Insira a URL da CodDoc: " codedoc_url

# Solicitar o ID do trace via prompt
read -p "# Insira o ID do trace: " id_trace

# Diretório a ser monitorado
diretorio_monitorado=/tmp

# Arquivo de saída
arquivo_saida="$diretorio_monitorado/trace.txt"

# URL da rota Laravel
url_rota="http://$codedoc_url/api/v1/traces/$id_trace/file/upload"

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
    echo "---------------"
    echo "NOVO RASTRO ENCONTRADO!"
    echo "---------------"
    arquivo="$1"

    echo "Coletando dados de $arquivo..."

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

    echo "Concluído."
}

# Função a ser executada antes de sair
limpar_e_sair() {
    clear

    echo "---------------"
    echo "Enviando os dados de rastreamento..."
    echo "---------------"

    # Fazer upload do arquivo para a rota Laravel
    curl -X POST -F "trace_file=@$arquivo_saida" "$url_rota"

    echo "Saindo do script..."

    remover_arquivos_existente

    exit 0
}

# Capturar o sinal SIGINT (Ctrl+C) para sair do script
trap limpar_e_sair SIGINT

# Pedir para pressionar Enter para iniciar o monitoramento
echo "Pressione Enter para iniciar o rastreamento da execução da aplicação..."
read

# Remover arquivos existentes
remover_arquivos_existente

# Iniciar monitoramento
echo "---------------"
echo "RASTREANDO..."
echo "---------------"
echo "Execute os passos do cenário do caso de uso..."
while true; do
    arquivo_novo=$(inotifywait -e create -e moved_to --format "%f" "$diretorio_monitorado")
    # Verificar se o arquivo começa com "trace." e termina com ".xt.gz"
    if [[ "$arquivo_novo" == trace.*.xt.gz ]]; then
        descompactar_arquivo_e_concatenar "$diretorio_monitorado/$arquivo_novo"
    fi

    echo "---------------"
    echo "Ao concluir a execução, prescione CTRL + C para finalizar o rastreamento."
    echo "---------------"
done