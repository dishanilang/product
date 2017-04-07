<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h2>Dashboard</h2>
        <table style="border: 1px solid black">
            <thead>
                <tr>
                    <th>Industry Name</th>
                    <th>Product Name</th>
                    <th>Production Total</th>
                    <th>Dispatch Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($alldata) {
                    foreach ($alldata as $key => $data) {
                ?>
                <tr>
                    <td><?php echo $data['i_name'] ?></td>
                    <td><?php echo $data['p_name'] ?></td>
                    <td><?php echo $data['total'] ?></td>
                </tr>
                <?php }} else { ?>
                <tr>
                    <td>No Records Found</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>