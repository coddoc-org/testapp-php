<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12 pt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><? echo $cliente->nome; ?></div>
                            <div class="mb-2">
                                Endereço: <strong><? echo $cliente->endereco; ?></strong>
                            </div>
                            <div class="mb-2">
                                Telefone: <strong><? echo $cliente->telefone; ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($cliente->getTipoCliente() == "PF") { ?>
                    <div class="col-12 pt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Pessoa Física</div>
                                <div class="mb-2">
                                    Data de Nascimento: <strong><? echo $cliente->dtNascimento; ?></strong>
                                </div>
                                <div class="mb-2">
                                    CPF: <strong><? echo $cliente->CPF; ?></strong>
                                </div>
                                <div class="mb-2">
                                    Identidade: <strong><? echo $cliente->identidade; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($cliente->getTipoCliente() == "PJ") { ?>
                    <div class="col-12 pt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Pessoa Jurídica</div>
                                <div class="mb-2">
                                    Cadastro Geral de Contribuintes: <strong><? echo $cliente->cgc; ?></strong>
                                </div>
                                <div class="mb-2">
                                    Razão Social: <strong><? echo $cliente->razaoSocial; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>