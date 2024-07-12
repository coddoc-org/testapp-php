<form action="/?c=Venda&m=finalizarCompra" method="post" autocomplete="off" novalidate>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">



                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">CHECKOUT</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Nome</label>
                                <div>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Nome" value="<? echo $cliente->nome; ?>">
                                    <small class="form-hint">Nome para notas fiscais</small>
                                </div>
                            </div>
                            <?php if ($cliente->getTipoCliente() == "PF") { ?>
                                <div class="mb-3">
                                    <label class="form-label required">Data de Nascimento</label>
                                    <div>
                                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Data de Nascimento" value="<? echo $cliente->dtNascimento; ?>">
                                        <small class="form-hint">Data de nascimento</small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Identidade</label>
                                    <div>
                                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Identidade" value="<? echo $cliente->identidade; ?>">
                                        <small class="form-hint">Número do documento de identidade</small>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($cliente->getTipoCliente() == "PJ") { ?>
                                <div class="mb-3">
                                    <label class="form-label required">Número do CGC</label>
                                    <div>
                                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Número do CGC" value="<? echo $cliente->cgc; ?>">
                                        <small class="form-hint">Cadastro geral de contribuintes</small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Razão Social</label>
                                    <div>
                                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Razão Social" value="<? echo $cliente->razaoSocial; ?>">
                                        <small class="form-hint">Razão Social</small>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="mb-3">
                                <label class="form-label required">Endereço</label>
                                <div>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Endereço" value="<? echo $cliente->endereco; ?>">
                                    <small class="form-hint">Endereço de entrega</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">E-mail</label>
                                <div>
                                    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="E-mail" value="<? echo $cliente->email; ?>">
                                    <small class="form-hint">E-mail para receber notificações sobre a compra</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Telefone</label>
                                <div>
                                    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Telefone" value="<? echo $cliente->telefone; ?>">
                                    <small class="form-hint">Telefone para contato</small>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <div class="mt-5 mb-5"></div>

            <div class="row row-cards">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PRODUTOS</h3>
                        </div>
                        <div class="list-group list-group-flush list-group-hoverable">

                            <?php foreach ($carrinho as $produto) { ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="badge"></span></div>
                                        <div class="col-auto">
                                            <a href="#">
                                                <span class="avatar"><?php echo strtoupper(substr($produto->descricao, 0, 2)); ?></span>
                                            </a>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-reset d-block"><?php echo $produto->descricao; ?></a>
                                            <div class="d-block text-secondary text-truncate mt-n1">Preço: R$ <?php echo $produto->preco; ?> / Estoque: <?php echo $produto->estoque; ?> / Código: <?php echo $produto->codProd; ?></div>
                                        </div>
                                        <div class="col-auto">

                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-5 mb-5"></div>

            <div class="row row-cards">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">FATURAMENTO</h3>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Total de Itens</label>
                                <div class="form-control-plaintext"><?php echo $totalDeItens ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Valor Total</label>
                                <div class="form-control-plaintext">R$ <?php echo $valorTotal ?></div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>


            <div class="mt-5 mb-5"></div>


            <div class="row row-cards">
                <div class="col-12">



                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DADOS DO CARTÃO DE CRÉDITO</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Número do Cartão</label>
                                <div>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Número do Cartão">
                                    <small class="form-hint">Nome para notas fiscais</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Data de Validade</label>
                                <div>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Data de Validade">
                                    <small class="form-hint">Data de Validade</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Código de Autorização</label>
                                <div>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Código de Autorização">
                                    <small class="form-hint">Código de Autorização</small>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <button id="finalizar" type="submit" class="btn btn-primary">Finalizar Compra</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</form>