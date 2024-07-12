<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">

            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">CARRINHO</h3>
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

                <div class="col-12">
                    <div class="row g-2 align-items-center">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <a id="comprar" href="/?c=Venda&m=realizarCheckout" class="btn btn-primary w-100">
                                Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>