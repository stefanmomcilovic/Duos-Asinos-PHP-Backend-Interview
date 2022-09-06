<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
<h1>Welcome, <?= $_SESSION['user']['name']; ?></h1>
<?php else: ?>
<h1>Please login</h1>
<?php endif; ?>