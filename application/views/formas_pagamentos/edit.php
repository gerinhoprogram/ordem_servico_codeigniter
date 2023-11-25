<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('modulo') ?>">Formas de pagamentos</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo $titulo ?>
                </li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
                <form method="POST" name="form_edit" class="user">
                    <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última atualização:</strong>
                        <?php echo formata_data_banco_sem_hora($forma_pagamento->forma_pagamento_data_alteracao) ?>
                    </p>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="forma_pagamento_nome" class="form-label">*Nome forma pagamento</label>
                                <input type="text" class="form-control" name="forma_pagamento_nome" aria-describedby="emailHelp" value="<?php echo $forma_pagamento->forma_pagamento_nome ?>">
                                <?php echo form_error('forma_pagamento_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="forma_pagamento_ativa" class="form-label">Status</label>
                                <select name="forma_pagamento_ativa" class="form-control">
                                    <option value="0" <?php echo ($forma_pagamento->forma_pagamento_ativa == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($forma_pagamento->forma_pagamento_ativa == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="forma_pagamento_aceita_parc" class="form-label">Aceita parcelamento</label>
                                <select name="forma_pagamento_aceita_parc" class="form-control">
                                    <option value="0" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                        </div>
                    </legend>
        
                    <input type="hidden" name="forma_pagamento_id" value="<?php echo $forma_pagamento->forma_pagamento_id ?>">

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('modulo') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->