  <div class="container pt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">

      <div class="col-xl-12   col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block" style="background: #ccc"></div>
              <div class="col-lg-6">
                <div class="p-5">
                <?php if($message = $this->session->flashdata('error')) : ?>
                      <div class='row'>
                        <div class='col-lg-12'>
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class='fas fa-exclamation-triangle'></i></strong>&nbsp;&nbsp; <?php echo $message ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        </div>
                      </div>
                  <?php endif; ?>
                  <?php if($message = $this->session->flashdata('info')) : ?>
                      <div class='row'>
                        <div class='col-lg-12'>
                              <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong><i class='fas fa-exclamation-triangle'></i></strong>&nbsp;&nbsp; <?php echo $message ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        </div>
                      </div>
                  <?php endif; ?>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Seja bem vindo!</h1>
                  </div>
                  <form class="user" name="form_aunteticar" method="POST" action="<?php echo base_url('login/autenticar') ?>">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Login (email)">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Senha">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Entrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</body>

</html>
