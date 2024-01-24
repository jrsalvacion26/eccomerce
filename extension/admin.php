<?php
include "db.php";

// Constants for pagination
$recordsPerPage = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Check if search form is submitted
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to get user orders and total quantity with pagination
$sql = "SELECT u.user_id, u.fullname, SUM(o.quantity) as total_quantity
        FROM `user` u
        LEFT JOIN `order` o ON u.user_id = o.user_id
        WHERE u.role = 'User'
        AND u.fullname LIKE '%$search%'
        GROUP BY u.user_id, u.fullname
        LIMIT $offset, $recordsPerPage";

$result = $conn->query($sql);

if ($result === false) {
    die("Error executing the query: " . $conn->error);
}

// Query to count total records for pagination
$countSql = "SELECT COUNT(DISTINCT u.user_id) as total_records
              FROM `user` u
              LEFT JOIN `order` o ON u.user_id = o.user_id
              WHERE u.role = 'User'
              AND u.fullname LIKE '%$search%'";

$countResult = $conn->query($countSql);
$totalRecords = $countResult->fetch_assoc()['total_records'];

// Calculate total pages for pagination
$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <form class="mb-3" method="GET" action="">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by Full Name" name="search" value="<?php echo $search; ?>">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <?php if ($result->num_rows > 0) { ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Total Order</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $rowNumber = $offset + 1; // Start row numbering from the correct offset
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <th scope="row"><?php echo $rowNumber; ?></th>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['total_quantity']; ?></td>
                    <td><button class="btn btn-warning">Active</button></td>
                    <td><a class="material-symbols-outlined" href="extension/view_customer_order.php/?user_id=<?php echo $row['user_id']; ?>">visibility</a></td>
                </tr>
                <?php
                $rowNumber++;
            }
            ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } else { ?>
        <p class="alert alert-warning">No results found</p>
    <?php } ?>

    <?php $conn->close(); ?>
</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
