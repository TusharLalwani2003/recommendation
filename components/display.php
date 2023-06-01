<?php


function displayStudentTable($n)
{

	echo "<tr>";
	echo "<td>" . $n["title"] . "</td>";
	echo "<td>" . $n["author"] . "</td>";
	echo "<td>" . $n["publisher"] . "</td>";
	echo "<td>" . $n["year"] . "</td>";
	echo "<td>" . $n["edition"] . "</td>";
	echo "<td>" . $n["isbn"] . "</td>";
	echo "<td>" . $n["currency"] . "</td>";
	echo "<td>" . $n["price"] . "</td>";
	echo "<td>" . $n["type"] . "</td>";
	echo "<td>" . $n["copies"] . "</td>";
	echo "<td>" . $n["studentname"] . "</td>";
	echo "<td>" . $n["course"] . "</td>";
	echo "<td>" . $n["regNo"] . "</td>";
	echo "<td>" . $n["Department"] . "</td>";
	echo "<td>" . $n["email"] . "</td>";
	echo "</tr>";
}

function displayFacultyTable($n)
{

	echo "<tr>";
	echo "<td>" . $n["title"] . "</td>";
	echo "<td>" . $n["author"] . "</td>";
	echo "<td>" . $n["publisher"] . "</td>";
	echo "<td>" . $n["year"] . "</td>";
	echo "<td>" . $n["edition"] . "</td>";
	echo "<td>" . $n["isbn"] . "</td>";
	echo "<td>" . $n["currency"] . "</td>";
	echo "<td>" . $n["price"] . "</td>";
	echo "<td>" . $n["type"] . "</td>";
	echo "<td>" . $n["copies"] . "</td>";
	echo "<td>" . $n["facultyname"] . "</td>";
	echo "<td>" . $n["designation"] . "</td>";
	echo "<td>" . $n["facultyID"] . "</td>";
	echo "<td>" . $n["Department"] . "</td>";
	echo "<td>" . $n["email"] . "</td>";
	echo "</tr>";
}

$sql = "SELECT * FROM facultybooks";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<table>";
echo "<tr>";
echo "<th>Title</th>";
echo "<th>Author</th>";
echo "<th>Publisher</th>";
echo "<th>Year Of Publishing</th>";
echo "<th>Edition</th>";
echo "<th>ISBN</th>";
echo "<th>Currency</th>";
echo "<th>Price</th>";
echo "<th>Type</th>";
echo "<th>Copies</th>";
echo "<th>Faculty Name</th>";
echo "<th>Designation</th>";
echo "<th>Faculty ID</th>";
echo "<th>Department</th>";
echo "<th>Email</th>";
echo "</tr>";
array_map('displayFacultyTable', $result);
echo "</table>";



$sql = "SELECT * FROM studentbooks";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<table>";
echo "<tr>";
echo "<th>Title</th>";
echo "<th>Author</th>";
echo "<th>Publisher</th>";
echo "<th>Year Of Publishing</th>";
echo "<th>Edition</th>";
echo "<th>ISBN</th>";
echo "<th>Currency</th>";
echo "<th>Price</th>";
echo "<th>Type</th>";
echo "<th>Copies</th>";
echo "<th>Student Name</th>";
echo "<th>Course</th>";
echo "<th>Registeration Number</th>";
echo "<th>Department</th>";
echo "<th>Email</th>";
echo "</tr>";
array_map('displayStudentTable', $result);
echo "</table>";

?>