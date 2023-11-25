<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('categorias') ?>">categorias</a></li>
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
                                <label for="categoria_nome" class="form-label">*Nome</label>
                                <input type="text" class="form-control" name="categoria_nome" aria-describedby="emailHelp" value="<?php echo set_value('categoria_nome') ?>">
                                <?php echo form_error('categoria_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="categoria_ativa" class="form-label">Status</label>
                                <select name="categoria_ativa" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                    </fieldset>

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('categorias') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->