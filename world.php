<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Establish a database connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the value of the 'country' parameter from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';

// Use a prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>