<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/login1.css')?>">
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<?php echo form_open('login_admin/process_login'); ?>
			<h1>Administrateur</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>

			<?php if (isset($erreur)) { ?>
				<p style="color: red;"><?php echo $erreur; ?></p>
			<?php } ?>

			<span>Veuillez remplir les champs</span>
			<input type="text" placeholder="Veuillez entrer votre pseudonyme" name="nom" value="admin"/>
			<input type="password" placeholder="Veuillez entrer votre Mot de passe" name="mdp" value="admin"/>
			<button type="submit">Se connecter</button>
		<?php echo form_close(); ?>
	</div>
	
	<div class="form-container sign-in-container">
	<?php echo form_open('login/process_login'); ?>
			<h1>Utilisateur</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
			<input type="text" name="car_number" placeholder="Veuillez entrer votre immatriculation" />
			<select name="car_type_name" id="car_type_name">
				<option value="">Veuillez entrer le type de vehicule</option>
				<?php foreach ($types_voiture as $type) { ?>
                <option value="<?php echo $type['nom']; ?>"><?php echo $type['nom']; ?></option>
            <?php } ?>
			</select>
			<button type="submit">Se connecter</button>
		<?php echo form_close(); ?>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left" style="background-color: #4B49AC;">
				<h1>AutoMecano</h1>
				<p></p>
				<button id="signIn">Utilisateur</button>
			</div>
			<div class="overlay-panel overlay-right" style="background-color: #1089ff ;">
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
