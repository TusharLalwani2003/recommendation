<?php

session_start();
class BookData
{
	public $Title = "";
	public $Publisher = "";
	public $Author = "";
	public $YearOfPublishing = "";
	public $Edition = "";
	public $ISBN = "";
	public $Currency = "";
	public $Price = "";
	public $Type = "";
	public $Copies = "";

	function __construct($Title, $Publisher, $Author, $YearOfPublishing, $Edition, $ISBN, $Currency, $Price, $Type, $Copies)
	{
		$this->Title = (string) $Title;
		$this->Publisher = (string) $Publisher;
		$this->Author = (string) $Author;
		$this->YearOfPublishing = (string) $YearOfPublishing;
		$this->Edition = (string) $Edition;
		$this->ISBN = (string) $ISBN;
		$this->Currency = (string) $Currency;
		$this->Price = (string) $Price;
		$this->Type = (string) $Type;
		$this->Copies = (string) $Copies;
	}

	function printRow()
	{
		echo "<tr>";
		echo "<td>" . $this->Title . "</td>";
		echo "<td>" . $this->Author . "</td>";
		echo "<td>" . $this->Publisher . "</td>";
		echo "<td>" . $this->YearOfPublishing . "</td>";
		echo "<td>" . $this->Edition . "</td>";
		echo "<td>" . $this->ISBN . "</td>";
		echo "<td>" . $this->Currency . "</td>";
		echo "<td>" . $this->Price . "</td>";
		echo "<td>" . $this->Type . "</td>";
		echo "<td>" . $this->Copies . "</td>";
		echo "</tr>";
	}
}

if ($_SESSION == null || $_SESSION == [])
	$_SESSION['OrderList'] = array();

$role = 'student';

$RegNo = '';
$FacultyId = '';

$FullStudentName = '';
$FullFacultyName = '';

$Course = '';
$Designation = '';

$StudentDepartment = '';
$FacultyDepartment = '';

$StudentEmail = '';
$FacultyEmail = '';
function useRegex($input)
{
	$regex = '/([A-Za-z0-9]+(\\.[A-Za-z0-9]+)+)@mnnit\\.ac\\.in/i';
	return preg_match($regex, $input);
}

// $_SESSION['OrderList'] = array();
if (isset($_POST['queueadd'])) {
	do {
		if ($_POST["role-select"] == "student") {
			$role = 'student';
			$RegNo = trim($_POST['regno']);
			$FullStudentName = trim($_POST['fullstudentname']);
			$Course = trim($_POST['course']);
			$StudentDepartment = trim($_POST['studentdepartment']);
			$StudentEmail = trim($_POST['studentemail']);


			if ($role == "" || $RegNo == "" || $FullStudentName == "" || $Course == "" || $StudentDepartment == "" || $StudentEmail == "") {
				echo '<script>alert("Please fill all the Fields in your Details!!");</script>';
				break;
			}

			if (useRegex($StudentEmail) == 0) {
				echo '<script>alert("Please Enter Valid College Email ID!!");</script>';
				break;
			}

		} else {
			$role = 'faculty';
			$FacultyId = trim($_POST['facid']);
			$FullFacultyName = trim($_POST['fullfacultyname']);
			$Designation = trim($_POST['designation']);
			$FacultyDepartment = trim($_POST['facultydepartment']);
			$FacultyEmail = trim($_POST['facultyemail']);

			if ($role == "" || $FacultyId == "" || $FullFacultyName == "" || $Designation == "" || $FacultyDepartment == "" || $FacultyEmail == "") {
				echo '<script>alert("Please fill all the Fields in your Details!!");</script>';
				break;
			}

			if (useRegex($FacultyEmail) == 0) {
				echo '<script>alert("Please Enter Valid College Email ID!!");</script>';
				break;
			}

		}

		$newBook = new BookData(trim($_POST['booktitle']), $_POST['publisher'], $_POST['author'], $_POST['yearofpublish'], $_POST['edition'], $_POST['isbn'], $_POST['currency'], $_POST['price'], $_POST['booktype'], $_POST['copies']);


		if ($newBook->Title == "") {
			echo '<script>alert("Please fill the Book Title!!");</script>';
			break;
		}

		if ($newBook->Author == "") {
			echo '<script>alert("Please fill the Book Author!!");</script>';
			break;
		}


		if ($newBook->Publisher == "")
			$newBook->Publisher = "-NA-";

		if ($newBook->YearOfPublishing == "")
			$newBook->YearOfPublishing = "-NA-";

		if ($newBook->Edition == "")
			$newBook->Edition = "-NA-";

		if ($newBook->ISBN == "")
			$newBook->ISBN = "0";

		if ($newBook->Currency == "")
			$newBook->Currency = "-NA-";

		if ($newBook->Price == "")
			$newBook->Price = "-NA-";

		if ($newBook->Type == "")
			$newBook->Type = "-NA-";

		if ($newBook->Copies == "")
			$newBook->Copies == "-NA-";



		array_push($_SESSION['OrderList'], $newBook);
	}
	while (false);


}

