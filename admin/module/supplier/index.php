<?php
    $open = "supplier";
    error_reporting(0);
    require ("../../autoload/autoload.php");
    require ("../../../libraries/database.php");
?>
<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Danh Sách Nhà Cung Cấp</h1>
                    <a  href="/thuctap2020/admin/module/supplier/add.php">
                        <button  class="btn btn-success" style="margin-left:10px;" >Thêm Mới</button>
                        <br>
                        <br>
                    </a>
                    <?php if(isset($_SESSION['success'])):?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
                            </div>
                    <?php endif ?>

                    <?php
                        if(isset($_GET['pages']))
                        {
                            $pages = $_GET['pages'];
                        }
                        else
                        {
                            $pages = 1; 
                            
                        }

                        $rowPerpage = 5;
                        $perRow = $pages*$rowPerpage - $rowPerpage;
                        
                        $sql = "SELECT * FROM `nhacungcap` LIMIT $perRow,$rowPerpage";
                        $query = mysqli_query($connect, $sql);
                        $totalRows =  mysqli_num_rows(mysqli_query($connect, "SELECT * FROM nhacungcap"));
                        $totalPages = ceil($totalRows / $rowPerpage); // ceil là làm tròn tăng thôi 4.1 lên 5. 4.4 lên 5
                       
                        $listPages  = "";
                        for($i =1; $i <= $totalPages; $i++)
                        {
                            if($pages == $i)
                            {
                                $listPages.=' <li class="page-item active"><a href="index.php?pages='.$i.'"></a>'.$i.'</a></li>';
                            }
                            else
                            {
                                $listPages.='<li class="page-item"><a href="index.php?pages='.$i.'"></a>'.$i.'</a></li>';
                                
                            }
                        }
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th width="10%">STT</th>
                                        <th width="20%">Mã nhà cung cấp</th>
                                        <th width="60%">Tên nhà cung cấp</th>
                                        <th width="10%">Hành động</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $stt = $rowPerpage * ($pages -1)+ 1;
                                            while($rows = mysqli_fetch_array($query))
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $stt++;?></td>
                                            <td><?php echo $rows['maNCC'] ?></td>
                                            <td><?php echo $rows['tenNCC'] ?></td>
                                            <td>
                                                <a class="btn btn-info" href="edit.php?id=<?php echo $rows['maNCC']?>"> <i class="fa fa-edit" ></i></a>
                                                <a class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa nhà cung cấp này?')" href="delete.php?id=<?php echo $rows['maNCC']?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    
                                </table>
                                <ul class="pagination">
                                    <?php
                                        for($t = 1; $t <= $totalPages; $t++)
                                        {
                                            
                                            echo "<li class='page-item'><a class='page-link' href='index.php?pages=$t'>Trang $t</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
<?php require ("../../layout/footer.php"); ?>