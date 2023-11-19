<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Establish a database connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the value of the 'country' parameter from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookupCities = isset($_GET['lookup']) && $_GET['lookup'] === 'cities';

if ($lookupCities) {
    // Query for cities with a join between countries and cities
    $stmt = $conn->prepare("
        SELECT cities.name AS city_name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");
} else {
    // Query for countries
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
}

$stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
  <?php if ($lookupCities && !empty($results)): ?>
    <tr>
      <th>City Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['city_name']; ?></td>
        <td><?= $row['district']; ?></td>
        <td><?= $row['population']; ?></td>
      </tr>
    <?php endforeach; ?>
  <?php elseif (!$lookupCities && !empty($results)): ?>
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
  <?php else: ?>
    <tr>
      <td colspan="4">No data found</td>
    </tr>
  <?php endif; ?>
</table>