if (isset($_POST['submit'])) {
	do {
		$bookList = $_SESSION['OrderList'];

		if ($_POST["role-select"] == "student") {
			$role = 'student';
			$RegNo = trim($_POST['regno']);
			$FullStudentName = trim($_POST['fullstudentname']);
			$Course = trim($_POST['course']);
			$StudentDepartment = trim($_POST['studentdepartment']);
			$StudentEmail = trim($_POST['studentemail']);

			if ($role == "" || $RegNo == "" || $FullStudentName == "" || $Course == "" || $StudentDepartment == "" || $StudentEmail == "") {
				echo '<script>alert("Please fill all the Fields in your Details!!");</script>';
				break;
			}

			if (useRegex($StudentEmail) == 0) {
				echo '<script>alert("Please Enter Valid College Email ID!!");</script>';
				break;
			}


		} else {
			$role = 'faculty';
			$FacultyId = trim($_POST['facid']);
			$FullFacultyName = trim($_POST['fullfacultyname']);
			$Designation = trim($_POST['designation']);
			$FacultyDepartment = trim($_POST['facultydepartment']);
			$FacultyEmail = trim($_POST['facultyemail']);

			if ($role == "" || $FacultyId == "" || $FullFacultyName == "" || $Designation == "" || $FacultyDepartment == "" || $FacultyEmail == "") {
				echo '<script>alert("Please fill all the Fields in your Details!!");</script>';
				break;
			}

			if (useRegex($FacultyEmail) == 0) {
				echo '<script>alert("Please Enter Valid College Email ID!!");</script>';
				break;
			}

		}

		if ($role == 'student') {
			try {
				for ($i = 0; $i < sizeof($bookList); $i++) {
					$title = $bookList[$i]->Title;
					$author = $bookList[$i]->Author;
					$publisher = $bookList[$i]->Publisher;
					$year = $bookList[$i]->YearOfPublishing;
					$edition = $bookList[$i]->Edition;
					$isbn = $bookList[$i]->ISBN;
					$currency = $bookList[$i]->Currency;
					$price = $bookList[$i]->Price;
					$type = $bookList[$i]->Type;
					$copies = $bookList[$i]->Copies;

					if ($isbn !== "0") {

						$sql = "SELECT COUNT(*) FROM studentbooks WHERE isbn ='$isbn' AND regNo = '$RegNo'";
						$result = mysqli_query($conn, $sql);
						$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

						if ($result[0]["COUNT(*)"] !== '0') {
							echo '<script>alert("Book with isbn ' . $isbn . ' already added by you earlier.");</script>';
						} else {
							//sql for inserting book in studentbook table
							$sql = "INSERT INTO studentbooks (title, author, publisher, year, edition, isbn, currency, price, type, copies, studentname, course, regNo, Department, email) VALUES ('$title', '$author', '$publisher', '$year', '$edition','$isbn','$currency','$price','$type', '$copies','$FullStudentName','$Course','$RegNo','$StudentDepartment', '$StudentEmail' )";
							//inserting to database
							if (mysqli_query($conn, $sql)) {
								// success
								echo '<script>console.log("Recommendation of book with isbn ' . $isbn . ' added.");';
								echo '</script>';
							} else {
								// error
								echo '<script>console.log("Some error occured");';
								echo '</script>';
								throw new Exception('Some error occured');
							}
						}
					} else {
						//sql for inserting book in studentbook table
						$sql = "INSERT INTO studentbooks (title, author, publisher, year, edition, isbn, currency, price, type, copies, studentname, course, regNo, Department, email) VALUES ('$title', '$author', '$publisher', '$year', '$edition','$isbn','$currency','$price','$type', '$copies','$FullStudentName','$Course','$RegNo','$StudentDepartment', '$StudentEmail' )";
						//inserting to database
						if (mysqli_query($conn, $sql)) {
							// success
							echo '<script>console.log("Recommendation of book with isbn ' . $isbn . ' added.");';
							echo '</script>';
						} else {
							// error
							echo '<script>console.log("Some error occured");';
							echo '</script>';
							throw new Exception('Some error occured');
						}
					}
				}
				$_SESSION['OrderList'] = array();
				echo '<script>alert("Recommendation added successfully");';
				echo 'window.location= "./"; </script>';
			} catch (Exception $e) {
				echo $e->getMessage() . "<br/>";
				while ($e = $e->getPrevious()) {
					echo 'Previous exception: ' . $e->getMessage() . "<br/>";
				}
			}

		} else {
			try {
				for ($i = 0; $i < sizeof($bookList); $i++) {
					$title = $bookList[$i]->Title;
					$author = $bookList[$i]->Author;
					$publisher = $bookList[$i]->Publisher;
					$year = $bookList[$i]->YearOfPublishing;
					$edition = $bookList[$i]->Edition;
					$isbn = $bookList[$i]->ISBN;
					$currency = $bookList[$i]->Currency;
					$price = $bookList[$i]->Price;
					$type = $bookList[$i]->Type;
					$copies = $bookList[$i]->Copies;

					if ($isbn !== "0") {

						$sql = "SELECT COUNT(*) FROM facultybooks WHERE isbn ='$isbn' AND facultyID = '$FacultyId'";
						$result = mysqli_query($conn, $sql);
						$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

						if ($result[0]["COUNT(*)"] !== '0') {
							echo '<script>alert("Book with isbn ' . $isbn . ' already added by you earlier.");</script>';
						} else {
							//sql for inserting book in facultybook table
							$sql = "INSERT INTO facultybooks (title, author, publisher, year, edition, isbn, currency, price, type, copies, facultyname, designation, facultyID, Department, email) VALUES ('$title', '$author', '$publisher', '$year', '$edition','$isbn','$currency','$price','$type', '$copies','$FullFacultyName','$Designation','$FacultyId','$FacultyDepartment','$FacultyEmail' )";
							//inserting to database
							if (mysqli_query($conn, $sql)) {
								// success
								echo '<script>console.log("Recommendation of book with isbn ' . $isbn . ' added.");';
								echo '</script>';
							} else {
								// error
								echo '<script>console.log("Some error occured");';
								echo '</script>';
								throw new Exception('Some error occured');
							}
						}
					} else {
						//sql for inserting book in facultybook table
						$sql = "INSERT INTO facultybooks (title, author, publisher, year, edition, isbn, currency, price, type, copies, facultyname, designation, facultyID, Department, email) VALUES ('$title', '$author', '$publisher', '$year', '$edition','$isbn','$currency','$price','$type', '$copies','$FullFacultyName','$Designation','$FacultyId','$FacultyDepartment','$FacultyEmail' )";
						//inserting to database
						if (mysqli_query($conn, $sql)) {
							// success
							echo '<script>console.log("Recommendation of book with isbn ' . $isbn . ' added.");';
							echo '</script>';
						} else {
							// error
							echo '<script>console.log("Some error occured");';
							echo '</script>';
							throw new Exception('Some error occured');
						}
					}
				}
				$_SESSION['OrderList'] = array();
				echo '<script>alert("Recommendation added successfully");';
				echo 'window.location= "./"; </script>';
			} catch (Exception $e) {
				echo $e->getMessage() . "<br/>";
				while ($e = $e->getPrevious()) {
					echo 'Previous exception: ' . $e->getMessage() . "<br/>";
				}
			}
		}
	} while (false);

}

