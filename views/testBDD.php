<?php
require_once __DIR__ . '/../controllers/LoginController.php';
$controller = new LoginController();
$users = $controller->getAllUsers();
?>
<h2>Liste des utilisateurs</h2>
<table border="1" cellpadding="8" style="border-collapse:collapse;">
	<thead>
		<tr>
			<th>ID</th>
			<th>Pseudo</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?= htmlspecialchars($user['id']) ?></td>
				<td><?= htmlspecialchars($user['pseudo']) ?></td>
				<td><?= htmlspecialchars($user['email']) ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>