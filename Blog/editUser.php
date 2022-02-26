<!DOCTYPE html>
<html>
<head>
	<title>Admin Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>


<div>
	
        <form method="post" action="editUser.php">

	<div>
			<label>Username</label>
			<input type="text" name="username">
		</div>
		<div>
			<label>Email</label>
			<input type="email" name="email">
		</div>
		<div>
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div>
        <label>Post Visible to user/label>
			<select name="visible_status" >
				<option value=""></option>
				<option value="Active">Active</option>
				<option value="Unactive">Unactive</option>
			</select>
		</div>
		
		<div>
			<button type="submit" class="btn" name="userVisible_btn"> Add Permission</button>
		</div>
	</form>
    </div>
</body>
</html>
