<?php foreach($materiales as $material):?>
	<tr>
	    <td><?php echo $material->num_laminas;?></td>
	    <td><?php echo $material->num_tacos;?></td>
	    <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==3):?> 
	    <td><?php echo $material->tecnologo;?></td>
	    <?php endif?>
	</tr>
<?php endforeach;?>