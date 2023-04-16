<?php 

$c = new Courses();

$payments = $c->getPaymentInfo();

?>


<section>

    <h4>Enrollment Info</h4>
    <table class="table container bg-warning-subtle shadow my-3 rounded" id="dataTable">
        <thead>
            <tr>
                <th>TrxId</th>
                <th>username</th>
                <th>Course</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($payments as $p){ ?>

            <tr>
                <td><?php echo ($p['trx_id']); ?></td>
                <td><?php echo htmlspecialchars($p['username']); ?></td>
                <td><?php echo htmlspecialchars($p['course_code']); ?></td>
                <td><?php echo htmlspecialchars($p['approval']); ?></td>

                <td>
                    <a class="btn btn-info" href="edit-user/?username=<?= $p['trx_id']?>">Approve</a>
                    <a class="btn btn-danger" href="delete-user/?username=<?= $p['trx_id']?>">Withdraw</a>
                </td>
            </tr>

            <?php } ?>

        </tbody>
    </table>

</section>
