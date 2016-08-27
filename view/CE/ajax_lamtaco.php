<?php foreach($materialesce as $materialce):?>
	<tr>
	    <td><?php echo $materialce->num_laminas;?></td>
	    <td><?php echo $materialce->num_tacos;?></td>
	    <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==3):?>
	    <td><?php echo $materialce->tecnologo;?></td>
	    <?php endif?>
	</tr>
<?php endforeach;?>