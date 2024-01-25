<?php
include_once "db.php";

// Step 1: Query to count all orders for all customers
$orderCountQuery = "SELECT COUNT(*) AS order_count FROM `order`";
$orderCountResult = mysqli_query($conn, $orderCountQuery);
$orderCount = ($orderCountResult && mysqli_num_rows($orderCountResult) > 0) ? mysqli_fetch_assoc($orderCountResult)['order_count'] : 0;

// Query to count today's orders
$todayOrdersQuery = "SELECT COUNT(*) AS today_order_count FROM `order` WHERE DATE(order_date) = CURDATE()";
$todayOrdersResult = mysqli_query($conn, $todayOrdersQuery);
$todayOrderCount = ($todayOrdersResult && mysqli_num_rows($todayOrdersResult) > 0) ? mysqli_fetch_assoc($todayOrdersResult)['today_order_count'] : 0;

// Query to calculate the average order price
$averageOrderPriceQuery = "SELECT AVG(p.price) AS average_order_price 
                          FROM `order` o
                          JOIN `product` p ON o.product_id = p.product_id";
$averageOrderPriceResult = mysqli_query($conn, $averageOrderPriceQuery);
$averageOrderPrice = ($averageOrderPriceResult && mysqli_num_rows($averageOrderPriceResult) > 0) ? mysqli_fetch_assoc($averageOrderPriceResult)['average_order_price'] : 0;



// Replace 'start_date' and 'end_date' with your actual date range
$start_date = '2022-01-01';
$end_date = '2022-12-31';

$queryss = "
    SELECT
        SUM(o.quantity) AS total_quantity,
        SUM(o.total_amount) AS total_sales,
        SUM(p.price * o.quantity) AS total_revenue,
        SUM(p.price * o.quantity) AS total_cost,
        SUM((p.price - p.price) * o.quantity) AS total_profit
    FROM
        `order` o
    JOIN
        `product` p ON o.product_id = p.product_id
 
";

$result = $conn->query($queryss);

if ($result === false) {
    die("Query failed: " . $conn->error);
}
$row = $result->fetch_assoc();

$total_quantity = $row['total_quantity'];
$total_sales = $row['total_sales'];
$total_revenue = $row['total_revenue'];
$total_cost = $row['total_cost'];
$total_profit = $row['total_profit'];



$query_order = "
    SELECT
        COUNT(*) AS number_of_purchases,
        SUM(total_amount) AS total_cost
    FROM
        `order`;
";

$result = $conn->query($query_order);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

$row = $result->fetch_assoc();

$number_of_purchases = $row['number_of_purchases'];
$total_cost = $row['total_cost'];



// Close the database connection
mysqli_close($conn);
?>

<style>
    
</style>


<h1 style="text-indent:1rem; font-weight:800;">Dashboard</h1>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="cardo" style="padding:.3rem; background:linear-gradient(110deg, #E0EAFC,#CFDEF3);">
            <div class="header_txt d-flex" style="align-items:center; justify-content: space-between;">
                
                <h6>Sales Overview</h6> 
                <span class="material-symbols-outlined">more_vert</span>
            </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="total_sales d-flex align-items-center" style="gap:.3rem; border-bottom:1px solid gray;">
                                <span class="material-symbols-outlined" style="background-color:#FADCD9; padding:.5rem; color:#F79489; border-radius:7px;">real_estate_agent</span>
                                <div class="txt">
                                    <h6>Total Sales</h6>
                                    <h6><?php echo $total_sales; ?></h6>
                                </div>
                            </div>

                            <div class="cost d-flex align-items-center" style="gap:.3rem;">
                                <span class="material-symbols-outlined" style="background-color:#B1D4E0; padding:.5rem; color:#0C2D48; border-radius:7px;">payments</span>
                                <div class="txt">
                                    <h6>Cost</h6>
                                    <h6><?php echo $total_cost; ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="revenue d-flex align-items-center" style="gap:.3rem; border-bottom:1px solid gray;">
                                <span class="material-symbols-outlined" style="background-color:#F4EBD0; padding:.5rem; color:#122620; border-radius:7px;">monitoring</span>
                                <div class="txt">
                                    <h6>Revenue</h6>
                                    <h6><?php echo $total_revenue; ?></h6>
                                </div>
                            </div>

                            <div class="profit d-flex align-items-center" style="gap:.3rem;">
                                <span class="material-symbols-outlined" style="background-color:#B9B7BD; padding:.5rem; color:#EEEDE7; border-radius:7px;">paid</span>
                                <div class="txt">
                                    <h6>Profit</h6>
                                    <h6><?php echo $total_profit; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="cardo" style="padding:.3rem; background:linear-gradient(110deg, #C9D6FF,#E2E2E2);">
            <div class="header_txt d-flex" style="align-items:center; justify-content: space-between;">
                
                <h6>Purchase Overview</h6> 
                <span class="material-symbols-outlined">more_vert</span>
            </div>
                <div class="card-body">
                    <div class="row" >
                        <div class="col-md-6">
                            <div class="num_purchase d-flex align-items-center" style="gap:.3rem; border-bottom:1px solid gray;">
                                <span class="material-symbols-outlined" style="background-color:#9388A2; padding:.5rem; color:#0E050F; border-radius:7px;">shopping_bag</span>
                                <div class="txt">
                                    <h6>No. of Purchase</h6>
                                    <h6><?php echo $number_of_purchases; ?></h6>
                                </div>
                            </div>

                            <div class="cancel_order d-flex align-items-center" style="gap:.3rem;">
                                <span class="material-symbols-outlined" style="background-color:#FABEC0; padding:.5rem; color:#E43D40; border-radius:7px;">cancel</span>
                                <div class="txt">
                                    <h6>Cancel Order</h6>
                                    <h6>21</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="cost d-flex align-items-center" style="gap:.3rem; border-bottom:1px solid gray;">
                                <span class="material-symbols-outlined" style="background-color:#B1D4E0; padding:.5rem; color:#0C2D48; border-radius:7px;">payments</span>
                                <div class="txt">
                                    <h6>Cost</h6>
                                    <h6><?php echo $total_cost; ?></h6>
                                </div>
                            </div>

                            <div class="return d-flex align-items-center" style="gap:.3rem;">
                                <span class="material-symbols-outlined" style="background-color:#C197D2; padding:.5rem; color:#211522; border-radius:7px;">assignment_return</span>
                                <div class="txt">
                                    <h6>Returns</h6>
                                    <h6>21</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>


