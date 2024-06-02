<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">

            <?php if (isset($_GET['msg'])) { ?>
                <div class="alert alert-success" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            <?php echo urldecode($_GET['msg']); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo strtoupper($_GET['cat']); ?></h3>
                        </div>
                        <div class="list-group list-group-flush list-group-hoverable">

                            <?php foreach ($produtos as $produto) { ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="badge"></span></div>
                                        <div class="col-auto">
                                            <a href="/?c=Venda&m=adicionarAoCarrinho&codProd=<?php echo $produto->codProd; ?>">
                                                <span class="avatar"><?php echo strtoupper(substr($produto->descricao, 0, 2)); ?></span>
                                            </a>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="/?c=Venda&m=adicionarAoCarrinho&codProd=<?php echo $produto->codProd; ?>" class="text-reset d-block"><?php echo $produto->descricao; ?></a>
                                            <div class="d-block text-secondary text-truncate mt-n1">Preço: R$ <?php echo $produto->preco; ?> / Estoque: <?php echo $produto->estoque; ?> / Código: <?php echo $produto->codProd; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="/?c=Venda&m=adicionarAoCarrinho&codProd=<?php echo $produto->codProd; ?>" class="list-group-item-actions"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>