<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link rel="stylesheet" href="../../assets/css/login1.css">
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="#">
			<h1>Administrateur</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>Veuillez remplir les champs</span>
			<input type="text" placeholder="Veuillez entrer votre pseudonyme" />
			<input type="password" placeholder="Veuillez entrer votre Mot de passe" />
			<button>Se connecter</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login" method="post">
			<h1>Utilisateur</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>Veuillez remplir les champs</span>
			<input type="text" name="text" placeholder="Veuillez entrer votre immatriculation" />
			<select name="" id="">
				<option value="">Veuillez entrer le type de vehicule</option>
				<option value="">"4*4"</option>
			</select>
			<button type="submit">Se connecter</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>AutoMecano</h1>
				<p></p>
				<button id="signIn">Utilisateur</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>AutoMecano</h1>
				<p></p>
				<button id="signUp">Administrateur</button>
			</div>
		</div>
	</div>
</div>

<footer>

</footer>

<script>
    const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});

	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
});

</script>
</body>
</html>
