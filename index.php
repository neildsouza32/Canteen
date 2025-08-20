<?php

$menu_items = [
    ["name" => "Idli",     "price" => 35.00,  "image" => "images/idli.jpg",       "category" => "South Indian"],
    ["name" => "Sada Dosa",  "price" => 35.00,  "image" => "images/sadadosa.jpg",       "category" => "South Indian"],
    ["name" => "Masala Dosa",  "price" => 50.00,  "image" => "images/masaladosa.jpg",    "category" => "South Indian"],
    ["name" => "Upma",       "price" => 30.00,  "image" => "images/upma.jpg",  "category" => "South Indian"],
    ["name" => "Medu Wada",    "price" => 35.00,  "image" => "images/meduwada.jpg",  "category" => "South Indian"],
    ["name" => "Extra Chutney/Sambhar",    "price" => 35.00,  "image" => "images/extrachutney.jpg",  "category" => "South Indian"],

    ["name" => "Poha",        "price" => 30.00,  "image" => "images/poha.jpg",    "category" => "Maharashtrian"],
    ["name" => "Batata Vada","price" => 10.00,  "image" => "images/batatawada.jpg",      "category" => "Maharashtrian"],
    ["name" => "Samosa",   "price" => 16.00,  "image" => "images/samosa.jpg",  "category" => "Maharashtrian"],
    ["name" => "Dal Rice",   "price" => 35.00,  "image" => "images/dalrice.jpg",  "category" => "Maharashtrian"],
    ["name" => "Pav Bhaji",   "price" => 45.00,  "image" => "images/pavbhaji.jpg",  "category" => "Maharashtrian"],
    ["name" => "Misal",   "price" => 30.00,  "image" => "images/misal.jpg",  "category" => "Maharashtrian"],
    ["name" => "Extra Pav",   "price" => 5.00,  "image" => "images/Extrapav.jpg",  "category" => "Maharashtrian"],

    ["name" => "Chutney Sandwich",    "price" => 25.00, "image" => "images/chutneysandwich.jpg",      "category" => "Sandwiches"],
    ["name" => "Veg Sandwich",    "price" => 35.00, "image" => "images/vegsandwich.jpg",      "category" => "Sandwiches"],
    ["name" => "Chutney Sandwich Toast",  "price" => 35.00, "image" => "images/chutneysandtoast.jpg",      "category" => "Sandwiches"],
    ["name" => "Veg Sandwich Toast",   "price" => 50.00, "image" => "images/vegtoast.jpg",      "category" => "Sandwiches"],

    ["name" => "Franky",     "price" => 25.00,  "image" => "images/franky.jpg", "category" => "Chinese"],
    ["name" => "Fried Rice",     "price" => 45.00,  "image" => "images/friedrice.jpg", "category" => "Chinese"],
    ["name" => "Veg Noodles",     "price" => 45.00,  "image" => "images/vegnoodles.jpg", "category" => "Chinese"],
    ["name" => "Schezwan Noodles",     "price" => 60.00,  "image" => "images/schezwannoodles.jpg", "category" => "Chinese"],

    ["name" => "Nescafe Coffee",   "price" => 15.00,  "image" => "images/nescafe.jpg", "category" => "Beverages"],
    ["name" => "Coffee (Machine)",  "price" => 20.00,  "image" => "images/coffee.jpg",       "category" => "Beverages"],
    ["name" => "Tea",       "price" => 10.00,  "image" => "images/tea.jpg",       "category" => "Beverages"],
    ["name" => "Nimbu Paani", "price" => 10.00,  "image" => "images/nimbupaani.jpg",       "category" => "Beverages"],
    ["name" => "Mineral Water", "price" => 10.00,  "image" => "images/mineralwater.jpg",       "category" => "Beverages"],
    ["name" => "Lassi/Chaas/Curd",       "price" => 10.00,  "image" => "images/lassi.jpg",       "category" => "Beverages"],
];
?>

