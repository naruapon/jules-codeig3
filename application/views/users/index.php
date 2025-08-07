<?php $this->load->view('templates/header'); ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">User List</h3>
    </div>
    <div class="card-body">
        <p>This page is only visible to administrators.</p>

        <?php if (!empty($users)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Role</th>
                            <th>Registered On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['country']; ?></td>
                                <td><span class="badge bg-<?php echo ($user['role'] === 'admin') ? 'success' : 'secondary'; ?>"><?php echo $user['role']; ?></span></td>
                                <td><?php echo $user['created_at']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No users found.</div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
