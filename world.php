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

<table border="1">
  <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']; ?></td>
      <td><?= $row['continent']; ?></td>
      <td><?= $row['independence_year']; ?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