<?php
$servername = "localhost";
$username = "root"; 
$password = "";    
$dbname = "canteen";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>College Canteen Menu</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    :root{
        --brand:#004080;
        --accent:#ff9800;
        --bg:#f4f4f4;
        --card:#ffffff;
        --shadow:0 2px 10px rgba(0,0,0,0.1);
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:#222;}
    header{background:#ffffff;padding:10px 20px;display:flex;align-items:center;justify-content:space-between;box-shadow:var(--shadow);position:sticky;top:0;z-index:10;}
    header img.logo{height:90px;width:auto;display:block;}
    .login-buttons{display:flex;gap:10px;}
    .login-buttons a{padding:8px 14px;border-radius:6px;font-weight:bold;text-decoration:none;color:#111;}
    .student-btn{background:#ffeb3b;}
    .admin-btn{background:#004080;color:#fff !important;}
    body.admin-page .student-btn{background:#004080;color:#fff !important;}
    body.admin-page .admin-btn{background:#ffeb3b;color:#111 !important;}
    .controls{max-width:1100px;margin:16px auto 8px;padding:0 16px;display:flex;gap:12px;flex-wrap:wrap;align-items:center;justify-content:space-between;}
    .tabs{display:flex;gap:8px;flex-wrap:wrap;}
    .tab{border:0;background:#e7eefc;color:#103f91;padding:8px 12px;border-radius:999px;cursor:pointer;font-weight:600;}
    .tab.active{background:var(--accent);color:#111;}
    .search{margin-left:auto;display:flex;align-items:center;gap:8px;background:#fff;border:1px solid #ddd;padding:8px 12px;border-radius:10px;box-shadow:var(--shadow);}
    .search input{border:0;outline:0;min-width:220px;font-size:14px;}
    .grid{max-width:1100px;margin:8px auto 16px;padding:0 16px;display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;}
    .card{background:var(--card);border-radius:14px;box-shadow:var(--shadow);overflow:hidden;display:flex;flex-direction:column;}
    .card img{width:100%;height:140px;object-fit:cover;background:#ddd;}
    .card .info{padding:12px;display:flex;flex-direction:column;gap:6px;text-align:center;}
    .name{font-weight:700;}
    .price{color:#444;font-weight:700;}
    .counter{display:flex;align-items:center;justify-content:center;gap:10px;margin-top:6px;}
    .counter button{background:var(--brand);color:#fff;border:0;border-radius:8px;padding:6px 12px;cursor:pointer;font-size:16px;}
    .counter input{width:48px;text-align:center;padding:6px 8px;border:1px solid #ccc;border-radius:8px;font-weight:700;}
    .bill-wrap{max-width:1100px;margin:8px auto 24px;padding:0 16px;}
    .btn{background:var(--accent);border:0;color:#111;font-weight:800;padding:10px 18px;border-radius:10px;cursor:pointer;box-shadow:var(--shadow);}
    .bill{background:#fff;border:1px solid #eee;border-radius:12px;box-shadow:var(--shadow);overflow:hidden;margin-top:10px;}
    .bill table{width:100%;border-collapse:collapse;}
    .bill th,.bill td{padding:10px;text-align:center;border-bottom:1px solid #f0f0f0;}
    .bill th{background:#fafafa;}
    footer{background:var(--brand);color:#fff;text-align:center;padding:18px;font-size:18px;margin-top:24px;}
    footer a{color:#fff;text-decoration:none;margin:0 10px;}
</style>
</head>
<body>

<header>
    <img src="images/logo.png" alt="Canteen Logo" class="logo" style="height:150px; width:auto;">
    
    <h1 style="font-weight:bold; text-align:center; margin-top:10px;">Canteen Menu</h1>
    
    <div class="login-buttons">
        <a href="index.php" class="student-btn">Student Login</a>
        <a href="admin.php" class="admin-btn">Admin Login</a>
    </div>
</header>


<form method="POST" id="orderForm">
    <div class="controls">
        <div class="tabs" id="tabs">
            <?php
                $cats = ["All","South Indian","Maharashtrian","Sandwiches","Chinese","Beverages"];
                foreach ($cats as $i => $cat) {
                    $active = $i===0 ? 'active' : '';
                    echo "<button type='button' class='tab $active' data-cat=\"$cat\">$cat</button>";
                }
            ?>
        </div>
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Search food...">
        </div>
    </div>

    <div class="grid" id="menuGrid">
        <?php foreach ($menu_items as $i => $item): ?>
        <div class="card" data-name="<?= strtolower($item['name']) ?>"
             data-category="<?= $item['category'] ?>"
             data-price="<?= $item['price'] ?>"
             data-itemname="<?= htmlspecialchars($item['name']) ?>">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
            <div class="info">
                <div class="name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="price">₹<?= number_format($item['price'], 2) ?></div>
                <div class="counter">
                    <button type="button" class="dec">-</button>
                    <input type="number" name="qty[<?= $i ?>]" value="0" min="0" readonly>
                    <button type="button" class="inc">+</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

   
    <div class="bill-wrap">
        <div id="liveBill" class="bill" style="display:none;"></div>
    </div>
</form>


<div id="bill-display" style="margin-top: 20px; border: 1px solid #ccc; padding: 15px;"></div>

<footer>
    <div>Follow us:
        <a href="https://instagram.com/bmn_college?igshid=YmMyMTA2M2Y="><i class="fab fa-instagram"></i> Instagram</a> •
        <a href="https://www.facebook.com/Dr-BMN-College-of-Home-Science-208633133133272/"><i class="fab fa-facebook"></i> Facebook</a> •
        <a href="https://twitter.com/DrBMNCollege"><i class="fab fa-x-twitter"></i> X</a>
    </div>
    <div style="margin-top:6px;">© <?= date('Y') ?> Dr. BMN college of Home Science College Canteen</div>
</footer>

<script>
(() => {
    const tabs = document.querySelectorAll('.tab');
    const grid = document.getElementById('menuGrid');
    const cards = Array.from(grid.querySelectorAll('.card'));
    const searchInput = document.getElementById('searchInput');
    const billBox = document.getElementById('liveBill');
    let activeCat = 'All';

    function updateBill() {
        let rows = '';
        let total = 0;
        cards.forEach(card => {
            const qty = parseInt(card.querySelector('input').value) || 0;
            const price = parseFloat(card.dataset.price);
            const name = card.dataset.itemname;
            if (qty > 0) {
                const lineTotal = qty * price;
                total += lineTotal;
                rows += `<tr>
                    <td>${name}</td>
                    <td>${qty}</td>
                    <td>${price.toFixed(2)}</td>
                    <td>${lineTotal.toFixed(2)}</td>
                </tr>`;
            }
        });
        if (rows) {
            billBox.style.display = '';
            billBox.innerHTML = `
                <table>
                    <thead>
                        <tr><th>Item</th><th>Qty</th><th>Unit Price (₹)</th><th>Line Total (₹)</th></tr>
                    </thead>
                    <tbody>${rows}</tbody>
                    <tfoot>
                        <tr><th colspan="3" style="text-align:right;">Grand Total</th>
                            <th id="total-amount">${total.toFixed(2)}</th></tr>
                    </tfoot>
                </table>
                <div style="text-align:center; padding:10px;">
                    <button type="button" onclick="generateBill()" style="padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; font-size: 16px;">
                        Generate Bill
                    </button>
                </div>
            `;
        } else {
            billBox.style.display = 'none';
        }
    }

    grid.addEventListener('click', e => {
        if (e.target.classList.contains('inc') || e.target.classList.contains('dec')) {
            const input = e.target.closest('.card').querySelector('input');
            let v = parseInt(input.value) || 0;
            v += e.target.classList.contains('inc') ? 1 : -1;
            if (v < 0) v = 0;
            input.value = v;
            updateBill();
        }
    });

    tabs.forEach(btn => {
        btn.addEventListener('click', () => {
            tabs.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeCat = btn.dataset.cat;
            applyFilters();
        });
    });

    searchInput.addEventListener('input', applyFilters);

    function applyFilters() {
        const q = searchInput.value.trim().toLowerCase();
        cards.forEach(card => {
            const name = card.dataset.name;
            const cat  = card.dataset.category;
            const matchCat = (activeCat === 'All') || (cat === activeCat);
            const matchSearch = !q || name.includes(q);
            card.style.display = (matchCat && matchSearch) ? '' : 'none';
        });
    }

    window.generateBill = function() {
        const rollNumber = prompt("Enter your Roll Number:");
        if (!rollNumber) {
            alert("Roll Number is required!");
            return;
        }
        const tokenNumber = "TKN" + Date.now().toString().slice(-6);
        const billHTML = billBox.querySelector("tbody").innerHTML;
        const totalAmount = document.getElementById("total-amount").innerText;

        document.getElementById("bill-display").innerHTML = `
            <h3>Bill Summary</h3>
            <p><strong>Roll Number:</strong> ${rollNumber}</p>
            <p><strong>Token Number:</strong> ${tokenNumber}</p>
            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
                ${billHTML}
            </table>
            <h4>Total: ₹${totalAmount}</h4>
            <p><em>Please keep your token number safe for payment.</em></p>
        `;

        fetch("save_bill.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                roll_number: rollNumber,
                token_number: tokenNumber,
                items_html: billHTML,
                total: totalAmount
            })
        })
        .then(res => res.text())
        .then(data => {
            console.log("Bill saved:", data);
            alert("✅ Bill generated and saved! Token: " + tokenNumber);
        })
        .catch(err => console.error("Error saving bill:", err));
    };

    applyFilters();
})();
</script>

</body>
</html>
