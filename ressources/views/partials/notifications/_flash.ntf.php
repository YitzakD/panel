<?php if(isset($_SESSION['ntf']['message'])) : ?>
    
    <div class="alert alert-<?= $_SESSION['ntf']['type']; ?> alert-dismissible fade show dev-content-alert" role="alert" id="js-p-alert">

        <div class="content-alert-one" >

    	<?php if($_SESSION['ntf']['type'] === "info"): ?><strong>Information!</strong>

    	<?php elseif($_SESSION['ntf']['type'] === "success"): ?><strong>Félicitation!</strong>

    	<?php elseif($_SESSION['ntf']['type'] === "warning"): ?><strong>Attention!</strong>

    	<?php elseif($_SESSION['ntf']['type'] === "danger"): ?><strong>Erreur!</strong>

    	<?php else: ?><strong>conseil!</strong>

    	<?php endif; ?>

    	<?= $_SESSION['ntf']['message']; ?>

        </div>

		<button type="button" class="close p-alert-close" data-dismiss="alert" aria-label="Close" title="Fermer">

			<span aria-hidden="true">&times;</span>

		</button>

    </div>

    <?php $_SESSION['ntf'] = []; ?>

<?php endif; ?>