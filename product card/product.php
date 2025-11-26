<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'] ?? '';

$sql = "SELECT * FROM products WHERE name LIKE '%$query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    padding: 20px;
}

/* Grid layout for cards */
.cards-container {
   display:flex;
    gap: 20px;
    margin-top: 20px;
}

/* Card style */
.card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(21,21,21,0.08);
  transition: transform .15s ease, box-shadow .15s ease;
 height:250px;
 width: 150px;
  margin-top:20px;
 padding:20px 60px;
 
 
}

/* Hover effect */
.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 30px rgba(21,21,21,0.15);
}

/* Image */
.card img {
    
   width: 180px;
    height: 180px;
     object-fit: cover; 
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

/* Product name */
.card h3 {
    font-size: 18px;
    margin: 10px;
}

/* Price */
.card p {
    font-size: 16px;
    margin: 10px;
    font-weight: bold;
    color: #0b7a5f;
}



    </style>
</head>
<body>

<h2>Search Results for: <b><?= htmlspecialchars($query) ?></b></h2>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='card'>
            <img src='{$row['image']}' alt='Product Image'>
            <h3>{$row['name']}</h3>
            <p>Price: ₹{$row['price']}</p>
        </div>
        ";
    }
} else {
    echo "<p>No products found!</p>";
}

$conn->close();
?>

</body>
</html>
