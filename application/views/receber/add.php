<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('receber') ?>">Conta a receber</a></li>
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
                <form method="POST" name="form_add" class="user">
                   
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados principais</legend>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="conta_receber_cliente_id" class="form-label">cliente</label>
                                <select class="form-control contas_receber" name="conta_receber_cliente_id">
                                <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente->cliente_id ?>" 
                                            <?php echo $cliente->cliente_ativo == 0 ? 'disabled' : '' ?>>
                                            <?php echo $cliente->cliente_ativo == 0 ?  $cliente->cliente_nome . '&nbsp;(inativo)' : $cliente->cliente_nome ?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                                <?php echo form_error('conta_receber_cliente_id','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="conta_receber_data_vencto" class="form-label">Data de vencimento</label>
                                <input type="date" class="form-control" name="conta_receber_data_vencto" aria-describedby="emailHelp" value="<?php echo set_value('conta_receber_data_vencto') ?>">
                                <?php echo form_error('conta_receber_data_vencto','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="conta_receber_valor" class="form-label">Valor da conta</label>
                                <input type="text" class="form-control form-control-use-date money2" name="conta_receber_valor" aria-describedby="emailHelp" value="<?php echo set_value('conta_receber_valor') ?>">
                                <?php echo form_error('conta_receber_valor','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="situacao" class="form-label">Situação</label>
                                <select class="form-control" name="conta_receber_status">
                                        <option value="1">Recebido</option>
                                        <option value="0">Pendente</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="situacao" class="form-label">Observações</label>
                                <textarea class="form-control" name="conta_receber_obs"><?php echo set_value('conta_receber_obs') ?></textarea>
                                <?php echo form_error('conta_receber_obs','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                       
                    </fieldset>

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('receber') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->