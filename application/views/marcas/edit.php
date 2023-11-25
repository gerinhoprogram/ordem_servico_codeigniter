<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Marcas</a></li>
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
                        <?php echo formata_data_banco_sem_hora($marca->marca_data_alteracao) ?>
                    </p>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados</legend>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="marca_nome" class="form-label">*Nome marca</label>
                                <input type="text" class="form-control" name="marca_nome" aria-describedby="emailHelp" value="<?php echo $marca->marca_nome ?>">
                                <?php echo form_error('marca_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="marca_ativa" class="form-label">Status</label>
                                <select name="marca_ativa" class="form-control">
                                    <option value="0" <?php echo ($marca->marca_ativa == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($marca->marca_ativa == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                        </div>
                    </legend>
        
                    <input type="hidden" name="marca_id" value="<?php echo $marca->marca_id ?>">

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('marcas') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->