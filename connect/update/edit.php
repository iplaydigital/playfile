<?php
require_once('connection.php');

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $db->prepare("SELECT * FROM " . $tb_hotlink . " WHERE ID = " . $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);


        //extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_REQUEST['btn_update'])) {
    $name = $_REQUEST['name'];
    $url = $_REQUEST['url'];

    if (empty($name)) {
        $errorMsg = "Please Enter Name";
    } else if (empty($url)) {
        $errorMsg = "Please Enter URL";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE " . $tb_hotlink . " SET NAME = '" . $name . "', URL = '" . $url . "' WHERE ID =" . $id);
                if ($update_stmt->execute()) {
                    $updateMsg = "Record update successfully...";
                    header("refresh:2;index.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>

<body>

    <div class="container">
        <div class="display-3 text-center">Edit Page</div>

        <?php
        if (isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <strong>Wrong! <?php echo $errorMsg; ?></strong>
            </div>
        <?php } ?>


        <?php
        if (isset($updateMsg)) {
        ?>
            <div class="alert alert-success">
                <strong>Success! <?php echo $updateMsg; ?></strong>
            </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">

            <div class="form-group text-center">
                <div class="row">
                    <label for="name" class="col-sm-3 control-label">NAME</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" value="<?php echo $row['NAME']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="url" class="col-sm-3 control-label">URL</label>
                    <div class="col-sm-9">
                        <input type="text" name="url" class="form-control" value="<?php echo $row['URL']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


        </form>

        <script src="js/slim.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
</body>

</html>