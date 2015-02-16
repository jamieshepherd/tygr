<html>
<head>
    <title>Test azure</title>
</head>
<body>
    <form action="" method="POST"  accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <label for="attachment">Add an attachment</label>
        <input type="file" name="attachment">
        <input type="submit" value="Submit">
    </form>
</body>
</html>