<div class="container-fluid">
    <div class="row ">
        <div class="col-md-4">
            <div class="card" style="padding:.3rem;  background:linear-gradient(110deg, #D3CCE3,#E9E4F0);">
                <h3>Orders</h3>
                <div class="card-body">
                    <div class="total_or d-flex">
                        <h6>Total Orders: </h6>
                        <h6><?php echo $orderCount; ?></h6>
                    </div>
                    <div class="today_or d-flex">
                        <h6>Today Orders: </h6>
                        <h6><?php echo $todayOrderCount; ?></h6>
                    </div>
                    <div class="average_or d-flex">
                        <h6>Average Order Price: </h6>
                        <h6>₱<?php echo number_format($averageOrderPrice, 2); ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="padding:.3rem; background:linear-gradient(110deg, #D3CCE3,#E9E4F0);">
                <h3>Shipments</h3>
                <div class="card-body">

                    <div class="total_ship d-flex">
                        <h6>Total Shipments:</h6>
                        <h6>21</h6>
                    </div>

                    <div class="today_shipments d-flex">
                        <h6>Today Shipments:</h6>
                        <h6>21</h6>
                    </div>

                    <div class="total_ship_cost d-flex">
                        <h6>Total Shipment Cost:</h6>
                        <h6>21</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="cardo" style="padding:.3rem; background:linear-gradient(110deg, #D3CCE3,#E9E4F0);">
                <h6>No. of Users</h6>
                <div class="card-body d-flex" style="justify-content:space-evenly;">
                    <div class="customer col-md-5 d-flex" style=" border-radius:11px; background:#FEE7E6; flex-direction:column; align-items:center;">
                        <span class="material-symbols-outlined" style="font-size:3rem;">groups</span>
                        <h6>Total Customers</h6>
                        <h3>21</h3>
                    </div>
                    <div class="suppliers col-md-5 d-flex" style=" border-radius:11px; background:#FEE7E6; flex-direction:column; align-items:center;">
                        <span class="material-symbols-outlined" style="font-size:3rem;">groups</span>
                        <h6>Total Suppliers</h6>
                        <h3>21</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section2" style=" background:linear-gradient(110deg, #E0EAFC,#CFDEF3);">
    <div class="rev">
        <h1>Total Revenue</h1>
        <h3>Last 90 days</h3>
        <h1>$298.56K</h1>
        <p>+5.2k vs prev. 90 days</p>
    </div>
    <div class="ship">
        <h1>SHIPPED ORDERS</h1>
        <h3>3,928</h3>
        <h1>UNSHIPPED ORDERS</h1>
        <h3>83</h3>
    </div>
    <span></span>
    <div class="profit">
        <h1>Total Profit</h1>
        <h3>Last 90 days</h3>
        <h1>$298.56K</h1>
        <p>+9.2k vs prev. 90 days</p>
    </div>

    <div class="new">
        <h1>New Customers</h1>
        <h3>Last 90 days</h3>
        <h2>98</h2>
        <p>+67 vs prev. 90 days</p>
    </div>
</div>

<br>
<!--GRAPH-->
<div class="all" style="margin:1rem;">
    <div class="sales" style="background:linear-gradient(110deg, #C9D6FF,#E2E2E2);margin:1rem;">
        <div class="text">
            <h1>Total Sales & Costs</h1>
            <h3>Last 90 days</h3>
            <br>
            <h1>$200.41K</h1>
            <p>+5.2k vs prev. 90 days</p>
        </div>

        <div class="chart_sales">
            <canvas id="myChart"></canvas>
        </div>
    </div>


    <div id="warehouse_box" style="background:linear-gradient(110deg, #C9D6FF,#E2E2E2);">
        <!-- warehouse -->
    <div class="warehouse" style="display:flex; gap:2rem;">
        <select>
            <option value="option1">All Warehouse</option>
            <option value="option2">Makati</option>
            <option value="option3">Cavite</option>
        </select>

        <p>Last 90 days: Oct 19, 2022 - Dec 4, 2023</p>
    </div>

    <!-- warehouse box -->
    <div class="warehouse_box">
        <div class="warehouse_chart">
            <canvas id="wh_chart"></canvas>
        </div>

        <div class="whText">
            <h1>5,623 products</h1>
            <p>400 new products will arrive on next monday.</p>
            <div class="radio_btn">
                <input type="radio" id="option1" name="options" value="option1">
                <label for="option1">Active listing</label>

                <input type="radio" id="option2" name="options" value="option2">
                <label for="option2">Off market</label>
            </div>
        </div>
    </div>
    </div>

</div>
<br>
<br>

