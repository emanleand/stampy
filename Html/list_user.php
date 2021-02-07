<?php
include_once __DIR__ . '../../Controller/User/ListController.php';

$db = new ListController;
$users = $db->getUsers();

?>
<section id="section-table-user">
    <div class="header-table-user">
        <h3 class="title-table-user">Crud User</h3>
        <a href="#" id="new-user" class="btn info small">New</a>
    </div>
    <table id="table-user" class="table-user" cellspacing="0">
        <thead>
            <tr>
                <th>Id</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Username</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($users as $key => $value) { ?>                     
                    <tr>
                        <th><?php echo $value['id']?></th>
                        <th><?php echo $value['first_name']?></th>
                        <th><?php echo $value['last_name']?></th>
                        <th><?php echo $value['username']?></th>
                        <th><?php echo $value['email']?></th>
                        <th>
                            <button class="edit-user btn info small" id="<?php echo $value['id']?>" value="view">Edit</button>
                        </th>
                        <!-- <th><input type="button" class="edit-user btn info small" id="<?php //echo $value['id']?>" value="view" /></th> -->
                        <th><input type="button" class="delete-user btn alert small" value="delete" onclick="deleteUser(<?php echo $value['id']?>)" /></th>
                    </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</section>