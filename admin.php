<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - College Canteen</title>
    <style>
        :root {
            --brand: #004080;
            --shadow: 0 2px 5px rgba(0,0,0,0.15);
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        
        header {
            background: #ffffff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        header img.logo {
            height: 150px;
            width: auto;
            display: block;
        }
        .login-buttons {
            display: flex;
            gap: 10px;
        }
        .login-buttons a {
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
        }

        
        body:not(.admin-page) .student-btn {
            background: #004080;
            color: #fff;
        }
        body:not(.admin-page) .admin-btn {
            background: #ffeb3b;
            color: #111;
        }

       
        body.admin-page .student-btn {
            background: #004080;
            color: #fff;
            
        }
        body.admin-page .admin-btn {
            background: #ffeb3b;
            color: #111;
        }

       
        footer {
            background: var(--brand);
            color: #fff;
            text-align: center;
            padding: 18px;
            font-size: 18px;
            margin-top: 24px;
        }
        footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-page">

<header>
    <img src="images/logo.png" alt="Canteen Logo" class="logo" style="height:150px; width:auto;">
    
    <h1 style="font-weight:bold; text-align:center; margin-top:10px;">Canteen Menu</h1>
    
    <div class="login-buttons">
        <a href="index.php" class="student-btn">Student Login</a>
        <a href="admin.php" class="admin-btn">Admin Login</a>
    </div>
</header>

<main style="padding:20px;">
    <h1>Welcome to Admin Dashboard</h1>
    <p>Manage menu items, view orders, and track sales here.</p>

    <?php
   
    $conn = new mysqli("localhost", "root", "", "canteen");
    if ($conn->connect_error) {
        die("DB connection failed: " . $conn->connect_error);
    }

   
    if (isset($_POST['payment_done_id'])) {
        $id = intval($_POST['payment_done_id']);
        $bill = $conn->query("SELECT * FROM bills WHERE id=$id")->fetch_assoc();
        if ($bill) {
            $stmt = $conn->prepare("INSERT INTO payments_done (roll_no, token_no, bill_items, total_amount) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssd", $bill['roll_no'], $bill['token_no'], $bill['bill_items'], $bill['total_amount']);
            $stmt->execute();
            $stmt->close();
            $conn->query("DELETE FROM bills WHERE id=$id");
        }
    }

    
    $search = $_GET['search'] ?? '';
    $filter = $_GET['filter'] ?? '';
    $view_done = isset($_GET['view_done']);

    $where = "1";
    if ($search) {
        $search = $conn->real_escape_string($search);
        $where .= " AND (roll_no LIKE '%$search%' OR token_no LIKE '%$search%')";
    }

    if ($filter) {
        if ($filter == "1m") $where .= " AND created_at >= NOW() - INTERVAL 1 MONTH";
        if ($filter == "3m") $where .= " AND created_at >= NOW() - INTERVAL 3 MONTH";
        if ($filter == "6m") $where .= " AND created_at >= NOW() - INTERVAL 6 MONTH";
        if ($filter == "1y") $where .= " AND created_at >= NOW() - INTERVAL 1 YEAR";
    }

    $table = $view_done ? "payments_done" : "bills";
    $result = $conn->query("SELECT * FROM $table WHERE $where ORDER BY created_at DESC");

    
    ?>
    <form method="GET" style="margin-bottom:15px; display:flex; gap:10px; flex-wrap:wrap;">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search Roll No or Token No" style="padding:6px; flex:1;">
    <select name="filter" style="padding:6px;">
        <option value="">-- Filter by Date --</option>
        <option value="1m" <?= $filter=="1m"?"selected":"" ?>>Last 1 Month</option>
        <option value="3m" <?= $filter=="3m"?"selected":"" ?>>Last 3 Months</option>
        <option value="6m" <?= $filter=="6m"?"selected":"" ?>>Last 6 Months</option>
        <option value="1y" <?= $filter=="1y"?"selected":"" ?>>Last 1 Year</option>
    </select>
    <button type="submit" style="padding:6px 10px;">Apply</button>

    <?php if ($view_done): ?>
        <input type="hidden" name="view_done" value="1">
    <?php endif; ?>

    <a href="?<?= $view_done?'':'view_done=1' ?>" style="padding:6px 10px; background:#333; color:#fff; text-decoration:none; border-radius:4px;">
        <?= $view_done ? "View Pending Bills" : "View Completed Payments" ?>
    </a>
</form>

    <?php

    
    echo "<h2>" . ($view_done ? "Completed Payments" : "Pending Bills") . "</h2>";
    echo "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse; width:100%;'>";
    echo "<tr style='background:#eee;'>
            <th>Roll No</th>
            <th>Token No</th>
            <th>Items</th>
            <th>Total</th>
            <th>Date</th>";
    if (!$view_done) echo "<th>Action</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['roll_no']}</td>";
        echo "<td>{$row['token_no']}</td>";
        $items_clean = strip_tags($row['bill_items']);
        echo "<td><pre style='margin:0;'>$items_clean</pre></td>";
        echo "<td>{$row['total_amount']}</td>";
        echo "<td>{$row['created_at']}</td>";
        if (!$view_done) {
            echo "<td>
                    <form method='POST' style='margin:0;'>
                        <input type='hidden' name='payment_done_id' value='{$row['id']}'>
                        <button type='submit' style='padding:6px 10px; background:green; color:#fff; border:none; border-radius:4px; cursor:pointer;'>
                            Payment Done
                        </button>
                    </form>
                  </td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    $conn->close();
    ?>
</main>


<footer>
    <div>Follow us:
        <a href="https://instagram.com/bmn_college?igshid=YmMyMTA2M2Y=">
            <i class="fab fa-instagram"></i> Instagram
        </a> •
        <a href="https://www.facebook.com/Dr-BMN-College-of-Home-Science-208633133133272/">
            <i class="fab fa-facebook"></i> Facebook
        </a> •
        <a href="https://twitter.com/DrBMNCollege">
            <i class="fab fa-x-twitter"></i> X
        </a>
    </div>
    <div style="margin-top:6px;">
        © <?= date('Y') ?> Dr. BMN College of Home Science College Canteen
    </div>
</footer>

</body>
</html>
