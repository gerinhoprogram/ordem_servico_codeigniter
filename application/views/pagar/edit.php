<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('pagar') ?>">Conta a pagar</a></li>
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
                        <?php echo formata_data_banco_sem_hora($conta_pagar->conta_pagar_data_alteracao) ?>
                    </p>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados principais</legend>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="conta_pagar_fornecedor_id" class="form-label">Fornecedor</label>
                                <select class="form-control contas_pagar" name="conta_pagar_fornecedor_id">
                                <?php foreach ($fornecedores as $fornecedor): ?>
                                        <option value="<?php echo $fornecedor->fornecedor_id ?>" 
                                            <?php echo $fornecedor->fornecedor_id == $conta_pagar->conta_pagar_fornecedor_id ? 'selected' : '' ?>
                                            <?php echo $fornecedor->fornecedor_ativo == 0 ? 'disabled' : '' ?>>
                                            <?php echo $fornecedor->fornecedor_ativo == 0 ?  $fornecedor->fornecedor_nome_fantasia . '&nbsp;(inativo)' : $fornecedor->fornecedor_nome_fantasia ?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                                <?php echo form_error('conta_pagar_fornecedor_id','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="conta_pagar_data_vencto" class="form-label">Data de vencimento</label>
                                <input type="date" class="form-control" name="conta_pagar_data_vencto" aria-describedby="emailHelp" value="<?php echo $conta_pagar->conta_pagar_data_vencto ?>">
                                <?php echo form_error('conta_pagar_data_vencto','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="conta_pagar_valor" class="form-label">Valor da conta</label>
                                <input type="text" class="form-control form-control-use-date money2" name="conta_pagar_valor" aria-describedby="emailHelp" value="<?php echo $conta_pagar->conta_pagar_valor ?>">
                                <?php echo form_error('conta_pagar_valor','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="situacao" class="form-label">Situação</label>
                                <select class="form-control" name="conta_pagar_status">
                                        <option value="1" <?php ($conta_pagar->conta_pagar_status == 1 ? 'selected' : '') ?>>Pago</option>
                                        <option value="0" <?php ($conta_pagar->conta_pagar_status == 0 ? 'selected' : '') ?>>Pendente</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="situacao" class="form-label">Observações</label>
                                <textarea class="form-control" name="conta_pagar_obs"><?php echo $conta_pagar->conta_pagar_obs ?></textarea>
                                <?php echo form_error('conta_pagar_obs','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                       
                    </fieldset>

                    <input type="hidden" name="conta_pagar_id" value="<?php echo $conta_pagar->conta_pagar_id ?>">

                    <button type="submit" class="btn btn-success btn-md" <?php echo ($conta_pagar->conta_pagar_status == 1 ? 'disabled' : '') ?>><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('pagar') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->