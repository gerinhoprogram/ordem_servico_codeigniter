<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('servicos') ?>">Serviços</a></li>
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
                        <legend class="font-small">Dados</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="servico_nome" class="form-label">*Nome</label>
                                <input type="text" class="form-control" name="servico_nome" aria-describedby="emailHelp" value="<?php echo set_value('servico_nome') ?>">
                                <?php echo form_error('servico_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="servico_preco" class="form-label">*Preço</label>
                                <input type="text" class="form-control money" name="servico_preco" aria-describedby="emailHelp" value="<?php echo set_value('servico_preco') ?>">
                                <?php echo form_error('servico_preco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="servico_ativo" class="form-label">Ativo</label>
                                <select name="servico_ativo" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                    </fieldset>
                    <div class="form-group row">
                            <div class="col-md-12">
                                <label for="servico_descricao" class="form-label">Descrição</label>
                                <textarea class="form-control form-control-user" name="servico_descricao"><?php echo set_value('servico_descricao') ?></textarea> 
                            </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('servicos') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->