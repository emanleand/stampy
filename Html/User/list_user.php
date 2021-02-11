<?php
include_once __DIR__ . '../../../Controller/User/ListController.php';

$db = new ListController;
$table = $db->getTableUsers();

?>
<section id="section-table-user">
    <div class="header-table-user">
        <div class="item">
            <h3 class="title-table-user">Crud User</h3>
        </div>
        <div class="item">
            <a href="#" id="new-user" class="btn info small">
                insert
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
                    foreach ($table['users'] as $key => $value) { ?>                     
                        <tr>
                            <th><?php echo $value['id']?></th>
                            <th><?php echo $value['first_name']?></th>
                            <th><?php echo $value['last_name']?></th>
                            <th><?php echo $value['username']?></th>
                            <th><?php echo $value['email']?></th>
                            <th>
                                <a id="<?php echo $value['id']?>" class="edit-user btn info small">
                                    update
                                </a>
                            </th>
                            <th>
                                <a id="<?php echo $value['id']?>" class="delete-user btn alert small" onclick="deleteUser(<?php echo $value['id']?>)">
                                    delete
                                </a>
                            </th>
                        </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul>
                <li class="btn"><a href=" <?php echo '?pag=' . $table['dec']; ?> ">◀</a></li>
                <?php            
                    for($i = $table['from']; $i <= $table['until']; $i++) {
                        if($i <= $table['log_amount']) {
                            if($i == $compag) {
                                echo "<li class=\"active\"><a href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                            } else {
                            echo "<li><a href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                            }     		
                        }
                    }
                ?>
                <li class="btn"><a href=" <?php echo '?pag=' . $table['inc']; ?> ">▶</a></li>
            </ul>
        </div>
    </div>
</section>