<?php include 'View/layout/cabecalho.php'; ?>

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Entre em sua Conta</h2>
                <form action="/?c=Sistema&m=auth" method="post" autocomplete="off" novalidate>
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input name="email" type="email" class="form-control" placeholder="endereço de e-mail" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input name="senha" type="password" class="form-control" placeholder="sua senha" autocomplete="off">
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'View/layout/rodape.php'; ?>