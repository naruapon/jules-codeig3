<?php $this->load->view('templates/header'); ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Register</h3>
            </div>
            <div class="card-body">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php echo form_open('auth/register'); ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" name="country" id="country" value="<?php echo set_value('country'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (min. 8 characters)</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="passconf" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="passconf" id="passconf" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="card-footer text-center">
                <a href="<?php echo base_url('auth/login'); ?>">Already have an account? Login</a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