if (isset($_POST['clearqueue'])) {
	$_SESSION['OrderList'] = array();
}
?>



<div class="border-4 rounded-xl m-10">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<div class="text-center font-black my-6">Enter Your Details</div>

		<div class="text-center my-3">
			Select Your Role :<br />
			<input type="radio" id="student" name="role-select" value="student" <?php echo ($role == 'student') ? 'checked' : '' ?> />
			<label for="student">Student</label>
			<input type="radio" id="faculty" name="role-select" value="faculty" class="ml-10" <?php echo ($role == 'faculty') ? 'checked' : '' ?> />
			<label for="faculty">Faculty</label>
		</div>

		<div class="flex flex-wrap justify-center <?php echo ($role == 'student') ? '' : 'hidden' ?>" id="student-form">
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="regno">Registeration No : </label>
				<input class="border-2" id="regno" name="regno" value="<?php echo $RegNo ?>" req />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="name">Full Name : </label>
				<input class="border-2 w-5/6" id="name" name="fullstudentname" value="<?php echo $FullStudentName ?>" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="course">Course : </label>
				<input class="border-2" id="course" name="course" value="<?php echo $Course ?>" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="department">Department : </label>
				<select name="studentdepartment" id="department">
					<option <?php echo $StudentDepartment == "Applied Mechanics" ? 'selected' : '' ?> value=" Applied Mechanics">Applied Mechanics</option>
					<option <?php echo $StudentDepartment == "Biotechnology" ? 'selected' : '' ?> value="Biotechnology">Biotechnology</option>
					<option <?php echo $StudentDepartment == "Chemical Engineering" ? 'selected' : '' ?> value="Chemical Engineering">Chemical Engineering</option>
					<option <?php echo $StudentDepartment == "Chemistry" ? 'selected' : '' ?> value="Chemistry">Chemistry</option>
					<option <?php echo $StudentDepartment == "Civil Engineering" ? 'selected' : '' ?> value="Civil Engineering">Civil Engineering</option>
					<option <?php echo $StudentDepartment == "Computer Sc. & Engineering" ? 'selected' : '' ?> value="Computer Sc. & Engineering"> Computer Sc. & Engineering</option>
					<option <?php echo $StudentDepartment == "Electrical Engineering" ? 'selected' : '' ?> value="Electrical Engineering"> Electrical Engineering</option>
					<option <?php echo $StudentDepartment == "GIS Cell" ? 'selected' : '' ?> value="GIS Cell">GIS Cell</option>
					<option <?php echo $StudentDepartment == "Humanities and Social Science" ? 'selected' : '' ?> value="Humanities and Social Science">Humanities and Social Science</option>
					<option <?php echo $StudentDepartment == "Mathematics" ? 'selected' : '' ?> value="Mathematics">Mathematics </option>
					<option <?php echo $StudentDepartment == "Mechanical Engineering" ? 'selected' : '' ?> value="Mechanical Engineering"> Mechanical Engineering</option>
					<option <?php echo $StudentDepartment == "Physics" ? 'selected' : '' ?> value="Physics">Physics</option>
					<option <?php echo $StudentDepartment == "School of Management Studies" ? 'selected' : '' ?> value="School of Management Studies"> School of Management Studies</option>
				</select>
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="email">Email (@mnnit.ac.in) : </label>
				<input class="border-2 w-5/6" name="studentemail" id="studentemail" value="<?php echo $StudentEmail ?>" />
			</div>
		</div>

		<div class="flex flex-wrap justify-center  <?php echo ($role == 'faculty') ? '' : 'hidden' ?>" id="faculty-form">
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="facid">Faculty ID : </label>
				<input class="border-2" id="facid" name="facid" value="<?php echo $FacultyId ?>" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="name">Full Name : </label>
				<input class="border-2 w-5/6" id="name" name="fullfacultyname" value="<?php echo $FullFacultyName ?>" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="designation">Designation : </label>
				<select name="designation" id="department">
					<option <?php echo $Designation == "Assistant Professor (Grade-I)" ? 'selected' : '' ?> value="Assistant Professor (Grade-I)">Assistant Professor (Grade-I)</option>
					<option <?php echo $Designation == "Assistant Professor (Grade-II)" ? 'selected' : '' ?> value="Assistant Professor (Grade-II)">Assistant Professor (Grade-II)</option>
					<option <?php echo $Designation == "Associate Professo" ? 'selected' : '' ?> value="Associate Professor">Associate Professor</option>
					<option <?php echo $Designation == "Professor" ? 'selected' : '' ?> value="Professor">Professor</option>
					<option <?php echo $Designation == "Professor (HAG)" ? 'selected' : '' ?> value="Professor (HAG)">Professor (HAG)</option>
				</select>
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="department">Department : </label>
				<select name="facultydepartment" id="department">
					<option <?php echo $FacultyDepartment == "Applied Mechanics" ? 'selected' : '' ?> value=" Applied Mechanics">Applied Mechanics</option>
					<option <?php echo $FacultyDepartment == "Biotechnology" ? 'selected' : '' ?> value="Biotechnology">Biotechnology</option>
					<option <?php echo $FacultyDepartment == "Chemical Engineering" ? 'selected' : '' ?> value="Chemical Engineering">Chemical Engineering</option>
					<option <?php echo $FacultyDepartment == "Chemistry" ? 'selected' : '' ?> value="Chemistry">Chemistry</option>
					<option <?php echo $FacultyDepartment == "Civil Engineering" ? 'selected' : '' ?> value="Civil Engineering">Civil Engineering</option>
					<option <?php echo $FacultyDepartment == "Computer Sc. & Engineering" ? 'selected' : '' ?> value="Computer Sc. & Engineering"> Computer Sc. & Engineering</option>
					<option <?php echo $FacultyDepartment == "Electrical Engineering" ? 'selected' : '' ?> value="Electrical Engineering"> Electrical Engineering</option>
					<option <?php echo $FacultyDepartment == "GIS Cell" ? 'selected' : '' ?> value="GIS Cell">GIS Cell</option>
					<option <?php echo $FacultyDepartment == "Humanities and Social Science" ? 'selected' : '' ?> value="Humanities and Social Science">Humanities and Social Science</option>
					<option <?php echo $FacultyDepartment == "Mathematics" ? 'selected' : '' ?> value="Mathematics">Mathematics </option>
					<option <?php echo $FacultyDepartment == "Mechanical Engineering" ? 'selected' : '' ?> value="Mechanical Engineering"> Mechanical Engineering</option>
					<option <?php echo $FacultyDepartment == "Physics" ? 'selected' : '' ?> value="Physics">Physics</option>
					<option <?php echo $FacultyDepartment == "School of Management Studies" ? 'selected' : '' ?> value="School of Management Studies"> School of Management Studies</option>
				</select>
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="email">Email (@mnnit.ac.in) : </label>
				<input class="border-2 w-5/6" id="facultyemail" name="facultyemail" value="<?php echo $FacultyEmail ?>" />
			</div>
		</div>


		<div class="text-center font-black my-6">Enter About Book</div>
		<div class="flex flex-wrap justify-center">
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="title">Book Title : </label>
				<input class="border-2 w-5/6 " name="booktitle" id="title" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="author">Author : </label>
				<input class="border-2 w-5/6" name="author" id="author" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="publisher">Publisher : </label>
				<input class="border-2 w-5/6" name="publisher" id="publisher" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="Year">Year of Publish : </label>
				<input class="border-2" name="yearofpublish" type="number" id="Year" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="Edition">Edition : </label>
				<input class="border-2" name="edition" type="number" id="Edition" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="isbn">ISBN : </label>
				<input class="border-2" name="isbn" type="number" id="isbn" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="currency">Currency : </label>
				<select name="currency" id="currency">
					<option value="INR">Indian Rupees (INR)</option>
					<option value="USD">US Dollar (USD)</option>
				</select>
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="price">Price : </label>
				<input class="border-2" name="price" type="number" id="price" />
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="reference">Type : </label>
				<select name="booktype" id="reference">
					<option value="ReferenceBook">Reference Book</option>
					<option value="TextBook">Text Book</option>
				</select>
			</div>
			<div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 grid justify-items-center ">
				<label for="copies">Copies : </label>
				<input class="border-2" type="number" name="copies" id="copies" />
			</div>
		</div>
		<div class="flex flex-wrap justify-center">
			<input class="" name="queueadd" value="Add to Queue" type="submit">
		</div>
		<div class="text-center font-black my-6">Book Queue</div>
		<div>
			<?php
			function displayTable($n)
			{
				$n->printRow();
			}

			echo "<table class=\"displayTable\">";
			echo "<tr>";
			echo "<th>Title</td>";
			echo "<th>Author</td>";
			echo "<th>Publisher</td>";
			echo "<th>YearOfPublishing</td>";
			echo "<th>Edition</td>";
			echo "<th>ISBN</td>";
			echo "<th>Currency</td>";
			echo "<th>Price</td>";
			echo "<th>Type</td>";
			echo "<th>Copies</td>";
			echo "</tr>";
			array_map('displayTable', $_SESSION['OrderList']);
			echo "</table>";
			?>
		</div>
		<div class="flex flex-wrap justify-center">
			<input class="border-4 mx-4 rounded-full px-2" name="submit" value="Submit" type="submit">
			<input class="border-4 mx-4 rounded-full px-2" name="clearqueue" value="Clear Queue" type="submit">
		</div>

	</form>
</div>




<script>
	const studentSelect = document.getElementById('student');
	const facultySelect = document.getElementById('faculty');
	const studentForm = document.getElementById("student-form");
	const facultyForm = document.getElementById("faculty-form");
	facultySelect.addEventListener('click', (e) => {
		studentForm.classList.add("hidden");
		facultyForm.classList.remove("hidden");
	})

	studentSelect.addEventListener('click', (e) => {
		studentForm.classList.remove("hidden");
		facultyForm.classList.add("hidden");

	})
</script>