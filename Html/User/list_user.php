<?php
include_once __DIR__ . '../../../Controller/User/ListController.php';

$db = new ListController;
$users = $db->getUsers();
?>
<section id="section-table-user">
    <div class="header-table-user">
        <div class="item">
            <h3 class="title-table-user">Crud User</h3>
        </div>
        <div class="item">
            <a href="#" id="new-user" class="btn info small">
                <i class="fas fa-user-plus"></i>
            </a>
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
                                <a id="<?php echo $value['id']?>" class="edit-user btn info small">
                                    <i class="fas fa-marker"></i>
                                </a>
                            </th>
                            <th>
                                <a id="<?php echo $value['id']?>" class="delete-user btn alert small" onclick="deleteUser(<?php echo $value['id']?>)">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </th>
                        </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
</section>